<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    //recuperar los datos del ID correspondiente
    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM  tbl_portafolio where  id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $titulo=$registro['titulo'];
    $subtitulo=$registro["subtitulo"];
    $imagen=$registro['imagen'];
    $descripcion=$registro['descripcion'];
    $cliente=$registro['cliente'];
    $categoria=$registro['categoria'];
    $url=$registro['url'];
}
    if ($_POST){
    
        //recuperacion los valores del formulario
        $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
        $subtitulo=(isset($_POST['subtitulo']))?$_POST['subtitulo']:"";
        $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
        $cliente=(isset($_POST['cliente']))?$_POST['cliente']:"";
        $categoria=(isset($_POST['categoria']))?$_POST['categoria']:"";
        $url=(isset($_POST['url']))?$_POST['url']:"";
    
        $sentencia=$conexion->prepare("UPDATE tbl_portafolio
        SET 
        titulo=:titulo, 
        subtitulo=:subtitulo, 
        descripcion=:descripcion,
        cliente=:cliente,
        categoria=:categoria,
        url=:url
        WHERE id=:id ");
        
        
        $sentencia->bindParam(":titulo",$titulo);
        $sentencia->bindParam(":subtitulo",$subtitulo);
        $sentencia->bindParam(":descripcion",$descripcion);
        $sentencia->bindParam(":cliente",$cliente);
        $sentencia->bindParam(":categoria",$categoria);
        $sentencia->bindParam(":url",$url);
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        
     //imagen
     if($_FILES['imagen']["tmp_name"]!=""){

        $imagen=(isset($_FILES['imagen']["name"]))?$_FILES['imagen']["name"]:"";
        $fecha_imagen=new DateTime();
        $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";
        $tmp_imagen=$_FILES["imagen"]["tmp_name"];

            //Borrado del archivo anterior
            move_uploaded_file($tmp_imagen,"../../../assets/img/portfolio/".$nombre_archivo_imagen);
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


        $sentencia=$conexion->prepare("UPDATE tbl_portafolio SET imagen=:imagen WHERE id=:id ");
        $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();

        
        
     } 
        $mensaje="Registro modificado con éxito.";
        header("Location:index.php?mensaje=".$mensaje);
    }

include("../../templates/header.php");?>
<div class="card">
    <div class="card-header">Producto del portafolio</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="" class="form-label">ID</label>
                <input type="text" class="form-control" readonly name="txtID" id="txtID" VALUE="<?php echo $txtID;?>" aria-describedby="helpId" placeholder="" />
            </div>
            <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input  VALUE="<?php echo $titulo;?>" type="text"  class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="título"/>
            </div>
        <div class="mb-3">
        <label for="subtitulo" class="form-label">Suptitulo:</label>
        <input VALUE="<?php echo $subtitulo;?>" type="text" class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="subtitulo" />
        </div>
        <div class="mb-3">
        <label for="imagen" class="form-label">Imagen:</label>
        <img  width="55" src="../../../assets/img/portfolio/<?php echo $imagen;?>">
        <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId" />
        </div>
        <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <input VALUE="<?php echo $descripcion;?>" type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion" />
        </div>
        <div class="mb-3">
        <label for="cliente" class="form-label">Cliente:</label>
        <input VALUE="<?php echo $cliente;?>" type="text" class="form-control" name="cliente" id="cliente" aria-describedby="helpId" placeholder="cliente" />
        </div>
        <div class="mb-3">
        <label for="categoria" class="form-label">Categoria:</label>
        <input VALUE="<?php echo $categoria;?>" type="text" class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="categoria"/>
        </div>
        <div class="mb-3">
        <label for="url" class="form-label">URL:</label>
        <input VALUE="<?php echo $url;?>" type="text" class="form-control" name="url" id="url" aria-describedby="helpId" placeholder="url del proyecto" />
        </div>
        <button type="submit" class="btn btn-success" >Actualizar</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button" >Cancelar</a>
        </form>  
    </div>
</div>
<?php include("../../templates/footer.php");?>