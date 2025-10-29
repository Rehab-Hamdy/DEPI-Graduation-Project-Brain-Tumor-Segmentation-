from flask import Flask, request, send_file, jsonify  
from PIL import Image
import io
import numpy as np
import tensorflow as tf
import cv2
import base64

app = Flask(__name__)

interpreter = tf.lite.Interpreter(model_path="quantized_model.tflite")
interpreter.allocate_tensors()

input_details = interpreter.get_input_details()
output_details = interpreter.get_output_details()

def preprocess_image(image):
    image = image.resize((256, 256)) 
    image = np.array(image, dtype=np.float32) / 255.0  
    image = np.expand_dims(image, axis=0)  
    return image

def postprocess_mask(mask):
    mask = (mask.squeeze() * 255).astype(np.uint8)
    mask = cv2.resize(mask, (512, 512))  
    return Image.fromarray(mask)

@app.route("/")
def index():
    return "Welcome to the MRI Segmentation API! Use the /process_image endpoint to upload images."

@app.route("/process_image", methods=["POST"])
def process_image():
    if 'image' not in request.files:
        return "No image provided", 400

    image_file = request.files['image']
    image = Image.open(image_file).convert("RGB")

    input_data = preprocess_image(image)
    interpreter.set_tensor(input_details[0]["index"], input_data)
    interpreter.invoke()

    mask = interpreter.get_tensor(output_details[0]["index"])
    processed_mask = postprocess_mask(mask)

    output_image = np.squeeze(mask)
    if output_image.max() <= 1.0:
        output_image = (output_image > 0.5).astype(np.uint8)
    diagnosis=0
    if output_image.max() > 0:
        diagnosis=1
        
    img_io = io.BytesIO()
    processed_mask.save(img_io, 'PNG')
    img_io.seek(0)

    return jsonify({
        "mask_image": "data:image/png;base64," + base64.b64encode(img_io.getvalue()).decode('utf-8'),
        "diagnosis": diagnosis
    })

if __name__ == "__main__":
    app.run(port=5000, debug=True)
