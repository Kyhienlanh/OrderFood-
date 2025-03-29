<?php
session_start();
include("../db.php"); 


$user_id = $_SESSION["user_id"] ?? 1; 


$stmt = $connection->prepare("SELECT tennguoidung, hovaten, sodienthoai, diachi FROM nguoidung WHERE id_nguoidung = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$success = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tennguoidung = trim($_POST["tennguoidung"]);
    $hovaten = trim($_POST["hovaten"]);
    $sodienthoai = trim($_POST["sodienthoai"]);
    $diachi = trim($_POST["diachi"]);

    if (empty($tennguoidung) || empty($hovaten)) {
        $errors[] = "Tên người dùng và họ tên không được để trống!";
    }

    if (!empty($sodienthoai) && !preg_match('/^[0-9]{10,15}$/', $sodienthoai)) {
        $errors[] = "Số điện thoại không hợp lệ!";
    }

    if (empty($errors)) {
        // Cập nhật thông tin người dùng, không cập nhật vai trò
        $stmt = $connection->prepare("UPDATE nguoidung SET tennguoidung=?, hovaten=?, sodienthoai=?, diachi=? WHERE id_nguoidung=?");
        $stmt->bind_param("ssssi", $tennguoidung, $hovaten, $sodienthoai, $diachi, $user_id);
        if ($stmt->execute()) {
            $success = "Cập nhật hồ sơ thành công!";
            // Cập nhật lại thông tin trên giao diện
            $user["tennguoidung"] = $tennguoidung;
            $user["hovaten"] = $hovaten;
            $user["sodienthoai"] = $sodienthoai;
            $user["diachi"] = $diachi;
        } else {
            $errors[] = "Có lỗi xảy ra, vui lòng thử lại!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Contact</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>
<body>
	

    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
   
	<?php
	include("menu.php");
	?>
	
	
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
					
						<h1>Hồ sơ người dùng</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			
			
<div class="container">
   
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger"><?php echo implode("<br>", $errors); ?></div>
    <?php endif; ?>

    <?php if ($success) : ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form action="HoSoNguoiDung.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Tên người dùng</label>
            <input type="text" name="tennguoidung" class="form-control" value="<?php echo htmlspecialchars($user['tennguoidung']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Họ và tên</label>
            <input type="text" name="hovaten" class="form-control" value="<?php echo htmlspecialchars($user['hovaten']); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="sodienthoai" class="form-control" value="<?php echo htmlspecialchars($user['sodienthoai']); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <textarea name="diachi" class="form-control"><?php echo htmlspecialchars($user['diachi']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Lưu Thay Đổi</button>
    </form>
</div>

			
		</div>
	</div>
	
   
					
			</div>
				<div class="col-lg-4">
					<div class="contact-form-wrap">
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php
	include("footer.php");
	?>
	



	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- form validation js -->
	<script src="assets/js/form-validate.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>
	
</body>
</html>