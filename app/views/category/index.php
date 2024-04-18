<?php
include_once 'app/views/share/header.php';
?>

<div class="row">
    <a href="/chieu2/category/create" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-flag"></i>
        </span>
        <span class="text">Add Category</span>
    </a>

    <div class="col-sm-12">
        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <!-- <th>Description</th> -->
                    <th>Action (Edit/Delete)</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $categories->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <!-- <td><?= $row['description'] ?></td> -->
                        <td>
                            <a href="/chieu2/category/edit/<?=$row['id']?>" class="btn btn-info">
                                Edit
                            </a>
                            <button class="delete-btn-category btn btn-danger" data-id="<?=$row['id']?>" data-type="category">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>


<?php
include_once 'app/views/share/footer.php';
?>

