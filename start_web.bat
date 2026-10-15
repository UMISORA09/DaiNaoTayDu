@echo off
chcp 65001 >nul
echo ===================================================
echo     DANG KHOI DONG DICH VU WEB VA DATABASE...
echo ===================================================

cd /d "%~dp0GPHWEB"

:: Khoi dong MySQL
echo [1/2] Dang khoi dong MySQL (Port 3306)...
start "" "%~dp0GPHWEB\MySQL5\bin\mysqld.exe" --defaults-file="%~dp0GPHWEB\MySQL5\my.ini"

timeout /t 2 >nul

:: Khoi dong Apache
echo [2/2] Dang khoi dong Apache Web Server (Port 8089)...
start "" "%~dp0GPHWEB\Apache2\bin\httpd.exe" -d "%~dp0GPHWEB\Apache2"

timeout /t 2 >nul

echo ===================================================
echo   DA KHOI DONG THANH CONG!
echo   Dang mo trinh duyet: http://127.0.0.1:8089/
echo ===================================================
start http://127.0.0.1:8089/

exit
