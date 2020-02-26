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

  // QUERY PARA CREAR EL REPORTE
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




   if(isset($_POST['generar_reporte']))
{
  // NOMBRE DEL ARCHIVO Y CHARSET
  header('Content-Type:text/csv; charset=latin1');
  header('Content-Disposition: attachment; filename="Reporte_Unitario.csv"');

  // SALIDA DEL ARCHIVO
  $salida=fopen('php://output', 'w');
  // ENCABEZADOS
  fputcsv($salida, array('RUT', 'DV', 'NOMBRE', 'COD_AREA', 'TELEFONO', 'DIRECCION', 'COMUNA', 'REGION','FECHA'));
  // QUERY PARA CREAR EL REPORTE
  /*$reporteCsv=$link->query("SELECT * FROM clientes A  INNER JOIN direcciones PP ON A.rut = PP.rut INNER JOIN telefonos C ON PP.rut = C.rut  WHERE A.rut = $rut");*/

   $reporteCsv = mysqli_query($link, $query); 
  while($filaR= $reporteCsv->fetch_array())
    fputcsv($salida, array($filaR['rut'], 
                $filaR['dv'],
                $filaR['nombre'],
                $filaR["cod_area"],
                $filaR["tel"],
                $filaR["dire"],
                $filaR["comuna"],
                 $filaR["region"],
                $filaR["date"]);

}
?>
