<?php 
require_once 'koneksi.php';
class Frontend_model {
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

}

?>