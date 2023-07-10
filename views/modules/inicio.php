<?php
if(!$_SESSION['validar']){
	header('Location:login');
	exit();
}
if((time() - $_SESSION['last_login']) > 900) {
    header('location:salir');
}
$pagina= "inicio";
//echo $tipo_usuario;
include_once 'header.php';
include_once 'aside.php'; 
?>
<!-- Contenido Dinámico-->              
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <div class="inicio">
                    <h2>Bienvenidos al Sistema de Boletas</h2>
                    <p>Elija la operación que desee realizar:</p>
                    <div class="row m-0">
                        <?php if($tipo_usuario == 2):?>
                        <div class="col-md-4 m-b-10 col-lg-3">
                            <div class="navegacion nav-1">
                            <a href="cuenta">
                                <span class="pcoded-micon"><i class="icofont icofont-gear"></i></span>
                                <span class="pcoded-mtext">Administrar Cuenta</span>
                            </a>
                            </div>
                        </div>
                        <div class="col-md-4 m-b-10 col-lg-3">
                            <div class="navegacion nav-2">
                                <a href="ugel">
                                    <span class="pcoded-micon"><i class="icofont icofont-exclamation-circle"></i></span>
                                    <span class="pcoded-mtext">Información Ugel</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 m-b-10 col-lg-3">
                            <div class="navegacion nav-7">
                                <a href="usuarios">
                                    <span class="pcoded-micon"><i class="icofont icofont-users-alt-5"></i></span>
                                    <span class="pcoded-mtext">Usuarios</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 m-b-10 col-lg-3">
                            <div class="navegacion nav-5">
                                <a href="cargar_boletas">
                                    <span class="pcoded-micon"><i class="icofont icofont-upload"></i></span>
                                    <span class="pcoded-mtext">Cargar Boletas</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 m-b-10 col-lg-3">
                            <div class="navegacion nav-6">
                                <a href="consulta">
                                    <span class="pcoded-micon"><i class="icofont icofont-document-search"></i></span>
                                    <span class="pcoded-mtext">Consultar Boletas</span>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($tipo_usuario == 3):?>
                        <div class="col-md-4 m-b-10 col-lg-3">
                            <div class="navegacion nav-1">
                                <a href="datos">
                                    <span> 
                                        <i class="feather icon-user"></i>
                                    </span>
                                    <span>
                                        Datos Personales
                                    </span>    
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 m-b-10 col-lg-3">
                            <div class="navegacion nav-2">
                                <a href="boletas">
                                    <span> 
                                        <i class="icofont icofont-paper"></i>
                                    </span>
                                    <span>
                                        Boletas de Pago
                                    </span>    
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 m-b-10 col-lg-3">
                            <div class="navegacion nav-3">
                                <a href="contacto">
                                    <span> 
                                        <i class="icofont icofont-envelope-open"></i>
                                    </span>
                                    <span>
                                        Contactanos
                                    </span>    
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-4 m-b-10 col-lg-3">
                            <div class="navegacion nav-4">
                                <a href="salir">
                                    <span> 
                                        <i class="icofont icofont-exit"></i>
                                    </span>
                                    <span>
                                        Cerrar Sesion
                                    </span>    
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php' ?>

