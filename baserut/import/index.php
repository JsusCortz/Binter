<?php 

include_once("db_connect.php");
if(!empty($_GET['import_status'])) {
    switch($_GET['import_status']) {
        case 'success':
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Datos Insertada Exitosamente';
            break;
        case 'error':
            $message_stauts_class = 'alert-warning';
            $import_status_message = 'Error: Por favor, Intente nuevamente';
            break;
        case 'invalid_file':
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Por favor, Cargue un archivo CSV valido';
            break;
        default:
            $message_stauts_class = '';
            $import_status_message = '';
    }
}
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
<!--<div role="navigation" class="navbar navbar-default navbar-static-top">
      <div class="container">
      
      </div>
    </div>-->
	
	<div class="container" style="min-height:500px;">
	<div class=''>
	</div>
<div class="container">
	<h2>Sistema para importar Datos al Sistema RuT</h2>	
    <?php if(!empty($import_status_message)){
        echo '<div class="alert '.$message_stauts_class.'">'.$import_status_message.'</div>';
    } ?>
    <div class="panel panel-default">        
        <div class="panel-body">
			<br>
			<div class="row">
				<form action="import.php" method="post" enctype="multipart/form-data" id="import_form">				
						<div class="col-md-12">
						<input type="file" name="file" />
						</div>
						<div class="col-md-12">
							<br><br><br>
						<input type="submit" class="btn btn-primary col-6 mt-1" name="import_data" value="IMPORTAR">
						</div>	
				</form>
						<div class="col-md-12">
						
					<br>  
				<a onclick="Mens();" class="btn btn-primary col-3 mt-2  text-white">Volver</a>

				<a href="../import.csv" download="Ejemplo_Importar.csv" class="btn btn-primary col-4 mt-2 text-white">Descargar Ejemplo</a>
							</div>					
							
				
			</div>
			<br>
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
						$sql = "SELECT 
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
						INNER JOIN telefonos C ON PP.rut = C.rut limit 10";
						/*WHERE A.rut = $rut ";*/
						$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
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
						<?php } } else { ?>  
						<tr><td colspan="5">No records to display.....</td></tr>
						<?php } ?>					
					</tbody>
				</table>
			</div>	
        </div>
    </div>		
	<!--<div style="margin:50px 0px 0px 0px;">
		<a class="btn btn-default read-more" style="background:#3399ff;color:white" href="http://www.phpzag.com/import-csv-file-into-mysql-using-php/" title="">Back to Tutorial</a>			
	</div>	-->	
</div>


<div class="insert-post-ads1" style="margin-top:20px;">

</div>
</div>

<script type="text/javascript">
 function Mens(){
   // var id_adm; 
        // id_adm= getUrlParameter('data1'); //1234;
          
            swal({
             title: `Menu Principal`,
             //text: "Expandir la Pantalla",
             type: "success",
             timer: 5000
        }, 
        function(){
             window.location.href = "../index.php";
        })


        } 
</script>



</body>

</html>