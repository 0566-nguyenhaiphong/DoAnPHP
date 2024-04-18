<!-- Trong view userList.php -->
<?php include_once 'app/views/share/header.php'; ?>

<h2>User List</h2>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1 ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->role ?></td>
                <td>
                    <a href="/chieu2/account/lockUser/<?php echo $user->id; ?>" onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản này?')" class="btn btn-primary"><i class="fas fa-fw fa-lock"></i></a>
                    <a href="/chieu2/account/deleteUser/<?= $user->id ?>" onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></a>
                </td>
            </tr>
            <?php $i++?>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once 'app/views/share/footer.php'; ?>
