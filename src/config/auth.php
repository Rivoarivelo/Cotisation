<?php
// session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php?controller=auth&action=login");
    exit;
}