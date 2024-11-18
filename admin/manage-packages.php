<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
include '../config/database.php';
include '../templates/header.php';
include '../templates/admin-navbar.php';

$query = "SELECT * FROM tbltourpackages";
$result = $conn->query($query);
?>

<div class="container">
    <h1>Manage Packages</h1>
    <a href="create-package.php" class="btn">Create New Package</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['PackageId']; ?></td>
                    <td><?php echo $row['PackageName']; ?></td>
                    <td><?php echo $row['PackageType']; ?></td>
                    <td><?php echo $row['PackagePrice']; ?></td>
                    <td>
                        <a href="edit-package.php?id=<?php echo $row['PackageId']; ?>">Edit</a>
                        <a href="delete-package.php?id=<?php echo $row['PackageId']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../templates/footer.php'; ?>
