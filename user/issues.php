<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $issue = $_POST['issue'];
    $user_email = $_SESSION['user_email'];

    $query = "INSERT INTO tblissues (UserEmail, IssueDescription) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $user_email, $issue);

    if ($stmt->execute()) {
        $success_message = "Your issue has been submitted successfully!";
    } else {
        $error_message = "Error submitting your issue.";
    }
}
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <h2>Submit an Issue</h2>
    
    <?php if (!empty($success_message)): ?>
        <p class="success"><?php echo $success_message; ?></p>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="POST" action="issues.php">
        <textarea name="issue" placeholder="Describe your issue" required></textarea>
        <button type="submit">Submit Issue</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
