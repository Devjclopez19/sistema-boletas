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
$pagina= "contacto";
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
                    <h2>Página de Contacto</h2>
                </div>
                <div class="page-content">
                    <div class="cuenta" id="contacto">
                        <form @submit.prevent="sendForm" method="post" id="editarContacto">
                            <p>Envianos un Mensaje</p>
                            <input type="hidden" name="contacto">
                            <input type="hidden" name="full_name" value="<?php echo $full_name; ?>">
                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Asunto</label>
                                <div class="col-sm-9">
                                    <input type="text" 
                                    class="form-control" 
                                    name="asunto" 
                                    @keyup="validateData"
                                    pattern="^[a-z0-9A-Z_\-ÑñÁáÉéÍíÓóÚúÜü\s]+$"
                                    title="Caracteres no validos!"
                                    required>
                                    <transition name="fade">
                                        <span v-show="message.asunto"
                                        v-text="message.asunto" class="err-message"></span>
                                    </transition>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mensaje</label>
                                <div class="col-sm-9">
                                    <textarea 
                                    class="form-control" 
                                    name="mensaje" 
                                    @keyup="validateData"
                                    pattern="^[a-z0-9A-Z_\-ÑñÁáÉéÍíÓóÚúÜü\s]+$"
                                    title="Caracteres no validos!"
                                    required
                                    rows="6"
                                    ></textarea>
                                    <transition name="fade">
                                        <span v-show="message.mensaje"
                                        v-text="message.mensaje" class="err-message"></span>
                                    </transition>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">                              <div class="send-mail" v-show="enviando">
                                        <div class="send-mail__img">
                                            <img src="views/images/spinner.gif" alt="" class="img-fluid">
                                        </div>
                                        <div class="send-mail__message">
                                            <p>Enviando Mensaje, espere un momento...</p>
                                        </div>
                                    </div>           
                                    <button type="submit" class="btn btn-primary" v-bind:disabled="enviando" :class="enviando? 'disabled': ''"><i class="icofont icofont-send-mail"></i> Enviar Mensaje</button>
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

