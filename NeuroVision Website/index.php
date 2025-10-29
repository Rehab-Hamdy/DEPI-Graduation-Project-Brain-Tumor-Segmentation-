<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>NeuroVision</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<!-- Login Modal -->
<div id="loginModal" class="login-modal">
    <div class="login-modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="role" class="form-label">Login as:</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="doctor">Doctor</option>
                    <option value="patient">Patient</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <?php
        session_start();
        if (isset($_SESSION['error_message'])) {
            echo "<div class='error-message'>{$_SESSION['error_message']}</div>";
            unset($_SESSION['error_message']);
        }
        ?>
    </div>
</div>


<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->



    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
        <a href="" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h1 class="m-0 text-primary"><img src="img/Blue-ABstract-Brain-Technology-unscreen.gif" alt="" style="width: 200px; margin:-60px; margin-right: -50px;">NeuroVision</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="#home" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <a href="#services" class="nav-item nav-link">Service</a>
                <a href="#contact" class="nav-item nav-link">Contact Us</a>
            </div>
            <a href="#" onclick="openModal()" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Login</a>
        </div>
    </nav>
    <!-- Navbar End --> 


    <!-- Header Start -->
    <div class="container-fluid header bg-primary p-0 mb-5" style="height: 700px" id="home">
        <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
            <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-4 text-white mb-5">Empowering Precision in Brain Tumor Diagnosis</h1>
                <div>
                    <p style="color: white;">Our AI-driven platform provides healthcare professionals with advanced tools for brain tumor segmentation,
                        aiding in accurate diagnosis and efficient patient management.
                        Patients can securely access their diagnostic results and connect with their healthcare providers through our secure portal.</p>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item position-relative" >
                        <img class="img-fluid" src="img/Brain2g.gif" alt="" style="height: 700px">
                    </div>
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="img/brain.gif" alt="" style="height: 700px">
                    </div>
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="img/Brain Cerebral Cortex GIF - Brain Cerebral Cortex Parts Of The Brain - Discover & Share GIFs.gif" alt="" style="height: 700px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5" id="about">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex flex-column">
                        <img class="img-fluid rounded w-75 align-self-end" src="img/About.jpg" alt="">
                        <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="img/Brain GIF - Brain Mind - Discover & Share GIFs.gif" alt="" style="margin-top: -25%;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">About Us</p>
                    <h1 class="mb-4">About Brain Tumor Segmentation</h1>
                    <p>Brain tumor segmentation is an advanced AI technique that helps identify and outline tumor regions in MRI scans with high precision. By leveraging deep learning models, this platform assists doctors in the critical task of diagnosing brain tumors, reducing analysis time and increasing accuracy. We aim to support healthcare providers with this cutting-edge technology to improve outcomes for patients through early and accurate detection. With both doctors and patients in mind, our platform prioritizes data security, usability, and ease of access, making it a reliable tool in the diagnostic journey.</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Accurate Tumor Detection</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Advanced AI for Reliable Diagnosis</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Secure Patient Data Access</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-xxl py-5" id="services">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Services</p>
                <h1>Why Choose Us?</h1>
            </div>
            <div class="row g-4">
                <h2>For Doctors:</h2>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-brain text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Accurate Tumor Segmentation</h4>
                        <p class="mb-4">Our AI model offers accurate tumor segmentation for efficient diagnostic analysis, supporting precise and rapid identification.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-upload text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Easy MRI Upload and Viewing</h4>
                        <p class="mb-4">Doctors can easily upload MRI scans, view tumor segmentation results, and add diagnostic notes for each patient.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-chart-bar text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Detailed Patient Analysis</h4>
                        <p class="mb-4">We provide in-depth analysis of patient conditions, including tracking tumor occurrences and non-occurrences across our patient base. This data-driven approach allows for better understanding and management of patient health, helping us to continuously improve treatment strategies and patient outcomes.</p>
                    </div>
                </div>
                <h2>For Patients:</h2>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-user-shield text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Secure Access to Results</h4>
                        <p class="mb-4">Patients have private and secure access to their MRI results and notes from their doctor, helping them stay informed about their health.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-lightbulb text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Improved Understanding</h4>
                        <p class="mb-4">Diagnostic notes and images make it easier to understand and follow treatment discussions.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-comments text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Tumor Information Chatbot</h4>
                        <p class="mb-4">Patients can ask questions directly to our chatbot about brain tumors and related topics, helping them understand their diagnosis and treatment options better.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

<!-- Team Start -->
    <div class="container-xxl py-5" id="contact">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Contact Us</p>
                <h1>Our Team</h1>
            </div>
            <div class="row g-4" style="padding-left: 190px;">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/Rehab.jpg" alt="">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>Rehab Hamdy</h5>
                            <p class="text-primary">
                                DEPI Trainee
                                <br>
                                Computer science student at Helwan University
                            </p>
                            <div class="team-social text-center">
                                <a class="btn btn-square" href="http://www.linkedin.com/in/rehab-hamdy-83568424b"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/marina safwat.jpg" alt="" style="height: 300px; width: 300px;">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>Marina Safwat</h5>
                            <p class="text-primary">
                                DEPI Trainee
                                <br>
                                Computer science student at October 6 University
                            </p>
                            <div class="team-social text-center">
                                <a class="btn btn-square" href="http://www.linkedin.com/in/marina-safwat-3b186b246"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/Alaa.jpg" alt="" style="height: 300px;">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>Alaa Mohsen</h5>
                            <p class="text-primary">
                                DEPI Trainee
                                <br>
                                Computer Engineering student at Ain shams University
                            </p>
                            <div class="team-social text-center">
                                <a class="btn btn-square" href="https://www.linkedin.com/in/alaa-mohsen-b5422921b?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script>
        // Show the modal
        function openModal() {
            document.getElementById("loginModal").style.display = "block";
        }

        // Hide the modal
        function closeModal() {
            document.getElementById("loginModal").style.display = "none";
        }

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById("loginModal");
            if (event.target == modal) {
                closeModal();
            }
        }

    </script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>