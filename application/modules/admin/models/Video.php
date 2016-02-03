<?php

class Admin_Model_Video {

    function __construct() {
        $this->db = Zend_Registry::get('connectDB');
    }

    function __destruct() {
        $this->db = NULL;
    }

    public function list_video($id='') {
        try {            
            $query = "SELECT * FROM `video`";
            if(!empty($id))
                $query.=" where video_id like '$id'";

            return $stml = $this->db->fetchAll($query);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

   
    public function insert_video($data) {
        $this->db->insert('video', $data);
    }

    public function update_video($data, $id) {
        
        $this->db->update('video', $data, 'video_id=' . $id);
    }

    public function delete_support($id) {
        $this->db->delete('video', 'video_id=' . $id);
    }

}

?>
