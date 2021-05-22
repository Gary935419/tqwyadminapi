<?php


class Goods_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //商品count
    public function getgoodsAllPage($gname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($gname)) {
            $sqlw .= " and ( gname like '%" . $gname . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `goods`" . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //商品list
    public function getgoodsAllNew($pg,$gname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($gname)) {
            $sqlw .= " and ( gname like '%" . $gname . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `goods` " . $sqlw . " order by gsort desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //商品图片list
    public function getgoodsimgsAllNew($gid)
    {
        $gid = $this->db->escape($gid);
        $sqlw = " where 1=1 and gid = $gid";
        $sql = "SELECT * FROM `gimgs` " . $sqlw;
        return $this->db->query($sql)->result_array();
    }
    //商品byname
    public function getgoodsByname($gname)
    {
        $gname = $this->db->escape($gname);
        $sql = "SELECT * FROM `goods` where gname=$gname ";
        return $this->db->query($sql)->row_array();
    }
    //商品save
    public function goods_save($gname, $gtitle,$tid, $gsort,$gimg,$gcontent,$addtime,$status,$starttime)
    {
        $gname = $this->db->escape($gname);
		$starttime = $this->db->escape($starttime);
        $gtitle = $this->db->escape($gtitle);
        $tid = $this->db->escape($tid);
        $gsort = $this->db->escape($gsort);
        $gimg = $this->db->escape($gimg);
        $gcontent = $this->db->escape($gcontent);
        $addtime = $this->db->escape($addtime);
        $status = $this->db->escape($status);
        $sql = "INSERT INTO `goods` (status,gname, gtitle,tid,gsort,gimg,gcontent,addtime) VALUES ($status,$gname, $starttime,$tid,$gsort,$gimg,$gcontent,$addtime)";
        $this->db->query($sql);
        $gid=$this->db->insert_id();
        return $gid;
    }
    //商品bannersave
    public function goodsimg_save($gid,$imgs)
    {
        $gid = $this->db->escape($gid);
        $imgs = $this->db->escape($imgs);
        $sql = "INSERT INTO `gimgs` (gid,imgs) VALUES ($gid,$imgs)";
        return $this->db->query($sql);;
    }
    //商品delete
    public function goods_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM goods WHERE gid = $id";
        return $this->db->query($sql);
    }
    //商品图片delete
    public function goodsimg_delete($gid)
    {
        $gid = $this->db->escape($gid);
        $sql = "DELETE FROM gimgs WHERE gid = $gid";
        return $this->db->query($sql);
    }
    //商品byid
    public function getgoodsById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `goods` where gid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //商品byname id
    public function getgoodsById2($gname, $gid)
    {
        $gname = $this->db->escape($gname);
        $gid = $this->db->escape($gid);
        $sql = "SELECT * FROM `goods` where gname=$gname and gid!=$gid ";
        return $this->db->query($sql)->row_array();
    }
    //商品save_edit
    public function goods_save_edit($gid, $gname, $gtitle, $tid, $gsort, $gimg, $gcontent,$status,$starttime)
    {
        $gid = $this->db->escape($gid);
        $gname = $this->db->escape($gname);
        $gtitle = $this->db->escape($gtitle);
        $tid = $this->db->escape($tid);
		$starttime = $this->db->escape($starttime);
        $gsort = $this->db->escape($gsort);
        $gimg = $this->db->escape($gimg);
        $gcontent = $this->db->escape($gcontent);
        $status = $this->db->escape($status);
        $sql = "UPDATE `goods` SET status=$status,gname=$gname,gtitle=$starttime,tid=$tid,gsort=$gsort,gimg=$gimg,gcontent=$gcontent WHERE gid = $gid";
        return $this->db->query($sql);
    }


	//兴趣商品count
	public function getinterestAllPage($ename,$mid)
	{
		$sqlw = " where 1=1 and uid = $mid";
		if (!empty($ename)) {
			$sqlw .= " and ( goodsname like '%" . $ename . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `interest`" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//兴趣商品list
	public function getinterestAllNew($pg,$ename,$mid)
	{
		$sqlw = " where 1=1 and uid = $mid";
		if (!empty($ename)) {
			$sqlw .= " and ( goodsname like '%" . $ename . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT * FROM `interest` " . $sqlw . " order by id desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}

	//商品count
	public function getitemsAllPage($ename)
	{
		$sqlw = " where 1=1 ";
		if (!empty($ename)) {
			$sqlw .= " and ( ename like '%" . $ename . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `items`" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//商品list
	public function getitemsAllNew($pg,$ename)
	{
		$sqlw = " where 1=1 ";
		if (!empty($ename)) {
			$sqlw .= " and ( ename like '%" . $ename . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT * FROM `items` " . $sqlw . " order by esort desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	//商品图片list
	public function getitemsimgsAllNew($id)
	{
		$id = $this->db->escape($id);
		$sqlw = " where 1=1 and eid = $id";
		$sql = "SELECT * FROM `itemsimg` " . $sqlw;
		return $this->db->query($sql)->result_array();
	}
	//商品byname
	public function getitemsByname($ename)
	{
		$ename = $this->db->escape($ename);
		$sql = "SELECT * FROM `items` where ename=$ename ";
		return $this->db->query($sql)->row_array();
	}
	//商品save
	public function items_save($topprice,$topnums,$cid,$ename,$etitle,$unitprice,$unitnums,$batchprice,$batchnums,$sumnums,$place,$delivery,$esort,$gimg,$content,$parameter,$addtime,$ishot)
	{
		$topprice = $this->db->escape($topprice);
		$topnums = $this->db->escape($topnums);
		$cid = $this->db->escape($cid);
		$ename = $this->db->escape($ename);
		$etitle = $this->db->escape($etitle);
		$unitprice = $this->db->escape($unitprice);
		$unitnums = $this->db->escape($unitnums);
		$batchprice = $this->db->escape($batchprice);
		$batchnums = $this->db->escape($batchnums);
		$sumnums = $this->db->escape($sumnums);
		$place = $this->db->escape($place);
		$delivery = $this->db->escape($delivery);
		$esort = $this->db->escape($esort);
		$gimg = $this->db->escape($gimg);
		$content = $this->db->escape($content);
		$parameter = $this->db->escape($parameter);
		$addtime = $this->db->escape($addtime);
		$ishot = $this->db->escape($ishot);
		$sql = "INSERT INTO `items` (topprice,topnums,cid,ename,etitle,unitprice,unitnums,batchprice,batchnums,sumnums,place,delivery,esort,img,content,parameter,addtime,ishot) VALUES ($topprice,$topnums,$cid,$ename,$etitle,$unitprice,$unitnums,$batchprice,$batchnums,$sumnums,$place,$delivery,$esort,$gimg,$content,$parameter,$addtime,$ishot)";
		$this->db->query($sql);
		$gid=$this->db->insert_id();
		return $gid;
	}
	//商品bannersave
	public function itemsimg_save($id,$imgs)
	{
		$id = $this->db->escape($id);
		$imgs = $this->db->escape($imgs);
		$sql = "INSERT INTO `itemsimg` (eid,img) VALUES ($id,$imgs)";
		return $this->db->query($sql);;
	}
	//商品delete
	public function items_delete($id)
	{
		$id = $this->db->escape($id);
		$sql = "DELETE FROM items WHERE id = $id";
		return $this->db->query($sql);
	}
	//商品图片delete
	public function itemsimg_delete($gid)
	{
		$gid = $this->db->escape($gid);
		$sql = "DELETE FROM itemsimg WHERE eid = $gid";
		return $this->db->query($sql);
	}
	//商品byid
	public function getitemsById($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `items` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
	//商品byname id
	public function getitemsById2($ename, $id)
	{
		$ename = $this->db->escape($ename);
		$gid = $this->db->escape($id);
		$sql = "SELECT * FROM `items` where ename=$ename and id!=$gid ";
		return $this->db->query($sql)->row_array();
	}
	//商品save_edit
	public function items_save_edit($topprice,$topnums,$id,$cid,$ename,$etitle,$unitprice,$unitnums,$batchprice,$batchnums,$sumnums,$place,$delivery,$esort,$gimg,$content,$parameter,$ishot)
	{
		$topprice = $this->db->escape($topprice);
		$topnums = $this->db->escape($topnums);
		$id = $this->db->escape($id);
		$cid = $this->db->escape($cid);
		$ename = $this->db->escape($ename);
		$etitle = $this->db->escape($etitle);
		$unitprice = $this->db->escape($unitprice);
		$unitnums = $this->db->escape($unitnums);
		$batchprice = $this->db->escape($batchprice);
		$batchnums = $this->db->escape($batchnums);
		$sumnums = $this->db->escape($sumnums);
		$place = $this->db->escape($place);
		$delivery = $this->db->escape($delivery);
		$esort = $this->db->escape($esort);
		$gimg = $this->db->escape($gimg);
		$content = $this->db->escape($content);
		$parameter = $this->db->escape($parameter);
		$ishot = $this->db->escape($ishot);
		$sql = "UPDATE `items` SET topprice=$topprice,topnums=$topnums,cid=$cid,ename=$ename,etitle=$etitle,unitprice=$unitprice,unitnums=$unitnums,batchprice=$batchprice,batchnums=$batchnums,sumnums=$sumnums,place=$place,delivery=$delivery,esort=$esort,img=$gimg,content=$content,parameter=$parameter,ishot=$ishot WHERE id = $id";
		return $this->db->query($sql);
	}
}
