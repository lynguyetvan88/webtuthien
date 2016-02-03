<?php

// Zend_View_Helper co dinh
class Zend_View_Helper_Search extends Zend_View_Helper_Abstract
{
    public $view;
    public function  Search()
    {
         $view=new Zend_View();
        $base=$view->baseUrl();
     
       // echo"<script type=\"text/javascript\" src=\"$base/js/AJAX_2.js\"></script>";
        echo "<link href=\"$base/css/bootstrap-cerulean_1.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" >
";
        echo "<form action=\"$base/product/search\" method=\"get\" enctype=\"multipart/form-data\" name=\"tt_mh\" id=\"tt_mh\"  class=\"form-horizontal\">
 <div class=\"control-group\" style='margin-left:-30px'>
        <label class=\"control-label\" for=\"selectError\">Tìm kiếm</label>
        <div class=\"controls\">
            <input name=\"title\" type=\"text\" class=\"span6 typeahead\" id=\"typeahead\"  data-provide=\"typeahead\"  style=\"float: left; margin-right: 10px; width: 250px\" >
            
           ";
        $page=new Default_Model_Page();
        $page->list_category();
      
           echo "   <script>
            $(document).ready(function(  ){
                $(\"select option:selected\").each(function () {
                    $(\"div#div123\").get(\"$base/default/register/menu?id=\" + $(this).val());
                });	
            });
	
            $(\"select#category_id\").change(function () {
                var str = \"\";
                $(\"select option:selected\").each(function () {
                    str += $(this).val() + \" \";
                });
               
            })
            .change(function(  ){
                $(\"div#div123\").load(\"$base/default/register/menu?id=\" + $(this).val());
            });
        </script> ";
        
           
	echo"
        <div id=\"div123\" style=\"float: left; margin: 2px 10px 0px 0px\">
                <select name=\"\">
                    <option>--- Chọn menu ---</option>
                </select>
            </div>
            <div id=\"div2\" style=\"float: left;margin: 2px 10px 0px 0px\"></div>
            <button type=\"submit\" class=\"btn btn-primary\" style=\"margin-top: 2px\">Search</button>
        </div>
    </div>
            

   
                 
               
   
</form>
     
";
    }
    
    
    
     
    public function setView(Zend_View_Interface $view) {
        $this->view=$view;
       
    }
}


