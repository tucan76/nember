<?php

     require("app.php");

     $app = new App($_REQUEST);

     $app->run();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Výkaznictví procedur</title>
</head>
<body>
  <header>
     <h1>Výkaznictví procedur</h1>
  </header>
  <main>
     <div class="container">
          <div class="column left">
               <form action="/" method="POST">
                    <select name="uzivatel" onChange="submit()">
                         <?php 
                              foreach($app->getUzivatele() as $uz) {
                                   $selected = ($uz->id == $app->getActiveUzivatel())? "selected" : "";
                                   echo "<option value=\"{$uz->id}\" {$selected}>{$uz->jmeno} {$uz->prijmeni}</option>";
                              }
                         ?>
                    </select>
               </form>
               <h2>Oblíbené procedury</h2>
               <div class="container2">
                    <?php 
                         foreach($app->getOblibene($app->getActiveUzivatel()) as $oblibene) {
                              echo "<div class=\"wrapper\"><div class=\"procedura\">{$oblibene->nazev}</div><a href=\"?remove={$oblibene->id}&uzivatel={$app->getActiveUzivatel()}\">x</a></div>";
                         }
                    ?>
               </div>
               <hr/>
          </div>
          <!--div class="column center">this is center</!--div-->
          <div class="column right">
               <h2>Do oblibenych</h2>
               <ul>
                    <?php 
                         foreach($app->getProcedures() as $proc) {
                              echo "<li><a href=\"?add={$proc->id}&uzivatel={$app->getActiveUzivatel()}\">{$proc->nazev}</a></li>";
                         }
                    ?>
               </ul>
          </div>
     </div>
  </main>
  <footer>
  </footer>
  <script src="scripts.js"></script>
</body>
</html>

