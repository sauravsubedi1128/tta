<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
include '../config/database.php';

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $details = $_POST['details'];
    $query = "INSERT INTO tbltourpackages (PackageName, PackageType, PackagePrice, PackageDetails) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssis", $name, $type, $price, $details);
    $stmt->execute();
    header('Location: manage-packages.php');
}

include '../templates/header.php';
include '../templates/admin-navbar.php';
?>

<div class="container">
    <h1>Create Package</h1>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Package Name" required>
        <input type="text" name="type" placeholder="Package Type" required>
        <input type="number" name="price" placeholder="Price" required>
        <textarea name="details" placeholder="Details" required></textarea>
        <button type="submit" name="create">Create</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
