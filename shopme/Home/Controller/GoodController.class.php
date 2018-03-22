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
    //添加子栏目
    public function goods_cate_per_add(){
      if(IS_POST) {
            if(!empty($_FILES['pic']['name'])){
                $dir=date("Ymd",time());
                $saveName=date("Ymd",time()).$this->_randStr(4,1);
                $saveExtStr=explode('/',$_FILES['pic']['type']);
                $saveExt=$saveExtStr[1];
                $logo=$this->_createThumImg('pic', 'Goods/'.$dir, $saveName, $saveExt);
                if($logo['tag'] == '1'){
                    echo '图片大小不得超过3MB';exit;
                }else if($logo['tag'] == '2'){
                    echo '文件格式不正确';exit;
                }else if($logo['tag'] == '3'){
                    echo '系统繁忙,请稍后再试';exit;
                }else if($logo['tag'] == '4'){
                    $data['pic']=$logo['con'];
                }    
            }
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
             //循环下拉分类
         	$id = I('get.id','');
            $sele=M("goods_class")->field("goods_class_id,name")->where("goods_class_id=".$id)->find();
            $this->assign('sele',$sele);
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
    //修改子栏目
    public function goods_cate_per_edit(){
        if (IS_POST){
    		$goods_class=M("goods_class");
    		$id = I('post.setid','');
            if(!empty($_FILES['pic']['name'])){
                $dir=date("Ymd",time());
                $saveName=date("Ymd",time()).$this->_randStr(4,1);
                $saveExtStr=explode('/',$_FILES['pic']['type']);
                $saveExt=$saveExtStr[1];
                $logo=$this->_createThumImg('pic', 'Goods/'.$dir, $saveName, $saveExt);
                if($logo['tag'] == '1'){
                    echo '图片大小不得超过3MB';exit;
                }else if($logo['tag'] == '2'){
                    echo '文件格式不正确';exit;
                }else if($logo['tag'] == '3'){
                    echo '系统繁忙,请稍后再试';exit;
                }else if($logo['tag'] == '4'){
                    $data['pic']=$logo['con'];
                }    
            }else{
                $logo=$goods_class->field("pic")->where("goods_class_id=".$id)->find();
                $data['pic']=$logo['pic'];
            }
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
    		$pid = I('get.pid','');
    		//自己的数据
    		$data=M("goods_class")->field("goods_class_id,name,pic,sort,state")->where("goods_class_id=".$id)->find();
    		//上级分类数据
    		$sele=M("goods_class")->field("goods_class_id,name")->where("goods_class_id=".$pid)->find();
            $this->assign('sele',$sele);
    		$this->assign("infor",$data);
    		$this->display();
    	}
    }    
    /*
    *2017.12.28
    *明明
    *分类--子类
    */
    #获取下级拼接成相应数据
    public function getJson()
    {
        $id = I('get.id','');
        $level = I('get.level','');
        $now_level = $level + 1;
        $margin = 20 * $now_level;
        $id_arr = M('goods_class')
            ->field('goods_class_id')
            ->where(['goods_class_id'=>$id])
            ->find();
        if (empty($id_arr)){
            echo 'fail';exit;
        }
        $info  = M('goods_class')
        	->field('goods_class_id,name,pic,pid,sort,state,time')
            ->where(['pid'=>$id_arr['goods_class_id']])
            ->order("sort asc,goods_class_id asc")
            ->select();
        $html = '';
        if (!empty($info)){
            foreach ($info as $k => $v)
            {   
                $html .='<tr >';
                $html .='<td ><img style="width:50px;height:50px;" src="/Uploads'.$v['pic'].'""></td>';
                $html .='<td>'.$v['sort'].'</td>';
                $html .='<td>'.$v['goods_class_id'].'</td>';
                $html .='<td align="left" style="padding-left: 40px;">├─ '. $v['name'] .'</td>';
                $html .='<td>'.date("Y-m-d H:i:s",$v['time']).'</td>';
                $html .='<td >';
                if(strpos($_SESSION['ad']['auth'], 'all') !== false){
                    $html .='<a href="'.U('Good/goods_cate_per_edit',['id'=>$v['goods_class_id'],'pid'=>$id_arr['goods_class_id']]).'" >修改</a>';
                    $html .=' <span >|</span> ';
                    $html .='<a href="javascript:void(0);"  style="color:#F00;"  onclick="subformone('.$v['goods_class_id'].')">删除</a>';
                }else{
                    if(strpos($_SESSION['ad']['auth'], 'Good_goods_cate_per_edit') !== false){
                        $html .='<a href="'.U('Good/goods_cate_per_edit',['id'=>$v['goods_class_id'],'pid'=>$id_arr['goods_class_id']]).'" >修改</a>';
                        $html .=' <span >|</span> ';
                    }
                    if(strpos($_SESSION['ad']['auth'], 'Good_goods_cate_per_del') !== false){
                        $html .='<a href="javascript:void(0);"  style="color:#F00;"  onclick="subformone('.$v['goods_class_id'].')">删除</a>';
                    }
                }
                $html .='</td>';
                $html .='</tr>';
            }
            echo $html;exit;
        }else{
            echo 'fail';exit;
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
            $cond['goods_title'] = ['like',"%$title%"];
        }
        $total = M('goods')
            ->where($cond)
            ->count();
        $limit = 10;
        $page = new Page($total,$limit);
        $info = M('goods')
            ->field("id,goods_title,sid,goods_cate_id,goods_logo,goods_time,tm,xp,price,money,sta")
            ->where($cond)
            ->limit($page->firstRow.','.$limit)
            ->order('id desc')
            ->select();
        $html = $page->show();
        $this->assign('page',$html);
        $this->assign('info',$info);
        $this->display();
    }
    /*
    *设置商品特卖
    */
    public function good_set_tm(){
        $id = I('post.id','');
        $info = M('goods')->field("tm")->where("id=".$id)->find();
        $data['tm_time']=time();
        $data['tm']='2';
        if($info['tm'] == '3'){
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
    *设置商品新品上架
    */
    public function good_set_XP(){
        $id = I('post.id','');
        $info = M('goods')->field("xp")->where("id=".$id)->find();
        $data['xp_time']=time();
        $data['xp']='2';
        if($info['xp'] == '3'){
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
        if ($id!="") {
            $where['state']=['in','2,3,5'];
            $result = M('order')->field('order_id')->where(['gid'=>$id,$where])->select();
            if ($result) {
                echo "该商品有订单未处理完成，不允许删除！";
                exit();
            }else{
                $Model=M();
                if ($Model->execute("delete from sc_goods where id='{$id}'")) {
                    echo "ok";exit;
                }else{
                    echo "删除失败";exit;
                }
            }
        }
    }
}