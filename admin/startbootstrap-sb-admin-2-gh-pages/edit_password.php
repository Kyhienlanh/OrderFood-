<?php
include '../include/db.php'; // Ensure correct database connection

// Function to hash passwords using MD5
function hash_password_md5($password) {
    return md5($password);  // Hash using MD5
}

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the user ID from the URL

    // Set a default password (you can customize this as needed)
    $default_password = '123456';  // Default password to reset to

    // Hash the default password using MD5
    $hashed_password = hash_password_md5($default_password);

    // Update query to reset the password with the hashed value
    $sql = "UPDATE nguoidung SET matkhau = '$hashed_password' WHERE id_nguoidung = $id";

    // Execute the query
    if (mysqli_query($connection, $sql)) {
        echo "<script>alert('Mật khẩu đã được khôi phục về mặc định!'); window.location.href = 'list_user.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi khôi phục mật khẩu!'); window.location.href = 'list_user.php';</script>";
    }
} else {
    echo "<script>alert('ID người dùng không hợp lệ!'); window.location.href = 'list_user.php';</script>";
}
?>
