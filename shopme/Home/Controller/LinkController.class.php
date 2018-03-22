<?php
namespace Home\Controller;
use Think\Controller;

class LinkController extends ComController 
{
  
   /*
  * 2016.5.31
  * 董明
  *--单删
  */
  public function banClassDelete(){
        $id=$this->putIDmd5($_POST['id']);//单删id
        if ($id!="") {
            $Model=M();
            if ($Model->execute("delete from bannerclass where id='{$id}'")) {
                echo "1";
                exit;
            }else{
                echo "0";
                exit;
            }
        }
    }
    /*
  * 2016.5.31
  * 董明
  *--多删
  */
  public function banClassDdelall(){
        if ($_POST['idstr']!='') {
            $supAdmin= M("bannerclass");
            $newstr = substr($_POST['idstr'],0,strlen($_POST['idstr'])-1);   
            $ids=explode(",",$newstr);
            $id="";
            foreach ($ids as $key => $value) {
               $id.=$this->putIDmd5($value).",";//单删id   
            }
            $newstr2 = substr($id,0,strlen($id)-1); 
            if ($supAdmin->delete($newstr2)) {
                echo "1";
                exit;
            }else{
                echo "0";
                exit;
            }
        }
    }
}


  