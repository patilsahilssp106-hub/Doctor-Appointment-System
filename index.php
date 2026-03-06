<?php require_once 'includes/header.php'; ?>

<!-- Hero Section -->
<div class="p-5 mb-4 bg-light rounded-3 hero-section text-center" style="background-color: #343a40 !important; background-image: none;">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-white">Welcome to RestoBook</h1>
        <p class="col-md-8 fs-4 mx-auto text-light">Experience the best dining with our seamless online table booking system. Reserve your spot today and skip the waiting line!</p>
        <a href="booking.php" class="btn btn-warning btn-lg px-4 gap-3">Book a Table Now</a>
    </div>
</div>

<!-- Features Section -->
<div class="row align-items-md-stretch">
    <div class="col-md-6 mb-4">
        <div class="h-100 p-5 text-white bg-dark rounded-3">
            <h2>Delicious Cuisine</h2>
            <p>We offer a wide variety of dishes prepared by world-class chefs. From local delicacies to international favorites, we have something for everyone.</p>
            <a href="menu.php" class="btn btn-outline-light">View Menu</a>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="h-100 p-5 bg-light border rounded-3">
            <h2>Private Events</h2>
            <p>Planning a birthday, anniversary, or corporate meeting? Our restaurant offers private dining areas perfect for your special occasions.</p>
            <div class="d-flex gap-2">
                <a href="mailto:events@restobook.com" class="btn btn-outline-secondary"><i class="fas fa-envelope me-2"></i>Email Us</a>
                <a href="tel:+911234567890" class="btn btn-outline-secondary"><i class="fas fa-phone-alt me-2"></i>+91 123 456 7890</a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Info Section -->
<div class="row text-center mt-5 mb-5">
    <div class="col-md-4">
        <i class="fas fa-clock fa-3x text-warning mb-3"></i>
        <h4>Opening Hours</h4>
        <p>Mon - Sun: 10:00 AM - 11:00 PM</p>
    </div>
    <div class="col-md-4">
        <i class="fas fa-map-marker-alt fa-3x text-warning mb-3"></i>
        <h4>Location</h4>
        <p>123 Food Street, City Center</p>
    </div>
    <div class="col-md-4">
        <i class="fas fa-phone-alt fa-3x text-warning mb-3"></i>
        <h4>Call Us</h4>
        <p>+91 123 456 7890</p>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>