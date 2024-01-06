<?php
if (is_method('post')) {
    $validation = check_input($_POST, [
        'nik', 'nama', 'alamat', 'no_telepon', 'jenis_kelamin', 'agama', 'pekerjaan', 'penghasilan', 'tanggungan', 'jenis_rumah'
    ]);
    if ($validation == false) {
        flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.']);
    } else {
        $input_warga = [
            'nik' => escape(post('nik')), 
            'nama' => escape(post('nama')), 
            'alamat' => escape(post('alamat')), 
            'no_telepon' => escape(post('no_telepon')), 
            'jenis_kelamin' => escape(post('jenis_kelamin')), 
            'agama' => escape(post('agama')),
            'pekerjaan' => escape(post('pekerjaan')),
            'penghasilan' => escape(post('penghasilan')),
            'tanggungan' => escape(post('tanggungan')),
            'jenis_rumah' => escape(post('jenis_rumah')),
        ];
        if (check_empty($input_warga) == true) {
            flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.']);
        } else {
            $check_nik = $db->query([
                'select' => 'id',
                'table' => 'warga',
                'where' => 'nik = "' . $input_warga['nik'] .'"',
                'first' => true
            ]);
            if ($check_nik['count']) {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'NIK telah terdaftar.']);
            } else if (strlen($input_warga['nik']) < 10) {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'NIK minimal 10 digit.']);
            } else if (strlen($input_warga['no_telepon']) < 12) {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'No telepon minimal 12 digit.']);
            } elseif (!in_array($input_warga['jenis_kelamin'], ['pria', 'wanita'])) {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Jenis Kelamin tidak valid.']);
            } elseif (!in_array($input_warga['agama'], LIST_AGAMA)) {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Jenis Kelamin tidak valid.']);
            } elseif (!in_array($input_warga['pekerjaan'], LIST_PEKERJAAN)) {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Pekerjaan tidak valid.']);
            } elseif (!isset(LIST_TANGGUNGAN[$input_warga['tanggungan']])) {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Tanggungan tidak valid.']);
            } elseif (!isset(LIST_PENGHASILAN[$input_warga['penghasilan']])) {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Penghasilan tidak valid.']);
            } elseif (!isset(LIST_JENIS_RUMAH[$input_warga['jenis_rumah']])) {
                flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Jenis Rumah tidak valid.']);
            } else {
                $input_warga['tanggungan'] = LIST_TANGGUNGAN[$input_warga['tanggungan']];
                $input_warga['penghasilan'] = LIST_PENGHASILAN[$input_warga['penghasilan']];
                $input_warga['jenis_rumah'] = LIST_JENIS_RUMAH[$input_warga['jenis_rumah']];
                $insert_warga = $db->insert('warga', $input_warga);

                $input_matrik = [
                    'nik' => $input_warga['nik'],
                    'kriteria_tanggungan' => post('tanggungan'),
                    'kriteria_penghasilan' => post('penghasilan'),
                    'kriteria_jenis_rumah' => post('jenis_rumah'),
                ];

                $insert_matrik = $db->insert('matrik', $input_matrik);
                if ($insert_warga AND $insert_matrik) {
                    flashdata(['alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Warga baru berhasil di tambahkan.']);
                    exit(redirect(base_url('/warga')));
                } else {
                    flashdata(['alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Terjadi kesalahan.']);
                }
            }
        }
    }
}
?>