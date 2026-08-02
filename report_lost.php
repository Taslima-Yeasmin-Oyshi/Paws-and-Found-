<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'user') {
    header('Location: login.php'); exit;
}
include('includes/header.php');
require_once __DIR__ . '/includes/db_connect.php';

$success = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $breed = trim($_POST['breed'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $photo = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $targetDir = 'images/';
        $fileName = basename($_FILES['photo']['name']);
        $targetFile = $targetDir . time() . '_' . $fileName;
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
            $photo = basename($targetFile);
        } else { $error = 'Error uploading image.'; }
    }
    if (!$error && $name && $breed && $description) {
        $stmt = $conn->prepare("INSERT INTO lost_pets (name, breed, description, photo, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $name, $breed, $description, $photo);
        if ($stmt->execute()) { $success = true; } else { $error = 'Could not save lost pet. ' . $stmt->error; }
        $stmt->close();
    } elseif (!$error) { $error = 'Please fill in all required fields.'; }
}
?>
<div class="lost-pet-form-container" style="max-width:480px;margin:44px auto 40px auto;padding:34px 26px 28px 26px;background:#232323f3;border-radius:13px;box-shadow:0 6px 30px #0008;">
    <h2 style="text-align:center;color:#ffc100;margin-bottom:22px;">Report a Lost Pet</h2>
    <?php if ($success): ?>
        <div class="success-box" style="background:#fffbe6;color:#181818;border-radius:8px;padding:20px 14px 18px 14px;text-align:center;margin-bottom:24px;font-weight:600;box-shadow:0 2px 16px #0001;">
            <span style="font-size:1.3em;color:#27ae60;">&#10003;</span> Lost pet reported successfully!
            <br><br>
            <a href="lost_pets.php" class="back-btn" style="margin-top:18px;background:#ffc100;color:#181818;border-radius:7px;padding:10px 26px;text-decoration:none;display:inline-block;">&larr; Back to Lost Pets</a>
        </div>
    <?php else: ?>
        <?php if ($error): ?>
          <div class="success-box" style="background:#ffb8b8;color:#540000;border-radius:8px;padding:15px 13px;text-align:center;margin-bottom:19px;">
            &#9888; <?php echo $error; ?>
          </div>
        <?php endif; ?>
        <form action="report_lost.php" method="POST" enctype="multipart/form-data">
            <label for="name" style="color:#ffc100;font-weight:600;">Pet Name</label>
            <input type="text" name="name" id="name" required style="width:100%;padding:9px 8px;border-radius:7px;border:1px solid #ffc10044;margin-bottom:13px;background:#141414;color:#fff;">
            <label for="breed" style="color:#ffc100;font-weight:600;">Breed</label>
            <input type="text" name="breed" id="breed" required style="width:100%;padding:9px 8px;border-radius:7px;border:1px solid #ffc10044;margin-bottom:13px;background:#141414;color:#fff;">
            <label for="description" style="color:#ffc100;font-weight:600;">Details</label>
            <textarea name="description" id="description" rows="3" required style="width:100%;padding:9px 8px;border-radius:7px;border:1px solid #ffc10044;margin-bottom:13px;background:#141414;color:#fff;"></textarea>
            <label for="photo" style="color:#ffc100;font-weight:600;">Pet Photo</label>
            <input type="file" name="photo" id="photo" accept="image/*" style="width:100%;margin-bottom:20px;">
            <button type="submit" style="width:100%;background:#ffc100;color:#181818;font-weight:700;padding:12px 0;border-radius:8px;font-size:1.12em;border:none;">Submit</button>
        </form>
    <?php endif; ?>
</div>
<?php include('includes/footer.php'); ?>
