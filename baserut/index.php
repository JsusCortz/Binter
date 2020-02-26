<!DOCTYPE html>
<html>
<head>
	<title>Sistema Rut</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


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
</style>
</head>

<body class="center">
    <div class="row">

          <div class="content container-fluid align-items-center justify-content-start col-12 text-center">
        	<img src="logo_binter.jpeg" width="350" height="180">
        	<h1 class="h1">Sistema Rut</h1>
        </div>

        

      <div class="content container-fluid align-items-center justify-content-start col-12 text-center">

    	<button  class="btn btn-primary col-3 mt-1" onclick="rut(1);">Unitario</button>

    	<button  class="btn btn-primary col-3 mt-1" onclick="rut(2);">Por Lote</button>

    	<button  class="btn btn-primary col-3 mt-1" onclick='window.location.href="masivo/index.php"'>Masivo</button>

    	<button  class="btn btn-primary col-5 mt-1" onclick="rut(4);">Por Comuna</button>

    	<button  class="btn btn-primary col-5 mt-1" onclick="rut(5);">Por Region</button>
      
      <button  class="btn btn-primary col-3 mt-1" onclick='window.location.href="import/index.php"'>Cargar Datos</button>

    	<br>	<br>

    <!--unitario-->
      <div id="simple" class="content  justify-content text-center hide">
    <form method="post" action="tbl_uni.php">
      	<div id="simple" class="content justify-content text-center">
        	<input type="number"  placeholder="Ingrese Rut" id="rut1" name="rut1" class="text-center" />	 <br>
        	<input class="btn btn-primary col-5 mt-1" type="submit"/>
      	</div>
        </form>
      </div>

    <!--lotes-->
      	<div id="lote" class="content  justify-content text-center hide">
      		<form method="post" action="tbl_lotes.php">
        <div id="simple" class="content justify-content text-center ">
          <input type="number"  placeholder="Ingrese Rut" id="rutmenor" name="rutmenor" required="required" />
          <input type="number"  placeholder="Ingrese Rut" id="rutmayor" name="rutmayor"  required="required"/>   <br>
          <input type="submit"/>
        </div>
        </form>
      	</div>

    <!--masivo-->
      	<div id="masivo" class="content justify-content text-center hide">
      		<input type="text"  placeholder="Ingrese Rut" /> 	<br>
      		<button class="btn btn-primary col-3 mt-2" onclick="table(3);">BUSCAR</button>
      	</div>

    	<!--comuna-->
      <div id="comuna" class="content  justify-content text-center hide"> 
      	<form method="post" action="tbl_comuna.php">
        <div id="simple" class="content justify-content text-center ">
          <input type="number"  placeholder="Ingrese Rut" id="rutmenor" name="rutmenor" required="required" />
          <input type="number"  placeholder="Ingrese Rut" id="rutmayor" name="rutmayor"  required="required"/>   <br>
          <input type="text"  placeholder="Ingrese Comuna" id="comuna1" name="comuna1"  required="required"/>   <br>
          <input type="submit"/>
        </div>
        </form>
          </div>

      	<!--region-->
      	<div id="region" class="content  justify-content text-center hide">     
        <form method="post" action="tbl_region.php">
        <div id="simple" class="content justify-content text-center ">
          <input type="number"  placeholder="Ingrese Rut" id="rutmenor" name="rutmenor" required="required" />
          <input type="number"  placeholder="Ingrese Rut" id="rutmayor" name="rutmayor"  required="required"/>   <br>
          <input type="text"  placeholder="Ingrese Region" id="region1" name="region1"  required="required"/>   <br>
          <input type="submit"/>
        </div>
        </form>
          </div>

     </div>
    </div>

    <div id="table1" class="content  justify-content text-center hide">
      <form method="post" id="addproduct" action="import.php" enctype="multipart/form-data" role="form">
  <div>
    <label class="col-lg-2 control-label">Archivo (.xlsx)*</label>
      <input type="file" name="name"  id="name" placeholder="Archivo (.xlsx)">
<br><br>
      <button type="submit" class="btn btn-primary">Importar Datos</button>
  </div>
</form>
    </div>

<script>


	function rut(idButton) {

 switch(idButton) {
 case 1:
          $('#simple').removeClass('hide');
          $('#lote').addClass('hide');
          $('#masivo').addClass('hide');
          $('#comuna').addClass('hide');
          $('#region').addClass('hide');
          $('#table1').addClass('hide');
    break;

 case 2:
          $('#simple').addClass('hide');
          $('#lote').removeClass('hide');
          $('#masivo').addClass('hide');
          $('#comuna').addClass('hide');
          $('#region').addClass('hide');
           $('#table1').addClass('hide');

    break;

 case 3:
          $('#simple').addClass('hide');
          $('#masivo').removeClass('hide');
          $('#lote').addClass('hide');
          $('#comuna').addClass('hide');
          $('#region').addClass('hide');
           $('#table1').addClass('hide');
    break;
 case 4:
         $('#simple').addClass('hide');
          $('#masivo').addClass('hide');
          $('#lote').addClass('hide');
          $('#comuna').removeClass('hide');
          $('#region').addClass('hide');
           $('#table1').addClass('hide');
    break;
    case 5:
         $('#simple').addClass('hide');
          $('#masivo').addClass('hide');
          $('#lote').addClass('hide');
          $('#comuna').addClass('hide');
          $('#region').removeClass('hide');
           $('#table1').addClass('hide');
    break;
     case 6:
         $('#simple').addClass('hide');
          $('#masivo').addClass('hide');
          $('#lote').addClass('hide');
          $('#comuna').addClass('hide');
          $('#region').addClass('hide');
           $('#table1').removeClass('hide');
    break;
    default:
          alert("OPCION INVALIDA.")
        }

   }

	function table(idButton) {

	

 switch(idButton) {
 case 1:
          $('#table1').removeClass('hide');
    break;

 case 2:
 $('#table1').removeClass('hide');
           
    break;
    case 3:
    $('#table1').removeClass('hide');
           
    break;

 case 4:
           $('#table1').removeClass('hide');
    break;

 case 5:
           $('#table1').removeClass('hide');
    break;



}
}

$(document).ready(function() {
    $('#example').DataTable();
} );
</script>


</body>
</html>