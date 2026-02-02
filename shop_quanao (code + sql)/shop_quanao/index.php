<?php 
include 'config/db.php';
include 'includes/header.php';

$search = isset($_GET['search']) ? "%" . $_GET['search'] . "%" : "%";
$tag = isset($_GET['tag']) ? $_GET['tag'] : "%";
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$per_page = 8;
$offset = ($page - 1) * $per_page;

$count_sql = "SELECT COUNT(*) as total FROM products WHERE name LIKE ? AND tag LIKE ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("ss", $search, $tag);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total_products = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_products / $per_page);

$sql = "SELECT * FROM products WHERE name LIKE ? AND tag LIKE ? ORDER BY id DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $search, $tag, $per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="p-5 mb-4 rounded-5 shadow-sm" style="background: linear-gradient(45deg, #ff85a2, #ffd166); color: white;">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-4 fw-bold" style="font-family: 'Pacifico', cursive;">Mùa Hè Rực Rỡ ✨</h1>
        <p class="fs-4">Khám phá những mẫu váy áo xinh xắn nhất tuần này!</p>
        <a href="index.php?tag=New" class="btn btn-light btn-lg rounded-pill px-5 fw-bold" style="color: #ff85a2;">Xem Ngay</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h2 class="mb-4">
            <?php 
                if(isset($_GET['tag'])) echo "Danh mục: " . $_GET['tag'];
                elseif(isset($_GET['search'])) echo "Kết quả tìm kiếm cho: '" . $_GET['search'] . "'";
                else echo "Tất cả sản phẩm";
            ?>
        </h2>
    </div>

    <?php if($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-3 mb-4">
                <div class="product-card card shadow-sm" style="background: linear-gradient(135deg, #ffeef5 0%, #fff9e6 100%); border: 2px solid #ffb3d9; position: relative;">
                    <?php if(!empty($row['tag'])): ?>
                        <span class="position-absolute badge rounded-pill" style="background: #ff6b6b; color: white; top: 15px; left: 15px; padding: 8px 12px; font-weight: 700; z-index: 10;">
                            <?php echo $row['tag']; ?>
                        </span>
                    <?php endif; ?>
                    <div style="width: 100%; height: 280px; overflow: hidden; background: #f8f8f8;">
                        <img src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>" style="width: 100%; height: 100%; object-fit: contain; display: block;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="price"><?php echo number_format($row['price']); ?>đ</p>
                        <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="btn-detail w-100 btn">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/5089/5089735.png" width="100" class="mb-3 opacity-50">
            <p class="text-muted">Rất tiếc, chúng tôi không tìm thấy sản phẩm nào phù hợp!</p>
            <a href="index.php" class="btn btn-primary">Xem tất cả sản phẩm</a>
        </div>
    <?php endif; ?>
</div>

<?php if($total_pages > 1): ?>
<nav aria-label="Page navigation" class="mt-5 mb-5">
    <ul class="pagination justify-content-center">
        <?php if($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=1<?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo isset($_GET['tag']) ? '&tag=' . urlencode($_GET['tag']) : ''; ?>">« Đầu tiên</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="index.php?page=<?php echo $page - 1; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo isset($_GET['tag']) ? '&tag=' . urlencode($_GET['tag']) : ''; ?>">‹ Trước</a>
            </li>
        <?php endif; ?>

        <?php for($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
            <?php if($i == $page): ?>
                <li class="page-item active"><span class="page-link" style="background: #ff85a2; border-color: #ff85a2;"><?php echo $i; ?></span></li>
            <?php else: ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=<?php echo $i; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo isset($_GET['tag']) ? '&tag=' . urlencode($_GET['tag']) : ''; ?>"><?php echo $i; ?></a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if($page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=<?php echo $page + 1; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo isset($_GET['tag']) ? '&tag=' . urlencode($_GET['tag']) : ''; ?>">Sau ›</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="index.php?page=<?php echo $total_pages; ?><?php echo isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo isset($_GET['tag']) ? '&tag=' . urlencode($_GET['tag']) : ''; ?>">Cuối cùng »</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<?php endif; ?>

<?php 

include 'includes/footer.php'; 
