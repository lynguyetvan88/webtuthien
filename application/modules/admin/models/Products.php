<?php

class Admin_Model_Products {

    protected $db;

    function __construct() {

        $this->db = Zend_Registry::get('connectDB');
    }

    function __destruct() {
        $this->db = NULL;
    }

    public function insert_products($title, $description, $images, $content, $menu_id, $price, $state, $sales, $dis, $key, $position, $active, $home, $code, $members, $district_id, $type, $category_id, $price_root) {


        $data = array(
            'title' => $title,
            'description' => $description,
            'images' => $images,
            'content' => $content,
            'menu_id' => $menu_id,
            'price' => $price,
            'state' => $state,
            'sales' => $sales,
            'dis' => $dis,
            'key' => $key,
            'position' => $position,
            'active' => $active,
            'home' => $home,
            'code' => $code,
            'date' => time(),
            'members' => $members,
            'district_id' => $district_id,
            'type' => $type,
            'category_id' => $category_id,
            'price_root' => $price_root,
        );
        $this->db->insert('products', $data);
    }

    public function update_products($title, $description, $images, $content, $menu_id, $price, $state, $sales, $dis, $key, $position, $active, $home, $code, $members, $district_id, $type, $category_id, $id,$price_root) {


        $data = array(
            'title' => $title,
            'description' => $description,
            'images' => $images,
            'content' => $content,
            'menu_id' => $menu_id,
            'price' => $price,
            'state' => $state,
            'sales' => $sales,
            'dis' => $dis,
            'key' => $key,
            'position' => $position,
            'active' => $active,
            'home' => $home,
            'code' => $code,
            'date' => time(),
            //'members' =>$members,
            'district_id' => $district_id,
            'type' => $type,
            'category_id' => $category_id,
             'price_root' => $price_root,
        );
        $this->db->update('products', $data, 'id=' . $id);
    }

    public function update_products_mm($title, $description, $images, $content, $menu_id, $price, $state, $sales, $dis, $key, $position, $active, $home, $made_in, $members, $district_id, $type, $id) {


        $data = array(
            'title' => $title,
            'description' => $description,
            'images' => $images,
            'content' => $content,
            'menu_id' => $menu_id,
            'price' => $price,
            'state' => $state,
            'sales' => $sales,
            'dis' => $dis,
            'key' => $key,
            'position' => $position,
            'active' => $active,
            'home' => $home,
            'made_in' => $made_in,
            'date' => time(),
            //'members' =>$members,
            'district_id' => $district_id,
            'type' => $type,
        );
        $session = new Zend_Session_Namespace('identity');
        $username = $session->username;

        $where[] = "id = '$id'";
        $where[] = "members = '$username'";

        $this->db->update('products', $data, $where);
    }

    public function update_date($id) {

        $session = new Zend_Session_Namespace('identity');
        $username = $session->username;
        $data = array(
            'date' => time(),
        );
        $where[] = "id = '$id'";
        $where[] = "members = '$username'";
        $this->db->update("products", $data, $where);
    }

    public function list_products() {


        try {
            // hien danh sach

            $query = 'SELECT * FROM products order by id DESC';

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_products_1($id) {

        try {

            $query = "SELECT * FROM products where id like '$id'";

            //$stml=$this->db->fetchAssoc($query);
            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_products_2($title) {

        try {

            $query = "SELECT * FROM products where title like '%$title%'";

            //$stml=$this->db->fetchAssoc($query);
            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_products_3($title, $category_id, $parent_id) {

        try {

            $query = "SELECT * FROM products where title like '%$title%'  and menu_id like '%$parent_id%'";

            //$stml=$this->db->fetchAssoc($query);
            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function select_menu($id) {

        // hien danh sach
        $sql = "SELECT * FROM `menu` where id like '$id'";
        $stml = $this->db->prepare($sql);
        $stml->execute();

        while ($result = $stml->fetch(PDO::FETCH_ASSOC)) {

            echo $result['title'];
        }
    }

    public function delete_Products($id) {


        $this->db->delete('products', 'id=' . $id);
    }

    public function delete_Products_mm($id) {

        $session = new Zend_Session_Namespace('identity');
        $username = $session->username;
        $where[] = "id = '$id'";
        $where[] = "members = '$username'";
        $this->db->delete('products', $where);
    }

    public function menu() {
        
    }

    function kiem_tra_menu_con($id) {
        $sql = "select * from menu where parent_id='$id'";
        $count = $this->db->fetchRow($sql);
        if ($count != 0) {
            return "co";
        } else {
            return "khong";
        }
    }

    function hop_option_de_quy($id, $so) {
        $db1 = Zend_Registry::get('connectDB');
        $so++;
        $kt = "";
        for ($i = 1; $i <= $so; $i++) {
            $kt = $kt . "&Star;&Star;&Star;";
        }

        $sql1 = "SELECT * FROM `menu` where parent_id ='$id' ";
        $stml1 = $db1->prepare($sql1);
        $stml1->execute();

        while ($result1 = $stml1->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='$result1[id]'>";
            echo $kt;
            echo $result1['title'];
            echo "</option>";

            $ktmnc = $this->kiem_tra_menu_con($result1['id']);

            if ($ktmnc == "co") {
                $this->hop_option_de_quy($result1['id'], $so);
            }
        }
    }

    function hop_option($id) {

        $sql = "SELECT * FROM menu where category_id like '$id' and parent_id like '' order by position ASC";
        $stml = $this->db->prepare($sql);
        $stml->execute();

        echo "<select name=\"parent_id\" id=\"parent_id\" >";
        echo "<option value=\"\">Cấp đầu</option>";
        while ($result = $stml->fetch(PDO::FETCH_ASSOC)) {

            echo "<option value=\"$result[id]\">";
            echo $result['title'];
            //echo $ktmnc;
            echo "</option>";

            $ktmnc = $this->kiem_tra_menu_con($result['id']);
            if ($ktmnc == "co") {
                $this->hop_option_de_quy($result['id'], 0);
            }
            //hop_option_de_quy($result['id'],0);
        }
        echo "</select>";
    }

    function hop_option__() {

        $sql = "SELECT * FROM menu where parent_id like '' order by position ASC";
        $stml = $this->db->prepare($sql);
        $stml->execute();

        echo "<select name=\"parent_id\" id=\"parent_id\" >";
        echo "<option value=\"\">Cấp đầu</option>";
        while ($result = $stml->fetch(PDO::FETCH_ASSOC)) {

            echo "<option value=\"$result[id]\">";
            echo $result['title'];
            //echo $ktmnc;
            echo "</option>";

            $ktmnc = $this->kiem_tra_menu_con($result['id']);
            if ($ktmnc == "co") {
                $this->hop_option_de_quy($result['id'], 0);
            }
            //hop_option_de_quy($result['id'],0);
        }
        echo "</select>";
    }

    public function update_user_active($status, $id) {
        $data = array(
            'active' => $status,
        );
        $this->db->update('products', $data, 'id=' . $id);
    }

    public function update_menu_active($status, $id) {
        $data = array(
            'active' => $status,
        );
        $this->db->update('menu', $data, 'id=' . $id);
    }

}

?>
