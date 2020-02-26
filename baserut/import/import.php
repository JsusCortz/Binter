<?php
include_once("db_connect.php");

if(isset($_POST['import_data'])){    
    // validate to check uploaded file is a valid csv file
   
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
   
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){
       
        if(is_uploaded_file($_FILES['file']['tmp_name'])){   
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');           
            //fgetcsv($csv_file);            
            // get data records from csv file
           
            while(($emp = fgetcsv($csv_file)) !== FALSE){
                // Check if employee already exists with same email
               
                $sql_query = "SELECT * FROM clientes WHERE cod_cli = '".$emp[0]."'";
               

                $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
				// if employee already exist then update details otherwise insert new record
                if(mysqli_num_rows($resultset)) {         

					$sql_update = "UPDATE clientes set cod_cli='".$emp[0]."',
                                                 rut='".$emp[1]."',
                                                 dv='".$emp[2]."',
                                                 nombre='".$emp[3]."' 
                                                WHERE cod_cli = '".$emp[0]."'";
                    mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));


                } else{
$mysql_insert = "INSERT INTO clientes (rut,dv,nombre )VALUES('".$emp[1]."','".$emp[2]."','".$emp[3]."')";
					mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));

$mysql_insert = "INSERT INTO direcciones (rut,dire,comuna,region )VALUES('".$emp[1]."','".$emp[6]."','".$emp[7]."', '".$emp[8]."')";
                    mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));

$mysql_insert = "INSERT INTO telefonos (rut,cod_area,tel )VALUES('".$emp[1]."','".$emp[4]."','".$emp[5]."')";
                    mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
                }
            }            
            fclose($csv_file);
            $import_status = '?import_status=success';
        } else {
            $import_status = '?import_status=error';
        }
    } else {
        $import_status = '?import_status=invalid_file';
    }
}
header("Location: index.php".$import_status);
?>