<!DOCTYPE html>
<html>
  <head>
    <title>EJERCICIO 5 FORMULARIOS</title>
    <meta charset="utf-8"/>
  </head>
  <body>

    <?php
      $correcto=true;

    ?>

    <form action="ejer5.php" method="post">

      <label for="nom">Nombre: </label>
      <input type="text" name="nombre" id="nom" value="<?php
        if(isset($_POST['nombre'])){echo $_POST['nombre']; }
      ?>"/>

      <?php
        if(isset($_POST["nombre"]) && $_POST["nombre"] == ""){

            echo "* CAMPO OBLIGATORIO *";
            $correcto=false;

        }

      ?>



      <label for="ape">Apellidos: </label>
      <input type="text" name="apellido" id="ape" value="<?php
        if(isset($_POST['apellido'])){echo $_POST['apellido']; }
      ?>"/>

      <?php
        if(isset($_POST["apellido"]) && $_POST["apellido"] == ""){

            echo "* CAMPO OBLIGATORIO *";
            $correcto=false;

        }

      ?>

      <label for="cal">Calle: </label>
      <input type="text" name="calle" id="cal" value="<?php
        if(isset($_POST['calle'])){echo $_POST['calle']; }
      ?>"/>

      <?php
        if(isset($_POST["calle"]) && $_POST["calle"] == ""){

            echo "* CAMPO OBLIGATORIO *";
            $correcto=false;

        }

      ?>

      <label for="pos">Codigo Postal: </label>
      <input type="text" name="postal" id="pos" value="<?php
        if(isset($_POST['postal'])){echo $_POST['postal']; }
      ?>"/>

      <?php
        if(isset($_POST["postal"])) {
          if($_POST["postal"] == ""){

              echo "* CAMPO OBLIGATORIO *";
              $correcto=false;

        }
        else if(strlen($_POST["postal"])!=5 || !is_numeric($_POST["postal"]) )
        {
          echo "* EL CODIGO POSTAL ES INCORRECTO *";
          $correcto=false;
        }

        }

      ?>

      <label for="loc">Localidad: </label>
      <input type="text" name="localidad" id="loc" value="<?php
        if(isset($_POST['localidad'])){echo $_POST['localidad']; }
      ?>"/>

      <?php
        if(isset($_POST["localidad"]) && $_POST["localidad"] == ""){

            echo "* CAMPO OBLIGATORIO *";
            $correcto=false;

        }

      ?>



      <input type="submit" name="enviar" value="Calcular"/>

      <?php
      if($correcto && isset($_POST["enviar"]))
      {

        echo ( "<ul>".

          "<li>NOMBRE: ".$_POST['nombre']. "</li>".
          "<li>APELLIDOS: ".$_POST['apellido']. "</li>".
          "<li>CALLE: ".$_POST['calle']. "</li>".
          "<li>CODIGO POSTAL: ".$_POST['postal']. "</li>".
          "<li>LOCALIDAD:".$_POST['localidad']. "</li>".



        "</ul>");
      }


      ?>





    </form>

  </body>





</html>
