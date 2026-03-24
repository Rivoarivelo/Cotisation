<?php
require_once __DIR__ . '/../config/role_admin.php';
require_once __DIR__ . '/../models/ResponsableModel.php';

class ResponsableController {

    public function index() {
        $responsables = ResponsableModel::getAll();
        // echo "Gestion des responsables (ADMIN seulement)";
        // require __DIR__ . '/../views/responsables/index.php';
         $view = __DIR__ . '/../views/responsables/index.php';
        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function add() {
        if ($_POST) {
            ResponsableModel::insert([
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_DEFAULT),
                $_POST['telephone'],
                $_POST['role']
            ]);

            header("Location: index.php?controller=responsable");
            exit;
        }

        // require __DIR__ . '/../views/responsables/add.php';
         $view = __DIR__ . '/../views/responsables/add.php';
        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function edit() {
        $id = $_GET['id'];
        $responsable = ResponsableModel::find($id);

        if ($_POST) {
            ResponsableModel::update($id, [
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['telephone'],
                $_POST['role']
            ]);

            header("Location: index.php?controller=responsable");
            exit;
        }

        // require __DIR__ . '/../views/responsables/edit.php';
         $view = __DIR__ . '/../views/responsables/edit.php';
        require __DIR__ . '/../views/layout/dashboard.php';
    }

    public function delete() {
        ResponsableModel::delete($_GET['id']);
        header("Location: index.php?controller=responsable");
        exit;
    }
}