<?php

session_start();
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
            <div class="col-lg-4 "></div>
            <div class="col-lg-4">
                <h2 class="text-primary">Mostrar Usuario</h2>
                <div class="mainContainer">
                    <form action="router.php" method="POST" style="margin-top: 0em !important;">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="nombre" required>
                            <input type="text" class="form-control" name="apellido" placeholder="apellido" required>
                        </div>
                        <div class="inputs">
                            <input class="btn btn-primary btn-lg" type="submit" value="mostrar" name="mostrar">
                            <input class="btn btn-primary btn-lg" type="reset" value="Reset" name="reset">
                            <a href='opciones.php'>
                                    <button class="btn btn-primary btn-lg" type="button">Atras</button>
                            </a>
                            <a href='login.php'>
                                    <button class="btn btn-primary btn-lg" type="button">Salir</button>
                            </a>
                        </div>


                    </form>
                </div>

            </div>
            <div class="col-lg-4 ">
            <?php
            $info=$_SESSION["info"];
            echo "<table>";
            for($i=0;$i<info["count"];$i++){
               echo "<tr>";
               echo "<td>".$info[$i]["uid"][0]."</td>";
               echo "<td>".$info[$i]["cn"][0]."</td>";
               echo "<td>".$info[$i]["sn"][0]."</td>";
               echo"<td>".$info[$i]["givenName"][0]."</td>";
               echo "<td>".$info[$i]["description"][0]."</td>";
               echo "</tr>";
            }

            echo "</table>";
            ?>
            
            </div>
        </div>
    </div>

</body>


</html>