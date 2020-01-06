<?php
class User_model extends CI_Model {
    
    public  function get_users($user_id,$username) {
        $this->db->where([
                'Id'=>$user_id,
                'Name'=>$username
                ]);
        $query =$this->db->get('users');
        return $query->result();
    }
    
    public function create_users($data){
        $this->db->insert('users',$data);
    }
    public function update_users($data,$id){
        $this->db->where(['Id'=>$id]);
        $this->db->update('users',$data);
    }
    public function delete_user($id){
        $this->db->where(['Id'=>$id]);
        $this->db->delete('users');
    }
}
