<?php


class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->date = time();
        $this->load->database();
    }
    //登录账号密码验证
    public function isPass($name, $pwd)
    {

        $name = $this->db->escape($name);
        $pwd = md5($pwd);
        $sql = "SELECT * FROM `users` WHERE user_name= $name AND user_pass = '$pwd' ";

        $rest = $this->db->query($sql);

        if ($rest->num_rows() > 0) {
            return $this->db->query($sql)->row_array();
        } else {
            return false;
        }
    }
    //查询一条用户信息
    public function getUserById($user_name, $passold)
    {
        $user_name = $this->db->escape($user_name);
        $passold = $this->db->escape($passold);
        $sql = "SELECT * FROM `users` where user_name=$user_name and user_pass = md5($passold)";
        return $this->db->query($sql)->row_array();
    }
    //根据user_id获取用户是否注册
    public function getUserByUserId($uid)
    {
        $uid = $this->db->escape($uid);
        $sql = "SELECT * FROM `users` where uid=$uid";
        return $this->db->query($sql)->row_array();
    }
    //修改密码保存
    public function userpassportsave($user_name, $pass)
    {
        if (!empty($user_name)) {
            $user_name = $this->db->escape($user_name);
            $upass = md5($pass);
            $upass = $this->db->escape($upass);
            $sql = "UPDATE `users` SET `user_pass` =  $upass WHERE user_name = $user_name";
            return $this->db->query($sql);
        }
    }
    //会员录入
    public function usersave($user_name, $user_pass, $user_state, $rid)
    {
        $user_name = $this->db->escape($user_name);
        $user_pass = $this->db->escape($user_pass);
        $user_state = $this->db->escape($user_state);
        $rid = $this->db->escape($rid);
        $add_time = time();
        $sql = "INSERT INTO `users` (user_name,user_pass,user_state,rid,add_time) VALUES ($user_name,$user_pass,$user_state,$rid,$add_time);";
        return $this->db->query($sql);
    }
    //获取管理员信息
    public function getUserAllPage($user_name)
    {
        $sqlw = " where 1=1 ";
        if (!empty($user_name)) {
            $sqlw .= " and ( user_name like '%" . $user_name . "%' ) ";
        }
        $sql = "SELECT count(1) as number FROM `users` " . $sqlw;
        $number = $this->db->query($sql)->row()->number;
        return ceil($number / 10) == 0 ? 1 : ceil($number / 10);
    }
    //获取管理员信息
    public function getUserAll($pg, $user_name)
    {
        $sqlw = " where 1=1 ";
        if (!empty($user_name)) {
            $sqlw .= " and ( u.user_name like '%" . $user_name . "%' ) ";
        }
        $start = ($pg - 1) * 10;
        $stop = 10;
        $sql = "SELECT u.*,r.rname as rname FROM `users` u left join `role` r on u.rid=r.rid " . $sqlw . " order by u.uid desc LIMIT $start, $stop";
        return $this->db->query($sql)->result_array();
    }
    //获取角色列表
    public function getRole()
    {
        $sql = "SELECT * FROM `role` order by rid desc";
        return $this->db->query($sql)->result_array();
    }
    //根据账号
    public function getmemberById($user_name)
    {
        $user_name = $this->db->escape($user_name);
        $sql = "SELECT * FROM `users` where user_name = $user_name ";
        return $this->db->query($sql)->row_array();
    }
    //根据账号和id
    public function getmemberById2($user_name, $uid)
    {
        $user_name = $this->db->escape($user_name);
        $uid = $this->db->escape($uid);
        $sql = "SELECT * FROM `users` where user_name = $user_name and uid !=$uid";
        return $this->db->query($sql)->row_array();
    }
    //根据id
    public function getUserByIdnew($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM `users` where uid=$id ";
        return $this->db->query($sql)->row_array();
    }
    //会員save
    public function member_save($user_name, $user_pass, $rid, $user_state, $add_time)
    {
        $user_name = $this->db->escape($user_name);
        $user_pass = $this->db->escape($user_pass);
        $rid = $this->db->escape($rid);
        $user_state = $this->db->escape($user_state);
        $add_time = $this->db->escape($add_time);
        $sql = "INSERT INTO `users` (user_name,user_pass,rid,user_state,add_time) VALUES ($user_name,$user_pass,$rid,$user_state,$add_time)";
        return $this->db->query($sql);
    }
    //会員delete
    public function users_delete($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM users WHERE uid = $id";
        return $this->db->query($sql);
    }
    //会員users_save_edit
    public function users_save_edit($uid, $user_name, $user_pass, $rid, $user_state)
    {
        $uid = $this->db->escape($uid);
        $user_name = $this->db->escape($user_name);
        $user_pass = $this->db->escape($user_pass);
        $rid = $this->db->escape($rid);
        $user_state = $this->db->escape($user_state);

        $sql = "UPDATE `users` SET user_name=$user_name,user_pass=$user_pass,rid=$rid,user_state=$user_state WHERE uid = $uid";
        return $this->db->query($sql);
    }
}