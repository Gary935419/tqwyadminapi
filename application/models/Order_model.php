<?php


class Order_model extends CI_Model
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
		$sqlw = " where 1=1 and is_delete != 1";
		if (!empty($gname)) {
			$sqlw .= " and ( gname like '%" . $gname . "%' ) ";
		}
		$sql = "SELECT count(1) as number FROM `reportlist`" . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//商品list
	public function getgoodsAll($pg,$gname)
	{
		$sqlw = " where 1=1 and is_delete != 1";
		if (!empty($gname)) {
			$sqlw .= " and ( gname like '%" . $gname . "%' ) ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT * FROM `reportlist` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
	//商品byname
	public function getgoodsByname($gname)
	{
		$gname = $this->db->escape($gname);
		$sql = "SELECT * FROM `reportlist` where gname=$gname ";
		return $this->db->query($sql)->row_array();
	}
	//商品save
	public function goods_save($gname,$gtype,$schoolname,$typename,$pricename,$areaname,$classname,$gcontent,$addtime,$is_delete)
	{
		$gname = $this->db->escape($gname);
		$gtype = $this->db->escape($gtype);
		$schoolname = $this->db->escape($schoolname);
		$typename = $this->db->escape($typename);
		$pricename = $this->db->escape($pricename);
		$areaname = $this->db->escape($areaname);
		$classname = $this->db->escape($classname);
		$gcontent = $this->db->escape($gcontent);
		$addtime = $this->db->escape($addtime);
		$is_delete = $this->db->escape($is_delete);
		$sql = "INSERT INTO `reportlist` (gname,gtype,schoolname,typename,pricename,areaname,classname,gcontent,addtime,is_delete) VALUES ($gname,$gtype,$schoolname,$typename,$pricename,$areaname,$classname,$gcontent,$addtime,$is_delete)";
		$this->db->query($sql);
		$gid=$this->db->insert_id();
		$sql1 = "UPDATE `reportlist` SET addtime=$addtime WHERE gname = $gname and schoolname = $schoolname and typename = $typename and pricename = $pricename and areaname = $areaname and classname = $classname and is_delete != 1";
		$this->db->query($sql1);
		return $gid;
	}
	//商品byid
	public function getgoodsById($id)
	{
		$id = $this->db->escape($id);
		$sql = "SELECT * FROM `reportlist` where id=$id ";
		return $this->db->query($sql)->row_array();
	}
	//商品byname id
	public function getgoodsById2($gname, $gid)
	{
		$gname = $this->db->escape($gname);
		$gid = $this->db->escape($gid);
		$sql = "SELECT * FROM `reportlist` where gname=$gname and id!=$gid ";
		return $this->db->query($sql)->row_array();
	}
	//商品save_edit
	public function goods_save_edit($id,$gname,$gtype,$schoolname,$typename,$pricename,$areaname,$classname,$gcontent,$addtime,$is_delete)
	{
		$id = $this->db->escape($id);
		$gname = $this->db->escape($gname);
		$gtype = $this->db->escape($gtype);
		$schoolname = $this->db->escape($schoolname);
		$typename = $this->db->escape($typename);
		$pricename = $this->db->escape($pricename);
		$areaname = $this->db->escape($areaname);
		$classname = $this->db->escape($classname);
		$gcontent = $this->db->escape($gcontent);
		$addtime = $this->db->escape($addtime);
		$is_delete = $this->db->escape($is_delete);
		$sql = "UPDATE `reportlist` SET gname=$gname,gtype=$gtype,schoolname=$schoolname,typename=$typename,pricename=$pricename,areaname=$areaname,classname=$classname,gcontent=$gcontent,addtime=$addtime WHERE id = $id";
		$this->db->query($sql);
		$sql1 = "UPDATE `reportlist` SET addtime=$addtime WHERE gname = $gname and schoolname = $schoolname and typename = $typename and pricename = $pricename and areaname = $areaname and classname = $classname and is_delete != 1";
		return $this->db->query($sql1);
	}
//商品save_edit
	public function goods_save_delete($id)
	{
		$id = $this->db->escape($id);
		$sql = "UPDATE `reportlist` SET is_delete=1 WHERE id = $id";
		return $this->db->query($sql);
	}
	//充值count
    public function getrechargeorderAllPage($starttime,$end)
    {
        $sqlw = " where 1=1 ";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.add_time >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time <= $end ";
        }
        $sql = "SELECT count(1) as number FROM `rechargeorder` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //充值list
    public function getrechargeorderAll($pg,$starttime,$end)
    {
        $sqlw = " where 1=1 ";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.add_time >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time <= $end ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT m.*,me.nickname FROM `rechargeorder` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw . " order by m.add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //任务count
    public function gettaskorderAllPage($starttime,$end)
    {
        $sqlw = " where 1=1 ";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.add_time >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time <= $end ";
        }
        $sql = "SELECT count(1) as number FROM `taorder` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //任务list
    public function gettaskorderAll($pg,$starttime,$end)
    {
        $sqlw = " where 1=1 ";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time >= $starttime and m.add_time <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.add_time >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.add_time <= $end ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT m.*,me.nickname FROM `taorder` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw . " order by m.add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //合作订单商家count
    public function getintegralorderAllPage($starttime,$end)
    {
        $sqlw = " where 1=1 ";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.addtime >= $starttime and m.addtime <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.addtime >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.addtime <= $end ";
        }
        $sql = "SELECT count(1) as number FROM `ordergoods` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //合作订单商家list
    public function getintegralorderAll($pg,$starttime,$end)
    {
        $sqlw = " where 1=1 ";
        if (!empty($starttime) && !empty($end)) {
            $starttime = strtotime($starttime);
            $end = strtotime($end)+86400;
            $sqlw .= " and m.addtime >= $starttime and m.addtime <= $end ";
        } elseif (!empty($starttime) && empty($end)) {
            $starttime = strtotime($starttime);
            $sqlw .= " and m.addtime >= $starttime ";
        } elseif (empty($starttime) && !empty($end)) {
            $end = strtotime($end)+86400;
            $sqlw .= " and m.addtime <= $end ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT m.*,me.nickname FROM `ordergoods` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw . " order by m.addtime desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }

	//合作订单商品count
	public function getgoodsorderAllPage($starttime,$end)
	{
		$sqlw = " where 1=1 ";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.addtime >= $starttime and m.addtime <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.addtime >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.addtime <= $end ";
		}
		$sql = "SELECT count(1) as number FROM `reportorder` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw;

		$number = $this->db->query($sql)->row()->number;
		return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
	}
	//合作订单商品list
	public function getgoodsorderAll($pg,$starttime,$end)
	{
		$sqlw = " where 1=1 ";
		if (!empty($starttime) && !empty($end)) {
			$starttime = strtotime($starttime);
			$end = strtotime($end)+86400;
			$sqlw .= " and m.addtime >= $starttime and m.addtime <= $end ";
		} elseif (!empty($starttime) && empty($end)) {
			$starttime = strtotime($starttime);
			$sqlw .= " and m.addtime >= $starttime ";
		} elseif (empty($starttime) && !empty($end)) {
			$end = strtotime($end)+86400;
			$sqlw .= " and m.addtime <= $end ";
		}
		$start = ($pg - 1) * 10;
		$stop = 10;

		$sql = "SELECT m.*,me.nickname,me.avater FROM `reportorder` m  LEFT JOIN `member` me ON me.mid = m.mid " . $sqlw . " order by m.addtime desc LIMIT $start, $stop";
		return $this->db->query($sql)->result_array();
	}
}
