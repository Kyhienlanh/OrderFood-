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
    


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                
                <div class="sidebar-brand-text mx-3">HKL Healthy Food</div>
            </a>

            <!-- Divider -->
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


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
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

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
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

                       

                        <div class="topbar-divider d-none d-sm-block"></div>

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
                            <div class="container-fluid">

            <!-- Page Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách các món ăn</h6>
                    <div class="button_add">
                        <button type="button" class="btn_add" onclick="window.location.href='insert_monan.php'">Thêm mới</button>
                    </div>
                </div>
                <div class="card-body">          
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Mã món ăn</th>
                    <th>Tên món ăn</th>
                    <th>Giá (VNĐ)</th>
                    <th>Số lượng</th>
                    <th>Hình ảnh</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <script>
                function del_confirm(strlink){
                    var ok = confirm("Bạn có muốn xóa không?");
                    if (ok) {
                        window.location.href = strlink;
                    }
                }
            </script>
            <tbody>
            <?php
                include '../include/db.php'; // Đảm bảo kết nối đúng

                // Đếm tổng số món ăn để phân trang
                $sql_count = "SELECT COUNT(*) AS total FROM monan";
                $result_count = mysqli_query($connection, $sql_count);
                $row_count = mysqli_fetch_assoc($result_count);
                $total_records = $row_count["total"] ?? 0; // Kiểm tra dữ liệu tránh lỗi Undefined Variable
                
                // Cấu hình phân trang
                $pageSize = 10;
                $current_page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
                $pos = ($current_page - 1) * $pageSize;

                // Truy vấn lấy dữ liệu theo phân trang
                $sql = "SELECT * FROM monan LIMIT $pos, $pageSize";
                $rs  = mysqli_query($connection, $sql);
                $i   = $pos + 1; // Đánh số thứ tự

                // Hiển thị dữ liệu trong bảng
                while ($row = mysqli_fetch_array($rs)) {
                    echo "
                    <tr>
                        <td>$i</td>
                        <td>" . htmlspecialchars($row["tenmonan"]) . "</td>
                        <td>" . number_format($row["gia"], 0, ',', '.') . "</td>
                        <td>" . $row["soluong"] . "</td>
                        <td>";
                
                    // Đường dẫn ảnh
                    $image_path = '../../uploads/' . htmlspecialchars($row["hinhanh"]);
      
                    // Kiểm tra xem file có tồn tại hay không
                    if (file_exists($image_path)) {
                        echo "<img src='$image_path' width='120' height='150'>";
                    } else {
                        // In ra đường dẫn ảnh để debug nếu cần
                        echo "<p>Hình ảnh không tồn tại. Đường dẫn: $image_path</p>";
                        echo "<img src='../uploads/default.png' width='80' height='60'>"; // Nếu không có ảnh, hiển thị ảnh mặc định
                    }
                
                    echo "</td>
                        <td>" . $row["ngaytao"] . "</td>
                        <td>
                            <a href='edit_monan.php?id=" . $row["id_monan"] . "' class='btn btn-warning'>Sửa</a>
                            <a href='delete_moan.php?id=" . $row["id_monan"] . "' class='btn btn-danger' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")'>Xóa</a>
                        </td>
                    </tr>";
                    $i++;
                }
                

                // Giải phóng bộ nhớ kết quả sau khi truy vấn
                mysqli_free_result($rs);
            ?>
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php
                $total_pages = ceil($total_records / $pageSize);
                
                if ($total_pages > 1) {
                    for ($i = 1; $i <= $total_pages; $i++) {
                        $active = ($i == $current_page) ? "active" : "";
                        echo "<li class='page-item $active'><a class='page-link' href='list_monan.php?page=$i'>$i</a></li>";
                    }
                }
            ?>
        </ul>
    </nav>
</div>

            <!-- /.container-fluid -->

</div>
                

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