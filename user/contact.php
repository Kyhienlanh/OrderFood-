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

	<style>
	
		*{
			font-family: 'Open Sans', sans-serif;
		}

		.wrapper {
    width: 100%;
    max-width: 400px;
    background: #f8f9fa;
    border-radius: 15px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
    overflow: hidden;
}

.wrapper .title {
    background: #007bff;
    color: white;
    text-align: center;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.form {
    height: 300px;
    overflow-y: auto;
    padding: 10px;
    background: white;
}

.inbox {
    display: flex;
    align-items: center;
    margin: 8px 0;
}

.bot-inbox {
    justify-content: flex-start;
}

.user-inbox {
    justify-content: flex-end;
}

.icon {
    width: 35px;
    height: 35px;
    background: #007bff;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
}

.msg-header {
    background: #e9ecef;
    padding: 10px;
    border-radius: 10px;
    max-width: 70%;
    font-size: 14px;
}

.user-inbox .msg-header {
    background: #007bff;
    color: white;
}

.typing-field {
    padding: 10px;
    background: #f1f1f1;
    display: flex;
    align-items: center;
}

.input-data {
    flex: 1;
    display: flex;
}

.input-data input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 20px;
    outline: none;
}

.input-data button {
    background: #007bff;
    color: white;
    border: none;
    padding: 8px 15px;
    margin-left: 5px;
    border-radius: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.input-data button:hover {
    background: #0056b3;
}

	</style>
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
						<p>Hỗ trợ 24/7</p>
						<h1>Liên hệ với chúng tôi</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
			<div class="col-lg-8 mb-5 mb-lg-0">
				<div class="form-title">
					<h2>Bạn có thắc mắc gì không?</h2>
					
				</div>
				<div id="form_status"></div>
				<div class="contact-form">
					<form id="contact-form">
						<p>
							<input type="text" placeholder="Tên" name="name" id="name" required>
							<input type="email" placeholder="Email" name="email" id="email liên hệ" required>
						</p>
						<p>
							<input type="tel" placeholder="Số điện thoại" name="phone" id="phone">
							<input type="text" placeholder="Tiêu đề" name="subject" id="subject" required>
						</p>
						<p><textarea name="message" id="message" cols="30" rows="10" placeholder="Nội dung" required></textarea></p>
						<input type="hidden" name="token" value="FsWga4&@f6aw" />
						<p><button type="submit">Gửi</button></p>
						<!-- <p><input type="submit" value="Submit" ></p> -->

					</form>
				</div>
			</div>
			</div>

				<div class="col-lg-4">
					<div class="contact-form-wrap">
						<!-- <div class="contact-form-box">
							<h4><i class="fas fa-map"></i> Shop Address</h4>
							<p>34/8, East Hukupara <br> Gifirtok, Sadan. <br> Country Name</p>
						</div>
						<div class="contact-form-box">
							<h4><i class="far fa-clock"></i> Shop Hours</h4>
							<p>MON - FRIDAY: 8 to 9 PM <br> SAT - SUN: 10 to 8 PM </p>
						</div>
						<div class="contact-form-box">
							<h4><i class="fas fa-address-book"></i> Contact</h4>
							<p>Phone: +00 111 222 3333 <br> Email: support@fruitkha.com</p>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
				<div class="wrapper">
        <div class="title">Chatbot</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>
					Chào bạn, HKL Heathy Food có thể giúp gì cho bạn? Hãy chọn những yêu cầu của bạn: 1. Đặt hàng 2. Hủy đặt hàng 3. Liên hệ trực tuyến  
					</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Nhập câu hỏi.." required>
                <button id="send-btn">Gửi</button>
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
	<script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>

<script>
$(document).ready(function () {
    $("#contact-form").on("submit", function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "mail.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                let statusDiv = $("#form_status");
                if (data.status === "success") {
                    statusDiv.html("<p style='color: green;'>" + data.message + "</p>");
                    $("#contact-form")[0].reset();
                } else {
                    statusDiv.html("<p style='color: red;'>" + data.message + "</p>");
                }
            },
            error: function (xhr, status, error) {
                console.error("Lỗi gửi form:", error);
            }
        });
    });
});
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
	<!-- form validation js -->
	<script src="assets/js/form-validate.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>
	
</body>
</html>