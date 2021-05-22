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
            echo json_encode(array('error' => true, 'msg' => "该资讯名称已经存在。"));
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
            echo json_encode(array('error' => true, 'msg' => "该商家名称已经存在。"));
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
			echo json_encode(array('error' => true, 'msg' => "该商品名称已经存在。"));
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
			echo json_encode(array('error' => true, 'msg' => "该商品名称已经存在。"));
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
