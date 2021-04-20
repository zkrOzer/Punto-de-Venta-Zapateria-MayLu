<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM proveedor;");

$articulos_x_pagina = 3;
$total_articulos_bd = $sentencia->rowCount();
$paginas = $total_articulos_bd / 3;
$paginas = ceil($paginas);
#echo $paginas;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
    <title>MayLu - Administrador</title>

    <!-- using online links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">

    <link rel="stylesheet" href="styles/estilos-principal.css">
    <link rel="stylesheet" href="styles/sidebar-themes.css">
    <link rel="stylesheet" href="styles/estilos-nuevoproducto.css">
    <link rel="stylesheet" href="styles/popups.css">
    <link rel="shortcut icon" type="image/png" href="img/icon.png" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
</head>

<body>

    <div id="container">
        <div class="overlay" id="overlay">
            <?php
            if (!$_GET) {
                header('Location:Proveedor-Administrador.php?pagina=1');
            }
            if ($_GET['pagina'] > $paginas) {
                header('Location:Proveedor-Administrador.php?pagina=1');
            }

            $iniciar = ($_GET['pagina'] - 1) * $articulos_x_pagina;
            //echo $iniciar;

            $sql_articulos = "SELECT * FROM proveedor LIMIT :inicar,:narticulos";
            $productosS = $base_de_datos->prepare($sql_articulos);
            $productosS->bindParam(':inicar', $iniciar, PDO::PARAM_INT);
            $productosS->bindParam(':narticulos', $articulos_x_pagina, PDO::PARAM_INT);
            $productosS->execute();

            $resultado_articulos = $productosS->fetchAll();
            ?>

            <div class="popup" id="popup">
                <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
                <h3>Agregar Proveedor</h3>
                <h4>Ingresa los datos</h4>
                <h5><label>*</label> Campos obligatorios</h5>
                <form method="post" action="nuevoProveedor.php">
                    <div class="contenedor-etiquetas">
                        <h4><label>*</label> Nombre</h4>
                        <h4><label>*</label> Agente</h4>
                        <h4><label>*</label> Direccion</h4>
                        <h4><label>*</label> Telefono</h4>
                        <h4><label>*</label> Correo</h4>
                    </div>
                    <div class="contenedor-inputs">

                        <input type="text" name="nombre_empresa" placeholder="Nombre de la empresa" onkeypress="return sololetras(event)" required>

                        <input type="text" name="nombre_agente" placeholder="Nombre del agente" onkeypress="return sololetras(event)" required>

                        <input type="text" name="direccion" placeholder="Direccion" required>

                        <input type="text" name="tel" placeholder="Telefono" onkeypress="return solonumeros(event)" required>

                        <input type="text" name="email" placeholder="Correo electrónico" required>

                    </div>
                    <br>
                    <input type="submit" class="btn-submit" name="guardar" value="Guardar">
                </form>
            </div>
        </div>
    </div>

    <div class="page-wrapper default-theme sidebar-bg bg1 toggled">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>

            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <nav id="sidebar" class="sidebar-wrapper">
                    <div class="sidebar-content">
                        <!-- sidebar-brand  -->
                        <div class="sidebar-item sidebar-brand">
                            <span align="center">
                                <i class="fa fa-shoe-prints"></i>
                                MayLú
                            </span>
                        </div>
                        <!-- sidebar-header  -->
                        <div class="sidebar-item sidebar-header d-flex flex-nowrap">
                            <div class="user-pic">
                                <img class="img-responsive img-rounded" src="img/user.png" alt="User picture">
                            </div>
                            <div class="user-info">
                                <span class="user-name"><strong>Carlos
                                        Loaeza</strong>
                                </span>
                                <span class="user-role">Administrador</span>
                                <span class="user-status">
                                    <i class="fa fa-circle"></i>
                                    <span>Online</span>
                                </span>
                            </div>
                        </div>
                        <!-- sidebar-menu  -->
                        <div class=" sidebar-item sidebar-menu">
                            <ul>
                                <li class="header-menu">
                                    <span>General</span>
                                </li>
                                <li>
                                    <a href="principal-admin.php">
                                        <i class="fa fa-tachometer-alt"></i>
                                        <span class="menu-text">Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="Punto-Venta-Admin.php">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="menu-text">Punto de Venta</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="Inventario-Administrador.php?pagina=1">
                                        <i class="fa fa-warehouse"></i>
                                        <span class="menu-text">Inventario</span>
                                    </a>
                                </li>
                                <li class="sidebar-dropdown">
                                    <a href="#">
                                        <i class="fa fa-file-invoice-dollar"></i>
                                        <span class="menu-text">Reportes</span>
                                        <span class="badge badge-pill badge-warning">New</span>
                                    </a>
                                    <div class="sidebar-submenu">
                                        <ul>
                                            <li>
                                                <a href="reportes.php?pagina=1"><i class="fa fa-list-ol"></i> Ventas
                                                </a>
                                            </li>
                                            <li>
                                                <a href="apartado2.php"><i class="fa fa-calendar-check"></i> Apartado <span class="badge badge-pill badge-warning">New</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="AdminCaja.php">
                                        <i class="fa fa-cash-register"></i>
                                        <span class="menu-text">Caja</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="apartado.php">
                                        <i class="fa fa-cart-plus"></i>
                                        <span class="menu-text">Apartados</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="Usuario-Administrador.php?pagina=1">
                                        <i class="fa fa-users"></i>
                                        <span class="menu-text">Usuarios</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="Proveedor-Administrador.php?pagina=1">
                                        <i class="fa fa-truck"></i>
                                        <span class="menu-text">Proveedores</span>
                                    </a>
                                </li>
                                <li class="header-menu">
                                    <span>Extra</span>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-question"></i>
                                        <span class="menu-text">Ayuda</span>
                                        <span class="badge badge-pill badge-primary">Prox</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-calendar"></i>
                                        <span class="menu-text">Calendario</span>
                                        <span class="badge badge-pill badge-primary">Prox</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="btnabrir">
                                        <i class="fa fa-power-off"></i>
                                        <span class="menu-text" onclick="cierra()">Cerrar sesión</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- sidebar-menu  -->
                    </div>
                    <div class="sidebar-footer">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-laptop-code"></i>
                                <i class="fa fa-terminal"></i>
                                <span> codiguITO</span>
                            </a>
                        </div>
                    </div>

                </nav>
            </div>

        </nav>
        <!-- contenido  -->
        <main class="page-content pt-2">

            <div class="fondo_transparente">
                <div class="modal">
                    <div class="modal_titulo">ADVERTENCIA</div>
                    <div class="modal_mensaje">
                        <p>¿Seguro que desea salir?</p>
                    </div>
                    <div class="modal_botones">
                        <a href="login.php" class="boton" id="btn-yes">SI</a>
                        <a href="#" class="boton" id="btn-no" onclick="NO()">NO</a>
                    </div>
                </div>
            </div>

            <div id="overlay" class="overlay"></div>
            <section id="main-content">

                <article>
                    <div id="divnombre">
                        <p id="pnombre"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg> Nombre</p>
                    </div>
                    <div id="divcerrar">
                        <a href="login.php">
                            <button class="btn-tiny btn-danger">
                                Cerrar Sesión <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                </svg>
                            </button>
                        </a>
                    </div>
                    <header id="encabezado">
                        <img id="img-inventario" class="img-responsive img-rounded" src="img/prove.png" height="150" width="150" alt="Proveedor picture">
                        <br>
                        <br>
                        <h1>Proveedores</h1>
                    </header>


                    <div id="container1">

                        <form>
                            <div class="field" id="searchform">
                                <input type="text" id="searchterm" name="introducemodelo" placeholder="Ingresar nombre del proveedor" required />
                                <input class="btn btn" type="submit" id="search" value="Buscar" />
                                <button type="button" id="btn-abrir-popup"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                    </svg> Agregar</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_GET['introducemodelo'])) {
                            $sentencia = $base_de_datos->query("SELECT * FROM proveedor where nombre_empresa = '" . $_GET['introducemodelo'] . "';");
                        }
                        $proveedores = $sentencia->fetchAll(PDO::FETCH_OBJ);
                        ?>
                    </div>
                    <div class="table-responsive">
                        <br>
                        <table border="1" class="table table-hover table-bordered" id="tablee">
                            <thead>
                                <tr>
                                    <th>Nombre empresa</th>
                                    <th>Nombre agente</th>
                                    <th>Direccion</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($resultado_articulos as $proveedor) { ?>
                                    <tr>
                                        <td><?php echo $proveedor->nombre_empresa ?></td>
                                        <td><?php echo $proveedor->nombre_agente ?></td>
                                        <td><?php echo $proveedor->direccion ?></td>
                                        <td><?php echo $proveedor->tel ?></td>
                                        <td><?php echo $proveedor->email ?></td>
                                        <td>
                                            <a class="btn actualiza-tabla" href="<?php echo "ActualizarProveedor.php?id_proveedor=" . $proveedor->id_proveedor ?>"><i class="fa fa-edit"></i> Editar</a>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <div class="d-flex flex-row-reverse">
                            <nav aria-label="Page navigation example">

                                <ul class="pagination ">
                                    <li class="page-item
                        <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>
                        ">

                                        <a class="page-link" href="Proveedor-Administrador.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">
                                            Anterior
                                        </a>
                                    </li>

                                    <?php for ($i = 0; $i < $paginas; $i++) : ?>

                                        <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>">
                                            <a class="page-link" href="Proveedor-Administrador.php?pagina=<?php echo $i + 1 ?>">
                                                <?php echo $i + 1 ?>
                                            </a>
                                        </li>
                                    <?php endfor ?>



                                    <li class="page-item
                    <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>
                    "><a class="page-link" href="Proveedor-Administrador.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
                                </ul>
                            </nav>
                        </div>
                        <br>
                    </div>

                </article>
            </section>
        </main>
    </div>
    <!-- using online scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>

    <script src="js/popups.js"></script>
    <script src="js/administrador/principal-admin.js"></script>
    <script src="js/administrador/validacion.js"></script>

</body>

</html>