<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* buat class hide dan show */
        .hide {
            display: none;
        }
        .show {
            display: block;
        }
    </style>
</head>
<body>
    <div style="margin: 1rem;">
        <!-- buat button 50 dan 100 bilangan primara -->
        <button class="btn-prima-50">
            50 Bilangan Prima
        </button>
    </div>
    <div style="margin: 1rem;">
        <button class="btn-prima-100">
            100 Bilangan Prima
        </button>
    </div>
        
    
    <div style="margin: 1rem;"  class="prima-50 hide">
        <h4> 50 Bilangan prima</h4>
        <div style="margin: 1rem;">
        <?php
            // buat perulangan untuk menampilkan 50 bilangan prima
            for($i=1; $i <= 50; $i++){
                $a = 0;
                for($j=1; $j <= $i; $j++){
                    if($i % $j == 0){
                        $a++;
                    }
                }
                if($a == 2){
                    echo $i.' ';
                }
            }
        ?>
        </div>
    </div>
    <div style="margin: 1rem;"  class="prima-100 hide">
        <h4> 100 Bilangan prima</h4>
        <div style="margin: 1rem;">
        
        <?php
            // buat perulangan untuk menampilkan 100 bilangan prima
            for($i=1; $i <= 100; $i++){
                $a = 0;
                for($j=1; $j <= $i; $j++){
                    if($i % $j == 0){
                        $a++;
                    }
                }
                if($a == 2){
                    echo $i.' ';
                }
            }
        ?>
        </div>
    </div>

    <div style="margin: 1rem;">
            
        <h4> Cek Bilangan Prima</h4>
        <input type="number" id="angka">
        <button onclick="prima()">Cek</button>
    </div>
    <script>
        const btnPrima50 = document.querySelector('.btn-prima-50'); // ambil element button 50 bilangan prima
        const btnPrima100 = document.querySelector('.btn-prima-100'); // ambil element button 100 bilangan prima
        const prima50 = document.querySelector('.prima-50'); // ambil element div 50 bilangan prima
        const prima100 = document.querySelector('.prima-100'); // ambil element div 100 bilangan prima

        btnPrima50.addEventListener('click', function(){ // tambahkan event click pada button 50 bilangan prima
            prima50.classList.toggle('hide'); // tambahkan class hide pada div 50 bilangan prima
            prima50.classList.toggle('show');  // tambahkan class show pada div 50 bilangan prima
        });

        btnPrima100.addEventListener('click', function(){ // tambahkan event click pada button 100 bilangan prima
            prima100.classList.toggle('hide');  // tambahkan class hide pada div 100 bilangan prima
            prima100.classList.toggle('show'); // tambahkan class show pada div 100 bilangan prima
        });

        function prima() {
            const angka = document.querySelector('#angka').value; // ambil value dari input angka
            if (angka == '' || angka == null) { // cek apakah input angka kosong
                alert('Masukkan angka terlebih dahulu'); // tampilkan alert
            }
            let a = 0; // buat variabel a dengan nilai 0
            for(let i=1; i <= angka; i++){ // buat perulangan untuk mengecek bilangan prima
                if(angka % i == 0){ // cek apakah angka habis dibagi i
                    a++; // jika iya maka tambahkan nilai a
                }
            }
            if(a == 2){ // cek apakah nilai a sama dengan 2
                alert(angka + ' adalah bilangan prima'); // jika iya maka tampilkan alert
            } else { // jika tidak maka tampilkan alert
                alert(angka + ' bukan bilangan prima'); // jika iya maka tampilkan alert
            }
        }
    </script>
</body>
</html>