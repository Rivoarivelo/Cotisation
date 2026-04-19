<div class="container mt-4">
    <div class="card p-3">
        <h3 class="text-center">Fiche de présence</h3>

        <div class="card p-3 mb-3">
            <p><strong>Motif :</strong> <?= $data['titre'] ?></p>
            <p><strong>Date :</strong> <?= $data['date_event'] ?></p>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>CIN</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date Scan</th>
                    <th>Heure </th>
                </tr>
            </thead>

            <tbody class="table-success">
                <?php foreach ($data['liste'] as $m): ?>
                    <tr>
                        <td><?= $m['cin'] ?></td>
                        <td><?= $m['nom'] ?></td>
                        <td><?= $m['prenom'] ?></td>
                        <td><?= $m['date_event'] ?></td>
                        <td><?= $m['heure_scan'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="index.php?controller=presence&action=exportPDF" class="btn btn-primary w-100">
            Exporter PDF
        </a>
    </div>
</div>