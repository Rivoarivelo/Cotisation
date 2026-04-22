<!-- <title>Admin Dashboar</title> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
<link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico" />
<!--! END: Favicon-->
<!--! BEGIN: Bootstrap CSS-->
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css" />
<!--! END: Bootstrap CSS-->
<!--! BEGIN: Vendors CSS-->
<link rel="stylesheet" type="text/css" href="../assets/vendors/css/vendors.min.css" />
<link rel="stylesheet" type="text/css" href="../assets/vendors/css/daterangepicker.min.css" />

<link rel="stylesheet" type="text/css" href="../assets/css/theme.min.css" />


<!--! ================================================================ !-->
<!--! [Start] Navigation Manu !-->
<!--! ================================================================ !-->
<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <!-- <h4 class="text-white fw-bold fs-6">SARTM</h4> -->
            <a href="AccueilDashboard.php" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <!-- centrer le logo -->
                <img src="photos/logo.png" width="70" class="rounded rounded-end  mx-auto d-block" height="70" />

            </a>

        </div>
        <div class="navbar-content">
            <ul class="nxl-navbar d-flex row g-3">
                <li class="nxl-item nxl-caption ml-5">
                    <label>Navigation</label>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="AccueilDashboard.php" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-airplay"></i></span>
                        <span class="nxl-mtext fs-6">Dashboards</span><span class="nxl-arrow"><i class=""></i></span>
                    </a>
                </li>
                <?php if ($_SESSION['user']['role'] === 'ADMIN' || $_SESSION['user']['role'] === 'COMPTABLE'): ?>
                <li class="nxl-item nxl-hasmenu">
                    <a href="#" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-dollar-sign"></i></span>
                        <span class="nxl-mtext fs-6">Paiements</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link fs-6"
                                href="index.php?controller=paiement&action=add">Payer</a>
                        </li>
                        <li class="nxl-item"><a class="nxl-link fs-6"
                                href="index.php?controller=paiement&action=index">Liste des
                                payements</a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext fs-6">Membres</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <?php if ($_SESSION['user']['role'] === 'ADMIN' || $_SESSION['user']['role'] === 'BUREAU'): ?>
                        <li class="nxl-item"><a class="nxl-link fs-6"
                                href="index.php?controller=membre&action=add">Ajouter un
                                membre</a></li>
                        <?php endif; ?>
                        <li class="nxl-item"><a class="nxl-link fs-6"
                                href="index.php?controller=membre&action=index">Rechercher
                                un membre</a></li>
                    </ul>
                </li>

                <li class="nxl-item nxl-hasmenu">
                    <a href="index.php?controller=sync&action=syncOne" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext fs-6">Synchronisation</span><span class="nxl-arrow"><i
                                class=""></i></span>
                    </a>

                </li>
                <!--  -->
                <?php if ($_SESSION['user']['role'] === 'ADMIN' || $_SESSION['user']['role'] === 'BUREAU'): ?>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <!-- icone responsable -->
                        <span class="nxl-micon"><i class="feather-user-check"></i></span>
                        <span class="nxl-mtext fs-6">Responsable</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">

                        <li class="nxl-item"><a class="nxl-link fs-6" href="index.php?controller=responsable">Créer
                                responsable</a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                <li class="nxl-item nxl-hasmenu">
                    <a href="index.php?controller=sortiefond" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext fs-6">Sortie de fonds</span><span class="nxl-arrow"><i
                                class=""></i></span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="index.php?controller=paiement&action=stats" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-alert-circle"></i></span>
                        <span class="nxl-mtext text-opacity-100 fs-6">Histogramme</span><span class="nxl-arrow"><i
                                class=""></i></span>
                    </a>
                </li>
                <?php if ($_SESSION['user']['role'] === 'ADMIN' || $_SESSION['user']['role'] === 'BUREAU'): ?>
                <li class="nxl-item nxl-hasmenu">
                    <a href="index.php?controller=presence&action=index" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-user-check"></i></span>
                        <span class="nxl-mtext text-opacity-100 fs-6">Presence</span><span class="nxl-arrow"><i
                                class=""></i></span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($_SESSION['user']['role'] === 'ADMIN' || $_SESSION['user']['role'] === 'BUREAU'): ?>
                <li class="nxl-item nxl-hasmenu">
                    <a href="index.php?controller=pointage&action=index" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-user-check"></i></span>
                        <span class="nxl-mtext text-opacity-100 fs-6">Pointage</span><span class="nxl-arrow"><i
                                class=""></i></span>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Déconnexion placer en bas -->
                <a href="index.php?controller=auth&action=logout" class="btn btn-danger btn-sm text-end mt-3">
                    Déconnexion
                </a>
            </ul>
        </div>
    </div>
</nav>
<!--! ================================================================ !-->
<!--! [End]  Navigation Manu !-->
<!--! ================================================================ !-->
<!--! ================================================================ !-->
<!--! [Start] Header !-->
<!--! ================================================================ !-->
<header class="nxl-header">
    <div class="header-wrapper">
        <!--! [Start] Header Left !-->
        <div class="header-left d-flex align-items-center gap-4">
            <!--! [Start] nxl-head-mobile-toggler !-->
            <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>
            <!--! [Start] nxl-head-mobile-toggler !-->
            <!--! [Start] nxl-navigation-toggle !-->
            <div class="nxl-navigation-toggle">
                <a href="javascript:void(0);" id="menu-mini-button">
                    <i class="feather-align-left"></i>
                </a>
                <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                    <i class="feather-arrow-right"></i>
                </a>
            </div>
            <!--! [End] nxl-navigation-toggle !-->
            <!--! [Start] nxl-lavel-mega-menu-toggle !-->
            <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                <a href="javascript:void(0);" id="nxl-lavel-mega-menu-open">
                    <i class="feather-align-left"></i>
                </a>
            </div>
            <!--! [End] nxl-lavel-mega-menu-toggle !-->
            <!--! [Start] nxl-lavel-mega-menu !-->

            <!--! [End] nxl-lavel-mega-menu !-->
        </div>
        <!--! [End] Header Left !-->
        <!--! [Start] Header Right !-->
        <div class="header-right ms-auto">
            <div class="d-flex align-items-center">

                <a href="index.php?controller=auth&action=changePassword">
                    Changer mot de passe
                </a>
                <div class="nxl-h-item dark-light-theme">
                    <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button">
                        <i class="feather-moon"></i>
                    </a>
                    <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none">
                        <i class="feather-sun"></i>
                    </a>
                </div>

                <div class="dropdown nxl-h-item">
                    <a class="nxl-head-link me-3" data-bs-toggle="dropdown" href="#" role="button"
                        data-bs-auto-close="outside">
                        <i class="feather-bell"></i>
                        <span class="badge bg-danger nxl-h-badge">0</span>
                    </a>

                </div>
                <div class="dropdown nxl-h-item">
                    <!-- <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button" data-bs-auto-close="">
            <!-- icon utilisateur -->
                    <!-- <i class="feather-user text-white fs-5"></i> -->
                    <!-- </a> -->

                    <?php $user = $_SESSION['user'] ?? null; ?>
                    <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                        <div class="dropdown-header">
                            <div class="d-flex align-items-start">
                                <i class="feather-user text-black fs-3 border border-5 border-black rounded-pill"></i>
                                <div>
                                    <br class="text-dark fs-6 mb-0">
                                    <?= ($user['nom'] ?? '') . ' ' . ($user['prenom'] ?? '') ?>
                                    <span class="badge bg-soft-success text-success ms-1">
                                        <?= $user['role'] ?? 'USER' ?>
                                    </span>
                                    </h6>
                                    <span class="fs-12 fw-medium text-muted">
                                        <?= $user['email'] ?? '' ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>
                        <a href="index.php?controller=auth&action=logout" class="dropdown-item">
                            <i class="feather-log-out"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
                <!-- NOM ADMIN -->
                <h6 class="text-white fs-6 mb-0">
                    <?= ($user['prenom'] ?? '') ?>
                    <span class="badge bg-soft-success text-success ms-1">
                        <?= $user['role'] ?? 'USER' ?>
                    </span>
                </h6>
            </div>
        </div>
        <!--! [End] Header Right !-->
    </div>
</header>
<!--! ================================================================ !-->
<!--! [End] Header !-->
<!--! ================================================================ !-->
<!--! ================================================================ !-->
<!--! [Start] Main Content !-->
<!--! ================================================================ !-->
<main class="nxl-container bg-gray-400">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Tableau de bord</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="AccueilDashboard.php"><?php $title ?></a></li>
                    <!-- <li class="breadcrumb-item">Dashboard</li> -->
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Retour</span>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <div id="reportrange" class="reportrange-picker d-flex align-items-center">
                            <span class="reportrange-picker-field"></span>
                        </div>
                        <div class="dropdown filter-dropdown">
                            <a class="btn btn-md btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                data-bs-auto-close="outside">
                                <i class="feather-filter me-2"></i>
                                <span>Filtrer</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Role"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Role">Role</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Team"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Team">Team</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Email"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Email">Email</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Member"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Member">Member</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Recommendation"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer"
                                            for="Recommendation">Recommendation</label>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-plus me-3"></i>
                                    <span>Créer Nouveau</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-filter me-3"></i>
                                    <span>Gérer le Filtre</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <?php require $view; ?>
        </div>

</main>
<!--! ================================================================ !-->
<!--! [End] Main Content !-->
<!--! ================================================================ !-->
<!--! ================================================================ !-->
<!--! BEGIN: Theme Customizer !-->
<!--! ================================================================ !-->
<div class="theme-customizer">
    <div class="customizer-handle">
        <a href="javascript:void(0);" class="cutomizer-open-trigger bg-primary">
            <i class="feather-settings"></i>
        </a>
    </div>
    <div class="customizer-sidebar-wrapper">
        <div
            class="customizer-sidebar-header px-4 ht-80 border-bottom d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Theme Settings</h5>
            <a href="javascript:void(0);" class="cutomizer-close-trigger d-flex">
                <i class="feather-x"></i>
            </a>
        </div>
        <div class="customizer-sidebar-body position-relative p-4" data-scrollbar-target="#psScrollbarInit">
            <!--! BEGIN: [Navigation] !-->
            <div class="position-relative px-3 pb-3 pt-4 mt-3 mb-5 border border-gray-2 theme-options-set">
                <label
                    class="py-1 px-2 fs-8 fw-bold text-uppercase text-muted text-spacing-2 bg-white border border-gray-2 position-absolute rounded-2 options-label"
                    style="top: -12px">Navigation</label>
                <div class="row g-2 theme-options-items app-navigation" id="appNavigationList">
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-navigation-light" name="app-navigation" value="1"
                            data-app-navigation="app-navigation-light" checked />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-navigation-light">Light</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-navigation-dark" name="app-navigation" value="2"
                            data-app-navigation="app-navigation-dark" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-navigation-dark">Dark</label>
                    </div>
                </div>
            </div>
            <!--! END: [Navigation] !-->
            <!--! BEGIN: [Header] !-->
            <div class="position-relative px-3 pb-3 pt-4 mt-3 mb-5 border border-gray-2 theme-options-set mt-5">
                <label
                    class="py-1 px-2 fs-8 fw-bold text-uppercase text-muted text-spacing-2 bg-white border border-gray-2 position-absolute rounded-2 options-label"
                    style="top: -12px">Header</label>
                <div class="row g-2 theme-options-items app-header" id="appHeaderList">
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-header-light" name="app-header" value="1"
                            data-app-header="app-header-light" checked />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-header-light">Light</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-header-dark" name="app-header" value="2"
                            data-app-header="app-header-dark" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-header-dark">Dark</label>
                    </div>
                </div>
            </div>
            <!--! END: [Header] !-->
            <!--! BEGIN: [Skins] !-->
            <div class="position-relative px-3 pb-3 pt-4 mt-3 mb-5 border border-gray-2 theme-options-set">
                <label
                    class="py-1 px-2 fs-8 fw-bold text-uppercase text-muted text-spacing-2 bg-white border border-gray-2 position-absolute rounded-2 options-label"
                    style="top: -12px">Skins</label>
                <div class="row g-2 theme-options-items app-skin" id="appSkinList">
                    <div class="col-6 text-center position-relative single-option light-button active">
                        <input type="radio" class="btn-check" id="app-skin-light" name="app-skin" value="1"
                            data-app-skin="app-skin-light" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-skin-light">Light</label>
                    </div>
                    <div class="col-6 text-center position-relative single-option dark-button">
                        <input type="radio" class="btn-check" id="app-skin-dark" name="app-skin" value="2"
                            data-app-skin="app-skin-dark" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-skin-dark">Dark</label>
                    </div>
                </div>
            </div>
            <!--! END: [Skins] !-->
            <!--! BEGIN: [Typography] !-->
            <div class="position-relative px-3 pb-3 pt-4 mt-3 mb-0 border border-gray-2 theme-options-set">
                <label
                    class="py-1 px-2 fs-8 fw-bold text-uppercase text-muted text-spacing-2 bg-white border border-gray-2 position-absolute rounded-2 options-label"
                    style="top: -12px">Typography</label>
                <div class="row g-2 theme-options-items font-family" id="fontFamilyList">
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-lato" name="font-family" value="1"
                            data-font-family="app-font-family-lato" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-lato">Lato</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-rubik" name="font-family" value="2"
                            data-font-family="app-font-family-rubik" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-rubik">Rubik</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-inter" name="font-family" value="3"
                            data-font-family="app-font-family-inter" checked />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-inter">Inter</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-cinzel" name="font-family" value="4"
                            data-font-family="app-font-family-cinzel" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-cinzel">Cinzel</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-nunito" name="font-family" value="6"
                            data-font-family="app-font-family-nunito" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-nunito">Nunito</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-roboto" name="font-family" value="7"
                            data-font-family="app-font-family-roboto" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-roboto">Roboto</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-ubuntu" name="font-family" value="8"
                            data-font-family="app-font-family-ubuntu" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-ubuntu">Ubuntu</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-poppins" name="font-family" value="9"
                            data-font-family="app-font-family-poppins" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-poppins">Poppins</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-raleway" name="font-family" value="10"
                            data-font-family="app-font-family-raleway" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-raleway">Raleway</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-system-ui" name="font-family"
                            value="11" data-font-family="app-font-family-system-ui" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-system-ui">System UI</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-noto-sans" name="font-family"
                            value="12" data-font-family="app-font-family-noto-sans" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-noto-sans">Noto Sans</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-fira-sans" name="font-family"
                            value="13" data-font-family="app-font-family-fira-sans" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-fira-sans">Fira Sans</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-work-sans" name="font-family"
                            value="14" data-font-family="app-font-family-work-sans" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-work-sans">Work Sans</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-open-sans" name="font-family"
                            value="15" data-font-family="app-font-family-open-sans" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-open-sans">Open Sans</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-maven-pro" name="font-family"
                            value="16" data-font-family="app-font-family-maven-pro" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-maven-pro">Maven Pro</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-quicksand" name="font-family"
                            value="17" data-font-family="app-font-family-quicksand" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-quicksand">Quicksand</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-montserrat" name="font-family"
                            value="18" data-font-family="app-font-family-montserrat" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-montserrat">Montserrat</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-josefin-sans" name="font-family"
                            value="19" data-font-family="app-font-family-josefin-sans" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-josefin-sans">Josefin Sans</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-ibm-plex-sans" name="font-family"
                            value="20" data-font-family="app-font-family-ibm-plex-sans" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-ibm-plex-sans">IBM Plex Sans</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-source-sans-pro" name="font-family"
                            value="5" data-font-family="app-font-family-source-sans-pro" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-source-sans-pro">Source Sans Pro</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-montserrat-alt" name="font-family"
                            value="21" data-font-family="app-font-family-montserrat-alt" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-montserrat-alt">Montserrat Alt</label>
                    </div>
                    <div class="col-6 text-center single-option">
                        <input type="radio" class="btn-check" id="app-font-family-roboto-slab" name="font-family"
                            value="22" data-font-family="app-font-family-roboto-slab" />
                        <label
                            class="py-2 fs-9 fw-bold text-dark text-uppercase text-spacing-1 border border-gray-2 w-100 h-100 c-pointer position-relative options-label"
                            for="app-font-family-roboto-slab">Roboto Slab</label>
                    </div>
                </div>
            </div>
            <!--! END: [Typography] !-->
        </div>
        <div class="customizer-sidebar-footer px-4 ht-60 border-top d-flex align-items-center gap-2">
            <div class="flex-fill w-50">
                <a href="javascript:void(0);" class="btn btn-danger" data-style="reset-all-common-style">Reset</a>
            </div>
            <div class="flex-fill w-50">
                <a href="https://www.themewagon.com/themes/Duralux-admin" target="_blank"
                    class="btn btn-primary">Download</a>
            </div>
        </div>
    </div>
</div>

<!--! ================================================================ !-->
<!--! [End] Theme Customizer !-->
<!--! ================================================================ !-->
<!--! ================================================================ !-->
<!--! Footer Script !-->
<!--! ================================================================ !-->
<!--! BEGIN: Vendors JS !-->
<script src="../assets/vendors/js/vendors.min.js"></script>
<!-- vendors.min.js {always must need to be top} -->
<script src="../assets/vendors/js/daterangepicker.min.js"></script>
<script src="../assets/vendors/js/apexcharts.min.js"></script>
<script src="../assets/vendors/js/circle-progress.min.js"></script>
<!--! END: Vendors JS !-->
<!--! BEGIN: Apps Init  !-->
<script src="../assets/js/common-init.min.js"></script>
<script src="../assets/js/dashboard-init.min.js"></script>
<!--! END: Apps Init !-->
<!--! BEGIN: Theme Customizer  !-->
<script src="../assets/js/theme-customizer-init.min.js"></script>
<!--! END: Theme Customizer !-->
<?php require __DIR__ . '/../layout/footer.php'; ?>