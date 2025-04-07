<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.php">
								<img src="assets/img/logo01.png" alt="" >
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a href="index.php">Trang Chủ</a>
									<!-- <ul class="sub-menu">
										<li><a href="index.php">Static Home</a></li>
										<li><a href="index_2.php">Slider Home</a></li>
									</ul> -->
								</li>
								<li><a href="about.php">Giới thiệu</a></li>
								<!-- <li><a href="#">Trang</a>
									<ul class="sub-menu">
										<li><a href="404.php">404 page</a></li>
										<li><a href="about.php">About</a></li>
										<li><a href="cart.php">Cart</a></li>
										<li><a href="checkout.php">Check Out</a></li>
										<li><a href="contact.php">Contact</a></li>
										<li><a href="news.php">News</a></li>
										<li><a href="shop.php">Shop</a></li>
									</ul>
								</li> -->
								<!-- <li><a href="news.php"><Table>Tin tức</Table></a>
									<ul class="sub-menu">
										<li><a href="news.php">News</a></li>
										<li><a href="single-news.php">Single News</a></li>
									</ul>
								</li> -->
								<li><a href="contact.php">Liên hệ</a></li>
								<li><a href="shop.php">Cửa hàng</a>
									<ul class="sub-menu">
										<li><a href="shop.php">Cửa hàng</a></li>
										<li><a href="checkout.php">Đặt hàng</a></li>
										<!-- <li><a href="single-product.php">Single Product</a></li> -->
										<li><a href="cart.php">Giỏ hàng </a></li>
									</ul>
								</li>
								<?php
									
								
									if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
										echo '<li><a href="#">Xin chào '. $_SESSION['username'] . '</a>
												<ul class="sub-menu">
													<li><a href="logout.php">Đăng xuất</a></li>
													<li><a href="HoSoNguoiDung.php">Thông tin tài khoản</a></li>
													<li><a href="donhang.php">Đơn hàng</a></li>
												</ul>
											</li>';
									} else {
										echo '<li><a href="../login.php">Đăng nhập</a></li>';
									}
								?>

								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>