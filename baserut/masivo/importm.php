<?php
include_once("db_connect.php");
?>

<!DOCTYPE html>
<html>

<head>
<title>Sistema para importar Datos al Sistema RuT</title>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>

    <div class="container" style="min-height:500px;">
    <div class=''>
    </div>
<div class="container">
    <h2>Sistema de busqueda masiva</h2> 
    <div class="panel panel-default">        
      

            <form action="descargar.php" method="post" enctype="multipart/form-data" id="import_form">        
            
            <div class="col-md-12">
              <br><br>
             <input type="submit" class="btn btn-primary col-6 mt-1" name="generar_reporte" value="DESCARGAR">
            </div>  
        </form>
            <br>

<?php
if(isset($_POST['import_data'])){    
    // validate to check uploaded file is a valid csv file
   
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
                ?>
                
                        <div class="row">
                <table class="table table-bordered">
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
                        </tr> 
                    </thead>
                    <tbody>
                    <?php
                        
                        /*WHERE A.rut = $rut ";*/
           $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
                        if(mysqli_num_rows($resultset)) { 
                        while( $rows = mysqli_fetch_assoc($resultset) ) { 
                        ?>
                        <tr>
                          <td><?php echo $rows['rut']; ?></td>
                          <td><?php echo $rows['dv']; ?></td>
                          <td><?php echo $rows['nombre']; ?></td>
                          <td><?php echo $rows['cod_area']; ?></td>
                          <td><?php echo $rows['tel']; ?></td>           
                          <td><?php echo $rows['dire']; ?></td>           
                          <td><?php echo $rows['comuna']; ?></td>           
                          <td><?php echo $rows['region']; ?></td>           
                        </tr>
                        <?php 
                      } 

                      } else { ?>  
                        <tr><td colspan="5">No records to display.....</td></tr>
                        <?php } ?>                  
                    </tbody>
                </table>
            </div>  

<?php

                        
            fclose($csv_file);
            $import_status = '?import_status=success'; 
        } //else {
            //$import_status = '?import_status=error';
       // }
    } //else {
      // $import_status = '?import_status=invalid_file';
   //}
}

}




    if(isset($_POST['generar_reporte'])) {
  // NOMBRE DEL ARCHIVO Y CHARSET
  header('Content-Type:text/csv; charset=latin1');
  header('Content-Disposition: attachment; filename="Reporte_Comuna.csv"');

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

   $reporteCsv = mysqli_query($conn, $sql_query); 
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

</div>
</div>
</div>

</body>

</html>