<?php
session_start();
require_once __DIR__ . '/includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$pet_id = $_GET['pet_id'] ?? null;

if (!$pet_id) {
    echo "No pet selected.";
    exit;
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insert adoption request
    $stmt = $conn->prepare("INSERT INTO adoption_requests (user_id, pet_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $pet_id);
    if ($stmt->execute()) {
        $success = "Your adoption request has been sent!";
    } else {
        $error = "Error sending request. Please try again.";
    }
    $stmt->close();
}

?>

<?php include __DIR__ . '/includes/header.php'; ?>

<div style="max-width: 500px; margin: 50px auto; background: #232323cc; padding: 30px; border-radius: 12px; color: #fff;">
    <h2>Request Adoption</h2>
    <?php if ($error): ?>
        <div style="color: #ff6565; margin-bottom: 15px;"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div style="color: #a5d6a7; margin-bottom: 15px;"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <p>Are you sure you want to request adoption for pet ID: <strong><?php echo htmlspecialchars($pet_id); ?></strong>?</p>
        <button type="submit" style="background: #ffc100; color: #181818; padding: 12px 20px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">Send Request</button>
    </form>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
