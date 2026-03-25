<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">

    <h3 class="text-center text-success mb-4">Liste des présences</h3>

    <!-- Message scan -->
    <?php if (!empty($message)): ?>
        <div class="alert alert-info text-center">
            <?= $message ?>
        </div>
    <?php endif; ?>

 
    <!-- Tableau des présences -->
    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>CIN</th>
                        <th>Num Carte</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date</th>
                        <th>Heure</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($presences as $p): ?>
                        <tr>
                            <td><?= $p['cin'] ?></td>
                            <td><?= $p['num_carte'] ?></td>
                            <td><?= $p['nom'] ?></td>
                            <td><?= $p['prenom'] ?></td>
                            <td><?= $p['date_presence'] ?></td>
                            <td><?= $p['heure_presence'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>