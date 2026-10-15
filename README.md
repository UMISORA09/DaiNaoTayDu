# 🐉 ĐẠI NÁO TÂY DU - MÃ NGUỒN DỰ ÁN (BRANCH: `master`)

[![GitHub Repo](https://img.shields.io/badge/GitHub-UMISORA09%2FDaiNaoTayDu-blue?logo=github)](https://github.com/UMISORA09/DaiNaoTayDu)
[![Branch](https://img.shields.io/badge/Branch-master-brightgreen.svg)]()
[![Platform](https://img.shields.io/badge/Platform-Windows%20x64%20%7C%20Server-orange.svg)]()
[![Java](https://img.shields.io/badge/Java-JRE%206%20(Jetty%20%2B%20NIO)-informational.svg)]()
[![PHP & Apache](https://img.shields.io/badge/Web-Apache%202.2%20%7C%20PHP%205.3-yellow.svg)]()
[![Database](https://img.shields.io/badge/Database-MySQL%205.5-lightgrey.svg)]()

> [!NOTE]
> Đây là **nhánh phát triển chính (`master`)** chứa toàn bộ mã nguồn, cấu hình hệ thống, dữ liệu cơ sở dữ liệu và các kịch bản vá lỗi của dự án **Đại Náo Tây Du**.
> 
> Để xem trang giới thiệu đồ án tổng quan (Landing Page), vui lòng truy cập nhánh [`main`](https://github.com/UMISORA09/DaiNaoTayDu/tree/main).

---

## 📑 Mục Lục Kỹ Thuật
1. [Yêu Cầu Môi Trường](#1-yêu-cầu-môi-trường)
2. [Cấu Trúc Thư Mục Source Code](#2-cấu-trúc-thư-mục-source-code)
3. [Cấu Hình Mạng & Cổng Dịch Vụ](#3-cấu-hình-mạng--cổng-dịch-vụ)
4. [Quy Trình Khởi Động Server](#4-quy-trình-khởi-động-server)
5. [Hệ Thống Cơ Sở Dữ Liệu](#5-hệ-thống-cơ-sở-dữ-liệu)
6. [Tài Khoản Quản Trị & Công Cụ GM](#6-tài-khoản-quản-trị--công-cụ-gm)
7. [Các Kịch Bản Vá Lỗi & Tối Ưu (Python)](#7-các-kịch-bản-vá-lỗi--tối-ưu-python)
8. [Xử Lý Sự Cố Thường Gặp (Troubleshooting)](#8-xử-lý-sự-cố-thường-gặp-troubleshooting)

---

## 1. Yêu Cầu Môi Trường

- **Hệ điều hành:** Windows 7 / 10 / 11 hoặc Windows Server 2012 / 2016 / 2019 / 2022 (x86/x64).
- **Java:** JRE 6u45 (đã đóng gói kèm tại `server/jre6`).
- **Web & Gateway:** Apache 2.2 + PHP 5.3.28 (đi kèm trong `GPHWEB`).
- **Database:** MySQL 5.5.36 (đi kèm trong `GPHWEB/MySQL5`).
- **Python:** Python 3.8+ (dùng để chạy các kịch bản phân tích và patch tự động).
- **Client Runner:** Trình duyệt hỗ trợ Flash (Flash Browser, CentBrowser, 360Chrome, Palemoon) hoặc Flash Player Projector.

---

## 2. Cấu Trúc Thư Mục Source Code

```text
c:\Cassavas\DNTC/
├── [0].一键配置.exe            # Công cụ đổi IP hàng loạt (One-click IP Config)
├── [1].网站数据库.exe.lnk      # Phím tắt bật Essamp (Apache + MySQL)
├── [2].登录器网关.exe          # Cổng điều hướng đăng nhập (Login Gateway)
├── [3].启动服务端.bat.lnk      # Phím tắt khởi chạy Game Server chính
├── [4].自动充值管理网关.exe    # Cổng thanh toán & nạp KNB tự động
├── [99].关闭服务端.bat         # Kịch bản tắt toàn bộ dịch vụ an toàn
├── [999]大闹天宫OL数据工具.lnk # Bộ công cụ chỉnh sửa dữ liệu trang bị/vật phẩm
├── Sua_Loi_Flash.vbs           # Script đăng ký Flash OCX cho Windows mới
│
├── GPHWEB/                     # Web Portal, API & Database Runtime
│   ├── Apache2/                # Máy chủ HTTP Apache 2.2
│   │   ├── conf/httpd.conf     # File cấu hình VirtualHost & Port (8089)
│   │   └── logs/               # Nhật ký truy cập Web
│   ├── MySQL5/                 # Máy chủ CSDL MySQL 5.5
│   │   ├── data/dntg/          # CSDL nhân vật, túi đồ, thần tướng, bang hội
│   │   ├── data/dnweb/         # CSDL tài khoản web, máy chủ
│   │   └── my.ini              # File cấu hình bộ nhớ đệm MySQL
│   ├── PHP5/                   # Bộ thông dịch PHP 5.3
│   └── wwwroot/                # Thư mục gốc Web
│       ├── configuration/      # File kết nối DB (config.inc.php)
│       ├── game.php            # Trang nhúng Flash SWF và khởi tạo phiên chơi
│       ├── sysconfig.php       # Định nghĩa URL tài nguyên và cổng kết nối
│       └── guanli/             # Trang quản trị GM (server.php, login.php)
│
├── server/                     # Máy chủ Game Server Core (Java)
│   ├── config/                 # Tập tin cấu hình Game Logic
│   │   ├── config-download.properties   # Đường dẫn nạp dữ liệu từ Web
│   │   ├── gameconfig-info.properties   # Tọa độ và liên kết server
│   │   ├── gm-open.properties           # Bật/tắt lệnh GM trực tiếp
│   │   └── game/sys_config/             # Cấu hình drop, quái, map (.jat)
│   ├── jre6/                   # Máy ảo Java Runtime Environment 6
│   ├── lib/                    # Thư viện: Netty, Jetty, c3p0, slf4j, mysql-driver
│   ├── dntg_start.jar          # File JAR nạp và kích hoạt server
│   └── run_test.bat            # Script khởi chạy Java với tham số JVM chuẩn
│
├── com/                        # Các lớp Java bytecode đã decompile & patch logic
│   ├── BagServiceImpl.class    # Vá lỗi ba lô và xếp chồng vật phẩm
│   ├── GiftCodeServiceImpl.class# Vá lỗi nhận mã kích hoạt (GiftCode)
│   ├── RoleEmailServiceImpl.class# Vá lỗi nhận vật phẩm từ thư tín
│   └── ShenjiangServiceImpl.class# Xử lý hệ thống Thần Tướng biến thân
│
└── *.py                        # Bộ công cụ Python phân tích & vá dữ liệu
    ├── apply_boss_fix.py       # Tự động quét và vá tọa độ Boss khiêu chiến
    ├── apply_email_and_giftcode_fix.py # Vá logic GiftCode & Email
    ├── clean_dangerous_emails.py # Quét dọn thư rác độc hại trong CSDL
    ├── check_boss_walkable.py  # Kiểm tra ô có thể đi lại (walkable tiles)
    └── analyze_swf.py          # Giải mã và phân tích file SWF client
```

---

## 3. Cấu Hình Mạng & Cổng Dịch Vụ

| Dịch Vụ | Cổng Mặc Định | File Cấu Hình |
| :--- | :---: | :--- |
| **Web Portal / Game.php** | `8089` | `GPHWEB/Apache2/conf/httpd.conf`, `GPHWEB/essamp.ini` |
| **MySQL Database** | `3306` | `GPHWEB/MySQL5/my.ini` |
| **Flash Policy Server** | `843` | Tự động xử lý cấp quyền cross-domain XML socket |
| **Game Server Socket** | `8001 / 9001` | `server/config/gameconfig-info.properties` |
| **Resource Download** | `8089` | `server/config/config-download.properties` |

---

## 4. Quy Trình Khởi Động Server

1. **Khởi động Apache & MySQL:**
   - Mở `[1].网站数据库.exe`.
   - Kiểm tra cả 2 đèn trạng thái **Apache** và **MySQL** chuyển sang màu xanh lá.
2. **Khởi động Cổng Đăng Nhập:**
   - Chạy `[2].登录器网关.exe`.
3. **Khởi động Java Core Server:**
   - Chạy `[3].启动服务端.bat` (hoặc chạy trực tiếp `server/run_test.bat`).
   - Lệnh thực thi JVM:
     ```cmd
     jre6\bin\java.exe -cp "./;lib/*;lib/Jetty/*;extensions/__lib__/*" -server -Xms256m -Xmx1024m -XX:PermSize=256M -XX:MaxPermSize=256M -jar dntg_start.jar
     ```
   - Chờ đến khi dòng chữ sau xuất hiện:
     ```text
     ================== server started successfully ==================
     ```
4. **Vào Game:**
   - Mở trình duyệt hỗ trợ Flash và truy cập `http://127.0.0.1:8089/game.php`.

---

## 5. Hệ Thống Cơ Sở Dữ Liệu

- **Host:** `127.0.0.1`
- **Port:** `3306`
- **User:** `root`
- **Password:** `123456`
- **Các Database chính:**
  - `dnweb`:
    - `account`: Quản lý thông tin đăng nhập, tên tài khoản, mật khẩu mã hóa MD5.
    - `server`: Danh sách máy chủ hiển thị trên cổng đăng nhập.
  - `dntg`:
    - `role`: Thông tin nhân vật, cấp độ, kinh nghiệm, môn phái.
    - `role_bag`: Dữ liệu ba lô, số lượng và thuộc tính trang bị của người chơi.
    - `role_shenjiang`: Dữ liệu mở khóa và nâng cấp 72 phép biến hóa Thần Tướng.
    - `role_email`: Hòm thư ingame, đính kèm vàng, KNB và vật phẩm.

---

## 6. Tài Khoản Quản Trị & Công Cụ GM

### Trang Quản Trị Web (GM Panel):
- **URL:** `http://127.0.0.1:8089/guanli/login.php`
- **Tài khoản:** `admin`
- **Mật khẩu:** `lyzwlkj.vip`
- **Chức năng:** Quản lý máy chủ, gửi thư hệ thống, phát vật phẩm, cộng KNB, mở sự kiện nạp thẻ.

### Lệnh GM Trực Tiếp Ingame (Khi bật gm_open = 1):
Chỉnh sửa trong `server/config/gm-open.properties`:
```properties
gm_open = 1
```

---

## 7. Các Kịch Bản Vá Lỗi & Tối Ưu (Python)

Các script đã được thử nghiệm và hoạt động ổn định:
- **`python apply_boss_fix.py`**: Quét và sửa lỗi bản đồ khi Boss xuất hiện ở tọa độ không hợp lệ khiến nhân vật không thể tấn công.
- **`python apply_email_and_giftcode_fix.py`**: Vá lỗ hổng cho phép nhận trùng phần thưởng Giftcode và thư hệ thống.
- **`python clean_dangerous_emails.py`**: Dọn dẹp các bản ghi thư bị lỗi định dạng JSON gây nghẽn hòm thư người chơi.

---

## 8. Xử Lý Sự Cố Thường Gặp (Troubleshooting)

1. **Trình duyệt báo lỗi "Adobe Flash Player bị chặn / Không tải được game":**
   - Chạy script `Sua_Loi_Flash.vbs` bằng quyền Administrator.
   - Sử dụng trình duyệt chuyên dụng có tích hợp Flash sạch như *CentBrowser* hoặc *Flash Browser*.
2. **Server báo lỗi cổng `8089` đã bị chiếm dụng (Port Conflict):**
   - Kiểm tra tiến trình đang chiếm cổng:
     ```cmd
     netstat -ano | findstr :8089
     ```
   - Đổi port trong `GPHWEB/Apache2/conf/httpd.conf` và `GPHWEB/essamp.ini` sang cổng khác (ví dụ: `8090`).
3. **Lỗi Java OutOfMemoryError / PermGen Space:**
   - Điều chỉnh tham số trong `server/run_test.bat`: tăng `-Xmx1024m` lên `-Xmx2048m` nếu chạy nhiều phụ bản đồng thời.

---

<p align="center">
  <b>ĐẠI NÁO TÂY DU - SOURCE CODE REPOSITORY</b><br/>
  <i>Nhánh mã nguồn phát triển bởi <a href="https://github.com/UMISORA09">UMISORA09</a></i>
</p>
