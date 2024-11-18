<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
include '../config/database.php';
include '../templates/header.php';
include '../templates/admin-navbar.php';
?>

<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?php echo $_SESSION['admin_username']; ?>!</p>
    <div class="dashboard-links">
        <a href="manage-packages.php">Manage Packages</a>
        <a href="manage-bookings.php">Manage Bookings</a>
        <a href="manage-issues.php">Manage Issues</a>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
