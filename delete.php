<?php
    session_start();
    require('config.php');
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id=".$_GET['id']);
    $stmt->execute();
    $_SESSION['delete_post'] = true;
    header('location:index.php');
?>