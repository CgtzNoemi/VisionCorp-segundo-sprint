<?php
//Incluir archivo de conexión a la base de datos
include_once("db_conexion.php");

$AngularData = file_get_contents("php://input");
if(isset($AngularData) && !empty($AngularData)){
    $request = json_decode($AngularData);
    
    $NombreUsuario = trim($request->NombreUsuario);
    $correoElectronico = mysqli_real_escape_string($mysqli, trim($request->correoElectronico));
    $contrasena = mysqli_real_escape_string($mysqli, trim($request->Password));
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarioadministrador(NombreUsuario, correoElectronico, Password) VALUES ('$NombreUsuario', '$correoElectronico', '$hash')";

    if($mysqli->query($sql)) {
        $data = array('message'=>'success');
        echo json_encode($data);
    }else{
        $data = array('message'=>'failed');
        echo json_encode($data);
    }
}

?>