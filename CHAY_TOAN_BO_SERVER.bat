@echo off
title KHOI DONG SERVER DAI NAO THIEN CUNG
cd /d "%~dp0"

echo [1/4] Khoi dong MySQL...
start "" "%~dp0GPHWEB\MySQL5\bin\mysqld.exe" --defaults-file="%~dp0GPHWEB\MySQL5\my.ini"
timeout /t 2 /nobreak >nul

echo [2/4] Khoi dong Apache...
start "" "%~dp0GPHWEB\Apache2\bin\httpd.exe" -d "%~dp0GPHWEB\Apache2"
timeout /t 2 /nobreak >nul

echo [3/4] Khoi dong Gateway...
start "" "%~dp0[2].登录器网关.exe"
timeout /t 2 /nobreak >nul

echo [4/4] Khoi dong Game Server...
cd /d "%~dp0server"
start "[3].JAVA_SERVER" cmd /c "jre6\bin\java -cp ./;lib/*;lib/Jetty/*;extensions/__lib__/* -server -Xms256m -Xmx768m -XX:PermSize=128M -XX:MaxPermSize=192M -jar dntg_start.jar & pause"

echo.
echo ========================================================
echo   DA KHOI DONG XONG! MO TRINH DUYET TRONG 3 GIAY...
echo ========================================================
timeout /t 3 /nobreak >nul
start http://127.0.0.1:81/

exit
