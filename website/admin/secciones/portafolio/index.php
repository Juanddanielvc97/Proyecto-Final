<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_portafolio where  id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registros_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registros_imagen["imagen"])){
        if(file_exists("../../../assets/img/portfolio/".$registros_imagen["imagen"])){
            unlink("../../../assets/img/portfolio/".$registros_imagen["imagen"]);
        }
    }

    $sentencia=$conexion->prepare("DELETE FROM tbl_portafolio where  id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
}


// seleccionar registros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_portafolio`");
$sentencia->execute();
$lista_portafolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);
include("../../templates/header.php");
?>
<div class="card">
    <div class="card-header"><a name="" id="" class="btn btn-primary" href="crear.php" role="button" >agregar registros</a></div>
    <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Título</th>
                            <th scope="col">Subtitulo</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">url</th>
                            <th scope="col">Aciones</th>
                        </tr>
                    </thead>
                    <tbody><?php foreach ($lista_portafolio as $registros){ ?>
                            <tr class=""> 
                                <td scope="col"><?php echo $registros['ID'];?></td>
                                <td scope="col"><h6><?php echo $registros['titulo'];?></h6></td>
                                <td scope="col"><?php echo $registros['subtitulo'];?></td>
                                <td scope="col"><img  width="55" src="../../../assets/img/portfolio/<?php echo $registros['imagen'];?>"></td>
                                <td scope="col"><?php echo $registros['descripcion'];?></td>
                                <td scope="col"><?php echo $registros['cliente'];?></td>
                                <td scope="col"><?php echo $registros['categoria'];?></td>
                                <td scope="col"><?php echo $registros['url'];?></td>
                                <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button" >Editar</a>
                            |
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button" >Eliminar</a>
                        </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
    </div>
</div>
<?php include("../../templates/footer.php");?>