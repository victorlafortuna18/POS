<?php
$strServer = "190.12.45.140";
$strServerPort = "22";
$strServerUsername = "domicilio";
$strServerPassword = "Mayflower2016";
//$csv_filename = "test.csv";

$localFile='resources/txtFiles/BITACORA.TXT';
$remoteFile='/var/ftp/pedidos/DIRECTORIO/BITACORA.TXT';
// $remoteFile="/var/ftp/pedidos/DIRECTORIO/enviar.sh";

//connect to server
$resConnection = ssh2_connect($strServer, $strServerPort);

if(ssh2_auth_password($resConnection, $strServerUsername, $strServerPassword)){
    //Initialize SFTP subsystem

    echo "connected";
    //echo $reSFTP;
    $resSFTP = ssh2_sftp($resConnection);    

	echo "<p/>";
	
	//$copy = ssh2_scp_recv($resConnection, "/var/ftp/pedidos/DIRECTORIO/BITACORA.TXT",$localFile);
	$copy = ssh2_scp_recv($resConnection, $remoteFile,$localFile);
	
	echo "<p>Opening external file <strong>" . $remoteFile . "</strong> to copy into a local file <strong>". $localFile ."</strong></p>";
	if($copy){
		
		$fp = fopen($localFile, "r");
		while(!feof($fp)) {
		$linea = fgets($fp);
		echo $linea . "<br />";
		}
		fclose($fp);
		
		echo "<h4>Copiado exitosamente!</h4>";
	}else{
		echo "Error al copiar";
	}

}else{
    echo "Unable to authenticate on server";
}




?>

