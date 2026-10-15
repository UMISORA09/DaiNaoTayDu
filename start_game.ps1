$baseDir = $PSScriptRoot
if (-not $baseDir) { $baseDir = (Get-Location).Path }

Write-Host "========================================================" -ForegroundColor Cyan
Write-Host "      KHOI DONG TOAN BO SERVER DAI NAO THIEN CUNG       " -ForegroundColor Cyan
Write-Host "========================================================" -ForegroundColor Cyan

# 1. MySQL
Write-Host "[1/4] Khoi dong MySQL (Port 3306)..." -ForegroundColor Yellow
if (-not (Get-Process -Name "mysqld" -ErrorAction SilentlyContinue)) {
    Start-Process -FilePath "$baseDir\GPHWEB\MySQL5\bin\mysqld.exe" -ArgumentList ('--defaults-file="' + "$baseDir\GPHWEB\MySQL5\my.ini" + '"') -WindowStyle Hidden
    Start-Sleep -Seconds 2
} else {
    Write-Host "      MySQL dang chay." -ForegroundColor Green
}

# 2. Apache
Write-Host "[2/4] Khoi dong Apache..." -ForegroundColor Yellow
if (-not (Get-Process -Name "httpd" -ErrorAction SilentlyContinue)) {
    Start-Process -FilePath "$baseDir\GPHWEB\Apache2\bin\httpd.exe" -ArgumentList ('-d "' + "$baseDir\GPHWEB\Apache2" + '"') -WindowStyle Hidden
    Start-Sleep -Seconds 2
} else {
    Write-Host "      Apache dang chay." -ForegroundColor Green
}

# 3. Gateway
Write-Host "[3/4] Khoi dong Login Gateway..." -ForegroundColor Yellow
$gateway = Get-ChildItem -Path "$baseDir" -Filter "*登录器网关*.exe" | Select-Object -First 1
if ($gateway) {
    Start-Process -FilePath $gateway.FullName
}

# 4. Java Server
Write-Host "[4/4] Khoi dong Java Game Server..." -ForegroundColor Yellow
Start-Process cmd.exe -ArgumentList ('/k "cd /d ""' + "$baseDir\server" + '"" && jre6\bin\java.exe -cp ./;lib/*;lib/Jetty/*;extensions/__lib__/* -server -Xms256m -Xmx768m -XX:PermSize=128M -XX:MaxPermSize=192M -jar dntg_start.jar"')

Write-Host ""
Write-Host "========================================================" -ForegroundColor Green
Write-Host "  DA KHOI DONG THANH CONG! MO TRINH DUYET VAO GAME...   " -ForegroundColor Green
Write-Host "  Luu y: Doi 1-2 phut cho cua so Java nạp du lieu xong  " -ForegroundColor Green
Write-Host "========================================================" -ForegroundColor Green

Start-Sleep -Seconds 2
Start-Process "http://127.0.0.1:8089/"
