<?php

class Admin_Model_Page {

    protected $db;
    public $title, $cat_page, $position, $active, $content, $date, $id;

    function __construct() {

        $this->db = Zend_Registry::get('connectDB');
    }

    function __destruct() {
        $this->db = NULL;
    }

    public function add_Page($title, $cat_page, $position, $active, $content, $cat_page_id, $key, $dis) {

        $data = array(
            'cat_page' => $cat_page,
            'position' => $position,
            'active' => $active,
            'content' => $content,
            'title' => $title,
            'cat_page_id' => $cat_page_id,
            'date' => time(),
            'key' => $key,
            'dis' => $dis,
        );
        $this->db->insert('add_page', $data);
    }

    public function update_Page($title, $cat_page, $position, $active, $content, $id, $key, $dis, $cat_page_id) {

        $data = array(
            'cat_page' => $cat_page,
            'position' => $position,
            'active' => $active,
            'content' => $content,
            'title' => $title,
            'cat_page_id' => $cat_page_id,
            'date' => time(),
            'key' => $key,
            'dis' => $dis,
        );
        $this->db->update('add_page', $data, 'id=' . $id);
    }

    public function delete_Page($id) {
        $query = "SELECT * FROM `page` where menu like '$id'";
        $count = $this->db->fetchRow($query);
        if ($count <> 0) {
            thongbao('Dữ liệu còn');
            trang_truoc();
        } else {


            $this->db->delete('add_page', 'id=' . $id);
        }
    }

    public function list_Page() {

        try {
            // hien danh sach

            $query = "SELECT * FROM add_page where cat_page_id='' order by cat_page";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Page_1($id) {

        try {

            $query = "SELECT * FROM add_page where id like '$id'";

            return $stml = $this->db->fetchAll($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function insert_page($menu, $title, $dis, $key, $description, $images, $position, $active, $content, $home, $address) {

        $data = array(
            'menu' => $menu,
            'title' => $title,
            'dis' => $dis,
            'key' => $key,
            'description' => $description,
            'images' => $images,
            'position' => $position,
            'active' => $active,
            'content' => $content,
            'home' => $home,
            'address' => $address,
            'date' => time(),
        );
        $this->db->insert('page', $data);
    }

    public function option_page() {

        try {
            // hien danh sach

            $query = "SELECT * FROM add_page where cat_page like '1' and active like '1'";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Pages($data = "") {

        try {
            // hien danh sach

            $query = "SELECT * FROM page $data order by id DESC";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Pages_search($data) {

        try {
            // hien danh sach

            $query = 'SELECT * FROM page order by id DESC';

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Pages_1($id) {

        try {

            $query = "SELECT * FROM page where id like '$id'";

            //$stml=$this->db->fetchAssoc($query);
            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function select_user($id) {

        // hien danh sach
        $sql = "SELECT * FROM `add_page` where id like '$id'";
        $stml = $this->db->prepare($sql);
        $stml->execute();

        while ($result = $stml->fetch(PDO::FETCH_ASSOC)) {

            echo $result['title'];
        }
    }

    public function delete_Pages($id) {




//                $sql = "SELECT * FROM `page` where id like '$id'";
//                $stml= $this->db->prepare($sql);
//                $stml->execute();
//                 while( $result=$stml->fetch(PDO::FETCH_ASSOC))
//                 {
//                    //$front = Zend_Controller_Front::getInstance();
//                     //$url = $front->getBaseUrl();
//                     $hinhanh=$result['images'];
//                     $taptin="http://localhost/project_1/public/Upload/$hinhanh";
//	             unlink($taptin);
//                   
//       
//                 }


        $this->db->delete('page', 'id=' . $id);
    }

    public function update_Pages($menu, $title, $dis, $key, $description, $images, $position, $active, $content, $home, $address, $id) {

        $data = array(
            'menu' => $menu,
            'title' => $title,
            'dis' => $dis,
            'key' => $key,
            'description' => $description,
            'images' => $images,
            'position' => $position,
            'active' => $active,
            'content' => $content,
            'home' => $home,
            'address' => $address,
            'date' => time(),
        );
        $this->db->update('page', $data, 'id=' . $id);
    }

    public function count_page($id) {

        $sql = "select * from  add_page where  	cat_page_id='$id'";
        $count = $this->db->fetchRow($sql);
        if ($count != 0) {
            return "co";
        } else {
            return "khong";
        }
    }

    public function update_user_active($status, $id) {
        $data = array(
            'active' => $status,
        );
        $this->db->update('add_page', $data, 'id=' . $id);
    }

    public function update_pages_active($status, $id) {
        $data = array(
            'active' => $status,
        );
        $this->db->update('page', $data, 'id=' . $id);
    }

}
