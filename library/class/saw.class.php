<?php

class SAW
{
    public function rank(array $arr_bobot, array $matriks, array $search_max) {
        $list = [];
        foreach($matriks['rows'] as $key => $value) {  
            $total_point = ($value['kriteria_penghasilan'])+($value['kriteria_tanggungan'])+($value['kriteria_jenis_rumah']);
            $total_nilai = round(
                (($value['kriteria_penghasilan'] / $search_max['rows']['max_k1']) * $arr_bobot['kriteria_1']) +
                (($value['kriteria_tanggungan'] / $search_max['rows']['max_k2']) * $arr_bobot['kriteria_2']) +
                (($value['kriteria_jenis_rumah'] / $search_max['rows']['max_k3']) * $arr_bobot['kriteria_3']),
            3);
            
            $keterangan = '';
            if ($total_nilai >= 0.8) {
                $keterangan = 'Sangat Layak';
            } else if ($total_nilai >= 0.6) {
                $keterangan = 'Layak';
            } else if ($total_nilai >= 0.4) {
                $keterangan = 'Cukup Layak';
            } else if ($total_nilai >= 0.2) {
                $keterangan = 'Kurang Layak';
            } else {
                $keterangan = 'Tidak Layak';
            }
            $list[] = [
                'nik' => $value['nik'],
                'nama' => $value['nama'],
                'total_point' => $total_point,
                'total_nilai' => $total_nilai,
                'keterangan' => $keterangan
            ];
        }
        return $list;
    }

    public function point(...$data) 
    {
        $total = 0;
        foreach($data as $key => $value) {
            $total += $value;
        }
        return $total;
    }
}