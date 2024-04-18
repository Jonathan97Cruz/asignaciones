<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../img/logo1.png" alt="Logo FS" width="150" height="70">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <?php
                if ($_SESSION['fa_rol'] == 1 || $_SESSION['fa_rol'] == 2) {
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" href="#" aria-expanded="false"><i class="fa-solid fa-house-user"></i> Folios</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" class="dropdown-item" aria-current="page"><i class="fa-solid fa-file-invoice"></i> Ingreso de folios</a>
                            </li>
                            <li>
                                <a href="acciones/listaFolios.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-list-check"></i> Listado de folios</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-hand-pointer"></i> Asignaciones</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="acciones/inspectores/asignaciones.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-user-check"></i> Mis asignaciones</a>
                            </li>
                            <!--<li>
                                    <a href="index.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-file-invoice"></i> Ingreso de asignaciones</a>
                                </li>-->
                            <li>
                                <a href="acciones/listadoAsignaciones.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-list-check"></i> Listado de asignaciones</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-hand-pointer"></i> Etiquetas</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="acciones/051/index.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-user-check"></i> Revisión de etiquetas</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="usuarios/agregarUsuario.php" class="nav-link active" aria-current="page"><i class="fa-solid fa-users"></i> Inspectores</a>
                    </li>
                <?php
                } elseif ($_SESSION['fa_rol'] == 3) {
                ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Asignaciones</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="acciones/inspectores/asignaciones.php" class="dropdown-item" aria-current="page">Mis asignaciones</a>
                            </li>
                        </ul>
                    </li>
                <?php
                } elseif ($_SESSION['fa_rol'] == 4) {
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" href="#" aria-expanded="false"><i class="fa-solid fa-house-user"></i> Folios</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" class="dropdown-item" aria-current="page"><i class="fa-solid fa-file-invoice"></i> Ingreso de folios</a>
                            </li>
                            <li>
                                <a href="acciones/listaFolios.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-list-check"></i> Listado de folios</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-hand-pointer"></i> Asignaciones</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="acciones/inspectores/asignaciones.php" class="dropdown-item" aria-current="page"><i class="fa-solid fa-user-check"></i> Mis asignaciones</a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <li class="nav-item">
                    <a href="../conexion/salir.php" class="nav-link active" aria-current="page"><i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i> Cerrar Sesión</a>
                </li>
            </ul>
            <ul class="navbar-nav me-5 my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <label style="color: white;">
                        <center><i class="fa-solid fa-user-tie"></i> Usuario</center><?php echo $_SESSION['fa_nombre'] . " " . $_SESSION['fa_apellido']; ?>
                    </label>
                </li>
            </ul>
        </div>
    </div>
</nav>