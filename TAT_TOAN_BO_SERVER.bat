@echo off
chcp 65001 >nul
title TAT TOAN BO SERVER GAME
echo Dang tat toan bo tien trinh Server Game...
taskkill /f /im java.exe >nul 2>&1
taskkill /f /im httpd.exe >nul 2>&1
taskkill /f /im mysqld.exe >nul 2>&1
taskkill /f /im Gateway.exe >nul 2>&1
taskkill /f /im "[2].登录器网关.exe" >nul 2>&1
taskkill /f /im ESSamp.exe >nul 2>&1
echo Da tat hoan tat toan bo he thong!
pause
