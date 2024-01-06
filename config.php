<?php
require_once 'vendor/autoload.php';
$_env_repository = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(Dotenv\Repository\Adapter\EnvConstAdapter::class)
    ->addWriter(Dotenv\Repository\Adapter\PutenvAdapter::class)
    ->immutable()
    ->make();



$dotenv = Dotenv\Dotenv::create($_env_repository, __DIR__);
$dotenv->load();

$_ENV['production'] = false; // true or false;
date_default_timezone_set('Asia/Jakarta');

if(!isset($_SESSION)) session_start(); // init session

$config['base'] = [
    'app' => [
        'name' => getenv('APP_NAME', 'SISTEM PENDUKUNG KEPUTUSAN PENERIMA BANTUAN'),
        'short_name' => getenv('APP_SHORT_NAME', 'SPKPB'),
        'description' => getenv('APP_DESCRIPTION')
    ],
    'url' => 'http://localhost/simple-pbo-saw'
];

$config['db'] = [
    'host' => getenv('DB_HOST'),
	'name' => getenv('DB_DATABASE'),
	'username' => getenv('DB_USERNAME'),
	'password' => getenv('DB_PASSWORD')
];

CONST LIST_PENGHASILAN = [
    20 => 'Rp 2.000.000 - Rp 2.500.000',
    40 => 'Rp 1.500.000 - Rp 2.000.000',
    60 => 'Rp 1000.000 - Rp 1.500.000',
    80 => 'Rp 500.000 - Rp 1.000.000',
    100 => 'Kurang dari Rp 500.000'
];

CONST LIST_TANGGUNGAN = [
    20 => '1 orang',
    40 => '2 orang',
    60 => '3 orang',
    80 => '4 orang',
    100 => 'Lebih dari 5 orang'
];

CONST LIST_JENIS_RUMAH = [
    20 => 'LANTAI UBIN DAN DINDING BATA',
    40 => 'LANTAI SEMEN DAN DINDING BATA',
    60 => 'LANTAI SEMEN DAN DINDING BAMBU',
    80 => 'LANTAI TANAH DAN DINDING BAMBU',
    100 => 'LANTAI TANAH DAN DINDING KAYU'
];

CONST LIST_PEKERJAAN = [
    'PETANI',
    'BURUH TANI',
    'BURUH BANGUNAN',
    'BURUH PABRIK',
    'BURUH MIGRAN',
    'PEDAGANG',
    'TUKANG BECAK',
    'TUKANG OJEK',
    'TUKANG PARKIR',
    'TUKANG JAHIT',
    'TUKANG LISTRIK',
    'TUKANG KAYU',
    'TUKANG BANGUNAN',
    'IBU RUMAH TANGGA',
    'SUPIR MOBIL',
    'PENGANGGURAN',
    'PENSIUNAN',
];

CONST LIST_AGAMA = [
    'islam','kristen','katholik','hindu','buddha','khonghucu'
];

CONST NILAI_BOBOT = [
    'kriteria_1' => 0.4,
    'kriteria_2' => 0.25, 
    'kriteria_3' => 0.35
];


require_once 'library/helper/global.helper.php';
require_once 'library/helper/form.helper.php';
require_once 'library/helper/session.helper.php';
