<?php
session_start();
include('includes/header.php');
require_once __DIR__ . '/includes/db_connect.php';

// Handle form submission
$success = $error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donor_name = trim($_POST['donor_name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $amount = floatval($_POST['amount'] ?? 0);
    $message = trim($_POST['message'] ?? '');

    if ($donor_name === '' || $phone === '' || $amount <= 0) {
        $error = "Please enter your name, phone number, and a valid amount.";
    } else {
        $stmt = $conn->prepare("INSERT INTO donations (donor_name, phone, amount, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssds', $donor_name, $phone, $amount, $message);
        if ($stmt->execute()) {
            $success = "Thank you for your donation!";
        } else {
            $error = "Could not process your donation. Please try again.";
        }
        $stmt->close();
    }
}
?>

<style>
.donation-form {
    max-width: 430px;
    margin: 40px auto 40px auto;
    background: #232323e6;
    border-radius: 15px;
    box-shadow: 0 4px 22px #0005;
    padding: 28px 24px 22px 24px;
}
.donation-form label { color: #ffc100; font-weight: 700; }
.donation-form input, .donation-form textarea {
    width: 100%;
    padding: 11px 8px;
    border-radius: 7px;
    border: 1px solid #888;
    margin-bottom: 19px;
    font-size: 1em;
    background: #181818;
    color: #ffe496;
}
.donation-form button {
    width: 100%;
    background: #ffc100;
    color: #181818;
    font-weight: 700;
    font-size: 1.13em;
    padding: 12px 0;
    border-radius: 9px;
    border: none;
    box-shadow: 0 2px 16px #0001;
    transition: .16s;
}
.donation-form button:hover { background: #ffe496; color: #181818; }
</style>

<div class="donation-form">
    <h2 style="color:#ffc100;text-align:center;margin-bottom:22px;">Make a Donation</h2>
    <?php if ($success): ?>
        <div style="color:#228e2d;background:#e9ffe7;border-radius:7px;padding:10px 12px 8px 12px;margin-bottom:17px;text-align:center;font-weight:700;"><?php echo $success; ?></div>
    <?php elseif ($error): ?>
        <div style="color:#d90330;background:#ffe6e6;border-radius:7px;padding:10px 12px 8px 12px;margin-bottom:17px;text-align:center;font-weight:700;"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post" autocomplete="off">
        <label>Name</label>
        <input type="text" name="donor_name" required>
        <label>Phone</label>
        <input type="text" name="phone" required>
        <label>Amount</label>
        <input type="number" name="amount" min="1" step="any" required>
        <label>Message (optional)</label>
        <textarea name="message" rows="3"></textarea>
        <button type="submit">Donate</button>
    </form>
</div>
<?php include('includes/footer.php'); ?>
