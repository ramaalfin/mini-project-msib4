<?php
require_once('controller.php');
$controller = new Produk_controller();

if (!$produk) {
    echo "Produk tidak ditemukan.";
    exit;
}

$title = 'Detail Produk';
$active = "produk";
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

<style>
    #example_filter {
        display: flex;
        justify-content: end;
    }

    .table> :not(:first-child) {
        border-top: unset;
    }
</style>
<?php

if (isset($_SESSION['welcome_message'])) {
    echo $_SESSION['welcome_message'];
    unset($_SESSION['welcome_message']);
}
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
                                            <h5 class="card-title text-primary ms-2">Detail Produk</h5>
                                            <form action="controller.php" method="POST">
                                                <div class="p-2">
                                                    <input type="hidden" name="id" value="<?= $produk['id'] ?>">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="kode" class="form-label">Kode Produk (Maks. 10 karakter)</label>
                                                            <input type="text" id="kode" class="form-control" name="kode" placeholder="..." value="<?= $produk['kode'] ?>"  maxlength="10" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nama" class="form-label">Nama Produk</label>
                                                            <input type="text" id="nama" class="form-control" name="nama" value="<?= $produk['nama'] ?>" placeholder="Nama" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="harga_beli" class="form-label">Harga Beli (Rp)</label>
                                                            <input type="number" id="harga_beli" class="form-control" name="harga_beli" value="<?= $produk['harga_beli'] ?>" placeholder="..." required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="harga_jual" class="form-label">Harga Jual (Rp)</label>
                                                            <input type="number" id="harga_jual" class="form-control" name="harga_jual" value="<?= $produk['harga_jual'] ?>" placeholder="..." required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="stok" class="form-label">Stok</label>
                                                            <input type="number" id="stok" class="form-control" name="stok" value="<?= $produk['stok'] ?>" placeholder="..." required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="min_stok" class="form-label">Minimal Stok</label>
                                                            <input type="number" id="min_stok" class="form-control" name="min_stok" value="<?= $produk['min_stok'] ?>" placeholder="..." required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="jenis_produk_id" class="form-label">Jenis Produk</label>
                                                            <select id="jenis_produk_id" class="form-select" name="jenis_produk_id">
                                                                <?php
                                                                $data_jenis_produk = $controller->get_jenis_produk();

                                                                foreach ($data_jenis_produk as $jenis_produk) : ?>
                                                                    <option value="<?= $jenis_produk['id'] ?>" <?= $jenis_produk['id'] == $produk['jenis_produk_id'] ? 'selected' : '' ?> ><?= $jenis_produk['nama'] ?></option>
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

$script = "
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            paging: true,
            scrollX: true,
        });
    });
</script>

<script>
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const deletePelangganId = document.querySelector('#pelanggan-id');

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const pelangganId = button.getAttribute('data-id');
            deletePelangganId.value = pelangganId;
            $('#modalCenter').modal('show');
        })
    });
</script>
";

require('../layouts/footer.php')
?>