<?php


class Member_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
	//获取会员感兴趣商品数
	public function getmembergoodscount($id)
	{
		$sqlw = " where 1=1 and uid = $id";
		$sql = "SELECT count(1) as number FROM `interest` " . $sqlw;
		$number = $this->db->query($sql)->row()->number;
		return $number;
	}
    //获取会员总人数
    public function getmemberAllPage($nickname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($nickname)) {
            $sqlw .= " and ( nickname like '%" . $nickname . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `member` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //获取会员总信息
    public function getmemberAll($pg, $nickname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($nickname)) {
            $sqlw .= " and ( u.nickname like '%" . $nickname . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT u.*,r.gname FROM `member` u left join `grade` r on u.gid=r.gid " . $sqlw . " order by u.add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //获取会员总
    public function getmembernewAll($cityname)
    {
        $cityname = $this->db->escape($cityname);
        $sqlw = " where 1=1 and cityname = $cityname and is_agent = 1 ";
        $sql = "SELECT * FROM `member` " . $sqlw . " order by add_time desc ";
        return $this->db->query($sql)->result_array();
    }
    //根据id查看详情
    public function getmemberById($mid)
    {
        $mid = $this->db->escape($mid);
        $sql = "SELECT * FROM `member` where mid = $mid ";
        return $this->db->query($sql)->row_array();
    }
    //查询等级信息列表
    public function getgradeAll()
    {
        $sql = "SELECT * FROM `grade` order by gid desc";
        return $this->db->query($sql)->result_array();
    }
    //查询城市信息列表
    public function getcnameAll()
    {
        $sql = "SELECT * FROM `city` order by cid desc";
        return $this->db->query($sql)->result_array();
    }
    //查询消息信息列表
    public function getnewslist($mid,$pg)
    {
        $mid = $this->db->escape($mid);
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `news` where mid = $mid order by add_time desc LIMIT $start, $stop";

        return $this->db->query($sql)->result_array();
    }
    //会員内容修改提交
    public function member_save_edit($cityname,$is_agent,$avater,$mid, $nickname, $sex, $mobile, $gid, $status, $email, $truename, $opend_bank, $bank_card)
    {
        $cityname = $this->db->escape($cityname);
        $is_agent = $this->db->escape($is_agent);
        $mid = $this->db->escape($mid);
        $nickname = $this->db->escape($nickname);
        $sex = $this->db->escape($sex);
        $mobile = $this->db->escape($mobile);
        $gid = $this->db->escape($gid);
        $status = $this->db->escape($status);
        $email = $this->db->escape($email);
        $truename = $this->db->escape($truename);
        $opend_bank = $this->db->escape($opend_bank);
        $bank_card = $this->db->escape($bank_card);
        $avater = $this->db->escape($avater);
        $sql = "UPDATE `member` SET cityname=$cityname,is_agent=$is_agent,avater=$avater,nickname=$nickname,sex=$sex,mobile=$mobile,gid=$gid,status=$status,email=$email,truename=$truename,opend_bank=$opend_bank,bank_card=$bank_card WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //会員消息保存
    public function member_new_save($mid,$ncontent, $add_time, $if_flag)
    {
        $mid = $this->db->escape($mid);
        $ncontent = $this->db->escape($ncontent);
        $add_time = $this->db->escape($add_time);
        $if_flag = $this->db->escape($if_flag);

        $sql = "INSERT INTO `news` (mid,ncontent,add_time,if_flag) VALUES ($mid,$ncontent,$add_time,$if_flag);";
        return $this->db->query($sql);
    }
    //验证发送信息频繁
    public function getnewsinfo($mid,$add_timeend,$add_time)
    {
        $sqlw = " where mid=$mid and add_time between $add_timeend and $add_time";
        $sql = "SELECT * FROM `news` " . $sqlw;
        return $this->db->query($sql)->result_array();
    }


    /* 小程序接口开始   　      * */
    /* 时间：2019/12/4       * */

    //根据opendid查看详情
    public function getMemberInfo($openid)
    {
        $openid = $this->db->escape($openid);
        $sql = "SELECT * FROM `member` where openid = $openid ";
        return $this->db->query($sql)->row_array();
    }
    //根据token查看详情
    public function getMemberInfotoken($token)
    {
        $token = $this->db->escape($token);
        $sql = "SELECT * FROM `member` where token = $token ";
        return $this->db->query($sql)->row_array();
    }
	//根据id查看详情
	public function getReportinfo($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `reportlist` where id = $id ";
		return $this->db->query($sql)->row_array();
	}
	public function getquestionInfotoken($str)
	{
		$str = $this->db->escape($str);
		$sql = "SELECT * FROM `taorder` where content = $str ";
		return $this->db->query($sql)->row_array();
	}
	public function getreportorder($str)
	{
		$str = $this->db->escape($str);
		$sql = "SELECT * FROM `reportorder` where paynumber = $str ";
		return $this->db->query($sql)->row_array();
	}
    //会员注册
    public function register($member_id,$badd_time,$is_agent,$cityname,$gid,$avater,$nickname,$sex,$openid,$token,$add_time,$wallet,$status,$integral,$state,$idnumber)
    {
        $member_id = $this->db->escape($member_id);
        $badd_time = $this->db->escape($badd_time);
        $is_agent = $this->db->escape($is_agent);
        $cityname = $this->db->escape($cityname);
        $gid = $this->db->escape($gid);
        $avater = $this->db->escape($avater);
        $nickname = $this->db->escape($nickname);
        $sex = $this->db->escape($sex);
        $openid = $this->db->escape($openid);
        $token = $this->db->escape($token);
        $add_time = $this->db->escape($add_time);
        $wallet = $this->db->escape($wallet);
        $status = $this->db->escape($status);
        $integral = $this->db->escape($integral);
        $state = $this->db->escape($state);
		$idnumber = $this->db->escape($idnumber);
        $sql = "INSERT INTO `member` (idnumber,member_id,badd_time,is_agent,cityname,gid,avater,nickname,sex,openid,token,add_time,wallet,status,integral,state) VALUES ($idnumber,$member_id,$badd_time,$is_agent,$cityname,$gid,$avater,$nickname,$sex,$openid,$token,$add_time,$wallet,$status,$integral,$state)";
        return $this->db->query($sql);
    }
	public function registerquestion($mid,$question,$ostate,$add_time)
	{
		$mid = $this->db->escape($mid);
		$question = $this->db->escape($question);
		$ostate = $this->db->escape($ostate);
		$add_time = $this->db->escape($add_time);
		$sql = "INSERT INTO `taorder` (mid,ostate,content,add_time) VALUES ($mid,$ostate,$question,$add_time)";
		return $this->db->query($sql);
	}
	public function reportorderinsert($mid,$paynumber,$status,$addtime,$email,$price,$ftype,$money,$area,$school,$btype,$checktime)
	{
		$mid = $this->db->escape($mid);
		$paynumber = $this->db->escape($paynumber);
		$status = $this->db->escape($status);
		$addtime = $this->db->escape($addtime);
		$email = $this->db->escape($email);
		$price = $this->db->escape($price);
		$ftype = $this->db->escape($ftype);
		$money = $this->db->escape($money);
		$area = $this->db->escape($area);
		$school = $this->db->escape($school);
		$btype = $this->db->escape($btype);
		$checktime = $this->db->escape($checktime);
		$sql = "INSERT INTO `reportorder` (mid,paynumber,status,addtime,email,price,ftype,money,area,school,btype,checktime) VALUES ($mid,$paynumber,$status,$addtime,$email,$price,$ftype,$money,$area,$school,$btype,$checktime)";
		return $this->db->query($sql);
	}
	public function getupdatereportorder($ordernumber)
	{
		$paynumber = $this->db->escape($ordernumber);
		$sql = "UPDATE `reportorder` SET status=1 WHERE paynumber = $paynumber";
		return $this->db->query($sql);
	}
    //会員登录
    public function member_edit($mid, $token)
    {
        $mid = $this->db->escape($mid);
        $token = $this->db->escape($token);
        $sql = "UPDATE `member` SET token=$token WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //根据id查看详情
    public function getgradeInfo($gid)
    {
        $gid = $this->db->escape($gid);
        $sql = "SELECT * FROM `grade` where gid = $gid ";
        return $this->db->query($sql)->row_array();
    }
    //查看设置详情
    public function getsetInfo()
    {
        $sql = "SELECT * FROM `setting` where sid = 1 ";
        return $this->db->query($sql)->row_array();
    }
	//查看是否支付
	public function getpayInfo($btype,$school,$area,$money,$ftype,$mid,$status)
	{
		$btype = $this->db->escape($btype);
		$school = $this->db->escape($school);
		$area = $this->db->escape($area);
		$money = $this->db->escape($money);
		$ftype = $this->db->escape($ftype);
		$mid = $this->db->escape($mid);
		$status = $this->db->escape($status);
		$sql = "SELECT * FROM `reportorder` where btype = $btype and school = $school and area = $area and money = $money and ftype = $ftype and mid = $mid and status = $status and checktime != '' order by addtime desc limit 1";
		return $this->db->query($sql)->row_array();
	}
	//查看是否支付
	public function getpayInfo1($btype,$school,$area,$money,$ftype,$checktime)
	{
		$btype = $this->db->escape($btype);
		$school = $this->db->escape($school);
		$area = $this->db->escape($area);
		$money = $this->db->escape($money);
		$ftype = $this->db->escape($ftype);
		$checktime = $this->db->escape($checktime);
		$sql = "SELECT * FROM `reportlist` where typename = $btype and schoolname = $school and areaname = $area and pricename = $money and classname = $ftype and addtime = $checktime";
		return $this->db->query($sql)->row_array();
	}
	//查询学校
	public function getitemsclassschoolname($schoolname)
	{
		$schoolname = $this->db->escape($schoolname);
		$sql = "SELECT * FROM `itemsclass` where cname=$schoolname ";
		return $this->db->query($sql)->row_array();
	}
	//获得报告列表
	public function getReportlist($btype,$school,$area,$money,$ftype)
	{
		$btype = $this->db->escape($btype);
		$school = $this->db->escape($school);
		$area = $this->db->escape($area);
		$money = $this->db->escape($money);
		$ftype = $this->db->escape($ftype);
		$sql = "SELECT * FROM `reportlist` where typename = $btype and schoolname = $school and areaname = $area and pricename = $money and classname = $ftype and is_delete != 1";
		return $this->db->query($sql)->result_array();
	}
    //获得佣金统计
    public function getcommissionsum($mid)
    {
        $sqlw = " where mid=$mid and wtype = 1 ";
        $sql = "SELECT SUM(wprice) as number from walletwater " . $sqlw ;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取会员未读消息统计
    public function getnewscount($mid)
    {
        $sqlw = " where 1=1 and mid =$mid and if_flag=2";

        $sql = "SELECT count(1) as number FROM `news` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取会员待处理统计
    public function gettaorder1($mid)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=1";

        $sql = "SELECT count(1) as number FROM `taorder` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取会员审核中统计
    public function gettaorder2($mid)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=2";

        $sql = "SELECT count(1) as number FROM `taorder` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取会员已通过统计
    public function gettaorder3($mid)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=3";

        $sql = "SELECT count(1) as number FROM `taorder` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取会员未通过统计
    public function gettaorder4($mid)
    {
        $sqlw = " where 1=1 and mid=$mid and ostate=4";

        $sql = "SELECT count(1) as number FROM `taorder` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //获取城市列表
    public function getcitylist()
    {
        $sqlw = " where 1=1 ";
        $sql = "SELECT * FROM `city` " . $sqlw ;
        return $this->db->query($sql)->result_array();
    }
    //会員消息标记已读
    public function getnewsflge($mid)
    {
        $mid = $this->db->escape($mid);
        $sql = "UPDATE `news` SET if_flag=1 WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //获取积分明细
    public function getintegrallist($mid,$pg)
    {
        $sqlw = " where 1=1 and mid = $mid";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `integralflow` " . $sqlw . " order by add_time desc LIMIT $start, $stop";

        return $this->db->query($sql)->result_array();
    }
    //获取钱包明细
    public function getwalletllist($mid,$pg)
    {
        $sqlw = " where 1=1 and mid = $mid and wtype != 1 and wtype != 7 and wtype != 8 ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `walletwater` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //获取佣金明细
    public function getcommissionlist($mid,$pg)
    {
        $sqlw = " where 1=1 and mid = $mid and wtype=1 ";
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `walletwater` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //会員基础信息设置
    public function updatamemberinfo($mid,$truename,$mobile,$email,$address)
    {
        $mid = $this->db->escape($mid);
        $truename = $this->db->escape($truename);
        $mobile = $this->db->escape($mobile);
        $email = $this->db->escape($email);
        $address = $this->db->escape($address);
        $sql = "UPDATE `member` SET truename=$truename,mobile=$mobile,email=$email,address=$address WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //会員基础信息银行卡
    public function updatamemberinfo1($mid,$opend_bank,$bank_card)
    {
        $mid = $this->db->escape($mid);
        $opend_bank = $this->db->escape($opend_bank);
        $bank_card = $this->db->escape($bank_card);
        $sql = "UPDATE `member` SET opend_bank=$opend_bank,bank_card=$bank_card WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //获取广告列表
    public function getindeximglist()
    {
        $sqlw = " where 1=1";
        $sql = "SELECT * FROM `advertisement` " . $sqlw . " order by add_time desc ";
        return $this->db->query($sql)->result_array();
    }
	//获取学校列表
	public function indexschoollist()
	{
		$sqlw = " where 1=1";
		$sql = "SELECT * FROM `itemsclass` " . $sqlw . " order by addtime desc ";
		return $this->db->query($sql)->result_array();
	}
	//获取价格列表
	public function indexpricellist()
	{
		$sqlw = " where 1=1";
		$sql = "SELECT * FROM `reportprice` " . $sqlw;
		return $this->db->query($sql)->result_array();
	}
	//获取区域列表
	public function indexareallist()
	{
		$sqlw = " where 1=1";
		$sql = "SELECT * FROM `reportarea` " . $sqlw;
		return $this->db->query($sql)->result_array();
	}
	//获取类型列表
	public function indextypellist()
	{
		$sqlw = " where 1=1";
		$sql = "SELECT * FROM `reporttype` " . $sqlw;
		return $this->db->query($sql)->result_array();
	}
	//获取资讯列表
	public function getindexnewlist()
	{
		$sqlw = " where 1=1";
		$sql = "SELECT * FROM `goods` " . $sqlw . " order by gtitle desc";
		return $this->db->query($sql)->result_array();
	}
	//获取问答列表
	public function getquestionlist($str)
	{
		$sqlw = " where 1=1 ";
		if (!empty($str)) {
			$sqlw .= " and ( u.content like '%" . $str . "%' ) ";
		}
		$sql = "SELECT * FROM `taorder` u left join `member` r on u.mid=r.mid " . $sqlw . " order by u.add_time desc";
		return $this->db->query($sql)->result_array();
	}
    //获取公告列表
    public function getindexnoticelist()
    {
        $sqlw = " where 1=1";
        $sql = "SELECT * FROM `notice` " . $sqlw . " order by add_time desc ";
        return $this->db->query($sql)->result_array();
    }
    //获取分类列表  商家
    public function getindexclasslist()
    {
        $sqlw = " where 1=1";
        $sql = "SELECT * FROM `taskclass` " . $sqlw . " order by tsort ";
        return $this->db->query($sql)->result_array();
    }
	//获取分类列表  商品  推荐
	public function getindexitemsclasslist()
	{
		$sqlw = " where 1=1 and ishot = 1 ";
		$sql = "SELECT * FROM `itemsclass` " . $sqlw . " order by csort ";
		return $this->db->query($sql)->result_array();
	}
	//获取分类列表  商品
	public function getitemsclasslist()
	{
		$sqlw = " where 1=1 ";
		$sql = "SELECT * FROM `itemsclass` " . $sqlw . " order by csort ";
		return $this->db->query($sql)->result_array();
	}
    //任务筛选条件查询
    public function gettasklist($tid,$keywords,$pricestate,$pg)
    {
        $sqlw = " where 1=1 and if_recommend=1";

        if (!empty($tid)) {
            $tid = $this->db->escape($tid);
            $sqlw .= " and tid = $tid ";
        }
        if (!empty($keywords)) {
            $sqlw .= " and ( tatitle like '%" . $keywords . "%') ";
        }
        if (!empty($pricestate)) {
            if ($pricestate == 1){
                $sqlw .= " order by tacommission desc ";
            }else{
                $sqlw .= " order by tacommission asc ";
            }
        }else{
            $sqlw .= " order by add_time desc ";
        }

        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT * FROM `task` " . $sqlw ." LIMIT $start, $stop";
//        $sql = "SELECT * FROM `city` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //根据mid查看详情
    public function getMemberInfomid($mid)
    {
        $mid = $this->db->escape($mid);
        $sql = "SELECT * FROM `member` where mid = $mid ";
        return $this->db->query($sql)->row_array();
    }
    //updatashare
    public function updatashare($mid,$mqrcode)
    {
        $mid = $this->db->escape($mid);
        $mqrcode = $this->db->escape($mqrcode);
        $sql = "UPDATE `member` SET mqrcode=$mqrcode WHERE mid = $mid";
        return $this->db->query($sql);
    }
    //获取推荐人列表
    public function getsharelist($mid)
    {
        $sqlw = " where 1=1 and member_id = $mid and ifpay=1 ";
        $sql = "SELECT * FROM `member` " . $sqlw . " order by badd_time desc ";
        return $this->db->query($sql)->result_array();
    }
    //获取会员总人数
    public function getindexmembernum()
    {
        $sqlw = " where 1=1 ";
        $sql = "SELECT count(1) as number FROM `member` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return $number;
    }
    //格式化数据库
    public function deleteall()
    {
        $sql =  "DELETE FROM integralflow";
        $sql1 = "DELETE FROM member";
        $sql2 = "DELETE FROM news";
        $sql3 = "DELETE FROM oimgs";
        $sql4 = "DELETE FROM rechargeorder";
        $sql5 = "DELETE FROM taorder";
        $sql6 = "DELETE FROM task";
        $sql7 = "DELETE FROM walletwater";
        $sql8 = "DELETE FROM withdrawal";
        $this->db->query($sql);
        $this->db->query($sql1);
        $this->db->query($sql2);
        $this->db->query($sql3);
        $this->db->query($sql4);
        $this->db->query($sql5);
        $this->db->query($sql6);
        $this->db->query($sql7);
        $this->db->query($sql8);
    }
}
