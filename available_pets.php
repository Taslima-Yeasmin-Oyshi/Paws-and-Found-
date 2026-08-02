<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'user') {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/includes/db_connect.php';
include('includes/header.php');
?>

<h2 style="text-align:center; margin-top:30px; color:#ffc100;">Available Pets for Adoption</h2>

<div class="pet-list" style="max-width:1100px; margin:30px auto; display:flex; flex-wrap:wrap; gap:28px; justify-content:center;">

<?php
$sql = "SELECT * FROM pets WHERE status='Available'";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $img = !empty($row['photo']) ? htmlspecialchars($row['photo']) : 'noimage.jpg';
        echo "<div class='pet' style='border:1.5px solid #ffd566; padding:20px 18px 26px 18px; border-radius:14px; width:285px; background:#232323; box-shadow:0 4px 16px #0002; text-align:center;'>";
        echo "<img src='images/{$img}' alt='" . htmlspecialchars($row['name']) . "' style='width:100%;height:180px;object-fit:cover;border-radius:10px;margin-bottom:13px;border:1px solid #ffc10033;'>";
        echo "<h3 style='color:#ffc100;margin-bottom:8px;font-size:1.3em;'>" . htmlspecialchars($row['name']) . "</h3>";
        if (!empty($row['description'])) {
            echo "<div style='color:#ffe496;font-size:.97em; margin-bottom:10px;'>" . htmlspecialchars($row['description']) . "</div>";
        }
        if (!empty($row['location'])) {
            echo "<div style='color:#b6b4b1;font-size:.97em; margin-bottom:13px;'><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</div>";
        }
        echo '<a href="adopt.php?pet_id=' . urlencode($row['id']) . '" class="login-btn" style="margin-top:10px; display:inline-block; background:#ffc100; color:#181818; padding:10px 32px; border-radius:8px; font-weight:700; text-decoration:none;box-shadow:0 2px 8px #0002;">Adopt</a>';
        echo "</div>";
       }
} else {
    echo "<p style='color:#fffbe6;text-align:center;'>No pets currently available for adoption.</p>";
}
?>

</div>

<?php include('includes/footer.php'); ?>
