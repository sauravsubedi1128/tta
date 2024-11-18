<?php
session_start();
include '../config/database.php';

$user_email = $_SESSION['user_email'];
$query = "SELECT * FROM tblusers WHERE EmailId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();

$query = "SELECT * FROM tblbookings WHERE UserEmail = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$booking_result = $stmt->get_result();
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <h2>User Profile</h2>

    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['FullName']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['EmailId']); ?></p>
    <p><strong>Mobile:</strong> <?php echo htmlspecialchars($user['MobileNumber']); ?></p>

    <h3>Your Bookings</h3>
    <div class="bookings">
        <?php if ($booking_result->num_rows > 0): ?>
            <?php while ($booking = $booking_result->fetch_assoc()): ?>
                <div class="booking-card">
                    <p><strong>Package:</strong> <?php echo htmlspecialchars($booking['PackageId']); ?></p>
                    <p><strong>From Date:</strong> <?php echo htmlspecialchars($booking['FromDate']); ?></p>
                    <p><strong>To Date:</strong> <?php echo htmlspecialchars($booking['ToDate']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No bookings found.</p>
        <?php endif; ?>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
