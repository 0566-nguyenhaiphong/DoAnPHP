<?php

class Cart{
    static function countItemsInCart()
{
    $totalItems = 0;

    // Kiểm tra xem session giỏ hàng có tồn tại không
    if (isset($_SESSION['cart'])) {
        // Lặp qua từng sản phẩm trong giỏ hàng và tính tổng số lượng
        foreach ($_SESSION['cart'] as $item) {
            $totalItems += $item->quantity;
        }
    }

    return $totalItems;
}

}