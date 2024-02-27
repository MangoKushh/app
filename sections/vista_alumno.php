<?php include('../template/cabecera.php');?>
<div class="container">
    <div class="row">
        <div class="col-12"><br/>
            <div class="row">
                <div class="col-md-5">
                    <?php include('alumnos.php');?>
                   <!-- <s?php include('form.php');?> -->
                   <form action="" method="post">
                        <div class="card">
                            <div class="card-header">
                                Alumnos
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="" class="form-label">ID</label>
                                    <input type="text" class="form-control"
                                    name="id" id="id" 
                                    aria-describedby="helpId" placeholder="ID"
                                    value="<?php echo $id;?>"/>
                                </div>
                                <div class="mb-3">
                                    <label for="nombre_alumno" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" 
                                    name="nombre_alumno" id="nombre_alumno" 
                                    aria-describedby="helpId" placeholder="Nombre del alumno"
                                    value="<?php echo $nombre_alumno;?>"/>
                                </div>
                                <div class="mb-3">
                                    <label for="apellidos_alumno" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" 
                                    name="apellidos_alumno" id="apellidos_alumno" 
                                    aria-describedby="helpId" placeholder="Apellidos"
                                    value="<?php echo $apellidos_alumno;?>"/>
                                </div>
                                <div class="mb-3">
                                    <label for="nombre_curso" class="form-label">Cursos</label>
                                    <select multiple class="form-control" name="cursos[]" id="listaCursos">
                                        <?php foreach($cursos as $curso){ ?>
                                        <option value="<?php echo $curso['id'];?>"> 
                                            <?php echo $curso['id']; echo ". ";
                                            echo $curso['nombre_curso'];?>
                                        </option> <?php } ?>
                                        
                                        
                                    </select>
                                </div>
                                <div class="btn-group" role="group" aria-label="">
                                    <button type="submit" class="btn btn-primary" name="accion" value="agregar" id="botonAgregar">Agregar</button>
                                    <button type="submit" class="btn btn-primary" name="accion" value="editar" id="botonEditar">Editar</button>
                                    <button type="submit" class="btn btn-primary" name="accion" value="borrar" id="botonBorrar">Borrar</button>
                                </div>
            
                            </div>
                        </div>
                    </form>
                </div>
    
                <div class="col-md-7">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre completo</th>
                                    <th scope="col">Cursos</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($lista_alumnos as $alumno){ ?>

                                <tr>
                                    <td><?php echo $alumno['id'];?></td>
                                    <td><?php  echo $alumno['apellidos'];
                                        echo ', ';
                                        echo $alumno['nombre'];?></td>
                                    <td>
                                        <?php foreach($alumno['cursos'] as $curso){
                                        echo $curso['nombre_curso']; 
                                        echo "<br>";
                                        }?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id" id="id" value="<?php echo $alumno['id'];?>">
                                            <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">
                                        </form>    

                                    </td>
                                </tr> 
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
        
                </div>
            </div>
        </div>
    </div>

    
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<script> new TomSelect("#listaCursos",{plugins:['remove_button']}); </script>
</div><?php include('../template/pie.php');?>
