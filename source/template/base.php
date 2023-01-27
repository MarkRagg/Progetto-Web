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
    <title><?php echo $templateParams["title"]?></title>
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
                    <li><a href="showhomepage.php" class="nav-link px-2 link-secondary">Home</a></li>
                    <li><a href="#" class="nav-link px-2 ">Corsi</a></li>
                    <li><a href="notification.php" class="nav-link px-2 ">Notifiche</a></li>
                </ul>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://cdn.pixabay.com/photo/2017/11/10/05/48/user-2935527_1280.png" alt="user picture"
                            width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
                        <li><a class="dropdown-item"
                                href="../php/profile.php?username=<?php echo $templateParams["paginaprofilouser"]?>">Profile</a>
                        </li>
                        <li><a class="dropdown-item" href="../php/insertpost.php">Inserisci post</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="">
        <button class="btn btn-secondary float-right" onclick="location.href='../php/insertpost.php';">Aggiungi
            post</button>
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