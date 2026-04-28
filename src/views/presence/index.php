<div class="container mt-4 ">
    <div class="mb-3 text-end">
        <a href="index.php?controller=presence&action=historique" class="btn btn-dark">
            📂 Historique
        </a>
    </div>
    <div class="card d-flex flex-column gap-5 p-3">
        <div class="card shadow-lg p-3">
            <h3 class="card-title text-center  fw-bold">Fiche de présence</h3>

            <!-- FORM -->
            <div class="card p-3 mb-3">
                <input type="text" id="titre" class="form-control mb-2" placeholder="Motif (ex: Réunion)">
                <input type="date" id="date_event" class="form-control">
            </div>
        </div>
        <!-- Font Bold -->

        <div>
            <h3 class="card-title text-center ">Demandes de présence</h3>

            <table class="table table-bordered border-1 border-darken">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Action</th>
                        <th>Date</th>
                        <th>Heure</th>
                    </tr>
                </thead>

                <tbody id="listeTemp"></tbody>
            </table>

            <button onclick="validerPresenceFinal()" class="btn btn-primary w-100 mt-3">
                Valider présence
            </button>
        </div>

    </div>
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


// charger demandes en attente
function chargerDemandes() {

    fetch("index.php?controller=presence&action=getTemp")
        .then(res => res.json())
        .then(data => {

            let html = '';

            data.forEach(m => {

                html += `
            <tr>
                <td>${m.nom}</td>
                <td>${m.prenom}</td>
                <td>
                    <button onclick="valider(${m.id})" class="btn btn-success btn-sm">✔</button>
                    <button onclick="rejeter(${m.id})" class="btn btn-danger btn-sm">✖</button>
                </td>
                <td>${m.date_event}</td>
                <td>${m.heure_scan}</td>
                
            </tr>`;
            });

            document.getElementById('listeTemp').innerHTML = html;
        });
}

// auto refresh (temps réel)
setInterval(chargerDemandes, 2000);

// valider demande
function valider(id) {

    fetch("index.php?controller=presence&action=validerTemp", {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}`
        })
        .then(() => chargerDemandes());
}

function rejeter(id) {

    fetch("index.php?controller=presence&action=rejeterTemp", {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}`
        })
        .then(() => chargerDemandes());
}

function validerPresenceFinal() {

    let titre = document.getElementById('titre').value;
    let date_event = document.getElementById('date_event').value;

    if (!titre || !date_event) {
        alert("Remplir le motif et la date");
        return;
    }

    fetch("index.php?controller=presence&action=validerAll", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                titre: titre,
                date_event: date_event
            })
        })
        .then(res => res.json())
        .then(res => {
            window.location.href = res.redirect;
        });
}
</script>