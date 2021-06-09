<?php

/**
 * **********************************************************************
 * サブシステム名  ： Task
 * 機能名         ：商品
 * 作成者        ： Gary
 * **********************************************************************
 */
class Goods extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['user_name'])) {
            header("Location:" . RUN . '/login/logout');
        }
        $this->load->model('Goods_model', 'goods');
        $this->load->model('Task_model', 'task');
        $this->load->model('Taskclass_model', 'taskclass');
		$this->load->model('Itemsclass_model', 'itemsclass');
        header("Content-type:text/html;charset=utf-8");
    }
    /**
     * 商品列表页
     */
    public function goods_list()
    {

        $gname = isset($_GET['gname']) ? $_GET['gname'] : '';
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $allpage = $this->goods->getgoodsAllPage($gname);
        $page = $allpage > $page ? $page : $allpage;
        $data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
        $data["page"] = $page;
        $data["allpage"] = $allpage;
        $list = $this->goods->getgoodsAllNew($page, $gname);

        $data["gname"] = $gname;
        foreach ($list as $k=>$v){
            $tidone = $this->taskclass->gettaskclassById($v['tid']);
            $list[$k]['tname'] = $tidone['tname'];
        }

        $data["list"] = $list;
        $this->display("goods/goods_list", $data);
    }
    /**
     * 商品添加页
     */
    public function goods_add()
    {
        $tidlist = $this->task->gettidlist();
        $data['tidlist'] = $tidlist;
        $this->display("goods/goods_add",$data);
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
        $tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
        $gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
        $gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
        $gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
        $gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
        $avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
        $gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
        $addtime = time();
        $status = isset($_POST["status"]) ? $_POST["status"] : '0';
        $goods_info = $this->goods->getgoodsByname($gname);
        if (!empty($goods_info)) {
            echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
            return;
        }
        $gid = $this->goods->goods_save($gname, $gtitle,$tid, $gsort,$gimg,$gcontent,$addtime,$status,$starttime);

        if ($gid) {
            if (!empty($avater)){
                foreach ($avater as $k=>$v){
                    $this->goods->goodsimg_save($gid,$v);
                }
            }

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
        if ($this->goods->goods_delete($id)) {
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
        $gid = isset($_GET['gid']) ? $_GET['gid'] : 0;
        $goods_info = $this->goods->getgoodsById($gid);
        if (empty($goods_info)) {
            echo json_encode(array('error' => true, 'msg' => "数据错误"));
            return;
        }
        $imgslist = $this->goods->getgoodsimgsAllNew($gid);
        $tidlist = $this->task->gettidlist();

        $data = array();
        $data['gname'] = $goods_info['gname'];
        $data['starttime'] = $goods_info['gtitle'];
        $data['gcontent'] = $goods_info['gcontent'];
        $data['gimg'] = $goods_info['gimg'];
        $data['gsort'] = $goods_info['gsort'];
        $data['status'] = $goods_info['status'];
        $data['gid'] = $gid;
        $data['tid'] = $goods_info['tid'];
        $data['imgsall'] = $imgslist;
        $data['tidlist'] = $tidlist;
        $this->display("goods/goods_edit", $data);
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
        $gid = isset($_POST["gid"]) ? $_POST["gid"] : '';
        $gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
        $gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
        $tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
        $gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
        $gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
        $avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
        $gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
        $status = isset($_POST["status"]) ? $_POST["status"] : '0';
        $goods_info = $this->goods->getgoodsById2($gname,$gid);
        if (!empty($goods_info)) {
            echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
            return;
        }

        $result = $this->goods->goods_save_edit($gid, $gname, $gtitle, $tid, $gsort, $gimg, $gcontent,$status,$starttime);
        $this->goods->goodsimg_delete($gid);
        if (!empty($avater)){
            foreach ($avater as $k=>$v){
                $this->goods->goodsimg_save($gid,$v);
            }
        }
        if ($result) {
            echo json_encode(array('success' => true, 'msg' => "操作成功。"));
            return;
        } else {
            echo json_encode(array('error' => false, 'msg' => "操作失败"));
            return;
        }
    }


	/**
	 * 商品列表页
	 */
	public function goods_list1()
	{

		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->goods->getgoodsAllPage1($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->goods->getgoodsAllNew1($page, $gname);

		$data["gname"] = $gname;

		$data["list"] = $list;
		$this->display("goods/goods_list1", $data);
	}
	/**
	 * 商品添加页
	 */
	public function goods_add1()
	{
		$this->display("goods/goods_add1");
	}
	/**
	 * 商品添加提交
	 */
	public function goods_save1()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$addtime = time();
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsByname1($gname);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$gid = $this->goods->goods_save1($gname, $gtitle,$tid, $gsort,$gimg,$gcontent,$addtime,$status,$starttime);

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
	public function goods_delete1()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->goods->goods_delete1($id)) {
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
	public function goods_edit1()
	{
		$gid = isset($_GET['gid']) ? $_GET['gid'] : 0;
		$goods_info = $this->goods->getgoodsById1($gid);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$data = array();
		$data['gname'] = $goods_info['gname'];
		$data['starttime'] = $goods_info['gtitle'];
		$data['gcontent'] = $goods_info['gcontent'];
		$data['gimg'] = $goods_info['gimg'];
		$data['gsort'] = $goods_info['gsort'];

		$data['gid'] = $gid;


		$this->display("goods/goods_edit1", $data);
	}
	/**
	 * 商品修改提交
	 */
	public function goods_save_edit1()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$gid = isset($_POST["gid"]) ? $_POST["gid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsById21($gname,$gid);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$result = $this->goods->goods_save_edit1($gid, $gname, $gtitle, $tid, $gsort, $gimg, $gcontent,$status,$starttime);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}




	/**
	 * 商品列表页
	 */
	public function goods_list2()
	{

		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->goods->getgoodsAllPage2($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->goods->getgoodsAllNew2($page, $gname);

		$data["gname"] = $gname;

		$data["list"] = $list;
		$this->display("goods/goods_list2", $data);
	}
	/**
	 * 商品添加页
	 */
	public function goods_add2()
	{
		$this->display("goods/goods_add2");
	}
	/**
	 * 商品添加提交
	 */
	public function goods_save2()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$addtime = time();
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsByname2($gname);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$gid = $this->goods->goods_save2($gname, $gtitle,$tid, $gsort,$gimg,$gcontent,$addtime,$status,$starttime);

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
	public function goods_delete2()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->goods->goods_delete2($id)) {
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
	public function goods_edit2()
	{
		$gid = isset($_GET['gid']) ? $_GET['gid'] : 0;
		$goods_info = $this->goods->getgoodsById12($gid);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$data = array();
		$data['gname'] = $goods_info['gname'];
		$data['starttime'] = $goods_info['gtitle'];
		$data['gcontent'] = $goods_info['gcontent'];
		$data['gimg'] = $goods_info['gimg'];
		$data['gsort'] = $goods_info['gsort'];

		$data['gid'] = $gid;


		$this->display("goods/goods_edit2", $data);
	}
	/**
	 * 商品修改提交
	 */
	public function goods_save_edit2()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$gid = isset($_POST["gid"]) ? $_POST["gid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsById22($gname,$gid);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$result = $this->goods->goods_save_edit2($gid, $gname, $gtitle, $tid, $gsort, $gimg, $gcontent,$status,$starttime);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}




	/**
	 * 商品列表页
	 */
	public function goods_list3()
	{

		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->goods->getgoodsAllPage3($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->goods->getgoodsAllNew3($page, $gname);

		$data["gname"] = $gname;

		$data["list"] = $list;
		$this->display("goods/goods_list3", $data);
	}
	/**
	 * 商品添加页
	 */
	public function goods_add3()
	{
		$this->display("goods/goods_add3");
	}
	/**
	 * 商品添加提交
	 */
	public function goods_save3()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$addtime = time();
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsByname3($gname);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$gid = $this->goods->goods_save3($gname, $gtitle,$tid, $gsort,$gimg,$gcontent,$addtime,$status,$starttime);

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
	public function goods_delete3()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->goods->goods_delete3($id)) {
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
	public function goods_edit3()
	{
		$gid = isset($_GET['gid']) ? $_GET['gid'] : 0;
		$goods_info = $this->goods->getgoodsById123($gid);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$data = array();
		$data['gname'] = $goods_info['gname'];
		$data['starttime'] = $goods_info['gtitle'];
		$data['gcontent'] = $goods_info['gcontent'];
		$data['gimg'] = $goods_info['gimg'];
		$data['gsort'] = $goods_info['gsort'];

		$data['gid'] = $gid;


		$this->display("goods/goods_edit3", $data);
	}
	/**
	 * 商品修改提交
	 */
	public function goods_save_edit3()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$gid = isset($_POST["gid"]) ? $_POST["gid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsById223($gname,$gid);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$result = $this->goods->goods_save_edit3($gid, $gname, $gtitle, $tid, $gsort, $gimg, $gcontent,$status,$starttime);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}





	/**
	 * 商品列表页
	 */
	public function goods_list4()
	{

		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->goods->getgoodsAllPage4($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->goods->getgoodsAllNew4($page, $gname);

		$data["gname"] = $gname;

		$data["list"] = $list;
		$this->display("goods/goods_list4", $data);
	}
	/**
	 * 商品添加页
	 */
	public function goods_add4()
	{
		$this->display("goods/goods_add4");
	}
	/**
	 * 商品添加提交
	 */
	public function goods_save4()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$addtime = time();
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsByname4($gname);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$gid = $this->goods->goods_save4($gname, $gtitle,$tid, $gsort,$gimg,$gcontent,$addtime,$status,$starttime);

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
	public function goods_delete4()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->goods->goods_delete4($id)) {
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
	public function goods_edit4()
	{
		$gid = isset($_GET['gid']) ? $_GET['gid'] : 0;
		$goods_info = $this->goods->getgoodsById1234($gid);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$data = array();
		$data['gname'] = $goods_info['gname'];
		$data['starttime'] = $goods_info['gtitle'];
		$data['gcontent'] = $goods_info['gcontent'];
		$data['gimg'] = $goods_info['gimg'];
		$data['gsort'] = $goods_info['gsort'];

		$data['gid'] = $gid;


		$this->display("goods/goods_edit4", $data);
	}
	/**
	 * 商品修改提交
	 */
	public function goods_save_edit4()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$gid = isset($_POST["gid"]) ? $_POST["gid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsById2234($gname,$gid);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$result = $this->goods->goods_save_edit4($gid, $gname, $gtitle, $tid, $gsort, $gimg, $gcontent,$status,$starttime);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}






	/**
	 * 商品列表页
	 */
	public function goods_list5()
	{

		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->goods->getgoodsAllPage5($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->goods->getgoodsAllNew5($page, $gname);

		$data["gname"] = $gname;

		$data["list"] = $list;
		$this->display("goods/goods_list5", $data);
	}
	/**
	 * 商品添加页
	 */
	public function goods_add5()
	{
		$this->display("goods/goods_add5");
	}
	/**
	 * 商品添加提交
	 */
	public function goods_save5()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$addtime = time();
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsByname5($gname);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$gid = $this->goods->goods_save5($gname, $gtitle,$tid, $gsort,$gimg,$gcontent,$addtime,$status,$starttime);

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
	public function goods_delete5()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->goods->goods_delete5($id)) {
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
	public function goods_edit5()
	{
		$gid = isset($_GET['gid']) ? $_GET['gid'] : 0;
		$goods_info = $this->goods->getgoodsById12345($gid);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$data = array();
		$data['gname'] = $goods_info['gname'];
		$data['starttime'] = $goods_info['gtitle'];
		$data['gcontent'] = $goods_info['gcontent'];
		$data['gimg'] = $goods_info['gimg'];
		$data['gsort'] = $goods_info['gsort'];

		$data['gid'] = $gid;


		$this->display("goods/goods_edit5", $data);
	}
	/**
	 * 商品修改提交
	 */
	public function goods_save_edit5()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$gid = isset($_POST["gid"]) ? $_POST["gid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsById22345($gname,$gid);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$result = $this->goods->goods_save_edit5($gid, $gname, $gtitle, $tid, $gsort, $gimg, $gcontent,$status,$starttime);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}







	/**
	 * 商品列表页
	 */
	public function goods_list6()
	{

		$gname = isset($_GET['gname']) ? $_GET['gname'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->goods->getgoodsAllPage6($gname);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->goods->getgoodsAllNew6($page, $gname);

		$data["gname"] = $gname;

		$data["list"] = $list;
		$this->display("goods/goods_list6", $data);
	}
	/**
	 * 商品添加页
	 */
	public function goods_add6()
	{
		$this->display("goods/goods_add6");
	}
	/**
	 * 商品添加提交
	 */
	public function goods_save6()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$addtime = time();
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsByname6($gname);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$gid = $this->goods->goods_save6($gname, $gtitle,$tid, $gsort,$gimg,$gcontent,$addtime,$status,$starttime);

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
	public function goods_delete6()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->goods->goods_delete6($id)) {
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
	public function goods_edit6()
	{
		$gid = isset($_GET['gid']) ? $_GET['gid'] : 0;
		$goods_info = $this->goods->getgoodsById123456($gid);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}

		$data = array();
		$data['gname'] = $goods_info['gname'];
		$data['starttime'] = $goods_info['gtitle'];
		$data['gcontent'] = $goods_info['gcontent'];
		$data['gimg'] = $goods_info['gimg'];
		$data['gsort'] = $goods_info['gsort'];

		$data['gid'] = $gid;


		$this->display("goods/goods_edit6", $data);
	}
	/**
	 * 商品修改提交
	 */
	public function goods_save_edit6()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$gid = isset($_POST["gid"]) ? $_POST["gid"] : '';
		$gname = isset($_POST["gname"]) ? $_POST["gname"] : '';
		$gtitle = isset($_POST["gtitle"]) ? $_POST["gtitle"] : '';
		$tid = isset($_POST["tid"]) ? $_POST["tid"] : '';
		$starttime = isset($_POST["starttime"]) ? $_POST["starttime"] : '';
		$gsort = isset($_POST["gsort"]) ? $_POST["gsort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
		$gcontent = isset($_POST["gcontent"]) ? $_POST["gcontent"] : '';
		$status = isset($_POST["status"]) ? $_POST["status"] : '0';
		$goods_info = $this->goods->getgoodsById223456($gname,$gid);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$result = $this->goods->goods_save_edit6($gid, $gname, $gtitle, $tid, $gsort, $gimg, $gcontent,$status,$starttime);
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}






	/**
	 * 兴趣商品
	 */
	public function goods_news()
	{
		$mid = isset($_GET['mid']) ? $_GET['mid'] : '';
		$ename = isset($_GET['ename']) ? $_GET['ename'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->goods->getinterestAllPage($ename,$mid);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->goods->getinterestAllNew($page,$ename,$mid);
		$data["mid"] = $mid;
		$data["ename"] = $ename;
		$data["list"] = $list;
		$this->display("goods/goods_news", $data);
	}
	/**
	 * 商品列表页
	 */
	public function items_list()
	{

		$ename = isset($_GET['ename']) ? $_GET['ename'] : '';
		$page = isset($_GET["page"]) ? $_GET["page"] : 1;
		$allpage = $this->goods->getitemsAllPage($ename);
		$page = $allpage > $page ? $page : $allpage;
		$data["pagehtml"] = $this->getpage($page, $allpage, $_GET);
		$data["page"] = $page;
		$data["allpage"] = $allpage;
		$list = $this->goods->getitemsAllNew($page, $ename);

		$data["ename"] = $ename;
		foreach ($list as $k=>$v){
			$tidone = $this->itemsclass->getitemsclassById($v['cid']);
			$list[$k]['cname'] = $tidone['cname'];
		}

		$data["list"] = $list;
		$this->display("goods/items_list", $data);
	}
	/**
	 * 商品添加页
	 */
	public function items_add()
	{
		$tidlist = $this->task->getcidlist();
		$data['tidlist'] = $tidlist;
		$this->display("goods/items_add",$data);
	}
	/**
	 * 商品添加提交
	 */
	public function items_save()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法添加数据"));
			return;
		}
		$cid = isset($_POST["cid"]) ? $_POST["cid"] : '';
		$ename = isset($_POST["ename"]) ? $_POST["ename"] : '';
		$etitle = isset($_POST["etitle"]) ? $_POST["etitle"] : '';
		$unitprice = isset($_POST["unitprice"]) ? $_POST["unitprice"] : '';
		$unitnums = isset($_POST["unitnums"]) ? $_POST["unitnums"] : '';
		$batchprice = isset($_POST["batchprice"]) ? $_POST["batchprice"] : '';
		$batchnums = isset($_POST["batchnums"]) ? $_POST["batchnums"] : '';
		$topprice = isset($_POST["topprice"]) ? $_POST["topprice"] : '';
		$topnums = isset($_POST["topnums"]) ? $_POST["topnums"] : '';
		$sumnums = isset($_POST["sumnums"]) ? $_POST["sumnums"] : '';
		$place = isset($_POST["place"]) ? $_POST["place"] : '';
		$delivery = isset($_POST["delivery"]) ? $_POST["delivery"] : '';
		$esort = isset($_POST["esort"]) ? $_POST["esort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
		$content = isset($_POST["content"]) ? $_POST["content"] : '';
		$parameter = isset($_POST["parameter"]) ? $_POST["parameter"] : '';
		$addtime = time();
		$ishot = isset($_POST["ishot"]) ? $_POST["ishot"] : '0';
		$goods_info = $this->goods->getitemsByname($ename);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}
		$gid = $this->goods->items_save($topprice,$topnums,$cid,$ename,$etitle,$unitprice,$unitnums,$batchprice,$batchnums,$sumnums,$place,$delivery,$esort,$gimg,$content,$parameter,$addtime,$ishot);

		if ($gid) {
			if (!empty($avater)){
				foreach ($avater as $k=>$v){
					$this->goods->itemsimg_save($gid,$v);
				}
			}

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
	public function items_delete()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		if ($this->goods->items_delete($id)) {
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
	public function items_edit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$goods_info = $this->goods->getitemsById($id);
		if (empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "数据错误"));
			return;
		}
		$imgslist = $this->goods->getitemsimgsAllNew($id);
		$tidlist = $this->task->getcidlist();

		$data = array();
		$data['ename'] = $goods_info['ename'];
		$data['etitle'] = $goods_info['etitle'];
		$data['img'] = $goods_info['img'];
		$data['ishot'] = $goods_info['ishot'];
		$data['unitprice'] = $goods_info['unitprice'];
		$data['unitnums'] = $goods_info['unitnums'];
		$data['batchprice'] = $goods_info['batchprice'];
		$data['batchnums'] = $goods_info['batchnums'];
		$data['topprice'] = $goods_info['topprice'];
		$data['topnums'] = $goods_info['topnums'];
		$data['sumnums'] = $goods_info['sumnums'];
		$data['place'] = $goods_info['place'];
		$data['delivery'] = $goods_info['delivery'];
		$data['content'] = $goods_info['content'];
		$data['parameter'] = $goods_info['parameter'];
		$data['esort'] = $goods_info['esort'];
		$data['id'] = $id;
		$data['cid'] = $goods_info['cid'];
		$data['imgsall'] = $imgslist;
		$data['tidlist'] = $tidlist;
		$this->display("goods/items_edit", $data);
	}
	/**
	 * 商品修改提交
	 */
	public function items_save_edit()
	{
		if (empty($_SESSION['user_name'])) {
			echo json_encode(array('error' => false, 'msg' => "无法修改数据"));
			return;
		}
		$id = isset($_POST["id"]) ? $_POST["id"] : '';
		$cid = isset($_POST["cid"]) ? $_POST["cid"] : '';
		$ename = isset($_POST["ename"]) ? $_POST["ename"] : '';
		$etitle = isset($_POST["etitle"]) ? $_POST["etitle"] : '';
		$unitprice = isset($_POST["unitprice"]) ? $_POST["unitprice"] : '';
		$unitnums = isset($_POST["unitnums"]) ? $_POST["unitnums"] : '';
		$batchprice = isset($_POST["batchprice"]) ? $_POST["batchprice"] : '';
		$batchnums = isset($_POST["batchnums"]) ? $_POST["batchnums"] : '';
		$topprice = isset($_POST["topprice"]) ? $_POST["topprice"] : '';
		$topnums = isset($_POST["topnums"]) ? $_POST["topnums"] : '';
		$sumnums = isset($_POST["sumnums"]) ? $_POST["sumnums"] : '';
		$place = isset($_POST["place"]) ? $_POST["place"] : '';
		$delivery = isset($_POST["delivery"]) ? $_POST["delivery"] : '';
		$esort = isset($_POST["esort"]) ? $_POST["esort"] : '';
		$gimg = isset($_POST["gimg"]) ? $_POST["gimg"] : '';
		$avater = isset($_POST["avater"]) ? $_POST["avater"] : '';
		$content = isset($_POST["content"]) ? $_POST["content"] : '';
		$parameter = isset($_POST["parameter"]) ? $_POST["parameter"] : '';
		$ishot = isset($_POST["ishot"]) ? $_POST["ishot"] : '0';
		$goods_info = $this->goods->getitemsById2($ename,$id);
		if (!empty($goods_info)) {
			echo json_encode(array('error' => true, 'msg' => "该名称已经存在。"));
			return;
		}

		$result = $this->goods->items_save_edit($topprice,$topnums,$id,$cid,$ename,$etitle,$unitprice,$unitnums,$batchprice,$batchnums,$sumnums,$place,$delivery,$esort,$gimg,$content,$parameter,$ishot);
		$this->goods->itemsimg_delete($id);
		if (!empty($avater)){
			foreach ($avater as $k=>$v){
				$this->goods->itemsimg_save($id,$v);
			}
		}
		if ($result) {
			echo json_encode(array('success' => true, 'msg' => "操作成功。"));
			return;
		} else {
			echo json_encode(array('error' => false, 'msg' => "操作失败"));
			return;
		}
	}
}
