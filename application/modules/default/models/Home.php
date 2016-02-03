<?php

class Default_Model_Home {

    function __construct() {
        $this->db = Zend_Registry::get('connectDB');
    }

    function __destruct() {
        $this->db = NULL;
    }

    public function list_side() {
        try {
            $query = "SELECT * FROM page where active=1 and home=1 order by position ASC,id DESC limit 0,10";
            return $stml = $this->db->fetchAll($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_product() {

        try {

            $query = "SELECT * FROM products where home=1 and active=1 limit 0,15";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function about_mint($id) {

        try {

            $query = "SELECT * FROM add_page where id=$id";

            return $stml = $this->db->fetchAll($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_product_nb() {

        try {

            $query = "SELECT * FROM products ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_page() {

        try {

            $query = "SELECT * FROM page where menu=92 and home=1 and active=1  order by id DESC limit 0,5";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_key($id) {

        try {

            $query = "SELECT * FROM he_thong where id=$id";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
