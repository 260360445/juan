<?php if (!defined('THINK_PATH')) exit();?><div class="sun" >
<?php if($comment){?>
    <?php if(is_array($comment)): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="w_calculate_three">
            <div class="w_results_left">
                <div class="w_results_border">
                    <img class="lazy54" data-original="/Uploads<?php echo ($list["photo"]); ?>" src="/Uploads<?php echo ($list["photo"]); ?>" style="display: inline;">
                </div>
                <a><?php echo ($list["nick_name"]); ?></a>
            </div>
            <div class="w_results_right">
                <div class="w_results_top">
                    <a><?php echo date('Y-m-d H:i:s',$list['ptime']);?></a>
                </div>
                <div class="w_results_bottom">
                    <p style="overflow: hidden;text-overflow: ellipsis;width: 740px;display:block;"><?php echo ($list["cont"]); ?></p>
                    <div class="w_imgBorder">
                        
                        <?php
 $img=M('comment_img')->field('showlogo')->where(['cid'=>$list['id']])->select(); ?>  
                        <?php if(is_array($img)): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><a href="javascript:void(0)">
                                <img class="lazy200" data-original="/Uploads<?php echo ($info['showlogo']); ?>" src="/Uploads<?php echo ($info['showlogo']); ?>" style="display: inline;">
                            </a><?php endforeach; endif; else: echo "" ;endif; ?>

                        <div class="w_clear"></div>
                    </div>
                </div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>  
<?php }else{?>
<img src="/Public/Home/static/img/zanwupingjia.png" style="display:block;margin:100px auto;">
<?php }?>
</div>
<div class="pager" id="pages" ><div><?php echo ($page); ?></div></div>