<?php
session_start();
if (isset($_SESSION['user'])) {
    // Hapus session
    session_unset();
    session_destroy();
}

header("Location: index.php");
exit();
?>