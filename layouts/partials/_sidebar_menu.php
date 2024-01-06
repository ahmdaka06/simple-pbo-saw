<ul class="menu-inner py-1 d-none-print">
    <?php 
    if (getenv('INSTALLED') == 'true') { 
    ?>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu Utama</span></li>
        <?php 
            if (user()) { 
        ?>
            <li class="menu-item">
                <a href="<?= $config['base']['url'] ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                    <div data-i18n="Basic">Dashboard</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= $config['base']['url'] ?>/warga" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-account-multiple-outline"></i>
                    <div data-i18n="Basic">Warga</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= $config['base']['url'] ?>/warga/data-penerima" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-account-multiple-outline"></i>
                    <div data-i18n="Basic">Warga Penerima Bantuan</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= $config['base']['url'] ?>/warga/normalisasi" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-chart-arc mdi-spin"></i>
                    <div data-i18n="Basic">Normalisasi</div>
                </a>
            </li>
            <?php } else  { ?>
            <li class="menu-item">
                <a href="<?= $config['base']['url'] ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Basic">Halaman Utama</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="<?= $config['base']['url'] ?>/auth/login" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                    <div data-i18n="Basic">Login</div>
                </a>
            </li>
            <!-- <li class="menu-item">
                <a href="<?= $config['base']['url'] ?>/auth/register" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                    <div data-i18n="Basic">Register</div>
                </a>
            </li> -->
        <?php } ?>
    <?php } ?>
</ul>
