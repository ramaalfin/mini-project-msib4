<?php 
require_once 'model.php';
$controller = new Frontend_controller();

class Frontend_controller{
    private $model;

    public function __construct() {
        $this->model = new Frontend_model();
    }

    public function get_produk() {
        return $this->model->get_produk();
    }
}

?>