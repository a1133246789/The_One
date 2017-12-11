<?php
// 第一步，在app的前台页面index里 创建一个空间并且给空间定义一个名字
namespace app\home\controller;


use houdunwang\core\Controller;

// 定义一个类文件 起名：Index extends Controller

class Index extends Controller
{
    //定义一个公共的类，给个名字index
    public function index()
    {
        //echo 'index测试1';   //boot.php完成后测试通过
        //1.写完前台的视图文件message.php放置在public/view/里边
        //2.在houdunwang/core/创建Controller.php类
        //3.Index继承Controller类
        //4.测试能否调用Controller类里面message方法
        //链式操作，关键$this->setRedirect ()需要返回$this

        $this->setRedirect()->message('测试');
        //p(u('member/index'));//?s=home/member/index
        //p(u('member'));//?s=home/Index/member
        //p(u('member/Entry/index'));//?s=member/Entry/index

    }

    public function add()
    {
        //$this->setRedirect ()->message('添加成功');
        //$this->setRedirect ('?s=member/mine/index')->message('添加成功');
        //封装一个生成url的函数u
        //u('模块/控制器/方法')----> ?s=member/mine/index
        //p(u('home/index/index'));
        //p(u('index/index'));
        //$this->setRedirect(u('article/add'))->message('添加成功');
    }

}