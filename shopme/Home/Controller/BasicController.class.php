<?php
namespace Home\Controller;
use Think\Controller;

class BasicController extends ComController {
  public function infor(){
    $information=M("information"); 
    if (IS_POST){

      //图片更新
      $upload = new \Think\Upload();// 实例化上传类
      $upload->maxSize   = 22222222 ;// 设置附件上传大小 
      $upload->exts = array('jpg','png','gif','jpag','ico');// 设置附件上传类型
      $upload->autoSub   = true;//自动子目录保存文件
      $upload->rootPath  = "./";
      $upload->savePath  ='Uploads/Info/'; // 设置附件上传目录
         // 获取上传文件信息
      if(!empty($_FILES['ico']['name']) || !empty($_FILES['logo']['name']) || !empty($_FILES['weixinlogo']['name']) || !empty($_FILES['qqlogo']['name'])){//处理上传的文件
          $time=date('Y-m-d', time());
          foreach ($_FILES as $key => $files) {//循环验证上传的数组
            if (!empty($files['name'])) {//如果数组不为空就验证
              $Url=$information->field("".$key."")->where('')->find();
              $save_path=$upload->rootPath.$Url["".$key.""];
              @unlink($save_path);//删除原来的图片
              $uploadinfo = $upload->uploadOne($files);
              if ($uploadinfo) {//验证上传数组验证成功就拼接图片地址否则返回错误信息
                $_POST[$key] = $upload->savePath.$time.'/'.$uploadinfo['savename'];
              }else{
                echo '上传失败';exit;
              }
            }
          }
      }
      $data=$_POST;
      $ss=$information->where("")->find();
      if(empty($ss)){
        $addId=$information->add($data);
        if($addId){
          echo 'ok';exit;
        }else{
          echo '设置失败';exit;
        }
      }else{
        if(false !== $information->where("")->save($data)){
          echo 'ok';exit;
          exit;
        }else{
          echo '设置失败';exit;
          exit;
        }  
      }
    }else{
      $inFor=$information->find();
      $this->assign("infor",$inFor);
      $this->display();
    }
  }

}
