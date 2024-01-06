<?php
require_once '../init.php';
if(user() == false) exit(redirect(base_url('/auth/logout')));
set_page('Normalisasi');
include '../layouts/primary.php';
// query 
# 1. Ambil nilai max dari setiap kriteria
# 2. Hitung nilai normalisasi
# 3. Hitung nilai bobot
# 4. Hitung nilai akhir
$search_max = $db->query([
    'select' => 'MAX(matrik.kriteria_penghasilan) AS max_k1, MAX(matrik.kriteria_tanggungan) AS max_k2, MAX(matrik.kriteria_jenis_rumah) AS max_k3',
    'table' => 'matrik',
    'first' => true
]);
$matriks = $db->query([
    'select' => 'warga.nama, matrik.*',
    'table' => 'matrik',
    // 'order_by' => 'matrik.nik asc'
    'join' => 'LEFT JOIN warga ON matrik.nik=warga.nik',
    'group_by' => 'matrik.nik',
]);
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
                                <th width="300" scope="col" class="text-white">TOTAL POINT</th>
                                <th width="300" scope="col" class="text-white">TOTAL NILAI</th>
                                <th width="300" scope="col" class="text-white">KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                // Buat array bobot C1 = 40%, C2 = 25%, C3 = 30%
                                $array_bobot = NILAI_BOBOT;

                            ?>
                            <?php 
                                if ($matriks['count'] == 0){ 
                            ?>
                            <tr>
                                <td colspan="6" class="text-center">Data masih kosong...</td>
                            </tr>
                            <?php } ?>
                            <?php 
                            require_once '../library/class/saw.class.php';
                            $saw = new SAW();
                            $data = $saw->nilai($array_bobot, $matriks, $search_max);
                            $no = 1;
                            array_multisort(array_column($data, 'total_nilai'), SORT_DESC, $data);
                            foreach($data as $key => $value) {  
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['total_point'] ?></td>
                                <td><?= $value['total_nilai'] ?></td>
                                <td><?= $value['keterangan'] ?></td>
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