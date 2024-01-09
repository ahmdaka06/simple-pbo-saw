<?php
require_once 'init.php';
set_page('Dashboard');
include 'layouts/primary.php';

$warga = $db->query([
    'select' => 'COUNT(*) as total',
    'table' => 'warga',
    'first' => true
]);
?>
<div class="row justify-content-center">
    <!-- <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-start">
                <h5 class="fw-bold"><i class="mdi mdi-account-multiple"></i> <span>Total Warga Terdata</span></h5>
            </div>

            <h3 class="card-title text-nowrap mb-1 text-end"><?= $warga['rows']['total'] ?> </h3>
          </div>
        </div>
    </div> -->
  <div class="col-md-12">
    <div class="card shadow">
      <div class="card-header bg-primary py-3">
        <h5 class="card-title text-white">Simple Pendukung Keputusan </h5>
      </div>
      <div class="card-body">
        <p>
          Sistem Pendukung Keputusan (SPK) penerima bantuan  ini dibuat untuk membantu pemerintah dalam menentukan calon penerima bantuan. Sistem ini menggunakan metode SAW (Simple Additive Weighting) untuk menentukan calon penerima bantuan. Metode SAW merupakan salah satu metode yang digunakan untuk mencari alternatif terbaik dari sejumlah alternatif yang ada berdasarkan sejumlah kriteria yang telah ditentukan. Metode ini menggunakan konsep penjumlahan berbobot pada setiap atribut atau kriteria dari setiap alternatif.
        </p>
      </div>
    </div>
  </div>
</div>
<?php include 'layouts/footer.php'; ?>