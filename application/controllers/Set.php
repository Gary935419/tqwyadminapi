<?php

/**
 * **********************************************************************
 * サブシステム名  ： TASK
 * 機能名         ：系统设置
 * 作成者        ： Gary
 * **********************************************************************
 */
class Set extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Set_model', 'set');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 设置修改页
     */
    public function set_edit()
    {
        $sid = 1;
        $set_info = $this->set->getsetById($sid);
        $data['name'] = $set_info['name'];
        $data['email'] = $set_info['email'];
		$data['img'] = $set_info['img'];
		$data['price'] = $set_info['price'];
        $data['address'] = $set_info['address'];
        $data['contentnew'] = $set_info['contentnew'];
        $data['contentagent'] = $set_info['contentagent'];
        $data['customercode'] = $set_info['customercode'];
        $this->display("set/set_edit", $data);
    }
    /**
     * 设置修改提交
     */
    public function set_save_edit()
    {

        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $sid = 1;
        $name = isset($_POST["name"]) ? $_POST["name"] : '';
        $email = isset($_POST["email"]) ? $_POST["email"] : '';
        $address = isset($_POST["address"]) ? $_POST["address"] : '';
		$img = isset($_POST["img"]) ? $_POST["img"] : '';
		$price = isset($_POST["price"]) ? $_POST["price"] : '';
        $customercode = isset($_POST["customercode"]) ? $_POST["customercode"] : '';
        $contentnew = isset($_POST["contentnew"]) ? $_POST["contentnew"] : '';
        $contentagent = isset($_POST["contentagent"]) ? $_POST["contentagent"] : '';
        $result = $this->set->set_save_edit($name,$contentagent,$email,$customercode,$address,$sid,$contentnew,$img,$price);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }

    }

	/**
	 * 通用报告修改
	 */
	public function set_edit_new()
	{
		$sid = 1;
		$set_info = $this->set->getsetById($sid);
		$data['content1'] = $set_info['content1'];
		$data['content2'] = $set_info['content2'];
		$data['content3'] = $set_info['content3'];
		$this->display("set/set_edit_new", $data);
	}
	/**
	 * 通用报告修改提交
	 */
	public function set_save_edit_new()
	{

		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$sid = 1;
		$content1 = isset($_POST["content1"]) ? $_POST["content1"] : '';
		$content2 = isset($_POST["content2"]) ? $_POST["content2"] : '';
		$content3 = isset($_POST["content3"]) ? $_POST["content3"] : '';
		$result = $this->set->set_save_edit_new($sid,$content1,$content2,$content3);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}

	}

	/**
	 * 区域报告修改
	 */
	public function set_edit_new_area()
	{
		$sid = 1;
		$set_info = $this->set->getsetById($sid);
		$data['content4'] = $set_info['content4'];
		$data['content5'] = $set_info['content5'];
		$data['content6'] = $set_info['content6'];
		$data['content7'] = $set_info['content7'];
		$data['content8'] = $set_info['content8'];
		$data['content9'] = $set_info['content9'];
		$data['content10'] = $set_info['content10'];
		$data['content11'] = $set_info['content11'];
		$this->display("set/set_edit_new_area", $data);
	}
	/**
	 * 区域报告修改提交
	 */
	public function set_save_edit_new_area()
	{

		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$sid = 1;
		$content4 = isset($_POST["content4"]) ? $_POST["content4"] : '';
		$content5 = isset($_POST["content5"]) ? $_POST["content5"] : '';
		$content6 = isset($_POST["content6"]) ? $_POST["content6"] : '';
		$content7 = isset($_POST["content7"]) ? $_POST["content7"] : '';
		$content8 = isset($_POST["content8"]) ? $_POST["content8"] : '';
		$content9 = isset($_POST["content9"]) ? $_POST["content9"] : '';
		$content10 = isset($_POST["content10"]) ? $_POST["content10"] : '';
		$content11 = isset($_POST["content11"]) ? $_POST["content11"] : '';
		$result = $this->set->set_save_edit_new_area($sid,$content4,$content5,$content6,$content7,$content8,$content9,$content10,$content11);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}

	}

    /**
     * 广告列表页
     */
    public function advertisement_list()
    {

        $aname = isset($_GET['aname']) ? $_GET['aname'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->set->getadvertisementAllPage($aname);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->set->getadvertisementAllNew($page, $aname);
        $data["list"] = $list;
        $data["aname"] = $aname;
        $this->display("set/advertisement_list", $data);
    }
    /**
     * 广告添加页
     */
    public function advertisement_add()
    {
        $this->display("set/advertisement_add");
    }
    /**
     * 广告添加提交
     */
    public function advertisement_save()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
            return;
        }

        $aname = isset($_POST["aname"]) ? $_POST["aname"] : '';
        $aimg = isset($_POST["aimg"]) ? $_POST["aimg"] : '';
        $add_time = time();

        $advertisement_info = $this->set->getadvertisementByname($aname);
        if (!empty($advertisement_info)) {
            echo json_encode(array('error' => true, 'msg' => "该广告名称已经存在。"));
            return;
        }
        $result = $this->set->advertisement_save($aname, $aimg, $add_time);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
    /**
     * 广告删除
     */
    public function advertisement_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        if ($this->set->advertisement_delete($id)) {
            echo json_encode(array('success' => true, 'msg' => "删除成功"));
            return;
        } else {
            echo json_encode(array('success' => false, 'msg' => "删除失败"));
            return;
        }
    }
    /**
     * 广告修改页
     */
    public function advertisement_edit()
    {
        $aid = isset($_GET['aid']) ? $_GET['aid'] : 0;
        $advertisement_info = $this->set->getadvertisementById($aid);
        if (empty($advertisement_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $data = array();
        $data['aname'] = $advertisement_info['aname'];
        $data['aimg'] = $advertisement_info['aimg'];
        $data['aid'] = $aid;
        $this->display("set/advertisement_edit", $data);
    }
    /**
     * 广告修改提交
     */
    public function advertisement_save_edit()
    {
        if (empty($_SESSION['user_name'])) {
            echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
            return;
        }
        $aname = isset($_POST["aname"]) ? $_POST["aname"] : '';
        $aimg = isset($_POST["aimg"]) ? $_POST["aimg"] : '';
        $aid = isset($_POST["aid"]) ? $_POST["aid"] : '';
        $advertisement_info = $this->set->getadvertisementById2($aname, $aid);
        if (!empty($advertisement_info)){
            echo json_encode(array('error' => false, 'msg' => "该类型名称已经存在"));
            return;
        }

        $result = $this->set->advertisement_save_edit($aid,$aname,$aimg);
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }
}
