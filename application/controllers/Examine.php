<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：审核
 * 作成者        ： Gary
 * **********************************************************************
 */
class Examine extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Examine_model', 'examine');
        $this->load->model('Member_model', 'member');
        header("Content-type:text/html;charset=utf-8");
    }

    /**
     * 商家入驻审核列表页
     */
    public function task_list()
    {
        $start = isset($_GET['start']) ? $_GET['start'] : '';
        $end = isset($_GET['end']) ? $_GET['end'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->examine->gettaskAllPage($start,$end);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->examine->gettaskAll($page,$start,$end);
        $data["list"] = $list;
        $data["start"] = $start;
        $data["end"] = $end;
        $this->display("examine/task_list", $data);
    }
    /**
     * 商家入驻审核详情列表页
     */
    public function task_examine_details()
    {
        $data = array();
        $oid = isset($_GET['oid']) ? $_GET['oid'] : 0;
        $task_info = $this->examine->gettaskById($oid);
        $data['tareject'] = empty($task_info['tareject'])?'':$task_info['tareject'];
        $data['content'] = empty($task_info['content'])?'':$task_info['content'];
        $data['email'] = empty($task_info['email'])?'':$task_info['email'];
        $oimgs = $this->examine->getoimgsall($oid);
        $data['oimgs'] = empty($oimgs)?'':$oimgs;
        $this->display("examine/task_examine_details",$data);
    }
    /**
     * 合作商家审核详情列表页
     */
    public function task_examine_details1()
    {
        $data = array();
        $ogid = isset($_GET['ogid']) ? $_GET['ogid'] : 0;
        $task_info = $this->examine->gettaskById1($ogid);
        $data['email'] = empty($task_info['email'])?'':$task_info['email'];
        $data['content'] = empty($task_info['content'])?'':$task_info['content'];
        $this->display("examine/task_examine_details1",$data);
    }
	/**
	 * 合作商品审核详情列表页
	 */
	public function examine_details_items()
	{
		$data = array();
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$task_info = $this->examine->gettaskByIditems($id);
		$data['price'] = empty($task_info['price'])?'':$task_info['price'];
		$data['email'] = empty($task_info['email'])?'':$task_info['email'];
		$data['btype'] = empty($task_info['btype'])?'':$task_info['btype'];
		$data['school'] = empty($task_info['school'])?'':$task_info['school'];
		$data['area'] = empty($task_info['area'])?'':$task_info['area'];
		$data['money'] = empty($task_info['money'])?'':$task_info['money'];
		$data['ftype'] = empty($task_info['ftype'])?'':$task_info['ftype'];
		$data['status'] = empty($task_info['status'])?'未支付':'已支付';
		$data['paynumber'] = empty($task_info['paynumber'])?'':$task_info['paynumber'];
		$this->display("examine/examine_details_items",$data);
	}
    /**
     * 入驻审核通过操作页
     */
    public function task_examine()
    {
        $oid = isset($_GET['oid']) ? $_GET['oid'] : 0;
        $data = array();
        $data['oid'] = $oid;
		$task_info = $this->examine->gettaskById($oid);
		$data['tareject'] = empty($task_info['tareject'])?'':$task_info['tareject'];
		$data['content'] = empty($task_info['content'])?'':$task_info['content'];
        $this->display("examine/task_examine", $data);
    }
    /**
     * 入驻审核驳回操作页
     */
    public function taskno_examine()
    {
        $oid = isset($_GET['oid']) ? $_GET['oid'] : 0;
        $data = array();
        $data['oid'] = $oid;
        $this->display("examine/taskno_examine", $data);
    }

    /**
     * 入驻审核任务操作提交
     */
    public function examine_new_save_task()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $oid = isset($_POST["oid"]) ? $_POST["oid"] : '';
        $ostate = isset($_POST["ostate"]) ? $_POST["ostate"] : '';
        $tareject = isset($_POST["tareject"]) ? $_POST["tareject"] : '';

        $taorder_info_state = $this->examine->gettaorderByIdstate($oid);
        if (!empty($taorder_info_state)){
            echo json_encode(array('error' => false, 'msg' => "请勿重复操作"));
            return;
        }
        $taorder_info = $this->examine->gettaorderById($oid);
        $mid = $taorder_info['mid'];

        $result = $this->examine->examine_new_save_task($oid,$ostate,$tareject);
        if ($result) {
            $add_time = time();
            $if_flag = 2;
            //发送信息
            $this->member->member_new_save($mid,$tareject, $add_time, $if_flag);
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }

    }

    /**
     * 审核操作页  合作商家
     */
    public function goods_examine()
    {
        $ogid = isset($_GET['ogid']) ? $_GET['ogid'] : 0;
        $data = array();
        $data['ogid'] = $ogid;
        $this->display("examine/goods_examine", $data);
    }
	/**
	 * 任务审核驳回操作页  合作商家
	 */
	public function goodsno_examine()
	{
		$ogid = isset($_GET['ogid']) ? $_GET['ogid'] : 0;
		$data = array();
		$data['ogid'] = $ogid;
		$this->display("examine/goodsno_examine", $data);
	}
	/**
	 * 审核操作页  合作商品
	 */
	public function goods_examine_items()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = array();
		$data['id'] = $id;
		$this->display("examine/goods_examine_items", $data);
	}
	/**
	 * 任务审核驳回操作页  合作商品
	 */
	public function goodsno_examine_items()
	{
		$ogid = isset($_GET['id']) ? $_GET['id'] : 0;
		$data = array();
		$data['id'] = $ogid;
		$this->display("examine/goodsno_examine_items", $data);
	}
    /**
     * 审核操作提交 商家 审核通过
     */
    public function examinegoods_new_save_task()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $ogid = isset($_POST["ogid"]) ? $_POST["ogid"] : '';
        $tareject = isset($_POST["tareject"]) ? $_POST["tareject"] : '';
        $gotime = time();
		$taorder_info_state = $this->examine->getinorderByIdstate($ogid);
        if (!empty($taorder_info_state)){
            echo json_encode(array('error' => false, 'msg' => "请勿重复操作"));
            return;
        }
		$taorder_info_state1 = $this->examine->getinorderByIdstatenew($ogid);
        $mid = $taorder_info_state1['mid'];
        $result = $this->examine->examineintegral_new_save_task($ogid,$tareject,$gotime);
        if ($result) {
            $add_time = time();
            $if_flag = 2;
            //发送信息
            $this->member->member_new_save($mid,$tareject, $add_time, $if_flag);
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 审核操作提交  商家  审核驳回
     */
    public function examinegoods_new_save_task1()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $ogid = isset($_POST["ogid"]) ? $_POST["ogid"] : '';
        $tareject = isset($_POST["tareject"]) ? $_POST["tareject"] : '';
        $gotime = time();
        $taorder_info_state = $this->examine->getinorderByIdstate1($ogid);
        if (!empty($taorder_info_state)){
            echo json_encode(array('error' => false, 'msg' => "请勿重复操作"));
            return;
        }
		$taorder_info_state1 = $this->examine->getinorderByIdstatenew($ogid);
		$mid = $taorder_info_state1['mid'];
        $result = $this->examine->examineintegral_new_save_task1($ogid,$tareject,$gotime);
        if ($result) {
            $add_time = time();
            $if_flag = 2;
            //发送信息
            $this->member->member_new_save($mid,$tareject, $add_time, $if_flag);
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }

	/**
	 * 审核操作提交  商品  审核通过
	 */
	public function examinegoods_new_save_items()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$tareject = isset($_POST["tareject"]) ? $_POST["tareject"] : '';
		$taorder_info_state = $this->examine->getinorderByIdstateitems($id,2);
		if (!empty($taorder_info_state)){
			echo json_encode(array('error' => false, 'msg' => "请勿重复操作"));
			return;
		}
		$taorder_info_state1 = $this->examine->getinorderByIdstatenewitems($id);
		$mid = $taorder_info_state1['mid'];
		$result = $this->examine->examineintegral_new_save_items($id,$tareject,2);
		if ($result) {
			$add_time = time();
			$if_flag = 2;
			//发送信息
			$this->member->member_new_save($mid,$tareject, $add_time, $if_flag);
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}
	/**
	 * 审核操作提交  商品  审核驳回
	 */
	public function examinegoods_new_save_itemsno()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$tareject = isset($_POST["tareject"]) ? $_POST["tareject"] : '';
		$taorder_info_state = $this->examine->getinorderByIdstateitems($id,3);
		if (!empty($taorder_info_state)){
			echo json_encode(array('error' => false, 'msg' => "请勿重复操作"));
			return;
		}
		$taorder_info_state1 = $this->examine->getinorderByIdstatenewitems($id);
		$mid = $taorder_info_state1['mid'];
		$result = $this->examine->examineintegral_new_save_items($id,$tareject,3);
		if ($result) {
			$add_time = time();
			$if_flag = 2;
			//发送信息
			$this->member->member_new_save($mid,$tareject, $add_time, $if_flag);
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}
	/**
	 * 类型删除
	 */
	public function itemsclass_delete()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->examine->itemsclass_delete($id)) {
			echo json_encode(array('success' => true, 'msg' => "删除成功"));
			return;
		} else {
			echo json_encode(array('success' => false, 'msg' => "删除失败"));
			return;
		}
	}
}
