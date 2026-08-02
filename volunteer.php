<?php
include('includes/header.php');
require_once __DIR__ . '/includes/db_connect.php';

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        $stmt = $conn->prepare("INSERT INTO volunteer_applications (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);
        if ($stmt->execute()) {
            $success = "Thank you for volunteering! We'll contact you soon.";
        } else {
            $error = "Error submitting application: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>
<style>
.volunteer-container {
    max-width: 900px;
    margin: 60px auto 40px auto;
    background: rgba(35,35,35,0.97);
    border-radius: 18px;
    padding: 46px 38px 28px 38px;
    box-shadow: 0 8px 36px #0006;
    color: #ffe496;
}
.volunteer-container h2 {
    color: #ffc100;
    font-size: 2.15em;
    text-align: center;
    margin-bottom: 16px;
    font-weight: 900;
    letter-spacing: 1.3px;
}
.volunteer-container .intro {
    font-size: 1.14em;
    text-align: center;
    margin-bottom: 22px;
    color: #fffbe6;
}
.volunteer-form {
    background: #191919e3;
    border-radius: 12px;
    box-shadow: 0 3px 12px #0003;
    padding: 28px 24px 18px 24px;
    max-width: 430px;
    margin: 0 auto;
    color: #fffbe6;
}
.volunteer-form h3 {
    color: #ffc100;
    text-align: center;
    font-size: 1.19em;
    margin-bottom: 14px;
}
.volunteer-form input,
.volunteer-form textarea {
    width: 100%;
    padding: 10px 8px;
    border-radius: 7px;
    border: 1.2px solid #ffc10044;
    margin-bottom: 15px;
    font-size: 1.04em;
    background: #232323;
    color: #fffbe6;
    box-shadow: 0 2px 10px #0001;
    outline: none;
    transition: border .14s;
}
.volunteer-form input:focus,
.volunteer-form textarea:focus {
    border: 1.2px solid #ffc100;
}
.volunteer-form button {
    width: 100%;
    background: #ffc100;
    color: #181818;
    font-weight: 700;
    font-size: 1.09em;
    padding: 12px 0 10px 0;
    border-radius: 9px;
    border: none;
    box-shadow: 0 2px 16px #0001;
    transition: background .16s, color .16s;
    cursor: pointer;
}
.volunteer-form button:hover {
    background: #ffe496;
    color: #232323;
}
.volunteer-form .msg-success {
    background: #212c13d0;
    color: #c9ff67;
    border-left: 7px solid #85db31;
    padding: 14px 14px 12px 14px;
    margin-bottom: 15px;
    border-radius: 9px;
    font-weight: 600;
    text-align: center;
}
.volunteer-form .msg-error {
    background: #33201a;
    color: #ffc100;
    border-left: 7px solid #ff6565;
    padding: 14px 14px 12px 14px;
    margin-bottom: 15px;
    border-radius: 9px;
    font-weight: 600;
    text-align: center;
}
</style>
<div class="volunteer-container">
    <h2>Become a Volunteer</h2>
    <div class="intro">
        Volunteers are the heart of <b>Paws &amp; Found</b>!<br>
        By joining us, you help rescue, care for, and find loving homes for animals in need.<br>
        No experience needed—just your love and passion for pets!
    </div>
    <div class="volunteer-form">
        <h3>Volunteer Application</h3>
        <?php if ($success): ?>
            <div class="msg-success"><?php echo $success; ?></div>
        <?php elseif ($error): ?>
            <div class="msg-error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="phone" placeholder="Phone (optional)">
            <textarea name="message" rows="3" placeholder="Why do you want to volunteer?" required></textarea>
            <button type="submit">Apply Now</button>
        </form>
    </div>
</div>
<?php include('includes/footer.php'); ?>
