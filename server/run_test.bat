@echo off
cd /d "%~dp0"
jre6\bin\java.exe -cp "./;lib/*;lib/Jetty/*;extensions/__lib__/*" -server -Xms256m -Xmx1024m -XX:PermSize=256M -XX:MaxPermSize=256M -jar dntg_start.jar
