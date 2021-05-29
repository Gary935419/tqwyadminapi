<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：类型
 * 作成者        ： Gary
 * **********************************************************************
 */
class Taskclass extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Taskclass_model', 'taskclass');
		$this->load->model('Itemsclass_model', 'itemsclass');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 类型列表页
     */
    public function taskclass_list()
    {

        $tname = isset($_GET['tname']) ? $_GET['tname'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->taskclass->gettaskclassAllPage($tname);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->taskclass->gettaskclassAllNew($page, $tname);
        $data["list"] = $list;
        $data["tname"] = $tname;
        $this->display("taskclass/taskclass_list", $data);
    }
    /**
     * 类型添加页
     */
    public function taskclass_add()
    {
        $this->display("taskclass/taskclass_add");
    }
    /**
     * 类型添加提交
     */
    public function taskclass_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $tname = isset($_POST["tname"]) ? $_POST["tname"] : '';
        $timg = isset($_POST["timg"]) ? $_POST["timg"] : '';
        $tsort = isset($_POST["tsort"]) ? $_POST["tsort"] : '';
        $add_time = time();

        $taskclass_info = $this->taskclass->gettaskclassByname($tname);
        if (!empty($taskclass_info)) {
            echo json_encode(array('error' => true, 'msg' => "该类型名称已经存在。"));
            return;
        }
        $result = $this->taskclass->taskclass_save($tname, $timg,$tsort, $add_time);
        if ($result) {
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
    public function taskclass_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->taskclass->taskclass_delete($id)) {
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
    public function taskclass_edit()
    {
        $tid = isset($_GET['tid']) ? $_GET['tid'] : 0;
        $taskclass_info = $this->taskclass->gettaskclassById($tid);
        if (empty($taskclass_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['tname'] = $taskclass_info['tname'];
        $data['timg'] = $taskclass_info['timg'];
        $data['tsort'] = $taskclass_info['tsort'];
        $data['tid'] = $tid;
        $this->display("taskclass/taskclass_edit", $data);
    }
    /**
     * 类型修改提交
     */
    public function taskclass_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $tname = isset($_POST["tname"]) ? $_POST["tname"] : '';
        $timg = isset($_POST["timg"]) ? $_POST["timg"] : '';
        $tsort = isset($_POST["tsort"]) ? $_POST["tsort"] : '';
        $tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
        $taskclass_info = $this->taskclass->gettaskclassById2($tname, $tid);
        if (!empty($taskclass_info)){
            echo json_encode(array('error' => false, 'msg' => "该类型名称已经存在"));
            return;
        }

        $result = $this->taskclass->taskclass_save_edit($tid, $tname, $timg, $tsort);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }


	/**
	 * 类型列表页
	 */
	public function itemsclass_list()
	{

		$tname = isset($_GET['tname']) ? $_GET['tname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->itemsclass->getitemsclassAllPage($tname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->itemsclass->getitemsclassAllNew($page, $tname);
		$data["list"] = $list;
		$data["tname"] = $tname;
		$this->display("taskclass/itemsclass_list", $data);
	}
	/**
	 * 类型添加页
	 */
	public function itemsclass_add()
	{
		$this->display("taskclass/itemsclass_add");
	}
	/**
	 * 类型添加提交
	 */
	public function itemsclass_save()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}

		$tname = isset($_POST["tname"]) ? $_POST["tname"] : '';
		$careaname = isset($_POST["careaname"]) ? $_POST["careaname"] : '';
		$timg = isset($_POST["timg"]) ? $_POST["timg"] : '';
		$tsort = isset($_POST["tsort"]) ? $_POST["tsort"] : '';
		$ishot = isset($_POST["ishot"]) ? $_POST["ishot"] : '0';
		$add_time = time();

		$taskclass_info = $this->itemsclass->getitemsclassByname($tname);
		if (!empty($taskclass_info)) {
			echo json_encode(array('error' => true, 'msg' => "该类型名称已经存在。"));
			return;
		}
		$result = $this->itemsclass->itemsclass_save($tname, $timg,$tsort, $ishot,$add_time,$careaname);
		if ($result) {
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
		if ($this->itemsclass->itemsclass_delete($id)) {
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
	public function itemsclass_edit()
	{
		$tid = isset($_GET['id']) ? $_GET['id'] : 0;
		$taskclass_info = $this->itemsclass->getitemsclassById($tid);
		if (empty($taskclass_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$data = array();
		$data['tname'] = $taskclass_info['cname'];
		$data['timg'] = $taskclass_info['cimg'];
		$data['tsort'] = $taskclass_info['csort'];
		$data['ishot'] = $taskclass_info['ishot'];
		$data['id'] = $tid;
		$data['careaname'] = $taskclass_info['careaname'];
		$this->display("taskclass/itemsclass_edit", $data);
	}
	/**
	 * 类型修改提交
	 */
	public function itemsclass_save_edit()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$tname = isset($_POST["tname"]) ? $_POST["tname"] : '';
		$timg = isset($_POST["timg"]) ? $_POST["timg"] : '';
		$careaname = isset($_POST["careaname"]) ? $_POST["careaname"] : '';
		$tsort = isset($_POST["tsort"]) ? $_POST["tsort"] : '';
		$ishot = isset($_POST["ishot"]) ? $_POST["ishot"] : '';
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$taskclass_info = $this->itemsclass->getitemsclassById2($tname, $tid);

		if (!empty($taskclass_info)){
			echo json_encode(array('error' => false, 'msg' => "该类型名称已经存在"));
			return;
		}

		$result = $this->itemsclass->itemsclass_save_edit($tid, $tname, $timg, $tsort, $ishot, $careaname);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}
}
