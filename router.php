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

?>
