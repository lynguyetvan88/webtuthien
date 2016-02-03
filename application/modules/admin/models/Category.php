<?php

class Admin_Model_Category   {

    protected $db; 
   
   
    
    function __construct() {
        
          $this->db=  Zend_Registry::get('connectDB');      
        
    }
    function __destruct() {
        $this->db=NULL;
    }

    public function add_category($title)
	{
        
		$data=array(
		
                'title' =>$title,
                 
		);
                $this->db->insert('category', $data);
                
            
	}
        
        
        public function update_category($title, $id)
	{
        
		$data=array(
		
                'title' =>$title,
                
		);
                $this->db->update('category', $data, 'id='.$id);
                
	}
         public function update_district($category,$position, $id)
	{
        
		$data=array(
		
                'category' =>$category,
                'position' =>$position,
                
		);
                $this->db->update('district', $data, 'id='.$id);
                
	}
    public function delete_category($id)
	{
          $query = "SELECT * FROM `menu` where category_id like '$id'";
          $count=  $this->db->fetchRow($query);
          if($count<>0)
          {
                thongbao('Dữ liệu còn');
               trang_truoc();
          }
         else 
          {
              
               $this->db->delete('category',  'id='.$id);
          }
	
             
              
                
                
                
	}
        
        public function delete_district($id)
	{
          $query = "SELECT * FROM `products` where district_id like '$id'";
          $count=  $this->db->fetchRow($query);
          if($count<>0)
          {
                thongbao('Dữ liệu còn');
               trang_truoc();
          }
         else 
          {
              
               $this->db->delete('district',  'id='.$id);
          }
	
             
              
                
                
                
	}
    
    public function list_category()
    {
       
        try {
             // hien danh sach
       
               $query='SELECT * FROM category';
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
     public function list_district()
    {
       
        try {
             // hien danh sach
       
               $query='SELECT * FROM district';
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    public function add_district($category, $position)
	{
        
		$data=array(
		
                'category' =>$category,
                'position' =>$position,
                 
		);
                $this->db->insert('district', $data);
                
            
	}
        
     public function list_Page_1($id)
    {
       
        try {
            
               $query="SELECT * FROM category where id like '$id'";
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    public function list_Page_2($id)
    {
       
        try {
            
               $query="SELECT * FROM district where id like '$id'";
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    
    
    public function insert_page($menu,$title, $dis, $key, $description, $images,  $position, $active, $content, $home)
	{
        
		$data=array(
		'menu'  =>$menu,
                'title' =>$title,
                'dis' =>$dis,
                'key' =>$key,  
                'key' =>$key,  
		'description'   =>$description,
                'images'   =>$images,
                'position'   =>$position,    
		'active' =>$active,
                'content' =>$content,
                'home' =>$home,
                
                 'date' =>  date("d-m-Y H:i:s"),
		);
                $this->db->insert('page', $data);
                
            
	}
        
        
    public function option_page()
    {
       
        try {
             // hien danh sach
       
               $query="SELECT * FROM add_page where cat_page like '1' and active like '1'";
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    
    
   
    
    
     public function list_Pages()
    {
       
        try {
             // hien danh sach
       
               $query='SELECT * FROM page order by id DESC';
       
              return  $stml=$this->db->fetchAssoc($query);
             
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    
    
    
   
    public function list_Pages_1($id)
    {
       
        try {
            
               $query="SELECT * FROM page where id like '$id'";
       
                //$stml=$this->db->fetchAssoc($query);
               return  $stml=$this->db->fetchAssoc($query);
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    
    
    
    
    public function select_user($id)
    {
        
        // hien danh sach
        $sql = "SELECT * FROM `add_page` where id like '$id'";
        $stml= $this->db->prepare($sql);
        $stml->execute();
        
       while( $result=$stml->fetch(PDO::FETCH_ASSOC))
       {
       
            echo $result['title'];
       
       }
    }
     public function delete_Pages($id)
	{
        
       
              
                
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
         
                  $this->db->delete('page',  'id='.$id);
	}
    
    public function update_Pages($menu,$title, $dis, $key, $description, $images,  $position, $active, $content, $home,$id)
	{
        
		$data=array(
		'menu'  =>$menu,
		'title'   =>$title,
		'dis' =>$dis,
                'key' =>$key,
                'description' =>$description,
                'images' =>$images,
                'position' =>$position,
                'active' =>$active,
                'content' =>$content,
                'home' =>$home,
                'date' =>  date("Y-m-d H:i:s"),
		);
                $this->db->update('page', $data, 'id='.$id);
                
	}
        
        
         public function option_menu()
        {
         try {
             // hien danh sach
       
               $query="SELECT * FROM category  order by id ASC";
       
              return  $stml=$this->db->fetchAssoc($query);
              //$this->menu_parent($stml['id']);
             
             
            } catch (Exception $exc) {
                     echo $exc->getTraceAsString();
                        }


       
        }
        public function option_dictrict()
        {
         try {
             // hien danh sach
       
               $query="SELECT * FROM district  order by  position";
       
              return  $stml=$this->db->fetchAssoc($query);
              //$this->menu_parent($stml['id']);
             
             
            } catch (Exception $exc) {
                     echo $exc->getTraceAsString();
                        }


       
        }
        public function insert_menu( $title, $position, $parent_id, $category_id, $thuocloai, $content, $active, $key, $dis)
        {
         $data=array(
		'parent_id'  =>$parent_id,
                'title' =>$title,
                'dis' =>$dis,
                'key' =>$key,  
                'key' =>$key,  
		'category_id'   =>$category_id,
                'thuocloai'   =>$thuocloai,
                'position'   =>$position,    
		'active' =>$active,
                'content' =>$content,
               
		);
                $this->db->insert('menu', $data);
        }
        
        
        public function list_menu()
    {
       
        try {
             // hien danh sach
       
               $query='SELECT * FROM menu order by  id ASC';
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    
    
     public function delete_menu($id)
	{
          $query1 = "SELECT * FROM `menu` where parent_id like '$id'";
          $count1=  $this->db->fetchRow($query1);
          
          $query = "SELECT * FROM `products` where menu_id like '$id'";
          $count=  $this->db->fetchRow($query);
          if($count<>0 || $count1<>0)
          {
                thongbao('Menu này vẫn còn tồn tại dữ liệu. Vui lòng xóa hết dữ liệu mới xóa được menu');
               trang_truoc();
          }
         else 
          {
              
               $this->db->delete('menu',  'id='.$id);
          }
	
        
	}
        
         public function update_menu($title,$position,$thuocloai,$content,$active,$key,$dis,$category_id, $id)
	{
             
             
        
		$data=array(
		
                'title' =>$title,
                'position' =>$position,
                
                'thuocloai' =>$thuocloai,
                'content' =>$content,
                'active' =>$active,
                'key' =>$key,
                'dis' =>$dis,
                'category_id' =>$category_id,  
                
		);
                $this->db->update('menu', $data, 'id='.$id);
                
	}
         public function list_menu_1($id)
         {
       
        try {
            
               $query="SELECT * FROM menu where id like '$id'";
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
         }
           public function delete_order($id)
	{
          
              
               $this->db->delete('order',  'id='.$id);
          
	
        
	}
    
}