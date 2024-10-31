<?php
session_start(); //Crea o hereda la session

/* Configuracion de la aplicacion */
require_once "./app/config/App.php";
//Cuando un usuario posea una sesion activa, NO DEBE RENDERIZAR EL LOGIN
if (isset($_SESSION['login']) && $_SESSION['login']['status'] === true) {
  header("Location: " . SERVERURL . "views/");
  exit;
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= COMPANY ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= SERVERURL ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= SERVERURL ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= SERVERURL ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <h3>App Permiso</h3>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Ingrese tus datos </p>

        <form action="" method="post" id="formulario-login">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="nomuser" placeholder="Nombre de usuario" autofocus required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="passuser" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Recordar contraseña
                </label>
              </div>
            </div>
            <!-- /.col -->
        </form>

        <div class="social-auth-links text-center mt-2 mb-3">
          <button class="btn btn-sm btn-primary btn-block" type="submit">Iniciar Sesion</button>
          <button class="btn btn-sm btn-danger btn-block" type="button">Recuperar Contraseña</button>
        </div>

        <!-- /.social-auth-links -->

        <p class="mb-0 text">
          <a href="mailto:benjaminpac22@gmail.com">Soporte Tecnico</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= SERVERURL ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= SERVERURL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= SERVERURL ?>dist/js/adminlte.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- SweetAlert Custom -->
  <script src="<?php SERVERURL ?>dist/js/swalcustom.js"></script>


  <script>
    document.addEventListener("DOMContentLoaded", () => {

      const formulario = document.querySelector("#formulario-login");
      const inputNomUser = document.querySelector("#nomuser");
      const inputPassUser = document.querySelector("#passuser");

      formulario.addEventListener("submit", async (event) => {
        event.preventDefault(); //Detener 

        const parametros = new FormData();

        parametros.append("operation", "login");
        parametros.append("nomuser", inputNomUser.value);
        parametros.append("passuser", inputPassUser.value);

        const response = await fetch('./app/controllers/Usuario.controller.php', {

          method: 'POST',

          body: parametros

        });

        const data = await response.json();

        if (!data.esCorrecto) {

          showToast(data.mensaje);
        } else {
          showToast(data.mensaje, 'SUCCESS', 800, './views/home/welcome');
        }
      });

    });
  </script>


</body>

</html>