<?php
require_once("db_config.php");
$query_result = $dbh->AddUser($_POST["nickname"], $_POST["email"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["date"], $_POST["residence"]);

?>

<!DOCTYPE html>
<html lang="eng">
  <head>

  </head>
  <body>
    <header>
    </header>
    <main>
      <section>
        <?php if ($query_result == true) {
          echo "<h1>Registrazione completata!</h1>";
        }
        else {
          echo "<h1>Registrazione fallita!</h1>";
        } ?>  
      </section>
    </main>
    <footer>
      <!--TODO--> 
    </footer>
  </body>
</html>