<nav class="pcoded-navbar navbar-left">
                    <div class="pcoded-inner-navbar main-menu">
                        <div class="pcoded-navigatio-lavel">Menu de Navegación</div>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="<?php if($pagina == 'inicio'){echo 'active';} ?>">
                                <a href="inicio">
                                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                    <span class="pcoded-mtext">Inicio</span>
                                </a>
                            </li>
                            <?php if($tipo_usuario == 2):?>
                            <li class="<?php if($pagina == 'cuenta'){echo 'active';} ?>">
                                <a href="cuenta">
                                    <span class="pcoded-micon"><i class="icofont icofont-gear"></i></span>
                                    <span class="pcoded-mtext">Administrar Cuenta</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if($tipo_usuario == 2):?>
                            <li class="<?php if($pagina == 'ugel'){echo 'active';} ?>">
                                <a href="ugel">
                                    <span class="pcoded-micon"><i class="icofont icofont-exclamation-circle"></i></span>
                                    <span class="pcoded-mtext">Información Ugel</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if($tipo_usuario == 3):?>
                            <li class="<?php if($pagina == 'datos'){echo 'active';} ?>">
                                <a href="datos">
                                    <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                                    <span class="pcoded-mtext">Datos Personales</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if($tipo_usuario == 2):?>
                            <li class="<?php if($pagina == 'usuarios'){echo 'active';} ?>">
                                <a href="usuarios">
                                    <span class="pcoded-micon"><i class="icofont icofont-users-alt-5"></i></span>
                                    <span class="pcoded-mtext">Usuarios del Sistema</span>
                                </a>
                            </li>
                            <li class="<?php if($pagina == 'cargar_boletas'){echo 'active';} ?>">
                                <a href="cargar_boletas">
                                    <span class="pcoded-micon"><i class="icofont icofont-upload"></i></span>
                                    <span class="pcoded-mtext">Cargar Boletas</span>
                                </a>
                            </li>
                            <li class="<?php if($pagina == 'consulta'){echo 'active';} ?>">
                                <a href="consulta">
                                    <span class="pcoded-micon"><i class="icofont icofont-document-search"></i></span>
                                    <span class="pcoded-mtext">Consultar Boletas</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if($tipo_usuario == 3):?>
                            <li class="<?php if($pagina == 'boletas'){echo 'active';} ?>">
                                <a href="boletas">
                                    <span class="pcoded-micon"><i class="icofont icofont-paper"></i></span>
                                    <span class="pcoded-mtext">Boletas de Pago</span>
                                </a>
                            </li>
                            <li class="<?php if($pagina == 'contacto'){echo 'active';} ?>">
                                <a href="contacto">
                                    <span class="pcoded-micon"><i class="icofont icofont-envelope-open"></i></span>
                                    <span class="pcoded-mtext">Contactanos</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="">
                                <a href="salir">
                                    <span class="pcoded-micon"><i class="icofont icofont-exit"></i></span>
                                    <span class="pcoded-mtext">Cerrar Sesion</span>
                                </a>
                            </li>
                        </ul>
                        <div class="dev">
                            <p>Desarrollado por <a href="https://espectrocreativo.com" target="_blank">Espectro Creativo</a> <i class="icofont icofont-medal"></i></p>
                        </div>
                    </div>
                </nav>