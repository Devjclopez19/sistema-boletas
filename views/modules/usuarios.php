<?php
if(!$_SESSION['validar']){
	header('Location:login');
	exit();
}
if($_SESSION['tipo_usuario'] != 2){
    header('Location:inicio');
}
if((time() - $_SESSION['last_login']) > 900) {
    header('location:salir');
}
$pagina= "usuarios";
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
                    <h2>Usuarios del Sistema</h2>
                </div>
                <div class="page-content">
                    <div class="usuarios" id="usuarios">
                        <div class="btn-agregar">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#usuario">
                                <i class="icofont icofont-plus-circle"></i> 
                                Agregar Usuario
                            </button>
                        </div> 
                        <div class="modal fade" id="usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content modal-usuario">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center" id="exampleModalLabel"><i class="icofont icofont-plus-circle" v-show="!editar"></i> 
                                            <i class="icofont icofont-ui-edit" v-show="editar"></i> {{formTitle}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeForm">
                                        <span aria-hidden="true"><i class="icofont icofont-close-squared"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.prevent="guardarUsuario" method="post" id="formUsuario" class="j-pro">
                                            <div class="row m-0 p-0">
                                                <input type="hidden" name="agregar" v-if="!editar">
                                                <input type="hidden" name="id_ugel" value="<?php echo $_SESSION['id_ugel']; ?>" v-if="!editar">
                                                <input type="hidden" name="id_user" v-if="editar">
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
                                                                title="Nombre Completo"
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
                                                                title="Ingrese un DNI válido!"
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
                                                                    <option value="" v-bind:selected="tipo_boleta ==''? true : false">Seleccione tipo de Boleta</option>
                                                                    <option value="activo" v-bind:selected="tipo_boleta =='activo'? true : false">Trabajador Activo</option>
                                                                    <option value="nombrado" v-bind:selected="tipo_boleta =='nombrado'? true : false">Nombrado</option>
                                                                    <option value="contratado" v-bind:selected="tipo_boleta =='contratado'? true : false">Contratado</option>
                                                                    <option value="judicial" v-bind:selected="tipo_boleta =='judicial'? true : false">Judicial</option>
                                                                    <option value="cesante-tit" v-bind:selected="tipo_boleta =='cesante-tit'? true : false">Cesante Titular</option>
                                                                    <option value="cesante-sob" v-bind:selected="tipo_boleta =='cesante-sob'? true : false">Cesante - Viudez/Orfandad</option>
                                                                    <option value="cafae" v-bind:selected="tipo_boleta =='cafae'? true :false">Cafae</option>
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
                                                                title="Email"
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
                                                                title="N° de Celular"
                                                                @keyup="validateData"
                                                                pattern="^[0-9]+$"
                                                                maxlength="9"
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
                                                                title="Ingrese solo letras y numeros sin espacios en blanco"
                                                                @keyup="validateData"
                                                                pattern="^[a-z0-9A-Z_\-]+$"
                                                                required
                                                                @blur="verificarUsuario"
                                                                v-bind:disabled="editar"
                                                                class="form-control"
                                                                >
                                                            </div>
                                                            <transition name="fade">
                                                                <span v-show="message.username"
                                                                v-text="message.username" class="err-message"></span>
                                                            </transition>
                                                        </div>
                                                    </div>
                                                    <div v-if="editar" class="m-t-20">
                                                        <div class="d-flex">
                                                            <input type="checkbox" name="editarPass" id="editarPass" v-model="editarPass">
                                                            <label class="j-label " for="editarPass">¿Desea modificar la contraseña?</label>
                                                        </div>
                                                        <div class="j-unit"></div>
                                                    </div>
                                                    <div v-if="editarPass || !editar">
                                                        <div>
                                                            <label class="j-label ">Contraseña <small>(Acceso al sistema)</small></label>       <div class="j-unit">
                                                                <div class="j-input">
                                                                    <label class="j-icon-left" for="password">
                                                                        <i class="icofont icofont-lock" ></i>
                                                                    </label>
                                                                    <label class="j-icon-right">
                                                                        <i class="icofont icofont-refresh" @click="generarPass"></i>
                                                                    </label>
                                                                    <input 
                                                                    type="text" 
                                                                    id="password" 
                                                                    name="password"
                                                                    title="Ingrese solo letras y números"
                                                                    class="form-control"
                                                                    @keyup="validateData"
                                                                    pattern="^[a-z0-9A-Z_\-]+$"
                                                                    required
                                                                    :value="passValue"
                                                                    >
                                                                </div>
                                                                <transition name="fade">
                                                                    <span v-show="message.password"
                                                                    v-text="message.password" class="err-message"></span>
                                                                </transition>
                                                            </div>                                                
                                                        </div>
                                                    </div>
                                                    <div class="send-mail" v-show="enviando">
                                                        <div class="send-mail__img">
                                                            <img src="views/images/spinner.gif" alt="" class="img-fluid">
                                                        </div>
                                                        <div class="send-mail__message">
                                                            <p>Registrando usuario, espere un momento...</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeForm" v-bind:disabled="enviando" :class="enviando? 'disabled': ''"><i class="icofont icofont-close-squared-alt"></i> Cancelar</button>
                                                <button type="submit" class="btn btn-primary" v-bind:disabled="enviando" :class="enviando? 'disabled': ''"><i class="icofont icofont-save"></i> {{ btnTitle }}</button>
                                            </div>                               
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="lista-usuarios">
                            <div class="table-responsive">
                                <table id="tabla-usuarios" class="table table-bordered table-striped table-hover  dt-responsive">
                                    <thead>
                                        <tr>
                                            <th>Nombres y Apellidos</th>
                                            <th>DNI</th>
                                            <th>Tipo</th>
                                            <th>Email</th>
                                            <th>Celular</th>
                                            <th>Acciones</th>
                                            <th>F.Registro</th>
                                            <th>F.Acceso</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>   
                        <!-- Modal eliminar -->
                        <div class="modal fade" id="modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content modal-usuario">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center" id="exampleModalLabel"><i class="icofont icofont-users-alt-4"></i> Eliminar Usuario</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="icofont icofont-close-squared"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.prevent="eliminar" method="post" id="formEliminar" class="j-pro">
                                            <div class="row m-0 p-0 justify-content-center">
                                                <input type="hidden" name="id_user" :value="idEliminar">
                                                <div>
                                                    <div class="alert alert-danger text-center">
                                                        <label class="j-label "><i class="icofont icofont-warning"></i> ¿Está Seguro de Eliminar al Usuario?</label>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="icofont icofont-ui-close"></i> Cancelar</button>
                                                <button type="submit" class="btn btn-danger"><i class="icofont icofont-ui-delete"></i> Eliminar</button>
                                            </div>                               
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php' ?>

