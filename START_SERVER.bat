@echo off
title KHOI DONG TOAN BO SERVER
cd /d "%~dp0"

echo [1/4] Dang bat MySQL (Port 3306)...
start "" "%~dp0GPHWEB\MySQL5\bin\mysqld.exe" --defaults-file="%~dp0GPHWEB\MySQL5\my.ini"
timeout /t 2 /nobreak >nul

echo [2/4] Dang bat Apache (Port 8089)...
start "" "%~dp0GPHWEB\Apache2\bin\httpd.exe" -d "%~dp0GPHWEB\Apache2"
timeout /t 2 /nobreak >nul

echo [3/4] Dang bat Gateway...
if exist "%~dp0Gateway.exe" (
    start "" "%~dp0Gateway.exe"
) else if exist "%~dp0_2_~1.EXE" (
    start "" "%~dp0_2_~1.EXE"
) else (
    start "" "%~dp0[2].登录器网关.exe"
)
timeout /t 2 /nobreak >nul

echo [4/4] Dang bat Server Java...
cd /d "%~dp0server"
start "GAME_SERVER_JAVA" "%~dp0server\jre6\bin\java.exe" -cp "./;lib/*;lib/Jetty/*;extensions/__lib__/*" -server -Xms256m -Xmx768m -XX:PermSize=128M -XX:MaxPermSize=192M -jar dntg_start.jar
timeout /t 2 /nobreak >nul

echo ========================================================
echo   DA KHOI DONG XONG! DANG MO GAME TREN TRINH DUYET...
echo ========================================================
start http://127.0.0.1:8089/
exit
