<?php 
require_once 'model.php';
$controller = new Pesanan_controller();
if (isset($_POST['addBtnSubmit'])) {
    // panggil method pada controller untuk menyimpan data kartu yang dikirim dari form
    $controller->add_pesanan($_POST);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pesanan = $controller->get_pesanan_by_id($id);
}

if (isset($_POST['editBtnSubmit'])) {
    $id = $_POST['id'];
    $controller->edit_pesanan($id, $_POST);
}

if (isset($_POST['hapus_pesanan'])) {
    $id = $_POST['id'];
    $controller->hapus_pesanan($id);
}

class Pesanan_controller{
    private $model;

    public function __construct() {
        $this->model = new Pesanan_model();
    }

    public function get_pesanan()
    {
        return $this->model->get_pesanan();
    }

    public function get_pelanggan() {
        return $this->model->get_pelanggan();
    }

    public function get_pesanan_by_id($id)
    {
        return $this->model->get_pesanan_by_id($id);
    }

    public function add_pesanan($data)
    {
        $tanggal = $data['tanggal'];
        $total = $data['total'];
        $pelanggan_id = $data['pelanggan_id'];

        $this->model->add_pesanan($tanggal, $total, $pelanggan_id);
        header('Location: index.php');
    }

    public function edit_pesanan($id, $data)
    {
        $tanggal = $data['tanggal'];
        $total = $data['total'];
        $pelanggan_id = $data['pelanggan_id'];

        $this->model->edit_pesanan($id, $tanggal, $total, $pelanggan_id);
        header('Location: index.php');
    }

    public function hapus_pesanan($id)
    {
        $cekPelanggan = $this->model->cek_pelanggan($id);

         if ($cekPelanggan) {
            echo "Tidak bisa menghapus pesanan";
        } else {
            $this->model->hapus_pesanan($id);
            header('Location: index.php');
        }
    }
}

?>