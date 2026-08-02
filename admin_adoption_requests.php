<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/includes/db_connect.php';
?>
<?php
$sql = "SELECT ar.id, u.username, p.name AS pet_name, ar.request_date, ar.status
        FROM adoption_requests ar
        JOIN users u ON ar.user_id = u.id
        JOIN pets p ON ar.pet_id = p.id
        ORDER BY ar.request_date DESC";

$result = $conn->query($sql);
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<h2 style="text-align:center; margin-top: 30px;">Adoption Requests</h2>

<table style="width:90%; margin: 20px auto; border-collapse: collapse; color:#fff; background: #232323; border-radius:12px; box-shadow:0 4px 20px #000;">
  <thead>
    <tr style="border-bottom: 2px solid #ffc100;">
      <th style="padding:12px;">Request ID</th>
      <th style="padding:12px;">Username</th>
      <th style="padding:12px;">Pet Name</th>
      <th style="padding:12px;">Date Requested</th>
      <th style="padding:12px;">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr style="border-bottom: 1px solid #444;">
          <td style="padding:10px; text-align:center;"><?php echo htmlspecialchars($row['id']); ?></td>
          <td style="padding:10px;"><?php echo htmlspecialchars($row['username']); ?></td>
          <td style="padding:10px;"><?php echo htmlspecialchars($row['pet_name']); ?></td>
          <td style="padding:10px;"><?php echo htmlspecialchars($row['request_date']); ?></td>
          <td style="padding:10px;"><?php echo htmlspecialchars(ucfirst($row['status'])); ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr>
        <td colspan="5" style="padding: 15px; text-align:center;">No adoption requests found.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

<?php include __DIR__ . '/includes/footer.php'; ?>
