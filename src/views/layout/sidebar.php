<ul class="nav flex-column">

    <li class="nav-item">
        <a class="nav-link" href="index.php">Dashboard</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.php?controller=membre">Membres</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.php?controller=paiement">Paiements</a>
    </li>

    <!-- 🔐 UNIQUEMENT POUR ADMIN -->
    <?php if ($_SESSION['user']['role'] === 'ADMIN'): ?>
        <li class="nav-item">
            <a class="nav-link text-warning"
               href="index.php?controller=responsable">
               Responsables
            </a>
        </li>
    <?php endif; ?>

</ul>
