<?php
require_once __DIR__ . '/auth.php';

if (!in_array($_SESSION['user']['role'], ['ADMIN', 'COMPTABLE', 'BUREAU'])) {
    die("Accès interdit");
}