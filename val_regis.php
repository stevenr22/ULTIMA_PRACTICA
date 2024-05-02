<?php
session_start();
require_once("conec.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST["ced"];
    $nombre = $_POST["nom"];
    $usu = $_POST["usu"];
    $contra = $_POST["pass"];

    $query = "SELECT * FROM usuario WHERE cedula = '$cedula'";
    $resultado = mysqli_query($conexion, $query);
    if (mysqli_num_rows($resultado) > 0) {
        echo "
        <script>
            alert(' Usuario registrado.');
            window.location = 'regis.html';
        </script>
       
        ";
    } else {
        $insercion = "INSERT INTO usuario(cedula, nom_usu, contra) VALUES ('$cedula','$usu','$contra')";
        $resultado_inser = mysqli_query($conexion, $insercion);
        if ($resultado_inser) {
            echo "
            <script>
                alert('Usuario registrado correctamente.'); 
                window.location = 'login.html';
            </script>";
        } else {
            echo "
            <script>
                alert('Error al registrar usuario.');
            </script>";
        }
                
    }
    
}
?>