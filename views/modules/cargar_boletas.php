<?php
if(!$_SESSION['validar']){
	header('Location:login');
	exit();
}
if($_SESSION['tipo_usuario'] != 2){
    header('Location:inicio');
}
$pagina= "cargar_boletas";
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
                    <h2>Cargar Boletas Mensuales</h2>
                </div>
                <div class="page-content">
                    <div class="cargar-boletas usuarios" id="cargar-boletas">
                        <div class="acciones">
                            <div class="row">
                                <div class="col-md-3 m-b-10">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#c-boleta">
                                        <i class="icofont icofont-plus-circle"></i> 
                                        Agregar Boleta
                                    </button>
                                </div>
                                <div class="col-md-3 m-b-10">
                                    <div class="select-b">
                                        <label for="aniob">Año: </label>
                                        <select name="aniob" id="aniob" class="form-control" @change="filtrarBoleta" v-model="aniob">
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
                                    <div class="select-b">
                                        <label for="tipob">Boleta: </label>
                                        <select name="tipob" id="tipob" class="form-control" @change="filtrarBoleta" v-model="tipob">
                                            <option value="" disabled>Seleccione año</option>
                                            <option
                                            v-for="op in tipos"
                                            :value="op.id"
                                            v-text="op.name"
                                            v-bind:selected="'Activo' == op.id ? true : false"
                                            >
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div> 
                        <div class="modal fade" id="c-boleta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content modal-usuario">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center" id="exampleModalLabel">
                                            <i class="icofont icofont-plus-circle" v-show="!editar"></i> 
                                            <i class="icofont icofont-ui-edit" v-show="editar"></i>
                                            {{formTitle}}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeForm">
                                        <span aria-hidden="true"><i class="icofont icofont-close-squared"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.prevent="guardarBoleta" method="post" id="formBoleta" class="j-pro" enctype="multipart/form-data">
                                            <div class="row m-0 p-0">
                                                <input type="hidden" name="agregar" v-if="!editar">
                                                <input type="hidden" name="id_ugel" value="<?php echo $_SESSION['id_ugel']; ?>" v-if="!editar">
                                                <input type="hidden" name="id_boleta" v-if="editar" :value="id_boleta">
                                                <div class="col-md-6">
                                                    <div>
                                                        <label class="j-label">Año</label>
                                                        <div class="j-unit">
                                                            <div class="j-input">
                                                                <select name="anio" required v-model="anio" id="anio" v-bind:disabled="editar"
                                                                :class="editar? 'disabled':''">
                                                                    <option value="" disabled>Seleccione un año</option>
                                                                    <option
                                                                    v-for="op in anios"
                                                                    :value="op.id"
                                                                    v-text="op.name"
                                                                    v-bind:selected="anio == op.id ? true : false"
                                                                    >
                                                                    </option>
                                                                </select>
                                                            </div>   
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <label class="j-label">Mes</label>
                                                        </div>
                                                        <div class="j-unit">
                                                            <div class="j-input">
                                                                <select name="mes" required v-model="mes" v-bind:disabled="editar"
                                                                :class="editar? 'disabled':''">
                                                                    <option value="" disabled>Seleccione un mes</option>    
                                                                    <option
                                                                    v-for="op in meses"
                                                                    :value="op.id"
                                                                    v-text="op.name"
                                                                    v-bind:selected="anio == op.id ? true : false"
                                                                    >
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <label class="j-label">Tipo Boleta</label>
                                                        </div>
                                                        <div class="j-unit">
                                                            <div class="j-input">
                                                                <select name="tipo_boleta" required v-model="tipo_boleta" v-bind:disabled="editar"
                                                                :class="editar? 'disabled':''">
                                                                    <option value="" disabled>Seleccione tipo de boleta</option>
                                                                    <option
                                                                    v-for="op in tipos"
                                                                    :value="op.id"
                                                                    v-text="op.name"
                                                                    v-bind:selected="anio == op.id ? true : false"
                                                                    >
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <label class="j-label ">Periodo</label>
                                                        </div>
                                                        <div class="j-unit">
                                                            <div class="j-input">
                                                                <label class="j-icon-left" for="periodo">
                                                                    <i class="icofont icofont-ui-calendar"></i>
                                                                </label>
                                                                <input 
                                                                type="text" 
                                                                id="periodo" 
                                                                name="periodo"
                                                                title="Ingrese los datos solicitados"
                                                                @keyup="validateData"
                                                                pattern="^[a-z0-9A-Z_\-ÑñÁáÉéÍíÓóÚúÜü\s]+$"
                                                                required
                                                                >
                                                            </div>
                                                            <transition name="fade">
                                                                <span v-show="message.periodo"
                                                                v-text="message.periodo" class="err-message"></span>
                                                            </transition>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <div>
                                                            <label class="j-label">Descripción</label>
                                                        </div>
                                                        <div class="j-unit">
                                                            <div class="j-input">
                                                                <input type="text" name="descripcion" pattern="^[a-z0-9A-Z_\-ÑñÁáÉéÍíÓóÚúÜü\s]+$" title="solo letras y numeros">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <div v-if="editar" class="m-t-20">
                                                                <div class="d-flex">
                                                                    <input type="checkbox" name="editarBol" id="editarBol" v-model="editarBol">
                                                                    <label class="j-label " for="editarBol">¿Desea cambiar el archivo?</label>
                                                                </div>
                                                                <div class="j-unit"></div>
                                                            </div>
                                                            <label class="j-label " v-if="!editar">Cargar Boleta al sistema</label>
                                                        </div>
                                                        <div class="j-unit" v-show="!editar || editarBol">
                                                            <p class="title-instrucciones">Instrucciones</p>
                                                            <ul class="list-instrucciones form-control">
                                                                <li>- El archivo debe ser texto plano con extensión <b>.txt</b> y no exceder los <strong>10MB</strong></li>
                                                                <li>- Haga click en el boton o suelte el archivo en el area delimitada</li>
                                                                <li>- Un solo archivo por tipo de boleta</li>
                                                            </ul>
                                                        </div>
                                                    </div>                                               
                                                    <div v-show="!editar || editarBol">
                                                        <div class="j-unit">
                                                            <div class="j-input">
                                                                <input 
                                                                type="file" 
                                                                name="boleta"
                                                                id="boleta"
                                                                title="Seleccione o suelte un archivo"
                                                                v-bind:required="!editar"
                                                                accept="text/plain"
                                                                @change="verificarArchivo">
                                                            </div>
                                                            <transition name="fade">
                                                                <span v-show="message.boleta"
                                                                v-text="message.boleta" class="err-message"></span>
                                                            </transition>
                                                        </div>
                                                    </div> 
                                                    <div class="send-mail" v-show="enviando">
                                                        <div class="send-mail__img">
                                                            <img src="views/images/spinner.gif" alt="" class="img-fluid">
                                                        </div>
                                                        <div class="send-mail__message">
                                                            <p>Subiendo archivo, espere un momento...</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="closeForm"><i class="icofont icofont-close-squared-alt"></i> Cancelar</button>
                                                <button type="submit" class="btn btn-primary"><i class="icofont icofont-save"></i> {{ btnTitle }}</button>
                                            </div>                               
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="lista-usuarios">
                            <div class="table-responsive">
                                <table id="tabla-cboletas" class="table table-bordered table-striped table-hover  dt-responsive">
                                    <thead>
                                        <tr>
                                            <th>Año</th>
                                            <th>Mes</th>
                                            <th>Tipo Boleta</th>
                                            <th>Periodo</th>
                                            <th>descripción</th>
                                            <th>Fecha Registro</th>
                                            <th>Boleta</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="boleta in boletas" :key="boleta.id">
                                        <td>{{boleta.anio}}</td>
                                        <td>{{boleta.mes}}</td>
                                        <td>{{boleta.tipo_boleta}}</td>
                                        <td>{{boleta.periodo}}</td>
                                        <td>{{boleta.descripcion}}</td>
                                        <td>{{boleta.fecha_registro}}</td>
                                        <td>
                                            <a :href="boleta.link" target="_blank" class="link-boleta"><i class="icofont icofont-attachment"></i></a>
                                        </td>
                                        <td>
                                            <button class="btn-table" @click="editarBoleta(boleta)">
                                            <i class="icofont icofont-ui-edit"></i>
                                            </button>
                                            <button class="btn-table btn-del" @click="eliminarBoleta(boleta.id)">
                                            <i class="icofont icofont-ui-delete"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="errorBusqueda">
                                        <td colspan="8" class="text-center">No existen boletas que coincidan con el criterio de busqueda</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>   
                        <!-- Modal eliminar -->
                        <div class="modal fade" id="modal-eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content modal-usuario">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center" id="exampleModalLabel"><i class="icofont icofont-warning-circle"></i> Eliminar Boleta</h5>
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
                                                        <label class="j-label "><i class="icofont icofont-warning"></i> ¿Está Seguro de Eliminar la Boleta?</label>
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

