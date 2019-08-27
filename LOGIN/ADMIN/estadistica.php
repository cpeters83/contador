<?php
include ("data/cabezera.php");
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
                    <h3>Dashboard</h3>
                </div>
            </nav>

            <p>Sitio para administracion y registro de incidentes en area de mantenimiento V0.8</p>
            <div class="line"></div>

            <div class="col-md-4">
                            <div class="card ">
                                <div class="card-header ">
                                    <h4 class="card-title">Email Statistics</h4>
                                    <p class="card-category">Last Campaign Performance</p>
                                </div>
                                <div class="card-body ">
                                    <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Open
                                        <i class="fa fa-circle text-danger"></i> Bounce
                                        <i class="fa fa-circle text-warning"></i> Unsubscribe
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>

            
        </div>
    </div>
   
   
<?php
include ("data/foot.php");
?>