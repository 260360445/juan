<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class GoodController extends ComController {
    /*
    *2017.12.28
    *明明
    *商品分类
    */
    public function goods_cate_list(){
        $name = I('get.name','');
        $cond['pid']=0;
        if ($name != ''){
            $cond['name'] = ['like',"%$name%"];
        }
        $total = M('goods_class')
            ->where($cond)
            ->count();
        $limit = 10;
        $page = new Page($total,$limit);
        $info = M('goods_class')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('sort asc,goods_class_id asc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    /*
    *2017.12.28
    *分类添加
    */
    public function goods_cate_add(){
    	if (IS_POST){
    		$goods_class=M("goods_class");
    		$data['name']=$_POST['name'];
            $data['sort']=$_POST['sort'];
            $data['pid']=$_POST['pid'];
            $data['state']=$_POST['state'];
            $data['time']=time();
            $addid=$goods_class->add($data);
            if($addid){
            	echo 'ok';
            	exit;
            }else{
            	echo '添加失败';
            	exit;
            }
    	}else{
    		$this->display();
    	}
    }
    /*
    *2017.12.28
    *分类修改
    */
    public function goods_cate_edit(){
    	if (IS_POST){
    		$goods_class=M("goods_class");
    		$id = I('post.setid','');
            
    		$data['name']=$_POST['name'];
            $data['sort']=$_POST['sort'];
            $data['pid']=$_POST['pid'];
            $data['state']=$_POST['state'];
            $data['time']=time();
            $addid=$goods_class->where("goods_class_id=".$id)->save($data);
            if($addid){
            	echo 'ok';
            	exit;
            }else{
            	echo '修改失败';
            	exit;
            }
    	}else{
    		$id = I('get.id','');
    		$data=M("goods_class")->field("goods_class_id,name,sort,state")->where("goods_class_id=".$id)->find();
    		$this->assign("infor",$data);
    		$this->display();
    	}
    }
    //-----删除(单删)-----//
    public function good_cate_delete(){
        $id=isset($_POST['id'])?$_POST['id']:'';//单删id
        if ($id!="") {
            $result = M('goods')->where("goods_cate_id = {$id}")->find();
            $classresult = M('goods_class')->where("pid = {$id}")->find();
            if ($classresult) {
                echo "分类下有子类不允许删除";
                exit();
            }else{
                if ($result) {//分类下有商品不允许删除
                    echo "分类下有商品不允许删除";
                    exit;
                }else{
                     $Model=M();
                     if ($Model->execute("delete from sc_goods_class where goods_class_id='{$id}'")) {
                        echo "ok";exit;
                     }else{
                        echo "删除失败";exit;
                     }
                }
            }
        }
    }
    //商品列表
    public function goods_list(){
    	$title = I('get.title','');
        if ($title != ''){
            $cond['title'] = ['like',"%$title%"];
        }
        $total = M('goods')
            ->where($cond)
            ->count();
        $limit = 10;
        $page = new Page($total,$limit);
        $info = M('goods')
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    public function daolist(){
        $info = M('goods_class')->field('goods_class_id,name')->order('sort asc,goods_class_id asc')->select();
        $html.='<form enctype="multipart/form-data" method="post" id="subexcel"><div style="text-align:center;margin:0 auto;">';
        $html.='<div class="col-md-55" style="margin-top:25px;margin:0 auto;">';
        $html.='<label>商品分类 ：</label>';
        $html.='<select id="goods_cate_id" name="goods_cate_id">';
        $html.='<option value="0">请选择分类</option>';
        foreach ($info as $k => $v) {
            $html.='<option value="'.$v['goods_class_id'].'">'.$v['name'].'</option>';
        }    
        $html.='</select>';
        $html.='</div>';
        $html.='<div class="col-md-55" style="margin-top:25px;margin:0 auto;">';
        $html.='<label>商品属性 ： </label><input type="radio" name="type" value="2" checked>普通 <input type="radio" name="type" value="3" >高佣金';
        $html.='</div>';
        $html.='<div class="col-md-55" style="margin-top:25px;margin:0 auto;">';
        $html.='<label>商品类型 ： </label><input type="radio" name="gtype" value="2" checked>普通 <input type="radio" name="gtype" value="3" >9块9';
        $html.='</div>';
        $html.='<div class="col-md-55" style="margin-top:25px;margin:0 auto;">';
        $html.='<label>导入商品 ： </label><input type="file" name="goodsexal" id="goodsexal" style="display:inline-block;">';
        $html.='</div>';
        $html.='<div class="thumbnailbutton">';
        $html.='<a href="javascript:setexal();" class="btn btn-wide btn-o btn-info">导入</a>&nbsp&nbsp&nbsp'; 
        $html.='<a href="javascript:closelayer();" class="btn btn-wide btn-o btn-danger">取消</a>'; 
        $html.='</div>';
        $html.='</div></form>';
        echo $html;
    }
    public function upload() {
       if (!empty($_FILES)) {
            $config = array(
                'exts' => array('xlsx','xls'),
                'maxSize' => 3145728,
                'rootPath' =>"./",
                'savePath' => 'Uploads/excel/',
                'subName' => array('date','YmdHis'),
            );
            $upload = new \Think\Upload($config);
            if (!$info = $upload->upload()) {
               $this->error($upload->getError());
            }
            vendor("PHPExcel.PHPExcel");
            $file_name=$upload->rootPath.$info['goodsexal']['savepath'].$info['goodsexal']['savename'];
            $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
            if ($extension == 'xlsx') {
                $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
                $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            } else if ($extension == 'xls'){
                $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
            }
            $sheet =$objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();//取得总行数
            $highestColumn =$sheet->getHighestColumn(); //取得总列数
            for ($i = 1; $i <= $highestRow; $i++) {
                $data['lid'] =$objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                $data['title'] =$objPHPExcel->getActiveSheet()->getCell("B" .$i)->getValue();
                $data['glogo'] =$objPHPExcel->getActiveSheet()->getCell("C" .$i)->getValue();
                $data['gurl'] = $objPHPExcel->getActiveSheet()->getCell("D". $i)->getValue();
                $data['store'] =$objPHPExcel->getActiveSheet()->getCell("E" .$i)->getValue();
                $data['price'] =$objPHPExcel->getActiveSheet()->getCell("F" . $i)->getValue();
                $data['sell'] =$objPHPExcel->getActiveSheet()->getCell("G" . $i)->getValue();
                $data['shouru'] =$objPHPExcel->getActiveSheet()->getCell("H" . $i)->getValue();
                $data['yj'] =$objPHPExcel->getActiveSheet()->getCell("I" . $i)->getValue();
                if($_POST['type'] == 2){//普通
                    $data['wangwang'] =$objPHPExcel->getActiveSheet()->getCell("J" . $i)->getValue();
                    $data['tbkdurl'] =$objPHPExcel->getActiveSheet()->getCell("K" . $i)->getValue();
                    $data['tbkurl'] =$objPHPExcel->getActiveSheet()->getCell("L" . $i)->getValue();
                    $data['tkl'] =$objPHPExcel->getActiveSheet()->getCell("M" . $i)->getValue();
                    $data['yhj_num'] =$objPHPExcel->getActiveSheet()->getCell("N" . $i)->getValue();
                    $data['yhj_sy_num'] =$objPHPExcel->getActiveSheet()->getCell("O" . $i)->getValue();
                    $data['yhj_price'] =$objPHPExcel->getActiveSheet()->getCell("P" . $i)->getValue();
                    $data['yhj_start_time'] =$objPHPExcel->getActiveSheet()->getCell("Q" . $i)->getValue();
                    $data['yhj_end_time'] =$objPHPExcel->getActiveSheet()->getCell("R" . $i)->getValue();
                    $data['yhj_url'] =$objPHPExcel->getActiveSheet()->getCell("S" . $i)->getValue();
                    $data['yhj_kl'] =$objPHPExcel->getActiveSheet()->getCell("T" . $i)->getValue();
                    $data['yhj_small_url'] =$objPHPExcel->getActiveSheet()->getCell("U" . $i)->getValue();
                    $data['yx'] =$objPHPExcel->getActiveSheet()->getCell("V" . $i)->getValue();
                }else if($_POST['type'] == 3){//高佣金
                    $data['hdsta'] =$objPHPExcel->getActiveSheet()->getCell("J" . $i)->getValue();
                    $data['hdsr'] =$objPHPExcel->getActiveSheet()->getCell("K" . $i)->getValue();
                    $data['hdyj'] =$objPHPExcel->getActiveSheet()->getCell("L" . $i)->getValue();
                    $data['hd_start_time'] =$objPHPExcel->getActiveSheet()->getCell("M" . $i)->getValue();
                    $data['hd_end_time'] =$objPHPExcel->getActiveSheet()->getCell("N" . $i)->getValue();
                    $data['wangwang'] =$objPHPExcel->getActiveSheet()->getCell("O" . $i)->getValue();
                    $data['tbkdurl'] =$objPHPExcel->getActiveSheet()->getCell("P" . $i)->getValue();
                    $data['tbkurl'] =$objPHPExcel->getActiveSheet()->getCell("Q" . $i)->getValue();
                    $data['tkl'] =$objPHPExcel->getActiveSheet()->getCell("R" . $i)->getValue();
                    $data['yhj_num'] =$objPHPExcel->getActiveSheet()->getCell("S" . $i)->getValue();
                    $data['yhj_sy_num'] =$objPHPExcel->getActiveSheet()->getCell("T" . $i)->getValue();
                    $data['yhj_price'] =$objPHPExcel->getActiveSheet()->getCell("U" . $i)->getValue();
                    $data['yhj_start_time'] =$objPHPExcel->getActiveSheet()->getCell("V" . $i)->getValue();
                    $data['yhj_end_time'] =$objPHPExcel->getActiveSheet()->getCell("W" . $i)->getValue();
                    $data['yhj_url'] =$objPHPExcel->getActiveSheet()->getCell("X" . $i)->getValue();
                    $data['yhj_kl'] =$objPHPExcel->getActiveSheet()->getCell("Y" . $i)->getValue();
                    $data['yhj_small_url'] =$objPHPExcel->getActiveSheet()->getCell("Z" . $i)->getValue();
                }
                $data['state'] = '2';
                $data['type'] = $_POST['type'];
                $data['gtype'] = $_POST['gtype'];
                $data['goods_cate_id'] = $_POST['goods_cate_id'];
                $data['time'] = time();
                $addid=M('goods')->add($data);
            }
            if($addid){
                echo 'ok';exit;
            }else{
                echo '导入失败';exit;
            }
        } else {
            echo '请选择导入的文件';exit;
        }
    }
    /*
    *设置商品特卖
    */
    public function good_set_ms(){
        $id = I('post.id','');
        $info = M('goods')->field("ms_sta")->where("id=".$id)->find();
        $data['ms_time']=time();
        $data['ms_sta']='2';
        if($info['ms_sta'] == '3'){
            if(false !== M('goods')->where("id=".$id)->save($data)){
                echo '设置成功';exit;
            }else{
                echo '设置失败';exit;
            }
        }else{
            if(false !== M('goods')->where("id=".$id)->save($data)){
                echo '更新成功';exit;
            }else{
                echo '更新失败';exit;
            }
        }
    }
    /*
    *推荐商品
    */
    public function good_set_tj(){
        $id = I('post.id','');
        $info = M('goods')->field("tj_sta")->where("id=".$id)->find();
        $data['tj_time']=time();
        $data['tj_sta']='2';
        if($info['tj_sta'] == '3'){
            if(false !== M('goods')->where("id=".$id)->save($data)){
                echo '设置成功';exit;
            }else{
                echo '设置失败';exit;
            }
        }else{
            if(false !== M('goods')->where("id=".$id)->save($data)){
                echo '更新成功';exit;
            }else{
                echo '更新失败';exit;
            }
        }
    }
     public function good_list_delete(){
        $id=isset($_POST['id'])?$_POST['id']:'';//单删id
        $Model=M();
        if ($Model->execute("delete from tao_goods where id='{$id}'")) {
            echo "ok";exit;
        }else{
            echo "删除失败";exit;
        }
    }
}