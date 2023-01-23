<!DOCTYPE html>
<html lang="en">
  <head>
  </head>
  <body>
    <header>
      <h1><?php echo $templateParams["title"] ?></h1>
    </header>
    <main>
      <?php
      if(isset($templateParams["name"])){
          require($templateParams["name"]);
      }
      ?>
    </main>
    <footer>
      <!--TODO--> 
    </footer>
    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
  </body>
</html>