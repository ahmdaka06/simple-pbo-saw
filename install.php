<?php
date_default_timezone_set('Asia/Jakarta');
require_once 'config.php';

include 'layouts/primary.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <?php if (getenv('INSTALLED') AND getenv('INSTALLED') == 'true'){ ?>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>Aplikasi sudah di install</p>
                    <hr>
                    <p class="mb-0">Jika ingin install ulang ubah value isi .env dengan isi .env.example</p>
                </div>
                <?php } else { ?>
                <?php
                    $_SESSION['install'] = 0;
                ?>
                <?php if ($_POST) { ?>
                <pre>
                            <?php
                            try {
                                $app_name = $_POST['app_name'];
                                $app_short_name = $_POST['app_short_name'];
                                $app_description = $_POST['app_description'];

                                $db_name = $_POST['db_name'];
                                $db_host = $_POST['db_host'];
                                $db_username = $_POST['db_username'];
                                $db_password = $_POST['db_password'] ?? '';
                                
                                $username = $_POST['username'];
                                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                                $datetime = date('Y-m-d H:i:s');

                                $mysqli = new mysqli($db_host, $db_username, $db_password);

                                $query = "CREATE DATABASE IF NOT EXISTS " . $db_name;
                                $mysqli->query($query);
                                if ($mysqli->error) {
                                    throw new Exception($mysqli->error);
                                } else {
                                    print "<li>Database " . $db_name ." berhasil di buat / sudah tersedia</li>";
                                }

                                // Pilih database
                                $mysqli->select_db($db_name);

                                if ($mysqli->error) {
                                    throw new Exception($mysqli->error);
                                } else {
                                    print "<li>Database " .$db_name. " berhasil di pilih</li>";
                                }

                                // Temporary variable, used to store current query
                                $templine = '';
                                // Read in entire file
                                $lines = file('simple_saw.sql');
                                // Loop through each line
                                foreach ($lines as $line) {
                                // Skip it if it's a comment
                                    if (substr($line, 0, 2) == '--' || $line == '') continue;
                                    
                                    // Add this line to the current segment
                                    $templine .= $line;
                                    // If it has a semicolon at the end, it's the end of the query
                                    if (substr(trim($line), -1, 1) == ';') {
                                        // Perform the query
                                        $mysqli->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                                        // Reset temp variable to empty
                                        $templine = '';
                                    }
                                }
                                // $config['installed'] = true;
                                // $config['db']['host'] = $db_host;
                                // $config['db']['name'] = $db_name;
                                // $config['db']['username'] = $db_username;
                                // $config['db']['password'] = $db_password;

                                $_SESSION['install'] = 1;

                                $pathENV = __DIR__ . '/.env';
                                if (file_exists($pathENV)) {
                                    file_put_contents($pathENV, str_replace('INSTALLED=' . getenv('INSTALLED'), 'INSTALLED=true', file_get_contents($pathENV)));
                                    file_put_contents($pathENV, str_replace('DB_HOST=' . getenv('DB_HOST'), 'DB_HOST=' . $db_host, file_get_contents($pathENV)));
                                    file_put_contents($pathENV, str_replace('DB_DATABASE=' . getenv('DB_DATABASE'), 'DB_DATABASE=' . $db_name, file_get_contents($pathENV)));
                                    file_put_contents($pathENV, str_replace('DB_USERNAME=' . getenv('DB_USERNAME'), 'DB_USERNAME=' . $db_username, file_get_contents($pathENV)));
                                    file_put_contents($pathENV, str_replace('DB_PASSWORD=' . getenv('DB_PASSWORD'), 'DB_PASSWORD=' . $db_password, file_get_contents($pathENV)));

                                    file_put_contents($pathENV, str_replace('APP_NAME="' . getenv('APP_NAME') . '"', 'APP_NAME="' . $app_name .'"', file_get_contents($pathENV)));
                                    file_put_contents($pathENV, str_replace('APP_SHORT_NAME="' . getenv('APP_SHORT_NAME') . '"', 'APP_SHORT_NAME="' . $app_short_name . '"', file_get_contents($pathENV)));
                                    file_put_contents($pathENV, str_replace('APP_DESCRIPTION="' . getenv('APP_DESCRIPTION') . '"', 'APP_DESCRIPTION="' . $app_description . '"', file_get_contents($pathENV)));
                                }

                                print "Table berhasil di import <br />";

                                $mysqli->query("INSERT INTO `admin` (`name`, `username`, `password`, `created_at`, `updated_at`) VALUES ('Administrator', '$username', '$password', '$datetime', NULL)");

                                print "<b>Data Login</b> <br />";

                                print "Username : $username <br />";
                                print "Password : " . $_POST['password'] ." <br />";

                                print "Aplikasi berhasil di install silahkan klik <a href='auth/login'>disini</a> untuk login";


                            } catch (\Throwable $e) {
                                print $e->getMessage();
                            }
                            ?>
                            </pre>
                <?php } ?>
                <?php if (isset($_SESSION['install']) AND $_SESSION['install'] == 0) { ?>
                <form method="POST">
                    <div class="row">
                        <h4 class="text-center"> KONFIGURASI UTAMA </h4>
                        <div class="form-group col-md-12 my-2">
                            <label for="">NAMA APLIKASI</label>
                            <input type="text" name="app_name" class="form-control" required value="SIMPLE SAW">
                        </div>
                        <div class="form-group col-md-12 my-2">
                            <label for="">NAMA PENDEK APLIKASI</label>
                            <input type="text" name="app_short_name" class="form-control" required value="SPKPB">
                        </div>
                        <div class="form-group col-md-12 my-2">
                            <label for="">DESKRIPSI APLIKASI</label>
                            <textarea name="app_description" id="app_description" cols="30" rows="10"
                                class="form-control">SIMPLE SAW</textarea>
                        </div>
                        <h4 class="text-center"> DATABASE </h4>
                        <div class="form-group col-md-12 my-2">
                            <label for="">Hostname</label>
                            <input type="text" name="db_host" class="form-control" required value="localhost">
                        </div>
                        <div class="form-group col-md-12 my-2">
                            <label for="">Username</label>
                            <input type="text" name="db_username" class="form-control" required value="root">
                        </div>
                        <div class="form-group col-md-12 my-2">
                            <label for="">Password</label>
                            <input type="password" name="db_password" class="form-control" value="">
                        </div>
                        <div class="form-group col-md-12 my-2">
                            <label for="">Database</label>
                            <input type="text" name="db_name" class="form-control" required
                                value="simple_saw">
                        </div>

                        <h4 class="text-center"> ADMIN </h4>
                        <div class="form-group col-md-12 my-2">
                            <label for="">Username Admin</label>
                            <input type="text" name="username" class="form-control" required value="admin">
                        </div>
                        <div class="form-group col-md-12 my-2">
                            <label for="">Password Admin</label>
                            <input type="password" name="password" class="form-control" value="">
                        </div>

                        <div class="form-group col-md-12 my-2">
                            <button class="btn btn-success" type="submit"> Submit</button>
                        </div>
                    </div>
                </form>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include 'layouts/footer.php'; ?>