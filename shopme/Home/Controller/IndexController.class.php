<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends ComController 
{
  public function __construct(){
    parent::__construct();
  }
  public function index()
  {
    $this->display();
  }
}
