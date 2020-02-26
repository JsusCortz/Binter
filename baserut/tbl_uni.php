<?php
 
   // Dirección o IP del servidor MySQL
    $host = "localhost";
 
    // Puerto del servidor MySQL
    $puerto = "3306";
 
   // Nombre de usuario del servidor MySQL
   $usuario = "root";
 
    // Contraseña del usuario
   $contrasena = "";
 
   // Nombre de la base de datos
   $baseDeDatos ="baserut";
 
   // Nombre de la tabla a trabajar
    $tabla = "clientes";
    
    $rut = $_POST["rut1"];
  
 
    function Conectarse()
   {
     global $host, $puerto, $usuario, $contrasena, $baseDeDatos, $tabla;
 
     if (!($link = mysqli_connect($host.":".$puerto, $usuario, $contrasena))) 
     { 
       // echo "Error conectando a la base de datos.<br>"; 
       exit(); 
            }
     else
      {
     // echo "Listo, estamos conectados.<br>";
      }
     if (!mysqli_select_db($link, $baseDeDatos)) 
      { 
      //  echo "Error seleccionando la base de datos.<br>"; 
        exit(); 
      }
     else
      {
      // echo "Obtuvimos la base de datos $baseDeDatos sin problema.<br>";
     }
   return $link; 
    } 
 
    $link = Conectarse();


$query = "SELECT 
    A.rut, 
    A.dv, 
    A.nombre, 
    C.cod_area, 
    C.tel, 
    C.date,
    PP.dire, 
    PP.comuna, 
    PP.region 
FROM 
  clientes A 
INNER JOIN direcciones PP ON A.rut = PP.rut 
INNER JOIN telefonos C ON PP.rut = C.rut 
WHERE A.rut = $rut";


 $result = mysqli_query($link, $query); 
 ?>


<!DOCTYPE html>
<html>
<head>
  <title>Sistema Rut</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="js/pagination.js"></script>
<style type="text/css">
  .button{
    margin: 20px;
    padding: 20px;
    position: center;
  }

  .h1{
    margin: 20px;
  }
  .input{
    margin:20px;
  }
  .hide{
    display: none;
  }

  button.bottom { vertical-align: text-bottom; }
</style>
</head>

<body class="center">
    <div class="row">
          <div class="content container-fluid align-items-center justify-content-start col-12 text-center">
          <img src="logo_binter.jpeg" width="350" height="180">
          <h1 class="h1">Sistema Rut</h1>
        </div>
      <div class="content  justify-content text-center col-3"> 
        <br>   <br>   <br>
            <button  class="btn btn-primary col-4" onclick="window.location.href='index.php'">Regresar</button>
        <br>   <br>   <br>
        <form method="post" class="form" action="reporte_uni.php">
         <input type="number"  placeholder="Ingrese Rut" id="rut1" name="rut1" class="text-center hide" value=<?php echo $rut ?> /> 
          <input type="submit" name="generar_reporte" class="btn btn-primary col-4" value="Descargar">
        </form>
      </div>
      <div class="content container-fluid align-items-center justify-content-start col-9 text-center">

      <div id="table1" class="content  justify-content text-center col-12">

        <center>

        <table id="example" class="table table-striped table-bordered col-10" >
            <thead>
           <tr>
              <td>Rut</td>
              <td>DV</td>
              <td>Nombre</td>
              <td>Cod Area</td>
              <td>Telefono</td>
              <td>Direccion</td>
              <td>Comuna</td>
              <td>Region</td>
              <td>Feha</td>
            </tr> 
               </thead>
        <tbody>
 <?php


  while($row = mysqli_fetch_array($result)) { 
     printf("<tr>
              <td>%s</td>
              <td>%s</td>
              <td>%s</td>
              <td>%s</td>
              <td>%s</td>
              <td>%s</td>
              <td>%s</td>
              <td>%s</td>
              <td>%s</td>
          </tr>",
          $row["rut"],
          $row["dv"],
          $row["nombre"],
          $row["cod_area"],
          $row["tel"],
          $row["dire"],
          $row["comuna"],
          $row["region"],
          $row["date"]); 
  } 
    mysqli_free_result($result); 
    mysqli_close($link); 
 ?>
 </tbody>
        <tfoot>
            <tr>
              <td>Rut</td>
              <td>DV</td>
              <td>Nombre</td>
              <td>Cod Area</td>
              <td>Telefono</td>
              <td>Direccion</td>
              <td>Comuna</td>
              <td>Region</td>
              <td>Feha</td>
            </tr>
        </tfoot>
    </table>

  </center>

</div>

<div>

</div>

</div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</body>

</html>