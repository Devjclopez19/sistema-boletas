<section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-md-4 p-0 area-logo">
                    <div class="login-logo">
                        <div class="login-logo__title">
                            <h2>Sistema de Boletas</h2>
                        </div>
                        <div class="login-logo__img d-none d-md-block">
                            <img src="views/images/computer.png" alt="logo.png" class="img-fluid">
                        </div>
                        <div class="login-logo__ugel">
                            <div class="row align-items-center">
                                <div class="col-md-4 d-none d-md-block">
                                    <img src="views/images/logo_espinar.png" alt="" class="img-fluid">
                                </div>
                                <div class="col-md-8">
                                    <div class="d-sm-block d-md-none img-mobile">
                                        <img src="views/images/logo_mobile.png" alt="" class="img-fluid ">
                                    </div>
                                    <h3 class="d-none d-md-block">Unidad de Gestión Educativa Local Espinar</h3>
                                </div>
                            </div>
                        </div>
                        <p class="d-none d-md-block">Sistema de Boletas Ugel v.1.0</p>
                    </div>
                </div>
                <div class="col-md-4 p-0" style="background: #fff;" id="login">
                    <!-- Authentication card start --> 
                        <form class="j-pro" method="post" action="<?php $_SERVER['PHP_SELF'];?>" @submit="validarDatos">                            
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row titulo-sistema">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Acceso al Sistema</h3>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="username" class="j-label">Usuario</label>
                                        <div class="j-unit">
                                            <div class="j-input">
                                                <label for="username" class="j-icon-left">
                                                    <i class="icofont icofont-user-male"></i>
                                                </label>
                                                <input 
                                                type="text" 
                                                name="username" 
                                                class="form-control" 
                                                required="" 
                                                placeholder="Usuario"
                                                @keyup="validateData"
                                                title="Ingrese su usuario"
                                                >
                                            </div>
                                            <transition name="fade">
                                                <span v-show="message.username"
                                                v-text="message.username" class="err-message"></span>
                                            </transition>
                                        </div>
                                    </div>
                                    <div class="pass">
                                        <label class="j-label">Contraseña</label>
                                        <div class="j-unit">
                                            <div class="j-input">
                                                <label class="j-icon-left" for="password">
                                                    <i class="icofont icofont-unlock"></i>
                                                </label>
                                                <label class="j-icon-right" for="password" @click="showPassword">
                                                    <i class="icofont" :class="passwordFieldType ==='password' ? 'icofont-eye': 'icofont-eye-blocked'"></i>
                                                </label>
                                                <input 
                                                :type="passwordFieldType"
                                                name="password" 
                                                class="form-control" 
                                                required="" 
                                                placeholder="Contraseña"
                                                title="Ingrese su contraseña"
                                                @keyup="validateData"
                                                >
                                            </div>
                                            <transition name="fade">
                                                <span v-show="message.password"
                                                v-text="message.password" class="err-message"></span>
                                            </transition>   
                                        </div>
                                    </div>
                                    <span id="d" class="d-none"></span>
                                    <span id="t" class="d-none"></span>
                                    <?php
                                        $login = new LoginController();
                                        $login->validarLogin();
                                    ?>                                    
                                    <div class="row div-btn-login">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block text-center m-b-20 f-w-600" name="ingresar">Ingresar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="registro-block">
                            <p>No está registrado? <a href="registro" class="text-primary">Regístrese Aquí <i class="icofont icofont-sign-out d-none d-md-inline-block"></i></a></p>
                            <p>Olvidó su contraseña? <a href="reestablecer" class="text-primary">Recuperar Contraseña <i class="icofont icofont-sign-out d-none d-md-inline-block"></i></a></p>
                            <p class="descargar"><a href="views/manuales/manual_usuario_sbe.pdf" target="_blank">Descargar Manuales <i class="icofont icofont-inbox"></i></a></p>
                        </div>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>