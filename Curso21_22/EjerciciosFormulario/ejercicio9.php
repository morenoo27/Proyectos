<!DOCTYPE html>
<html>
  <head>
    <title>EJERCICIO 9</title>
    <meta charset="utf-8"/>
    <style>
      div {width: 500px; float:left; margin:20px}
      div > input[type="text"] {width:95%}
      div > input[type="submit"], input[type="reset"]{margin:auto 50%}
      div#radio{width:100%; }
      div#radio > input{width:20px}
      label{font-weight: bold}

    </style>
  </head>


  <body>

    <h2>Formulario - Ejercicio 9</h2>
    <h4>Cinem@s</h4>

    <form action="ejer9.php" method="post" enctype="multipart/form-data">

      <div >
        <label for="titulo">Titulo: </label>
        <input type='text' id="titulo" name="titulo"
        value="<?php if(isset($_POST['titulo'])){echo $_POST['titulo']; }?>"/>

        <?php
        $correcto=true;
          if(isset($_POST['titulo']))
          {
            if($_POST['titulo']=="" )
            {
              echo "* CAMPO OBLIGATORIO *";
              $correcto=false;
            }else{
              $datos=[];
              $datos['Titulo']=$_POST['titulo'];
            }
          }


        ?>
        <label for="director">Director: </label>
        <input type='text' id="director" name="director"
        value="<?php if(isset($_POST['director'])){echo $_POST['director']; }?>"/>

        <?php

          if(isset($_POST['director']))
          {
            if($_POST['director']=="" )
            {
              echo "* CAMPO OBLIGATORIO *";
              $correcto=false;
            }else{
              $datos['Director']=$_POST['director'];
            }
          }


        ?>

        <label for="produccion">Produccion: </label>
        <input type='text' id="produccion" name="produccion"
        value="<?php if(isset($_POST['produccion'])){echo $_POST['produccion']; }?>"/>

        <?php

          if(isset($_POST['produccion']))
          {
            if($_POST['produccion']=="" )
            {
              echo "* CAMPO OBLIGATORIO *";
              $correcto=false;
            }else{
              $datos['Preduccion']=$_POST['produccion'];
            }
          }


        ?>

        <label for="nacionalidad">Nacionalidad: </label>
        <input type='text' id="nacionalidad" name="nacionalidad"
        value="<?php if(isset($_POST['nacionalidad'])){echo $_POST['nacionalidad']; }?>"/>

        <?php

          if(isset($_POST['nacionalidad']))
          {
            if($_POST['nacionalidad']=="" )
            {
              echo "* CAMPO OBLIGATORIO *";
              $correcto=false;
            }else{
              $datos['Nacionalidad']=$_POST['nacionalidad'];
            }
          }


        ?>

        <label for="duracion">Duracion: </label>
        <input type='number' id="duracion" name="duracion"
        value="<?php if(isset($_POST['duracion'])){echo $_POST['duracion']; }?>"/>

        <?php

          if(isset($_POST['duracion']))
          {
            if($_POST['duracion']==""  )
            {
              echo "* CAMPO OBLIGATORIO *";
              $correcto=false;
            }else if(strlen($_POST['duracion'])>3)
            {

              echo "* MAXIMO 3 CARACTERES *";
              $correcto=false;
            }else{
              $datos['Duracion']=$_POST['duracion'];
            }
          }


        ?>
      </div>

      <div>
        <label for="actores">Actores: </label>
        <input type='text' id="actores" name="actores"
        value="<?php if(isset($_POST['actores'])){echo $_POST['actores']; }?>"/>

        <?php

          if(isset($_POST['actores']))
          {
            if($_POST['actores']=="" )
            {
              echo "* CAMPO OBLIGATORIO *";
              $correcto=false;
            }else{
              $datos['Actores']=$_POST['actores'];
            }
          }


        ?>
        <label for="guion">Guion: </label>
        <input type='text' id="guion" name="guion"
        value="<?php if(isset($_POST['guion'])){echo $_POST['guion']; }?>"/>

        <?php

          if(isset($_POST['guion']))
          {
            if($_POST['guion']=="" )
            {
              echo "* CAMPO OBLIGATORIO *";
              $correcto=false;
            }else{
              $datos['Guion']=$_POST['guion'];
            }
          }


        ?>

        <label for="ano">Ano: </label>
        <input type='number' id="ano" name="ano"
        value="<?php if(isset($_POST['ano'])){echo $_POST['ano']; }?>"/>

        <?php

          if(isset($_POST['ano']))
          {
            if($_POST['ano']=="" )
            {
              echo "* CAMPO OBLIGATORIO *";
              $correcto=false;
            }else if(strlen($_POST['ano'])!=4 )
            {
              echo "* VALOR INCORRECTO *";
            }else{
              $datos['Anio']=$_POST['ano'];
            }
          }


        ?>




        <label for="gen">Genero: </label>
        <select name="genero" id="gen">
          <option value='comedia' <?php comprobarChecked('comedia') ?>>comedia</option>
          <option value='drama' <?php comprobarChecked('drama') ?>>drama</option>
          <option value='accion' <?php comprobarChecked('accion') ?>>accion</option>
          <option value='terror' <?php comprobarChecked('terror') ?>>terror</option>
          <option value='suspense' <?php comprobarChecked('suspense') ?>>suspense</option>
          <option value='otras' <?php comprobarChecked('otras') ?>>otras</option>

        </select><br/>

        <?php
        if(isset($_POST['genero']))
        {
          $datos['Genero']=$_POST['genero'];
        }


        ?>

        <label>Restricciones de edad</label>
        <div id="radio">
          <input type="radio" name="restricciones" id="todos" value="todos"
          <?php
            if(isset($_POST['restricciones']) && $_POST['restricciones']=="todos" )
            {
              echo "checked";
            }
          ?>/>
          <label for="todos">Todos los publicos</label>
          <input type="radio" name="restricciones" id="mayores7" value="mayor7"
          <?php
            if(isset($_POST['restricciones']) && $_POST['restricciones']=="mayor7" )
            {
              echo "checked";
            }




          ?>/>
          <label for="mayores7">Mayores de 7 anios</label>
          <input type="radio" name="restricciones" id="mayores18" value="mayor18"
          <?php
            if(!isset($_POST['restricciones']) || $_POST['restricciones']=="mayor18" )
            {
              echo "checked";
            }
            if(isset($_POST['restricciones']))
            {
              $datos['Restricciones de edad']=$_POST['restricciones'];
            }

          ?>/>
          <label for="mayores18">Mayores de 18 anios</label>

        </div>


      </div>

      <div style="width:100%">
        <label for="sinopsis">Sinopsis</label><br/>
        <textarea cols=50 rows=10 id='sinopsis' name='sinopsis'></textarea>
      </div>



      <div>

      <label for="caratula">Caratula</label><br/>

      <input type="submit" name="enviar" value="Enviar" />

    </div>

        <div>
          <input type="file" name="caratula" id="caratula" accept="image/*"/>
          <?php
            if(isset($_POST["enviar"]))
            {
              if($_FILES['caratula']['name']=="")
              {
                echo "* ARCHIVO NECESARIO *";
                $correcto=false;
              }
              elseif($_FILES['caratula']['size']>120000)
              {
                echo "* ARCHIVO DEMASIADO GRANDE *";
                $correcto=false;
              }
              elseif($_FILES['caratula']['type']!="image/jpg" && $_FILES['caratula']['type']!="image/png" && $_FILES['caratula']['type']!="image/jpeg")
              {
                echo "* FORMATO DE ARCHIVO INCORRECTO *";
                $correcto=false;
              }
            }

          ?>
          <br/>
          <input type="reset" name="borrar" value="Borrar"/>

        </div>
    </form>
  </body>

  <?php
    if(isset($_POST['enviar']) && $correcto)
    {
      echo "<div style='float:none'>";
      echo "<h2>Formulario - Ejercicio 9</h2> <br/> <h3>La pelicula introducida es: </h3>";
      echo "<ul style='list-style:none'>";
      foreach ($datos as $i => $j)
      {
        echo "<li><strong>".$i."</strong>: ".$j."</li>";
      }

      if($_FILES['caratula']['error']==0)
      {
        echo "<li><strong>Caratula</strong><ul>";

        foreach($_FILES["caratula"] as $i => $j){
          echo "<li><strong>".$i.": </strong>".$j."</li>";
        }

        echo "</ul></ul>";



        if(move_uploaded_file($_FILES["caratula"]["tmp_name"], $_FILES["caratula"]["name"]))
        {
          echo "<h3>El archivo se ha movido a la carpeta de destino</h3>";
          echo "<hr/>";
          echo "<img src='".$_FILES["caratula"]["name"]."' width:200px/>";
          echo "<hr/>";
        }else{
          echo "No se pudo subir la caratula";
        }
      }else{
        echo " * HUBO PROBLEMAS AL SUBIR EL ARCHIVO * ";
      }

      echo "<strong>Sinopsis: </strong><br/>".$_POST['sinopsis'];

      echo "</div>";


    }

    function comprobarChecked($aux)
    {
      if(isset($_POST['genero']) && $_POST['genero']==$aux )
      {
        echo "selected";
      }
    }


  ?>



</html>
