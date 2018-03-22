<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;
class ArticleController extends ComController 
{
  public function __construct(){
    parent::__construct();
  }
  //文章分类
  public function menu(){
  	$name = I('get.name','');
    $cond['pid']=0;
    if ($name != ''){
        $cond['name'] = ['like',"%$name%"];
    }
    $total = M('menu')
        ->where($cond)
        ->count();
    $limit = 10;
    $page = new Page($total,$limit);
    $info = M('menu')
    	->field('id,name,sort,state,addtime')
        ->where($cond)
        ->limit($page->firstRow.','.$limit)
        ->order('sort asc,id asc')
        ->select();
    $html = $page->show();
    $this->assign('page',$html);
    $this->assign('info',$info);
    $this->display();
  }
  //添加子栏目
    public function menu_per_add(){
      if(IS_POST) {
            $menu=M("menu");
    		$data['name']=$_POST['name'];
            $data['sort']=$_POST['sort'];
            $data['pid']=$_POST['pid'];
            $data['state']=$_POST['state'];
            $data['time']=time();
            $addid=$menu->add($data);
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
            $sele=M("menu")->field("id,name")->where("id=".$id)->find();
            $this->assign('sele',$sele);
            $this->display();
         }
    }
    //修改子栏目
    public function menu_per_edit(){
        if (IS_POST){
    		$menu=M("menu");
    		$id = I('post.setid','');
    		$data['name']=$_POST['name'];
            $data['sort']=$_POST['sort'];
            $data['pid']=$_POST['pid'];
            $data['state']=$_POST['state'];
            $data['addtime']=time();
            $addid=$menu->where("id=".$id)->save($data);
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
    		$data=M("menu")->field("id,name,pid,sort,state")->where("id=".$id)->find();
    		//上级分类数据
    		$sele=M("menu")->field("id,name")->where("id=".$pid)->find();
            $this->assign('sele',$sele);
    		$this->assign("infor",$data);
    		$this->display();
    	}
    }    
    /*
    *2017.12.28
    *分类修改
    */
    public function menu_edit(){
    	if (IS_POST){
    		$menu=M("menu");
    		$id = I('post.setid','');
    		$data['name']=$_POST['name'];
            $data['sort']=$_POST['sort'];
            $data['pid']=$_POST['pid'];
            $data['state']=$_POST['state'];
            $data['addtime']=time();
            $addid=$menu->where("id=".$id)->save($data);
            if($addid){
            	echo 'ok';
            	exit;
            }else{
            	echo '修改失败';
            	exit;
            }
    	}else{
    		$id = I('get.id','');
    		$data=M("menu")->field("id,name,sort,state")->where("id=".$id)->find();
    		$this->assign("infor",$data);
    		$this->display();
    	}
    }
  /*
    *2017.12.28
    *分类添加
    */
    public function menu_add(){
    	if (IS_POST){
    		$menu=M("menu");
    		$data['name']=$_POST['name'];
            $data['sort']=$_POST['sort'];
            $data['pid']=$_POST['pid'];
            $data['state']=$_POST['state'];
            $data['addtime']=time();
            $addid=$menu->add($data);
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
    *分类--子类
    */
    #获取下级拼接成相应数据
    public function getJson()
    {
        $id = I('get.id','');
        $level = I('get.level','');
        $now_level = $level + 1;
        $margin = 20 * $now_level;
        $id_arr = M('menu')
            ->field('id')
            ->where(['id'=>$id])
            ->find();
        if (empty($id_arr)){
            echo 'fail';exit;
        }
        $info  = M('menu')
        	->field('id,name,pid,sort,state,addtime')
            ->where(['pid'=>$id_arr['id']])
            ->order("sort asc,id asc")
            ->select();
        $html = '';
        if (!empty($info)){
            foreach ($info as $k => $v)
            {   
                $html .='<tr data-level="2">';
                $html .='<td   style="margin-left: 50px;" scope="row" ><button style="margin-left: 10%;" onclick="categoryson(this)" data-status="plus" data-id="'.$v['id'].'" type="button" class="btn btn-sm btn-default" data-placement="top" data-toggle="tooltip" data-original-title="点击展开"><i class="fa fa-plus" ></i></button></td>';
                $html .='<td>'.$v['id'].'</td>';
                $html .='<td>'.$v['sort'].'</td>';
                $html .='<td align="left" style="padding-left:70px;">├─ '. $v['name'] .'</td>';
                $html .='<td>'.date("Y-m-d H:i:s",$v['addtime']).'</td>';
            	if($v['state'] == 2){
            		$html .='<td><font style="color:green;">开启</font></td>';
            	}else if($v['state'] == 3){
            		$html .='<td><font style="color:red;">关闭</font></td>';
            	}
                $html .='<td >';
                if(strpos($_SESSION['ad']['auth'], 'all') !== false){
                    $html .='<a href="'.U('Article/menu_per_add',['id'=>$v['id'],'pid'=>$id_arr['id']]).'" >添加子类</a>';
                    $html .=' <span >|</span> ';
                    $html .='<a href="'.U('Article/menu_per_edit',['id'=>$v['id'],'pid'=>$id_arr['id']]).'" >修改</a>';
                    $html .=' <span >|</span> ';
                    $html .='<a href="javascript:;"  style="color:#F00;"  onclick="subformone('.$v['id'].')">删除</a>';
                }else{
                    if(strpos($_SESSION['ad']['auth'], 'Article_menu_per_add') !== false){
                        $html .='<a href="'.U('Article/menu_per_add',['id'=>$v['id'],'pid'=>$id_arr['id']]).'" >添加子类</a>';
                        $html .=' <span >|</span> ';
                    }
                    if(strpos($_SESSION['ad']['auth'], 'Article_menu_per_edit') !== false){
                        $html .='<a href="'.U('Article/menu_per_edit',['id'=>$v['id'],'pid'=>$id_arr['id']]).'" >修改</a>';
                        $html .=' <span >|</span> ';
                    }   
                    if(strpos($_SESSION['ad']['auth'], 'Article_menu_per_del') !== false){
                        $html .='<a href="javascript:;"  style="color:#F00;"  onclick="subformone('.$v['id'].')">删除</a>';
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
    public function getJsonSon(){
        $id = I('get.id','');
        $level = I('get.level','');
        $now_level = $level + 1;
        $margin = 20 * $now_level;
        $id_arr = M('menu')
            ->field('id')
            ->where(['id'=>$id])
            ->find();
        if (empty($id_arr)){
            echo 'fail';exit;
        }
        $info  = M('menu')
            ->field('id,name,pid,sort,state,addtime')
            ->where(['pid'=>$id_arr['id']])
            ->order("sort asc,id asc")
            ->select();
        $html = '';
        if (!empty($info)){
            foreach ($info as $k => $v)
            {   
                $html .='<tr >';
                $html .='<td></td>';
                $html .='<td>'.$v['id'].'</td>';
                $html .='<td>'.$v['sort'].'</td>';
                $html .='<td align="left" style="padding-left:100px;">├─ '. $v['name'] .'</td>';
                $html .='<td>'.date("Y-m-d H:i:s",$v['addtime']).'</td>';
                if($v['state'] == 2){
                    $html .='<td><font style="color:green;">开启</font></td>';
                }else if($v['state'] == 3){
                    $html .='<td><font style="color:red;">关闭</font></td>';
                }
                $html .='<td >';
                    if(strpos($_SESSION['ad']['auth'], 'all') !== false){
                        $html .='<a href="'.U('Article/menu_per_edit',['id'=>$v['id'],'pid'=>$id_arr['id']]).'" >修改</a>';
                        $html .=' <span >|</span> ';
                        $html .='<a href="javascript:;"  style="color:#F00;"  onclick="subformone('.$v['id'].')">删除</a>';
                    }else{
                        if(strpos($_SESSION['ad']['auth'], 'Article_menu_per_edit') !== false){
                            $html .='<a href="'.U('Article/menu_per_edit',['id'=>$v['id'],'pid'=>$id_arr['id']]).'" >修改</a>';
                            $html .=' <span >|</span> ';
                        }
                        if(strpos($_SESSION['ad']['auth'], 'Article_menu_per_del') !== false){
                            $html .='<a href="javascript:;"  style="color:#F00;"  onclick="subformone('.$v['id'].')">删除</a>';
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
    public function menu_delete(){
        $id=isset($_POST['id'])?$_POST['id']:'';//单删id
        if ($id!="") {
            $classresult = M('menu')->where("pid = {$id}")->find();
            if ($classresult) {
                echo "分类下有子类不允许删除";
                exit();
            }else{
                $Model=M();
                if ($Model->execute("delete from sc_menu where id='{$id}'")) {
                    echo "ok";exit;
                }else{
                    echo "删除失败";exit;
                }
            }
        }
    }
    //文章管理
    public function article(){
    	$title = I('get.title','');
	    $cond='';
	    if ($title != ''){
	        $cond['title'] = ['like',"%$title%"];
	    }
	    $total = M('menu_text')
	        ->where($cond)
	        ->count();
	    $limit = 10;
	    $page = new Page($total,$limit);
	    $info = M('menu_text')
	    	->field('id,mid,title,cont,time,sta')
	        ->where($cond)
	        ->limit($page->firstRow.','.$limit)
	        ->order('sort desc,id desc')
	        ->select();
	    $html = $page->show();
	    $this->assign('page',$html);
	    $this->assign('info',$info);
	    $this->display();
    }
    //添加文章
    public function article_add(){
    	if (IS_POST){
    		$menu=M("menu_text");
    		$data['title']=$_POST['title'];
            $data['pid']=$_POST['pid'];
            $data['mid']=$_POST['mid'];
            $data['cid']=$_POST['cid'];
            $data['sta']=$_POST['sta'];
            $data['cont'] = stripslashes(htmlspecialchars_decode($_POST['cont']));
            $data['time']=time();
            $addid=$menu->add($data);
            if($addid){
            	echo 'ok';
            	exit;
            }else{
            	echo '添加失败';
            	exit;
            }
    	}else{
    		$menu=M('menu')->field('id,name')->where(['pid'=>0])->select();
    		$this->assign('menu',$menu);
    		$this->display();
    	}
    }
    /*
    *2017.12.28
    *分类修改
    */
    public function article_edit(){
    	if (IS_POST){
    		$menu=M("menu_text");
    		$id = I('post.setid','');
    		$data['title']=$_POST['title'];
            $data['pid']=$_POST['pid'];
            $data['mid']=$_POST['mid'];
            $data['cid']=$_POST['cid'];
            $data['sta']=$_POST['sta'];
            $data['cont'] = stripslashes(htmlspecialchars_decode($_POST['cont']));
            $data['time']=time();
            if(false !== $menu->where(['id'=>$id])->save($data)){
            	echo 'ok';
            	exit;
            }else{
            	echo '修改失败';
            	exit;
            }
    	}else{
    		$id = I('get.id','');
    		$data=M("menu_text")->field("id,title,cont,sta,mid,pid,cid")->where(['id'=>$id])->find();
    		$menu=M('menu')->field('id,name')->where(['pid'=>0])->select();
    		$mtextm=M('menu')->field('id,name')->where(['id'=>$data['mid']])->find();
            $mtextc=M('menu')->field('id,name')->where(['id'=>$data['cid']])->find();
    		$this->assign('menu',$menu);
    		$this->assign('mtextm',$mtextm);
            $this->assign('mtextc',$mtextc);
    		$this->assign("infor",$data);
    		$this->display();
    	}
    }
     public function article_delete(){
        $id=isset($_POST['id'])?$_POST['id']:'';//单删id
        if ($id!="") {
            $Model=M();
            if ($Model->execute("delete from sc_menu_text where id='{$id}'")) {
                echo "ok";exit;
            }else{
                echo "删除失败";exit;
            }
        }
    }
    public function getmenu(){
        $menu=M("menu");
        $mid=I('post.mid','');
        $data=$menu->where(['pid'=>$mid])->select();
        echo json_encode($data);
        exit;
    }
    public function getmenuc(){
        $menu=M("menu");
        $cid=I('post.cid','');
        $data=$menu->where(['pid'=>$cid])->select();
        echo json_encode($data);
        exit;
    }
}


  