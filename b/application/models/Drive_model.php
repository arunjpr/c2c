<?php
class Drive_model extends CI_Model {
    
    public function insertDriverApi($data) {
        $this->db->insert("drive_license", $data);
        if ($this->db->insert_id() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
     public  function getDriverDetailsApi($user_id) {
        $this->db->select(array("*"))
                ->from("drive_license")
                ->join('users', 'users.Id=drive_license.User_Id')
                ->where(array("users.Id" => $user_id, "users.Status" => 1));
        $query = $this->db->get();
//        echo  $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
   
}
