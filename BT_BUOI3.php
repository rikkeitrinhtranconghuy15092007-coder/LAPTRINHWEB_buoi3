<?php
// ==========================================
// 1. SẮP XẾP THEO GIÁ (Thêm vào phần xử lý PHP của index.php)
// ==========================================
$orderBy = ""; 
if (isset($_GET['sort'])) {
    if ($_GET['sort'] === 'price_asc') {
        $orderBy = "ORDER BY price ASC";
    } elseif ($_GET['sort'] === 'price_desc') {
        $orderBy = "ORDER BY price DESC";
    }
}

// Ví dụ cách nối vào câu lệnh SQL của bạn:
// $sql = "SELECT * FROM products " . $orderBy;


// ==========================================
// 2. ĐẾM KẾT QUẢ (Thêm vào phần HTML của index.php, phía trên lưới)
// ==========================================
?>
<p>Tìm thấy <?php echo count($products); ?> sản phẩm</p>
<?php


// ==========================================
// 3. SẢN PHẨM CÙNG DANH MỤC (Thêm vào product.php)
// ==========================================
// Phần xử lý PHP (thêm sau khi đã truy vấn được biến $product):
$sql_related = "SELECT * FROM products WHERE category_id = ? AND id <> ? LIMIT 3";
$stmt = $pdo->prepare($sql_related);
$stmt->execute([$product['category_id'], $product['id']]);
$related_products = $stmt->fetchAll();

// Phần hiển thị HTML (thêm vào cuối trang chi tiết):
?>
<h3>Sản phẩm cùng danh mục</h3>
<ul>
    <?php foreach ($related_products as $item): ?>
        <li>
            <a href="product.php?id=<?php echo $item['id']; ?>">
                <?php echo htmlspecialchars($item['name']); ?> - <?php echo number_format($item['price']); ?> đ
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php
// ==========================================
// 4. SAO LƯU (Hướng dẫn)
// ==========================================
/*
Trong phpMyAdmin, chọn cơ sở dữ liệu minishop, thẻ Export, bấm Export để tải tệp .sql. 
Nén thư mục minishop cùng tệp đó thành minishop-buoi3.zip.
*/