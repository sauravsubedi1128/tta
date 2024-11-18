<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile_number = $_POST['mobile_number'];

    $query = "INSERT INTO tblusers (FullName, EmailId, Password, MobileNumber) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $full_name, $email, $password, $mobile_number);

    if ($stmt->execute()) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_email'] = $email;
        header("Location: index.php");
    } else {
        $error_message = "Error during registration!";
    }
}
?>

<?php include '../templates/header.php'; ?>

<div class="signup-form">
    <h2>User Sign Up</h2>
    <?php if (!empty($error_message)): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST" action="signup.php">
        <input type="text" name="full_name" placeholder="Enter your full name" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <input type="text" name="mobile_number" placeholder="Enter your mobile number" required>
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

<?php include '../templates/footer.php'; ?>
