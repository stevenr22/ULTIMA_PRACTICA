<?php
session_start();
if(isset($_SESSION['usuario'])) {
    $nombre = $_SESSION['usuario']['nombre_completo'];
    $nombre_usuario = $_SESSION['usuario']['nom_usu'];
} else {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <style>
    body {
        background-color: #566573;
    }

    /* Agregamos estilos CSS personalizados aquí */
    .card-header h2,
    .card-header h4 {
        margin-bottom: 0;
        /* Eliminamos el espacio entre los títulos */
    }

    .table-responsive {
        overflow-x: auto;
        /* Habilitamos el desplazamiento horizontal en tablas largas */
    }
    </style>
</head>

<body>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center mb-0"><b>CRUD</b></h2>
                <h4 class="text-center mb-0">Bienvenido, <b><?php echo $nombre; ?></b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">CEDULA</th>
                                <th scope="col">NOMBRE COMPLETO</th>
                                <th scope="col">USUARIO</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                require_once("conec.php");
                                $query = "SELECT cedula, nombre_completo, nom_usu FROM usuario WHERE estado = 1";
                                $resultado = mysqli_query($conexion, $query);

                                // Verificar si la consulta tuvo éxito
                                if ($resultado && mysqli_num_rows($resultado) > 0) {
                                    // Iterar sobre los resultados y mostrar cada usuario en una fila de la tabla
                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                    ?>
                            <tr>
                                <td><?php echo $fila['cedula']; ?></td>
                                <td><?php echo $fila['nombre_completo']; ?></td>
                                <td><?php echo $fila['nom_usu']; ?></td>

                                <td>
                                    <div class="btn-group">
                                        <form method="post" action="eliminar_usu.php">
                                            <input type="hidden" name="cedula" value="<?php echo $fila['cedula']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm mr-2" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">ELIMINAR</button>
                                        </form>
                                        <button type="button" data-toggle="modal" data-target="#modalEdit" onclick="editarUsuario('<?php echo $fila['cedula']; ?>','<?php echo $fila['nombre_completo']; ?>','<?php echo $fila['nom_usu']; ?>');" class="btn btn-info btn-sm">ACTUALIZAR</button>
                                    </div>
                                </td>

                            </tr>
                            <?php
                                    }
                                }
                                ?>
                        </tbody>

                    </table>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditLabel">Editar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="editar_usuario.php" method="post" class="form-group">
                                <label for="cedula" class="form-label">Cedula:</label>
                                <input type="text" onkeypress="return validarcedula(event);" class="form-control"
                                    name="infoCedula" id="infoCedula" placeholder="Ingrese su cedula" required>
                                <br>
                                <label for="nombrec" class="form-label">Nombre completo:</label>
                                <input type="text" onkeypress="return validarletras(event);" class="form-control"
                                    name="infoNombreCompleto" id="infoNombreCompleto" placeholder="Ingrese su nombre"
                                    required>
                                <br>
                                <label for="nombreusu" class="form-label">Nombre usuario:</label>
                                <input type="text" class="form-control" id="infoNombreUsuario" name="infoNombreUsuario"
                                    placeholder="Ingrese su usuario" required>
                                <br>
                                <button type="submit" class="btn btn-info">Actualizar</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>




            <div class="card-footer text-center">
                <button type="button" onclick="cerrarSesion();" class="btn btn-success">CERRAR SESIÓN</button>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6 mx-auto"> 
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h2><b>AGREGAR USUARIO</b></h2>
                    </div>
                </div>
                <div class="card-body">
                    <form action="agregar_usu.php" method="post" class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="cedula" class="form-label">Cedula:</label>
                                <input type="text" onkeypress="return validarcedula(event);" class="form-control"
                                    placeholder="Ingrese su cedula" name="ced" id="ced" required>
                            </div>
                            <div class="col">
                                <label for="Nombre" class="form-label">Nombre:</label>
                                <input type="text" onkeypress="return validarletras(event);" name="nom" id="nom"
                                    class="form-control" placeholder="Ingrese su nombre" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="Usu" class="form-label">Usuario: </label>
                                <input type="text" placeholder="Ingrese su usuario" required class="form-control" name="usu"
                                    id="usu">
                            </div>

                            <div class="col">
                                <label for="Contra" class="form-label">Contraseña:</label>
                                <input type="password" name="pass" id="pass" class="form-control"
                                    placeholder="Ingrese su contraseña" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-success">Agregar</button>
                            </div>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS CDN -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>
    <!-- Bootstrap y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    function cerrarSesion() {
        window.location = "cerrar_sesion.php";
    }

    function editarUsuario(cedula, nombreCompleto, nombreUsuario) {
        $('#modalEdit').modal('show'); // Abre el modal con el ID "modalEdit"

        // Establece el valor de los campos de entrada con la información recibida
        $('#infoCedula').val(cedula);
        $('#infoNombreCompleto').val(nombreCompleto);
        $('#infoNombreUsuario').val(nombreUsuario);
    }
    </script>


</body>

</html>