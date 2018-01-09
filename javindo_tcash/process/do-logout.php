<?php
    require_once '../config.php';
    $session->destroy();
    header('location:../index.php');
?>