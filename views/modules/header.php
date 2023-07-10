<?php
$username = $_SESSION['username'];
$tipo_usuario = $_SESSION['tipo_usuario'];
$full_name = $_SESSION['full_name'];
$dni = $_SESSION['dni'];
$tipo = $_SESSION['tipo_boleta'];
$nombre_ugel = $_SESSION['nombre_ugel'];
$logo = $_SESSION['logo'];
$email = $_SESSION['email'];
$celular = $_SESSION['celular'];
?>
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
        </div>
    </div>
</div>
<div id="pcoded" class="pcoded">
    <div class="pcoded-container navbar-wrapper">

        <nav class="navbar header-navbar pcoded-header" header-theme="theme1">
            <div class="navbar-wrapper">

                <div class="navbar-logo">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="feather icon-menu"></i>
                    </a>
                    <a href="inicio">
                        <img class="img-logo" src="views/images/sbe.png" alt="Theme-Logo">
                    </a>
                    <a class="mobile-options">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>

                <div class="navbar-container container-fluid">
                    <div class="nav-left p-10 d-none info-ugel align-items-center justify-content-between d-lg-flex">
                        <a href="#!" onclick="javascript:toggleFullScreen()">
                            <i class="feather icon-maximize full-screen"></i>
                        </a>
                        <div class="ugel-img">
                            <img src="<?php echo $logo; ?>" alt="logo-ugel" class="img-fluid">
                        </div>                        
                        <p><?php echo $nombre_ugel; ?></p>
                    </div>
                    <ul class="nav-right info-user p-10">
                        <li class="user-profile">
                            <div>
                                <img src="views/images/user.png" class="img-radius" alt="User-Profile-Image">
                                <span><?php echo $full_name; ?></span>
                            </div>
                            <p class="datos"><span>DNI:</span> <span id="d"><?php echo $dni; ?></span></p>
                            <p class="datos"><span>Tipo:</span> <span id="t"><?php echo $tipo; ?></span></p>
                        </li>
                        <li>
                            <a href="salir" class="logout">
                                <i class="feather icon-log-out"></i> Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">