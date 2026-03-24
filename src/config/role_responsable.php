<?php
require_once __DIR__ . '/auth.php';

if (!in_array($_SESSION['user']['role'], ['ADMIN', 'RESPONSABLE'])) {
    die("Accès interdit");
}