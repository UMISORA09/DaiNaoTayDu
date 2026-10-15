@echo off
title GAME SERVER JAVA CORE
cd /d "%~dp0"
echo Dang khoi dong Game Server Java...
jre6\bin\java.exe -cp "./;lib/*;lib/Jetty/*;extensions/__lib__/*" -server -Xms256m -Xmx768m -XX:PermSize=128M -XX:MaxPermSize=192M -jar dntg_start.jar
pause
