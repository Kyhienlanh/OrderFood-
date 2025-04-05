<?php
// Kiểm tra nếu session chưa được khởi tạo
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Chỉ gọi session_start() nếu session chưa được bắt đầu
}

// Kết nối cơ sở dữ liệu
include '../include/db.php';

// Lấy doanh thu theo tháng
$sql = "SELECT MONTH(ngaydat) AS thang, SUM(tongtien) AS doanhthu 
        FROM donhang 
        WHERE trangthai = 'hoan_tat'
        GROUP BY thang 
        ORDER BY thang";
$result = $connection->query($sql);

$months = [];
$revenues = [];

while ($row = $result->fetch_assoc()) {
    $months[] = "Tháng " . $row['thang'];
    $revenues[] = $row['doanhthu'];
}

$connection->close();

// Lấy tên người dùng từ session hoặc mặc định là 'quanly'
$ten_nguoidung = isset($_SESSION['ten_nguoidung']) ? $_SESSION['ten_nguoidung'] : 'quanly';
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,600,800" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $ten_nguoidung; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

               

                <!-- Các biểu đồ -->
                
                <div class="chart-container">
                    <canvas id="barChart"></canvas>
                    <canvas id="pieChart"></canvas>
                </div>
                <canvas id="areaChart"></canvas>



                <script>
                    var months = <?php echo json_encode($months); ?>;
                    var revenues = <?php echo json_encode($revenues); ?>;

                    // Biểu đồ cột
                    var ctx1 = document.getElementById('barChart').getContext('2d');
                    new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Doanh thu',
                                data: revenues,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        }
                    });

                    // Biểu đồ tròn
                    var ctx2 = document.getElementById('pieChart').getContext('2d');
                    new Chart(ctx2, {
                        type: 'pie',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Doanh thu',
                                data: revenues,
                                backgroundColor: ['red', 'blue', 'green', 'yellow', 'purple', 'orange']
                            }]
                        }
                    });

                    // Biểu đồ miền
                    var ctx3 = document.getElementById('areaChart').getContext('2d');
                    new Chart(ctx3, {
                        type: 'line',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Doanh thu',
                                data: revenues,
                                fill: true,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 2
                            }]
                        }
                    });
                </script>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; HKL Healthy Food 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

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
