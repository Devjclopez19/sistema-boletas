<section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row justify-content-center">
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
                <div class="col-md-8 p-0" style="background: #fff;" id="registro">                    
                        <form class="j-pro" @submit.prevent="sendForm" id="formRegistro">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-12 titulo-sistema">
                                            <h3 class="text-center">Registro de Usuarios</h3>
                                        </div>
                                    </div>
                                    <input type="hidden" name="registrar">
                                    <div class="row m-0 p-0">
                                        <div class="col-md-6">
                                            <div>
                                                <label class="j-label">Nombre Completo</label>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="full_name">
                                                            <i class="icofont icofont-ui-user"></i>
                                                        </label>
                                                        <input 
                                                        type="text" 
                                                        name="full_name" 
                                                        required 
                                                        @keyup="validateData"
                                                        pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$"
                                                        title="Ingrese solo letras!"
                                                        class=""
                                                        id="full_name"
                                                        >
                                                    </div>
                                                    <transition name="fade">
                                                        <span v-show="message.full_name"
                                                        v-text="message.full_name" class="err-message"></span>
                                                    </transition>   
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <label class="j-label">DNI</label>
                                                </div>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="dni">
                                                            <i class="icofont icofont-id-card"></i>
                                                        </label>
                                                        <input 
                                                        type="text" 
                                                        name="dni" 
                                                        @keyup="validateData"
                                                        pattern="^[0-9]+$"
                                                        title="Ingrese un DNI válido"
                                                        required
                                                        class=""
                                                        maxlength="8"
                                                        id="dni"
                                                        >
                                                    </div>
                                                    <transition name="fade">
                                                        <span v-show="message.dni"
                                                        v-text="message.dni" class="err-message"></span>
                                                    </transition>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <label class="j-label">Tipo de Usuario</label>
                                                </div>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <select name="tipo_boleta" required>
                                                            <option value="" disabled selected>Seleccione tipo de Boleta</option>
                                                            
                                                            <option value="nombrado">Nombrado</option>
                                                            <option value="contratado">Contratado</option>
                                                            <option value="judicial">Judicial</option>
                                                            <option value="cesante-tit">Cesante Titular</option>
                                                            <option value="cesante-sob">Cesante - Viudez/Orfandad </option>
                                                            <option value="cafae">Cafae</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <label class="j-label">Email</label>
                                                </div>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="email">
                                                            <i class="icofont icofont-envelope"></i>
                                                        </label>
                                                        <input 
                                                        type="email" 
                                                        id="email" 
                                                        name="email"
                                                        title="Ingrese un email válido"
                                                        @keyup="validateData"
                                                        pattern="^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$"
                                                        class=""
                                                        required
                                                        >
                                                    </div>
                                                    <transition name="fade">
                                                        <span v-show="message.email"
                                                        v-text="message.email" class="err-message"></span>
                                                    </transition>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <div>
                                                    <label class="j-label ">N° Celular</label>
                                                </div>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="celular">
                                                            <i class="icofont icofont-iphone"></i>
                                                        </label>
                                                        <input 
                                                        type="text" 
                                                        id="celular" 
                                                        name="celular"
                                                        title="Ingrese un celular válido"
                                                        @keyup="validateData"
                                                        pattern="^[0-9]+$"
                                                        maxlength="9"
                                                        required
                                                        >
                                                    </div>
                                                    <transition name="fade">
                                                        <span v-show="message.celular"
                                                        v-text="message.celular" class="err-message"></span>
                                                    </transition>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <label class="j-label ">Usuario <small>(Acceso al sistema)</small></label>
                                                </div>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="username">
                                                            <i class="icofont icofont-ui-check"></i>
                                                        </label>
                                                        <input 
                                                        type="text" 
                                                        id="username" 
                                                        name="username"
                                                        title="Solo se permite letras, numeros, - (guión) y _ (guión bajo)"
                                                        @keyup="validateData"
                                                        pattern="^[a-z0-9A-Z_\-]+$"
                                                        required
                                                        @blur="verificarUsuario"
                                                        >
                                                    </div>
                                                    <transition name="fade">
                                                        <span v-show="message.username"
                                                        v-text="message.username" class="err-message"></span>
                                                    </transition>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <label class="j-label ">Contraseña <small>(Acceso al sistema)</small></label>                                                        
                                                </div>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="password">
                                                            <i class="icofont icofont-lock" ></i>
                                                        </label>
                                                        <label class="j-icon-right" @click="showPassword">
                                                            <i class="icofont" :class="passwordFieldType ==='password' ? 'icofont-eye': 'icofont-eye-blocked'"></i>
                                                        </label>
                                                        <input 
                                                        :type="passwordFieldType" 
                                                        id="password" 
                                                        name="password"
                                                        title="Ingrese solo letras y números"
                                                        @keyup="validateData"
                                                        pattern="^[a-z0-9A-Z_\-]+$"
                                                        required
                                                        >
                                                    </div>
                                                    <transition name="fade">
                                                        <span v-show="message.password"
                                                        v-text="message.password" class="err-message"></span>
                                                    </transition>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <label class="j-label ">Repita la Contraseña</label>                                                        
                                                </div>
                                                <div class="j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="password2">
                                                            <i class="icofont icofont-lock" ></i>
                                                        </label>
                                                        <label class="j-icon-right" @click="showPassword">
                                                            <i class="icofont" :class="passwordFieldType ==='password' ? 'icofont-eye': 'icofont-eye-blocked'"></i>
                                                        </label>
                                                        <input 
                                                        :type="passwordFieldType" 
                                                        id="password2" 
                                                        name="password2"
                                                        title="Ingrese solo letras y números"
                                                        @keyup="validateData"
                                                        pattern="^[a-z0-9A-Z_\-]+$"
                                                        required
                                                        >
                                                    </div>
                                                    <transition name="fade">
                                                        <span v-show="message.password2"
                                                        v-text="message.password2" class="err-message"></span>
                                                    </transition>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span id="d" class="d-none"></span>
                                    <span id="t" class="d-none"></span>
                                    <div class="j-footer text-left">
                                        <button type="submit" class="btn btn-primary" v-bind:disabled="enviando" :class="enviando? 'disabled': ''">Registrarse</button>
                                        <div class="send-mail" v-show="enviando">
                                            <div class="send-mail__img">
                                                <img src="views/images/spinner.gif" alt="" class="img-fluid">
                                            </div>
                                            <div class="send-mail__message">
                                                <p>Registrando usuario, espere un momento...</p>
                                            </div>
                                        </div>
                                        Ya tiene una cuenta? <a href="login" class="text-primary" style="font-size:15px;text-decoration:underline;">Iniciar Sesion</a>
                                    </div>
                                </div>
                        </form>
                </div>
            </div>
        </div>
    </section>