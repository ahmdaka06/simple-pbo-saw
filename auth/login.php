<?php 
require_once '../init.php';
set_page('Login');
include '../apps/auth/login.php';
include '../layouts/primary.php';
?>
<div class="row justify-content-center" style="margin-top: 5rem;">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <form method="POST">
                    <h1 class="h3 mb-3 fw-normal text-center">Please login</h1>
                    <?= alert() ?>
                    <div class="form-floating mt-2">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>
                    <!-- <p>Belum memiliki akun ?? <a href="<?= base_url('auth/register') ?>" class="mx-auto" style="text-decoration: none;">Register</a></p> -->
                    <div class="text-center my-2">
                        <button class="btn btn-md btn-primary" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../layouts/footer.php'; ?>