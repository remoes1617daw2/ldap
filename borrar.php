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

        <?php
        session_start();
        $ldaphost = "localhost";
		$ldappass = "fjeclot";  
    $ldapconn = ldap_connect($ldaphost) or die("Could not connect to LDAP server.");
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
    if ($ldapconn) {
        $ldapbind = ldap_bind($ldapconn, "cn=admin,dc=fjeclot,dc=net", $ldappass);
        if ($ldapbind) {
			
			
			$_SESSION["mainTittle"]="Fallo al mostrar usuarios";
			$_SESSION["secondaryTittle"]="No ha sido posible visualizar los usuarios";
			$_SESSION["href"]="opciones.php";
			$resul=ldap_search($ldapconn,"ou=usuaris,dc=fjeclot,dc=net","(uid=*)") ;//or die (header("Location:error.php"));
			$info = ldap_get_entries($connection, $resul);
			$_SESSION["v_borrar"]=$info;
			
			
			      
            for($i=0;$i<$info["count"];$i++){
               echo "<form action=router.php method=post>";
               echo "<div class='form-group'>";
               echo "<label>".$info[$i]["cn"][0]."</label>";
               echo "<input type='text' name='uidBorrar' placeholder=".$info[$i]["uid"][0]." value=".$info[$i]["uid"][0]." class='form-control' id='name' required> ";
			   echo "<input type='text' name='ouBorrar' placeholder=".$info[$i]["ou"][0]." value=".$info[$i]["ou"][0]." class='form-control' id='name' required>";
				echo "</div>";
				echo "</form>";
			echo "<BR>";
           
            }


         
		}
	}
       ?>
 	    </div>
        <div class="col-lg-4"></div>
   </div>
</div>
</body>
</html>
