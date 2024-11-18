<?php
session_start();
include '../config/database.php';

// Fetch available tour packages
$query = "SELECT * FROM tbltourpackages ORDER BY CreationDate DESC LIMIT 6";
$result = $conn->query($query);

// Check if the user is logged in
$user_logged_in = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
?>

<?php include '../templates/header.php'; ?>

<!-- Navbar (user) -->
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <div class="welcome-message">
        <h2>Welcome to Our Tour and Travel Agency</h2>
        <p>Explore the best travel packages for your next vacation!</p>
    </div>

    <h3>Popular Tour Packages</h3>
    
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
