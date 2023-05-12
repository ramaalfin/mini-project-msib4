<?php 
require_once '../../koneksi.php';
class Produk_model {
    private $dbh;

    public function __construct() {
        global $dsn, $user, $password;
        try {
            $this->dbh = new PDO($dsn, $user, $password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Terjadi Kesalahan Koneksi DB dengan sebab: ' .
            $e->getMessage());
        }
    }

    public function get_produk() {
        $stmt = $this->dbh->prepare('SELECT produk.*, jenis_produk.nama AS jenis_produk FROM produk JOIN jenis_produk ON produk.jenis_produk_id = jenis_produk.id ORDER BY nama;');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_jenis_produk()
    {
        $stmt = $this->dbh->prepare('SELECT * FROM jenis_produk');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_produk_by_id($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM produk WHERE id = $id");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add_produk($kode, $nama, $harga_beli, $harga_jual, $stok, $min_stok, $jenis_produk_id)
    {
        $stmt = $this->dbh->prepare('INSERT INTO produk (kode, nama, harga_beli, harga_jual, stok, min_stok, jenis_produk_id) VALUES (:kode, :nama, :harga_beli, :harga_jual, :stok, :min_stok, :jenis_produk_id)');
        $stmt->bindParam(':kode', $kode);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':harga_beli', $harga_beli);
        $stmt->bindParam(':harga_jual', $harga_jual);
        $stmt->bindParam(':stok', $stok);
        $stmt->bindParam(':min_stok', $min_stok);
        $stmt->bindParam(':jenis_produk_id', $jenis_produk_id);
        $stmt->execute();
    }

    public function edit_produk($id, $kode, $nama, $harga_beli, $harga_jual, $stok, $min_stok, $jenis_produk_id)
    {
        $stmt = $this->dbh->prepare('UPDATE produk SET kode=:kode, nama=:nama, harga_beli=:harga_beli, harga_jual=:harga_jual, stok=:stok, min_stok=:min_stok, jenis_produk_id=:jenis_produk_id WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':kode', $kode);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':harga_beli', $harga_beli);
        $stmt->bindParam(':harga_jual', $harga_jual);
        $stmt->bindParam(':stok', $stok);
        $stmt->bindParam(':min_stok', $min_stok);
        $stmt->bindParam(':jenis_produk_id', $jenis_produk_id);
        $stmt->execute();
    }

    public function hapus_produk($id)
    {
        $stmt = $this->dbh->prepare("DELETE FROM produk WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }
}

?>