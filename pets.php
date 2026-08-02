<?php include 'includes/db.php'; ?>


<?php include('includes/header.php'); ?>

<div class="container">
    <h2 class="page-title">Available Pets for Adoption</h2>
    <div class="card-grid">
        <?php
        // Sample static pet data (You can later fetch from database)
        $pets = [
            ['name' => 'Bella', 'breed' => 'Labrador', 'image' => 'images/bella.jpg', 'desc' => 'Friendly and playful.'],
            ['name' => 'Max', 'breed' => 'German Shepherd', 'image' => 'images/max.jpg', 'desc' => 'Very loyal and active.'],
            ['name' => 'Milo', 'breed' => 'Golden Retriever', 'image' => 'images/milo.jpg', 'desc' => 'Loves kids and cuddles.']
        ];

        foreach ($pets as $pet) {
            echo '<div class="card">
                    <img src="' . $pet['image'] . '" alt="' . $pet['name'] . '">
                    <h3>' . $pet['name'] . '</h3>
                    <p><strong>Breed:</strong> ' . $pet['breed'] . '</p>
                    <p>' . $pet['desc'] . '</p>
                  </div>';
        }
        ?>
    </div>
</div>



<?php include('includes/footer.php'); ?>
