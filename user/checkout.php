<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Check Out</title>

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
	include("../db.php");
	include("checkLogin.php");
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
						<p>Fresh and Organic</p>
						<h1>Check Out Product</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- check out section -->
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="checkout-accordion-wrap">
						<div class="accordion" id="accordionExample">
						  <div class="card single-accordion">
						    <div class="card-header" id="headingOne">
						      <h5 class="mb-0">
						        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						          Địa chỉ nhận hàng
						        </button>
						      </h5>
						    </div>

						    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="billing-address-form">
								<?php
										$id_user=$_SESSION['user_id'];
										$query="SELECT * from nguoidung where id_nguoidung=$id_user";
										$result=mysqli_query($connection,$query);
										while($rows=mysqli_fetch_assoc($result)){ ?>

										<form action="DatHang.php" method="POST">
										<p><input type="text" name="name" placeholder="Tên" required value="<?php echo $rows['tennguoidung'];?>"></p>
										<p><input type="email" name="email" placeholder="Email" required  value="<?php echo $rows['email'];?>"></p>
										<p><input type="text" id="address" name="address" placeholder="Địa chỉ nhận hàng" required value="<?php echo $rows['diachi'];?>"></p>

										<p><input type="tel" name="phone" placeholder="Số điện thoại" required  value="<?php echo $rows['sodienthoai'];?>"></p>
										<p>
											<label>
												<input type="radio" name="payment_method" value="cod" checked> Thanh toán khi nhận hàng
											</label>
											<label>
												<input type="radio" name="payment_method" value="paypal"> Thanh toán qua PayPal
											</label>
										</p>

										<p><textarea name="note" cols="30" rows="5" placeholder="ghi chú"></textarea></p>
										<!-- <button type="submit" class="boxed-btn" style="border-radius: 20px;">Đặt hàng</button> -->
								</form>
										<?php
										}

								?>
						        </div>
						      </div>
						    </div>
						  </div>
						  <div class="card single-accordion">
						    <!-- <div class="card-header" id="headingTwo">
						      <h5 class="mb-0">
						        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						          Shipping Address
						        </button>
						      </h5>
						    </div> -->
						    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="shipping-address-form">
						        	<p>Your shipping address form is here.</p>
						        </div>
						      </div>
						    </div>
						  </div>
						  <div class="card single-accordion">
						    <!-- <div class="card-header" id="headingThree">
						      <h5 class="mb-0">
						        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						          Card Details
						        </button>
						      </h5>
						    </div> -->
						    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="card-details">
						        	<p>Your card details goes here.</p>
						        </div>
						      </div>
						    </div>
						  </div>
						</div>

					</div>
				</div>

				<div class="col-lg-4">
					<div class="order-details-wrap">
						<table class="order-details">
							<thead>
								<tr>
									<th>Chi tiết đơn hàng </th>
									<th>Số lượng</th>
									<th>Gía</th>
								</tr>
							</thead>
							<tbody class="order-details-body">
							<?php
								
									
									$tong_gio_hang = 0;
									$id_user=$_SESSION['user_id'];
									
									$query="SELECT g.* ,m.tenmonan , m.gia , m.hinhanh  FROM giohang g , monan m where g.id_monan= m.id_monan and g.id_nguoidung=$id_user";

									$result=mysqli_query($connection,$query);
									while($rows=mysqli_fetch_assoc($result)){ 
										$tong_gio_hang += $rows['soluong'] * $rows['gia'];
										?>
										<tr class="table-body-row">
											<td class="product-name"><?php echo $rows['tenmonan'];?></td>
											<td class="product-quantity">
											<?php echo $rows['soluong']; ?>
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
							<tbody class="checkout-details">
								<tr>
									<?php
											$id_user = $_SESSION['user_id'];
										    $query_total = "SELECT SUM(g.soluong * m.gia) AS tong_gio_hang 
											FROM giohang g 
											JOIN monan m ON g.id_monan = m.id_monan 
											WHERE g.id_nguoidung = $id_user";
											$result_total = mysqli_query($connection, $query_total);
											if ($result_total) {
												$row_total = mysqli_fetch_assoc($result_total);
												$tong_gio_hang = $row_total['tong_gio_hang'] ?? 0;
												echo "	<td>Tổng cộng</td>
														<td></td>
														<td>" . number_format($tong_gio_hang, 0) . " VNĐ</td>";

											}
									?>
									
								</tr>
							</tbody>
						</table>
						<a href="#" class="boxed-btn">Đặt hàng</a>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end check out section -->

	<!-- logo carousel -->
	
	<!-- end logo carousel -->

	<!-- footer -->
	<?php
	include("footer.php");
	?>
	<!-- end copyright -->
<!-- Thêm thư viện SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function () {
    $(".boxed-btn").click(function (e) {
        e.preventDefault(); // Ngăn trang tải lại

        let paymentMethod = $("input[name='payment_method']:checked").val(); // Lấy phương thức thanh toán
		let tongtien = $("td:contains('Tổng cộng')").next().next().text().replace(" VNĐ", "").replace(",", "").trim();

		let formData = {
			name: $("input[name='name']").val(),
			email: $("input[name='email']").val(),
			address: $("input[name='address']").val(),
			phone: $("input[name='phone']").val(),
			note: $("textarea[name='note']").val(),
			payment_method: paymentMethod,
			tongtien: tongtien // 🟢 Thêm tổng tiền vào formData
		};

		console.log("Dữ liệu gửi đi:", formData); // Kiểm tra dữ liệu trước khi gửi


        if (paymentMethod === "cod") {
            // ✅ Thanh toán khi nhận hàng (COD)
            $.ajax({
                url: "DatHang.php",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    console.log("Phản hồi từ server:", response);

                    if (response.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Đặt hàng thành công!",
                            text: "Mã đơn hàng: " + response.id_donhang,
                            confirmButtonText: "Xem đơn hàng"
                        }).then(() => {
                            window.location.href = "donhang.php?id=" + response.id_donhang;
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi!",
                            text: response.message,
                            confirmButtonText: "Thử lại"
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Lỗi AJAX:", xhr.responseText);
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi kết nối!",
                        text: "Không thể gửi yêu cầu, vui lòng thử lại sau.",
                        confirmButtonText: "OK"
                    });
                }
            });
        } else if (paymentMethod === "paypal") {
            // ✅ Chuyển hướng đến trang PayPal
            let paypalUrl = "../pay.php?" + $.param(formData);
            window.location.href = paypalUrl;
        }
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