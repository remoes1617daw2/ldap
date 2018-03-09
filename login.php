<?php
include("./router.php")
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
                <div class="mainContainer">
                    <form action="router.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" placeholder="usuario" required>
                            <input type="text" class="form-control" name="contraseña" placeholder="contraseña" required>
                        </div>
                        <div class="inputs">
                            <input class="btn btn-primary btn-lg" type="submit" value="enviar" name="enviar">
                            <input class="btn btn-primary btn-lg" type="reset" value="reset" name="reset">
                        </div>


                    </form>
                </div>

            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>

</body>


</html>