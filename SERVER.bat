@echo off
setlocal enabledelayedexpansion
chcp 65001 >nul
title HE THONG DIEU KHIEN SERVER - DAI NAO TAY DU
cd /d "%~dp0"

set "WEB_PORT=8089"
set "DB_PORT=3306"
set "GAME_URL=http://127.0.0.1:8089/game.php"
set "GM_URL=http://127.0.0.1:8089/guanli/login.php"

if /i "%~1"=="start" goto DO_START_ALL
if /i "%~1"=="stop" goto DO_STOP_ALL
if /i "%~1"=="restart" goto DO_RESTART_ALL
if /i "%~1"=="status" goto DO_STATUS
if /i "%~1"=="web-start" goto DO_START_WEB
if /i "%~1"=="web-stop" goto DO_STOP_WEB
if /i "%~1"=="server-start" goto DO_START_SERVER
if /i "%~1"=="server-stop" goto DO_STOP_SERVER
if /i "%~1"=="gateway" goto DO_START_GATEWAY
if /i "%~1"=="play" goto DO_PLAY
if /i "%~1"=="gm" goto DO_GM
if /i "%~1"=="fix-flash" goto DO_FIX_FLASH

:MENU
cls
echo ===================================================================
echo             HE THONG QUAN TRI SERVER DAI NAO TAY DU
echo ===================================================================
echo.
echo   [1] KHOI DONG TOAN BO [MySQL, Apache, Gateway, Java Server]
echo   [2] TAT TOAN BO SERVER [Dong an toan tat ca tien trinh]
echo   [3] KHOI DONG LAI TOAN BO [Restart All]
echo.
echo   ------------------ DIEU KHIEN TUNG DICH VU ------------------
echo   [4] Khoi dong rieng Web va Database [Apache va MySQL]
echo   [5] Tat rieng Web va Database
echo   [6] Khoi dong rieng Game Server [Java Core]
echo   [7] Tat rieng Game Server [Java Core]
echo   [8] Khoi dong rieng Login Gateway
echo.
echo   ------------------- TIEN ICH VA TRANG THAI ------------------
echo   [9] Kiem tra trang thai he thong [Status Check]
echo   [P] Mo trinh duyet vao Game [Port %WEB_PORT%]
echo   [G] Mo trang Quan tri GM
echo   [F] Chay sua loi Flash Player [fix hosts]
echo.
echo   [0] Thoat
echo ===================================================================
set /p "CHOICE=Nhap lua chon cua ban [0-9, P, G, F]: "

if "%CHOICE%"=="1" goto DO_START_ALL
if "%CHOICE%"=="2" goto DO_STOP_ALL
if "%CHOICE%"=="3" goto DO_RESTART_ALL
if "%CHOICE%"=="4" goto DO_START_WEB
if "%CHOICE%"=="5" goto DO_STOP_WEB
if "%CHOICE%"=="6" goto DO_START_SERVER
if "%CHOICE%"=="7" goto DO_STOP_SERVER
if "%CHOICE%"=="8" goto DO_START_GATEWAY
if "%CHOICE%"=="9" goto DO_STATUS
if /i "%CHOICE%"=="P" goto DO_PLAY
if /i "%CHOICE%"=="G" goto DO_GM
if /i "%CHOICE%"=="F" goto DO_FIX_FLASH
if "%CHOICE%"=="0" exit /b 0

echo Lua chon khong hop le!
timeout /t 2 >nul
goto MENU

:DO_START_ALL
echo ===================================================================
echo               DANG KHOI DONG TOAN BO SERVER GAME
echo ===================================================================
echo.

echo [1/4] Dang khoi dong MySQL Database [Port %DB_PORT%]...
tasklist /fi "imagename eq mysqld.exe" 2>nul | find /i "mysqld.exe" >nul
if !errorlevel! equ 0 (
    echo       - MySQL da dang chay.
) else (
    start "" "%~dp0GPHWEB\MySQL5\bin\mysqld.exe" --defaults-file="%~dp0GPHWEB\MySQL5\my.ini"
    timeout /t 2 /nobreak >nul
    echo       - Khoi dong MySQL thanh cong.
)

echo [2/4] Dang khoi dong Apache Web Server [Port %WEB_PORT%]...
tasklist /fi "imagename eq httpd.exe" 2>nul | find /i "httpd.exe" >nul
if !errorlevel! equ 0 (
    echo       - Apache da dang chay.
) else (
    start "" "%~dp0GPHWEB\Apache2\bin\httpd.exe" -d "%~dp0GPHWEB\Apache2"
    timeout /t 2 /nobreak >nul
    echo       - Khoi dong Apache thanh cong.
)

echo [3/4] Dang khoi dong Login Gateway...
tasklist /fi "imagename eq Gateway.exe" 2>nul | find /i "Gateway.exe" >nul
if !errorlevel! equ 0 (
    echo       - Gateway da dang chay.
) else (
    if exist "%~dp0Gateway.exe" (
        start "" "%~dp0Gateway.exe"
    ) else (
        start "" "%~dp0_2_~1.EXE"
    )
    timeout /t 2 /nobreak >nul
    echo       - Khoi dong Gateway thanh cong.
)

echo [4/4] Dang khoi dong Java Game Server Core...
tasklist /fi "imagename eq java.exe" 2>nul | find /i "java.exe" >nul
if !errorlevel! equ 0 (
    echo       - Java Game Server da dang chay.
) else (
    cd /d "%~dp0server"
    start "GAME_SERVER_JAVA" "%~dp0server\jre6\bin\java.exe" -cp "./;lib/*;lib/Jetty/*;extensions/__lib__/*" -server -Xms256m -Xmx768m -XX:PermSize=128M -XX:MaxPermSize=192M -jar dntg_start.jar
    cd /d "%~dp0"
    timeout /t 2 /nobreak >nul
    echo       - Da mo cua so tien trinh Game Server Java.
)

echo.
echo ===================================================================
echo   DA KHOI DONG XONG HET CAC DICH VU! DANG MO GAME...
echo   Luu y: Cho 30-60 giay de Java nap hoan tat du lieu.
echo ===================================================================
timeout /t 3 /nobreak >nul
start %GAME_URL%

if "%~1"=="" (
    pause
    goto MENU
)
exit /b 0

:DO_STOP_ALL
echo ===================================================================
echo               DANG DUNG TOAN BO HE THONG SERVER
echo ===================================================================
echo.
echo Dang dong tien trinh Java Server...
taskkill /f /im java.exe >nul 2>&1
echo Dang dong tien trinh Apache Web Server...
taskkill /f /im httpd.exe >nul 2>&1
echo Dang dong tien trinh MySQL Database...
taskkill /f /im mysqld.exe >nul 2>&1
echo Dang dong tien trinh Login Gateway...
taskkill /f /im Gateway.exe >nul 2>&1
taskkill /f /im _2_~1.EXE >nul 2>&1
taskkill /f /im ESSamp.exe >nul 2>&1

echo.
echo ===================================================================
echo   DA TAT TOAN BO DICH VU HOAN TAT VA AN TOAN!
echo ===================================================================
if "%~1"=="" (
    pause
    goto MENU
)
exit /b 0

:DO_RESTART_ALL
call :DO_STOP_ALL auto
timeout /t 2 /nobreak >nul
call :DO_START_ALL auto
if "%~1"=="" (
    pause
    goto MENU
)
exit /b 0

:DO_START_WEB
echo Dang khoi dong MySQL Database...
start "" "%~dp0GPHWEB\MySQL5\bin\mysqld.exe" --defaults-file="%~dp0GPHWEB\MySQL5\my.ini"
timeout /t 2 /nobreak >nul
echo Dang khoi dong Apache Web Server [Port %WEB_PORT%]...
start "" "%~dp0GPHWEB\Apache2\bin\httpd.exe" -d "%~dp0GPHWEB\Apache2"
timeout /t 2 /nobreak >nul
echo Web va Database da duoc kich hoat!
if "%~1"=="" (
    pause
    goto MENU
)
exit /b 0

:DO_STOP_WEB
echo Dang tat Apache va MySQL...
taskkill /f /im httpd.exe >nul 2>&1
taskkill /f /im mysqld.exe >nul 2>&1
echo Da tat Web va Database!
if "%~1"=="" (
    pause
    goto MENU
)
exit /b 0

:DO_START_SERVER
echo Dang khoi dong Java Game Server...
cd /d "%~dp0server"
start "GAME_SERVER_JAVA" "%~dp0server\jre6\bin\java.exe" -cp "./;lib/*;lib/Jetty/*;extensions/__lib__/*" -server -Xms256m -Xmx768m -XX:PermSize=128M -XX:MaxPermSize=192M -jar dntg_start.jar
cd /d "%~dp0"
echo Da mo tien trinh Game Server Java!
if "%~1"=="" (
    pause
    goto MENU
)
exit /b 0

:DO_STOP_SERVER
echo Dang tat Game Server Java...
taskkill /f /im java.exe >nul 2>&1
echo Da tat Game Server Java!
if "%~1"=="" (
    pause
    goto MENU
)
exit /b 0

:DO_START_GATEWAY
echo Dang khoi dong Login Gateway...
if exist "%~dp0Gateway.exe" (
    start "" "%~dp0Gateway.exe"
) else (
    start "" "%~dp0_2_~1.EXE"
)
echo Da khoi dong Gateway!
if "%~1"=="" (
    pause
    goto MENU
)
exit /b 0

:DO_STATUS
echo ===================================================================
echo               TRANG THAI CAC TIEN TRINH SERVER
echo ===================================================================
echo.

tasklist /fi "imagename eq mysqld.exe" 2>nul | find /i "mysqld.exe" >nul
if !errorlevel! equ 0 (
    echo   [+] MySQL Database      : [DANG CHAY] [Port %DB_PORT%]
) else (
    echo   [-] MySQL Database      : [DA TAT]
)

tasklist /fi "imagename eq httpd.exe" 2>nul | find /i "httpd.exe" >nul
if !errorlevel! equ 0 (
    echo   [+] Apache Web Server   : [DANG CHAY] [Port %WEB_PORT%]
) else (
    echo   [-] Apache Web Server   : [DA TAT]
)

tasklist /fi "imagename eq Gateway.exe" 2>nul | find /i "Gateway.exe" >nul
if !errorlevel! equ 0 (
    echo   [+] Login Gateway       : [DANG CHAY]
) else (
    tasklist /fi "imagename eq _2_~1.EXE" 2>nul | find /i ".exe" >nul
    if !errorlevel! equ 0 (
        echo   [+] Login Gateway       : [DANG CHAY]
    ) else (
        echo   [-] Login Gateway       : [DA TAT]
    )
)

tasklist /fi "imagename eq java.exe" 2>nul | find /i "java.exe" >nul
if !errorlevel! equ 0 (
    echo   [+] Java Game Server    : [DANG CHAY]
) else (
    echo   [-] Java Game Server    : [DA TAT]
)

echo.
echo ===================================================================
echo   Cong ket noi dang lang nghe:
netstat -ano | findstr /R ":%WEB_PORT% :%DB_PORT%" 2>nul
echo ===================================================================
if "%~1"=="" (
    pause
    goto MENU
)
exit /b 0

:DO_PLAY
start %GAME_URL%
if "%~1"=="" goto MENU
exit /b 0

:DO_GM
start %GM_URL%
if "%~1"=="" goto MENU
exit /b 0

:DO_FIX_FLASH
if exist "%~dp0fix_hosts.bat" (
    call "%~dp0fix_hosts.bat"
)
if exist "%~dp0Sua_Loi_Flash.vbs" (
    wscript.exe "%~dp0Sua_Loi_Flash.vbs"
)
echo Hoan tat thao tac sua loi Flash!
pause
goto MENU
