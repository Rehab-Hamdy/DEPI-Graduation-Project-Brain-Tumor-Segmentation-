from flask import Flask, request, jsonify
from transformers import pipeline

app = Flask(__name__)
medical_chatbot = pipeline("question-answering", model="deepset/bert-base-cased-squad2")

medical_context =  """
Brain tumors are abnormal growths of cells in the brain. Tumors can be benign (non-cancerous) or malignant (cancerous).
Common symptoms of brain tumors include headaches, seizures, memory problems, and changes in behavior.
Treatment options depend on the type and size of the tumor, and can include surgery, radiation therapy, or chemotherapy.
Brain tumors are abnormal growths of tissue within the brain. They can be benign (non-cancerous) or malignant (cancerous). The severity and treatment options for brain tumors vary widely depending on several factors, including:
Type: There are numerous types of brain tumors, each with its own characteristics and prognosis. Some common types include gliomas, meningiomas, and pituitary tumors.
Location: The location of a brain tumor within the brain can significantly impact its symptoms and treatment options. For example, a tumor located in the motor cortex may affect movement, while one in the visual cortex may impact vision.
Size: Larger tumors are often associated with more severe symptoms and may require more aggressive treatment.
Grade: The grade of a brain tumor refers to its aggressiveness and the likelihood of its recurrence. Higher-grade tumors are generally more malignant and difficult to treat.
Symptoms of brain tumors can vary widely depending on their location and size. Some common symptoms include:
Headaches
Seizures
Changes in vision
Weakness or numbness
Difficulty speaking or understanding speech
Balance problems
Personality changes
Diagnosis of brain tumors typically involves a combination of imaging tests, such as MRI and CT scans, and sometimes a biopsy.
Treatment options for brain tumors depend on the type, location, size, and grade of the tumor. Common treatment options include:
Surgery: Surgical removal of the tumor is often the preferred treatment option, especially for benign tumors and some malignant tumors.
Radiation therapy: Radiation therapy uses high-energy rays to kill cancer cells. It may be used after surgery to reduce the risk of recurrence or as the primary treatment for some tumors.
Chemotherapy: Chemotherapy uses drugs to kill cancer cells. It may be used in combination with surgery or radiation therapy for certain types of brain tumors.
Targeted therapy: Targeted therapy uses drugs that specifically target the genetic changes that occur in cancer cells. This type of treatment is becoming increasingly important for treating brain tumors.
Prognosis for brain tumors varies widely depending on the factors mentioned above. While some brain tumors can be cured, others are more difficult to treat and may lead to a poorer outcome. Early diagnosis and treatment can improve the prognosis for many patients with brain tumors.
"""

@app.route('/answer', methods=['POST'])
def answer():
    question = request.json.get('question')
    if not question:
        return jsonify({"error": "No question provided"}), 400
    
    result = medical_chatbot(question=question, context=medical_context)
    return jsonify({"answer": result["answer"]})

@app.route('/test', methods=['GET'])
def test():
    return "Server is running"

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
