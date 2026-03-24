<?php
function checkWriteAccess()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] === 'visitor') {
        header("Location: " . BASE_URL . "?controller=dashboard");
        exit;
    }
}