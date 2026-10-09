@echo off
setlocal
chcp 65001 >nul

:: Kiem tra quyen Admin
net session >nul 2>&1
if %errorlevel% neq 0 (
    echo [THONG BAO] Vui long chay file nay bang quyen Quan tri vien (Run as Administrator)!
    echo Chuot phai vao file -> Chon "Run as administrator".
    pause
    exit /b 1
)

set HOSTS=%WINDIR%\System32\drivers\etc\hosts

findstr /C:"geo2.adobe.com" "%HOSTS%" >nul 2>&1
if %errorlevel% neq 0 echo 127.0.0.1 geo2.adobe.com>> "%HOSTS%"

findstr /C:"flash.2144.com" "%HOSTS%" >nul 2>&1
if %errorlevel% neq 0 echo 127.0.0.1 flash.2144.com>> "%HOSTS%"

findstr /C:"www.2144.cn" "%HOSTS%" >nul 2>&1
if %errorlevel% neq 0 echo 127.0.0.1 www.2144.cn>> "%HOSTS%"

findstr /C:"macromedia.com" "%HOSTS%" >nul 2>&1
if %errorlevel% neq 0 echo 127.0.0.1 macromedia.com>> "%HOSTS%"

findstr /C:"flash.cn" "%HOSTS%" >nul 2>&1
if %errorlevel% neq 0 echo 127.0.0.1 flash.cn>> "%HOSTS%"

findstr /C:"api.flash.cn" "%HOSTS%" >nul 2>&1
if %errorlevel% neq 0 echo 127.0.0.1 api.flash.cn>> "%HOSTS%"

ipconfig /flushdns >nul
echo [THANH CONG] Da cap nhat file hosts va xoa DNS Cache xong!
pause
