<?php 
include("../../bd.php");
if(isset($_GET['txtID'])){
    //recuperar los datos del ID correspondiente
    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM  tbl_equipo where  id=:id ");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $imagen=$registro['imagen'];
    $nombrecompleto=$registro['nombrecompleto'];
    $puesto=$registro['puesto'];
    $twitter=$registro['twitter'];
    $facebook=$registro['facebook'];
    $linkedin=$registro['linkedin'];
}
if ($_POST){
    
    //recuperacion los valores del formulario
    $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $nombrecompleto=(isset($_POST["nombrecompleto"]))?$_POST["nombrecompleto"]:"";
    $puesto=(isset($_POST["puesto"]))?$_POST["puesto"]:"";
    $twitter=(isset($_POST["twitter"]))?$_POST["twitter"]:"";
    $facebook=(isset($_POST["facebook"]))?$_POST["facebook"]:"";
    $linkedin=(isset($_POST["linkedin"]))?$_POST["linkedin"]:"";;

    $sentencia=$conexion->prepare("UPDATE tbl_equipo
    SET 
    /*imagen=:imagen,*/
    nombrecompleto=:nombrecompleto, 
    puesto=:puesto,
    twitter=:twitter,
    facebook=:facebook,
    linkedin=:linkedin
    
    WHERE id=:id ");
    
    $sentencia->bindParam(":nombrecompleto",$nombrecompleto);
    $sentencia->bindParam(":puesto",$puesto);
    $sentencia->bindParam(":twitter",$twitter);
    $sentencia->bindParam(":facebook",$facebook);
    $sentencia->bindParam(":linkedin",$linkedin);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    
 //imagen
 if($_FILES['imagen']["tmp_name"]!=""){

    $imagen=(isset($_FILES['imagen']["name"]))?$_FILES['imagen']["name"]:"";
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";
    $tmp_imagen=$_FILES["imagen"]["tmp_name"];

        //Borrado del archivo anterior
        move_uploaded_file($tmp_imagen,"../../../assets/img/team/".$nombre_archivo_imagen);
        $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";
        $sentencia=$conexion->prepare("SELECT imagen FROM tbl_equipo where  id=:id ");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $registros_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
    
        if(isset($registros_imagen["imagen"])){
            if(file_exists("../../../assets/img/team/".$registros_imagen["imagen"])){
                unlink("../../../assets/img/team/".$registros_imagen["imagen"]);
            }
        }


    $sentencia=$conexion->prepare("UPDATE tbl_equipo SET imagen=:imagen WHERE id=:id ");
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $imagen=$nombre_archivo_imagen;
   
 }  
 
    $mensaje="Registro modificado con éxito.";
    header("Location:index.php?mensaje=".$mensaje);
}


include("../../templates/header.php");?>
<div class="card">
    <div class="card-header"> Nuevo personal</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="id" class="form-label">ID:</label>
            <input readonly
            VALUE="<?php echo $txtID;?>"
                type="txtID"
                class="form-control"
                name="id"
                id="id"
                aria-describedby="helpId"
                placeholder="id"
            />
        </div>
        
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <img  width="55" src="../../../assets/img/team/<?php echo $imagen;?>">  
            <input
                type="file"
                class="form-control"
                name="imagen"
                id="imagen"
                aria-describedby="helpId"
                placeholder="imagen"
            />
        </div>
        
        <div class="mb-3">
            <label for="nombrecompleto" class="form-label">Nombre completo:</label>
            <input
                VALUE="<?php echo $nombrecompleto;?>"
                type="text"
                class="form-control"
                name="nombrecompleto"
                id="nombrecompleto"
                aria-describedby="helpId"
                placeholder="Nombre"
            />
        </div>
        <div class="mb-3">
            <label for="puesto" class="form-label">Puesto:</label>
            <input
                VALUE="<?php echo $puesto;?>"
                type="text"
                class="form-control"
                name="puesto"
                id="puesto"
                aria-describedby="helpId"
                placeholder="Puesto"
            />
            <div class="mb-3">
                <label for="twitter" class="form-label">Twitter:</label>
                <input
                    VALUE="<?php echo $twitter;?>"
                    type="text"
                    class="form-control"
                    name="twitter"
                    id="twitter"
                    aria-describedby="helpId"
                    placeholder="twitter"
                />
            </div>
            
            <div class="mb-3">
                <label for="facebook" class="form-label">Facebook:</label>
                <input
                    VALUE="<?php echo $facebook;?>"
                    type="text"
                    class="form-control"
                    name="facebook"
                    id="facebook"
                    aria-describedby="helpId"
                    placeholder="facebook"
                />
            </div>
            <div class="mb-3">
                <label for="linkedin" class="form-label">Linkedin</label>
                <input
                    VALUE="<?php echo $linkedin;?>"
                    type="text"
                    class="form-control"
                    name="linkedin"
                    id="linkedin"
                    aria-describedby="helpId"
                    placeholder="Linkedin"
                />
            </div>
            
            <button type="submit" class="btn btn-success" >Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button" >Cancelar</a>
        </div>
        
        
        </form>
    </div>
</div>
<?php include("../../templates/footer.php");?>