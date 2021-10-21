<!DOCTYPE html>
<html>
  <head>
    <title>EJERCICIO 7 FORMULARIOS</title>
    <meta charset="utf-8"/>
  </head>
  <body>

    <?php
      $correcto=true;

    ?>

    <form action="ejer7.php" method="post">

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

    <label for="peseta">Pesetas</label>
    <input type="radio" name="moneda" id="peseta" value="peseta" <?php
      if(!isset($_POST['enviar']) || $_POST["moneda"] == "peseta"){echo "checked";}

     ?>/>

    <label for="dolar">Dolares</label>
    <input type="radio" name="moneda" id="dolar" value="dolar" <?php
      if(isset($_POST['enviar']) && $_POST["moneda"] == "dolar"){echo "checked";}

     ?>/>





    <input type="submit" name="enviar" value="Calcular pesetas"/>

  </form>


  <?php
    if(isset($_POST['enviar']) && $correcto)
    {
      echo calcularMoneda($_POST['moneda'], $_POST['euros']);
    }

    function calcularMoneda($tipo, $cantidad){

      if($tipo == "peseta")
      {
        echo $cantidad." EUROS SON: ". $cantidad*166 ." PESETAS.";
      }else{
        echo $cantidad." EUROS SON: ". $cantidad*1.15 ." DOLARES.";
      }
    }



  ?>






    </form>

  </body>





</html>
