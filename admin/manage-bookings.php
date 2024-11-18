<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
include '../config/database.php';
include '../templates/header.php';
include '../templates/admin-navbar.php';

$query = "SELECT * FROM tblbooking";
$result = $conn->query($query);
?>

<div class="container">
    <h1>Manage Bookings</h1>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>User Email</th>
                <th>Package ID</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['BookingId']; ?></td>
                    <td><?php echo $row['UserEmail']; ?></td>
                    <td><?php echo $row['PackageId']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                    <td>
                        <a href="confirm-booking.php?id=<?php echo $row['BookingId']; ?>">Confirm</a>
                        <a href="cancel-booking.php?id=<?php echo $row['BookingId']; ?>">Cancel</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../templates/footer.php'; ?>
