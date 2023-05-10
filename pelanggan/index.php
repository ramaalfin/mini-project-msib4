<?php

require_once('controller.php');
$controller = new Pelanggan_controller();
$data_pelanggan = $controller->get_pelanggan();

$title = 'Pelanggan';
$active = "pelanggan";
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
    .table > :not(:first-child) {
        border-top: unset;
    }
</style>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <?php
        $href = [
            '../pelanggan/index.php',
            '../pesanan/index.php',
            '../kartu/index.php',
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
                                            <a href="tambah.php" class="btn btn-primary mb-4">Tambah</a>
                                            <table id="example" class="table table-striped text-nowrap mt-2" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Tempat Lahir</th>
                                                        <th>Tanggal Lahir</th>
                                                        <th>Email</th>
                                                        <th>Kartu</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php foreach ($data_pelanggan as $row) : ?>
                                                        <tr>
                                                            <td>
                                                                <a href="detail.php?id=<?= $row['id'] ?>"><?= $row['kode'] ?></a>
                                                            </td>
                                                            <td><?= $row['nama_pelanggan'] ?></td>
                                                            <td><?= $row['jk'] ?></td>
                                                            <td><?= $row['tmp_lahir'] ?></td>
                                                            <td><?= $row['tgl_lahir'] ?></td>
                                                            <td><?= $row['email'] ?></td>
                                                            <td><?= $row['kartu'] ?></td>
                                                            <td>
                                                                <button type="button" class="dropdown-item w-auto p-1 btn-delete" data-id="<?= $row['id'] ?>">
                                                                    <i class="bx bx-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
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

<!-- modal delete -->
<div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Hapus Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Apakah Kamu yakin ingin menghapus pelanggan ini?</h5>
            </div>
            <div class="modal-footer">
                <form action="controller.php" method="post">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <input type="hidden" name="id" id="pelanggan-id">
                    <button type="submit" class="btn btn-primary" name="hapus_pelanggan">Save changes</button>
                </form>
            </div>
        </div>
    </div>
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