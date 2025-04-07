<?php
// Kiểm tra nếu session chưa được khởi tạo
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Chỉ gọi session_start() nếu session chưa được bắt đầu
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quản lý đồ ăn</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#txtmota'))
                .catch(error => {
                    console.error(error);
                });
        });
    </script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">HKL Healthy Food</div>
            </a>
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="order_confirm.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Xác nhận đơn hàng</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="list_monan.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Quản lý món ăn</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="list_danhmuc.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Quản lý danh mục</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="list_user.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Quản lý người dùng</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="report.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Báo cáo doanh thu</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="charts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Thống kê doanh thu</span></a>
            </li>

            <!-- Other sidebar items... -->

            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        
                    </form>

                    <ul class="navbar-nav ml-auto">

                        

                        <!-- Nav Item - User Information -->
                        <?php
                            if (isset($_SESSION['ten_nguoidung'])) {
                                $ten_nguoidung = $_SESSION['ten_nguoidung'];
                            } else {
                                $ten_nguoidung = 'quanly';
                            }
                        ?>

                        

                    </ul>

                </nav>
                <?php
            include '../include/db.php'; // Kết nối database

            // Kiểm tra khi form được submit
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (!empty($_POST["tendanhmuc"]) && !empty($_POST["txtmota"])) {
                    // Lấy dữ liệu từ form
                    $tendanhmuc = mysqli_real_escape_string($connection, $_POST["tendanhmuc"]);
                    $mota = mysqli_real_escape_string($connection, $_POST["txtmota"]);

                    // Câu lệnh SQL thêm danh mục mới
                    $sql = "INSERT INTO danhmuc (tendanhmuc, mota, ngaytao) VALUES ('$tendanhmuc', '$mota', NOW())";
                    $rs = mysqli_query($connection, $sql);

                    // Kiểm tra kết quả thực thi
                    if ($rs) {
                        echo "<script>alert('Thêm danh mục thành công!'); window.location.href='list_danhmuc.php';</script>";
                        exit();
                    } else {
                        die("<p style='color:red;'>Lỗi khi thêm danh mục: " . mysqli_error($connection) . "</p>");
                    }
                } else {
                    echo "<p style='color:red;'>Vui lòng nhập đầy đủ thông tin.</p>";
                }
            }
            ?>

            <form method="post" enctype="multipart/form-data">
                <table class="table table-striped table-bordered table-hover" style="width:90%" align="center">
                    <tbody>
                        <tr>
                            <td><b>Tên danh mục:</b></td>
                            <td><input class="form-control" type="text" name="tendanhmuc" required></td>
                        </tr>
                        <tr>
                            <td><b>Mô tả:</b></td>
                            <td><textarea class="form-control" name="txtmota" id="txtmota"><?= isset($mota) ? htmlspecialchars($mota) : '' ?></textarea></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                                <button type="reset" class="btn btn-warning" style="margin-left: 10px">Làm lại</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>


<script>
    CKEDITOR.replace('txtmota');
</script>

           

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
