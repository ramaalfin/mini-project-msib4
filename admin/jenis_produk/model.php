<?php 
require_once '../../koneksi.php';

class JenisProduk_model {
    private $dbh;
    public function __construct()
    {
        global $dsn, $user, $password;
        try {
            $this->dbh = new PDO($dsn, $user, $password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Terjadi Kesalahan Koneksi DB dengan sebab: ' .
            $e->getMessage());
        }
    }

    public function get_jenis_produk()
    {
        $stmt = $this->dbh->prepare('SELECT * FROM jenis_produk');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_jenis_produk_by_id($id) {
        $stmt = $this->dbh->prepare("SELECT * FROM jenis_produk WHERE id = $id");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add_jenis_produk($nama)
    {
        $stmt = $this->dbh->prepare('INSERT INTO jenis_produk (nama) VALUES (:nama)');
        $stmt->bindParam(':nama', $nama);
        $stmt->execute();
    }

    public function edit_jenis_produk($id, $nama)
    {
        $stmt = $this->dbh->prepare('UPDATE jenis_produk SET nama=:nama WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $nama);
        $stmt->execute();
    }

    public function hapus_jenis_produk($id)
    {
        $stmt = $this->dbh->prepare("DELETE FROM jenis_produk WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }
}
?>