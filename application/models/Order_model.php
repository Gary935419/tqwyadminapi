<?php


class Order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
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
