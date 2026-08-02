<?php
session_start();
require_once __DIR__ . '/includes/db_connect.php'; // adjust path if needed

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $sql = "SELECT id, password, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $hash, $role);
            $stmt->fetch();
            if ($password === $hash) {  // compare plain text!
                $_SESSION['user_id'] = $id;
                $_SESSION['user_role'] = $role;
                if ($role === 'admin') {
                    header("Location: admin/dashboard.php");
                    exit;
                } else {
                    header("Location: index.php");
                    exit;
                }
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    }
    $stmt->close();
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<style>
body {
    background: #181818 url('/paws_and_found2/images/bg.jpg') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    position: relative;
}
.login-main-flex {
    display: flex;
    justify-content: center;
    align-items: stretch; /* <-- Ensures both divs are equal height */
    min-height: 560px;
    margin-top: 50px;
    gap: 0;
}
.login-side-info, .login-form-box {
    width: 480px;
    min-height: 540px;
    background: #232323dd;
    display: flex;
    flex-direction: column;
    justify-content: center;
    box-sizing: border-box;
}
.login-side-info {
    border-radius: 24px 0 0 24px;
    text-align: center;
    padding: 50px 38px 50px 38px;
}
.login-side-info h2 {
    margin-bottom: 20px;
    color: #ffcb05;
    font-size: 2.6em;
    font-weight: 900;
}
.login-side-info .pet-gallery {
    display: flex;
    justify-content: center;
    gap: 18px;
    margin-bottom: 24px;
}
.login-side-info .pet-gallery img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 16px;
    box-shadow: 0 1px 10px #0004;
}
.login-side-info p {
    font-size: 1.22em;
    color: #fff;
    margin-bottom: 9px;
    text-align: left;
    line-height: 1.54;
}
.login-form-box {
    border-radius: 0 24px 24px 0;
    padding: 50px 38px 50px 38px;
    box-shadow: 0 6px 40px #0006;
    align-items: stretch;
}
.login-form-box h2 {
    color: #ffc100;
    text-align: center;
    margin-bottom: 28px;
    font-size: 2em;
    font-weight: 700;
    letter-spacing: 1px;
}
.login-form-box label {
    color: #fffbe6;
    font-size: 1.08em;
    margin-bottom: 5px;
    display: block;
}
.login-form-box input[type="text"],
.login-form-box input[type="password"] {
    width: 100%;
    padding: 13px 10px;
    border-radius: 8px;
    border: 1.2px solid #666;
    margin-bottom: 22px;
    font-size: 1.08em;
    background: #141414;
    color: #fff;
    box-shadow: 0 2px 10px #0001;
    outline: none;
    transition: border .15s;
    display: block;
}
.login-form-box input[type="text"]:focus,
.login-form-box input[type="password"]:focus {
    border: 1.2px solid #ffc100;
}
.login-form-box .showpass-wrap {
    margin-bottom: 26px;
    margin-top: -11px;
    display: flex;
    align-items: center;
}
.login-form-box .showpass-wrap label {
    color: #ffe496;
    font-size: 1em;
    margin-left: 8px;
    cursor: pointer;
    margin-bottom: 0;
}
.login-form-box button {
    width: 100%;
    background: #ffc100;
    color: #181818;
    font-weight: 700;
    font-size: 1.18em;
    padding: 13px 0 11px 0;
    border-radius: 10px;
    border: none;
    box-shadow: 0 2px 16px #0001;
    transition: background .16s, color .16s;
    cursor: pointer;
}
.login-form-box button:hover {
    background: #ffe496;
    color: #232323;
}
.login-form-box .login-error {
    color: #ff6565;
    background: #fff3e7;
    border-radius: 7px;
    padding: 10px 12px 8px 12px;
    margin-bottom: 17px;
    text-align: center;
    font-weight: 500;
    letter-spacing: 0.2px;
}
@media (max-width: 1100px) {
    .login-main-flex { flex-direction: column; }
    .login-side-info, .login-form-box {
        width: 98vw !important;
        border-radius: 24px 24px 0 0 !important;
        min-height: 340px;
    }
    .login-form-box { border-radius: 0 0 24px 24px !important; }
}
</style>

<div class="login-main-flex">
    <!-- LEFT SIDE: Pet images and website info -->
    <div class="login-side-info">
        <h2>Paws & Found</h2>
        <div class="pet-gallery">
            <img src="images/pet1.jpg" alt="Pet 1">
            <img src="images/pet2.jpg" alt="Pet 2">
            <img src="images/pet3.jpg" alt="Pet 3">
        </div>
        <p>
            <strong>Paws & Found</strong> is a caring online community dedicated to helping lost pets find their way back home. Whether you’ve lost a furry friend or found someone’s missing companion, our platform makes it easy to share information, post updates, and reach out to the local community.<br><br>
            Easily post details about lost or found pets, upload their photos, and get in touch with other pet lovers nearby. You can browse recent reports, see adorable pets looking for help, and even offer support by commenting or spreading the word.<br><br>
            With a simple sign up and secure login, you get full access to create listings, get instant updates, and connect with pet owners or finders. Every member plays a part in reuniting families with their beloved animals.<br><br>
            <b>Log in now to join the mission—because every pet deserves to come home!</b>
        </p>
    </div>

    <!-- RIGHT SIDE: Login form -->
    <div class="login-form-box">
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="login-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="login.php" autocomplete="off">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input id="passInput" type="password" name="password" required>

            <div class="showpass-wrap">
                <input type="checkbox" id="showPass" onclick="showPassword()" style="vertical-align:middle;">
                <label for="showPass">Show Password</label>
            </div>
            <button type="submit">Login</button>
        </form>
        <div style="margin-top:16px;text-align:center;">
            New? <a href="register.php" style="color:#ffc100;">Sign Up</a>
        </div>
    </div>
</div>
<script>
function showPassword() {
    var passInput = document.getElementById('passInput');
    passInput.type = (passInput.type === "password") ? "text" : "password";
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
