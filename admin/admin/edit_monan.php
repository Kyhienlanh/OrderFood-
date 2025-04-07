<?php
ob_start(); // Bắt đầu output buffering
session_start(); // Khởi tạo session

include '../include/db.php'; // Kết nối CSDL

// Kiểm tra nếu 'id' có trong URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_monan = $_GET['id'];
} else {
    echo "ID không hợp lệ!";
    exit(); // Dừng thực thi script
}

// Lấy dữ liệu món ăn hiện tại
$sql_get = "SELECT * FROM monan WHERE id_monan = ?";
$stmt_get = mysqli_prepare($connection, $sql_get);
mysqli_stmt_bind_param($stmt_get, 'i', $id_monan);
mysqli_stmt_execute($stmt_get);
$result = mysqli_stmt_get_result($stmt_get);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['btnUpdate'])) {
    // Xử lý cập nhật món ăn
    $id_monan = $_POST['id_monan'];
    $id_danhmuc = $_POST['cbodanhmuc'];
    $tenmonan = $_POST['txttenmonan'];
    $gia = $_POST['txtgia'];
    $soluong = $_POST['txtsoluong'];
    $mota = $_POST['txtmota'];
    $old_image = $_POST['oldimage']; // Ảnh cũ
    $hinhanh = $old_image; // Giữ ảnh cũ nếu không có ảnh mới

    // Kiểm tra xem có ảnh mới không
    if (!empty($_FILES["txtimages"]["name"])) {
        $file_ext = pathinfo($_FILES["txtimages"]["name"], PATHINFO_EXTENSION); // Lấy đuôi mở rộng
        $hinhanh = time() . "." . $file_ext; // Đặt tên ảnh mới để tránh trùng lặp
        $target_file = "../../uploads/" . $hinhanh;

        // Tạo thư mục nếu chưa có
        if (!is_dir("../uploads")) {
            mkdir("../uploads", 0777, true);
        }

        // Kiểm tra lỗi khi upload
        if ($_FILES["txtimages"]["error"] !== UPLOAD_ERR_OK) {
            die("Lỗi khi tải ảnh! Mã lỗi: " . $_FILES["txtimages"]["error"]);
        }

        // Di chuyển file ảnh vào thư mục uploads
        if (!move_uploaded_file($_FILES["txtimages"]["tmp_name"], $target_file)) {
            die("Lỗi khi di chuyển ảnh vào thư mục!");
        }

        // Cập nhật ảnh mới vào CSDL
        $sql = "UPDATE monan SET hinhanh=? WHERE id_monan=?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $hinhanh, $id_monan);
        mysqli_stmt_execute($stmt);
    }

    // Cập nhật thông tin món ăn
    $sql_update = "UPDATE monan SET id_danhmuc = ?, tenmonan = ?, gia = ?, soluong = ?, mota = ? WHERE id_monan = ?";
    $stmt_update = mysqli_prepare($connection, $sql_update);
    mysqli_stmt_bind_param($stmt_update, 'issssi', $id_danhmuc, $tenmonan, $gia, $soluong, $mota, $id_monan);
    mysqli_stmt_execute($stmt_update);

    // Chuyển hướng về trang list_monan.php
    header("Location: list_monan.php");
    exit(); // Đảm bảo không có mã nào được thực thi sau khi chuyển hướng
}

ob_end_flush(); // Gửi tất cả đầu ra sau khi hoàn tất
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
                    <!-- Other topbar items here -->
                </nav>
                <!-- End of Topbar -->

                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            
                        </div>

                        <form method="post" enctype="multipart/form-data">
                            <table class="table table-striped table-bordered table-hover" style="width:50%" align="center">
                                <tbody>
                                    <input type="hidden" name="id_monan" value="<?= htmlspecialchars($id_monan) ?>">
                                    <input type="hidden" name="oldimage" value="<?= htmlspecialchars($row['hinhanh']) ?>">

                                    <tr>
                                        <td><b>Danh mục món ăn:</b></td>
                                        <td>
                                            <select class="form-control" name="cbodanhmuc">
                                                <?php
                                                $sql_danhmuc = "SELECT * FROM danhmuc";
                                                $rs_danhmuc = mysqli_query($connection, $sql_danhmuc);
                                                while ($danhmuc = mysqli_fetch_assoc($rs_danhmuc)) {
                                                    $selected = ($row['id_danhmuc'] == $danhmuc['id_danhmuc']) ? "selected" : "";
                                                    echo "<option value='" . $danhmuc['id_danhmuc'] . "' $selected>" . htmlspecialchars($danhmuc['tendanhmuc']) . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Tên món ăn:</b></td>
                                        <td><input type="text" class="form-control" name="txttenmonan" value="<?= htmlspecialchars($row['tenmonan']) ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td><b>Giá:</b></td>
                                        <td><input type="number" class="form-control" name="txtgia" value="<?= htmlspecialchars($row['gia']) ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td><b>Số lượng:</b></td>
                                        <td><input type="number" class="form-control" name="txtsoluong" value="<?= htmlspecialchars($row['soluong']) ?>" required></td>
                                    </tr>
                                    <tr>
                                        <td><b>Hình ảnh:</b></td>
                                        <td>
                                            <input type="file" class="form-control" name="txtimages">
                                            <?php if (!empty($row['hinhanh'])): ?>
                                                <img src="../uploads/<?= htmlspecialchars($row['hinhanh']) ?>" width="100">
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mô tả:</td>
                                        <td><textarea class="form-control" name="txtmota"><?= htmlspecialchars($row['mota']) ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <button type="submit" name="btnUpdate" class="btn btn-primary">Cập nhật</button>
                                            <button type="reset" class="btn btn-warning" style="margin-left: 10px">Làm lại</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

