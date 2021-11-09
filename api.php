<?php

require_once "conexion.php";

$user = new BDD();

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
        $id = $_POST['eid'];
        $nombre = $_POST['enombre'];
        $descripcion = $_POST['edescripcion'];
        $foto = "";

        if (isset($_FILES['efoto']['name'])) {
            $foto = $_FILES['efoto']['name'];

            $target_dir = "img/";
            $target_file = $target_dir.basename($foto);
            move_uploaded_file($_FILES['efoto']['tmp_name'],$target_file);
            $foto =",foto='".$foto = $_FILES['efoto']['name']."'";
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
        $id = $_POST['did'];

        $u = $user->borrar("paisajes","id=".$id);

        if ($u) {
            $res['mensaje'] = "Se ha eliminado";
        }else{
            $res['mensaje'] = 'error al eliminar';
            $res['error'] = true;
        }
        break;
}

echo json_encode($res);
die();


?>