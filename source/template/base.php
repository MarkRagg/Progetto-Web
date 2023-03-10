<?php

$homeBg = "bg-light";
$homeLink = "link-primary";
$uniBg = "bg-light";
$uniLink = "link-primary";
$notifyBg = "bg-light";
$notifyLink = "link-primary";
if ($templateParams["homepage"] === "link-secondary") {
    $homeBg = "bg-primary";
    $homeLink = "link-light";
}
if ($templateParams["uni-list"] === "link-secondary") {
    $uniBg = "bg-primary";
    $uniLink = "link-light";
}
if ($templateParams["notifications"] === "link-secondary") {
    $notifyBg = "bg-primary";
    $notifyLink = "link-light";
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title><?php echo $templateParams["title"]?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body class="bg-secondary">
    <header class="p-3 mb-3 border-bottom sticky-top z-index-master navbar-dark bg-dark">
        <div class="container ">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <img src="../img/logo.png" alt="logo" width="50" height="50"
                        class="rounded-circle">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li class="<?php echo($homeBg) ?> rounded-3"><a href="showhomepage.php" class="nav-link px-2 <?php echo($homeLink) ?>">Home</a></li>
                    <li class="<?php echo($uniBg) ?> rounded-3"><a href="uni-list.php" class="nav-link px-2 <?php echo($uniLink) ?>">Universit√†</a></li>
                    <li class="<?php echo($notifyBg) ?> rounded-3"><a href="notification.php" class="nav-link px-2 <?php echo($notifyLink) ?>">Notifiche</a></li>
                </ul>
                <button type="button" id="searchBtn" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#searchModal"><em class="bi bi-search"> Cerca utente</em></button>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../img/<?php require_once("../php/db_config.php"); $img = $dbh->getUserInfo($_SESSION["user_id"]); echo $img["user_image"] ?>" alt="user picture"
                            width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item"
                                href="../php/profile.php?username=<?php echo $_SESSION["user_id"];?>">Profilo</a>
                        </li>
                        <li><a class="dropdown-item" href="../php/insertpost.php">Inserisci post</a></li>
                        <li><a class="dropdown-item" href="../php/settings.php">Impostazioni</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../php/Login.php">Disconnetti</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <label for="searchInput" class="modal-title" id="searchModalLabel">Ricerca:</label>
                <input type="search" class="form-control" id="searchInput" placeholder="Cerca utente">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container searchResult p-3">
                    <p>Utilizza la barra di ricerca per cercare utenti in base al loro nome, cognome e/o username.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            </div>
            </div>
        </div>
    </div>
    <main>
        <?php
            if (isset($templateParams["name"])) {
                require($templateParams["name"]);
            }
            ?>
    </main>
    <footer>
        <nav class="fixed-bottom z-index-master navbar-dark bg-dark text-light">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="text-center">¬© 2023 - Progetto Web</p>
                    </div>
                </div>
            </div>
        </nav>

    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script src="../js/constants.js"></script>
<script src="../js/search.js"></script>
<?php 
    if (isset($templateParams["js"])) :
        foreach($templateParams["js"] as $script):
    ?>
<script src="<?php echo $script; ?>"></script>
<?php
        endforeach;
    endif;
    ?>

</html>