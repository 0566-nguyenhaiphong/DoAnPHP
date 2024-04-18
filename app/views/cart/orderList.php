<?php include_once 'app/views/share/header.php'; ?>

<h2>Order List</h2>

<?php if (empty($orders)): ?>
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
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['customer_name']; ?></td>
                    <td><?php echo $order['phone']; ?></td>
                    <td>
                        <form action="/chieu2/cart/updateStatus/<?php echo $order['id']; ?>" method="post">
                            <select name="status" style="width: 180px;">
                                <option value="1" <?php if ($order['status'] == 1) echo 'selected'; ?>>Đơn chờ xử lí</option>
                                <option value="2" <?php if ($order['status'] == 2) echo 'selected'; ?>>Đã xác nhận</option>
                                <option value="3" <?php if ($order['status'] == 3) echo 'selected'; ?>>Đang giao hàng</option>
                                <option value="4" <?php if ($order['status'] == 4) echo 'selected'; ?>>Đã nhận hàng</option>
                            </select>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </td>
                    <td><?php echo $order['note']; ?></td>
                    <td><?php echo $order['total_amount']; ?></td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($order['created_at'])); ?></td>
                    <td><a href="/chieu2/cart/orderDetail/<?php echo $order['id']; ?>" class="btn btn-info">Detail</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include_once 'app/views/share/footer.php'; ?>
