<?php 
require_once 'model.php';
$controller = new JenisProduk_controller();

if (isset($_POST['addBtnSubmit'])) {
    $controller->add_jenis_produk($_POST);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $jenis_produk = $controller->get_jenis_produk_by_id($id);
}

if (isset($_POST['editBtnSubmit'])) {
    $id = $_POST['id'];
    $controller->edit_jenis_produk($id, $_POST);
}

if (isset($_POST['hapus_jenis_produk'])) {
    $id = $_POST['id'];
    $controller->hapus_jenis_produk($id);
}

class JenisProduk_controller{
    private $model;

    public function __construct()
    {
        $this->model = new JenisProduk_model();
    }

    public function get_jenis_produk()
    {
        return $this->model->get_jenis_produk();
    }
    public function get_jenis_produk_by_id($id)
    {
        return $this->model->get_jenis_produk_by_id($id);
    }
    public function add_jenis_produk($data)
    {
        $nama = $data['nama'];

        $this->model->add_jenis_produk($nama);
        header('Location: index.php');
    }
    public function edit_jenis_produk($id, $data)
    {
        $nama = $data['nama'];

        $this->model->edit_jenis_produk($id, $nama);
        header('Location: index.php');
    }

    public function hapus_jenis_produk($id)
    {
        $this->model->hapus_jenis_produk($id);
        header('Location: index.php');
    }
}
?>