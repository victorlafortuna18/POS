<?php 
$host = '190.12.45.140';
$port = 22;
$username = 'domicilio';
$password = 'Mayflower2016';
$remoteDir = '/var/ftp/pedidos/DIRECTORIO/';
$localDir = '/var/www/html/SmartDelivery/resources/txtFiles';
 
if (!function_exists("ssh2_connect"))
    die('Function ssh2_connect does not exist.');
 
if (!$connection = ssh2_connect($host, $port))
    die('Failed to connect.');
 
if (!ssh2_auth_password($connection, $username, $password))
    die('Failed to authenticate.');
 
if (!$sftp_conn = ssh2_sftp($connection))
    die('Failed to create a sftp connection.');
 
if (!$dir = opendir("ssh2.sftp://$sftp_conn$remoteDir"))
    die('Failed to open the directory.');
 
$files = array();
while ( ($file = readdir($dir)) !== false)
{
    if(substr($file, -4)==".TXT")
    {
        $files[]=$file;
    }
}
closedir($dir);
 
foreach ($files as $file)
{
    echo "Copying file: $file\n";
    if (!$remote = fopen("ssh2.sftp://$sftp_conn$remoteDir$file", 'r'))
    {
        echo "Failed to open remote file: $file\n";
        continue;
    }
 
    if (!$local = fopen($localDir . $file, 'w'))
    {
        echo "Failed to create local file: $file\n";
        continue;
    }
 
    $read = 0;
    $filesize = filesize("ssh2.sftp://$sftp_conn/$remoteDir$file");
    while ( ($read < $filesize) && ($buffer = fread($remote, $filesize - $read)) )
    {
        $read += strlen($buffer);
        if (fwrite($local, $buffer) === FALSE)
        {
            echo "Failed to write to local file: $file\n";
            break;
        }
    }
    fclose($local);
    fclose($remote);
}