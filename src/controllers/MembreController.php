<?php
require_once __DIR__ . '/../models/MembreModel.php';
require_once __DIR__ . '/../models/ResponsableModel.php';
require_once __DIR__ . '/../config/role_responsable.php';

class MembreController {

    public function index() {
        $membres = MembreModel::getAll();
        if (!empty($_GET['search'])) {
        $membres = MembreModel::search($_GET['search']);
    } else {
        $membres = MembreModel::getAll();
    }
        // require __DIR__ . '/../views/membres/index.php';
        $view = __DIR__ . '/../views/membres/index.php';
        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function add() {

        $membres = MembreModel::getAll();

        // $numcart = MembreModel::generateNumeroCarte();
            if ($_POST) {

            $photoName = null;

            if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK){

                $uploadDir = __DIR__ . '/../../public/uploads/';

                if(!is_dir($uploadDir)){
                    mkdir($uploadDir,0777,true);
                }

                $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $photoName = uniqid('membre_').'.'.$ext;

                move_uploaded_file(
                    $_FILES['photo']['tmp_name'],
                    $uploadDir.$photoName
                );
            }

            MembreModel::insert([
                $_POST['CIN'],
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['nom_entreprise'],
                $_POST['contact'],
                $_POST['email'],
                $_POST['date_naissance'],
                $_POST['genre'],
                $_POST['date_adhesion'],
                $_POST['profession'],     
                $_POST['lieutravail'],
                
                $_POST['date_embauche'],
                $_POST['adressmembre'], 
                $photoName
            ]);

            header("Location: index.php?controller=membre");
            exit;
        }
        // require __DIR__ . '/../views/membres/add.php';
        $view = __DIR__ . '/../views/membres/add.php';
        require __DIR__ . '/../views/layout/dashboard.php';

    }

    public function edit()
    {
    $cin = $_GET['cin'];
    $membre = MembreModel::getByCIN($cin);

    if ($_POST) {

         // 📷 photo existante par défaut
            $uploadDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // ---------------- PHOTO MEMBRE ----------------
        $photo = $membre['photo'];

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $photo = uniqid('membre_') . '.' . $ext;

            move_uploaded_file(
                $_FILES['photo']['tmp_name'],
                $uploadDir . $photo
            );
        }
        // ---------------- PHOTO CIN ----------------
        $photoCIN = $membre['photoCIN'];

        if (isset($_FILES['photoCIN']) && $_FILES['photoCIN']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['photoCIN']['name'], PATHINFO_EXTENSION);
            $photoCIN = uniqid('cin_') . '.' . $ext;

            move_uploaded_file(
                $_FILES['photoCIN']['tmp_name'],
                $uploadDir . $photoCIN
            );
        }
        MembreModel::update($cin, [
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['nom_entreprise'],
            $_POST['contact'],
            $_POST['email'],
            $_POST['profession'],
            $_POST['adressmembre'],
            $photo,
            $_POST['genre'],
            $_POST['date_adhesion'],
        ]);
        header("Location: index.php?controller=membre");
        exit;
    }


    // require __DIR__ . '/../views/membres/edit.php';
    $view = __DIR__ . '/../views/membres/edit.php';
    require __DIR__ . '/../views/layout/dashboard.php';
}

public function delete()
{
    $cin = $_GET['cin'];
    MembreModel::delete($cin);

    header("Location: index.php?controller=membre");
    exit;
}

}