<?php
require_once 'init.php';
set_page('Dashboard');
include 'layouts/primary.php';
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="mt-5">Hi, <?= user('name') ?></h1>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-start">
                <h5 class="fw-bold"><i class="mdi mdi-account-multiple"></i> <span>Total Warga Terdata</span></h5>
            </div>

            <h3 class="card-title text-nowrap mb-1 text-end"><?= $warga['rows']['total'] ?> </h3>
          </div>
        </div>
    </div>
</div>
<?php include 'layouts/footer.php'; ?>