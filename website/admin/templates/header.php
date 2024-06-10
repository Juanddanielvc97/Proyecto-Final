<?php 
session_start();
$url_base="http://localhost/website/admin/";
if(!isset($_SESSION['usuario'])){
    header("Location:".$url_base."login.php");
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title>administrador del sitio web</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <script 
        src="https://code.jquery.com/jquery-3.7.1.min.js" 
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
        crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    </head>
    <body>
        <header>
            <!-- place navbar here -->
            <nav class="navbar navbar-expand navbar-light bg-light">
                <div class="nav navbar-nav">
                    <a class="nav-item nav-link" href="../../index.php" aria-current="page">administrador <span class="visually-hidden">(current)</span></a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/servicios/">Servicios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/portafolio/">Portafolio</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/entradas/">Entradas</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/equipo/">Equipo</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/configuraciones/">configuraciones</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>secciones/usuarios/">usuarios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar sesión</a>
                </div>
            </nav>
        </header>
        <main class="container">
        <br/>
<script>
    <?php if (isset($_GET['mensaje'])){ ?>
    Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje'];?>"});
    <?php }?>
</script>