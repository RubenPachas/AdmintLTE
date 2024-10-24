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
    <?php echo renderContentHeader("Lista de reportes", "Inicio", SERVERURL . "views"); ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">Reportes</div>
                                <div class="col-md-6 text-right"><a href="./registra-colaborador" class="btn btn-sm btn-primary">Registrar</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            $url = $_SERVER["REQUEST_URI"];
                            $arreglo = explode("/", $url);// se debe comparar con la ruta de la vista
                            var_dump($arreglo);
                            ?>
                        </div>
                    </div>
                </div>
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

</body>

</html>