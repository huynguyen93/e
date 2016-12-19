Cài trên windows:  
1. Tải xampp: https://www.apachefriends.org/xampp-files/7.0.13/xampp-win32-7.0.13-0-VC14-installer.exe  
2. Cài đặt xampp (mặc định thư mục xampp sẽ nằm ở ổ C và database_username='root', database_password=''). Cài xong thì mở   lên, bấm start apache và start mysql (vào config chọn apache và mysql để mỗi lần mở chương trình chạy nó tự start)  
3. Vào thư mục cài đã cài đặt xampp, vào tiếp thư mục htdocs  
4. Tải và cài git: https://git-scm.com/download/win (không cần cũng được)  
5. Git clone https://github.com/huynguyen93/e.git nếu có cài git, hoặc copy thư mục e vào trong thư mục htdocs,
 đường dẫn dạng như sau: C:\xampp\htdocs\e  
6. Mở trình duyệt web truy cập localhost/phpmyadmin  
7. Ở thanh menu ngang trên cùng, chọn database (nếu chưa được chọn)  
8. Nhập tên database là: e. Bấm nút Create.  
9. Ở cột bên trái có hiển thị danh sách database, chọn databse e.  
10. Ở thanh menu ngang ở trên, chọn Import để nhập database  
11. bấm browser để chọn file. Chọn file e.sql trong thư mục databasefile trong thư mục e.(C:\xampp\htdocs\e\databasefile\e.sql, hoặc bỏ đâu cũng đc). => xong phần database  
12. Mở text editor vào file: C:\xampp\htdocs\e\application\config\config.php  
13. Sửa dòng $config['base_url'] = 'http://localhost/e'; => xong  
14. Mở trình duyệt web vào địa chỉ: http://localhost/e để học. Nhớ tạo tài khoản để lưu kết quả cho dễ theo dõi.  
Mỗi khi muốn học thì mở chương trình xampp, start apache + mysql sẽ vào được localhost/e.  
(Nếu ở bước 3 có thêm database_password, hoặc ở bước 8 nhập database_name khác thì vào htdocs\e\application\config\database.php, kéo xuống dưới cùng để sửa lại 'username' => 'root', 'password' => '', 'database' => 'e')

Linux
1. Mở terminal  
1.1 cài php: sudo apt-get install php  
1.2 cài mysql: sudo apt-get install mysql-server (lúc cài có bắt nhập user, password, ví dụ ở đây đặt user=root, pass=root)  
2. git clone https://github.com/huynguyen93/e.git  
3. cd vào thư mục mới clone về  
4. cd tiếp vào thư mục database file  
5. chạy lệnh:  
mysql -u root -proot  
create database e;  
exit;  
mysql -u root -proot e < e.sql  
cd ..  
php -S localhost:8000  
6. vào file e/application/config/config.php sửa dòng $config['base_url'] = 'http://localhost:8000';  
7. vào file e/application/config/database.php kéo xuống dưới cùng kiểm tra 'username' => 'root', 'password' => 'root', 'database' => 'e' là OK  
8. mở trình duyệt web, vào localhost:8000/ => xong  
Mỗi khi muốn vào thì cd vào thư mục e, chạy lệnh php -S localhost:8000 là được.  
  
  
Có gì nhắn tin vào flowdoc nhé
