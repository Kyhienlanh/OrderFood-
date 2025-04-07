<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Single Product</title>

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
						<p>Thông tin món ăn</p>
						<h1>Chi tiết món ăn</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single product -->
	<?php
			include("../db.php");

			if (isset($_GET['id'])) {
				$idMonan = $_GET['id'];
				$query = "SELECT * FROM monan WHERE id_monan = $idMonan";
				$result = mysqli_query($connection, $query);

				if (mysqli_num_rows($result) > 0) { 
					while ($row = mysqli_fetch_assoc($result)) { 
			?>
						<div class="single-product mt-150 mb-150">
						<div class="container">
							<div class="row">
								<div class="col-md-5">
									<div class="single-product-img">
									<img src="../uploads/<?php echo htmlspecialchars($row['hinhanh']); ?>" alt="Hình ảnh món ăn">
									</div>
								</div>
								<div class="col-md-7">
									<div class="single-product-content">
										<h3><?php echo htmlspecialchars($row['tenmonan']); ?></h3>
										<p class="single-product-pricing"> Giá: <?php echo htmlspecialchars(number_format($row['gia'], 0)); ?> VND</p>
										<p><?php echo htmlspecialchars($row['mota']); ?></p>
										
										<div class="single-product-form">
										<form onsubmit="return false;">
										<input type="number" id="soluong_<?= $row['id_monan']; ?>" name="soluong_<?= $row['id_monan']; ?>" value="1" min="1" style="width: 60px;">
											
										</form>
										<a href="javascript:void(0);" class="cart-btn" onclick="themVaoGioHang(<?= $row['id_monan']; ?>)">
											<i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
										</a>
											<p><strong>Thành phần: </strong><?php echo htmlspecialchars($row['thanhphan']); ?></p>
										</div>
										<h4>chia sẻ:</h4>
										<ul class="product-share">
											<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
											<li><a href=""><i class="fab fa-twitter"></i></a></li>
											<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
											<li><a href=""><i class="fab fa-linkedin"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
			<?php 
					} 
				} else {
					echo "Không tìm thấy món ăn.";
				}
			} else {
				echo "Không có ID trong URL";
			}
	?>

	<!-- <div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="../uploads/banhmi.jpg" alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3>Green apples have polyphenols</h3>
						<p class="single-product-pricing"><span>Per Kg</span> $50</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta sint dignissimos, rem commodi cum voluptatem quae reprehenderit repudiandae ea tempora incidunt ipsa, quisquam animi perferendis eos eum modi! Tempora, earum.</p>
						<div class="single-product-form">
							<form action="index.php">
								<input type="number" placeholder="0">
							</form>
							<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
							<p><strong>Categories: </strong>Fruits, Organic</p>
						</div>
						<h4>Share:</h4>
						<ul class="product-share">
							<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
							<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end single product -->

	<!-- more products
	<div class="more-products mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Related</span> Products</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php"><img src="../uploads/banhmi.jpg" alt=""></a>
						</div>
						<h3>Strawberry</h3>
						<p class="product-price"><span>Per Kg</span> 85$ </p>
						<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php"><img src="assets/img/products/product-img-2.jpg" alt=""></a>
						</div>
						<h3>Berry</h3>
						<p class="product-price"><span>Per Kg</span> 70$ </p>
						<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php"><img src="assets/img/products/product-img-3.jpg" alt=""></a>
						</div>
						<h3>Lemon</h3>
						<p class="product-price"><span>Per Kg</span> 35$ </p>
						<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end more products -->

	<!-- logo carousel
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="assets/img/company-logos/1.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/2.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/3.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/4.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/5.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end logo carousel -->

	<!-- footer -->
	<?php
	include("footer.php");
	?>
	<!-- end footer -->
	
	<!-- copyright -->
	
	<!-- end copyright -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
function themVaoGioHang(id) {
    let soluong = document.getElementById("soluong_" + id).value;

    $.ajax({
        url: "AddToCarts.php",
        type: "POST",
        data: { id: id, soluong: soluong }, // Gửi số lượng đã chọn
        success: function(response) {
            try {
                let data = JSON.parse(response);

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
                            window.location.href = "cart.php";
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
                            window.location.href = "../login.php";
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