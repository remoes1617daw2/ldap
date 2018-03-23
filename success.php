<!DOCTYPE hmtl>
<html>
    <?php
    session_start();
?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container-fluid">
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
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
            <div class="secondaryTitleSuccess">
          <?php echo "<h4>".$_SESSION["secondaryTittle"]."</h4>"; ?>
            </div>
        <?php  echo '<a class="mainLink" href='.$_SESSION["href"].'><button class="btn btn-primary btn-lg btn-left" style="background-color:#00ff00;" type="button">Atras</button></a>'; ?>
        <a href='login.php'>
            <button class="btn btn-primary btn-lg btn-right" type="button" style="background-color:#00ff00;">Salir</button>
        </a>
        
        </div>             
        <div class="col-lg-4">
        </div>
    </div>
</div>
</body>

 

</html>
