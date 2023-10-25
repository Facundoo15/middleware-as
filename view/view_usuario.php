<?php
// IMPORTAMOS EL MIDDLEWARE O API
include("../controller/API_USER.php");


// LISTAMOS LOS USUARIOS A MOSTRAR
$listaUsuarios = API_USUARIO::listarUsuarios();

// CAPTURAMOS LA DATA DE LOS INPUTS

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
$correo = isset($_POST['correo']) ? $_POST['correo'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$accion = isset($_POST['accion']) ? $_POST['accion'] : null;


// AGREGAMOS EL USUARIO CON EL EVENTO 'REGISTRAR'
if ($accion == 'registrar') {
    $usuarioExistente = API_USUARIO::validarCorreo($correo);
    if ($usuarioExistente == null) {
        API_USUARIO::registrarUsuario($nombre, $apellido, $correo, $password);
        echo '<script>alert("¡Usuario registrado con éxito!")</script>';
    } else {
        echo '<script>alert("¡El correo a registrar ya existe!")</script>';
    }
}

// HTML - 5
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/archivo.css">
    <title>Formulario</title>
</head>

<body>

    <!-- FORMULARIO DE USUARIOS -->


    <div class="container my-3">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 py-4 bg-white">
                <h2>Formulario de Usuarios</h2>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Monica">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="apellido" placeholder="Galindo">
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo" placeholder="monica@galindo.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" placeholder="galindo123">
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" type="submit" value="registrar" name="accion">Guardar</button>
                        <button class="btn btn-secondary" type="reset">Limpiar</button>
                    </div>
                </form>
            </div>

            <!-- LISTADO DE USUARIOS -->

            <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 py-4 bg-white">
                <h2>Listado de personas</h2>
                <table class="table table-dark table-stripped">
                    <thead>
                        <tr>
                            <th class="centrado">#</th>
                            <th class="centrado">Nombre Completo</th>
                            <th class="centrado">Correo</th>
                            <th class="centrado">Contraseña</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listaUsuarios as $usuario) { ?>
                            <tr class="text-center">
                                <th>
                                    <?php echo $usuario['id'] ?>
                                </th>
                                <td>
                                    <?php echo $usuario['nombre'] . ' ' . $usuario['apellido'] ?>
                                </td>
                                <td>
                                    <?php echo $usuario['correo'] ?>
                                </td>
                                <td>
                                    <?php echo $usuario['contrasenia'] ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>