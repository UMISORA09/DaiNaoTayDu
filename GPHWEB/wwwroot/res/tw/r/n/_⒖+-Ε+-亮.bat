@echo off
set startDir = %CD%
if(%1)==('help') GOTO USAGE
IF (%1)==() ( 
    set work_dir=%cd% 
) ELSE ( 
    set work_dir=%1 
)
cd /d %1
SET counter=0
REM * 
dir /B /A:-D %1 > upx8.txt
REM * 
FOR /F %%i IN (dirs.txt) DO (
    set /A Counter += 1
)
echo %Counter%
REM * 
cd /d %startDir%
GOTO END
:USAGE
echo upx8.bat
echo _
echo Usage upx8 [dir]
:END