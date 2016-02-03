<?php


class My_Controller_Acl extends Zend_Acl
{
   
     public function __construct(){
 
      $this->addRole(new Zend_Acl_Role("amo"));
      $this->addRole(new Zend_Acl_Role("user"),"amo");
      $this->addRole(new Zend_Acl_Role("seller"),"user");
      $this->addRole(new Zend_Acl_Role("admin"));
      
      $this->addResource(new Zend_Acl_Resource("default:index"));// module default va controller index
      $this->addResource(new Zend_Acl_Resource("admin:index"));// modeule admin va controller index
      
      $this->allow("amo", "default:index",null );//array('index', 'gioithieu','register','logout')); // user co quyen tren modeule default controller index va full action trong controller đó , tương tự cho moderator bên dưới
      $this->allow("user", "default:index",null );//array('index', 'lienhe','register'));
      $this->deny("user", "admin:index", array( // Moderator có quền trên module admin -> controller index array la cac action trong controller index
                                                    'logout',
                                                    'cauhinh',
                                                    'contact',
                                                   
                                                    ));
      $this->allow("seller", "admin:index", array( // Moderator có quền trên module admin -> controller index array la cac action trong controller index
                                                    'index',
                                                    'danhmuc',
                                                    'noidungdm',
                                                    'gioithieu',
                                                    'daotao',
                                                    'tintuc',
                                                    'tuyendung',
                                                    'hotrotructuyen',
                                                    'lienketweb',
                                                    'facebook',
                                                    'thanhvien',
                                                    'listdanhmuc',
                                                    ));
      $this->allow("admin", null, null); // Admin co full quyền tên project
   }

    
}