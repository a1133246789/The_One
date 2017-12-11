<?php
// 给这个空间定义一个名字
namespace houdunwang\core;

/**
 * 这个类是公共的父级类主要作用就是网页的跳转和消息的提示
 */
class Controller
{
    //类中2个方法，方法一是消息提示  $msg
    public function message($msg)
    {
        // 这个公共的方法主要作用有2个
        // 形参的$msg暂时用不上，之后可以作为提示消息使用
        // 方法里边给一个地址，让他可以跳转
        include './view/message.php';

    }

    //类中2个方法，方法二是跳转链接  $url  跳转地址为空''
    public function setRedirect($url = '')
    {
        //判断跳转的地址
        if ($url) {
            //如果赋值了，说明指定了跳转地址
            $this->url = "location.href='$url'";
        } else {
            //如果没赋值，说明没有给跳转地址，默认back
            $this->url = "window.history.back()";
        }
        //反出结果
        return $this;
    }

}