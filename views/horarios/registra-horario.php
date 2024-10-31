<?php
require_once '../../app/config/App.php';

//Incluye la cabezera del DASBOARD y 2 secciones NAV + ASIDE
include_once '../includes/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php echo renderContentHeader("registra Horario", "Lista horarios", "./lista-horario"); ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="" id="formulario-registro">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="row ">
                                    <div class="col-md-6">Horarios</div>
                                    <div class="col-md-6 text-right">
                                        <a href="./lista-horario" class="btn btn-sm btn-primary">Mostrar lista</a>
                                    </div>
                                </div>
                            </div>
                            <div class="car-body">
                                <div class="row">
                                   
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
<!-- /.content-wrapper -->

<?php
//Incluye las ultimas 2 secciones: ASIDE + FOOTER y <script>
require_once '../includes/footer.php';
?>