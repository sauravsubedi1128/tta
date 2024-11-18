<?php
session_start();
include '../config/database.php';

if (isset($_GET['id'])) {
    $package_id = $_GET['id'];
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
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <div class="package-details">
        <img src="../assets/images/<?php echo htmlspecialchars($package['PackageImage']); ?>" alt="<?php echo htmlspecialchars($package['PackageName']); ?>">
        <h2><?php echo htmlspecialchars($package['PackageName']); ?></h2>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($package['PackageLocation']); ?></p>
        <p><strong>Price:</strong> $<?php echo htmlspecialchars($package['PackagePrice']); ?></p>
        <p><strong>Details:</strong> <?php echo nl2br(htmlspecialchars($package['PackageDetails'])); ?></p>
        <a href="booking.php?package_id=<?php echo $package['PackageId']; ?>" class="btn">Book This Package</a>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
