@echo off
cd ..\mysql5
start bin\mysqld.exe --defaults-file='%cd%\my.ini' --port=3306
ping 127.0.0.1>nul