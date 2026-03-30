<div class="container mt-4">

    <h3>Fiche de présence</h3>

    <!-- FORM -->
    <div class="card p-3 mb-3">
        <input type="text" id="titre" class="form-control mb-2" placeholder="Motif (ex: Réunion)">
        <input type="date" id="date_event" class="form-control">
    </div>

    <!-- TABLE -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>CIN</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date</th>
                <th>Heure</th>
            </tr>
        </thead>

        <tbody id="listePresence"></tbody>
    </table>

    <button onclick="validerPresence()" class="btn btn-success w-100">
        Valider présence
    </button>

</div>

<script>
    let liste = [];

    // ajouter membre
    function ajouterMembre(data) {

        if (liste.find(m => m.CIN === data.CIN)) return;

        // date/heure local
        let now = new Date();
        let date = now.toLocaleDateString();
        let heure = now.toLocaleTimeString();

        data.date = date;
        data.heure = heure;

        liste.push(data);

        let row = `
    <tr>
        <td>${data.CIN}</td>
        <td>${data.nom}</td>
        <td>${data.prenom}</td>
        <td>${date}</td>
        <td>${heure}</td>
    </tr>`;

        document.getElementById('listePresence').innerHTML += row;
    }

    // scan QR
    function scanQR(cin) {

        fetch(`index.php?controller=presence&action=scan&cin=${cin}`)
            .then(res => res.text())
            .then(text => {

                try {
                    let data = JSON.parse(text);

                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    ajouterMembre(data);

                } catch (e) {
                    console.error("Erreur JSON :", text);
                }

            })
            .catch(err => {
                console.error("Erreur fetch :", err);
            });
    }

    // valider présence
    function validerPresence() {

        let titre = document.getElementById('titre').value;
        let date_event = document.getElementById('date_event').value;

        if (!titre || !date_event) {
            alert("Remplir le motif et la date");
            return;
        }

        fetch("index.php?controller=presence&action=valider", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                titre: titre,
                date_event: date_event,
                liste: liste
            })
        })
            .then(res => res.json())
            .then(res => {
                window.location.href = res.redirect;
            });
    }
</script>