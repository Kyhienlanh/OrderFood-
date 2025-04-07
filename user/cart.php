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
						
						<h1>Giỏ hàng</h1>
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
									<th class="product-remove"></th>
									<th class="product-image">Hình món ăn</th>
									<th class="product-name">Tên món ăn</th>
									<th class="product-price">Gía</th>
									<th class="product-quantity">Số lượng</th>
									<th class="product-total">Tổng</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include("../db.php");
									include("checkLogin.php");
									$tong_gio_hang = 0;
									$id_user=$_SESSION['user_id'];
									
									$query="SELECT g.* ,m.tenmonan , m.gia , m.hinhanh  FROM giohang g , monan m where g.id_monan= m.id_monan and g.id_nguoidung=$id_user";

									$result=mysqli_query($connection,$query);
									while($rows=mysqli_fetch_assoc($result)){ 
										$tong_gio_hang += $rows['soluong'] * $rows['gia'];
										?>
										<tr class="table-body-row">
										<td class="product-remove">
											<a href="#" class="remove-item" data-id="<?php echo $rows['id_monan']; ?>">
												<i class="far fa-window-close"></i>
											</a>
										</td>

											<td class="product-image">
												<img src="<?php echo '../uploads/' . htmlspecialchars($rows['hinhanh']); ?>" alt="">
											</td>

											<td class="product-name"><?php echo $rows['tenmonan'];?></td>
											<td class="product-price"><?php echo number_format($rows['gia'],0) . " VNĐ";?></td>
											<td class="product-quantity">
												<input type="number" class="quantity-input" 
													data-id="<?php echo $rows['id_monan']; ?>" 
													data-price="<?php echo $rows['gia']; ?>" 
													min="1" 
													value="<?php echo $rows['soluong']; ?>">
											</td>

											<td class="product-total" id="total-<?php echo $rows['id_monan']; ?>">
												<?php echo number_format($rows['soluong'] * $rows['gia']) . " VNĐ"; ?>
											</td>
										</tr>
								<?php
									}
									?>  
									
									<?php
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
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
							<!-- <a href="cart.php" class="boxed-btn">Update Cart</a> -->
							<a href="checkout.php" class="boxed-btn black">Thanh toán</a>
						</div>
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
<script>
 $(document).ready(function () {
    $(".quantity-input").on("change", function () {
        let id_monan = $(this).data("id");  
        let newQuantity = parseInt($(this).val());  
        let price = parseInt($(this).closest("tr").find(".product-price").text().replace(/[^0-9]/g, ""));
        let rowTotalElement = $(this).closest("tr").find(".product-total"); 

        if (isNaN(newQuantity) || newQuantity < 1) {
            alert("Số lượng phải lớn hơn 0!");
            $(this).val(1);
            newQuantity = 1;
        }

        if (isNaN(price)) {
            alert("Lỗi: Không lấy được giá sản phẩm!");
            return;
        }

        // Cập nhật tổng tiền sản phẩm
        let newTotal = newQuantity * price;
        rowTotalElement.text(newTotal.toLocaleString() + " VNĐ");

        // Gửi AJAX cập nhật database
        $.ajax({
            url: "update_cart.php",
            type: "POST",
            data: { id_monan: id_monan, soluong: newQuantity },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    // Cập nhật tổng tiền giỏ hàng
                    // $("#cart-total").text(response.cart_total.toLocaleString() + " VNĐ");
					$(".total-data td:last-child").text(
						new Intl.NumberFormat("vi-VN").format(response.cart_total) + " VNĐ"
					);

                } else {
                    alert("Lỗi: " + response.message);
                }
            },
            error: function () {
                alert("Lỗi kết nối, vui lòng thử lại!");
            }
        });
    });
});


$(document).ready(function () {
    $(".remove-item").on("click", function (e) {
        e.preventDefault(); // Ngăn chặn chuyển hướng trang

        let id_monan = $(this).data("id"); // Lấy ID món ăn
        let row = $(this).closest("tr"); // Lấy dòng sản phẩm

        // Hiển thị thông báo xác nhận bằng SweetAlert2
        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Sản phẩm này sẽ bị xóa khỏi giỏ hàng!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Xóa",
            cancelButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) {
                // Gửi AJAX để xóa sản phẩm
                $.ajax({
                    url: "remove_cart.php",
                    type: "POST",
                    data: { id_monan: id_monan },
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            row.remove(); // Xóa sản phẩm khỏi giao diện

                            // Cập nhật tổng giỏ hàng
                            $("#cart-total, .total-data td:last-child").text(
                                new Intl.NumberFormat("vi-VN").format(response.cart_total) + " VNĐ"
                            );

                            // Hiển thị thông báo thành công
                            Swal.fire({
                                title: "Xóa thành công!",
                                text: "Sản phẩm đã bị xóa khỏi giỏ hàng.",
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        } else {
                            Swal.fire("Lỗi!", response.message, "error");
                        }
                    },
                    error: function () {
                        Swal.fire("Lỗi!", "Đã xảy ra lỗi, vui lòng thử lại!", "error");
                    },
                });
            }
        });
    });
});




</script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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