<body>
    <nav class="navbar navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="index.php">Cotisation</a>
    </nav>
    <div class="container mt-4">
        <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}