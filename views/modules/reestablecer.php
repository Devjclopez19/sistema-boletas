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
                <div class="col-md-4 p-0" style="background: #fff;" id="recuperar">
                    <!-- Authentication card start --> 
                        <form class="j-pro" method="post" @submit.prevent="recuperar" id="formRecuperar">             <input type="hidden" name="reestablecer">        
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-12 titulo-sistema">
                                            <h3 class="text-center">Recuperar Contraseña</h3>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="j-label">Ingrese el email asociado a su cuenta</label>
                                        <div class="j-unit">
                                            <div class="j-input">
                                                <label class="j-icon-left">
                                                    <i class="icofont icofont-envelope"></i>
                                                </label>
                                                <input 
                                                type="email" 
                                                id="email" 
                                                name="email"
                                                title="Ingrese un email válido!"
                                                @keyup="validateData"
                                                pattern="^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$"
                                                class="form-control"
                                                required
                                                >
                                            </div>
                                        </div>
                                        <transition name="fade">
                                            <span v-show="message.email"
                                            v-text="message.email" class="err-message"></span>
                                        </transition>
                                    </div>
                                    <div class="m-t-20">
                                        <label class="j-label">Ingrese su DNI</label>
                                        <div class="j-unit">
                                            <div class="j-input">
                                                <label class="j-icon-left">
                                                    <i class="icofont icofont-id-card"></i>
                                                </label>
                                                <input 
                                                    type="text" 
                                                    name="dni" 
                                                    @keyup="validateData"
                                                    pattern="^[0-9]+$"
                                                    title="Ingrese un DNI válido!"
                                                    required
                                                    class="form-control"
                                                    maxlength="8"
                                                    id="dni"
                                                >
                                            </div>
                                        </div>
                                        <transition name="fade">
                                            <span v-show="message.dni"
                                            v-text="message.dni" class="err-message"></span>
                                        </transition>
                                    </div>
                                    <span id="d" class="d-none"></span>
                                    <span id="t" class="d-none"></span>                                   
                                    <div class="row m-t-30 m-b-10">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block text-center f-w-600" v-bind:disabled="enviando" :class="enviando? 'disabled': ''">Recuperar Contraseña</button>
                                        </div>
                                    </div>
                                    <div class="send-mail" v-show="enviando">
                                        <div class="send-mail__img">
                                            <img src="views/images/spinner.gif" alt="" class="img-fluid">
                                        </div>
                                        <div class="send-mail__message">
                                            <p>Reestableciendo contraseña, espere un momento...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="registro-block">
                            <p style="font-size:14px;">Ingrese los datos requeridos, seguidamente se le enviará un correo con las instrucciones para recuperar su contraseña</p>
                            <p>Ya tiene una cuenta? <a href="login" class="text-primary">Iniciar Sesion <i class="icofont icofont-sign-out"></i></a></p>
                            <p>No está registrado? <a href="registro" class="text-primary">Registrese Aquí <i class="icofont icofont-sign-out"></i></a></p>
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