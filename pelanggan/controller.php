<?php 
require_once 'model.php';
$controller = new Pelanggan_controller();
if (isset($_POST['addBtnSubmit'])) {
    // panggil method pada controller untuk menyimpan data kartu yang dikirim dari form
    $controller->add_pelanggan($_POST);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pelanggan = $controller->get_pelanggan_by_id($id);
}

if (isset($_POST['hapus_pelanggan'])) {
    $id = $_POST['id'];
    $controller->hapus_pelanggan($id);
}

class Pelanggan_controller{
    private $model;

    public function __construct() {
        $this->model = new Pelanggan_model();
    }

    public function get_pelanggan() {
        return $this->model->get_pelanggan();
    }

    public function get_kartu()
    {
        return $this->model->get_kartu();
    }

    public function get_pelanggan_by_id($id)
    {
        return $this->model->get_pelanggan_by_id($id);
    }

    public function add_pelanggan($data)
    {
        $kode = $data['kode'];
        $nama_pelanggan = $data['nama_pelanggan'];
        $jk = $data['jk'];
        $tmp_lahir = $data['tmp_lahir'];
        $tgl_lahir = $data['tgl_lahir'];
        $email = $data['email'];
        $kartu_id = $data['kartu_id'];

        $this->model->add_pelanggan($kode, $nama_pelanggan, $jk, $tmp_lahir, $tgl_lahir, $email, $kartu_id);
        header('Location: index.php');
    }

    public function hapus_pelanggan($id)
    {
        $this->model->hapus_pelanggan($id);
        header('Location: index.php');
    }
}

?>