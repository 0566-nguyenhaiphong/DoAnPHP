<?php include_once 'app/views/share/header.php'; ?>

<section class="create-category">
    <div class="container">
        <h1>Create New Category</h1>
        <form action="store" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        <a href="index" class="btn btn-secondary mt-3">Back to List</a>
    </div>
</section>

<?php include_once 'app/views/share/footer.php'; ?>
