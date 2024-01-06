<?php
require_once '../init.php';
if(user() == false) exit(redirect(base_base_url('/auth/logout')));

include '../apps/warga/edit.php';
if (get('id') AND is_numeric(get('id'))) { // cek apakah id tersedia dan id berisi angka atau tidak
    $id = escape(get('id'));
} else { // jika tidak sesuai
    flashdata(['alert' => 'danger', 'title' => 'Gagal !', 'msg' => 'Parameter tidak sesuai!.']);
    exit(redirect(base_url('/warga')));
}
$query_warga = $db->query([
    'select' => '*',
    'table' => 'warga',
    'where' => 'id = "' . $id .'"',
    'first' => true
]);
if ($query_warga['count'] == 0) { // cek apakah data tersedia
    flashdata(['alert' => 'danger', 'title' => 'Gagal !', 'msg' => 'Data mahasiswa tidak di temukan!.']);
    exit(redirect(base_url('mahasiswa')));
}
$data_warga = $query_warga['rows'];
set_page('Edit Warga ' . $data_warga['nama'] );

include '../layouts/primary.php';
?>
<div class="p-2 mb-4 rounded-3">
    <div class="container-fluid">
        <h2 class="display-5 fw-bold fs-4 mt-4">Edit Data Warga <?= $data_warga['nama'] ?></h2>
        <div class="row">
            <div class="col-md-12">
                <a href="<?= base_url('/warga') ?>" class="btn btn-md btn-primary my-3">Kembali</a>
            </div>
            <div class="col-md-12 mb-5">
                <div class="card shadow py-2">
                    <div class="card-body">
                        <hr>
                        <form action="" method="POST" class="mb-5">
                            <?= alert() ?>
                            <div class="row">
                                <div class="form-group col-md-6 mt-2">
                                    <label for="">NIK</label>
                                    <input type="number" class="form-control" name="nik" placeholder="NIK" value="<?= $data_warga['nik'] ?>" required>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="">NAMA</label>
                                    <input type="text" class="form-control" name="nama" placeholder="NAMA" value="<?= $data_warga['nama'] ?>" required>
                                </div>
                                <div class="form-group col-md-12 mt-2">
                                    <label for="">ALAMAT</label>
                                    <textarea name="alamat" class="form-control" cols="5" rows="5" placeholder="ALAMAT" required><?= $data_warga['alamat'] ?></textarea>
                                </div>
                                <div class="form-group col-md-4 mt-2">
                                    <label for="">NO TELEPON</label>
                                    <input type="number" class="form-control" name="no_telepon" placeholder="NO TELEPON" value="<?= $data_warga['no_telepon'] ?>" required>
                                </div>
                                <div class="form-group col-md-4 mt-2">
                                    <label for="">Jenis Kelamin</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="pria" <?= ($data_warga['jenis_kelamin'] == 'pria') ? 'checked' : '' ?> id="pria" required>
                                    <label class="form-check-label" for="pria">
                                       Pria
                                    </label>
                                </div>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="wanita" id="wanita" <?= ($data_warga['jenis_kelamin'] == 'wanita') ? 'checked' : '' ?> required>
                                    <label class="form-check-label" for="wanita">
                                       Wanita
                                    </label>
                                </div>
                                </div>
                                <div class="form-group col-md-4 mt-2">
                                    <label for="">AGAMA</label>
                                    <select name="agama" class="form-control" required>
                                        <option value=""> - Pilih Salah Satu - </option>
                                        <?php foreach (LIST_AGAMA as $key => $value) { ?>
                                            <option value="<?= $value ?>" <?= ($value == $data_warga['agama']) ? 'selected' : '' ?>><?= strtoupper($value) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="">PILIH PEKERJAAN</label>
                                    <select name="pekerjaan" class="form-control" required>
                                        <option value=""> - Pilih Salah Satu - </option>
                                        <?php foreach (LIST_PEKERJAAN as $key => $value) { ?>
                                            <option value="<?= $value ?>" <?= ($value == $data_warga['pekerjaan']) ? 'selected' : '' ?>><?= strtoupper($value) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="">PENGHASILAN</label>
                                    <select name="penghasilan" class="form-control" required>
                                        <option value=""> - Pilih Salah Satu - </option>
                                        <?php foreach (LIST_PENGHASILAN as $key => $value) { ?>
                                            <option value="<?= $key ?>" <?= ($value == $data_warga['penghasilan']) ? 'selected' : '' ?>><?= strtoupper($value) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="">TANGGUNGAN</label>
                                    <select name="tanggungan" class="form-control" required>
                                        <option value=""> - Pilih Salah Satu - </option>
                                        <?php foreach (LIST_TANGGUNGAN as $key => $value) { ?>
                                            <option value="<?= $key ?>" <?= ($value == $data_warga['tanggungan']) ? 'selected' : '' ?>><?= strtoupper($value) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="">JENIS RUMAH</label>
                                    <select name="jenis_rumah" class="form-control" required>
                                        <option value=""> - Pilih Salah Satu - </option>
                                        <?php foreach (LIST_JENIS_RUMAH as $key => $value) { ?>
                                            <option value="<?= $key ?>" <?= ($value == $data_warga['jenis_rumah']) ? 'selected' : '' ?>><?= strtoupper($value) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12 mt-5 text-center">
                                <button class="btn btn-primary"> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../layouts/footer.php'; ?>