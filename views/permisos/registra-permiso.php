<?php
require_once '../../app/config/App.php';
?>

<?php
//Incluye la cabezera del DASBOARD y 2 secciones NAV + ASIDE
include_once '../includes/header.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php echo renderContentHeader("registro de permiso", "Lista Permiso", SERVERURL . "views/permisos/lista-permiso"); ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="" id="formulario-registro">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">Complete los datos</div>
                                    <div class="col-md-6 text-right">
                                        <a href="./lista-colaborador" class="btn btn-sm btn-primary">Mostrar lista</a>
                                    </div>
                                </div>
                            </div>
                            <div class="car-body">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="Colaborador">colaborador</label>
                                        <input type="text" class="form-control" id="Colaborador" autofocus required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="Dia">Dia</label>
                                        <input type="date" class="form-control" id="Dia" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="Tipo">Tipo</label>
                                        <input type="text" class="form-control" id="Tipo" autofocus required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="reset" class="btn btn-sm btn-outline-secondary">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-primary">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>