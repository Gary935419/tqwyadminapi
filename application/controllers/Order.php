<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：订单
 * 作成者        ： Gary
 * **********************************************************************
 */
class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Order_model', 'order');
		$this->load->model('Member_model', 'member');
        header("Content-type:text/html;charset=utf-8");
    }
	/**
	 * 商品列表页
	 */
	public function goods_list()
	{

		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->order->getgoodsAllPage($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->order->getgoodsAll($page, $gname);
		$data["gname"] = $gname;
		$data["list"] = $list;
		$this->display("order/goods_list", $data);
	}
	/**
	 * 商品添加页
	 */
	public function goods_add()
	{
		$indexschoollist = $this->member->indexschoollist();
		$data['schoollist'] = empty($indexschoollist)?'':$indexschoollist;
		$this->display("order/goods_add",$data);
	}
	/**
	 * 商品添加提交
	 */
	public function goods_save()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtype = isset($_POST["gtype"]) ? $_POST["gtype"] : '';
		$schoolname = isset($_POST["schoolname"]) ? $_POST["schoolname"] : '';
		$typename = isset($_POST["typename"]) ? $_POST["typename"] : '';
		$pricename = isset($_POST["pricename"]) ? $_POST["pricename"] : '';
		$areaname = isset($_POST["areaname"]) ? $_POST["areaname"] : '';
		$classname = isset($_POST["classname"]) ? $_POST["classname"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$addtime = time();
		$is_delete = 0;
		$goods_info = $this->order->getgoodsByname($gname);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该报告名称已经存在。"));
			return;
		}
		$gid = $this->order->goods_save($gname,$gtype,$schoolname,$typename,$pricename,$areaname,$classname,$gcontent,$addtime,$is_delete);

		if ($gid) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}
	/**
	 * 商品删除
	 */
	public function goods_delete()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->order->goods_save_delete($id)) {
			echo json_encode(array('success' => true, 'msg' => "删除成功"));
			return;
		} else {
			echo json_encode(array('success' => false, 'msg' => "删除失败"));
			return;
		}
	}
	/**
	 * 类型修改页
	 */
	public function goods_edit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->order->getgoodsById($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$indexschoollist = $this->member->indexschoollist();
		$data = array();
		$data['gname'] = $goods_info['gname'];
		$data['typename'] = $goods_info['typename'];
		$data['schoolname'] = $goods_info['schoolname'];
		$data['pricename'] = $goods_info['pricename'];
		$data['classname'] = $goods_info['classname'];
		$data['areaname'] = $goods_info['areaname'];
		$data['id'] = $id;
		$data['gcontent'] = $goods_info['gcontent'];
		$data['gtype'] = $goods_info['gtype'];
		$data['gname'] = $goods_info['gname'];
		$data['schoollist'] = empty($indexschoollist)?'':$indexschoollist;
		$this->display("order/goods_edit", $data);
	}
	/**
	 * 商品修改提交
	 */
	public function goods_save_edit()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtype = isset($_POST["gtype"]) ? $_POST["gtype"] : '';
		$schoolname = isset($_POST["schoolname"]) ? $_POST["schoolname"] : '';
		$typename = isset($_POST["typename"]) ? $_POST["typename"] : '';
		$pricename = isset($_POST["pricename"]) ? $_POST["pricename"] : '';
		$areaname = isset($_POST["areaname"]) ? $_POST["areaname"] : '';
		$classname = isset($_POST["classname"]) ? $_POST["classname"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$addtime = time();
		$is_delete = 0;
		$goods_info = $this->order->getgoodsById2($gname,$id);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该报告名称已经存在。"));
			return;
		}
		$result = $this->order->goods_save_edit($id,$gname,$gtype,$schoolname,$typename,$pricename,$areaname,$classname,$gcontent,$addtime,$is_delete);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}
    /**
     * 充值订单列表页
     */
    public function rechargeorder_list()
    {

        $start = isset($_GET['start']) ? $_GET['start'] : '';
        $end = isset($_GET['end']) ? $_GET['end'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->order->getrechargeorderAllPage($start,$end);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->order->getrechargeorderAll($page,$start,$end);
        $data["list"] = $list;
        $data["start"] = $start;
        $data["end"] = $end;
        $this->display("order/rechargeorder_list", $data);
    }
    /**
     * 任务订单列表页
     */
    public function taskorder_list()
    {

        $start = isset($_GET['start']) ? $_GET['start'] : '';
        $end = isset($_GET['end']) ? $_GET['end'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;

        $allpage = $this->order->gettaskorderAllPage($start,$end);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->order->gettaskorderAll($page,$start,$end);
        $data["list"] = $list;
        $data["start"] = $start;
        $data["end"] = $end;
        $this->display("order/taskorder_list", $data);
    }
    /**
     * 合作申请商家列表页
     */
    public function integralorder_list()
    {

        $start = isset($_GET['start']) ? $_GET['start'] : '';
        $end = isset($_GET['end']) ? $_GET['end'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;

        $allpage = $this->order->getintegralorderAllPage($start,$end);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->order->getintegralorderAll($page,$start,$end);
        $data["list"] = $list;
        $data["start"] = $start;
        $data["end"] = $end;
        $this->display("order/integralorder_list", $data);
    }
	/**
	 * 报告列表
	 */
	public function goodsorder_list()
	{

		$start = isset($_GET['start']) ? $_GET['start'] : '';
		$end = isset($_GET['end']) ? $_GET['end'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;

		$allpage = $this->order->getgoodsorderAllPage($start,$end);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->order->getgoodsorderAll($page,$start,$end);
		$data["list"] = $list;
		$data["start"] = $start;
		$data["end"] = $end;
		$this->display("order/goodsorder_list", $data);
	}
}
