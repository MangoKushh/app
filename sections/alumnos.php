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

$cursos=isset($_POST['cursos'])?$_POST['cursos']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';
$nombre_alumno=isset($_POST['nombre_alumno'])?$_POST['nombre_alumno']:'';
$apellidos_alumno=isset($_POST['apellidos_alumno'])?$_POST['apellidos_alumno']:'';
$idAlumno=$conexionDB->lastInsertID();
//echo $idAlumno; echo "<---";
//ACCIONES_BOTONES
if($accion != ''){
    switch($accion){
        case 'agregar':
            $sql="INSERT INTO alumnos (id, nombre, apellidos) VALUES (NULL,:nombre_alumno,:apellidos_alumno)";
            
            $consulta=$conexionDB->prepare($sql);
            $consulta->bindParam(':nombre_alumno',$nombre_alumno);
            $consulta->bindParam(':apellidos_alumno',$apellidos_alumno);
            $consulta->execute();
            
            $idAlumno=$conexionDB->lastInsertID();

            foreach($cursos as $curso){
                $sql="INSERT INTO alumnos_curso (id, id_alumno, id_curso) VALUES (NULL,:id_alumno,:id_curso)";
                $consulta=$conexionDB->prepare($sql);
                $consulta->bindParam(':id_alumno',$idAlumno);
                $consulta->bindParam(':id_curso',$curso);
                $consulta->execute();
            }

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
            $sql="SELECT * FROM alumnos WHERE id=:id";
            $consulta=$conexionDB->prepare($sql);
            $consulta->bindParam(':id',$id);
            $consulta->execute();
            $alumno=$consulta->fetch(PDO::FETCH_ASSOC);
            $nombre_alumno=$alumno['nombre'];
            $apellidos_alumno=$alumno['apellidos'];
            break;
    }
}

foreach($lista_alumnos as $clave => $alumno){
    $sql="SELECT * FROM cursos WHERE id IN (SELECT id_curso FROM alumnos_curso WHERE id_alumno=:id_alumno)";
    $consulta=$conexionDB->prepare($sql);
    $consulta->bindParam(':id_alumno',$alumno['id']);
    $consulta->execute();
    $cursosAlumno=$consulta->fetchAll();
    $lista_alumnos[$clave]['cursos']=$cursosAlumno;
}

$sql="SELECT * FROM cursos";
$lista_cursos=$conexionDB->query($sql);
$cursos=$lista_cursos->fetchAll();
//print_r($cursos[0]);
foreach($cursos as $curso){
    $sql="SELECT * FROM alumnos_curso;";
    $consulta=$conexionDB->prepare($sql);
        //$consulta->bindParam(':id_alumno',$alumno['id']);
        //$consulta->bindParam(':id_curso',$curso['id']);
    $consulta->execute();
    //echo $curso['id'];
}
?>