

<?php
session_start();
require_once("conec.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST["infoCedula"];
    $nombre = $_POST["infoNombreCompleto"];
    $nom_usu = $_POST["infoNombreUsuario"];
    $query = "UPDATE usuario SET nombre_completo = '$nombre', nom_usu = '$nom_usu' WHERE cedula = '$cedula'";
    $resul = mysqli_query($conexion, $query);
    if ($resul) {
        echo "
            <script>
                alert('ACTUALIZACION EXITOSA.');
                window.location = 'home.php';
               
            </script>
            ";
    } else {
        echo "
            <script>
                alert('ERROR INESPERADO.');
                window.location = 'home.php';
               
            </script>
            ";
    }
    
}

?>