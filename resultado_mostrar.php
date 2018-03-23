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
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4 INFOSuccess">
                <div class="mainTitleSuccess">

                    <?php echo "<h3>".$_SESSION["mainTittle"]."</h3>";?>
                </div>
            </div>
            <div class="col-lg-4">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 "></div>

            <div class="col-lg-4 ">
                <div class="muestra_tabla">

                    <?php
            session_start();
            $info=$_SESSION["info"];
            echo "<table class='table table-striped'>";
            for($i=0;$i<$info["count"];$i++){
               
               echo "<tr><td>CN: </td><td>".$info[$i]["cn"][0]."</td></tr>";
               echo "<tr><td>SN: </td><td>".$info[$i]["sn"][0]."</td></tr>";
               echo"<tr><td>Teephone: </td><td>".$info[$i]["telephonenumber"][0]."</td></tr>";
               echo"<tr><td>Mobile: </td><td>".$info[$i]["mobile"][0]."</td></tr>";
               echo"<tr><td>Address: </td><td>".$info[$i]["postaladdress"][0]."</td></tr>";
               echo "<tr><td>Description: </td><td>".$info[$i]["description"][0]."</td></tr>";
           
            }
            echo "</table>";
            ?>
                </div>
            </div>
            <div class="col-lg-4 "></div>

        </div>
        <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                 
        <div class="B">
                <?php  echo '<a href='.$_SESSION["href"].'><button class="btn btn-primary btn-lg" style="background-color:#00ff00;float:left;" type="button">Atras</button></a>'; ?>
                <a href='login.php'><button class="btn btn-primary btn-lg" type="button" style="background-color:#00ff00;float:right">Salir</button></a>
        </div>
        
                
                </div>             
                <div class="col-lg-4">
                </div>
            </div>
    </div>

</body>

</html>