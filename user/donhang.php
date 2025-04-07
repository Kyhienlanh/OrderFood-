<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Cart</title>

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
						
						<h1>Đơn hàng</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- cart -->
	<div class="cart-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<!-- <th class="product-remove"></th> -->
									<th class="product-name">Mã đơn hàng</th>
									<th class="product-name">Gía đơn</th>
									<th class="product-price">Ngày đặt</th>
									<th class="product-quantity">Địa chỉ</th>
									<th class="product-total">Trạng thái</th>
									<th class="product-name">Phương thức thanh toán</th>
                                    <th class="product-name">Chi tiết đơn hàng</th>

								</tr>
							</thead>
							<tbody>
                            <?php
                                include("../db.php");
                                include("checkLogin.php");

                                $tong_gio_hang = 0;
                                $id_user = $_SESSION['user_id'];

                                // Lấy danh sách đơn hàng của người dùng
                                $query = "SELECT d.* ,t.phuongthuc FROM donhang d ,thanhtoan t WHERE id_nguoidung=$id_user and d.id_donhang=t.id_donhang ORDER BY ngaydat DESC";
                                $result = mysqli_query($connection, $query);

                                while ($rows = mysqli_fetch_assoc($result)) {
                                    $tong_gio_hang += $rows['tongtien'];
                                ?>
                                    <tr class="table-body-row">
                                        <!-- <td class="product-remove">
                                            <?php if(isset($rows['id_donhang'])) { ?>
                                                <a href="#" class="remove-item" data-id="<?php echo $rows['id_donhang']; ?>">
                                                    <i class="far fa-window-close"></i>
                                                </a>
                                            <?php } else { echo 'Lỗi: Không tìm thấy đơn hàng!'; } ?>
                                        </td> -->

                                        <td class="product-name"><?php echo $rows['id_donhang']; ?></td>
                                        <td class="product-price"><?php echo number_format($rows['tongtien'], 0) . " VNĐ"; ?></td>
                                        <td class="product-name"><?php echo $rows['ngaydat']; ?></td>
                                        <td class="product-name"><?php echo $rows['diachi']; ?></td>
                                        <td class="product-name"><?php
																	if($rows['trangthai']=="cho_duyet"){
																		echo "Chờ duyệt"; 
																	}else if($rows['trangthai']=="dang_xu_ly"){
																		echo "Đang xử lý";
																	}else if($rows['trangthai']=="hoan_tat"){
																		echo "Hoàn tất";
																	}
																	else{	
																		echo "Hủy";
																	}
																?>
										</td>
										<td class="product-name"><?php 
																	if($rows['phuongthuc']=="tien_mat"){
																		echo "Tiền mặt";
																	}
																	else{
																		echo "paypal";
																	}
																	
																 ?></td>
                                        <td>
                                            <button class="btn btn-primary view-details" data-id="<?php echo $rows['id_donhang']; ?>" data-toggle="modal" data-target="#orderDetailModal">
                                                Xem Chi Tiết
                                            </button>
                                        </td>

                                    </tr>
                                <?php
                                }
                                ?>

							</tbody>
						</table>
					</div>
				</div>
                <div class="modal fade" id="orderDetailModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle">Chi Tiết Đơn Hàng</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="cart-table-wrap">
                                    <table class="cart-table">
                                        <thead class="cart-table-head">
                                            <tr class="table-head-row">
                                                <th>Hình món ăn</th>
                                                <th>Tên món ăn</th>
                                                <th>Số lượng</th>
                                                <th>Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody id="orderDetailContent">
                                            <!-- Nội dung đơn hàng sẽ được thêm vào đây -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
</div>

				<div class="col-lg-4">
					<div class="total-section">
						<!-- <table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Tổng giỏ hàng</th>
									<th>Gía</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong>Tổng cộng: </strong></td>
									<td>
										<?php echo number_format($tong_gio_hang,0) . " VNĐ"; ?>
									</td>
								</tr>					
							</tbody>
						</table>
						<div class="cart-buttons">
							<a href="cart.php" class="boxed-btn">Update Cart</a>
							<a href="checkout.php" class="boxed-btn black">Thanh toán</a>
						</div> -->
					</div>

					<!-- <div class="coupon-section">
						<h3>Apply Coupon</h3>
						<div class="coupon-form-wrap">
							<form action="index.php">
								<p><input type="text" placeholder="Coupon"></p>
								<p><input type="submit" value="Apply"></p>
							</form>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	<!-- end cart -->

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
        $(document).ready(function () {
            $(".view-details").click(function () {
                let id_donhang = $(this).data("id");

                $.ajax({
                    url: "getOrderDetails.php", // File xử lý lấy dữ liệu
                    type: "GET",
                    data: { id: id_donhang },
                    success: function (data) {
                        $("#orderDetailContent").html(data); // Đổ dữ liệu vào modal
                    },
                    error: function () {
                        alert("Không thể lấy dữ liệu chi tiết!");
                    }
                });
            });
        });

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