<?php

require_once "conexion.php";

$user = new ApptivaDB();

$accion = "mostrar";
$res = ["error"=>false];

if (isset($_GET['accion']))
    $accion = $_GET['accion'];

switch ($accion) {
    case 'mostrar':
        $u = $user->buscar("paisajes","1");
        if ($u) {
            $res['paisajes'] = $u;
            $res['mensaje'] = "exito";
        }else{
            $res['mensaje'] = 'aun no hay registros';
            $res['error'] = true;
        }
        break;
    case 'insertar':
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $foto = $_FILES['foto']['name'];

        $target_dir = "img/";
        $target_file = $target_dir.basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'],$target_file);

        $data = "'".$nombre."','".$descripcion."','".$foto."'";
        $u = $user->insertar("paisajes",$data);

        if ($u) {
            $res['mensaje'] = "Se ha insertado";
        }else{
            $res['mensaje'] = 'error al insertar';
            $res['error'] = true;
        }
        break;
    case 'editar':
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $foto = "";

        if (isset($_FILES['foto']['name'])) {
            $foto = $_FILES['foto']['name'];

            $target_dir = "img/";
            $target_file = $target_dir.basename($foto);
            move_uploaded_file($_FILES['foto']['tmp_name'],$target_file);
            $foto =",foto='".$foto = $_FILES['foto']['name']."'";
        }

        $data = "nombre='".$nombre."',descripcion='".$descripcion."','".$foto."'";
        $u = $user->actualizar("paisajes",$data,"id=".$id);

        if ($u) {
            $res['mensaje'] = "Se ha editado";
        }else{
            $res['mensaje'] = 'error al editar';
            $res['error'] = true;
        }
        break;
    case 'eliminar':
        $res['mensaje'] = "eliminar";
        break;
}

echo json_encode($res);
die();


?>