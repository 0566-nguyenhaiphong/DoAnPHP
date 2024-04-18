<?php
include_once 'app/views/shareuser/header.php';
?>

<div class="shopping-cart">
    <h2>Giỏ hàng của tôi</h2>
    <br>
    <?php if(empty($_SESSION['cart'])): ?>
        <h2 style="text-align: center; color: #333; font-size: 18px;">Giỏ hàng của bạn hiện đang trống.</h2>
<p style="text-align: center; font-size: 16px;">Hãy khám phá sản phẩm tuyệt vời của chúng tôi tại đây: <a href="/chieu2/home" style="color: #007bff; text-decoration: none;">Bắt đầu mua sắm ngay!</a></p>

    <?php else: ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Mô tả</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0; // Initialize total variable
                $i = 1; // Initialize loop counter outside the loop
                foreach ($_SESSION['cart'] as $item) {
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td><img src='/chieu2/" . $item->image . "' alt='Sản phẩm'></td>";
                    echo "<td>" . $item->name . "</td>";
                    echo "<td>";
                    echo "<form method='post' action='/chieu2/cart/updateQuality/{$item->id}'>";
                    echo "<div class='input-group'>";
                    echo "<span class='input-group-btn'>";
                    echo "<button type='button' class='btn btn-sm btn-secondary quantity-button minus' onclick='subtractQuantity(this)'>-</button>";
                    echo "</span>";
                    echo "<input name='quality' type='number' class='form-control' value='{$item->quantity}' min='1' readonly />";
                    echo "<span class='input-group-btn'>";
                    echo "<button type='button' class='btn btn-sm btn-secondary quantity-button plus' onclick='addQuantity(this)'>+</button>";
                    echo "</span>";
                    echo "</div>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>£" . number_format($item->price, 2, '.', ',') ."</td>";
                    echo "<td><a href='/chieu2/cart/removeItem/{$item->id}' class='remove-item' onclick='return confirm(\"Are you sure you want to remove this item?\")'>Xóa</a></td>";
                    echo "</tr>";

                    // Increment loop counter
                    $i++;

                    // Calculate the total for each item and add it to the total variable
                    $total += $item->quantity * $item->price;
                }
                ?>
            </tbody>
        </table>
        <div class="cart-totals">
            <p>Tổng cộng:</p>
            <p id="total">£<?php echo number_format($total, 2, '.', ',');?></p>
        </div>
      
        <div class="cart-actions row">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Nhập mã khuyến mãi">
            </div>
            <div class="col-md-6">
                <select id="discount-codes" class="form-control" style="height: 100%;">
                    <option value="code1">Mã giảm giá 20%</option>
                    <option value="code2">Mã giảm giá 50%</option>
                    <option value="code3">Mã giảm giá 10%</option>
                    <option value="code4">Mã giảm giá 40%</option>
                    <option value="code5">Mã giảm giá 30%</option>
                </select>
            </div>
        </div>
        <button class="apply-discount btn btn-primary">Áp dụng giảm giá</button>
        <a href="/chieu2/cart/checkOutForm" class="btn btn-success">Thanh toán</a>
        <a href="/chieu2/home" class="btn btn-danger"> Trở về</a>
    <?php endif; ?>
</div>

<?php
include_once 'app/views/shareuser/footer.php';
?>
