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
$pagina= "consulta";
//echo $tipo_usuario;
include_once 'header.php';
include_once 'aside.php'; 
?>
<!-- Contenido Dinámico-->              
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body main-page">
            <div class="page-wrapper" id="consulta">
                <div class="page-title">
                    <h2>Consultar Boletas de Pago</h2>
                </div>
                <div class="page-content">
                    <div class="cargar-boletas usuarios">
                        <form action="" method="post">
                            <div class="acciones">
                                <div class="row justify-content-center">
                                    <div class="col-md-2 p-md-0 m-b-10">
                                        <div class="select-b">
                                            <label for="dnib">DNI: </label>
                                            <input type="text" name="dnib" id="dnib" v-model="dnib" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 m-b-10">
                                        <div class="select-b">
                                            <label for="tipob">Tipo: </label>
                                            <select name="tipob" id="tipob" class="form-control" v-model="tipob" required>
                                                <option
                                                v-for="op in tipos"
                                                :value="op.id"
                                                v-text="op.name"
                                                v-bind:selected="tipob == op.id ? true : false"
                                                >
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 m-b-10">
                                        <div class="select-b">
                                            <label for="mesb">Mes: </label>
                                            <select name="mesb" id="mesb" class="form-control" v-model="mesb" required>
                                                <option
                                                v-for="op in meses"
                                                :value="op.id"
                                                v-text="op.name"
                                                v-bind:selected="mesb == op.id ? true : false"
                                                >
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 m-b-10">
                                        <div class="select-b">
                                            <label for="aniob">Año: </label>
                                            <select name="aniob" id="aniob" class="form-control" v-model="aniob" required>
                                                <option
                                                v-for="op in anios"
                                                :value="op.id"
                                                v-text="op.name"
                                                v-bind:selected="aniob == op.id ? true : false"
                                                >
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary" name="cargarBoleta">
                                            <i class="icofont icofont-search"></i> 
                                            Buscar Boleta
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="content-boleta">
                            <div class="boleta">
                                <pre>
                                <font size="2" face="Lucida Console"> 
                                <?php 
                                $boleta = new ConsultaController();
                                $boleta->cargarBoleta();
                                ?>
                                </font>
                                </pre>
                            </div>
                        </div> 
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php' ?>

