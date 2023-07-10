<?php
if(!$_SESSION['validar']){
	header('Location:login');
	exit();
}
if($_SESSION['tipo_usuario'] != 2){
    header('Location:inicio');
}
$pagina= "ugel";
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
                    <h2>Información de la Ugel</h2>
                </div>
                <div class="page-content">
                    <div class="cuenta" id="ugel">
                        <?php 
                            $ugel = new UgelController();
                            $infougel= $ugel->mostrarInfoUgel($_SESSION['id_ugel']);
                        ?>
                        <form @submit="sendForm" method="post" id="editarUgel" action="<?php $_SERVER['PHP_SELF'];?>">
                            <p>{{ formTitle }}</p>
                            <input type="hidden" name="id_ugel" value="<?php echo $_SESSION['id_ugel']; ?>">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ugel</label>
                                <div class="col-sm-9">
                                    <input 
                                    type="text" 
                                    name="razon_social"  
                                    class="form-control" 
                                    v-bind:readonly="!editar"
                                    value="<?php echo $infougel['razon_social']; 
                                    ?>"
                                    readonly 
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RUC</label>
                                <div class="col-sm-9">
                                    <input type="text" 
                                    class="form-control" 
                                    v-bind:readonly="!editar" 
                                    name="ruc" 
                                    required
                                    @keyup="validateData"
                                    title="Ingrese un RUC válido"
                                    value ="<?php echo $infougel['ruc']; ?>"
                                    maxlength="11"
                                    pattern="^[0-9]+$"
                                    >
                                    <transition name="fade">
                                        <span v-show="message.ruc"
                                        v-text="message.ruc" class="err-message"></span>
                                    </transition>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Director</label>
                                <div class="col-sm-9">
                                    <input 
                                    type="text" 
                                    class="form-control" 
                                    v-bind:readonly="!editar" 
                                    name="director" 
                                    @keyup="validateData"
                                    pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$"
                                    title="Ingrese solo letras"
                                    value="<?php echo $infougel['director']; ?>"
                                    required
                                    >
                                    <transition name="fade">
                                        <span v-show="message.director"
                                        v-text="message.director" class="err-message"></span>
                                    </transition>
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input 
                                    type="text" 
                                    class="form-control" 
                                    v-bind:readonly="!editar" 
                                    name="email" 
                                    @keyup="validateData"
                                    pattern="^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$"
                                    title="Ingrese un email válido"
                                    value="<?php echo $infougel['email']; ?>"
                                    required
                                    >
                                    <transition name="fade">
                                        <span v-show="message.email"
                                        v-text="message.email" class="err-message"></span>
                                    </transition>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Telefono</label>
                                <div class="col-sm-9">
                                    <input 
                                    type="text" 
                                    class="form-control" 
                                    value="<?php echo $infougel['telefono']; ?>" 
                                    v-bind:readonly="!editar" 
                                    name="telefono" 
                                    @keyup="validateData"
                                    pattern="^[0-9-]+$"
                                    title="Ingrese un teléfono válido!"
                                    required>
                                    <transition name="fade">
                                        <span v-show="message.telefono"
                                        v-text="message.telefono" class="err-message"></span>
                                    </transition>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Dirección</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="<?php echo $infougel['direccion']; ?>" v-bind:readonly="!editar" 
                                    required 
                                    name="direccion" 
                                    @keyup="validateData"
                                    title="Ingrese la dirección"
                                    >
                                    <transition name="fade">
                                        <span v-show="message.direccion"
                                        v-text="message.direccion" class="err-message"></span>
                                    </transition>
                                </div>
                                   
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-9 d-flex">                                  
                                    <button type="button"class="btn btn-primary" @click="habilitarForm" v-if="!editar"><i class="icofont icofont-ui-edit"></i> Editar Información</button>
                                    <button type="submit" class="btn btn-success m-b-10 m-r-5" v-if="editar" name="guardarInfo"><i class="icofont icofont-save"></i> Guardar</button>
                                    <button class="btn btn-danger m-b-10" v-if="editar" @click="cancelar"><i class="icofont icofont-ui-close"></i> Cancelar</button>
                                </div>
                            </div>
                        </form>
                        <?php
                            $ugel = new UgelController();
                            $ugel->editarUgel();
                        ?>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php' ?>

