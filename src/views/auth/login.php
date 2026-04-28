<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | SArtM</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    :root {
        /* Couleurs extraites de votre image de dashboard */
        --dash-dark: #12192c;
        --dash-blue: #3b82f6;
        --dash-bg: #f4f7fe;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--dash-dark);
        /* Fond sombre comme votre barre latérale */
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }

    .login-container {
        width: 100%;
        max-width: 420px;
        padding: 15px;
    }

    .card {
        border: none;
        border-radius: 16px;
        background-color: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .card-header {
        background-color: transparent !important;
        border-bottom: none;
        padding-top: 40px;
        color: var(--dash-dark) !important;
    }

    .logo-box {
        background-color: #fff;
        padding: 10px;
        border-radius: 12px;
        display: inline-block;
        margin-bottom: 10px;
    }

    .logo {
        width: 80px;
        height: auto;
    }

    .form-label {
        font-weight: 500;
        color: #4a5568;
        font-size: 0.9rem;
    }

    .form-control {
        padding: 12px 15px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
    }

    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        border-color: var(--dash-blue);
        background-color: #fff;
    }

    /* Bouton calqué sur le style bleu du dashboard */
    .btn-primary {
        background-color: var(--dash-blue);
        border: none;
        padding: 12px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-visitor {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 10px;
        padding: 10px;
        text-decoration: none;
        display: block;
        text-align: center;
        margin-bottom: 25px;
        transition: all 0.3s ease;
    }

    .btn-visitor:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .welcome-text {
        color: var(--dash-dark);
        font-weight: 700;
        font-size: 1.5rem;
    }
    </style>
</head>

<body>

    <div class="login-container">
        <a href="<?= BASE_URL ?>?controller=auth&action=visitor" class="btn-visitor">
            <i class="fas fa-user-clock me-2"></i> Mode Visiteur
        </a>

        <div class="card">
            <div class="card-header text-center">
                <div class="logo-box">
                    <img src="photos/logo.jpg" alt="Logo" class="logo">
                </div>
                <div class="welcome-text mt-2">Connexion</div>
                <p class="text-muted small">Accédez à votre espace SArtM</p>
            </div>

            <div class="card-body px-4 pb-5">
                <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center"
                    style="border-radius: 10px; font-size: 0.85rem;">
                    <i class="fas fa-exclamation-circle me-2"></i> <?= $error ?>
                </div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Adresse Email</label>
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="exemple@mail.com"
                                required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="motsdepass" class="form-control" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Se connecter <i class="fas fa-sign-in-alt ms-2"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
            <small style="color: rgba(255,255,255,0.5)">&copy; 2026 Système de Cotisations</small>
        </div>
    </div>

</body>

</html>