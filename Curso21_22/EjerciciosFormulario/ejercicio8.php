<!DOCTYPE html>
<html>
  <head>
    <title>EJERCICIO 8</title>
    <meta charset="utf-8"/>
  </head>


  <body>

    <form action="ejer8.php" method="post">
      <label for="edad">Edad: </label>
      <input type='text' id="edad" name="edad" placeholder="introduzca la edad..."
      value="<?php if(isset($_POST['edad'])){echo $_POST['edad']; }?>"/>

      <?php
      $correcto=true;
        if(isset($_POST['edad']))
        {
          if($_POST['edad']=="" || !is_numeric($_POST['edad']) || $_POST['edad']>100)
          {
            echo "* VALOR INCORRECTO *";
            $correcto=false;
          }else{
            $edad=abs($_POST['edad']);
          }
        }


      ?>

      <input type="radio" name="estudiante" value="0" id="est"
      <?php
        if(!isset($_POST['enviar']) || $_POST['estudiante'] == "0")
        {
          echo "checked";
        }
      ?>/>
      <label for="est">Soy estudiante</label>

      <input type="radio" name="estudiante" value="1" id="noest"
      <?php
        if(isset($_POST['estudiante']) && $_POST['estudiante'] == "1")
        {
          echo "checked";
        }


      ?>/>
      <label for="noest">No soy estudiante</label>

      <input type="submit" name="enviar" value="Enviar"/>

    </form>
  </body>

  <?php
    if(isset($_POST['enviar']) && $correcto)
    {
      $estudiante=$_POST['estudiante'];
      if($edad<12 || $estudiante == 0)
      {
        $precio = "Precio de 3.5 euros por entrada";
      }else{

        $precio = "Precio de 5 euros por entrada";
      }

      echo $precio;
    }




  ?>



</html>
