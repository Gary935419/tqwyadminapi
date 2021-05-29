<?php


class Itemsclass_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //类型count
    public function getitemsclassAllPage($tname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($tname)) {
            $sqlw .= " and ( cname like '%" . $tname . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `itemsclass` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //类型list
    public function getitemsclassAllNew($pg,$tname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($tname)) {
            $sqlw .= " and ( cname like '%" . $tname . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `itemsclass` " . $sqlw . " order by addtime desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //类型save
    public function itemsclass_save($tname, $timg,$tsort,$ishot,$add_time,$careaname)
    {
        $tname = $this->db->escape($tname);
        $timg = $this->db->escape($timg);
        $tsort = $this->db->escape($tsort);
        $add_time = $this->db->escape($add_time);
		$ishot = $this->db->escape($ishot);
		$careaname = $this->db->escape($careaname);
        $sql = "INSERT INTO `itemsclass` (cname,cimg,csort,addtime,ishot,careaname) VALUES ($tname,$timg,$tsort,$add_time,$ishot,$careaname)";
        return $this->db->query($sql);
    }
    //类型delete
    public function itemsclass_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM itemsclass WHERE id = $id";
        return $this->db->query($sql);
    }
    //类型byid
    public function getitemsclassById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `itemsclass` where id=$id ";
        return $this->db->query($sql)->row_array();
    }
    //类型byname
    public function getitemsclassByname($tname)
    {
        $tname = $this->db->escape($tname);
        $sql = "SELECT * FROM `itemsclass` where cname=$tname ";
        return $this->db->query($sql)->row_array();
    }
    //类型byname id
    public function getitemsclassById2($tname, $tid)
    {
        $tname = $this->db->escape($tname);
        $tid = $this->db->escape($tid);
        $sql = "SELECT * FROM `itemsclass` where cname=$tname and id != $tid";
        return $this->db->query($sql)->row_array();
    }
    //类型save_edit
    public function itemsclass_save_edit($tid, $tname, $timg, $tsort,$ishot,$careaname)
    {
        $tid = $this->db->escape($tid);
        $tname = $this->db->escape($tname);
        $timg = $this->db->escape($timg);
        $tsort = $this->db->escape($tsort);
		$ishot = $this->db->escape($ishot);
		$careaname = $this->db->escape($careaname);
        $sql = "UPDATE `itemsclass` SET careaname=$careaname,ishot=$ishot,cname=$tname,cimg=$timg,csort=$tsort WHERE id = $tid";
        return $this->db->query($sql);
    }
}
