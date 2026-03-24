<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Cotisation</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark px-3">
  <a class="navbar-brand" href="index.php">Cotisation</a>
</nav>
<div class="container mt-4">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}