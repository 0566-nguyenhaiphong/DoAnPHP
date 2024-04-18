<?php
include_once 'app/views/share/header.php';
?>
  <div class="container">
    <h1>Chi tiết đơn hàng</h1>

    <div class="order-info">
      <h2>Thông tin đơn hàng</h2>

      <table class="order-details">
        <thead>
          <tr>
            <th>Mã đơn hàng</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Duyệt qua danh sách sản phẩm trong đơn hàng và hiển thị thông tin
          foreach ($orderDetails as $orderDetail) {
            echo "<tr>";
            echo "<td>{$orderDetail['order_id']}</td>";
            echo "<td>{$orderDetail['product_name']}</td>";
            echo "<td>{$orderDetail['quantity']}</td>";
            echo "<td>{$orderDetail['price']}</td>";
            echo "<td>" . number_format($orderDetail['total'], 2, '.', ',') . "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
       
      </table>
    </div>
  </div>

  <?php
include_once 'app/views/share/footer.php';
?>
