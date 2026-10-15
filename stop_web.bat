@echo off
chcp 65001 >nul
echo Dang tat dich vu Apache va MySQL...
taskkill /f /im httpd.exe >nul 2>&1
taskkill /f /im mysqld.exe >nul 2>&1
taskkill /f /im ESSamp.exe >nul 2>&1
echo Da tat hoan tat!
pause

