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

            <ul class="list-unstyled components">
                <li>
                    <a href="crear.php">Crear Incidente</a>
                </li>
                <li>
                    <a href="list.php">Listado incidentes</a>
                </li>
                <li>
                    <a href="#">Estadisticas</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                 <li>
                    <a href="http://172.16.20.118:4040" class="download">Contador</a>
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
                        "fecha" => $_POST['fecha']
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
                    }
                    ?>
                   
                    <?php if (isset($_POST['submit']) && $statement) : ?>
                        <blockquote><?php echo escape($_POST['nombre']); ?> successfully added.</blockquote>
                    <?php endif; ?>

                    <form method="post">
                        <label for="firstname">Nombre</label>
                        <input type="text" name="nombre" id="nombre">
                        <label for="lastname">Area</label>
                        <input type="text" name="area" id="area">
                        <label for="age">Comentario</label>
                        <input type="text" name="comentario" id="comentario">
                        <label for="age">Fecha de accidente</label>
                        <input class="form-control" type="date" id="fecha" name="fecha">
                        <label for="age">Hora de accidente</label>
                        <input class="form-control" type="time" id="hora" name = "hora">
                        <button type="submit" class="btn btn-primary" name="submit" value="Submit" id="submit_form">Crear Nuevo Registro</button>
                    
                    </form>

    






            
        </div>
    </div>
   
   
<?php
include ("data/foot.php");
?>