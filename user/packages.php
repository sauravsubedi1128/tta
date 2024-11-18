<?php
session_start();
include '../config/database.php';

$query = "SELECT * FROM tbltourpackages ORDER BY PackageName";
$result = $conn->query($query);
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <h3>All Tour Packages</h3>

    <div class="tour-packages">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($package = $result->fetch_assoc()): ?>
                <div class="package-card">
                    <img src="../assets/images/<?php echo htmlspecialchars($package['PackageImage']); ?>" alt="<?php echo htmlspecialchars($package['PackageName']); ?>">
                    <h4><?php echo htmlspecialchars($package['PackageName']); ?></h4>
                    <p><?php echo htmlspecialchars($package['PackageLocation']); ?></p>
                    <p>Price: $<?php echo htmlspecialchars($package['PackagePrice']); ?></p>
                    <a href="package-details.php?id=<?php echo $package['PackageId']; ?>" class="btn">View Details</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No packages available at the moment.</p>
        <?php endif; ?>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
