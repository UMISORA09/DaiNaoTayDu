# 🐉 ĐẠI NÁO TÂY DU (ĐẠI NÁO THIÊN CUNG OL)
### Dự án Nghiên cứu & Phục dựng Game Nhập Vai Trực Tuyến MMORPG 2.5D Tiên Hiệp Tây Du Ký

[![GitHub Repo](https://img.shields.io/badge/GitHub-UMISORA09%2FDaiNaoTayDu-blue?logo=github)](https://github.com/UMISORA09/DaiNaoTayDu)
[![License: Apache-2.0](https://img.shields.io/badge/License-Apache%202.0-green.svg)](LICENSE)
[![Platform](https://img.shields.io/badge/Platform-Web%20Browser%20%7C%20Windows%20Server-orange.svg)]()
[![Game Engine](https://img.shields.io/badge/Client-ActionScript%203%20%7C%20Flash-red.svg)]()
[![Backend](https://img.shields.io/badge/Server-Java%20NIO%20%7C%20Netty%20%7C%20Jetty-informational.svg)]()
[![Web Gateway](https://img.shields.io/badge/Gateway-Apache%202.2%20%7C%20PHP%205.3-yellow.svg)]()
[![Database](https://img.shields.io/badge/Database-MySQL%205.5-lightgrey.svg)]()

---

> [!IMPORTANT]
> ### 📌 THÔNG BÁO VỀ CẤU TRÚC PHÂN NHÁNH REPOSITORY
> - **Nhánh `main` (Nhánh hiện tại):** Nhánh giao diện chính (Landing Page) hiển thị tổng quan đồ án, giới thiệu tính năng, kiến trúc kỹ thuật và hướng dẫn triển khai. Nhánh này được giữ gọn gàng, không chứa file nhị phân lớn để tối ưu hiển thị trên trang chủ GitHub.
> - **Nhánh `master`:** Chứa **toàn bộ mã nguồn (Source Code)**, tài nguyên game (Client/Server), cơ sở dữ liệu, bộ công cụ cấu hình và các kịch bản vá lỗi (Python scripts).
> 
> 👉 **Để xem và tải toàn bộ mã nguồn dự án, vui lòng chuyển sang nhánh [`master`](https://github.com/UMISORA09/DaiNaoTayDu/tree/master):**
> ```bash
> git fetch origin
> git checkout master
> ```

---

## 📜 Mục Lục
1. [Giới Thiệu Tổng Quan](#-1-giới-thiệu-tổng-quan)
2. [Cốt Truyện & Bối Cảnh](#-2-cốt-truyện--bối-cảnh)
3. [Hệ Thống Môn Phái & Nhân Vật](#-3-hệ-thống-môn-phái--nhân-vật)
4. [Tính Năng Gameplay Nổi Bật](#-4-tính-năng-gameplay-nổi-bật)
5. [Kiến Trúc Kỹ Thuật Hệ Thống](#-5-kiến-trúc-kỹ-thuật-hệ-thống)
6. [Hướng Dẫn Triển Khai & Cài Đặt Nhanh](#-6-hướng-dẫn-triển-khai--cài-đặt-nhanh)
7. [Các Công Cụ & Kịch Bản Hỗ Trợ](#-7-các-công-cụ--kịch-bản-hỗ-trợ)
8. [Cấu Trúc Thư Mục Dự Án](#-8-cấu-trúc-thư-mục-dự-án)
9. [Lộ Trình Phát Triển & Bản Quyền](#-9-lộ-trình-phát-triển--bản-quyền)

---

## 📖 1. Giới Thiệu Tổng Quan

**Đại Náo Tây Du** (nguyên bản: *Đại Náo Thiên Cung OL - 大闹天宫OL / The Monkey King Online*) là một tựa game nhập vai trực tuyến nhiều người chơi (MMORPG / ARPG) trên nền tảng Webgame kinh điển. Trò chơi lấy cảm hứng từ danh tác thần thoại kinh điển phương Đông *Tây Du Ký*, kết hợp đồ họa 2.5D huyền ảo, hiệu ứng chiêu thức rực rỡ và hệ thống chiến đấu thời gian thực tốc độ cao.

### Mục Tiêu Đồ Án:
- **Nghiên cứu kiến trúc phân tán Game Server**: Tìm hiểu mô hình Client - Gateway - Server - Database phục vụ hàng ngàn người chơi trực tuyến đồng thời (CCU cao).
- **Giao thức truyền thông Socket & Đồng bộ thực thể**: Khảo sát cơ chế bắt tay TCP/IP hai chiều, gói tin nhị phân (Binary Protocol), cơ chế đồng bộ chuyển động, bản đồ lưới (Tile/Grid map) và thuật toán tìm đường A*.
- **Xây dựng & Phục dựng**: Hoàn thiện môi trường chạy thử nghiệm độc lập trên nền tảng Windows/Web, khắc phục các vấn đề tương thích Flash trên trình duyệt hiện đại.
- **Tối ưu hóa & Phát triển công cụ**: Viết các module Python tự động phân tích cấu hình bản đồ, giải mã SWF, cân bằng chỉ số Boss, vá lỗi luồng GiftCode và Email ingame.

---

## 🌌 2. Cốt Truyện & Bối Cảnh

Thế giới trong game tái hiện giai đoạn biến động nhất của Tam Giới:
- Khi Tề Thiên Đại Thánh phá bỏ trật tự Sinh Tử Bộ dưới Địa Phủ, quậy phá Long Cung đoạt Định Hải Thần Châm (Như Ý Kim Cô Bổng) và làm kinh thiên động địa Thiên Đình.
- Người chơi sẽ bước vào vai một trong bốn đại sứ mệnh giả, lựa chọn đứng về phía Thiên Giới để giữ gìn trật tự hoặc đồng hành cùng Yêu Tộc phá vỡ xiềng xích định mệnh, chiến đấu với muôn vàn thiên binh thần tướng để viết nên thiên sử thi của riêng mình.

---

## ⚔️ 3. Hệ Thống Môn Phái & Nhân Vật

Game cung cấp 4 lớp nhân vật đại diện cho 4 trường phái chiến đấu đặc trưng với ngoại hình và bộ kỹ năng độc nhất:

| Nhân Vật | Biểu Tượng | Vũ Khí | Thuộc Tính Chính | Lối Đánh Đặc Trưng |
| :--- | :---: | :---: | :---: | :--- |
| **Hầu Vương** | 🐒 | Kim Cô Bổng | Công kích vật lý / Bạo kích | Thân pháp nhanh nhẹn, xuất chiêu thần tốc, áp sát và dồn sát thương đơn mục tiêu cực mạnh. |
| **Ngưu Ma** | 🐂 | Khai Thiên Phủ | Sinh lực / Phòng ngự | Sinh lực dồi dào, giáp dày hộ thể, càn quét tuyến đầu, tanker vững chãi trong mọi phó bản. |
| **Cửu Vĩ Hồ** | 🦊 | Pháp Trượng / Linh Châu | Sát thương phép / Khống chế | Thi triển pháp thuật tầm xa, đóng băng, giảm tốc và sát thương diện rộng cực lớn trong giao tranh. |
| **Thiết Phiến** | 🪭 | Ba Tiêu Bảo Phiến | Hỗ trợ / Phong lôi thuật | Triệu hồi cuồng phong, bão tố khống chế nhiều mục tiêu, giải khống và hồi phục đồng minh. |

---

## ✨ 4. Tính Năng Gameplay Nổi Bật

### 🔮 Bát Cửu Huyền Công (72 Phép Biến Thân Thần Tướng)
Một trong những tính năng đột phá nhất của game:
- Người chơi không bị bó buộc trong kỹ năng nhân vật cố định. Thông qua việc thu thập Tinh Hồn và vượt qua phụ bản Thần Tướng, người chơi có thể **biến hình trực tiếp thành các vị Thần / Tiên / Ma** huyền thoại:
  - **Nhị Lang Thần Dương Tiễn**: Khai thiên thần nhãn, sát thương lôi điện liên hoàn.
  - **Na Tra Tam Thái Tử**: Hỗn Thiên Lăng, Càn Khôn Quyển, Phong Hỏa Luân truy sát tốc độ cao.
  - **Thái Thượng Lão Quân**: Pháp bảo Bát Quái Lò, thiêu đốt quần thể.
  - **Vi Đà Thiên Tôn, Cự Linh Thần, Hằng Nga Tiên Tử, Diêm Vương...**
- Mỗi hình thái Thần Tướng sở hữu bộ skill và thuộc tính gia tăng hoàn toàn riêng biệt.

### 🐎 Hệ Thống Tọa Kỵ, Cánh & Thần Binh
- **Tọa Kỵ (Thú Cưỡi):** Tăng tốc độ di chuyển và cộng chỉ số vĩnh viễn: từ Ngựa Trắng, Hổ Dữ, Kỳ Lân đến Thần Long, Kim Bằng.
- **Vũ Dực (Cánh Thần):** Hiệu ứng hào quang rực rỡ, gia tăng tỉ lệ né tránh và bạo kích.
- **Thần Binh & Pháp Bảo:** Tự động kích hoạt đòn đánh phụ, gây choáng và suy yếu kẻ địch.

### 🏆 Đấu Trường PK & Hoạt Động Tam Giới
- **Săn Boss Thế Giới:** Xuất hiện theo chu kỳ thời gian thực, rơi trang bị cam quý hiếm và nguyên liệu nâng cấp.
- **Phó Bản Cốt Truyện & Leo Tháp:** Thử thách giới hạn tu vi từng tầng tháp, rèn luyện kỹ năng cá nhân.
- **Vương Thành Tranh Đoạt Chiến:** Cuộc chiến quy mô lớn giữa các Bang Hội để giành quyền thống trị Thiên Đình.
- **Chiến Trường Tam Giới (Tống Kim / Tiên Ma):** Đấu trường PvP đối kháng chia phe nảy lửa.

---

## 🏗️ 5. Kiến Trúc Kỹ Thuật Hệ Thống

Kiến trúc tổng thể của hệ thống game được tổ chức theo mô hình phân tầng module hóa cao:

```mermaid
graph TD
    subgraph Client ["Client Layer"]
        FlashClient["ActionScript 3 (AS3) Client<br/>• Flash Engine (SWF)<br/>• Map Tile / Entity Rendering<br/>• Skill & Particle FX<br/>• Sound & UI System"]
    end

    subgraph Gateway ["Web & Gateway Layer"]
        Apache["Apache 2.2 Server (Port 8089)"]
        PHP["PHP 5.3 Gateway<br/>• Đăng nhập & Xác thực<br/>• Quản trị GM (server.php)<br/>• Phân phối cấu hình (gameconfig)"]
        FlashPolicy["Flash Socket Policy Server (Port 843)"]
    end

    subgraph GameServer ["Game Server Core"]
        StartJar["Java Core Server (JRE 6)<br/>• dntg_start.jar"]
        NettyIO["Network Layer (NIO / Socket Engine)<br/>• Session & Packet Dispatcher"]
        LogicEngine["Game Logic Core<br/>• Map / Grid / A* Pathfinding<br/>• Combat & Damage Calculation<br/>• Thần Tướng, Tọa Kỵ, Ba Lô<br/>• Email & GiftCode Services"]
    end

    subgraph Database ["Data Persistence Layer"]
        MySQL["MySQL 5.5 Database (Port 3306)<br/>• dnweb (Tài khoản & Web)<br/>• dntg (Dữ liệu nhân vật, trang bị, log)"]
    end

    FlashClient <==>|HTTP / Resource Download| Apache
    FlashClient <==>|Socket Handshake (843)| FlashPolicy
    FlashClient <==>|TCP Socket (Two-Way Sync)| NettyIO
    Apache --> PHP
    PHP --> MySQL
    LogicEngine <==>|JDBC Connection Pool| MySQL
    NettyIO --> LogicEngine
    StartJar --> NettyIO
    StartJar --> LogicEngine
```

### Công Nghệ Sử Dụng:
- **Ngôn ngữ Client:** ActionScript 3 (AS3), Adobe Flex / Flash Builder SDK.
- **Backend Server:** Java SE (JRE 6), Jetty nhúng, Java NIO Socket, Netty Framework.
- **Web Portal / API:** PHP 5.3, Apache 2.2 HTTP Server (hỗ trợ eAccelerator tối ưu hóa).
- **Cơ sở dữ liệu:** MySQL 5.5 (InnoDB & MyISAM), hệ thống lưu trữ đồng bộ thời gian thực.
- **Bộ công cụ bổ trợ:** Python 3 (Scripts phân tích bytecode, giải mã cấu hình, trích xuất asset).

---

## 🚀 6. Hướng Dẫn Triển Khai & Cài Đặt Nhanh

> [!TIP]
> Tất cả mã nguồn, script chạy và công cụ đã được đóng gói sẵn trong nhánh [`master`](https://github.com/UMISORA09/DaiNaoTayDu/tree/master).

### Bước 1: Chuẩn Bị Môi Trường
1. **Hệ điều hành:** Windows 7 / 10 / 11 hoặc Windows Server 2012/2016/2019/2022.
2. **Java Runtime:** JRE 6 (đã được tích hợp sẵn trong thư mục `server/jre6`).
3. **Trình duyệt chơi game:** Flash Browser, CentBrowser, 360Chrome, Palemoon hoặc trình chạy Flash tương thích.

### Bước 2: Clone Mã Nguồn (Nhánh master)
```bash
git clone -b master https://github.com/UMISORA09/DaiNaoTayDu.git
cd DaiNaoTayDu
```

### Bước 3: Khởi Động Các Dịch Vụ
Khởi động các thành phần theo đúng thứ tự sau:

1. **Khởi động Web Server & Database:**
   - Chạy `[1].网站数据库.exe` (giao diện Essamp).
   - Nhấn **Start** để khởi chạy Apache (cổng `8089`) và MySQL (cổng `3306`).
2. **Khởi động Cổng Đăng Nhập (Login Gateway):**
   - Chạy `[2].登录器网关.exe`.
3. **Khởi động Game Server Core:**
   - Chạy file `[3].启动服务端.bat` (hoặc `server/run_test.bat`).
   - Đợi màn hình console hiển thị thông báo:
     ```text
     ================== server started successfully ==================
     ```
4. **Khởi động Cổng Quản Trị & Tự Động Nạp (Tùy chọn):**
   - Chạy `[4].自动充值管理网关.exe`.

### Bước 4: Truy Cập & Trải Nghiệm Game
- **Địa chỉ vào game:** Mở trình duyệt hỗ trợ Flash và truy cập:
  ```text
  http://127.0.0.1:8089/game.php
  ```
- **Trang quản trị GM (Game Master):**
  ```text
  http://127.0.0.1:8089/guanli/login.php
  Tài khoản: admin
  Mật khẩu:  lyzwlkj.vip (hoặc cấu hình trong db)
  ```

---

## 🛠️ 7. Các Công Cụ & Kịch Bản Hỗ Trợ

Trong thư mục dự án (nhánh `master`), chúng tôi đã nghiên cứu và phát triển nhiều công cụ tự động hóa:

| Tên Tập Tin Script | Ngôn Ngữ | Chức Năng Chính |
| :--- | :---: | :--- |
| `apply_boss_fix.py` | Python | Sửa lỗi tọa độ Boss rơi vào ô không thể di chuyển (unwalkable tiles), đồng bộ vị trí map. |
| `apply_email_and_giftcode_fix.py` | Python | Vá lỗ hổng kiểm tra phần thưởng trong hệ thống nhận Giftcode và đính kèm thư tín. |
| `analyze_swf.py` / `extract_abc.py` | Python | Trích xuất và giải mã ActionScript Bytecode (ABC) từ file Client SWF. |
| `clean_dangerous_emails.py` | Python | Quét và làm sạch dữ liệu email rác hoặc vật phẩm bất thường trong database. |
| `Sua_Loi_Flash.vbs` | VBScript | Tự động đăng ký DLL và sửa lỗi chặn Flash Player trên hệ điều hành Windows mới. |

---

## 📁 8. Cấu Trúc Thư Mục Dự Án (Trên Nhánh `master`)

```text
DaiNaoTayDu/
├── GPHWEB/                 # Cổng Web & Dịch vụ máy chủ
│   ├── Apache2/            # Máy chủ web Apache 2.2
│   ├── MySQL5/             # Cơ sở dữ liệu MySQL 5.5 & Data dntg/dnweb
│   ├── PHP5/               # Runtime PHP 5.3 & eAccelerator
│   └── wwwroot/            # Mã nguồn web portal, game.php, api quản trị
├── server/                 # Lõi máy chủ Game Server
│   ├── config/             # Toàn bộ file cấu hình game, boss, map, drop rates
│   ├── jre6/               # Java Runtime Environment 6
│   ├── lib/                # Thư viện phụ thuộc Java (Netty, Jetty, c3p0, JDBC)
│   ├── dntg_start.jar      # File thực thi máy chủ chính
│   └── run_test.bat        # Kịch bản khởi động Game Server
├── com/                    # Các module mã nguồn Java đã can thiệp & vá lỗi
├── *.py                    # Bộ công cụ phân tích & vá lỗi tự động
├── [0-4].*.exe             # Các launcher điều khiển hệ thống nhanh
└── README.md               # Tài liệu hướng dẫn kỹ thuật chi tiết
```

---

## 🎯 9. Lộ Trình Phát Triển & Bản Quyền

### Lộ Trình Phát Triển (Roadmap):
- [x] Phục dựng thành công cụm máy chủ cục bộ (Localhost) chạy ổn định trên Windows 10/11.
- [x] Tối ưu hóa cổng kết nối web gateway sang `8089` tránh xung đột cổng hệ thống.
- [x] Vá lỗi hệ thống phân phối Boss và tọa độ di chuyển trên toàn bộ các map chính.
- [x] Khắc phục lỗi kiểm tra phần thưởng GiftCode và thư tín (Email item duplication bug).
- [ ] Hoàn thiện gói Việt hóa giao diện Client và mô tả vật phẩm.
- [ ] Chuyển đổi Client sang WebAssembly / HTML5 (nghiên cứu thử nghiệm với Ruffle / Away3D).

### Bản Quyền & Giấy Phép (License):
- Dự án này được công bố theo giấy phép mã nguồn mở **Apache License 2.0**. Xem chi tiết tại [LICENSE](LICENSE).
- Mọi tài nguyên đồ họa, âm thanh và dữ liệu trò chơi thuộc quyền sở hữu của nhà phát triển gốc. Dự án được thực hiện hoàn toàn với **mục đích học tập, nghiên cứu khoa học và bảo tồn kỹ thuật phần mềm**.

---

<p align="center">
  <b>ĐẠI NÁO TÂY DU - PROJECT SHOWCASE</b><br/>
  <i>Nghiên cứu & Phát triển bởi <a href="https://github.com/UMISORA09">UMISORA09</a></i>
</p>