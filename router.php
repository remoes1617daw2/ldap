<?php
	session_start();
	$puerto=389;
	$ldaphost = "ldap://localhost";
 
$usuario;
$contraseña;


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



if(isset($_POST['enviar']) && $_POST['enviar']=='enviar'){
	
	$usuario=$_POST['nombre'];
	$ldapuser  = "cn=".$usuario.",dc=fjeclot,dc=net";
	$contraseña=$_POST['contraseña'];
	
	$coneccion=ldap_connect($ldaphost,$puerto) or die("No ha sido posible conectarse a la base de datos");
	ldap_set_option($coneccion,LDAP_OPT_PROTOCOL_VERSION, 3);
	if($coneccion){
		$binding=ldap_bind($coneccion,$ldapuser,$contraseña);
			if($binding){
			$_SESSION["coneccion"]=$coneccion;
			$_SESSION["binding"]=$binding;
			$_SESSION["user"]=$ldapuser;
			$_SESSION["pass"]=$contraseña;
			header("Location: opciones.php");
			
			/*$parametro="cn=".$usuario."";
			$array_Busqueda=array("ou");
			$resultado_Busqueda=ldap_list($ldaphost,$parametro,"ou=*",$array_Busqueda);
			$info_Busqueda=ldap_get_entries($ldaphost,$resultado_Busqueda);
				
			for($i=0;$i<$info_Busqueda["count"];$i++){
				
				echo $info_Busqueda[$i]["ou"][0];
				
		}*/
		
	}else{
		$_SESSION["mainTittle"] = "FALLO DE CONECCIÓN";
		$_SESSION["secondaryTittle"] = "No ha sido posible conectar con la base de datos";
		$_SESSION["href"]="login.php";
	header("Location: error.php");
}
	}else{
		$_SESSION["mainTittle"] = "FALLO AL ENTRAR";
		$_SESSION["secondaryTittle"] = "Nombre de usuario o contraseña incorrecta";
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

$_SESSION["mainTittle"]="Fallo de conexión";
$_SESSION["secondaryTittle"]="No ha sido posible conectar con la base de datos";
$_SESSION["href"]="mostrar.php";
$connection = ldap_connect("ldap://localhost", $puerto) or die(header("Location:error.php"));

    ldap_set_option($connection, LDAP_OPT_PROTOCOL_VERSION, 3);

	if ($connection) {
		$bind = ldap_bind($connection);	
		if($bind){
$_SESSION["mainTittle"]="Fallo al mostrar usuarios";
$_SESSION["secondaryTittle"]="No ha sido posible realizar la búsqueda";
$_SESSION["href"]="mostrar.php";
			$resul=ldap_search($connection,$n, $filtro) or die (header("Location:error.php"));

			$info = ldap_get_entries($connection, $resul);
			$_SESSION["info"]=$info;
			$_SESSION["mainTittle"]="Resultados de busqueda :";
			$_SESSION["href"]="mostrar.php";
			header("Location:resultado_mostrar.php");


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
?>
