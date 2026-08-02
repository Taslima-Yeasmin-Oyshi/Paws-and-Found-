<?php
session_start();
require_once __DIR__ . '/includes/db_connect.php';

// User must be logged in as user
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'user') {
    header('Location: login.php');
    exit;
}

// Get pet details (for sticky pet selection)
$pet_id = $_GET['pet_id'] ?? '';
$pet_name = '';
if ($pet_id) {
    $stmt = $conn->prepare("SELECT name FROM pets WHERE id = ?");
    $stmt->bind_param("i", $pet_id);
    $stmt->execute();
    $stmt->bind_result($pet_name);
    $stmt->fetch();
    $stmt->close();
}

include('includes/header.php');
?>

<!-- Adoption Request Form Styling -->
<style>
.adoption-form-container {
    max-width: 600px;
    margin: 40px auto;
    background: #181818;
    padding: 30px 26px 22px 26px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    color: #fffbe6;
}
.adoption-form-container h2 {
    text-align: center;
    color: #ffc100;
    margin-bottom: 25px;
}
.adoption-form-container label {
    display: block;
    margin: 10px 0 5px;
    font-weight: 600;
    color: #ffc100;
}
.adoption-form-container input,
.adoption-form-container select,
.adoption-form-container textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ffc10066;
    border-radius: 8px;
    background: #232323;
    color: #fffbe6;
    font-size: 1em;
}
.adoption-form-container button {
    width: 100%;
    padding: 12px;
    background-color: #ffc100;
    border: none;
    color: #181818;
    font-size: 17px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease;
    margin-top: 8px;
}
.adoption-form-container button:hover {
    background-color: #ffe496;
    color: #232323;
}
.pet-selected {
    font-size: 1.1em;
    color: #fffbe6;
    margin-bottom: 18px;
    background: #232323cc;
    padding: 10px 12px;
    border-radius: 7px;
    border: 1px solid #ffc10044;
}
</style>

<div class="adoption-form-container">
    <h2>Adoption Request Form</h2>
    <form action="process_adoption.php" method="POST">
        <?php if ($pet_id && $pet_name): ?>
            <input type="hidden" name="pet_id" value="<?php echo htmlspecialchars($pet_id); ?>">
            <div class="pet-selected">
                <strong>Pet Selected:</strong> <?php echo htmlspecialchars($pet_name); ?>
            </div>
        <?php else: ?>
            <div class="pet-selected" style="color:#ff6565; background:#fff3e7;">
                No pet selected. Please go to
                <a href="available_pets.php" style="color:#ffc100;">Available Pets</a>
                and click <b>Adopt</b>.
            </div>
        <?php endif; ?>

        <label for="full_name">Full Name</label>
        <input type="text" name="full_name" id="full_name" required>

        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" required>

        <label for="phone">Phone Number</label>
        <input type="text" name="phone" id="phone" required>

        <label for="address">Address</label>
        <textarea name="address" id="address" rows="3" required></textarea>

        <label for="pet_type">Pet Type</label>
        <select name="pet_type" id="pet_type" required>
            <option value="">Select a pet type</option>
            <option value="Dog">Dog</option>
            <option value="Cat">Cat</option>
            <option value="Bird">Bird</option>
            <option value="Other">Other</option>
        </select>

        <label for="reason">Why do you want to adopt?</label>
        <textarea name="reason" id="reason" rows="4" required></textarea>

        <button type="submit">Submit Request</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
