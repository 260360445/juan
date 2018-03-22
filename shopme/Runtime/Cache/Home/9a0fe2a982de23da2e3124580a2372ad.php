<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en" class="fixed">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>套包管理</title>
    <link rel="apple-touch-icon" sizes="120x120" href="/Public/Admin/favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/Public/Admin/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/Public/Admin/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/Public/Admin/favicon/favicon-16x16.png">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/stylesheets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/stylesheets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/Admin/vendor/animate.css/animate.css">
    <link rel="stylesheet" href="/Public/Admin/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="/Public/Admin/stylesheets/css/style.css">
</head>
<body>
<div class="wrap">
    <div class="page-header">
        <div class="leftside-header">
            
            <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open" data-target="html">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>
        <div class="rightside-header">
            <div class="header-middle"></div>
            <div class="header-section" id="user-headerbox">
                <div class="user-header-wrap">
                    
                    <div class="user-info">
                        <span class="user-name"><?php echo $_SESSION['ad']['account']?></span>
                        <!-- <span class="user-profile">Admin</span> -->
                    </div>
                    <i class="fa fa-plus icon-open" aria-hidden="true"></i>
                    <i class="fa fa-minus icon-close" aria-hidden="true"></i>
                </div>
                <div class="user-options dropdown-box">
                    <div class="drop-content basic">
                        <ul>
                            <li> <a href="<?php echo U('Pass/pass');?>"><i class="fa fa-lock" aria-hidden="true"></i> 修改密码</a></li>
                            <li><a href="<?php echo U('Login/logout');?>"><i class="fa fa-cog" aria-hidden="true"></i>退出</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header-separator"></div>
            <div class="header-section">
                <a href="<?php echo U('Login/logout');?>"><i class="fa fa-sign-out log-out" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="left-sidebar">
    <div class="left-sidebar-header">
        <div class="left-sidebar-title">管理中心</div>
        <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
            <span></span>
        </div>
    </div>
    <div id="left-nav" class="nano">
        <div class="nano-content">
            <nav>
                <ul class="nav" id="main-nav">
                    <?php
 if(ACTION_NAME=="index") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                      <a href="<?php echo U('Index/index');?>"><i class="fa fa-home" aria-hidden="true"></i><span>首页</span></a>
                    </li>
                  <?php if(stripos($_SESSION['ad']['auth'],'all') !== false): if(CONTROLLER_NAME=="Basic") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a><i class="fa fa-bars" aria-hidden="true"></i><span>基本设置</span></a>
                        <ul class="nav child-nav level-1">
                            <?php
 if(ACTION_NAME=="infor") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Basic/infor');?>">基本信息管理</a>
                            </li>
                            <!-- <li class="has-child-item close-item">
                                <a>支付管理</a>
                                <ul class="nav child-nav level-2 ">
                                    <li><a href="">微信</a></li>
                                    <li><a href="">支付宝</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </li>
                    <?php
 if(CONTROLLER_NAME=="Admin") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>管理设置</span></a>
                        <ul class="nav child-nav level-1">
                            <!-- <li><a href="#">权限管理</a></li> -->
                            <?php
 if(ACTION_NAME=="admin") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Admin/admin');?>">管理员管理</a>
                            </li>
                        </ul>
                    </li>
                    <?php
 if(CONTROLLER_NAME=="Article") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a><i class="fa fa-columns" aria-hidden="true"></i><span>文章设置</span></a>
                        <ul class="nav child-nav level-1">
                            <?php
 if(ACTION_NAME=="menu") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Article/menu');?>">分类管理</a>
                            </li>
                            <?php
 if(ACTION_NAME=="article") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Article/article');?>">文章管理</a>
                            </li>
                        </ul>
                    </li>
                    <?php
 if(CONTROLLER_NAME == "Banner") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a><i class="fa fa-image" aria-hidden="true"></i><span>轮播设置</span></a>
                        <ul class="nav child-nav level-1">
                            <li class="active-item"><a href="<?php echo U('Banner/ban');?>">轮播管理</a></li>
                        </ul>
                    </li>
                    <?php
 if(CONTROLLER_NAME == "Good") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a><i class="fa fa-cubes" aria-hidden="true"></i><span>商品设置</span></a>
                        <ul class="nav child-nav level-1">
                            <?php
 if(ACTION_NAME=="goods_cate_list") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Good/goods_cate_list');?>">分类管理</a>
                            </li>
                            <?php
 if(ACTION_NAME=="goods_list") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Good/goods_list');?>">商品管理</a>
                            </li>
                        </ul>
                    </li>
                    <?php
 if(CONTROLLER_NAME == "User") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a><i class="fa fa-user" aria-hidden="true"></i><span>会员设置</span></a>
                        <ul class="nav child-nav level-1">
                            <?php
 if(ACTION_NAME=="user") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('User/user');?>">会员管理</a>
                            </li>
                            <?php
 if(ACTION_NAME=="address") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('User/address');?>">地址管理</a>
                            </li>
                        </ul>
                    </li>
                    <?php
 if(CONTROLLER_NAME == "Merchant") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a>
                            <i class="fa fa-magic" aria-hidden="true"></i>
                            <span>商家设置</span>
                        </a>
                        <ul class="nav child-nav level-1">
                            <li class="active-item"><a href="<?php echo U('Merchant/merchant');?>" >商家管理</a></li>  
                        </ul>
                    </li>
                    <?php
 if(CONTROLLER_NAME == "Bao") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a>
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                            <span>套包设置</span>
                        </a>
                        <ul class="nav child-nav level-1">
                            <li class="active-item"><a href="<?php echo U('Bao/baolist');?>" >套包管理</a></li>  
                        </ul>
                    </li>
                    <?php
 if(CONTROLLER_NAME == "Packet") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a>
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                            <span>提现设置</span>
                        </a>
                        <ul class="nav child-nav level-1">
                            <?php
 if(ACTION_NAME=="chu") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Packet/chu');?>" >提现初审</a>
                            </li>
                            <?php
 if(ACTION_NAME=="shen") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Packet/shen');?>" >提现审核</a>
                            </li> 
                            <?php
 if(ACTION_NAME=="log") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Packet/log');?>" >提现记录</a>
                            </li> 
                        </ul>
                    </li>
                    <?php
 if(CONTROLLER_NAME == "Statistics") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a>
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            <span>数据统计</span>
                        </a>
                        <ul class="nav child-nav level-1">
                            <?php
 if(ACTION_NAME=="tilog") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Statistics/tilog');?>" >提现统计</a>
                            </li>
                            <?php
 if(ACTION_NAME=="transfer") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Statistics/transfer');?>" >转账统计</a>
                            </li> 
                            <?php
 if(ACTION_NAME=="bill") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Statistics/bill');?>" >财务统计</a>
                            </li> 
                        </ul>
                    </li>
                  <?php else: ?>
                  <?php if(stripos($_SESSION['ad']['auth'],'Basic') !== false): if(CONTROLLER_NAME=="Basic") {echo '<li class="has-child-item open-item" style="display:none;">';} else {echo '<li class="has-child-item close-item"  style="display:none;">';} ?>
                        <a><i class="fa fa-bars" aria-hidden="true"></i><span>基本设置</span></a>
                        <ul class="nav child-nav level-1">
                          <if condition="stripos($_SESSION['ad']['auth'],'Basic_infor') nheq false">
                            <?php
 if(ACTION_NAME=="infor") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Basic/infor');?>">基本信息管理</a>
                            </li><?php endif; ?>
                        </ul>
                    </li><?php endif; ?>
                  <?php if(stripos($_SESSION['ad']['auth'],'Basic') !== false): if(CONTROLLER_NAME=="Basic") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a><i class="fa fa-bars" aria-hidden="true"></i><span>基本设置</span></a>
                        <ul class="nav child-nav level-1">
                          <?php if(stripos($_SESSION['ad']['auth'],'Basic_infor') !== false): if(ACTION_NAME=="infor") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Basic/infor');?>">基本信息管理</a>
                            </li><?php endif; ?>
                            <!-- <li class="has-child-item close-item">
                                <a>支付管理</a>
                                <ul class="nav child-nav level-2 ">
                                    <li><a href="">微信</a></li>
                                    <li><a href="">支付宝</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </li><?php endif; ?>
                  <?php if(stripos($_SESSION['ad']['auth'],'Article') !== false): if(CONTROLLER_NAME=="Article") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a><i class="fa fa-columns" aria-hidden="true"></i><span>文章设置</span></a>
                        <ul class="nav child-nav level-1">
                          <?php if(stripos($_SESSION['ad']['auth'],'Article_menu') !== false): if(ACTION_NAME=="menu") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Article/menu');?>">分类管理</a>
                            </li><?php endif; ?>
                          <?php if(stripos($_SESSION['ad']['auth'],'Article_article') !== false): if(ACTION_NAME=="article") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Article/article');?>">文章管理</a>
                            </li><?php endif; ?>
                        </ul>
                    </li><?php endif; ?>
                  <?php if(stripos($_SESSION['ad']['auth'],'Banner') !== false): if(CONTROLLER_NAME == "Banner") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a><i class="fa fa-image" aria-hidden="true"></i><span>轮播设置</span></a>
                        <ul class="nav child-nav level-1">
                          <?php if(stripos($_SESSION['ad']['auth'],'Banner_ban') !== false): ?><li class="active-item"><a href="<?php echo U('Banner/ban');?>">轮播管理</a></li><?php endif; ?>
                        </ul>
                    </li><?php endif; ?>
                  <?php if(stripos($_SESSION['ad']['auth'],'Good') !== false): if(CONTROLLER_NAME == "Good") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a><i class="fa fa-cubes" aria-hidden="true"></i><span>商品设置</span></a>
                        <ul class="nav child-nav level-1">
                          <?php if(stripos($_SESSION['ad']['auth'],'Good_goods_cate_list') !== false): if(ACTION_NAME=="goods_cate_list") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Good/goods_cate_list');?>">分类管理</a>
                            </li><?php endif; ?>
                          <?php if(stripos($_SESSION['ad']['auth'],'Good_goods_list') !== false): if(ACTION_NAME=="goods_list") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('Good/goods_list');?>">商品管理</a>
                            </li><?php endif; ?>
                        </ul>
                    </li><?php endif; ?>
                  <?php if(stripos($_SESSION['ad']['auth'],'User') !== false): if(CONTROLLER_NAME == "User") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a><i class="fa fa-user" aria-hidden="true"></i><span>会员设置</span></a>
                        <ul class="nav child-nav level-1">
                          <?php if(stripos($_SESSION['ad']['auth'],'User_user') !== false): if(ACTION_NAME=="user") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('User/user');?>">会员管理</a>
                            </li><?php endif; ?>
                          <?php if(stripos($_SESSION['ad']['auth'],'User_address') !== false): if(ACTION_NAME=="address") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                                <a href="<?php echo U('User/address');?>">地址管理</a>
                            </li><?php endif; ?>
                        </ul>
                    </li><?php endif; ?>
                  <?php if(stripos($_SESSION['ad']['auth'],'Merchant') !== false): if(CONTROLLER_NAME == "Merchant") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a>
                            <i class="fa fa-magic" aria-hidden="true"></i>
                            <span>商家设置</span>
                        </a>
                        <ul class="nav child-nav level-1">
                          <?php if(stripos($_SESSION['ad']['auth'],'Merchant_merchant') !== false): ?><li class="active-item"><a href="<?php echo U('Merchant/merchant');?>" >商家管理</a></li><?php endif; ?>
                        </ul>
                    </li><?php endif; ?>
                  <?php if(stripos($_SESSION['ad']['auth'],'Bao') !== false): if(CONTROLLER_NAME == "Bao") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a>
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                            <span>套包设置</span>
                        </a>
                        <ul class="nav child-nav level-1">
                          <?php if(stripos($_SESSION['ad']['auth'],'Bao_baolist') !== false): ?><li class="active-item"><a href="<?php echo U('Bao/baolist');?>" >套包管理</a></li><?php endif; ?> 
                        </ul>
                    </li><?php endif; ?>
                  <?php if(stripos($_SESSION['ad']['auth'],'Packet') !== false): if(CONTROLLER_NAME == "Packet") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a>
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                            <span>提现设置</span>
                        </a>
                        <ul class="nav child-nav level-1">
                          <?php if(stripos($_SESSION['ad']['auth'],'Packet_chu') !== false): if(ACTION_NAME=="chu") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Packet/chu');?>" >提现初审</a>
                            </li><?php endif; ?>
                          <?php if(stripos($_SESSION['ad']['auth'],'Packet_shen') !== false): if(ACTION_NAME=="shen") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Packet/shen');?>" >提现审核</a>
                            </li><?php endif; ?>
                          <?php if(stripos($_SESSION['ad']['auth'],'Packet_log') !== false): if(ACTION_NAME=="log") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Packet/log');?>" >提现记录</a>
                            </li><?php endif; ?>
                        </ul>
                    </li><?php endif; ?>
                  <?php if(stripos($_SESSION['ad']['auth'],'Statistics') !== false): if(CONTROLLER_NAME == "Statistics") {echo '<li class="has-child-item open-item">';} else {echo '<li class="has-child-item close-item">';} ?>
                        <a>
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            <span>数据统计</span>
                        </a>
                        <ul class="nav child-nav level-1">
                          <?php if(stripos($_SESSION['ad']['auth'],'Statistics_tilog') !== false): if(ACTION_NAME=="tilog") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Statistics/tilog');?>" >提现统计</a>
                            </li><?php endif; ?>
                          <?php if(stripos($_SESSION['ad']['auth'],'Statistics_transfer') !== false): if(ACTION_NAME=="transfer") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Statistics/transfer');?>" >转账统计</a>
                            </li><?php endif; ?>
                          <?php if(stripos($_SESSION['ad']['auth'],'Statistics_bill') !== false): if(ACTION_NAME=="bill") {echo '<li class="active-item">';} else {echo '<li>';} ?>
                              <a href="<?php echo U('Statistics/bill');?>" >财务统计</a>
                            </li><?php endif; ?>
                        </ul>
                    </li><?php endif; ?>
                  </if>
                </ul>
            </nav>
        </div>
    </div>
</div> 
        <div class="content">
            <div class="content-header">
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">套包设置</a></li>
                        <li><a>套包管理</a></li>
                    </ul>
                </div>
            </div>
            <div class="row animated fadeInRight">
                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                            <div class="col-sm-6">
                            <div id="basic-table_filter" class="dataTables_filter">
                                <div class="form-horizontal form-stripe"   id="seachForm">
                                    <label style="display: -webkit-box;"><input type="search" style="width:200px;" class="form-control input-sm" placeholder="用户手机" name="mob" id="seachname" aria-controls="basic-table" value="<?php echo $_GET['mob']?>"> &nbsp;&nbsp;<button class="btn btn-primary" onclick="cha()" type="button">确定</button></label>
                                </div>
                            </div>
                            </div>
                                <table class="table table-striped table-hover table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th >订单号</th>
                                        <th >用户</th>
                                        <th >金额</th>
                                        <th >类型</th>
                                        <th >状态</th>
                                        <th >时间</th>
                                        <th >操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
                                        <td><?php echo ($list["number"]); ?></td>
                                        <td><?php echo ($list["mobile"]); ?></td>
                                        <td><?php echo ($list["money"]); ?></td>
                                        <td>
                                            <?php if($list[type] == 2): ?>正式会员
                                            <?php elseif($list[type] == 3): ?>
                                              银卡会员
                                            <?php elseif($list[type] == 4): ?>
                                              金卡会员
                                            <?php elseif($list[type] == 5): ?>
                                              钻石会员<?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($list[status] == 2): ?><font style="color:#dd2726;">待付款</font>
                                            <?php elseif($list[status] == 3): ?>
                                              <font style="color:green;">已付款</font>
                                              <?php elseif($list[status] == 5): ?>
                                              <font style="color:green;">已使用</font>
                                            <?php elseif($list[status] == 6): ?>
                                              <font style="color:#999;">已作废</font><?php endif; ?>
                                        </td>
                                        <td><?php echo date('Y-m-d H:i:s',$list[buy_time]);?></td>
                                        <td>
                                            <?php if($list[status] == 2): if(stripos($_SESSION['ad']['auth'],'all') !== false): ?><a href="javascript:setType(<?php echo ($list["id"]); ?>);">
                                                        修改状态
                                                    </a>
                                                <?php else: ?>
                                                    <?php if(stripos($_SESSION['ad']['auth'],'bao_info_set') !== false): ?><a href="javascript:setType(<?php echo ($list["id"]); ?>);">
                                                            修改状态
                                                        </a><?php endif; endif; ?>
                                            <?php elseif($list[status] == 3): ?>
                                                <font style="color:green;">已付款</font>
                                                  <?php elseif($list[status] == 5): ?>
                                                  <font style="color:green;">已使用</font>
                                            <?php elseif($list[status] == 6): ?>
                                                已作废<?php endif; ?>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-7">
                                    <ul class="pagination">
                                    <li id="page"><?php echo ($page); ?></li> 
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-sidebar">
            <div class="right-sidebar-toggle" data-toggle-class="right-sidebar-opened" data-target="html">
                <i class="fa fa-cog fa-spin" aria-hidden="true"></i>
            </div>
            <div id="right-nav" class="nano">
                <div class="nano-content">
                    <div class="template-settings">
                        <h4 class="text-center">Template Settings</h4>
                        <ul class="toggle-settings pv-xlg">
                            <li>
                                <h6 class="text">Header fixed</h6>
                                <label class="switch">
                                    <input id="header-fixed" type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li>
                                <h6 class="text">Left sidebar fixed</h6>
                                <label class="switch">
                                    <input id="left-sidebar-fixed" type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li>
                                <h6 class="text">Left sidebar collapsed</h6>
                                <label class="switch">
                                    <input id="left-sidebar-collapsed" type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li>
                                <h6 class="text">Content header fixed</h6>
                                <label class="switch">
                                    <input id="content-header-fixed" type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </li>
                        </ul>
                        <!-- <h4 class="text-center">Template Colors</h4>
                        <ul class="toggle-colors">
                            <li>
                                <a href="index.html" class="on-click"> <img alt="Helsinki-green" src="/Public/Admin/images/helsinki-green.png" /></a>
                            </li>
                            <li>
                                <a href="../helsinki-light/index.html" class="on-click"> <img alt="Helsinki-light" src="/Public/Admin/images/helsinki-light.png" /></a>
                            </li>
                            <li>
                                <a href="../helsinki-blue/index.html" class="on-click"> <img alt="Helsinki-blue" src="/Public/Admin/images/helsinki-blue.png" /></a>
                            </li>
                            <li>
                                <a href="../helsinki-red/index.html" class="on-click"> <img alt="Helsinki-red" src="/Public/Admin/images/helsinki-red.png" /></a>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
</div>
<script src="/Public/Admin/javascripts/jquery.min.js"></script>
<script src="/Public/Admin/javascripts/layer/layer.js"></script>
<script src="/Public/Admin/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/Public/Admin/vendor/nano-scroller/nano-scroller.js"></script>
<script src="/Public/Admin/javascripts/template-script.min.js"></script>
<script src="/Public/Admin/javascripts/template-init.min.js"></script>
</body>
<script>
    function cha(){
        var mob=$("#seachname").val();
        if(mob){
            window.location.href="<?php echo U(MODULE_NAME.'/Bao/baolist/mob/"+mob+"');?>";
        }else{
            window.location.href="<?php echo U('Bao/baolist');?>";
        }
    }
    function setType(id){
    var url = "<?php echo U('Bao/setType');?>";
    layer.confirm('您确定要修改支付状态吗？', {
      btn: ['已付款','作废'] //按钮
    }, function(){
        $.ajax({
            type : 'post',
            url : url,
            data : {id:id,type:1},
            error : function () {
                layer.msg('网络故障，请稍后重试!',{offset: '300px',time: 1500,icon: 7});
            },
            success : function (responses) {
                if (responses.msg == 'ok'){
                    layer.msg('设置成功',{offset: '300px',time: 1500,icon: 1},function () {
                       window.location.reload();
                    });
                }else{
                    layer.msg(responses.msg,{offset: '300px',time: 1500,icon: 2});
                }
            }
        });
    }, function(){
        $.ajax({
            type : 'post',
            url : url,
            data : {id:id,type:2},
            error : function () {
                layer.msg('网络故障，请稍后重试!',{offset: '300px',time: 1500,icon: 7});
            },
            success : function (responses) {
                if (responses.msg == 'ok'){
                    layer.msg('设置成功',{offset: '300px',time: 1500,icon: 1},function () {
                       window.location.reload();
                    });
                }else{
                    layer.msg(responses.msg,{offset: '300px',time: 1500,icon: 2});
                }
            }
        });
    });
}
    //删除
    function subformone(id){
        var url = "<?php echo U('Good/good_list_delete');?>";
        var id=id;
        layer.confirm('您确定要删除吗？', {
          btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                type : 'post',
                url : url,
                data : {id:id},
                error : function () {
                    layer.msg('网络故障，请稍后重试!',{offset: '300px',time: 1500,icon: 7});
                },
                success : function (responses) {
                    if (responses == 'ok'){
                        layer.msg('修改成功',{offset: '300px',time: 1500,icon: 1},function () {
                           window.location.href = "<?php echo U('Good/goods_cate_list');?>";
                        });
                    }else{
                        layer.msg(responses,{offset: '300px',time: 1500,icon: 2});
                    }
                }
            });
        });
    }
</script>
<script type="text/javascript">
$(function(){
    window.onkeydown=function(event){
    　　if(event.keyCode == 13){
    　　　　cha();
    　　}
    };
})
</script>
</html>