<?php
require_once '../init.php';
if(user() == false) exit(redirect(base_url('/auth/logout')));
set_page('Dashboard');
include '../layouts/primary.php';
include '../apps/warga/import.php';
if (get('action') AND get('action') == 'delete') {
    if (get('id') AND is_numeric(get('id'))) {
        $query_warga = $db->query([
            'select' => '*',
            'table' => 'warga',
            'where' => 'id = "' . escape(get('id')) .'"',
            'first' => true
        ]);
        if ($query_warga['count'] == 0) { // cek apakah data tersedia
            flashdata(['alert' => 'danger', 'title' => 'Gagal !', 'msg' => 'Data warga tidak di temukan!.']);
            exit(redirect(base_url('warga')));
        }
        if ($db->deleteById('warga', escape(get('id')))) {
            flashdata(['alert' => 'success', 'title' => 'Berhasil !', 'msg' => 'Berhasil menghapus data warga ' . $query_warga['rows']['nama'] . '!.']);
            exit(redirect(base_url('warga')));
        } else {
            flashdata(['alert' => 'danger', 'title' => 'Gagal !', 'msg' => 'Gagal menghapus data warga!.']);
        }
    }
}
?>
<div class="row">
    <div class="row ">
        <div class="col-md-12">
            <?= alert() ?>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-12">
        <h3 class="text-center"> Daftar Nama Calon Penerima Raskin </h3>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <!-- <div class="card-header bg-primary py-3">
                <h5 class="card-title text-white"><i class="mdi mdi-account-multiple-outline"></i> Data Warga</h5>
            </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr class="">
                                <th width="20" scope="col" class="text-white">#</th>
                                <th width="150" scope="col" class="text-white">NIK</th>
                                <th width="350" scope="col" class="text-white">NAMA WARGA</th>
                                <th width="300" scope="col" class="text-white">BOBOT PENGHASILAN</th>
                                <th width="300" scope="col" class="text-white">BOBOT TANGGUNGAN</th>
                                <th width="300" scope="col" class="text-white">BOBOT JENIS RUMAH</th>
                                <th width="300" scope="col" class="text-white">TOTAL POIN</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                $tables = $db->query([
                                    'select' => 'warga.*, matrik.kriteria_tanggungan, matrik.kriteria_penghasilan, matrik.kriteria_jenis_rumah',
                                    'where' => 'matrik.nik=warga.nik',
                                    'table' => 'warga, matrik',
                                    'order_by' => 'matrik.nik asc'
                                ]);
                            ?>
                            <?php 
                                if ($tables['count'] == 0){ 
                            ?>
                            <tr>
                                <td colspan="8" class="text-center">Data masih kosong...</td>
                            </tr>
                            <?php } ?>
                            <?php 
                            $no = 1;
                            require_once '../library/class/saw.class.php';
                            $sawClass = new SAW();
                            foreach($tables['rows'] as $key => $value) {  
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['kriteria_tanggungan'] ?></td>
                                <td><?= $value['kriteria_penghasilan'] ?></td>
                                <td><?= $value['kriteria_jenis_rumah'] ?></td>
                                <!-- <td><?= $value['kriteria_tanggungan'] + $value['kriteria_penghasilan'] + $value['kriteria_jenis_rumah'] ?></td> -->
                                <td><?= $sawClass->point($value['kriteria_tanggungan'], $value['kriteria_penghasilan'], $value['kriteria_jenis_rumah']) ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../layouts/footer.php'; ?>