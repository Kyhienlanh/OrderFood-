<?php
include("../db.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Shop</title>

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
	<link rel="stylesheet" href="assets/css/responsive.css">
	<style>
		*{
			font-family: 'Open Sans', sans-serif;
		}
	</style>
</head>
<body>
	
	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
	
	<!-- header -->
	<?php
	include("menu.php");
	?>
	<!-- end header -->

	<!-- search area -->
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
	<!-- end search arewa -->
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						
						<h1>Cửa hàng</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-filters">
                    <ul>
                        <li class="active" data-filter="*">Tất cả</li>
                        <?php
                      
                        $sql = "SELECT * FROM danhmuc";
                        $kq = mysqli_query($connection, $sql);

                        while ($rows = mysqli_fetch_assoc($kq)) {
                            $tendanhmuc_css = str_replace(" ", "-", strtolower($rows['tendanhmuc'])); 
                            echo "<li data-filter='." . $tendanhmuc_css . "'>" . $rows['tendanhmuc'] . "</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php
        $query = "SELECT m.id_monan, m.tenmonan, m.gia, m.mota, d.tendanhmuc, m.hinhanh 
                  FROM monan m 
                  JOIN danhmuc d ON m.id_danhmuc = d.id_danhmuc";

        $result = mysqli_query($connection, $query);

        echo "<div class='row product-lists'>";
        while ($rows = mysqli_fetch_assoc($result)) {
            $tendanhmuc_css = str_replace(" ", "-", strtolower($rows['tendanhmuc'])); 
			echo "<div class='col-lg-4 col-md-6 text-center $tendanhmuc_css'>
				<div class='single-product-item'>
					<div class='product-image'>
						<a href='single-product.php?id=" . $rows['id_monan'] . "'>
							<img src='../uploads/" . htmlspecialchars($rows['hinhanh']) . "' alt=''>
						</a>
					</div>
					<h3>" . htmlspecialchars($rows['tenmonan']) . "</h3>
					<p class='product-price'>" . number_format($rows['gia'], 0) . " VNĐ </p>
					<a href='javascript:void(0);' onclick='themVaoGioHang(" . $rows['id_monan'] . ")' class='cart-btn'>
						<i class='fas fa-shopping-cart'></i> Thêm vào giỏ hàng
					</a>
				</div>
			</div>";

	
        }
        echo "</div>";
        ?>
    </div>
</div>



			<!-- <div class="row product-lists">

				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php"><img src="assets/img/products/product-img-1.jpg" alt=""></a>
						</div>
						<h3>Strawberry</h3>
						<p class="product-price"><span>Per Kg</span> 85$ </p>
						<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center berry">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php"><img src="assets/img/products/product-img-2.jpg" alt=""></a>
						</div>
						<h3>Berry</h3>
						<p class="product-price"><span>Per Kg</span> 70$ </p>
						<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center lemon">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php"><img src="assets/img/products/product-img-3.jpg" alt=""></a>
						</div>
						<h3>Lemon</h3>
						<p class="product-price"><span>Per Kg</span> 35$ </p>
						<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php"><img src="assets/img/products/product-img-4.jpg" alt=""></a>
						</div>
						<h3>Avocado</h3>
						<p class="product-price"><span>Per Kg</span> 50$ </p>
						<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php"><img src="assets/img/products/product-img-5.jpg" alt=""></a>
						</div>
						<h3>Green Apple</h3>
						<p class="product-price"><span>Per Kg</span> 45$ </p>
						<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center la">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php"><img src="assets/img/products/product-img-6.jpg" alt=""></a>
						</div>
						<h3>Strawberry</h3>
						<p class="product-price"><span>Per Kg</span> 8a0$ </p>
						<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>

			</div> -->

			<!-- <div class="row">
				<div class="col-lg-12 text-center">
					<div class="pagination-wrap">
						<ul>
							<li><a href="#">Prev</a></li>
							<li><a href="#">1</a></li>
							<li><a class="active" href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					</div>
				</div>
			</div> -->
		</div>
	</div>
	<!-- end products -->

	<!-- logo carousel -->
	
	<!-- end logo carousel -->

	<!-- footer -->
	<?php
	include("footer.php");
	?>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function themVaoGioHang(id) {
    $.ajax({
        url: "AddToCart.php",
        type: "POST",
        data: { id: id },
        success: function(response) {
            try {
                let data = JSON.parse(response); // Chuyển chuỗi JSON thành object

                if (data.status === "success") {
                    Swal.fire({
                        title: "Thành công!",
                        text: "Sản phẩm đã được thêm vào giỏ hàng.",
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonText: "Xem giỏ hàng",
                        cancelButtonText: "Tiếp tục mua",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "cart.php"; // Chuyển đến trang giỏ hàng
                        }
                    });
                } else if (data.message === "Vui lòng đăng nhập để thêm vào giỏ hàng.") {
                    Swal.fire({
                        title: "Chưa đăng nhập!",
                        text: "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Đăng nhập",
                        cancelButtonText: "Đóng",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../login.php"; // Chuyển hướng đến trang đăng nhập
                        }
                    });
                } else {
                    Swal.fire("Lỗi!", data.message || "Không thể thêm vào giỏ hàng.", "error");
                }
            } catch (error) {
                console.error("Lỗi parse JSON:", error, response);
                Swal.fire("Lỗi!", "Có lỗi xảy ra, vui lòng thử lại.", "error");
            }
        },
        error: function(xhr, status, error) {
            console.error("Lỗi AJAX:", status, error);
            Swal.fire("Lỗi!", "Không thể kết nối đến server.", "error");
        }
    });
}


</script>




	</script>
	
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
	<!-- main js -->
	<script src="assets/js/main.js"></script>

</body>
</html>