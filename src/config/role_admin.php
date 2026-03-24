<?php
require_once __DIR__ . '/auth.php';

if ($_SESSION['user']['role'] !== 'ADMIN') {
    die("⛔ Accès réservé à l'administrateur");
}
