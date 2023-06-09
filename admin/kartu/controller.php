<?php
require_once 'model.php';

$controller = new Kartu_controller();
// cek apakah form tambah kartu telah disubmit
if (isset($_POST['addBtnSubmit'])) {
    // panggil method pada controller untuk menyimpan data kartu yang dikirim dari form
    $controller->add_kartu($_POST);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $kartu = $controller->get_kartu_by_id($id);
}

if (isset($_POST['editBtnSubmit'])) {
    $id = $_POST['id'];
    $controller->edit_kartu($id, $_POST);
}

if (isset($_POST['hapus_kartu'])) {
    $id = $_POST['id'];
    $controller->hapus_kartu($id);
}

class Kartu_controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Kartu_model();
    }

    public function get_kartu()
    {
        return $this->model->get_kartu();
    }

    public function get_kartu_by_id($id)
    {
        return $this->model->get_kartu_by_id($id);
    }

    public function add_kartu($data)
    {
        $kode = $data['kode'];
        $nama = $data['nama'];
        $diskon = $data['diskon'];
        $iuran = $data['iuran'];

        $this->model->add_kartu($kode, $nama, $diskon, $iuran);
        header('Location: index.php');
    }

    public function edit_kartu($id, $data)
    {
        $kode = $data['kode'];
        $nama = $data['nama'];
        $diskon = $data['diskon'];
        $iuran = $data['iuran'];
        
        $this->model->edit_kartu($id, $kode, $nama, $diskon, $iuran);
        header('Location: index.php');
    }

    public function hapus_kartu($id)
    {
        $this->model->hapus_kartu($id);
        header('Location: index.php');
    }
}
