<?php
	session_start();
	$puerto=389;
	$ldaphost = "ldap://localhost";
 
$usuario;
$contraseña;

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
if(isset($_POST['mostrar'])&& $_POST['mostrar']=='mostrar'){
$n=	$_POST["nombre"]." ".$_POST["apellido"];
$atrb =array("uid","cn","sn","givenName","description");
$base="";
$_SESSION["mainTittle"]="Fallo al mostrar usuario/s";
$_SESSION["secondaryTittle"]="Se ha producido un error al realiazar esta busqueda";
$_SESSION["href"]="mostrar.php";
$resul=ldap_search($_SESSION["coneccion"],$base,"cn=".$n,$atrb) or die (header("Location:error.php"));

$info = ldap_get_entries($_SESSION["coneccion"], $resul);
$_SESSION["info"]=$info;
/*
for($i=0;$i<info["count"];$i++){
	echo $info[$i]["uid"][0];
	echo $info[$i]["cn"][0];
	echo $info[$i]["sn"][0];
	echo $info[$i]["givenName"][0];
	echo $info[$i]["description"][0];
}*/
}
if(isset($_POST['crear']) && $_POST['crear']=='enviar'){


	if($_SESSION["binding"]){
	$record["objectclass"][0]="top";
	$record["objectclass"][1]="person";
	$record["objectclass"][2]="organizationalPerson";
	$record["objectclass"][3]="inetOrgPerson";
	$record["objectclass"][4]="posixAccount";
	$record["objectclass"][5]="shadowAccount";
	$record["uid"]=$_POST["uid"];
	$record["cn"]=$_POST["nombre"]." ".$_POST["apellido"];
	$record["sn"]=$_POST["apellido"];
	$record["givenName"]=$_POST["nombre"];
	$record["title"]=$_POST["titulo"];
	$record["telephoneNumber"]=$_POST["telefono"];
	$record["mobile"]=$_POST["mobil"];
	$record["direccion"]=$_POST["direccion"];
	$record["numero"]=$_POST["numero"];
	$record["loginShell"]="/bin/bash";
	$record["homeDirectory"]="/home/".$_POST["uid"];
	$record["description"]=$_POST["descripcion"];

	$a = ldap_add($_SESSION["coneccion"],"".$_POST["nombre"].",dc=fjeclot,dc=net",$record);
	if($a){$_SESSION["mainTittle"]="Usuario creado con éxito";
		$_SESSION["secondaryTittle"]=$a;
		$_SESSION["href"]="crear.php";
		header("Location: success.php");
	}
	}else{
		$_SESSION["mainTittle"] = "FALLO AL CREAR NUEVA ENTRADA";
		$_SESSION["secondaryTittle"] = "No ha sido posible crear un nuevo usuario en la base de datos :".$a;
		$_SESSION["href"]="crear.php";
		header("Location:error.php");
	}	
	

}
?>
