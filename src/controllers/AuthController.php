<?php
require_once __DIR__ . '/../models/ResponsableModel.php';

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];
            $password = $_POST['motsdepass'];

            $responsable = ResponsableModel::findByEmail($email);

            if ($responsable && password_verify($password, $responsable['motsdepass'])) {

                session_start();
                $_SESSION['user'] = [
                    'id'    => $responsable['idresponsable'],
                    'nom'   => $responsable['nomresponsable'],
                    'prenom'=> $responsable['prenomresponsable'],
                    'email' => $responsable['mailresponsable'],
                    'role'  => $responsable['role']
                ];

                header("Location: index.php");
                exit;
            }

            $error = "Email ou mot de passe incorrect";
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function logout()
    {
    session_start();
    session_unset();
    session_destroy();

    header("Location: index.php?controller=auth&action=login");
    exit;
    }

    public function changePassword()
{
    require_once __DIR__ . '/../config/auth.php';
    require_once __DIR__ . '/../models/AuthModel.php';

    $error = '';
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $ancien = $_POST['ancien_motdepasse'];
        $nouveau = $_POST['nouveau_motdepasse'];

        // utilisateur connecté
        $email = $_SESSION['user']['email'];

        $user = AuthModel::findByEmail($email);

        if (!$user || !password_verify($ancien, $user['motsdepass'])) {
            $error = "Ancien mot de passe incorrect";
        } else {
            $hash = password_hash($nouveau, PASSWORD_DEFAULT);
            AuthModel::updatePassword($user['idresponsable'], $hash);
            $success = "Mot de passe modifié avec succès";
        }
    }

    // require __DIR__ . '/../views/auth/change_password.php';
    $view = __DIR__ . '/../views/auth/change_password.php';
    require __DIR__ . '/../views/layout/dashboard.php';
}

    public function visitor()
    {
        $_SESSION['user'] = [
            'role' => 'visiteur',
            'nom'  => 'Visiteur'
        ];

        header("Location: " . BASE_URL . "?controller=dashboard");
        exit;
    }


}