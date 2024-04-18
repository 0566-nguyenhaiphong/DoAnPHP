<!-- app/views/voucher/edit.php -->

<?php include_once 'app/views/share/header.php'; ?>

<section class="edit-voucher">
    <div class="container">
        <h1>Edit Voucher</h1>
        <form action="/chieu2/voucher/update" method="post">
        <input type="hidden" name="id" value="<?= $voucher['id'] ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $voucher['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" class="form-control" value="<?php echo $voucher['description']; ?>" required>
            </div>
            <div class="form-group">
                <label for="value">Value:</label>
                <input type="number" id="value" name="value" class="form-control" value="<?php echo $voucher['value']; ?>" required>
            </div>
            <!-- Add more fields if needed -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</section>

<?php include_once 'app/views/share/footer.php'; ?>
