<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contador accidentes</title>
  <meta http-equiv=�Content-Type� content=�text/html; charset=UTF-8? />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>

#blanco {
  color: white;
  font-weight: bold;
  text-align: center;
}

#azul {
  color: #1D528B;
  font-weight: bold;
  text-align: center;
  opacity 1;
}

.bs-example  div[class^="col"] {
	border: 1px solid white;
	text-align: center;
	padding-top: 0px;
	padding-bottom: 10px;
	}

#white {
  color: white;
  font-weight: bold;
  text-align: center;

}

#contenedorazul {
      background: #1D528B;
      text-align: center;
      padding-top: 5px;
      padding-bottom: 5px;
     }

#contenedorblanco {
       
      text-align: center;
      padding-top: 0px;
      padding-bottom: 10px;
      color: #1D528B;
    

     }

#fondo {
	background-image: url('imagenes/20161021_031.jpg');
	background-size: 100% 100%;
        opacity: 1;
}


</style>

<script type="text/javascript">
    setTimeout
    window.onload = setupRefresh;
     
    function setupRefresh() {
      myVar = setTimeout("refreshPage();", 1000); // milliseconds
    }
      function refreshPage() {
       window.location = location.href;
    }    

    function stopCount(){
      clearTimeout(myVar);
     }
    
 </script>
 

<script>
function fecha() {
   xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText;
          }
        };
    xmlhttp.open("GET","update.php",true);
    xmlhttp.send(null);
    }

function newfecha() {
   xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText;
          }
        };
    xmlhttp.open("GET","hoy.php",true);
    xmlhttp.send(null);
    }


</script>

</head>
<body>
<?php
date_default_timezone_set("America/New_York");
$servername = "localhost";
$username = "root";
$password = "M3tr02017";
$dbname = "accidentes";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT fecha_inicial, fecha_record FROM fecha_historico";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
       $date=  $row["fecha_inicial"];
       $record=  $row["fecha_record"];
    }
}

$conn->close();
$then = new DateTime($date);
$now = new DateTime();
$sinceThen = $then->diff($now);
$diff=date_diff($then,$now);
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","S�bado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

if (strftime("%H") == "01"){
	
	$sql = "UPDATE fecha_historico SET fecha_record = ".$diff->format("%a")."";
	$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->query($sql) === TRUE) {
  
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();	
	
}






?> 

<div class="row" id = "contenedorazul">
 
<div class = "col-12">
   <p class="text-center"><h1 id = "blanco" class="display-4">Gerencia Mantenimiento</h1></p>
   <p class="text-center"><h1><p id = "blanco" class="display-4">Subgerencia Mantenimiento L&iacuteneas 6 y 3 </p></h1></p>
</div>

<div class="container-fluid">
<!-- image size 734x235   size 50  367x118    331x107   295x96-->
 <img src="imagenes/logo_dark.png" class="rounded mx-auto d-block" width="277" height="86" >
</div>
 
</div>

<div class="container-fluid">


<div class="row"id = "contenedorblanco">
 <div class="col-12"><h2><p class = "text-right" id = "azul">  </p></h2></div>
</div>



<div class="row" id = "contenedorblanco" >
  <div class="col-12"><h2><p class = "text-center" id = "azul">Hora <?php echo strftime("%H:%M:%S"); ?></p></h2></div>
</div>

<div class="row"id = "contenedorblanco">
 <div class="col-12"><h2><p class = "text-center" id = "azul"><?php echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ?></p></h2></div>
</div>

<div class="row" id = "contenedorblanco">
      <div class="col"><h2><p class = "text-right" id = "azul">Llevamos</p></h2></div>
       <span class="border border-primary">
      <div class="col"><h2><p class = "text-center" id = "azul"><?php echo $diff->format("%a"); ?></p></h2></div>
      </span>
      <div class="col"><h2><p class = "text-left" id = "azul">d&iacuteas sin accidentes</p></h2></div>
</div>


<div class="row" id = "contenedorblanco">
    <div class="col"><h2><p class = "text-right" id = "azul">Record Anterior</p></h2></div>
    <span class="border border-primary"><div class="col"><h2><p class = "text-center" id = "azul"><?php echo $record; ?></p></h2></div></span>
    <div class="col"><h2><p class = "text-left" id = "azul">d&iacuteas sin accidentes</p></h2></div>
 </div>

<div class="row"id = "contenedorblanco">
 <div class="col-12"><h2><p class = "text-right" id = "azul"> </p></h2></div>
</div>



</div>




<div class="row"> 
 <div class="container-fluid" id = "contenedorazul">
     <h2> <p id= "white"> Recuerde siempre usar los elementos de protecci&oacuten personal</p><h2>
  </div>
 </div>

 
 
<div class="row"> 
<div class="container-fluid" id = "contenedorblanco" >
<div class="text-center">
<img src="imagenes/botas.gif" class = "img-fluid" width="100" height="100">
<img src="imagenes/casco.gif"  class = "img-fluid" width="100" height="100">
<img src="imagenes/chaqueta.gif" class = "img-fluid"   width="100" height="100">
<img src="imagenes/lentes.gif" class = "img-fluid"   width="100" height="100">
<img src="imagenes/ropa.gif" class = "img-fluid"   width="100" height="100">
<img src="imagenes/mascarilla.gif" class = "img-fluid"   width="100" height="100">
<img src="imagenes/acustica.gif" class = "img-fluid"   width="100" height="100">

 </div>
 </div>
 </div>


















</body>
</html>