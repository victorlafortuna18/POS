#!/bin/sh
cd /var/www/html/SmartDelivery/resources/txtFiles
rm -rf BITACORA.TXT
lftp -u domicilio,Mayflower2016 sftp://190.12.45.140 << --EOF--
cd DIRECTORIO
get BITACORA.TXT
quit
--EOF--


echo "OK, starting now..."
cd /var/www/html/SmartDelivery/resources/txtFiles
mysql -u root -pOctagonoerp@1 << eof
use smartdelivery;
truncate table orden_origen_txt;
LOAD DATA INFILE '/var/www/html/SmartDelivery/resources/txtFiles/BITACORA.TXT' INTO TABLE orden_origen_txt COLUMNS TERMINATED BY "," OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES;
CALL Corrige_enies();
CALL Inserta_Registros_Ordenes();
eof
