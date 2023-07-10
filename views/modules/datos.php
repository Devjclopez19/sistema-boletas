<?php
if(!$_SESSION['validar']){
	header('Location:login');
	exit();
}
if($_SESSION['tipo_usuario'] != 3){
    header('Location:inicio');
}
if((time() - $_SESSION['last_login']) > 900) {
    header('location:salir');
}
$pagina= "datos";
//echo $tipo_usuario;
include_once 'header.php';
include_once 'aside.php'; 
?>
<!-- Contenido Dinámico-->              
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body main-page">
            <div class="page-wrapper">
                <div class="page-title">
                    <h2>Administración de la Cuenta</h2>
                </div>
                <div class="page-content">
                    <div class="cuenta" id="datos">
                        <form @submit.prevent="sendForm" method="post" id="editarDatos">
                            <p>{{ formTitle }}</p>
                            <input type="hidden" name="datosP">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Usuario</label>
                                <div class="col-sm-9">
                                    <input type="text" name="username"  class="form-control" value="<?php echo $username; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ passTitle }}</label>
                                <div :class="editar ? 'col-sm-4':'col-sm-9'">
                                    <input type="password" class="form-control" v-bind:placeholder="editar ? '': '*******'" v-bind:readonly="!editar" 
                                    name="password" 
                                    required
                                    @keyup="validateData"
                                    title="Debe Ingresar su contraseña para realizar los cambios necesarios"
                                    >
                                    <transition name="fade">
                                        <span v-show="message.password"
                                        v-text="message.password" class="err-message"></span>
                                    </transition>
                                </div>
                                <div class="col-sm-4" v-show="editar">
                                    <input type="checkbox" name="cambiarP" id="cambiarP" v-model="cambiarP" class="m-t-5"> ¿Desea cambiar su contraseña?
                                </div>
                            </div>
                            <div class="form-group row" v-show="cambiarP">
                                <label class="col-sm-3 col-form-label">Nueva contraseña</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" v-bind:readonly="!editar" name="newP" 
                                    @keyup="validateData"
                                    pattern="^[a-z0-9A-Z_\-]+$"
                                    title="Ingrese solo números y letras"
                                    >
                                    <transition name="fade">
                                        <span v-show="message.newP"
                                        v-text="message.newP" class="err-message"></span>
                                    </transition>
                                </div>
                            </div>
                            <div class="form-group row" v-show="cambiarP">
                                <label class="col-sm-3 col-form-label">Repita nueva contraseña</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" v-bind:readonly="!editar" name="rnewP" 
                                    @keyup="validateData"
                                    pattern="^[a-z0-9A-Z_\-]+$"
                                    title="Ingrese solo números y letras"
                                    >
                                    <transition name="fade">
                                        <span v-show="message.rnewP"
                                        v-text="message.rnewP" class="err-message"></span>
                                    </transition>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nombres</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $full_name; ?>" v-bind:readonly="!editar" name="full_name" 
                                    @keyup="validateData"
                                    pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$"
                                    title="Caracteres no validos!"
                                    required>
                                    <transition name="fade">
                                        <span v-show="message.full_name"
                                        v-text="message.full_name" class="err-message"></span>
                                    </transition>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">DNI</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $dni; ?>" v-bind:readonly="!editar" required name="dni" 
                                    @keyup="validateData"                                  pattern="^[0-9]+$"
                                    title="Ingrese un DNI válido!"
                                    maxlength="8">
                                    <transition name="fade">
                                        <span v-show="message.dni"
                                        v-text="message.dni" class="err-message"></span>
                                    </transition>
                                </div>                                   
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $email; ?>" v-bind:readonly="!editar" required name="email" 
                                    @keyup="validateData"                                  pattern="^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$"
                                    title="Ingrese un email válido!"
                                    >
                                    <transition name="fade">
                                        <span v-show="message.email"
                                        v-text="message.email" class="err-message"></span>
                                    </transition>
                                </div>                                   
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Celular</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $celular; ?>" v-bind:readonly="!editar" required name="celular" 
                                    @keyup="validateData"                                  pattern="^[0-9]+$"
                                    title="Ingrese un celular válido!"
                                    maxlength="9"
                                    >
                                    <transition name="fade">
                                        <span v-show="message.celular"
                                        v-text="message.celular" class="err-message"></span>
                                    </transition>
                                </div>                                   
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-9 d-flex">                                    
                                    <button class="btn btn-primary" @click="habilitarForm" v-if="!editar"><i class="icofont icofont-ui-edit"></i> Editar Información</button>
                                    <button type="submit" class="btn btn-success m-b-10 m-r-5" v-if="editar"><i class="icofont icofont-save"></i> Guardar</button>
                                    <button class="btn btn-danger m-b-10" v-if="editar" @click="cancelar"><i class="icofont icofont-ui-close"></i> Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php' ?>

