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
                    <h3>Registro de accidentes del area </h3>                    
                </div>
            </nav>

            <?php
            try {
                $connection = new PDO($dsn, $username, $password, $options);
                $sql = "SELECT * FROM Registro";
                $statement = $connection->prepare($sql);
                $statement->execute();
              
                $result = $statement->fetchAll();
              } catch(PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
              }
              ?>
            <div class="table-responsive-sm">
            <table class="table table bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Area</th>
                        <th>Fecha de accidente</th>
                        <th>Comentario</th>
                        <th>Edicion</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["nombre"]); ?></td>
            <td><?php echo escape($row["area"]); ?></td>
            <td><?php echo escape($row["fecha"]." ".$row["hora"]); ?></td>
            <td><?php echo escape($row["comentario"]); ?></td>
            <td><a href="update-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
            <td><a href="#">Eliminar</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>


            
            <div class="line"></div>

            
        </div>
    </div>
   
   
<?php
include ("data/foot.php");
?>