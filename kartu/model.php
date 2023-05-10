<?php 
require_once '../koneksi.php';
class Kartu_model {
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

    public function get_kartu() {
        $stmt = $this->dbh->prepare('SELECT * FROM kartu');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_kartu_by_id($id) {
        $stmt = $this->dbh->prepare("SELECT * FROM kartu WHERE id = $id");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add_kartu($kode, $nama, $diskon, $iuran)
    {
        $stmt = $this->dbh->prepare('INSERT INTO kartu (kode, nama, diskon, iuran) VALUES (:kode, :nama, :diskon, :iuran)');
        $stmt->bindParam(':kode', $kode);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':diskon', $diskon);
        $stmt->bindParam(':iuran', $iuran);
        $stmt->execute();
    }

    public function hapus_kartu($id)
    {
        $stmt = $this->dbh->prepare("DELETE FROM kartu WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }
}

?>