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
	public function set_editer()
	{
		$sid = 1;
		$set_info = $this->set->getsetById($sid);
		$data['ertext'] = $set_info['ertext'];

		$data['name'] = $set_info['nameer'];
		$data['email'] = $set_info['emailer'];
		$data['img'] = $set_info['imger'];
		$data['address'] = $set_info['addresser'];
		$data['contentnew'] = $set_info['contentnewer'];
		$data['contentagent'] = $set_info['contentagenter'];
		$data['contentagent1'] = $set_info['contentagent1er'];
		$data['customercode'] = $set_info['customercodeer'];

		$this->display("set/set_editer", $data);
	}
	/**
	 * 设置修改提交
	 */
	public function set_save_editer()
	{

		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$sid = 1;
		$ertext = isset($_POST["ertext"]) ? $_POST["ertext"] : '';

		$nameer = isset($_POST["name"]) ? $_POST["name"] : '';
		$emailer = isset($_POST["email"]) ? $_POST["email"] : '';
		$addresser = isset($_POST["address"]) ? $_POST["address"] : '';
		$imger = isset($_POST["img"]) ? $_POST["img"] : '';
		$customercodeer = isset($_POST["customercode"]) ? $_POST["customercode"] : '';
		$contentnewer = isset($_POST["contentnew"]) ? $_POST["contentnew"] : '';
		$contentagenter = isset($_POST["contentagent"]) ? $_POST["contentagent"] : '';
		$contentagent1er = isset($_POST["contentagent1"]) ? $_POST["contentagent1"] : '';

		$result = $this->set->set_save_editer($sid,$ertext,$nameer,$emailer,$addresser,$imger,$customercodeer,$contentnewer,$contentagenter,$contentagent1er);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}

	}
	/**
	 * 设置修改页
	 */
	public function set_editxin()
	{
		$sid = 1;
		$set_info = $this->set->getsetById($sid);
		$data['xintext'] = $set_info['xintext'];

		$data['name'] = $set_info['namexin'];
		$data['email'] = $set_info['emailxin'];
		$data['img'] = $set_info['imgxin'];
		$data['address'] = $set_info['addressxin'];
		$data['contentnew'] = $set_info['contentnewxin'];
		$data['contentagent'] = $set_info['contentagentxin'];
		$data['contentagent1'] = $set_info['contentagent1xin'];
		$data['customercode'] = $set_info['customercodexin'];

		$this->display("set/set_editxin", $data);
	}
	/**
	 * 设置修改提交
	 */
	public function set_save_editxin()
	{

		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$sid = 1;
		$xintext = isset($_POST["xintext"]) ? $_POST["xintext"] : '';
		$namexin = isset($_POST["name"]) ? $_POST["name"] : '';
		$emailxin = isset($_POST["email"]) ? $_POST["email"] : '';
		$addressxin = isset($_POST["address"]) ? $_POST["address"] : '';
		$imgxin = isset($_POST["img"]) ? $_POST["img"] : '';
		$customercodexin = isset($_POST["customercode"]) ? $_POST["customercode"] : '';
		$contentnewxin = isset($_POST["contentnew"]) ? $_POST["contentnew"] : '';
		$contentagentxin = isset($_POST["contentagent"]) ? $_POST["contentagent"] : '';
		$contentagent1xin = isset($_POST["contentagent1"]) ? $_POST["contentagent1"] : '';
		$result = $this->set->set_save_editxin($sid,$xintext,$namexin,$emailxin,$addressxin,$imgxin,$customercodexin,$contentnewxin,$contentagentxin,$contentagent1xin);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}

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
		$data['contentagent1'] = $set_info['contentagent1'];
		$data['price1'] = $set_info['price1'];
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
		$price1 = isset($_POST["price1"]) ? $_POST["price1"] : '';
        $customercode = isset($_POST["customercode"]) ? $_POST["customercode"] : '';
        $contentnew = isset($_POST["contentnew"]) ? $_POST["contentnew"] : '';
        $contentagent = isset($_POST["contentagent"]) ? $_POST["contentagent"] : '';
		$contentagent1 = isset($_POST["contentagent1"]) ? $_POST["contentagent1"] : '';
        $result = $this->set->set_save_edit($name,$contentagent,$email,$customercode,$address,$sid,$contentnew,$img,$price,$price1,$contentagent1);
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
		$id = isset($_GET['id']) ? $_GET['id'] : 1;
		$set_info = $this->set->getsetById($sid);
		$data['id'] = $id;
		if ($id == 1){
			$data['msg'] = "重点学校分析编辑";
			$data['content'] = $set_info['content1'];
		}elseif ($id == 2){
			$data['msg'] = "重点学校预警编辑";
			$data['content'] = $set_info['content2'];
		}elseif ($id == 3){
			$data['msg'] = "教育相关政策编辑";
			$data['content'] = $set_info['content3'];
		}elseif ($id == 9){
			$data['msg'] = "自住房分析编辑";
			$data['content'] = $set_info['content9'];
		}elseif ($id == 10){
			$data['msg'] = "自住房预警编辑";
			$data['content'] = $set_info['content10'];
		}elseif ($id == 11){
			$data['msg'] = "自住房政策编辑";
			$data['content'] = $set_info['content11'];
		}elseif ($id == 17){
			$data['msg'] = "投资房分析编辑";
			$data['content'] = $set_info['content17'];
		}elseif ($id == 18){
			$data['msg'] = "投资房预警编辑";
			$data['content'] = $set_info['content18'];
		}elseif ($id == 19){
			$data['msg'] = "投资房政策编辑";
			$data['content'] = $set_info['content19'];
		}else{
			$data['msg'] = "数据错误";
		}
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
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$content = isset($_POST["content"]) ? $_POST["content"] : '';
		$result = $this->set->set_save_edit_new($sid,$content,$id);
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
		$id = isset($_GET['id']) ? $_GET['id'] : 1;
		$set_info = $this->set->getsetById($sid);
		$data['id'] = $id;
		if ($id == 4 || $id == 12 || $id == 20){
			$data['msg'] = "区域分析 --- 中山区";
			if ($id == 4){
				$data['content'] = $set_info['content4'];
			}
			if ($id == 12){
				$data['content'] = $set_info['content12'];
			}
			if ($id == 20){
				$data['content'] = $set_info['content20'];
			}
		}elseif ($id == 5 || $id == 13 || $id == 21){
			$data['msg'] = "区域分析 --- 西岗区";
			if ($id == 5){
				$data['content'] = $set_info['content5'];
			}
			if ($id == 13){
				$data['content'] = $set_info['content13'];
			}
			if ($id == 21){
				$data['content'] = $set_info['content21'];
			}
		}elseif ($id == 6 || $id == 14 || $id == 22){
			$data['msg'] = "区域分析 --- 沙河口区";
			if ($id == 6){
				$data['content'] = $set_info['content6'];
			}
			if ($id == 14){
				$data['content'] = $set_info['content14'];
			}
			if ($id == 22){
				$data['content'] = $set_info['content22'];
			}
		}elseif ($id == 7 || $id == 15 || $id == 23){
			$data['msg'] = "区域分析 --- 甘井子区";
			if ($id == 7){
				$data['content'] = $set_info['content7'];
			}
			if ($id == 15){
				$data['content'] = $set_info['content15'];
			}
			if ($id == 23){
				$data['content'] = $set_info['content23'];
			}
		}elseif ($id == 8 || $id == 16 || $id == 24){
			$data['msg'] = "区域分析 --- 高新园区";
			if ($id == 8){
				$data['content'] = $set_info['content8'];
			}
			if ($id == 16){
				$data['content'] = $set_info['content16'];
			}
			if ($id == 24){
				$data['content'] = $set_info['content24'];
			}
		}else{
			$data['msg'] = "数据错误";
		}
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
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$content = isset($_POST["content"]) ? $_POST["content"] : '';
		$result = $this->set->set_save_edit_new_area($sid,$content,$id);
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
