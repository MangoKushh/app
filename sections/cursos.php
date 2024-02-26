<?php 
//INSERT INTO `cursos` (`id`, `nombre_curso`) VALUES (NULL, 'Sitio web con PHP');
include_once '../conf/db.php';
$conexionDB=DB::crearInstancia();


$id=isset($_POST['id'])?$_POST['id']:'';
$nombre_curso=isset($_POST['nombre_curso'])?$_POST['nombre_curso']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';

if($accion != ''){
    switch($accion){
        case 'agregar':
            $sql="INSERT INTO cursos (id, nombre_curso) VALUES (NULL,:nombre_curso)";
            //"INSERT INTO `cursos` (`id`, `nombre_curso`) VALUES (NULL, 'aaa')";
            $consulta=$conexionDB->prepare($sql);
            $consulta->bindParam(':nombre_curso',$nombre_curso);
            $consulta->execute();
            
            //echo $sql;
            break;
        case 'editar':
            $sql="UPDATE cursos SET nombre_curso=:nombre_curso WHERE id=:id";
            $consulta=$conexionDB->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->bindParam(':nombre_curso',$nombre_curso);
            $consulta->execute();
            break;
        case 'borrar':
            $sql="DELETE FROM cursos WHERE id=:id";
            $consulta=$conexionDB->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            break;
        case 'Seleccionar':
            $sql="SELECT * FROM cursos WHERE id=:id";
            $consulta=$conexionDB->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $curso=$consulta->fetch(PDO::FETCH_ASSOC);
            $nombre_curso=$curso['nombre_curso'];
            break;
    }
}

$consulta=$conexionDB->prepare("SELECT * FROM cursos");
$consulta->execute();
$listacursos=$consulta->fetchAll();

//print_r($listacursos);

print_r($_POST);

?>