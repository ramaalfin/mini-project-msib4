<?php 
require_once 'model.php';
$controller = new Produk_controller();
if (isset($_POST['addBtnSubmit'])) {
    $controller->add_produk($_POST);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produk = $controller->get_produk_by_id($id);
}

if (isset($_POST['editBtnSubmit'])) {
    $id = $_POST['id'];
    $controller->edit_produk($id, $_POST);
}

if (isset($_POST['hapus_produk'])) {
    $id = $_POST['id'];
    $controller->hapus_produk($id);
}

class Produk_controller{
    private $model;

    public function __construct() {
        $this->model = new Produk_model();
    }

    public function get_produk() {
        return $this->model->get_produk();
    }

    public function get_jenis_produk()
    {
        return $this->model->get_jenis_produk();
    }

    public function get_produk_by_id($id)
    {
        return $this->model->get_produk_by_id($id);
    }

    public function add_produk($data)
    {
        $kode = $data['kode'];
        $nama = $data['nama'];
        $harga_beli = $data['harga_beli'];
        $harga_jual = $data['harga_jual'];
        $stok = $data['stok'];
        $min_stok = $data['min_stok'];
        $jenis_produk_id = $data['jenis_produk_id'];

        $this->model->add_produk($kode, $nama, $harga_beli, $harga_jual, $stok, $min_stok, $jenis_produk_id);
        header('Location: index.php');
    }

    public function edit_produk($id, $data)
    {
        $kode = $data['kode'];
        $nama = $data['nama'];
        $harga_beli = $data['harga_beli'];
        $harga_jual = $data['harga_jual'];
        $stok = $data['stok'];
        $min_stok = $data['min_stok'];
        $jenis_produk_id = $data['jenis_produk_id'];

        $this->model->edit_produk($id, $kode, $nama, $harga_beli, $harga_jual, $stok, $min_stok, $jenis_produk_id);
        header('Location: index.php');
    }

    public function hapus_produk($id)
    {
        $this->model->hapus_produk($id);
        header('Location: index.php');
    }
}

?>