<?php
namespace Home\Controller;
use Think\Controller;
class HelpController extends ComController{
    #首页展示
    public function help(){
        
        //按照分类循环
        $menu = M("menu")->where(['state'=>2])->where('id != 123')->order('sort asc,id asc')->select();
        $tree = $this->getTreeArc($menu,0);
        $this->assign('tree',$tree);
        //查找常见问题--在p和m 等于空的情况下 默认查找常见问题
        $p=I('get.p','');
        $m=I('get.m','');
        if($p != '' && $m != ''){
            $menuarr = M('menu_text')->field("cid")->where(['pid'=>$p,'mid'=>$m])->order('sort desc')->limit(1)->find();
            $where=['pid'=>$p,'mid'=>$m,'cid'=>$menuarr['cid'],'sta'=>2];
            $wheres=['pid'=>$m,'sta'=>2];
        }else{
            $where=['pid'=>87,'mid'=>93,'cid'=>109,'sta'=>2];
            $wheres=['pid'=>93,'sta'=>2];
        }

        $menum = M("menu")->where($wheres)->order('sort asc,id asc')->select();
        $this->assign('menum',$menum);
        $menuarr = M('menu_text')->field("id,title,cont,cid")->where($where)->order('sort desc')->select();
        $this->assign('menuarr',$menuarr);
    	$this->display();
    }
    public function sonlist(){
        $cid=I("post.typeId","");
        $menu_text = M('menu_text');
        $menuarr = $menu_text->field("id,title,cont,cid")->where(['cid'=>$cid,'sta'=>2])->order('sort desc')->select();
        $this->ajaxReturn($menuarr);exit;
    }
}
