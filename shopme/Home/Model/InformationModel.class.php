<?php
namespace Home\Model;
use Think\Model;

class IformationModel extends Model{
	protected $_validate = array(
	 array('url','9,10','长度是9-20个字符',0,'length'), //默认情况下用正则进行验证
	 array('name','2,10','长度是2-10个汉字或字符',0,'length'), //默认情况下用正则进行验证
	 array('smallame','2,6','长度是2-6个汉字或字符',0,'length'), //默认情况下用正则进行验证
	 array('keyword','2,20','长度是2-20个汉字或字符',0,'length'), //默认情况下用正则进行验证
	 array('describe','2,200','长度是2-50个汉字或字符',0,'length'), //默认情况下用正则进行验证
	 array('copyright','2,30','长度是2-30个汉字或字符',0,'length'), //默认情况下用正则进行验证

	 );
}