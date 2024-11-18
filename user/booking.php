<?php
session_start();
include '../config/database.php';

if (isset($_GET['package_id'])) {
    $package_id = $_GET['package_id'];
    $query = "SELECT * FROM tbltourpackages WHERE PackageId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $package = $result->fetch_assoc();
    } else {
        echo "Package not found!";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $user_email = $_SESSION['user_email'];

    $query = "INSERT INTO tblbookings (UserEmail, PackageId, FromDate, ToDate) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siss", $user_email, $package_id, $from_date, $to_date);

    if ($stmt->execute()) {
        header("Location: booking-confirmation.php");
    } else {
        $error_message = "Error during booking!";
    }
}
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <h2>Booking for <?php echo htmlspecialchars($package['PackageName']); ?></h2>
    <?php if (!empty($error_message)): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    
    <form method="POST" action="booking.php?package_id=<?php echo $package['PackageId']; ?>">
        <label for="from_date">From Date:</label>
        <input type="date" name="from_date" required>
        
        <label for="to_date">To Date:</label>
        <input type="date" name="to_date" required>
        
        <button type="submit">Book Package</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
