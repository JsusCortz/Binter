<?php 

include_once("db_connect.php");
if(!empty($_GET['import_status'])) {
    switch($_GET['import_status']) {
        case 'success':
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Employee data inserted successfully.';
            break;
        case 'error':
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please try again.';
            break;
        case 'invalid_file':
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please upload a valid CSV file.';
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
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Sistema para exportar desde archivo</title>

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
	<h2>Sistema para exportar desde archivo</h2>	
    <?php if(!empty($import_status_message)){
        echo '<div class="alert '.$message_stauts_class.'">'.$import_status_message.'</div>';
    } ?>
    <div class="panel panel-default">        
        <div class="panel-body">
			<br>
			<div class="row">
				<form action="descargar.php" method="post" enctype="multipart/form-data" id="import_form">				
						<div class="col-md-12">
						<input type="file" name="file" />
						</div>
						<div class="col-md-12">
							<br><br><br>
						<!--<input type="submit" class="btn btn-primary col-6 mt-1" name="import_data" value="IMPORTAR">-->

						 <input type="submit" class="btn btn-primary col-6 mt-1" name="generar_reporte" value="DESCARGAR">
						</div>	
				</form>
						<div class="col-md-12">
						
					<br>  
				<a onclick="Mens();" class="btn btn-primary col-3 mt-2  text-white">Volver</a>

				<a href="../prueba.csv" download="Ejemplo_Importar.csv" class="btn btn-primary col-4 mt-2 text-white">Descargar Ejemplo</a>
							</div>					
							
				
			</div>
			<br>	
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