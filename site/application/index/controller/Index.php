<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use think\Log;
use think\captcha\Captcha;
use think\MyTrace;



class Index extends Controller
{
    public function index()
    {
		/* 
		1. 判断session是否记录登陆状态，如果有，则跳转到首页，如果没有，则显示登录页面。
		*/
        // Session::clear();
        if ("Y" == Session::get('st_login')){
            $this->success('已登陆，跳转到管理页面', 'Index/manageindex');
        }else{
            return $this->fetch();
        }
        /*
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
		}*/
		
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
        /*验证登陆信息，
            如验证成功：则记录登陆状态、用户名，然后跳转到管理页面；
            如验证失败：则返回错误码给浏览器；
        */
        //Session::set('st_login','Y');
        //Session::set('userid',$username);
        
        //return $this->success('登录成功', 'index/manageindex');
        
        
		$request = Request::instance();
		//dump($request);
		$username = $request->param('username');
		$userpass = $request->param('userpass');
        
        $result = Db::table('m_user')->where('user_name', $username)->where('user_pawd',$userpass)->select();
        if(!empty($result)){
        //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            Session::set('st_login','Y');
            Session::set('userid',$username);
            //MyTrace::tracelog( '验证密码成功！！！！！！！！！！！！！！！！！！！！');
            // $this->success('登录成功', 'Index/manageindex');
            //$this->redirect('Index/manageindex', ['cate_id=2' ] );
            return 'Y';
        } else {
        //错误页面的默认跳转页面是返回前一页，通常不需要设置
            return "N";
        }/**/
    }
    public function namecheck(){
        $request = Request::instance();
        $username = $request->param('username');
        MyTrace::tracevar( 'username',$username);
        $result = Db::table('m_user')->where('user_name', $username)->value("user_name");
        if (empty($result))
            return "N";
        else return "Y"; 
    }
    
    public function captcha_gen(){
        $captcha = new Captcha();
        return $captcha->entry();
        
    }
    public function captcha_check1(){
        $request = Request::instance();
        $captcha = new  Captcha();
        if ($captcha->check($request->param('capcode'), ''))return 'Y';
        return "N";
    }
	public function manageindex()
    {
        $this->assign('username',Session::get('userid'));
		return $this->fetch();
    }
    public function logout()
    {
        Session::clear();
		return $this->fetch('index');
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
