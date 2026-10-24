# CÂU HỎI ÔN TẬP VÀ GIẢI ĐÁP

**1. Mô tả các bước xảy ra từ khi trình duyệt yêu cầu `product.php?id=3` đến khi trang hiện ra.**
* **Bước 1:** Trình duyệt gửi HTTP GET request đến Web Server (VD: Apache) với URL chứa tham số `id=3`.
* **Bước 2:** Web Server nhận request và chuyển tệp `product.php` cho trình biên dịch PHP xử lý.
* **Bước 3:** PHP đọc mã lệnh, nhận diện tham số truyền vào qua mảng siêu toàn cục `$_GET['id']` (giá trị là 3).
* **Bước 4:** PHP sử dụng thông tin kết nối CSDL (PDO) để gửi câu lệnh SQL (VD: `SELECT * FROM products WHERE id = 3`) tới MySQL.
* **Bước 5:** MySQL truy xuất dữ liệu và trả về cho PHP.
* **Bước 6:** PHP nhúng dữ liệu vào các thẻ HTML, sinh ra mã HTML hoàn chỉnh và trả về cho Web Server.
* **Bước 7:** Web Server gửi mã HTML về trình duyệt. Trình duyệt render hiển thị trang web.

**2. Vì sao người dùng không xem được mã PHP bằng `Ctrl+U`?**
* PHP là ngôn ngữ Server-side. Khi file PHP thực thi, máy chủ chỉ trả về kết quả cuối cùng (HTML, CSS, JS) cho trình duyệt. Phím `Ctrl+U` chỉ xem được mã HTML kết quả chứ không thể thấy mã nguồn PHP gốc.

**3. Hàm `e()` bảo vệ website khỏi kiểu tấn công nào? Khi nào phải dùng nó?**
* Hàm `e()` (bọc hàm `htmlspecialchars`) bảo vệ website khỏi tấn công **XSS (Cross-Site Scripting)**.
* **Khi nào dùng:** Bất cứ khi nào cần in dữ liệu do người dùng nhập vào hoặc dữ liệu từ database ra ngoài giao diện HTML để tránh trình duyệt hiểu nhầm là mã thực thi (như `<script>`).

**4. Vì sao dùng `__DIR__` trong require thay vì viết đường dẫn tương đối?**
* `__DIR__` trả về đường dẫn tuyệt đối của thư mục chứa file hiện tại. Dùng `__DIR__` giúp đường dẫn luôn chính xác ở mọi nơi khi file bị `require` hoặc `include` từ một thư mục khác, tránh bị sai lệch đường dẫn tương đối.

**5. Khóa ngoại là gì? Vì sao không xóa được danh mục đang có sản phẩm?**
* **Khóa ngoại (Foreign Key):** Là cột dùng để liên kết với khóa chính của bảng khác, đảm bảo toàn vẹn dữ liệu.
* Ràng buộc khóa ngoại ngăn xóa danh mục nếu vẫn còn sản phẩm tham chiếu đến nó, tránh tình trạng dữ liệu sản phẩm bị "mồ côi" (lỗi tham chiếu).

**6. Vì sao bảng `order_items` lưu lại tên và giá sản phẩm?**
* Để giữ lại **lịch sử giao dịch chính xác**. Tên và giá ở bảng `products` có thể thay đổi trong tương lai. Nếu không lưu cứng ở `order_items`, hóa đơn cũ sẽ bị nhảy sang giá mới.

**7. SQL injection là gì? Câu lệnh chuẩn bị sẵn ngăn chặn nó bằng cách nào?**
* **SQL injection:** Lỗ hổng cho phép kẻ tấn công chèn mã SQL độc hại vào input để can thiệp CSDL.
* **Cách ngăn chặn:** Câu lệnh chuẩn bị sẵn (Prepared Statements) phân tách rõ ràng cấu trúc lệnh SQL và dữ liệu. Các tham số (`?`) chỉ được coi là dữ liệu thuần túy, không bị biên dịch thành mã SQL.

**8. Vì sao form tìm kiếm dùng GET chứ không dùng POST?**
* **GET** đẩy tham số lên thanh URL, cho phép người dùng chia sẻ link, lưu bookmark, hoặc tải lại trang mà không bị cảnh báo "Confirm Form Resubmission".
* **POST** dùng để thay đổi dữ liệu trên server (thêm/sửa/xóa, đăng nhập), không phù hợp cho tìm kiếm.