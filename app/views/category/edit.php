<?php include_once 'app/views/share/header.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <h1>Edit Category</h1>
        <form method="post" action="/chieu2/category/update">
            <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $category['name'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php include_once 'app/views/share/footer.php'; ?>
