<?php
//********************************************************************************************
//  第一步 给这个空间起个名字
//  namespace 空间
//  houdunwang\cor 名字
namespace houdunwang\core;


//********************************************************************************************
use app\home\controller\Index;

/**
 * 这是启动类  通过大总管public内的index.php加载进行关联
 * 给类顶一个名称 Boot
 */
class Boot
{
    //定义一个公共属性public 使用静态的方法 加载 run这个属性
    public static function run()
    {
        //**********第一步目标，实现在打开public中的index.php文件可以输出这个ehco*************/
        //echo 1;  //报错未找见类
        //**********第二步目标，换个方法，加载加载助手函数库**********************************/
        // 把助手函数库 helper.php放置在system文件夹内
        //让composer自动加载文件：修改conposer.json配置文件：autoload里面files:system/helper.php
        //需要在终端执行composer dump 重新加载
        //p(1);
        /*******打印成功，有P打印样式********/
        //**********第三步目标执行初始化的动作库**********************************************/
        //静态加载self::    //  init()初始化函数使用
        self::init();
        //*********************************分界线********************************************/
        //首先app/home/controller/创建一个类文件Index.php
        //然后测试Index.php类是否能加载到
        //这里注意使用user导入命名空间(在该文件最上面)
        //这个时候并不能实力化到类，会报错
        //修改composer配置文件，app增加到psr-4里面，然后执行composer dump

        // (new Index())->index();

        //这里创建app/home/controller，创建两个类
        //这里创建app/member/controller，创建1个类
        //用来作测试用
//        (new \app\home\controller\Index())->index();
//        echo '<br>';
//        (new \app\home\controller\Article())->index();
//        echo '<br>';
//        (new \app\member\controller\Mine())->index();
//        echo '<br>';
        //测试结果：
//        index测试1
//        Article测试1
//        member测试1
        //*********************************GET****************************************/
        //通过get参数来控制访问的模块、控制器类、方法：?c=Index&a=index&m=home
        //这里get参数样子换种写法：?s=模块/控制器/方法(?s=home/Index/index),我们按照这种方式来处理

        //进行if判断进行协助看是否可以获得get参数,
        //之后通过get参数的home/article/index(模块、控制器类、方法)进行处理
        if (isset($_GET['s'])) {
            //在地址栏输入?c=Index&a=index&m=home时可以看见路径地址home/article/index
            $s = $_GET['s'];
            //p($_GET['s']);die; 测试通过home/article/index
            // 把变量$s处理转化为数组,用一个新变量进行接收          //************************//
            // explode()把字符串打散为数组                         //* 每次测试结果的时候输入*//
            $info = explode('/', $s);                             //* ?s=home/article/index*//
            //测试新变量的格式                                     //************************//
            //p($info);die;  //结果： 有数组3个，0，1，2
//           Array (
//            [0] => home
//            [1] => article
//            [2] => index
//            )
            //定义3个变量用来接收数组格式的变量$info下的数组0，1，2
            $m = $info[0];//赋值数组0，模块项
            $c = ucfirst($info[1]);//赋值数组1，控制器类,首字母大写，因为他是类名字
            $a = $info[2];//赋值数组2，方法项{public}

            //****************知识点A*********************
            //ucfirst()把首字符转换为大写：
            //lcfirst() - 把字符串中的首字符转换为小写
            //strtolower() - 把字符串转换为小写
            //strtoupper() - 把字符串转换为大写
            //ucwords() - 把字符串中每个单词的首字符转换为大写
            //****************知识点B**********************
        } else {
            //不存在参数的时候给默认值
            $m = 'home';
            $c = 'Index';
            $a = 'index';
            //因为默认的地址还未存在这3个变量，所以打印其中1个并且刷新页面
            //p($a);die; // 测试结果 index  成功
        }
        // 把之前接收到数组的3个变量全部都定义为常量，常量的好处就是可以用作用全局
        //定义常量,为了在后面是使用的时候比较方便，以为define定义的常量可以不受命名空间限制[课件]
        define('MODULE', $m);
        define('CONTROLLER', $c);
        define('ACTION', $a);
        //定义一个新的变量用来就收：app文件夹/模块项/文件夹/方法项
        // 赋值的地址中模块箱和方法项可以改变，也就是文件夹可以使用的类可以做出边
        // 在这个里边的controller 不能改变，因为系统识别的默认文件名就是这个，改变不能识别

        //定义一个新变量$controller 用来接收路径，路径=app文件/模块/controller系统识别文件/方法
        $controller = "\app\\{$m}\controller\\{$c}";


        //****************************************************************
        // new一个新的类，赋值给方法
        //(new $controller)->$a();
        //下面这句话，就相当于上面这句
        //new $controller这个类，调用$a,并且把该函数的第二个参数作为$a方法的参数
        //call_user_func_array — 调用回调函数，并把一个数组参数作为回调函数的参数
        call_user_func_array([new $controller, $a], []);
        //接下来，我们构建MVC中的C就是controler
        //接下来在app/home/controller/Index.php文件中进行测试
        //****************************************************************
        //打开任意一个都可以正常输出页面，但是因为方法是抓的ID，所以只有一个可以输出
        //****************************************************************

    }

    /*
     * 初始化类init
     */
    public static function init()
    {
        //1.设置头部    字体转译的utf8
        header('Content-type:text/html;charset=utf8');
        //设置时区为    东八区
        date_default_timezone_set('PRC');
        //开启session  缓存退出清除方式
        session_id() || session_name();
        //如果已经有session_id()说明session开启过了
        //如果没有session_id，则再开启session
        //重复开启session，会导致报错
    }
}
