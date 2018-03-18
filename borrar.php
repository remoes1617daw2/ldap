<!DOCTYPE html>
<html>
<head>
	<title>Delete</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous" defer></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous" defer></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4"></div>
	    <div class="col-lg-4">
            <form action=router.php method=post>
		        <div class="form-group">
    			  
    			    <input type="text" name="uidBorrar" placeholder="Uid" class="form-control" id="name" required>            
                    <input type="text" name="ouBorrar" placeholder="Unidad organizativa" class="form-control" id="name" required>
                    <button type="submit" class="btn btn-primary" name="borrar" value="Borrar">Borrar</button>
                </div>
            </form>

 	    </div>
        <div class="col-lg-4"></div>
   </div>
</div>
</body>
</html>