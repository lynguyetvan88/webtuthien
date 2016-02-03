<?php

class Default_Model_Page {

    function __construct() {
        $this->db = Zend_Registry::get('connectDB');
    }

    function __destruct() {
        $this->db = NULL;
    }

    public function list_video($limit = "", $id = "", $id_other = "") {

        try {

            $query = "SELECT * FROM video where active=1 ";
            if (!empty($id))
                $query.=" and video_id = $id";
            if (!empty($id_other))
                $query.="and video_id <> $id_other";

            $query.=" order by video_id DESC";
            if (!empty($limit))
                $query.=" limit $limit";

            return $stml = $this->db->fetchAll($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function calander() {
        include 'ham/simple_html_dom.php';
        $html = file_get_html('http://ngaydep.com/lich-van-nien.html');
        $html = str_get_html($html);
        $elem = $html->find('div[id=this_year]', 0);
        return $elem;
    }

    public function list_cus() {

        try {

            $query = "SELECT * FROM side where type = 1";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_page_home($id = "", $limit = "") {

        try {

            $query = "SELECT * FROM page  where active = 1 and menu=$id order by id DESC limit $limit";

            return $stml = $this->db->fetchAll($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function add_page_home($id = "") {

        try {

            $query = "select * from  add_page where cat_page=1  and active=1  order by position ASC, id ASC ";

            $stml = $this->db->fetchAll($query);
            $count = count($stml);
            for ($i = 0; $i < $count; $i++) {
                $stml[$i]['page'] = $this->list_page_home($stml[$i]['id'], "0,3");
                $stml[$i]['page_2'] = $this->list_page_home($stml[$i]['id'], "3,6");
            }
            return($stml);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function add_page_news($id = "") {

        try {

            $query = "select * from  add_page where cat_page=1 and cat_page_id like '$id' and active=1  order by position ASC, id ASC ";

            $stml = $this->db->fetchAll($query);
            $count = count($stml);
            $stt = "";
            for ($i = 0; $i < $count; $i++) {
                $stt.=($stml[$i]['id']) . ",";
            }
            $in = substr($stt, 0, -1);
            $sql = "SELECT * FROM page  where active = 1 and menu in ($in) order by id DESC limit 0,5";
            //echo $sql; die;

            $stml_1 = $this->db->fetchAll($sql);
            return($stml_1);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function page_2($id) {


        try {

            $query = "select * from  add_page where cat_page=1 and cat_page_id=$id and active=1  order by position ASC, id ASC ";

            return $stml = $this->db->fetchAll($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function page_4($id) {


        try {

            $query = "select * from  add_page where  cat_page_id=6 and active=1  order by position ASC, id ASC ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_page___($id, $limit = "") {


        try {

            $query = "select * from  page where menu=$id and active=1  order by position ASC, id DESC limit $limit ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function page_3($id) {

        try {

            $query = "SELECT * FROM add_page where id like '$id'";

            return $stml = $this->db->fetchAll($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Page_1($id) {

        try {

            $query = "SELECT * FROM add_page where id like '$id' and active=1";

            return $stml = $this->db->fetchAll($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Page_2($id) {
        try {

            $query = "select * from  add_page where cat_page=1 and cat_page_id like '$id' and active=1  order by position ASC, id ASC ";

            $stml = $this->db->fetchAll($query);
            $count = count($stml);
            $stt = $id . ",";

            for ($i = 0; $i < $count; $i++) {
                $stt.=($stml[$i]['id']) . ",";
            }
            $in = substr($stt, 0, -1);
            $sql = "SELECT * FROM page  where active = 1 and menu in ($in) order by id DESC";
            // echo $sql; die;

            $stml_1 = $this->db->fetchAll($sql);
            return($stml_1);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Page_3e() {

        try {

            $query = "SELECT * FROM page where  active=1 order by position ASC, date DESC limit 0,7";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Page_search($key) {

        try {

            $query = "SELECT * FROM page where title like '%$key%' and active=1 order by position ASC, id DESC";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Page_3($id) {

        try {

            $query = "SELECT * FROM page where id like '$id' order by position ASC, id DESC ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Page_4($id, $menu) {

        try {

            $query = "SELECT * FROM page where id <> '$id' and menu like '$menu' order by position ASC, id DESC ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Products_Nb($limit = 0, $km = "") {

        try {
            // home like '1' and
            $query = "SELECT * FROM products where  active like '1' and home like '1'  ";
            if (!empty($km))
                $query .= " and sales like '1'";

            $query .= "order by position DESC, id DESC limit $limit,5";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_side_home() {

        try {

            $query = "SELECT * FROM  side  order by   position  ASC ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_page($id) {
        try {

            $query = "SELECT * FROM  add_page where id = $id  order by   position  ASC ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_menu_page($id) {

        try {

            $query = "SELECT * FROM add_page where  cat_page_id like '$id' and active like '1'  order by position ASC, id ASC ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Products_title($id) {

        try {

            $query = "SELECT menu.title as title_menu,category.title as title_category,menu.parent_id, category.id as id_category  FROM menu,category where  menu.category_id=category.id and  menu.id = '$id' ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function title_menu($id) {

        try {

            $query = "SELECT * from menu where id=$id";

            $stml = $this->db->fetchAll($query);
            return ($stml[0]['title']);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_menu_title_2($parent_id) {

        try {

            $query = "SELECT * FROM menu where   menu.id = '$parent_id' ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_menu_title_1($id) {

        try {

            $query = "SELECT * FROM menu where   menu.id = '$id' ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function kiem_tra_menu_con($id) {
        $sql = "select * from menu where id='$id' and parent_id not like ''";
        $count = $this->db->fetchRow($sql);
        if ($count != 0) {
            return "co";
        } else {
            return "khong";
        }
    }

    function check_menu($id) {
        $sql = "select * from menu where parent_id='$id' ";
        $count = $this->db->fetchRow($sql);
        if ($count != 0) {
            return "co";
        } else {
            return "khong";
        }
    }

    function list_menu($id) {

        try {

            $query = "select * from menu where parent_id='$id' ";

            $stml = $this->db->fetchAll($query);

            return $sttt = $this->_format_showlist($stml);
//              echo "<pre>";
//                var_dump($sttt); 
//                echo "</pre>";
//                die;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function list_menu_other($id) {

        try {

            $query = "select * from menu where parent_id='$id' ";

            $stml = $this->db->fetchAll($query);

            return $stml;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    private function _format_showlist($mlist) {

        if (!empty($mlist)) {
            for ($i = 0; $i < count($mlist); $i++) {
                $mfile = $this->list_menu_other($mlist[$i]['id']);
                $mlist[$i]['menu'] = $mfile;

                if (!empty($mlist[$i]['menu'])) {
                    for ($j = 0; $j < count($mfile); $j++) {
                        $mfile1 = $this->list_menu_other($mfile[$j]['id']);
                        $mlist[$i]['menu'][$j]['menu'] = $mfile1;

                        if (!empty($mfile1)) {
                            for ($k = 0; $k < count($mfile1); $k++) {
                                $mfile2 = $this->list_menu_other($mfile1[$k]['id']);
                                $mlist[$i]['menu'][$j]['menu'][$k]['menu'] = $mfile2;
                            }
                        }
                    }
                }
            }
        }
//    echo "<pre>";
//                var_dump($mlist); 
//     echo "</pre>"; die;
        return $mlist;
    }

    public function list_Products_title_c($id) {

        try {

            $query = "SELECT * FROM category where  id like '$id' ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function qc_home() {

        try {

            $query = "SELECT * FROM add_page where id like '15' and active like '1'";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_detail_products($id) {

        try {

            $query = "SELECT * FROM products where  id like '$id' and active like '1'";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function district($district_id) {

        $query = "SELECT * FROM district where id like '$district_id'";
        $stml = $this->db->prepare($query);
        $stml->execute();
        while ($result = $stml->fetch(PDO::FETCH_ASSOC)) {
            $id = $result['id'];
            $category = $result['category'];


            echo $category;
        }
    }

    public function menu($menu_id) {

        $query = "SELECT * FROM menu where category_id like '$menu_id'";
        return $stml = $this->db->fetchAll($query);
    }

    public function member($member) {
        $view = new Zend_View();
        $base = $view->baseurl();
        $query = "SELECT * FROM products where members like '$member' order by date DESC, id DESC limit 0,5 ";
        $stml = $this->db->prepare($query);
        $stml->execute();
        while ($result = $stml->fetch(PDO::FETCH_ASSOC)) {
            $id = $result['id'];

            $mystring = $result['date'];
            $findme = '-';
            $pos = strpos($mystring, $findme);
            if ($pos === false) {
                $date = gmdate("d-m-Y", $result['date'] + 7 * 3600);
            } else {
                $date = $result['date'];
            }
            $title = $result['title'];
            $url = khongdau($title);

            echo " <a href=\"$base/chi-tiet/$url-$id.html\" title=\"$title\"> <h5> $title ($date)</h5></a>  ";
        }
    }

    public function list_Products_New($id) {

        try {



            $query = "SELECT * FROM products where  active like '1' and  id <> $id order by date DESC, id DESC limit 0,15";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function detail_member($user) {

        try {


            $query = "SELECT * FROM users where  username like '$user' ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function update_views($views, $id) {


        $data = array(
            'views' => $views,
        );
        $this->db->update('products', $data, 'id=' . $id);
    }

    public function list_category() {
        $view = new Zend_View();
        $base = $view->baseurl();
        $query = "SELECT * FROM category order by id ASC ";
        $stml = $this->db->prepare($query);
        $stml->execute();
        echo "<select name=\"category_id\" id='category_id' class='form_tk' style=\"float: left;margin: 2px 10px 0px 0px\">";
        echo "<option value=\"\">
				------ Chọn danh mục gốc ------
			</option>";

        while ($result = $stml->fetch(PDO::FETCH_ASSOC)) {

            $title = $result['title'];
            $id = $result['id'];

            echo "<option value=\"$id\">
				$title
			</option>";
        }
        echo "</select>";
    }

    public function search_1($title) {

        try {

            $query = "SELECT * FROM products  where  title like '%$title%' ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function search_2($title = "") {

        try {

            $query = "SELECT * FROM products  where active = 1  ";
            if (!empty($title))
                $query.=" and title like '%$title%'";


            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_menu_price() {

        try {

            $query = "SELECT * FROM add_page where  cat_page_id  = 12 ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function check_menu_con($id) {
        $sql = "select * from add_page where cat_page_id='$id'";
        $count = $this->db->fetchRow($sql);
        if ($count != 0) {
            return "co";
        } else {
            return "khong";
        }
    }

    public function list_Page_67($id) {

        try {

            $query = "SELECT * FROM add_page where cat_page_id like '$id' and active=1 and cat_page=1";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_sildeshow() {


        try {

            $query = "SELECT * FROM side  order by position ASC limit 0,10";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function partners_home() {


        try {

            $query = "SELECT * FROM side where   type like '1'  ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function list_Products_() {

        try {

            $query = "SELECT * FROM products where   active like '1'  order by date DESC, id DESC ";

            return $stml = $this->db->fetchAssoc($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
