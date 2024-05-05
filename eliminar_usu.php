<?php
session_start();
require_once("conec.php");
if (isset($_SESSION["usuario"])) {
    $cedula_en_sesion = $_SESSION["usuario"]["cedula"];
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cedula"])) {
        $cedula_a_borrar = $_POST["cedula"];
        if ($cedula_en_sesion != $cedula_a_borrar) {
            $query_delete = "UPDATE usuario SET estado = 0 WHERE cedula = '$cedula_a_borrar'";
            $resul = mysqli_query($conexion, $query_delete);
            if ($resul) {
                echo "
                <script>
                    alert('ELIMINADO CON EXITO.');
                    window.location = 'home.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('OCURRIO UN ERROR INESPERADO.');
                    window.location = 'home.php';
                </script>
                ";
            }
            
        } else {
            echo "
            <script>
                alert('NO PUEDE ELIMINARSE PORQUE SE ENCUENTRA EN SESION.');
                window.location = 'home.php';
               
            </script>
            ";
        }
        
        
    } else {
        echo "
        <script>
            alert('SURGIO UN PROBLEMA CON LA SOLICITUD.');
            window.location = 'home.php';
        </script>
        ";
    }
    

    
} else {
    echo "
    <script>
        alert('USUARIO NO SE ENCUENTRA EN SESION.');
        window.location = login.html;
    </script>
    ";
}

?>