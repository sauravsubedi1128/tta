<?php
function redirect($url) {
    header("Location: $url");
    exit();
}

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

function isLoggedIn($type = 'user') {
    session_start();
    if (!isset($_SESSION[$type . '_logged_in'])) {
        redirect(BASE_URL . $type . '/login.php');
    }
}
?>
