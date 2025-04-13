<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>HKL</title>

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
	<!-- end search area -->

	<!-- hero area -->
	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Tươi  & Thơm ngon </p>
							<h1>Đồ ăn chay mang lại hương vị độc đáo</h1>
							<div class="hero-btns">
								<a href="shop.php" class="boxed-btn">Danh sách món ăn</a>
								<a href="contact.php" class="bordered-btn">Liên hệ với chúng tôi</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->

	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-shipping-fast"></i>
						</div>
						<div class="content">
							<h3>Miễn phí giao hàng</h3>
						
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-phone-volume"></i>
						</div>
						<div class="content">
							<h3>Hỗ trợ 24/7</h3>
							
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
							<i class="fas fa-sync"></i>
						</div>
						<div class="content">
							<h3>Đổi món ăn nếu sản phẩm có lỗi</h3>
							
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end features list section -->

	<!-- product section -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Sản phẩm của chúng tôi nhấn <a href="shop.php">Tại đây</a> để xem chi tiết</span> </h3>
						<h2 style="margin-top: 30px;">Món ăn được yêu thích</h2>
					</div>
				</div>
			</div>

			<div class="row">
					<?php
					include("../db.php");
					$query = "SELECT m.id_monan, m.tenmonan, m.gia, m.mota, d.tendanhmuc, m.hinhanh 
							FROM monan m 
							JOIN danhmuc d ON m.id_danhmuc = d.id_danhmuc 
							LIMIT 3";


					$result = mysqli_query($connection, $query);

					
					while ($rows = mysqli_fetch_assoc($result)) { ?>
						 <div class="col-lg-4 col-md-6 text-center">
							<div class="single-product-item">
								<div class="product-image">
									<a href="single-product.php?id=<?php echo $rows['id_monan']; ?>">
										<img src="../uploads/<?php echo htmlspecialchars($rows['hinhanh']); ?>" alt="">
									</a>
								</div>
								<h3><?php echo htmlspecialchars($rows['tenmonan']); ?></h3>
								<p class="product-price"><?php echo number_format($rows['gia'], 0); ?> VNĐ</p>
								<a href="javascript:void(0);" onclick="themVaoGioHang(<?php echo $rows['id_monan']; ?>)" class="cart-btn">
									<i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng
								</a>
							</div>
						</div>
					<?php
					}
					
       			?>
				<!-- <div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php"><img src="assets/img/products/product-img-1.jpg" alt=""></a>
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
				<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.php"><img src="assets/img/products/product-img-3.jpg" alt=""></a>
						</div>
						<h3>Lemon</h3>
						<p class="product-price"><span>Per Kg</span> 35$ </p>
						<a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	<!-- end product section -->

	<!-- cart banner section -->
	<!-- <section class="cart-banner pt-100 pb-100">
    	<div class="container">
        	<div class="row clearfix">
            
            	<div class="image-column col-lg-6">
                	<div class="image">
                    	<div class="price-box">
                        	<div class="inner-price">
                                <span class="price">
                                    <strong>30%</strong> <br> off per kg
                                </span>
                            </div>
                        </div>
                    	<img src="assets/img/a.jpg" alt="">
                    </div>
                </div>
               
                <div class="content-column col-lg-6">
					<h3><span class="orange-text">Deal</span> of the month</h3>
                    <h4>Hikan Strwaberry</h4>
                    <div class="text">Quisquam minus maiores repudiandae nobis, minima saepe id, fugit ullam similique! Beatae, minima quisquam molestias facere ea. Perspiciatis unde omnis iste natus error sit voluptatem accusant</div>
                   
                    <div class="time-counter"><div class="time-countdown clearfix" data-countdown="2020/2/01"><div class="counter-column"><div class="inner"><span class="count">00</span>Days</div></div> <div class="counter-column"><div class="inner"><span class="count">00</span>Hours</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Mins</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Secs</div></div></div></div>
                	<a href="cart.php" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                </div>
            </div>
        </div>
    </section> -->
    <!-- end cart banner section -->
	
	<section class="shop-banner">
    	<div class="container">
        	<h3>ĐỒ ĂN CHAY <br> Thực đơn đa dạng<span class="orange-text"></span></h3>
            <div class="sale-percent"><span> <br> </span>đặt ngay nào!<span></span></div>
            <a href="shop.php" class="cart-btn btn-lg">Cửa hàng</a>
        </div>
    </section>
	<div class="latest-news pt-150 pb-150">
		<div class="container">

			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Thông tin </span> món ăn</h3>
						<p></p>
					</div>
				</div>
			</div>

			<div class="row">
			<div class="col-lg-4 col-md-6">
    <div class="single-latest-news">
        <a href="single-news.html">
            <img src="../uploads/goicuon.jpg" alt="Bánh mì chay" class="img-fluid">
        </a>
        <div class="news-text-box">
            <h3><a href="single-news.html">Bánh Mì Chay – Đậm Đà Hương Vị Thuần Việt</a></h3>
            <p class="blog-meta">
                <span class="author"><i class="fas fa-user"></i> Admin</span>
                <span class="date"><i class="fas fa-calendar"></i> 14-4-2025</span>
            </p>
            <p class="excerpt">Bánh mì chay với nhân đậu hũ, nấm, rau củ tươi ngon kết hợp cùng nước sốt đậm đà, mang lại hương vị hấp dẫn mà không cần đến thịt.</p>
            <a href="shop.php" class="read-more-btn">xem chi tiết <i class="fas fa-angle-right"></i></a>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6">
    <div class="single-latest-news">
        <a href="single-news.html">
            <img src="../uploads/goicuon.jpg" alt="Lẩu nấm chay" class="img-fluid">
        </a>
        <div class="news-text-box">
            <h3><a href="single-news.html">Lẩu Nấm Chay – Thanh Đạm Mà Đậm Đà</a></h3>
            <p class="blog-meta">
                <span class="author"><i class="fas fa-user"></i> Admin</span>
                <span class="date"><i class="fas fa-calendar"></i> 14-4-2025</span>
            </p>
            <p class="excerpt">Lẩu nấm chay là món ăn thanh mát với nhiều loại nấm tươi ngon, nước dùng ngọt tự nhiên từ rau củ và gia vị chay, rất thích hợp cho những buổi sum họp gia đình.</p>
            <a href="shop.php" class="read-more-btn">xem chi tiết <i class="fas fa-angle-right"></i></a>
        </div>
    </div>
</div>

<div class="col-lg-4 col-md-6">
    <div class="single-latest-news">
        <a href="single-news.html">
            <img src="../uploads/goicuon.jpg" alt="Cơm tấm chay" class="img-fluid">
        </a>
        <div class="news-text-box">
            <h3><a href="single-news.html">Cơm Tấm Chay – Đổi Gió Cho Bữa Cơm Hằng Ngày</a></h3>
            <p class="blog-meta">
                <span class="author"><i class="fas fa-user"></i> Admin</span>
                <span class="date"><i class="fas fa-calendar"></i> 14-4-2025</span>
            </p>
            <p class="excerpt">Cơm tấm chay với sườn non chay, bì chay và chả hấp, ăn kèm dưa leo, đồ chua, thêm nước mắm chay đậm vị tạo nên một bữa ăn thanh tịnh nhưng vẫn đầy đủ dinh dưỡng.</p>
            <a href="shop.php" class="read-more-btn">xem chi tiết <i class="fas fa-angle-right"></i></a>
        </div>
    </div>
</div>

			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="shop.php" class="boxed-btn">Cửa hàng</a>
				</div>
			</div>
		</div>
	</div>
	<!-- testimonail-section -->
	<div class="testimonail-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar1.jpg" alt="">
							</div>
							<div class="client-meta">
								<h3>GIA KỲ <span>HEHE</span></h3>
								<p class="testimonial-body">
									" CHILL CHILL "
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/kk.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Hiền Nguyễn <span>hihi</span></h3>
								<p class="testimonial-body">
									"..."
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/ll.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Lộc Đỗ <span>haha</span></h3>
								<p class="testimonial-body">
									"..."
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end testimonail-section -->
	
	<!-- advertisement section -->
	
	<!-- end latest news -->

	<!-- logo carousel -->
	<!-- <div class="logo-carousel-section">
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
	<!-- end copyright -->
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