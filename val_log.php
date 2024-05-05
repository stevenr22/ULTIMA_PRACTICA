<?php
session_start();
require_once("conec.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usu = $_POST["usu"];
    $contra = $_POST["pass"];
    $query = "SELECT * FROM usuario WHERE
    nom_usu = '$usu' and contra = '$contra'";
    $resultado = mysqli_query($conexion, $query);
    if(mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION['usuario'] = $usuario;
        echo "
        <script>
            window.location = 'home.php';
        </script>
       
        ";
        
    } else {
        echo "
        <script>
            alert(' Usuario no encontrado.');
            window.location = 'login.html';
        </script>
       
        ";    }
}

?>