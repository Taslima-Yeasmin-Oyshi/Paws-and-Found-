<?php include('includes/header.php'); ?>

<div class="container">
    <h2 class="page-title">🛡️ Register a Pet Care Centre</h2>

    <form action="chip.php" method="POST" class="form">
        <input type="hidden" name="action" value="register_centre">

        <label for="centre_name">Centre Name:</label>
        <input type="text" id="centre_name" name="centre_name" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label for="services">Services Offered:</label>
        <textarea id="services" name="services" required></textarea>

        <label for="contact_info">Contact Information:</label>
        <input type="text" id="contact_info" name="contact_info" required>

        <button type="submit" class="btn">Register Centre</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
