<?php
	session_start();
	$puerto=389;
	$ldaphost = "ldap://localhost";
 
$usuario;
$contraseña;


//login
if( isset($_POST['enviar']) && $_POST['enviar']== 'Entrar')
{

	$ldaprdn  = "cn=".trim($_POST['nombre']).",dc=fjeclot,dc=net";
	$ldappass = trim($_POST['contraseña']);   
	$connection = ldap_connect("ldap://localhost", $puerto) or die("No s'ha pogut establir una connexió amb el servidor openLDAP.");

    ldap_set_option($connection, LDAP_OPT_PROTOCOL_VERSION, 3);

	if ($connection) {
		$bind = ldap_bind($connection, $ldaprdn, $ldappass);		
			$_SESSION["coneccion"]=$connection;
			$_SESSION["binding"]=$bind;
			$_SESSION["user"]=$ldaprdn;
			$_SESSION["pass"]=$ldappass;

		if ($bind) {
		
			header('Location: opciones.php'); 
	
		} else {
				$_SESSION["mainTittle"] = "FALLO AL ENTRAR";
				$_SESSION["secondaryTittle"] = "Nombre de usuario o contraseña incorrecta";
				$_SESSION["href"]="login.php";
				header("Location: error.php");
		}


	}
	else{
			$_SESSION["mainTittle"] = "FALLO DE CONEXIÓN";
		$_SESSION["secondaryTittle"] = "No se puede entrar a la base de datos";
		$_SESSION["href"]="login.php";
		header("Location: error.php");
	}
}


//buscar usuarios
if(isset($_POST['mostrar'])&& $_POST['mostrar']=='mostrar'){
$user= $_POST["uid"];
$uo= "ou=".$_POST["uo"];
$n=	$uo.",dc=fjeclot,dc=net";
$filtro ="(uid=".$user.")";

$_SESSION["mainTittle"]="Fallo al mostrar usuario/s";
$_SESSION["secondaryTittle"]="Se ha producido un error al realizar esta búsqueda";
$_SESSION["href"]="mostrar.php";
$connection = ldap_connect("ldap://localhost", $puerto) or die("No s'ha pogut establir una connexió amb el servidor openLDAP.");

    ldap_set_option($connection, LDAP_OPT_PROTOCOL_VERSION, 3);

	if ($connection) {
		$bind = ldap_bind($connection);	
		if($bind){
			$resul=ldap_search($connection,$n, $filtro) or die (header("Location:error.php"));

			$info = ldap_get_entries($connection, $resul);
			$_SESSION["info"]=$info;
			header("Location:resultado_mostrar.php");

			/*for($i=0;$i<$info["count"];$i++){
				echo $info[$i]["uid"][0];
				echo $info[$i]["cn"][0];
				echo $info[$i]["sn"][0];
				echo $info[$i]["givenName"][0];
				echo $info[$i]["description"][0];
			}*/
		}
	}
}

//creación usuarios
if(isset($_POST['crear']) && $_POST['crear']=='crear'){
	$connection = ldap_connect("ldap://localhost",389) or die("No s'ha pogut establir una connexió amb el servidor openLDAP.");

    ldap_set_option($connection, LDAP_OPT_PROTOCOL_VERSION, 3);

if($connection){

	$bind = ldap_bind($connection,"cn=admin,dc=fjeclot,dc=net","fjeclot");	
	if($bind){
	$record["objectclass"][0]= "top";
	$record["objectclass"][1]= "person";
	$record["objectclass"][2]= "organizationalperson";
	$record["objectclass"][3]= "inetorgperson";
	$record["objectclass"][4]= "posixaccount";
	$record["objectclass"][5]= "shadowaccount";
	$record["ou"]=trim($_POST["ou"]);
	$record["uid"]= trim($_POST["uid"]);
	$record["cn"]=$_POST["nombre"]." ".$_POST["apellido"];
	$record["sn"]=trim($_POST["apellido"]);
	$record["givenname"]=trim($_POST["nombre"]);
	$record["title"]=trim($_POST["titulo"]);
	$record["telephonenumber"]=$_POST["telefono"];
	$record["mobile"]=$_POST["mobil"];
	$record["postaladdress"]=$_POST["direccion"];
	$record["gidnumber"]= trim($_POST["gidnumber"]);
	$record["uidnumber"]=trim($_POST["uidnumber"]);
	$record["loginshell"]= "/bin/bash";
	$record["homedirectory"]= "/home/".$_POST["uid"];
	$record["description"]= $_POST["descripcion"];
	
	$uid=trim($_POST["uid"]);
	$d="uid=".$uid.",ou=usuaris,dc=fjeclot,dc=net";

	$a = ldap_add($connection, $d, $record);
	if($a){$_SESSION["mainTittle"]="Usuario creado con éxito";
		$_SESSION["secondaryTittle"]="El usuario ".$uid." se ha añadido a la base de datos";
		$_SESSION["href"]="crear.php";
		header("Location: success.php");
	}else{
		
		$_SESSION["mainTittle"] = "FALLO AL CREAR NUEVA ENTRADA";
		$_SESSION["secondaryTittle"] = "No ha sido posible crear un nuevo usuario en la base de datos :".$a;
		$_SESSION["href"]="crear.php";
		header("Location:error.php");
	}	
	}else{
		$_SESSION["mainTittle"] = "FALLO AL CREAR NUEVA ENTRADA";
		$_SESSION["secondaryTittle"] = "No ha sido posible crear un nuevo usuario en la base de datos :".$a;
		$_SESSION["href"]="crear.php";
		header("Location:error.php");
	}	
}else{echo "error";}	

}

//borar usuarios
if( isset($_POST['borrar']) && $_POST['borrar']=="Borrar")
{
$ldaphost = "localhost";
$ldaprdn  = 'uid='.trim($_POST['uidBorrar']).',ou='.trim($_POST['ouBorrar']).',dc=fjeclot,dc=net';
$ldappass = "fjeclot";  

    $ldapconn = ldap_connect($ldaphost) or die("Could not connect to LDAP server.");
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
    if ($ldapconn) {
        $ldapbind = ldap_bind($ldapconn, "cn=admin,dc=fjeclot,dc=net", $ldappass);
        if ($ldapbind) {
       
                $d = ldap_delete($ldapconn, $ldaprdn);
                if($d){
                $_SESSION["mainTittle"]="Usuario borrado con éxito";
				$_SESSION["secondaryTittle"]="El usuario ".trim($_POST['uidBorrar'])." se ha borrado de la base de datos";
				$_SESSION["href"]="borrar.php";
				header("Location: success.php");}
                else{
				   $_SESSION["mainTittle"] = "FALLO AL BORRAR ENTRADA";
				   $_SESSION["secondaryTittle"] = "No es reconocido el usuario ".trim($_POST['uidBorrar'])."en la base de datos";
				   $_SESSION["href"]="borrar.php";
				   header("Location:error.php");} 
        } 
        else {
        		$_SESSION["mainTittle"] = "FALLO AL ENTRAR BASE DE DATOS";
				$_SESSION["secondaryTittle"] = "No ha sido posible autentificarse";
				$_SESSION["href"]="borrar.php";
				header("Location:error.php");
        }
   }else {
        $_SESSION["mainTittle"] = "FALLO AL CONECTAR BASE DE DATOS";
				$_SESSION["secondaryTittle"] = "No ha sido posible conectarse";
				$_SESSION["href"]="borrar.php";
				header("Location:error.php");
        }
 }

?>
