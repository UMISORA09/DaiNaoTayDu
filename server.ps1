<#
.SYNOPSIS
    He thong quan ly va dieu khien Server Dai Nao Tay Du (PowerShell)
.DESCRIPTION
    Cung cap day du cac tinh nang Khoi dong, Dung, Khoi dong lai, Kiem tra trang thai
    cac dich vu MySQL, Apache, Login Gateway va Java Game Server.
.EXAMPLE
    .\server.ps1 start
    .\server.ps1 stop
    .\server.ps1 restart
    .\server.ps1 status
#>
[CmdletBinding()]
param (
    [ValidateSet("start", "stop", "restart", "status", "web-start", "web-stop", "server-start", "server-stop", "gateway", "play", "gm", "help")]
    [string]$Action
)

$baseDir = $PSScriptRoot
if (-not $baseDir) { $baseDir = (Get-Location).Path }

$webPort = 8089
$dbPort = 3306
$gameUrl = "http://127.0.0.1:$webPort/game.php"
$gmUrl = "http://127.0.0.1:$webPort/guanli/login.php"

function Start-AllServices {
    Write-Host "===================================================================" -ForegroundColor Cyan
    Write-Host "               DANG KHOI DONG TOAN BO SERVER GAME                  " -ForegroundColor Cyan
    Write-Host "===================================================================" -ForegroundColor Cyan
    Write-Host ""

    # 1. MySQL
    Write-Host "[1/4] Khoi dong MySQL Database (Port $dbPort)..." -ForegroundColor Yellow
    if (-not (Get-Process -Name "mysqld" -ErrorAction SilentlyContinue)) {
        Start-Process -FilePath "$baseDir\GPHWEB\MySQL5\bin\mysqld.exe" -ArgumentList ('--defaults-file="' + "$baseDir\GPHWEB\MySQL5\my.ini" + '"') -WindowStyle Hidden
        Start-Sleep -Seconds 2
        Write-Host "      - Khoi dong MySQL thanh cong." -ForegroundColor Green
    } else {
        Write-Host "      - MySQL da dang chay." -ForegroundColor Gray
    }

    # 2. Apache
    Write-Host "[2/4] Khoi dong Apache Web Server (Port $webPort)..." -ForegroundColor Yellow
    if (-not (Get-Process -Name "httpd" -ErrorAction SilentlyContinue)) {
        Start-Process -FilePath "$baseDir\GPHWEB\Apache2\bin\httpd.exe" -ArgumentList ('-d "' + "$baseDir\GPHWEB\Apache2" + '"') -WindowStyle Hidden
        Start-Sleep -Seconds 2
        Write-Host "      - Khoi dong Apache thanh cong." -ForegroundColor Green
    } else {
        Write-Host "      - Apache da dang chay." -ForegroundColor Gray
    }

    # 3. Gateway
    Write-Host "[3/4] Khoi dong Login Gateway..." -ForegroundColor Yellow
    $gwProc = Get-Process -Name "Gateway" -ErrorAction SilentlyContinue
    if (-not $gwProc) {
        $gwFile = "$baseDir\Gateway.exe"
        if (-not (Test-Path $gwFile)) {
            $gwFound = Get-ChildItem -Path $baseDir -Filter "*2*.exe" | Select-Object -First 1
            if ($gwFound) { $gwFile = $gwFound.FullName }
        }
        if (Test-Path $gwFile) {
            Start-Process -FilePath $gwFile
            Start-Sleep -Seconds 2
            Write-Host "      - Khoi dong Gateway thanh cong." -ForegroundColor Green
        }
    } else {
        Write-Host "      - Gateway da dang chay." -ForegroundColor Gray
    }

    # 4. Java Game Server
    Write-Host "[4/4] Khoi dong Java Game Server Core..." -ForegroundColor Yellow
    if (-not (Get-Process -Name "java" -ErrorAction SilentlyContinue)) {
        Start-Process cmd.exe -ArgumentList ('/k "cd /d """' + "$baseDir\server" + '""" && jre6\bin\java.exe -cp ./;lib/*;lib/Jetty/*;extensions/__lib__/* -server -Xms256m -Xmx768m -XX:PermSize=128M -XX:MaxPermSize=192M -jar dntg_start.jar"')
        Start-Sleep -Seconds 2
        Write-Host "      - Da mo tien trinh Game Server Java." -ForegroundColor Green
    } else {
        Write-Host "      - Java Game Server da dang chay." -ForegroundColor Gray
    }

    Write-Host ""
    Write-Host "===================================================================" -ForegroundColor Green
    Write-Host "  DA KHOI DONG XONG HET CAC DICH VU! DANG MO GAME TREN TRINH DUYET" -ForegroundColor Green
    Write-Host "  Luu y: Cho 30-60 giay de Java nap hoan tat du lieu.             " -ForegroundColor Green
    Write-Host "===================================================================" -ForegroundColor Green
    Start-Sleep -Seconds 2
    Start-Process $gameUrl
}

function Stop-AllServices {
    Write-Host "===================================================================" -ForegroundColor Red
    Write-Host "               DANG DUNG TOAN BO HE THONG SERVER                   " -ForegroundColor Red
    Write-Host "===================================================================" -ForegroundColor Red
    Write-Host ""
    
    $killList = @("java", "httpd", "mysqld", "Gateway", "ESSamp")
    foreach ($p in $killList) {
        $procs = Get-Process -Name $p -ErrorAction SilentlyContinue
        if ($procs) {
            Write-Host "Dang dong tien trinh: $p..." -ForegroundColor Yellow
            $procs | Stop-Process -Force -ErrorAction SilentlyContinue
        }
    }
    # Tim tat ca gateway theo ten tieng Trung neu con sot
    Get-Process | Where-Object { $_.ProcessName -like "*2*" -or $_.ProcessName -like "*登录器*" } | Stop-Process -Force -ErrorAction SilentlyContinue

    Write-Host ""
    Write-Host "===================================================================" -ForegroundColor Green
    Write-Host "   DA TAT TOAN BO DICH VU HOAN TAT VA AN TOAN!                    " -ForegroundColor Green
    Write-Host "===================================================================" -ForegroundColor Green
}

function Show-SystemStatus {
    Write-Host "===================================================================" -ForegroundColor Cyan
    Write-Host "               TRANG THAI CAC TIEN TRINH SERVER                    " -ForegroundColor Cyan
    Write-Host "===================================================================" -ForegroundColor Cyan
    Write-Host ""

    $my = Get-Process -Name "mysqld" -ErrorAction SilentlyContinue
    if ($my) {
        Write-Host "  [+] MySQL Database      : [DANG CHAY] (Port $dbPort) - PID: $($my.Id)" -ForegroundColor Green
    } else {
        Write-Host "  [-] MySQL Database      : [DA TAT]" -ForegroundColor Red
    }

    $ap = Get-Process -Name "httpd" -ErrorAction SilentlyContinue
    if ($ap) {
        Write-Host "  [+] Apache Web Server   : [DANG CHAY] (Port $webPort) - PID: $($ap[0].Id)" -ForegroundColor Green
    } else {
        Write-Host "  [-] Apache Web Server   : [DA TAT]" -ForegroundColor Red
    }

    $gw = Get-Process | Where-Object { $_.ProcessName -eq "Gateway" -or $_.ProcessName -like "*登录器*" }
    if ($gw) {
        Write-Host "  [+] Login Gateway       : [DANG CHAY] - PID: $($gw[0].Id)" -ForegroundColor Green
    } else {
        Write-Host "  [-] Login Gateway       : [DA TAT]" -ForegroundColor Red
    }

    $jv = Get-Process -Name "java" -ErrorAction SilentlyContinue
    if ($jv) {
        Write-Host "  [+] Java Game Server    : [DANG CHAY] - PID: $($jv[0].Id)" -ForegroundColor Green
    } else {
        Write-Host "  [-] Java Game Server    : [DA TAT]" -ForegroundColor Red
    }

    Write-Host ""
    Write-Host "===================================================================" -ForegroundColor Cyan
    Write-Host "  Cong ket noi dang lang nghe:" -ForegroundColor Cyan
    Get-NetTCPConnection -LocalPort $dbPort, $webPort -ErrorAction SilentlyContinue | Select-Object LocalAddress, LocalPort, State, OwningProcess | Format-Table -AutoSize
    Write-Host "===================================================================" -ForegroundColor Cyan
}

if ($Action) {
    switch ($Action.ToLower()) {
        "start"        { Start-AllServices }
        "stop"         { Stop-AllServices }
        "restart"      { Stop-AllServices; Start-Sleep -Seconds 2; Start-AllServices }
        "status"       { Show-SystemStatus }
        "web-start"    {
            Write-Host "Khoi dong MySQL & Apache..." -ForegroundColor Yellow
            Start-Process "$baseDir\GPHWEB\MySQL5\bin\mysqld.exe" ('--defaults-file="' + "$baseDir\GPHWEB\MySQL5\my.ini" + '"') -WindowStyle Hidden
            Start-Process "$baseDir\GPHWEB\Apache2\bin\httpd.exe" ('-d "' + "$baseDir\GPHWEB\Apache2" + '"') -WindowStyle Hidden
            Write-Host "Web va Database da san sang!" -ForegroundColor Green
        }
        "web-stop"     {
            Get-Process -Name "httpd", "mysqld" -ErrorAction SilentlyContinue | Stop-Process -Force
            Write-Host "Da tat Apache & MySQL." -ForegroundColor Green
        }
        "server-start" {
            Start-Process cmd.exe -ArgumentList ('/k "cd /d """' + "$baseDir\server" + '""" && jre6\bin\java.exe -cp ./;lib/*;lib/Jetty/*;extensions/__lib__/* -server -Xms256m -Xmx768m -XX:PermSize=128M -XX:MaxPermSize=192M -jar dntg_start.jar"')
            Write-Host "Da bat Java Game Server." -ForegroundColor Green
        }
        "server-stop"  {
            Get-Process -Name "java" -ErrorAction SilentlyContinue | Stop-Process -Force
            Write-Host "Da tat Java Game Server." -ForegroundColor Green
        }
        "gateway"      {
            Start-Process "$baseDir\Gateway.exe"
            Write-Host "Da bat Gateway." -ForegroundColor Green
        }
        "play"         { Start-Process $gameUrl }
        "gm"           { Start-Process $gmUrl }
    }
    exit 0
}

# Menu tuong tac neu chay khong tham so
while ($true) {
    Clear-Host
    Write-Host "===================================================================" -ForegroundColor Cyan
    Write-Host "             HE THONG QUAN TRI SERVER DAI NAO TAY DU               " -ForegroundColor Cyan
    Write-Host "===================================================================" -ForegroundColor Cyan
    Write-Host ""
    Write-Host "   [1] KHOI DONG TOAN BO (MySQL, Apache, Gateway, Java Server)" -ForegroundColor White
    Write-Host "   [2] TAT TOAN BO SERVER (Dong an toan tat ca tien trinh)" -ForegroundColor White
    Write-Host "   [3] KHOI DONG LAI TOAN BO (Restart All)" -ForegroundColor White
    Write-Host ""
    Write-Host "   ------------------ DIEU KHIEN TUNG DICH VU ------------------" -ForegroundColor DarkGray
    Write-Host "   [4] Khoi dong rieng Web va Database (Apache va MySQL)" -ForegroundColor White
    Write-Host "   [5] Tat rieng Web va Database" -ForegroundColor White
    Write-Host "   [6] Khoi dong rieng Game Server (Java Core)" -ForegroundColor White
    Write-Host "   [7] Tat rieng Game Server (Java Core)" -ForegroundColor White
    Write-Host "   [8] Khoi dong rieng Login Gateway" -ForegroundColor White
    Write-Host ""
    Write-Host "   ------------------- TIEN ICH VA TRANG THAI ------------------" -ForegroundColor DarkGray
    Write-Host "   [9] Kiem tra trang thai he thong (Status Check)" -ForegroundColor White
    Write-Host "   [P] Mo trinh duyet vao Game (Port $webPort)" -ForegroundColor White
    Write-Host "   [G] Mo trang Quan tri GM" -ForegroundColor White
    Write-Host ""
    Write-Host "   [0] Thoat" -ForegroundColor White
    Write-Host "===================================================================" -ForegroundColor Cyan
    $choice = Read-Host "Nhap lua chon cua ban (0-9, P, G)"

    switch ($choice.ToUpper()) {
        "1" { Start-AllServices; Read-Host "Nhan Enter de tiep tuc..." }
        "2" { Stop-AllServices; Read-Host "Nhan Enter de tiep tuc..." }
        "3" { Stop-AllServices; Start-Sleep -Seconds 2; Start-AllServices; Read-Host "Nhan Enter de tiep tuc..." }
        "4" {
            Start-Process "$baseDir\GPHWEB\MySQL5\bin\mysqld.exe" ('--defaults-file="' + "$baseDir\GPHWEB\MySQL5\my.ini" + '"') -WindowStyle Hidden
            Start-Process "$baseDir\GPHWEB\Apache2\bin\httpd.exe" ('-d "' + "$baseDir\GPHWEB\Apache2" + '"') -WindowStyle Hidden
            Write-Host "Web va Database da bat." -ForegroundColor Green
            Start-Sleep -Seconds 2
        }
        "5" {
            Get-Process -Name "httpd", "mysqld" -ErrorAction SilentlyContinue | Stop-Process -Force
            Write-Host "Da tat Web va Database." -ForegroundColor Green
            Start-Sleep -Seconds 2
        }
        "6" {
            Start-Process cmd.exe -ArgumentList ('/k "cd /d """' + "$baseDir\server" + '""" && jre6\bin\java.exe -cp ./;lib/*;lib/Jetty/*;extensions/__lib__/* -server -Xms256m -Xmx768m -XX:PermSize=128M -XX:MaxPermSize=192M -jar dntg_start.jar"')
            Write-Host "Da mo tien trinh Java Server." -ForegroundColor Green
            Start-Sleep -Seconds 2
        }
        "7" {
            Get-Process -Name "java" -ErrorAction SilentlyContinue | Stop-Process -Force
            Write-Host "Da tat Java Game Server." -ForegroundColor Green
            Start-Sleep -Seconds 2
        }
        "8" {
            Start-Process "$baseDir\Gateway.exe"
            Write-Host "Da bat Gateway." -ForegroundColor Green
            Start-Sleep -Seconds 2
        }
        "9" { Show-SystemStatus; Read-Host "Nhan Enter de tiep tuc..." }
        "P" { Start-Process $gameUrl }
        "G" { Start-Process $gmUrl }
        "0" { exit 0 }
    }
}
