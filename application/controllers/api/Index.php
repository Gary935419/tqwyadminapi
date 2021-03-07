<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：个人中心
 * 作成者        ： Gary
 * **********************************************************************
 */
class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // 加载数据库类
        $this->load->model('Member_model', 'member');
    }
    /**
     * 个人中心
     */
    public function memberinfo(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        //获得个人信息
        $data = array();
        if (empty($member['gid'])){
            $member['gname'] = "";
        }else{
            $grade = $this->member->getgradeInfo($member['gid']);
            $member['gname'] = $grade['gname'];
        }
        //未读消息数
        $newcount = $this->member->getnewscount($mid);
        //待处理数
        $ostate1 = $this->member->gettaorder1($mid);
        //审核中数
        $ostate2 = $this->member->gettaorder2($mid);
        //已通过数
        $ostate3 = $this->member->gettaorder3($mid);
        //未通过数
        $ostate4 = $this->member->gettaorder4($mid);
        $commissionsum = $this->member->getcommissionsum($mid);
        $member['newcount'] = $newcount;
        $member['ostate1'] = $ostate1;
        $member['ostate2'] = $ostate2;
        $member['ostate3'] = $ostate3;
        $member['ostate4'] = $ostate4;
        $member['commissionsum'] = empty($commissionsum)?'0.00':$commissionsum;
        $data['member'] = $member;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 个人中心（分享页数据）
     */
    public function memberinfos(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        if (!isset($_POST['mid']) || empty($_POST['mid'])) {
            $this->back_json(201, '缺少推荐人id！');
        }
        $mid = $_POST['mid'];
        //获得个人信息
        $data = array();
        $member = $this->member->getMemberInfomid($mid);
        $data['member'] = $member;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 消息列表
     */
    public function newslist(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        $page = $_POST['pageNumber'];
        $newslist = $this->member->getnewslist($mid,$page);
        foreach ($newslist as $k=>$v){
            $newslist[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
        }
        $data['newslist'] = $newslist;
        //消息标记已读
        $this->member->getnewsflge($mid);
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 积分明细
     */
    public function integrallist(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        $page = $_POST['pageNumber'];
        $integrallist = $this->member->getintegrallist($mid,$page);
        foreach ($integrallist as $k=>$v){
            $integrallist[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
        }
        $data['integrallist'] = $integrallist;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 钱包明细
     */
    public function walletlist(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        $page = $_POST['pageNumber'];
        $walletlist = $this->member->getwalletllist($mid,$page);
        foreach ($walletlist as $k=>$v){
            $walletlist[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
        }
        $data['walletlist'] = $walletlist;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 佣金明细
     */
    public function commissionlist(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        $page = $_POST['pageNumber'];
        $commission = $this->member->getcommissionlist($mid,$page);
        foreach ($commission as $k=>$v){
            $commission[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
        }
        $data['commissionlist'] = $commission;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 个人信息修改（设置）
     */
    public function memberupdatainfo(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        //获得真实姓名
        $truename = empty($_POST['truename'])?'':$_POST['truename'];
        //获得联系电话
        $mobile = empty($_POST['mobile'])?'':$_POST['mobile'];
        //获得邮箱地址
        $email = empty($_POST['email'])?'':$_POST['email'];
        //获得收货地址
        $address = empty($_POST['address'])?'':$_POST['address'];
        $this->member->updatamemberinfo($mid,$truename,$mobile,$email,$address);

        $this->back_json(200, '更新成功', array());
    }
    /**
     * 个人信息修改（银行卡）
     */
    public function memberupdatainfo1(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        //获得开户行
        $opend_bank = empty($_POST['opend_bank'])?'':$_POST['opend_bank'];
        //获得银行卡号
        $bank_card = empty($_POST['bank_card'])?'':$_POST['bank_card'];
        $this->member->updatamemberinfo1($mid,$opend_bank,$bank_card);

        $this->back_json(200, '更新成功', array());
    }
    /**
     * 首页轮播图
     */
    public function indeximglist(){
        $indeximglist = $this->member->getindeximglist();
        $data['indeximglist'] = empty($indeximglist)?'':$indeximglist;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 首页公告
     */
    public function indexnoticelist(){
        $indexnoticelist = $this->member->getindexnoticelist();
        $indexnotice = "";
        if (!empty($indexnoticelist)){
            foreach ($indexnoticelist as $k=>$v){
                if (!empty($indexnotice)){
                    $indexnotice = $indexnotice . ' ! ' . ' 、 ' . $v['ncontent'];
                }else{
                    $indexnotice = $v['ncontent'];
                }
            }
        }
        $data['indexnotice'] = $indexnotice;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 首页会员人数
     */
    public function indexmembernum(){
        //获取会员实际人数
        $indexmembernum = $this->member->getindexmembernum();
        //获取设置虚拟人数
        $set = $this->member->getsetInfo();
        $membernum = floatval($indexmembernum) + floatval($set['membernum']);
        $data['membernum'] = empty($membernum)?'0':$membernum;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 分类列表  商家
     */
    public function indexclasslist(){
        $indexclasslist = $this->member->getindexclasslist();
        $data['indexclasslist'] = empty($indexclasslist)?'':$indexclasslist;
        $this->back_json(200, '操作成功', $data);
    }
	/**
	 * 分类列表  商品  推荐
	 */
	public function indexitemsclasslist(){
		$indexclasslist = $this->member->getindexitemsclasslist();
		$data['indexclasslist'] = empty($indexclasslist)?'':$indexclasslist;
		$this->back_json(200, '操作成功', $data);
	}
	/**
	 * 分类列表  商品
	 */
	public function itemsclasslist(){
		$indexclasslist = $this->member->getitemsclasslist();
		$data['indexclasslist'] = empty($indexclasslist)?'':$indexclasslist;
		$this->back_json(200, '操作成功', $data);
	}
    /**
     * 个人中心（设置二维码）
     */
    public function memberinfoshare(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        //获得个人信息
        $data = array();
        if (empty($member['gid'])){
            $member['gname'] = "";
        }else{
            $grade = $this->member->getgradeInfo($member['gid']);
            $member['gname'] = $grade['gname'];
        }
        $newcount = $this->member->getnewscount($mid);
        $commissionsum = $this->member->getcommissionsum($mid);
        $member['newcount'] = $newcount;
        $member['commissionsum'] = empty($commissionsum)?'0.00':$commissionsum;

        if (empty($member['mqrcode'])){
            //生成推荐二维码
            $this->getAccessTokenNew($mid);
            $member = $this->member->getMemberInfotoken($token);
        }
        $data['member'] = $member;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 个人中心（我的客服二维码）
     */
    public function customercode(){
        $data = array();
        $data['setinfo'] = $this->member->getsetInfo();
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 推荐人列表
     */
    public function sharelist(){
        //验证loginCode是否传递
        if (!isset($_POST['token']) || empty($_POST['token'])) {
            $this->back_json(205, '未授权登录！');
        }
        $token = $_POST['token'];
        $member = $this->member->getMemberInfotoken($token);
        if (empty($member)){
            $this->back_json(205, '请重新登录');
        }
        $mid = $member['mid'];
        $sharelist = $this->member->getsharelist($mid);
        foreach ($sharelist as $k=>$v){
            $sharelist[$k]['badd_time'] = date("Y-m-d H:i:s",$v['badd_time']);
        }
        $data['sharelist'] = $sharelist;
        $this->back_json(200, '操作成功', $data);
    }
    /**
     * 城市列表
     */
    public function citylist(){
        $citylist = $this->member->getcitylist();
        $data = array();
        $city = array();
        array_push($city,'请选择');
        foreach ($citylist as $k=>$v){
            array_push($city,$v['cname']);
        }
        $data['citylist'] = $city;
        $this->back_json(200, '操作成功', $data);
    }
    public function getAccessTokenNew($mid){

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->secret}";
        $res = json_decode($this->curl_get($url),1);
        if (empty($res['access_token'])){
            $this->back_json(205, '操作失败', array());
        }
        $session_data = array();
        $session_data['access_token'] = $res['access_token'];
        $session_data['expire'] = time()+7000;

        $access_token=$res['access_token'];
        $path="pages/share/share?mid=".$mid;
        $width=430;
        $imgname = "Uploads/".$mid.".jpg";

        if (empty($access_token)||empty($path)||empty($width)||empty($imgname)) {
            return 'error';
        }
        $url = "https://api.weixin.qq.com/wxa/getwxacode?access_token={$access_token}";
        $data = array();
        $data['path'] = $path;
        //最大32个可见字符，只支持数字，大小写英文以及部分特殊字符：!#$&'()*+,/:;=?@-._~，其它字符请自行编码为合法字符（因不支持%，中文无法使用 urlencode 处理，请使用其他编码方式）
        $data['width'] = $width;
        //二维码的宽度，默认为 430px
        $json = $this->https_request($url,json_encode($data));

        $file = fopen($imgname,"w");//打开文件准备写入
        fwrite($file,$json);//写入,$res为图片二进制内容
        fclose($file);//关闭
        $src="/Uploads/".$mid.".jpg";
        $mqrcode = "https://renwu.huaruishijia.com".$src;
        $this->member->updatashare($mid,$mqrcode);

    }
    public function curl_get($url){
        $headers = array('User-Agent:Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.81 Safari/537.36');
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        curl_setopt($oCurl, CURLOPT_TIMEOUT, 20);
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);

        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }
    // 获取带参数的二维码
    // 获取小程序码，适用于需要的码数量极多的业务场景。通过该接口生成的小程序码，永久有效，数量暂无限制。
    function https_request($url,$data = null){
        if(function_exists('curl_init')){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
            if (!empty($data)){
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($curl);
            curl_close($curl);
            return $output;
        }else{
            return false;
        }
    }
}
