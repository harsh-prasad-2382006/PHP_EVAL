
<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = $conn->prepare("delete from users where id=?");
    $sql->bind_param("i", $id);
    $sql->execute();
}

header('Location: register.php');
exit;
?>
