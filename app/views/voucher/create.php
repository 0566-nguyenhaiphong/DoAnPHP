<!-- app/views/voucher/create.php -->

<?php include_once 'app/views/share/header.php'; ?>

<section class="create-voucher">
    <div class="container">
        <h1>Create New Voucher</h1>
        <form action="store" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="value">Value:</label>
                <input type="number" id="value" name="value" class="form-control" required>
            </div>
            <!-- Add more fields if needed -->
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</section>

<?php include_once 'app/views/share/footer.php'; ?>
