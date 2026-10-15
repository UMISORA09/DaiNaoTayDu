@echo off
title TAT TOAN BO SERVER
echo Dang tat toan bo tien trinh Server...

taskkill /f /im java.exe >nul 2>&1
taskkill /f /im httpd.exe >nul 2>&1
taskkill /f /im mysqld.exe >nul 2>&1
taskkill /f /im "[2].登录器网关.exe" >nul 2>&1
taskkill /f /im ESSamp.exe >nul 2>&1

echo ========================================================
echo   DA TAT TOAN BO SERVER VA WEB HOAN TAT!
echo ========================================================
timeout /t 3 >nul
exit
