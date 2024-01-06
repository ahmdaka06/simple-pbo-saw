<?php

require 'config.php';

include 'layouts/primary.php';
?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <p> Aplikasi belum di install !!. Klik <a href="<?= $config['base']['url'] ?>/install.php">Disini</a> untuk menginstall aplikasi </p>
            </div>
        </div>
    </div>
</div>
<?php include 'layouts/footer.php'; ?>