<?php


class Set_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //设置根据id
    public function getsetById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `setting` where sid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //设置set_save_edit
    public function set_save_edit($name,$contentagent,$email,$customercode,$address,$sid,$contentnew,$img,$price,$price1,$contentagent1)
    {
        $name = $this->db->escape($name);
        $email = $this->db->escape($email);
        $address = $this->db->escape($address);
        $sid = $this->db->escape($sid);
		$img = $this->db->escape($img);
		$price = $this->db->escape($price);
        $customercode = $this->db->escape($customercode);
        $contentnew = $this->db->escape($contentnew);
        $contentagent = $this->db->escape($contentagent);
		$price1 = $this->db->escape($price1);
		$contentagent1 = $this->db->escape($contentagent1);
        $sql = "UPDATE `setting` SET contentagent1=$contentagent1,price1=$price1,price=$price,img=$img,name=$name,contentagent=$contentagent,email=$email,contentnew=$contentnew,customercode=$customercode,address=$address WHERE sid = $sid";
        return $this->db->query($sql);
    }

	public function set_save_editer($sid,$ertext,$nameer,$emailer,$addresser,$imger,$customercodeer,$contentnewer,$contentagenter,$contentagent1er)
	{
		$ertext = $this->db->escape($ertext);
		$nameer = $this->db->escape($nameer);
		$emailer = $this->db->escape($emailer);
		$addresser = $this->db->escape($addresser);
		$imger = $this->db->escape($imger);
		$customercodeer = $this->db->escape($customercodeer);
		$contentnewer = $this->db->escape($contentnewer);
		$contentagenter = $this->db->escape($contentagenter);
		$contentagent1er = $this->db->escape($contentagent1er);
		$sid = $this->db->escape($sid);

		$sql = "UPDATE `setting` SET ertext=$ertext,nameer=$nameer,emailer=$emailer,addresser=$addresser,imger=$imger,customercodeer=$customercodeer,contentnewer=$contentnewer,contentagenter=$contentagenter,contentagent1er=$contentagent1er WHERE sid = $sid";
		return $this->db->query($sql);
	}

	public function set_save_editxin($sid,$xintext,$namexin,$emailxin,$addressxin,$imgxin,$customercodexin,$contentnewxin,$contentagentxin,$contentagent1xin)
	{
		$xintext = $this->db->escape($xintext);
		$namexin = $this->db->escape($namexin);
		$emailxin = $this->db->escape($emailxin);
		$addressxin = $this->db->escape($addressxin);
		$imgxin = $this->db->escape($imgxin);
		$customercodexin = $this->db->escape($customercodexin);
		$contentnewxin = $this->db->escape($contentnewxin);
		$contentagentxin = $this->db->escape($contentagentxin);
		$contentagent1xin = $this->db->escape($contentagent1xin);
		$sid = $this->db->escape($sid);

		$sql = "UPDATE `setting` SET xintext=$xintext,namexin=$namexin,emailxin=$emailxin,addressxin=$addressxin,imgxin=$imgxin,customercodexin=$customercodexin,contentnewxin=$contentnewxin,contentagentxin=$contentagentxin,contentagent1xin=$contentagent1xin WHERE sid = $sid";
		return $this->db->query($sql);
	}

	//设置set_save_edit
	public function set_save_edit_new($sid,$content,$id)
	{
		$content = $this->db->escape($content);
		$sid = $this->db->escape($sid);
		if ($id === '1'){
			$sql = "UPDATE `setting` SET content1=$content WHERE sid = $sid";
		}elseif ($id === '2'){
			$sql = "UPDATE `setting` SET content2=$content WHERE sid = $sid";
		}elseif ($id === '3'){
			$sql = "UPDATE `setting` SET content3=$content WHERE sid = $sid";
		}elseif ($id === '9'){
			$sql = "UPDATE `setting` SET content9=$content WHERE sid = $sid";
		}elseif ($id === '10'){
			$sql = "UPDATE `setting` SET content10=$content WHERE sid = $sid";
		}elseif ($id === '11'){
			$sql = "UPDATE `setting` SET content11=$content WHERE sid = $sid";
		}elseif ($id === '17'){
			$sql = "UPDATE `setting` SET content17=$content WHERE sid = $sid";
		}elseif ($id === '18'){
			$sql = "UPDATE `setting` SET content18=$content WHERE sid = $sid";
		}elseif ($id === '19'){
			$sql = "UPDATE `setting` SET content19=$content WHERE sid = $sid";
		}else{
			$sql = "UPDATE `setting` SET content19=$content WHERE sid = $sid";
		}
		return $this->db->query($sql);
	}
	public function set_save_edit_new_area($sid,$content,$id)
	{
		$content = $this->db->escape($content);
		$sid = $this->db->escape($sid);

		if ($id === '4'){
			$sql = "UPDATE `setting` SET content4=$content WHERE sid = $sid";
		}elseif ($id === '5'){
			$sql = "UPDATE `setting` SET content5=$content WHERE sid = $sid";
		}elseif ($id === '6'){
			$sql = "UPDATE `setting` SET content6=$content WHERE sid = $sid";
		}elseif ($id === '7'){
			$sql = "UPDATE `setting` SET content7=$content WHERE sid = $sid";
		}elseif ($id === '8'){
			$sql = "UPDATE `setting` SET content8=$content WHERE sid = $sid";
		}elseif ($id === '12'){
			$sql = "UPDATE `setting` SET content12=$content WHERE sid = $sid";
		}elseif ($id === '13'){
			$sql = "UPDATE `setting` SET content13=$content WHERE sid = $sid";
		}elseif ($id === '14'){
			$sql = "UPDATE `setting` SET content14=$content WHERE sid = $sid";
		}elseif ($id === '15'){
			$sql = "UPDATE `setting` SET content15=$content WHERE sid = $sid";
		}elseif ($id === '16'){
			$sql = "UPDATE `setting` SET content16=$content WHERE sid = $sid";
		}elseif ($id === '20'){
			$sql = "UPDATE `setting` SET content20=$content WHERE sid = $sid";
		}elseif ($id === '21'){
			$sql = "UPDATE `setting` SET content21=$content WHERE sid = $sid";
		}elseif ($id === '22'){
			$sql = "UPDATE `setting` SET content22=$content WHERE sid = $sid";
		}elseif ($id === '23'){
			$sql = "UPDATE `setting` SET content23=$content WHERE sid = $sid";
		}else{
			$sql = "UPDATE `setting` SET content24=$content WHERE sid = $sid";
		}
		return $this->db->query($sql);
	}
    //广告count
    public function getadvertisementAllPage($aname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($aname)) {
            $sqlw .= " and ( aname like '%" . $aname . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `advertisement` " . $sqlw;

        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //广告list
    public function getadvertisementAllNew($pg,$aname)
    {
        $sqlw = " where 1=1 ";
        if (!empty($aname)) {
            $sqlw .= " and ( aname like '%" . $aname . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;

        $sql = "SELECT * FROM `advertisement` " . $sqlw . " order by add_time desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //广告save
    public function advertisement_save($aname, $aimg, $add_time)
    {
        $aname = $this->db->escape($aname);
        $aimg = $this->db->escape($aimg);
        $add_time = $this->db->escape($add_time);

        $sql = "INSERT INTO `advertisement` (aname,aimg,add_time) VALUES ($aname,$aimg,$add_time)";
        return $this->db->query($sql);
    }
    //广告delete
    public function advertisement_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM advertisement WHERE aid = $id";
        return $this->db->query($sql);
    }
    //广告byid
    public function getadvertisementById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `advertisement` where aid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //广告byname
    public function getadvertisementByname($aname)
    {
        $aname = $this->db->escape($aname);
        $sql = "SELECT * FROM `advertisement` where aname=$aname ";
        return $this->db->query($sql)->row_array();
    }
    //类型byname id
    public function getadvertisementById2($aname, $aid)
    {
        $aname = $this->db->escape($aname);
        $aid = $this->db->escape($aid);
        $sql = "SELECT * FROM `advertisement` where aname=$aname and aid != $aid";
        return $this->db->query($sql)->row_array();
    }
    //广告save_edit
    public function advertisement_save_edit($aid,$aname,$aimg)
    {
        $aid = $this->db->escape($aid);
        $aname = $this->db->escape($aname);
        $aimg = $this->db->escape($aimg);
        $sql = "UPDATE `advertisement` SET aname=$aname,aimg=$aimg WHERE aid = $aid";
        return $this->db->query($sql);
    }
}
