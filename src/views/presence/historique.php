<div class="container mt-4">
    <div class="card p-3 ">

        <h3 class="mb-3">Historique des présences</h3>

        <!-- 🔍 FILTRE -->
        <form method="GET" class="row mb-3">
            <input type="hidden" name="controller" value="presence">
            <input type="hidden" name="action" value="historique">

            <div class="col-md-4">
                <input type="date" name="date" class="form-control" value="<?= $_GET['date'] ?? '' ?>">
            </div>

            <div class="col-md-4">
                <input type="text" name="titre" class="form-control" placeholder="Motif"
                    value="<?= $_GET['titre'] ?? '' ?>">
            </div>

            <div class="col-md-4">
                <button class="btn btn-primary w-100">Filtrer</button>
            </div>
        </form>

        <!-- 📋 TABLE -->
        <table class="table table-bordered table-striped">

            <thead class="table-dark">
                <tr>
                    <th>CIN</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Motif</th>
                    <th>Date événement</th>
                    <th>Date présence</th>
                    <th>Heure</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($data as $m): ?>
                <tr>
                    <td><?= $m['cin'] ?></td>
                    <td><?= $m['nom'] ?></td>
                    <td><?= $m['prenom'] ?></td>
                    <td><?= $m['titre'] ?></td>
                    <td><?= $m['date_event'] ?></td>
                    <td><?= $m['date_presence'] ?></td>
                    <td><?= $m['heure_presence'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>