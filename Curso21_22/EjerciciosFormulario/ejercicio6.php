<!DOCTYPE html>
<html>
  <head>
    <title>EJERCICIO 6 FORMULARIOS</title>
    <meta charset="utf-8"/>
  </head>
  <body>

    <?php
      $correcto=true;

    ?>

    <form action="ejer6.php" method="post">

    <input type="number" id="eu" name="euros" placeholder="Introduce euros..." value="<?php
      if(isset($_POST['euros'])){echo $_POST['euros']; }
    ?>"/>

    <?php

      if(isset($_POST['euros']) && $_POST['euros'] == 0)
      {
        echo "* CAMPO OBLIGATORIO *";
        $correcto=false;
      }



    ?>

    <input type="submit" name="enviar" value="Calcular pesetas"/>

  </form>


  <?php
    if(isset($_POST['enviar']) && $correcto)
    {
      echo $_POST['euros']." EUROS SON: ".$_POST['euros']*166 ." PESETAS.";
    }
  ?>






    </form>

  </body>





</html>
