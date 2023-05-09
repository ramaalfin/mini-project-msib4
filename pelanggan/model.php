<?php 
require_once '../koneksi.php';
class Pelanggan_model {
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

    public function get_pelanggan() {
        $stmt = $this->dbh->prepare('SELECT pelanggan.*, CASE WHEN jk = "L" THEN "Laki-laki" ELSE "Perempuan" END AS jk, kartu.nama AS kartu FROM pelanggan JOIN kartu ON pelanggan.kartu_id = kartu.id ORDER BY nama_pelanggan;');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_kartu()
    {
        $stmt = $this->dbh->prepare('SELECT * FROM kartu');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add_pelanggan($kode, $nama_pelanggan, $jk, $tmp_lahir, $tgl_lahir, $email, $kartu_id)
    {
        $stmt = $this->dbh->prepare('INSERT INTO pelanggan (kode, nama_pelanggan, jk, tmp_lahir, tgl_lahir, email, kartu_id) VALUES (:kode, :nama_pelanggan, :jk, :tmp_lahir, :tgl_lahir, :email, :kartu_id)');
        $stmt->bindParam(':kode', $kode);
        $stmt->bindParam(':nama_pelanggan', $nama_pelanggan);
        $stmt->bindParam(':jk', $jk);
        $stmt->bindParam(':tmp_lahir', $tmp_lahir);
        $stmt->bindParam(':tgl_lahir', $tgl_lahir);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':kartu_id', $kartu_id);
        $stmt->execute();
    }
}

?>