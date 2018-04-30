<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Index extends Controller
{
    public function index()
    {
		/* 
		1. 判断是否有提交用户名：
		  1.1 如有，则进行登录验证
		    1.1.1 登录成功，跳转到首页的方法；
			  1.1.2 登录失败，返回登录页面，提示登录失败；
		  1.2 如无，则显示登录页面；
		结束。
		*/
		$request = Request::instance();
		//dump($request);
		$username = $request->param('username');
		$userpass = $request->param('userpass');
		echo "\n";
		if (empty($username)){   //  如果为空，则为第一次打开页面，直接显示登录页面
			 return $this->fetch();
		}else{                                   //  否则，判断用户密码是否正确，正确则跳转到系统首页，错误则提示用户密码错误；
			$result = Db::table('m_user')->where('user_name', $username)->where('user_pawd',$userpass)->select();
            if(!empty($result)){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('登录成功', 'Index/manageindex');
            } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('登录失败');
            }
		}
		
    }
    public function test($action="zcl")
    {
		$request = Request::instance();
		//dump($request->param());
		$this->assign('name', $action);
		return $this->fetch();
    }
	public function logincheck()
    {
		$request = Request::instance();
		//dump($request);
		$username = $request->param('username');
		$userpass = $request->param('userpass');
		return  "" .$username." | ".$userpass ;
    }
	public function manageindex()
    {
		return $this->fetch();
    }
	public function menu()
    {
		return $this->fetch();
    }
	public function m_main ()
    {
		return $this->fetch();
    }
    public function m_site_manage()
    {
		return $this->fetch();
    } 
    public function m_member()
    {
		return $this->fetch();
    }
    public function m_member1()
    {
		return $this->fetch();
    } 
    public function m_member2()
    {
		echo "直接输出view";
    } 
    public function m_report()
    {
		return $this->fetch();
    } 
    public function m_system()
    {
		return $this->fetch();
    }
}
