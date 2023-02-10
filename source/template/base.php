<!--
    questo file si comporta come il template finale utilizzato per tutte le pagine
    deve includere $templateParams["name"] con require se presente (sarebbe il contenuto del main)
    utilizza i dati in $templateParams pre conpilare l'html
-->

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
                <!--<a href="#" class="d-flex d-none d-xxl-block align-items-center mb-2 mb-lg-0 text-decoration-none"> -->
                    <img src="https://i.ebayimg.com/images/g/o4EAAOSw9h1hcCxV/s-l500.jpg" alt="" width="50" height="50"
                        class="rounded-circle">
               <!-- </a> -->
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="showhomepage.php" class="nav-link px-2 <?php echo $templateParams["homepage"]?>">Home</a></li>
                    <li><a href="uni-list.php" class="nav-link px-2 <?php echo $templateParams["uni-list"]?>">Università</a></li>
                    <li><a href="notification.php" class="nav-link px-2 <?php echo $templateParams["notifications"]?>">Notifiche</a></li>
                </ul>
                <button id="searchBtn" role="search" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#searchModal"><em class="bi bi-search"> Cerca utente</em></button>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://cdn.pixabay.com/photo/2017/11/10/05/48/user-2935527_1280.png" alt="user picture"
                            width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
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
                <!-- <h1 class="modal-title fs-5" id="searchModalLabel">Cerca</h1> -->
                <input type="search" class="form-control" id="searchInput" placeholder="Cerca utente">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container searchResult p-3">
                    <p>Utilizza la barra di ricerca per cercare utenti in base al loro nome, cognome e/o username.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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
                        <p class="text-center">© 2023 - Progetto Web</p>
                    </div>
                </div>
            </div>
        </nav>

    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
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