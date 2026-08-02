<?php
session_start();
require_once __DIR__ . '/includes/db_connect.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (!$username || !$password || !$confirm) {
        $error = "Please fill in all fields.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        // Check if username exists
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already taken.";
        } else {
            // Insert new user (role = user)
            $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, 'user')";
            $stmt2 = $conn->prepare($sql);
            $stmt2->bind_param("ss", $username, $password);
            if ($stmt2->execute()) {
                $success = "Registration successful! <a href='login.php'>Login here</a>.";
            } else {
                $error = "Registration failed. Try again.";
            }
            $stmt2->close();
        }
        $stmt->close();
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<style>
.register-form-box {
    max-width: 400px;
    margin: 70px auto 50px auto;
    padding: 32px 30px 24px 30px;
    background: #232323ee;
    border-radius: 18px;
    box-shadow: 0 6px 40px #0006;
}
.register-form-box h2 {
    color: #ffc100;
    text-align: center;
    margin-bottom: 28px;
    font-size: 2em;
    font-weight: 700;
    letter-spacing: 1px;
}
.register-form-box label {
    color: #fffbe6;
    font-size: 1.08em;
    margin-bottom: 5px;
    display: block;
}
.register-form-box input[type="text"],
.register-form-box input[type="password"] {
    width: 100%;
    padding: 11px 8px;
    border-radius: 8px;
    border: 1.2px solid #666;
    margin-bottom: 17px;
    font-size: 1em;
    background: #141414;
    color: #fff;
    box-shadow: 0 2px 10px #0001;
    outline: none;
    transition: border .15s;
    display: block;
}
.register-form-box button {
    width: 100%;
    background: #ffc100;
    color: #181818;
    font-weight: 700;
    font-size: 1.14em;
    padding: 12px 0 10px 0;
    border-radius: 10px;
    border: none;
    box-shadow: 0 2px 16px #0001;
    transition: background .16s, color .16s;
    cursor: pointer;
}
.register-form-box button:hover {
    background: #ffe496;
    color: #232323;
}
.register-form-box .register-error {
    color: #ff6565;
    background: #fff3e7;
    border-radius: 7px;
    padding: 10px 12px 8px 12px;
    margin-bottom: 17px;
    text-align: center;
    font-weight: 500;
    letter-spacing: 0.2px;
}
.register-form-box .register-success {
    color: #169926;
    background: #edffef;
    border-radius: 7px;
    padding: 10px 12px 8px 12px;
    margin-bottom: 17px;
    text-align: center;
    font-weight: 500;
    letter-spacing: 0.2px;
}
</style>

<div class="register-form-box">
    <h2>User Sign Up</h2>
    <?php if ($error): ?>
        <div class="register-error"><?php echo $error; ?></div>
    <?php elseif ($success): ?>
        <div class="register-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form method="post" action="register.php" autocomplete="off">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" id="passInput" name="password" required>
        <label>Confirm Password:</label>
        <input type="password" id="confirmInput" name="confirm" required>
        <div class="showpass-wrap">
            <input type="checkbox" id="showPass" onclick="showPassword()" style="vertical-align:middle;">
            <label for="showPass">Show Password</label>
        </div>
        <button type="submit">Sign Up</button>
    </form>
    <div style="margin-top:16px;text-align:center;">
        Already have an account? <a href="login.php" style="color:#ffc100;">Login</a>
    </div>
</div>

<script>
function showPassword() {
    var passInput = document.getElementById('passInput');
    var confirmInput = document.getElementById('confirmInput');
    var show = document.getElementById('showPass').checked;
    passInput.type = show ? "text" : "password";
    confirmInput.type = show ? "text" : "password";
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
