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
    <div class="col-md-12">
        <a href="<?= base_url('/warga/tambah') ?>" class="btn btn-md btn-primary mb-3">Tambah</a>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title text-white"><i class="mdi mdi-account-multiple-outline"></i> Data Warga</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-nowrap">
                        <thead>
                            <tr class="">
                                <th width="20" scope="col" class="text-white">#</th>
                                <th width="150" scope="col" class="text-white">NIK</th>
                                <th width="350" scope="col" class="text-white">NAMA WARGA</th>
                                <th width="300" scope="col" class="text-white">ALAMAT</th>
                                <th width="250" colspan="2" scope="col" class="text-white text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                $tables = $db->query([
                                    'select' => '*',
                                    'table' => 'warga'
                                ]);
                            ?>
                            <?php 
                                if ($tables['count'] == 0){ 
                            ?>
                            <tr>
                                <td colspan="5" class="text-center">Data masih kosong...</td>
                            </tr>
                            <?php } ?>
                            <?php 
                            $no = 1;
                            foreach($tables['rows'] as $key => $value) {  
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['nik'] ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['alamat'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('/warga/edit?id=' . $value['id']) ?>"
                                        class="btn btn-md btn-warning mb-1 text-decoration-none">Edit</a>
                                    <a href="<?= base_url('/warga/index?action=delete&id=' . $value['id']) ?>"
                                        onclick="return confirm('Apakah anda yakin akan menghapus data dari <?= $data['nama'] ?>?')"
                                        class="btn btn-md btn-danger mb-1 text-decoration-none">Hapus</a>
                                </td>
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