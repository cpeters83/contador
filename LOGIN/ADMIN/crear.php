<?php
include ("data/cabezera.php");
include ("data/conexion.php");
?>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4>Administración</h4>
            </div>
             <p>Usuario:  <?=$_SESSION['name']?></p>

            <ul class="list-unstyled components">
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <li>
                    <a href="crear.php">Crear Incidente</a>
                </li>
                <li>
                    <a href="list.php">Listado incidentes</a>
                </li>
                <li>
                    <a href="estadistica.php">Estadisticas</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                 <li>
                    <a href="http://172.16.20.118:4040" class="download">Contador</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
            </ul>
        </nav>


        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <h3>Crear registro de incidente</h3>
                </div>
            </nav>

            <?php
                    if (isset($_POST['submit'])) {
                        try  {
                            $connection = new PDO($dsn, $username, $password, $options);
                            $new_user = array(
                            "nombre" => $_POST['nombre'],
                            "area"  => $_POST['area'],
                            "fecha" => $_POST['fecha'],
                            "hora" => $_POST['hora'],
                            "comentario" => $_POST['comentario']
                            );

                            $sql = sprintf(
                            "INSERT INTO %s (%s) values (%s)",
                            "Registro",
                            implode(", ", array_keys($new_user)),
                            ":" . implode(", :", array_keys($new_user))
                            );
                            
                            $statement = $connection->prepare($sql);
                            $statement->execute($new_user);
                        


                        } catch(PDOException $error) {
                            echo $sql . "<br>" . $error->getMessage();
                        }
                        try{
                            $connection = new PDO($dsn, $username, $password, $options);

                            $user =["fecha"=> $_POST['fecha']];
                            $fecha = $_POST['fecha'];
                            $stmt = $connection->prepare('UPDATE fecha_historico SET fecha_inicial = :fecha');
                            $stmt->execute($user);
                           
                        }catch(PDOException $error) {
                            echo $sql . "<br>" . $error->getMessage();
                        }
                    }
                    ?>
                   
                    <?php if (isset($_POST['submit']) && $statement) : ?>

                        <div class="alert alert-success" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <strong>Registro ingresado con exito</strong>
                     </div>

                   
                    <?php endif; ?>

        <form id="contact-form" method="post" role="form">

<div class="messages"></div>

<div class="controls">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresar el nombre del afectado" required="required">      
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
               <label for="area">Area:</label>
                <input type="text" name="area" id="area" class="form-control" placeholder="Ingresar el area del afectado" required="required">      
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="fecha">Fecha de incidente:</label>
                <input class="form-control" type="date" id="fecha" name="fecha" required="required">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="hora">Hora de incidente:</label>
                <input class="form-control" type="time" id="hora" name="hora" required="required">
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="form_message">Comentario:</label>
                <textarea id="form_message" name="comentario" class="form-control" placeholder="Descripcion y comentarios del incidente" rows="4" required="required"></textarea>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary" name="submit" value="Submit" id="submit_form">Crear Nuevo Registro</button>
        </div>
    </div>
 
</div>

</form>

  
            
        </div>
    </div>
   
   
<?php
include ("data/foot.php");
?>