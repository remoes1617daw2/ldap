<?php
include("./router.php");
include("./login.php");
include("./crear.php");
include("./borrar.php");
include("./mostrar.php");
include("./modificar.php");

?>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
</head>

<body>
    <div class="conatainer-fluid">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <h2 class="text-primary">Crear Usuario</h2>
                <div class="mainContainer">
                    <form action="router.php" method="POST" style="margin-top: 0em !important;">
                        <div class="form-group">
                            <input type="text" class="form-control" name="id" placeholder="id" required>
                            <input type="text" class="form-control" name="nombre" placeholder="nombre" required>
                            <input type="text" class="form-control" name="apellido" placeholder="apellido" required>
                            <input type="text" class="form-control" name="titulo" placeholder="titulo" required>
                            <input type="text" class="form-control" name="telefono" placeholder="teléfono" required>
                            <input type="text" class="form-control" name="mobil" placeholder="mobil" required>
                            <input type="text" class="form-control" name="direccion" placeholder="direccion" required>
                            <input type="text" class="form-control" name="numero" placeholder="numero" required>
                            <textArea class="form-control" name="descripcion" rows="5" placeholder="descripcion" required></textArea>

                        </div>
                        <div class="inputs">
                            <input class="btn btn-primary btn-lg" type="submit" value="crear" name="crear">
                            <input class="btn btn-primary btn-lg" type="reset" value="Reset" name="reset">
                            <a href='login.php'>
                                    <button class="btn btn-primary btn-lg" type="button">Salir</button>
                            </a>
                        </div>


                    </form>
                </div>

            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>

</body>


</html>