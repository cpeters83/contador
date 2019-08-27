<!DOCTYPE html>
<html lang="es">
<head>
  <title>Contador accidentes</title>
<!-- carga de bootstrap - jquery y set de dimensiones y hora de estilo -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style/stylegrad.css">

<!-- funcion para recargar contenedor de la hora -->
<script type="text/javascript">
$(document).ready( function(){
$('#hora').load(' #hora');
refresh();
refreshAt(0,01,02); 
});

function refresh()
{
	setTimeout( function(){
        $('#hora').load(' #hora');
        refresh();
        },1000);
}

//funcion para recargar pagina a las 00:00
function refreshAt(hours, minutes, seconds) {
    var now = new Date();
    var then = new Date();
	 

    if(now.getHours() > hours ||
       (now.getHours() == hours && now.getMinutes() > minutes) ||
        now.getHours() == hours && now.getMinutes() == minutes && now.getSeconds() >= seconds) {
        then.setDate(now.getDate() + 1);

    }
    then.setHours(hours);
    then.setMinutes(minutes);
    then.setSeconds(seconds);

    var timeout = (then.getTime() - now.getTime());
    setTimeout(function() { window.location.reload(true); }, timeout);
    refreshAt(0,1,02);  
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
$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
?>

<!--contenedor de titulos -->
<div class="row" id = "gradiente">
        <div class = "col-12">
            <p class="text-center"><h1 id = "blanco_cen" class="display-4">Gerencia Mantenimiento</h1></p>
            <p class="text-center"><h1><p id = "blanco_cen" class="display-4">Subgerencia Mantenimiento Líneas 6 y 3 </p></h1></p>
        </div>
        
         <!-- contenedor de Logo de metro-->
        <div class="container-fluid">
        <!-- image size 734x235   size 50  367x118    331x107   295x96-->
        <img src="imagenes/logo_dark.png" class="rounded mx-auto d-block" width="277" height="86" >
        </div>
</div>

<div class="container-fluid">

<!--contenedor hora para actualizar los valores-->
  <div id = "hora">
    <div class="row" id ="contenedorblanco">
    <div class="col-12"><h2><p id="azul">Hora <?php echo strftime("%H:%M:%S"); ?></p></h2></div>
    </div>
  </div>


<div class="row" id ="contenedorblanco">
 <div class="col-12"><h2><p id="azul"><?php echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ?></p></h2></div>
</div>

<div class="row" id = "contenedorblanco">
      <div class="col"><h2><p class = "text-right"  id="azul" >Llevamos</p></h2></div>
       <span class="border border-primary">
      <div class="col"><h2><p class = "text-center"  id="azul" ><?php echo $diff->format("%a"); ?></p></h2></div>
      </span>
      <div class="col"><h2><p class = "text-left"  id="azul" >días sin accidentes</p></h2></div>
</div>

<div class="row" id ="contenedorblanco">
    <div class="col"><h2><p class = "text-right"  id="azul">Record Anterior</p></h2></div>
    <span class="border border-primary"><div class="col"><h2><p class = "text-center"  id="azul"><?php echo $record; ?></p></h2></div></span>
    <div class="col"><h2><p class = "text-left"  id="azul">días sin accidentes</p></h2></div>
 </div>

<div class="row"id = "contenedorblanco">
 <div class="col-12"><h2><p class = "text-right" id = "azul"> </p></h2></div>
</div>
</div>

<!-- contenedor con frases para epp -->
<div class="row"> 
   <div class="container-fluid" id = "gradiente">
     <h2><p id= "white" class="text-center"> Recuerde siempre usar los elementos de proteccion personal</p><h2>
   </div>
 </div>

<!--contenedor con las imagenes de EPP -->
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