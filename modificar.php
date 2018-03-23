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
</head>

<body>
    <div class="conatainer-fluid">
        <div class="row">
            <div class="col-lg-4 L"></div>
            <div class="col-lg-4">
                <h2 class="text-primary">Modificar Usuario</h2>
                <div class="mainContainer">
                    <form action="router.php" method="POST" style="margin-top: 0em !important;">
                        <div class="form-group">
                            <input type="text" class="form-control" name="ouModOp" placeholder="ou" required>
                            <input type="text" class="form-control" name="uidModOp" placeholder="uid" required>
                            <div class="radio"> 
                            <label><input type="radio" name="radio" value="cn">nombre completo</label>
                            </div>
                             <div class="radio">
                            <label><input type="radio" name="radio" value="sn">apellido</label>
                            </div>
                            <div class="radio">
                            <label><input type="radio" name="radio" value="givenname">givenname</label>
                            </div>
                            <div class="radio">
                            <label><input type="radio" name="radio" value="title">título</label>
                            </div>
                            <div class="radio">
                            <label><input type="radio" name="radio" value="telephonenumber">teléfono</label>
                            </div>
                            <div class="radio">
                            <label><input type="radio" name="radio" value="mobile">mobil</label>
                            </div>
                            <div class="radio">
                            <label><input type="radio" name="radio" value="postaladdress">dirección</label>
                            </div>
                            <div class="radio">
                            <label><input type="radio" name="radio" value="uidnumber">uidnumber</label>
                            </div>
                            <div class="radio">
                            <label><input type="radio" name="radio" value="gidnumber">gidnumber</label>
                            </div>
                            <div class="radio">
                            <label><input type="radio" name="radio" value="description">descripcion</label>
                            </div>
                            <div class="radio">
                            <label><input type="radio" id="password" onclick="changeType()" name="radio" value="userpassword">contraseña</label>
                            </div>
                            <input class="form-control" type="text" id="valor" name="valor">
                                                  

                        </div>
                        <div class="inputs">
                            <input class="btn btn-primary btn-lg" type="submit" value="modificar" name="modificar">
                            <input class="btn btn-primary btn-lg" type="reset" value="Reset" name="reset">
                            <a href='login.php'>
                                    <button class="btn btn-primary btn-lg" type="button">Salir</button>
                            </a>
                        </div>


                    </form>
                </div>

            </div>
            <div class="col-lg-4 L"></div>
        </div>
    </div>
       <script type="text/javascript">
       function changeType(){
       var check = document.getElementById("password");
	        if(check.checked == true){
	            document.getElementById("valor").type = "password";
	        }
	        else{
	        	document.getElementById("valor").type = "text";
	        }
    	}
    </script>
</body>


</html>
