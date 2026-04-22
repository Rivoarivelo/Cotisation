<div class="container mt-4">
    <div class="card shadow-lg p-3">
        <h3 class="text-center">POINTAGE</h3>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>CIN</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date</th>
                    <th>Heure</th>
                </tr>
            </thead>

            <tbody id="listePointage"></tbody>

        </table>
    </div>

</div>

<script>
function chargerPointage() {

    fetch("index.php?controller=pointage&action=get")
        .then(res => res.json())
        .then(data => {

            let html = '';

            data.forEach(m => {

                html += `
            <tr>
                <td>${m.cin}</td>
                <td>${m.nom}</td>
                <td>${m.prenom}</td>
                <td>${m.date_pointage}</td>
                <td>${m.heure_pointage}</td>
            </tr>`;
            });

            document.getElementById('listePointage').innerHTML = html;
        });
}

// 🔥 refresh auto
setInterval(chargerPointage, 2000);
</script>