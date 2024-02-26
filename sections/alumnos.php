<?php 
include_once '../conf/db.php';

//CONEXION_BD
$conexionDB=DB::crearInstancia();

//Tabla De Alumnos
$consulta=$conexionDB->query("SELECT * FROM alumnos");
//$consulta->execute();
$lista_alumnos=$consulta->fetchAll();

//VARIABLES
$id=isset($_POST['id'])?$_POST['id']:'';
//$nombre_curso=isset($_POST['nombre_curso'])?$_POST['nombre_curso']:'';
$cursos=isset($_POST['cursos'])?$_POST['cursos']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';
$nombre_alumno=isset($_POST['nombre_alumno'])?$_POST['nombre_alumno']:'';
$apellidos_alumno=isset($_POST['apellidos_alumno'])?$_POST['apellidos_alumno']:'';

//ACCIONES_BOTONES
if($accion != ''){
    switch($accion){
        case 'agregar':
            $sql="INSERT INTO alumnos (id, nombre, apellidos) VALUES (NULL,:nombre_alumno,:apellidos_alumno)";
            //"INSERT INTO `cursos` (`id`, `nombre_curso`) VALUES (NULL, 'aaa')";
            $consulta=$conexionDB->prepare($sql);
            $consulta->bindParam(':nombre_alumno',$nombre_alumno);
            $consulta->bindParam(':apellidos_alumno',$apellidos_alumno);
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
            $sql="DELETE FROM alumnos WHERE id=:id";
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

foreach($lista_alumnos as $clave => $alumno){
    $sql="SELECT * FROM cursos WHERE id IN (SELECT id_curso FROM alumnos_curso WHERE id_alumno=:id_alumno)";
    $consulta=$conexionDB->prepare($sql);
    $consulta->bindParam(':id_alumno',$alumno['id']);
    $consulta->execute();
    $cursosAlumno=$consulta->fetchAll();
    $alumnos[$clave]['cursos']=$cursosAlumno;
}

print_r($alumnos)
?>