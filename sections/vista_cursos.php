<?php include('../template/cabecera.php');?>

<div class="container">
    <div class="row">
        <div class="col-12"><br/>
            <div class="row">
                <div class="col-md-5">
                    <?php include('cursos.php');?>
                   <!-- <s?php include('form.php');?> -->
                   <form action="" method="post">
                        <div class="card">
                            <div class="card-header">
                                Cursosss
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
                                    <label for="nombre_curso" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" 
                                    name="nombre_curso" id="nombre_curso" 
                                    aria-describedby="helpId" placeholder="Nombre del curso"
                                    value="<?php echo $nombre_curso;?>"/>
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
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listacursos as $curso){ ?>

                                
                                <tr>
                                    <td><?php echo $curso['id'];?></td>
                                    <td><?php echo $curso['nombre_curso'];?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="id" id="id" value="<?php echo $curso['id'];?>">
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
</div>
<?php include('../template/pie.php');?>