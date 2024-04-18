<?php include_once 'app/views/shareuser/header.php'; ?>

<h2 style="margin-top:150px">Order List</h2>

<?php if (empty($userOrders)): ?>
    <p>No orders found.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Note</th>
                <th>Total amount</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userOrders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['customer_name']; ?></td>
                    <td><?php echo $order['phone']; ?></td>
                    <td>
                    <?php
                        switch ($order['status']) {
                            case 1:
                                echo "Đơn chờ xử lí";
                                break;
                            case 2:
                                echo "Đã xác nhận";
                                break;
                            case 3:
                                echo "Đang giao hàng";
                                break;
                            case 4:
                                echo "Đã nhận hàng";
                                break;
                            default:
                                echo "Unknown";
                                break;
                        }
                    ?>
                    </td>

                    <td><?php echo $order['note']; ?></td>
                    <td><?php echo $order['total_amount']; ?></td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($order['created_at'])); ?></td>
                    <td><a href="/chieu2/cart/orderDetailUser/<?php echo $order['id']; ?>" class="btn btn-info">Detail</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include_once 'app/views/shareuser/footer.php'; ?>
