<!--
    questo file si comporta come il template finale utilizzato per tutte le pagine
    deve includere $templateParams["name"] con require se presente (sarebbe il contenuto del main)
    utilizza i dati in $templateParams pre conpilare l'html
-->

<!DOCTYPE html>
<html lang="it">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body class="">
    <header class="p-3 mb-3 border-bottom sticky-top z-index-master navbar-dark bg-dark">
            <div class="container ">
              <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="#" class="d-flex d-none d-xxl-block align-items-center mb-2 mb-lg-0 text-decoration-none">
                    <img src="https://i.ebayimg.com/images/g/o4EAAOSw9h1hcCxV/s-l500.jpg" alt="" width="50" height="50" class="rounded-circle">
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                  <li><a href="showhomepage.php" class="nav-link px-2 link-secondary">Home</a></li>
                  <li><a href="#" class="nav-link px-2 ">Corsi</a></li>
                  <li><a href="#" class="nav-link px-2 ">Notifiche</a></li>
                </ul>
                <!-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                  <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form> -->
                <div>
                  <a href="../php/profile.php?username=<?php echo $templateParams["paginaprofilouser"]?>" class="d-block text-decoration-none" id="dropdownUser1" aria-expanded="false">
                    <img src="https://cdn.pixabay.com/photo/2017/11/10/05/48/user-2935527_1280.png" alt="" width="32" height="32" class="rounded-circle">
                  </a>
                </div>
                <div>
                  <button type="button" class="btn btn-outline-info btn-sm mb-3 mb-lg-0 me-lg-3">
                    <span class="glyphicon glyphicon-log-out"></span> Log out
                  </button>
                </div>
              </div>
            </div>
          </header>
          <a href="insertpost.php">Aggiungi post</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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