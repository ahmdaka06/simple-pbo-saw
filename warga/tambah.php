<?php
require_once '../init.php';
if(user() == false) exit(redirect(base_url('/auth/logout')));
set_page('Tambah Mahasiwa');
include '../layouts/primary.php';
include '../apps/warga/tambah.php';
?>
<div class="p-2 mb-4 rounded-3">
    <div class="container-fluid">
        <h2 class="display-5 fw-bold fs-4 mt-4">Tambah Data Warga</h2>
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
                                    <input type="number" class="form-control" name="nik" placeholder="NIK" required>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="">NAMA</label>
                                    <input type="text" class="form-control" name="nama" placeholder="NAMA" required>
                                </div>
                                <div class="form-group col-md-12 mt-2">
                                    <label for="">ALAMAT</label>
                                    <textarea name="alamat" class="form-control" cols="5" rows="5" placeholder="ALAMAT" required></textarea>
                                </div>
                                <div class="form-group col-md-4 mt-2">
                                    <label for="">NO TELEPON</label>
                                    <input type="number" class="form-control" name="no_telepon" placeholder="NO TELEPON" required>
                                </div>
                                <div class="form-group col-md-4 mt-2">
                                    <label for="">Jenis Kelamin</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="pria"
                                            id="pria" required>
                                        <label class="form-check-label" for="pria">
                                        Pria
                                        </label>
                                    </div>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="wanita" id="wanita" required>
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
                                            <option value="<?= $value ?>"><?= strtoupper($value) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="">PILIH PEKERJAAN</label>
                                    <select name="pekerjaan" class="form-control" required>
                                        <option value=""> - Pilih Salah Satu - </option>
                                        <?php foreach (LIST_PEKERJAAN as $key => $value) { ?>
                                            <option value="<?= $value ?>"><?= strtoupper($value) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="">PENGHASILAN</label>
                                    <select name="penghasilan" class="form-control" required>
                                        <option value=""> - Pilih Salah Satu - </option>
                                        <?php foreach (LIST_PENGHASILAN as $key => $value) { ?>
                                            <option value="<?= $key ?>"><?= strtoupper($value) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="">TANGGUNGAN</label>
                                    <select name="tanggungan" class="form-control" required>
                                        <option value=""> - Pilih Salah Satu - </option>
                                        <?php foreach (LIST_TANGGUNGAN as $key => $value) { ?>
                                            <option value="<?= $key ?>"><?= strtoupper($value) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="">JENIS RUMAH</label>
                                    <select name="jenis_rumah" class="form-control" required>
                                        <option value=""> - Pilih Salah Satu - </option>
                                        <?php foreach (LIST_JENIS_RUMAH as $key => $value) { ?>
                                            <option value="<?= $key ?>"><?= strtoupper($value) ?></option>
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