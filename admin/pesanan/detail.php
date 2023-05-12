<?php
require_once('controller.php');
if (!$pesanan) {
    echo "Pesanan tidak ditemukan.";
    exit;
}

$title = 'Pesanan';
$active = "pesanan";
$href = [
    '../assets/vendor/fonts/boxicons.css',
    '../assets/vendor/css/core.css',
    '../assets/vendor/css/theme-default.css',
    '../assets/css/demo.css',
    '../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
    '../assets/vendor/css/pages/page-auth.css',
];
require('../layouts/header.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <?php
        $href = [
            '../pelanggan/index.php',
            '../pesanan/index.php',
            '../kartu/index.php',
            '../jenis_produk/index.php',
            '../produk/index.php',
        ];
        require('../layouts/aside.php')
        ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">

            <!-- NOTIFIKASI -->
            <?php
            // if (isset($_SESSION['welcome_message'])) {
            //     echo $_SESSION['welcome_message'];
            //     unset($_SESSION['welcome_message']);
            // }
            ?>
            <!-- NOTIFIKASI -->

            <!-- NAVBAR -->
            <?php require('../layouts/nav.php') ?>
            <!-- NAVBAR -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-12 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-12">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary ms-2">Detail Pesanan</h5>
                                            <form action="controller.php" method="POST">
                                                <div class="p-2">
                                                <input type="hidden" name="id" value="<?= $pesanan['id'] ?>">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="tanggal" class="form-label">Tanggal</label>
                                                            <input type="date" id="tanggal" class="form-control" name="tanggal" value="<?= $pesanan['tanggal'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="total" class="form-label">Total (Rp)</label>
                                                            <input type="number" id="total" class="form-control" name="total" value="<?= $pesanan['total'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="pelanggan_id" class="form-label">Pilih Nama Pelanggan</label>
                                                            <select id="pelanggan_id" class="form-select" name="pelanggan_id">
                                                                <?php
                                                                $data_pelanggan = $controller->get_pelanggan();

                                                                foreach ($data_pelanggan as $pelanggan) : ?>
                                                                    <option value="<?= $pelanggan['id'] ?>" <?= $pelanggan['id'] == $pesanan['pelanggan_id'] ? 'selected' : '' ?> ><?= $pelanggan['nama_pelanggan'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary" id="btnSubmit" name="editBtnSubmit">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">


                    </div>

                </div>
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made with ❤️ by
                            <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                        </div>
                        <div>
                            <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                            <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                            <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>
</div>

<?php
$src = [
    '../assets/vendor/libs/jquery/jquery.js',
    '../assets/vendor/libs/popper/popper.js',
    '../assets/vendor/js/bootstrap.js',
    '../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
    '../assets/vendor/js/menu.js',
    '../assets/js/main.js',
    '../assets/vendor/js/jquery.dataTables.min.js',
    '../assets/vendor/js/dataTables.bootstrap5.min.js',
    'https://buttons.github.io/buttons.js',
    '../assets/vendor/js/helpers.js',
    '../assets/js/config.js',
];

$script = "";

require('../layouts/footer.php')
?>