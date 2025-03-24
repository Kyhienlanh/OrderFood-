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

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                
                <div class="sidebar-brand-text mx-3">HKL Healthy Food</div>
            </a>

            <!-- Divider -->
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
                        
                    </button>                                                                             
                        <div class="topbar-divider d-none d-sm-block"></div>                        
                    </ul>

                </nav>
                <!-- End of Topbar -->
                <?php
                    include "../include/db.php"; // Kết nối cơ sở dữ liệu

                    // Kiểm tra nếu form đã được gửi
                    if (isset($_POST["danhmuc"])) {
                        // Lấy dữ liệu từ form
                        $id_danhmuc = $_POST["danhmuc"];
                        $tenmonan = $_POST["txttenmonan"];
                        $gia = $_POST["txtgia"];
                        $soluong = $_POST["txtsoluong"];
                        $mota = $_POST["txtmota"];

                        // Xử lý hình ảnh
                        $hinhanh = $_FILES["txtimages"]["name"];
                        $name_tmp = $_FILES["txtimages"]["tmp_name"];
                        $image_size = $_FILES["txtimages"]["size"];
                        $image_type = $_FILES["txtimages"]["type"];
                        
                        // Kiểm tra thư mục uploads có tồn tại không, nếu chưa có thì tạo
                        $uploads_dir = "../../uploads";
                        if (!file_exists($uploads_dir)) {
                            mkdir($uploads_dir, 0777, true); // Tạo thư mục nếu không tồn tại
                        }

                        // Kiểm tra kích thước và loại hình ảnh hợp lệ
                        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                        $max_size = 5 * 1024 * 1024; // 5MB

                        if (!in_array($image_type, $allowed_types)) {
                            echo "<script>alert('Chỉ chấp nhận hình ảnh định dạng JPEG, PNG, GIF');</script>";
                            exit();
                        }

                        if ($image_size > $max_size) {
                            echo "<script>alert('Kích thước hình ảnh quá lớn. Vui lòng chọn hình ảnh dưới 5MB.');</script>";
                            exit();
                        }

                        // Lấy ngày tạo (thời gian thực)
                        $ngaytao = date('Y-m-d H:i:s');

                        // Lấy tên tệp hình ảnh và đảm bảo tên tệp an toàn
                        $hinhanh = basename($hinhanh);
                        $image_path = $uploads_dir . "/" . $hinhanh;

                        // Di chuyển hình ảnh vào thư mục uploads
                        if (!move_uploaded_file($name_tmp, $image_path)) {
                            echo "<script>alert('Lỗi khi tải hình ảnh lên.');</script>";
                            echo "Lỗi: " . error_get_last()['message']; // Hiển thị lỗi chi tiết
                            exit();
                        }

                        // Câu truy vấn thêm món ăn với Prepared Statements
                        $sql = "INSERT INTO monan(id_danhmuc, tenmonan, gia, soluong, mota, hinhanh, ngaytao) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)";

                        // Chuẩn bị câu truy vấn
                        $stmt = mysqli_prepare($connection, $sql);
                        mysqli_stmt_bind_param($stmt, "ssiiiss", $id_danhmuc, $tenmonan, $gia, $soluong, $mota, $hinhanh, $ngaytao);

                        // Thực thi câu truy vấn
                        $rs = mysqli_stmt_execute($stmt);

                        // Kiểm tra nếu truy vấn thành công
                        if ($rs) {
                            echo "<script>window.location.href='list_monan.php';</script>"; // Chuyển hướng đến trang danh sách món ăn
                        } else {
                            // In ra lỗi MySQL nếu có
                            echo "<script>alert('Thêm món ăn không thành công: " . mysqli_error($connection) . "');</script>";
                        }
                    }
                    ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Món Ăn</title>
</head>
<body>
    

    <form method="post" enctype="multipart/form-data">
        <table class="table table-striped table-bordered table-hover" style="width:90%" align="center">
            <tbody>
                <tr>
                    <td><b>Tên danh mục (*):</b></td>
                    <td>
                        <select class="form-control" name="danhmuc" required>
                            <?php
                            // Lấy danh sách chủ đề từ cơ sở dữ liệu
                            $sql = "SELECT * FROM danhmuc";
                            $rs = mysqli_query($connection, $sql);

                            if ($rs) {
                                while ($row = mysqli_fetch_assoc($rs)) {
                                    echo '<option value="' . $row["id_danhmuc"] . '">' . $row["tendanhmuc"] . '</option>';
                                }
                            } else {
                                echo '<option value="">Không có dữ liệu</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b>Tên món ăn (*):</b></td>
                    <td><input class="form-control" name="txttenmonan" required></td>
                </tr>
                <tr>
                    <td><b>Giá:</b></td>
                    <td><input class="form-control" name="txtgia" type="number" required></td>
                </tr>
                <tr>
                    <td><b>Số lượng:</b></td>
                    <td><input class="form-control" name="txtsoluong" type="number" required></td>
                </tr>
                <tr>
                    <td>Mô tả:</td>
                    <td><textarea class="form-control" name="txtmota" id="txtmota"></textarea></td>
                </tr>
                <tr>
                    <td><b>Hình ảnh:</b></td>
                    <td><input type="file" class="form-control" name="txtimages" id="fileField" required></td>
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
</body>
</html>


                

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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
