<?php
session_start();
require_once __DIR__ . '/includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id   = $_SESSION['user_id'];
$pet_id    = $_POST['pet_id'] ?? '';
$full_name = trim($_POST['full_name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$phone     = trim($_POST['phone'] ?? '');
$address   = trim($_POST['address'] ?? '');
$pet_type  = trim($_POST['pet_type'] ?? '');
$reason    = trim($_POST['reason'] ?? '');

include('includes/header.php');
?>

<style>
.adoption-success-box {
    max-width: 450px;
    margin: 120px auto 0 auto;
    background: rgba(28,28,28, 0.98);
    border-radius: 22px;
    box-shadow: 0 12px 56px 0 rgba(0,0,0,0.23), 0 2px 16px 0 #ffc10022;
    padding: 48px 40px 42px 40px;
    text-align: center;
    border-top: 5px solid #ffc100;
    animation: pop-in 0.7s cubic-bezier(.52,2.03,.72,.89);
}
@keyframes pop-in {
  0% { transform: scale(0.95) translateY(80px); opacity: 0; }
  100% { transform: scale(1) translateY(0); opacity: 1; }
}
.adoption-success-box h2 {
    color: #ffc100;
    margin-bottom: 18px;
    font-size: 2.1em;
    font-weight: 900;
    letter-spacing: 1.5px;
    text-shadow: 0 2px 18px #1118;
}
.adoption-success-box p {
    color: #ffeebb;
    font-size: 1.17em;
    margin-bottom: 36px;
    line-height: 1.5;
}
.adoption-success-box a {
    display: inline-block;
    margin-top: 0;
    padding: 12px 32px 11px 32px;
    background: linear-gradient(90deg, #ffc100 55%, #ffe496 100%);
    color: #232323;
    border-radius: 9px;
    text-decoration: none;
    font-weight: 800;
    font-size: 1.16em;
    box-shadow: 0 2px 16px #ffc10022;
    transition: background .19s, color .19s, box-shadow .18s;
    border: none;
    outline: none;
}
.adoption-success-box a:hover {
    background: linear-gradient(90deg, #ffe496 55%, #ffc100 100%);
    color: #111;
    box-shadow: 0 3px 28px #ffc10055;
}
@media (max-width: 700px) {
    .adoption-success-box {
        max-width: 97vw;
        padding: 28px 6vw 24px 6vw;
    }
    .adoption-success-box h2 { font-size: 1.4em; }
}
</style>


<?php
if ($pet_id && $full_name && $email && $phone && $address && $pet_type && $reason) {
    $stmt = $conn->prepare("INSERT INTO adoption_requests 
        (user_id, pet_id, full_name, email, phone, address, pet_type, reason, status, request_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW())"
    );
    $stmt->bind_param("iissssss", $user_id, $pet_id, $full_name, $email, $phone, $address, $pet_type, $reason);

    if ($stmt->execute()) {
        echo '<div class="adoption-success-box">
                <h2>Thank You!</h2>
                <p>Your adoption request has been submitted.<br>We will contact you soon.</p>
                <a href="available_pets.php">Back to Available Pets</a>
              </div>';
    } else {
        echo '<div class="adoption-error">Error submitting request: ' . htmlspecialchars($stmt->error) . '</div>';
    }
    $stmt->close();
} else {
    echo '<div class="adoption-error">Please fill in all required fields.</div>';
}

include('includes/footer.php');
?>
