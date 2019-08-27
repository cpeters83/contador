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
                    

                    if (isset($_GET['id'])) {
                        try {
                          $connection = new PDO($dsn, $username, $password, $options);
                          $id = $_GET['id'];
                      
                          $sql = "SELECT * FROM Registro WHERE id = :id";
                          $statement = $connection->prepare($sql);
                          $statement->bindValue(':id', $id);
                          $statement->execute();
                          
                          $user = $statement->fetch(PDO::FETCH_ASSOC);
                        } catch(PDOException $error) {
                            echo $sql . "<br>" . $error->getMessage();
                        }
                      } else {
                          echo "Something went wrong!";
                          exit;
                      }


            ?>

<form id="contact-form" method="post" role="form">

<div class="messages"></div>

<div class="controls">

<?php foreach ($user as $row) : ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo escape($row["nombre"]); ?>">      
                <div class="help-block with-errors"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
               <label for="area">Area:</label>
                <input type="text" name="area" id="area" class="form-control" <?php echo escape($row["area"]); ?>  >      
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="fecha">Fecha de incidente:</label>
                <input class="form-control" type="date" id="fecha" name="fecha">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="hora">Hora de incidente:</label>
                <input class="form-control" type="time" id="hora" name="hora">
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="form_message">Comentario:</label>
                <textarea id="form_message" name="comentario" class="form-control" <?php echo escape($row["comentario"]); ?> rows="4"></textarea>
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <?php endforeach; ?>    
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary" name="submit" value="Submit" id="submit_form">Actualizar Registro</button>
        </div>
    </div>
 
</div>

</form>

  
            
        </div>
    </div>
   
   
<?php
include ("data/foot.php");
?>