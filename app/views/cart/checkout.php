<?php
include_once 'app/views/shareuser/header.php';
?>

  <div class="container">
    <h1>Đơn hàng</h1>

    <div class="order-info">
      <h2>Thông tin thanh toán</h2>

      <form action="/chieu2/cart/checkout" method="post">
        <div class="form-group">
          <label for="name">Họ và Tên:</label>
          <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
          <label for="phone">Điện thoại:</label>
          <input type="text" id="phone" name="phone" required>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
          <label for="address">Địa chỉ nhận hàng:</label>
          <input type="text" id="address" name="address" required>
        </div>

        <div class="form-group">
          <label for="payment-method">Phương thức thanh toán:</label>
          <select id="payment-method" name="payment-method" required>
            <option value="cod">COD (Nhận hàng và thanh toán tiền mặt)</option>
            <option value="bank-transfer">Chuyển khoản (Thanh toán bằng cách chuyển khoản qua ngân hàng)</option>
          </select>
        </div>

        <div class="form-group">
          <input type="checkbox" id="terms" name="terms" required>
          <label for="terms">Tôi đã đọc và đồng ý các điều khoản & chính sách của website</label>
        </div>

        <button type="submit">Đặt hàng</button>
      </form>
    </div>
  </div>


  <?php

include_once 'app/views/shareuser/footer.php';

?>