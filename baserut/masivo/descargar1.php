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

 if(isset($_POST['generar_reporte'])) {
  // NOMBRE DEL ARCHIVO Y CHARSET
  header('Content-Type:text/csv; charset=latin1');
  header('Content-Disposition: attachment; filename="Reporte_Masivo.csv"');

  // SALIDA DEL ARCHIVO
  $salida=fopen('php://output', 'w');
  // ENCABEZADOS
  fputcsv($salida, array('RUT', 'DV', 'NOMBRE', 'COD_AREA', 'TELEFONO', 'DIRECCION', 'COMUNA', 'REGION'));
  // QUERY PARA CREAR EL REPORTE

  $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
   
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){
       
        if(is_uploaded_file($_FILES['file']['tmp_name'])){   
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');           
           
            while(($emp = fgetcsv($csv_file)) !== FALSE){
                // Check if employee already exists with same email
               
                $sql_query = "SELECT 
                            A.rut, 
                            A.dv, 
                            A.nombre, 
                            C.cod_area, 
                            C.tel, 
                            PP.dire, 
                            PP.comuna, 
                            PP.region 
                        FROM 
                          clientes A 
                        INNER JOIN direcciones PP ON A.rut = PP.rut 
                        INNER JOIN telefonos C ON PP.rut = C.rut 
                        WHERE A.rut = '".$emp[0]."'";
  /*$reporteCsv=$link->query("SELECT * FROM clientes A  INNER JOIN direcciones PP ON A.rut = PP.rut INNER JOIN telefonos C ON PP.rut = C.rut  WHERE A.rut = $rut");*/

   $reporteCsv = mysqli_query($link, $sql_query); 
  while($filaR= $reporteCsv->fetch_array())
    fputcsv($salida, array($filaR['rut'], 
                $filaR['dv'],
                $filaR['nombre'],
                $filaR["cod_area"],
                $filaR["tel"],
                $filaR["dire"],
                $filaR["comuna"],
                $filaR["region"]));

}
}
}
}



?>