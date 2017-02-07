#!/bin/sh
cd /var/www/html/SmartDelivery/resources/txtFiles
rm -rf BITACORA.TXT
lftp -u domicilio,Mayflower2016 sftp://190.12.45.140 << --EOF--
cd DIRECTORIO
get BITACORA.TXT
quit
--EOF--