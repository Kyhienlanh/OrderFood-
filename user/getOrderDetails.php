<?php
include("../db.php");

if (isset($_GET['id'])) {
    $id_donhang = $_GET['id'];

    $query = "SELECT m.tenmonan, m.hinhanh, c.soluong, c.gia 
              FROM chitietdonhang c 
              JOIN monan m ON c.id_monan = m.id_monan 
              WHERE c.id_donhang = $id_donhang";
    
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='table-body-row'>
                <td><img src='../uploads/" . htmlspecialchars($row['hinhanh']) . "' width='50'></td>
                <td>" . $row['tenmonan'] . "</td>
                <td>" . $row['soluong'] . "</td>
                <td>" . number_format($row['soluong'] * $row['gia']) . " VNĐ</td>
              </tr>";
    }
}
?>
