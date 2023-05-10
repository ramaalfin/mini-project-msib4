<?php 
require_once '../koneksi.php';
class Pesanan_model{
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
    public function get_pesanan()
    {
        $stmt = $this->dbh->prepare('SELECT pesanan.*, pelanggan.nama_pelanggan AS nama_pelanggan FROM pesanan JOIN pelanggan ON pesanan.pelanggan_id = pelanggan.id ORDER BY tanggal');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_pelanggan()
    {
        $stmt = $this->dbh->prepare("SELECT * FROM pelanggan");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_pesanan_by_id($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM pesanan WHERE id = $id");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cek_pelanggan($id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM pesanan WHERE pelanggan_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add_pesanan($tanggal, $total, $pelanggan_id)
    {
        $stmt = $this->dbh->prepare('INSERT INTO pesanan (tanggal, total, pelanggan_id) VALUES (:tanggal, :total, :pelanggan_id)');
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':pelanggan_id', $pelanggan_id);
        $stmt->execute();
    }

    public function edit_pesanan($id, $tanggal, $total, $pelanggan_id)
    {
        $stmt = $this->dbh->prepare('UPDATE pesanan SET tanggal=:tanggal, total=:total, pelanggan_id=:pelanggan_id WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':pelanggan_id', $pelanggan_id);
        $stmt->execute();
    }

    public function hapus_pesanan($id)
    {
        $stmt = $this->dbh->prepare("DELETE FROM pesanan WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }
}
?>