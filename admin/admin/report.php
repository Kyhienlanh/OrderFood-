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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="css/style.css" rel="stylesheet">

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
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <?php
                            if (isset($_SESSION['ten_nguoidung'])) {
                                $ten_nguoidung = $_SESSION['ten_nguoidung'];
                            } else {
                                $ten_nguoidung = 'quanly';
                            }
                        ?>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $ten_nguoidung; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div class="container mt-4">
                <h3>Báo cáo thống kê doanh thu</h3>
                <form method="GET" action="report.php">
                    <div class="row mb-3">
                        <label for="date" class="col-sm-2 col-form-label">Chọn thời gian</label>
                        

                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="date" name="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : date('d/m/Y'); ?>" placeholder="DD/MM/YYYY" />
                        </div>

                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">Lọc</button>
                        </div>
                    </div>
                </form>

                <?php
                    include '../include/db.php';

                    $time_filter = isset($_GET['time_filter']) ? $_GET['time_filter'] : 'day';
                    $date = isset($_GET['date']) ? $_GET['date'] : date('d/m/Y');
                    $total_orders = 0;
                    $total_revenue = 0;

                    // Kiểm tra và chuyển đổi định dạng ngày tháng từ DD/MM/YYYY sang YYYY-MM-DD
                    $date_format = DateTime::createFromFormat('d/m/Y', $date);
                    if ($date_format === false) {
                        echo "<p class='text-danger'>Ngày nhập không hợp lệ. Vui lòng nhập lại theo định dạng DD/MM/YYYY.</p>";
                        exit;
                    }
                    $formatted_date = $date_format->format('Y-m-d');

                    // Xử lý truy vấn theo từng loại lọc
                    if ($time_filter == 'day') {
                        // Báo cáo theo ngày
                        $sql = "SELECT COUNT(*) AS total_orders, SUM(dh.tongtien) AS total_revenue
                                FROM donhang dh
                                WHERE dh.trangthai = 'hoan_tat' AND DATE(dh.ngaydat) = ?";
                    } elseif ($time_filter == 'month') {
                        // Báo cáo theo tháng
                        $sql = "SELECT COUNT(*) AS total_orders, SUM(dh.tongtien) AS total_revenue
                                FROM donhang dh
                                WHERE dh.trangthai = 'hoan_tat' AND MONTH(dh.ngaydat) = MONTH(?) AND YEAR(dh.ngaydat) = YEAR(?)";
                    } else {
                        // Báo cáo theo năm
                        $sql = "SELECT COUNT(*) AS total_orders, SUM(dh.tongtien) AS total_revenue
                                FROM donhang dh
                                WHERE dh.trangthai = 'hoan_tat' AND YEAR(dh.ngaydat) = YEAR(?)";
                    }

                    // Chuẩn bị và thực thi truy vấn
                    $stmt = mysqli_prepare($connection, $sql);
                    if ($time_filter == 'day') {
                        mysqli_stmt_bind_param($stmt, 's', $formatted_date);
                    } else {
                        mysqli_stmt_bind_param($stmt, 'ss', $formatted_date, $formatted_date);
                    }
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);

                    // Lấy tổng số lượng đơn hàng và tổng doanh thu
                    $total_orders = $row['total_orders'] ? $row['total_orders'] : 0;
                    $total_revenue = $row['total_revenue'] ? number_format($row['total_revenue'], 0, ',', '.') : '0';

                    // Hiển thị tổng số lượng đơn hàng và tổng doanh thu hoặc thông báo không có dữ liệu
                    echo "<p>Tổng số lượng đơn hàng hoàn tất: " . $total_orders . " đơn</p>";
                    echo "<p>Tổng doanh thu: " . $total_revenue . "</p>";

                    if ($total_orders == 0) {
                        echo "<p>Không có đơn hàng hoàn tất trong khoảng thời gian đã chọn.</p>";
                    }
                    if ($total_revenue == '0') {
                        echo "<p>Không có doanh thu trong khoảng thời gian đã chọn.</p>";
                    }
                ?>



        <div class="mt-5">
            <!-- Thêm các thông tin chi tiết khác nếu cần -->
        </div>
    </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#date").datepicker({
                    dateFormat: "dd/mm/yy"
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



            <!-- Footer -->
            
            <!-- End of Footer -->

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
                    <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn muốn đăng xuất?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn để đăng xuất</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <a class="btn btn-primary" href="../../user/logout.php">Đăng xuất</a>
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
    