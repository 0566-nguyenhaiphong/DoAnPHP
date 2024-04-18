<?php include_once 'app/views/shareuser/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card" style="margin-top:150px">
                <div class="card-body">
                    <h2 class="text-center mb-4" >User Profile</h2>
                    <div class="profile-info">
                        <p><strong>Username:</strong> <?php echo $_SESSION['username']; ?></p>
                        <p><strong>Full Name:</strong> <?php echo $user->name; ?></p>
                        <p><strong>Phone:</strong> <?php echo $phone; ?></p>
                        <p><strong>Address:</strong> <?php echo $address; ?></p>
                    </div>
                    <div class="text-center mt-4">
                        <a href="/chieu2/account/editProfile" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'app/views/shareuser/footer.php'; ?>
