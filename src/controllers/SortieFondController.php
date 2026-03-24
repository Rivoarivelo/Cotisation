    <?php
    require_once __DIR__ . "/../config/Database.php";
    require_once __DIR__ . "/../models/SortieFondModele.php";

    if ($_SESSION['user']['role'] === 'visitor') {
    die("Accès refusé : Lecture seule");
}

    class SortieFondController {

        public function index() {

            $conn = Database::compta();
            $model = new SortieFondModele($conn);

            // Traitement du formulaire
            if(isset($_POST['ajouter'])){
                $model->insert(
                    $_POST['motif'],
                    $_POST['datesortie'],
                    $_POST['montantsortie'],
                    $_POST['responsable']
                );

                header("Location: index.php?controller=sortiefond");
                exit;
            }
            // Données pour la vue
            $sorties = $model->getAll();
            $responsables = $conn->query("SELECT * FROM responsable")->fetchAll(PDO::FETCH_ASSOC);

            // Totaux financiers
            $totalSortie = $model->totalSortie();
            $totalEntree = $model->totalEntree();

            $soldeRestant = $totalEntree - $totalSortie;

            // require __DIR__ . "/../views/sortiefond/index.php";
            $view = __DIR__ . '/../views/sortiefond/index.php';
            require __DIR__ . '/../views/layout/dashboard.php';
        }
    }