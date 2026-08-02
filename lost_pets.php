<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'user') {
    header('Location: login.php');
    exit;
}
include('includes/header.php');
require_once __DIR__ . '/includes/db_connect.php';
?>
<style>
    .lost-pets-container {
        max-width: 1100px;
        margin: 40px auto 35px auto;
        display: flex;
        flex-wrap: wrap;
        gap: 28px;
        justify-content: center;
    }
    .lost-pet-card {
        background: #232323e6;
        border-radius: 15px;
        box-shadow: 0 4px 22px #0005;
        width: 285px;
        padding: 22px 18px 20px 18px;
        text-align: center;
        color: #ffe496;
        border: 1.5px solid #ffc10066;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 10px;
        transition: transform .14s, box-shadow .14s;
    }
    .lost-pet-card:hover {
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 8px 28px #0006;
    }
    .lost-pet-card img {
        width: 96%;
        height: 180px;
        object-fit: cover;
        border-radius: 11px;
        margin-bottom: 16px;
        border: 1.5px solid #ffc10055;
        background: #fff;
    }
    .lost-pet-card h3 {
        color: #ffc100;
        font-size: 1.25em;
        margin-bottom: 8px;
        margin-top: 0;
        font-weight: 800;
    }
    .lost-pet-card strong {
        color: #fffbe6;
        font-weight: 700;
    }
    .lost-pet-card .desc {
        color: #ffe496;
        font-size: .98em;
        margin-top: 7px;
        margin-bottom: 5px;
    }
    .found-btn {
        background: #ffc100;
        color: #181818;
        font-weight: 700;
        border: none;
        border-radius: 8px;
        padding: 7px 18px;
        margin-top: 9px;
        transition: background .13s, color .13s;
        cursor: pointer;
    }
    .found-btn:hover {
        background: #26b72b;
        color: #fff;
    }
    @media (max-width: 900px) {
        .lost-pets-container {
            flex-direction: column;
            align-items: center;
        }
        .lost-pet-card {
            width: 95vw;
        }
    }
</style>

<h2 style="text-align:center; margin-top:30px; color:#ffc100;">Reported Lost Pets</h2>
<div style="text-align:center;margin-bottom:28px;">
    <a href="report_lost.php" class="back-btn" style="font-size:1.1em;padding:9px 24px;background:#ffc100;color:#181818;border-radius:7px;text-decoration:none;">+ Report a Lost Pet</a>
</div>

<div class="lost-pets-container">
    <?php
    // Only show pets that are Lost (not ReportedFound or Resolved)
$result = $conn->query("SELECT * FROM lost_pets WHERE status IN ('Lost','ReportedFound') ORDER BY id DESC");

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $img = htmlspecialchars($row['photo'] ?? 'noimage.jpg');
            echo '<div class="lost-pet-card">';
            echo "<img src='images/$img' alt='" . htmlspecialchars($row['name']) . "'>";
            echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
            echo "<div><strong>Breed:</strong> " . htmlspecialchars($row['breed']) . "</div>";
            echo "<div class='desc'>" . htmlspecialchars($row['description']) . "</div>";
            // Show found button if user is not admin and pet not resolved
            if (($_SESSION['user_role'] ?? '') != 'admin' && strtolower($row['status']) != 'resolved') {
                echo '<form method="post" action="report_found.php">';
                echo '<input type="hidden" name="pet_id" value="' . $row['id'] . '">';
                echo '<button type="submit" name="report_found" class="found-btn">I Found This Pet</button>';
                echo '</form>';
            }
            echo '</div>';
        }
    } else {
        echo "<div style='color:#fffbe6;'>No lost pets reported yet.</div>";
    }
    ?>
</div>
<?php include('includes/footer.php'); ?>
