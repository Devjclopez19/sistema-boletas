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
$pagina= "boletas";
//echo $tipo_usuario;
include_once 'header.php';
include_once 'aside.php'; 
?>
<!-- Contenido Dinámico-->              
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body main-page">
            <div class="page-wrapper" id="boletasU">
                <div class="page-title">
                    <h2>Boletas de Pago - {{aniob}}</h2>
                </div>
                <div class="page-content">
                    <div class="cargar-boletas usuarios">
                        <div class="acciones">
                            <div class="row">
                                <div class="col-md-3 m-b-10">
                                    <div class="select-b">
                                        <label for="aniob">Año: </label>
                                        <select name="aniob" id="aniob" class="form-control" v-model="aniob">
                                            <option value="" disabled>Seleccione año</option>
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
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary m-auto d-block" @click="filtrarBoleta">
                                        <i class="icofont icofont-search"></i> 
                                        Mostrar Boletas
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="lista-usuarios">
                            <div class="table-responsive">
                                <table id="tabla-boletas" class="table table-bordered table-striped table-hover display">
                                    <thead>
                                        <tr>
                                            <th>Año</th>
                                            <th>Mes</th>
                                            <th>Tipo Boleta</th>
                                            <th>Periodo</th>
                                            <th>descripción</th>
                                            <th>Ver Boleta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="boleta in boletas" :key="boleta.id">
                                        <td>{{boleta.anio}}</td>
                                        <td>{{boleta.mes}}</td>
                                        <td>{{boleta.tipo_boleta}}</td>
                                        <td>{{boleta.periodo}}</td>
                                        <td>{{boleta.descripcion}}</td>
                                        <td>
                                            <button @click="verBoleta(boleta.mes,boleta.tipo_boleta,2)" class="btn-boleta" title="click para ver la boleta"><i class="icofont icofont-document-search"></i></button>
                                        </td>
                                    </tr>
                                    <tr v-if="errorBusqueda">
                                        <td colspan="8" class="text-center">No existen boletas que coincidan con el criterio de busqueda</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php' ?>

