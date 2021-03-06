<?php  
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Driver_model extends CI_Model { 
    public function __construct() { 
        parent::__construct(); 
    }
    private $_users = 'users'; 
    private $_drive_license = 'tbl_drive_license'; 
    
    public function check_login_info() {
        $username_or_email_address = $this->input->post('username_or_email_address', true);
        $password = $this->input->post('password', true);
        $this->db->select('*')
                ->from('users')
                ->where("(Name = '$username_or_email_address' OR Email = '$username_or_email_address')")
                ->where('password', md5($password))
                ->where("(Role_Id = '1' OR Role_Id = '2')")
                ->where('Status', 1)
                ->where('deletion_status', 0)
                ->where('Role_Id <= ', 5);
        $query_result = $this->db->get();
//         echo  $this->db->last_query();die;
        $result = $query_result->row();
        return $result;

    }
    public function get_dropdownData() { 
        $this->db->order_by('v_vehicle_name','ASC');
        $this->db->select(array('v_Id','v_vehicle_name','v_vehicle_number')) 
                ->from('vehicle')
                ->where('v_status', 1)
              //  ->where('v_type_id', 1)
                ->where('v_delete', 0)
                ;
        $query_result = $this->db->get(); 
        $result = $query_result->result(); 
        if($query_result->num_rows() > 0){
            return $result;
            } else {
               return array();  
            }
            
    }
    
    public function add_driver_data($data) { 
        //echo '<pre>' ;print_r($data);die;
        $this->db->insert($this->_users, $data); 
        
        return $this->db->insert_id(); 
    }  
    
    public function add_driver_licence_data($dataDriver) { 
        //echo '<pre>' ;print_r($data);die;
        $this->db->insert($this->_drive_license, $dataDriver); 
        
        return $this->db->insert_id(); 
    } 
	
    public function get_driver_info() { 
        $this->db->select('*') 
                ->from('users')
                ->where('Role_Id', 3)
                ->where('deletion_status', 0)
                ;
        $query_result = $this->db->get(); 
        $result = $query_result->result_array(); 
        return $result; 
    } 

    public function get_Driver_by_driver_id($driver_id) { 
        $result = $this->db->get_where($this->_users, array('Id' => $driver_id , 'deletion_status' => 0)); 
        return $result->row_array(); 
    } 
    public function get_Dl_by_driver_id($driver_id) { 
        $result = $this->db->get_where($this->_drive_license, array('d_l_user_id' => $driver_id , 'd_l_status' => 1)); 
        return $result->row_array(); 
    } 
    
    public function get_driver_vehicle_data($driver_id) { 
         $this->db->select('*') 
                ->from('users')
                ->join('tbl_drive_license', 'tbl_drive_license.d_l_user_id = users.Id', 'left')
                ->join('vehicle', 'vehicle.v_vehicle_driver_id = users.Id', 'left')
                ->where('users.Id', $driver_id)
                ->where('Role_Id', 3)
                ->where('deletion_status', 0)
                ;
        $query_result = $this->db->get(); 
        $result = $query_result->row_array();  
        return $result;
    } 

    public function published_driver_by_id($driver_id) { 
        $this->db->update($this->_users, array('Status' => 1), array('Id' => $driver_id));  
        return $this->db->affected_rows(); 
    } 

    public function unpublished_driver_by_id($driver_id) { 
        $this->db->update($this->_users, array('Status' => 0), array('Id' => $driver_id)); 
        return $this->db->affected_rows(); 
    } 

    public function update_driver($driver_id, $data) { 
        $this->db->update($this->_users, $data, array('Id' => $driver_id)); 
        return $this->db->affected_rows(); 
    } 
    public function update_driver_dl($driver_dl_id, $data) { 
        $this->db->update($this->_drive_license, $data, array('d_l_user_id' => $driver_dl_id)); 
        return $this->db->affected_rows(); 
    } 
	
    public function remove_driver_by_id($driver_id) { 
        $this->db->update($this->_users, array('deletion_status' => 1), array('Id' => $driver_id)); 
        return $this->db->affected_rows(); 
    } 
    
}

