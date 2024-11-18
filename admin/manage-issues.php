<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
include '../config/database.php';
include '../templates/header.php';
include '../templates/admin-navbar.php';

$query = "SELECT * FROM tblissues";
$result = $conn->query($query);
?>

<div class="container">
    <h1>Manage Issues</h1>
    <table>
        <thead>
            <tr>
                <th>Issue ID</th>
                <th>User Email</th>
                <th>Description</th>
                <th>Admin Remark</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['UserEmail']; ?></td>
                    <td><?php echo $row['Description']; ?></td>
                    <td><?php echo $row['AdminRemark']; ?></td>
                    <td>
                        <a href="respond-issue.php?id=<?php echo $row['id']; ?>">Respond</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../templates/footer.php'; ?>
