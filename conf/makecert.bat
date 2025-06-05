@echo off
set OPENSSL_CONF=./conf/openssl.cnf

if not exist .\conf\ssl.crt mkdir .\conf\ssl.crt
if not exist .\conf\ssl.key mkdir .\conf\ssl.key

bin\openssl req -new -out server.csr
bin\openssl rsa -in privkey.pem -out server.key
bin\openssl x509 -in server.csr -out server.crt -req -signkey server.key -days 365 -extfile v3.ext

set OPENSSL_CONF=
del .rnd
del privkey.pem
del server.csr

move /y server.crt .\conf\ssl.crt
move /y server.key .\conf\ssl.key

echo.
echo -----
echo Das Zertifikat wurde erstellt.
echo The certificate was provided.
echo.
pause
