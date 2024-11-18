<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include '../config/database.php';

if (isset($_GET['id'])) {
    $packageId = $_GET['id'];

    // Fetch the package details from the database
    $query = "SELECT * FROM tbltourpackages WHERE PackageId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $packageId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $package = $result->fetch_assoc();
    } else {
        header('Location: manage-packages.php');
        exit();
    }
}

if (isset($_POST['update'])) {
    // Get updated data from the form
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $details = $_POST['details'];

    // Update the package details in the database
    $query = "UPDATE tbltourpackages SET PackageName = ?, PackageType = ?, PackagePrice = ?, PackageDetails = ? WHERE PackageId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssisi", $name, $type, $price, $details, $packageId);
    $stmt->execute();

    // Redirect to the package management page
    header('Location: manage-packages.php');
    exit();
}

include '../templates/header.php';
include '../templates/admin-navbar.php';
?>

<div class="container">
    <h1>Edit Package</h1>
    <form method="POST" action="">
        <input type="text" name="name" value="<?php echo htmlspecialchars($package['PackageName']); ?>" placeholder="Package Name" required>
        <input type="text" name="type" value="<?php echo htmlspecialchars($package['PackageType']); ?>" placeholder="Package Type" required>
        <input type="number" name="price" value="<?php echo htmlspecialchars($package['PackagePrice']); ?>" placeholder="Price" required>
        <textarea name="details" placeholder="Details" required><?php echo htmlspecialchars($package['PackageDetails']); ?></textarea>
        <button type="submit" name="update">Update Package</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
