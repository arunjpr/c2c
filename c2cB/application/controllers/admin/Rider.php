<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
class Rider extends CI_Controller {  

    public function __construct() {
        parent::__construct(); 
//        $this->user_login_authentication(); 
        if ($this->session->userdata('logged_info') == FALSE) {
            redirect('admin', 'refresh');
        }
        $this->load->model('admin_models/rider_model', 'rider_mdl'); 
        
        // $memberObj = $this->session->userdata;
       // echo '<pre>' ; print_r($memberObj);die;
    } 

    public function index() {
        $data = array();
        $data['title'] = 'Manage Rider';
        $data['active_menu'] = 'rider';
        $data['active_sub_menu'] = 'rider';
        $data['active_sub_sub_menu'] = ''; 
        $data['rider_info'] = $this->rider_mdl->get_rider_info();
       // echo '<pre>' ;        print_r($data['rider_info']);die;
        $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
        $data['main_content'] = $this->load->view('admin_views/riders/manage_rider_v', $data, TRUE);
        $this->load->view('admin_views/admin_master_v', $data);
    } 

    public function add_rider() { 
        $data = array(); 
        $data['title'] = 'Add Rider';
        $data['active_menu'] = 'rider';
        $data['active_sub_menu'] = 'rider';
        $data['active_sub_sub_menu'] = '';
        $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
        $data['main_content'] = $this->load->view('admin_views/riders/add_rider_v', $data, TRUE);
        $this->load->view('admin_views/admin_master_v', $data);
    }
    public function create_rider() {
        // $imgPath = base_url(). '/assets/backend/img/rider/';
        $config = array(
            array(
                'field' => 'Name',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Mobile',
                'label' => 'Mobile',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Email',
                'label' => 'Email',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Address',
                'label' => 'Address',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Status',
                'label' => 'Status',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'Gender',
                'label' => 'Gender',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'Dob',
                'label' => 'Dob',
                'rules' => 'trim|required|max_length[250]'
            )
//            array(
//                'upload_path' => $imgPath,
//                'allowed_types' => 'gif|jpg|png',
//                'max_size' => 100,
//                'max_width' => 1024,
//                'max_height' => 768,
//            )
        );
       
        //echo '<pre>' ;print_r($config) ;die;
        $this->form_validation->set_rules($config);
       // $this->load->library('upload', $config);
        if ($this->form_validation->run() == FALSE) {
            $this->add_rider();
        } else {
            
            
            $data['Name'] = $this->input->post('Name', TRUE); 
            $data['Mobile'] = $this->input->post('Mobile', TRUE); 
            $data['Address'] = $this->input->post('Address', TRUE); 
            $data['Email'] = $this->input->post('Email', TRUE); 
            $data['Status'] = $this->input->post('Status', TRUE); 
            $data['Gender'] = $this->input->post('Gender', TRUE); 
            $data['Dob'] = $this->input->post('Dob', TRUE); 
           // $data['Image'] = $this->input->post('Image', TRUE); 
            $data['Role_Id'] = 2; 
            $data['add_by'] = $this->session->userdata('admin_id'); 
            //$data['date_added'] = date('Y-m-d H:i:s');  
            
            //echo '<pre>' ;print_r($data) ;die;
            $insert_id = $this->rider_mdl->add_rider_data($data); 
            if (!empty($insert_id)) { 
                $sdata['success'] = 'Add successfully . '; 
                $this->session->set_userdata($sdata); 
                redirect('admin/rider', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/rider', 'refresh'); 
            } 
        } 
    }
 
    public function published_rider($rider_id) { 
        $rider_info = $this->rider_mdl->get_rider_by_rider_id($rider_id); 
        if (!empty($rider_info)) { 
            $result = $this->rider_mdl->published_rider_by_id($rider_id); 
            if (!empty($result)) { 
                $sdata['success'] = 'Active successfully .'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/rider', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !';
                $this->session->set_userdata($sdata); 
                redirect('admin/rider', 'refresh'); 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !';
            $this->session->set_userdata($sdata); 
            redirect('admin/rider', 'refresh'); 
        } 
    }
 
    public function unpublished_rider($rider_id) { 
        $rider_info = $this->rider_mdl->get_rider_by_rider_id($rider_id);
        if (!empty($rider_info)) {
            $result = $this->rider_mdl->unpublished_rider_by_id($rider_id);
            if (!empty($result)) {
                $sdata['success'] = 'Inactive successfully .';
                $this->session->set_userdata($sdata); 
                redirect('admin/rider', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/rider', 'refresh'); 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/rider', 'refresh'); 
        } 
    }  

    public function edit_rider($rider_id) { 
        $data = array(); 
        $data['user_data'] = $this->rider_mdl->get_rider_by_rider_id($rider_id);  
        if (!empty($data['user_data'])) { 
            $data['title'] = 'Edit Rider'; 
            $data['active_menu'] = 'rider'; 
            $data['active_sub_menu'] = 'rider'; 
            $data['active_sub_sub_menu'] = ''; 
            $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
            $data['main_content'] = $this->load->view('admin_views/riders/edit_rider_v', $data, TRUE);
            $this->load->view('admin_views/admin_master_v', $data); 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/rider', 'refresh'); 
        } 
    } 

    public function update_rider($rider_id) { 
        $rider_info = $this->rider_mdl->get_rider_by_rider_id($rider_id); 
        if (!empty($rider_info)) { 
            $config = array( 
                array(
                'field' => 'Name',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Mobile',
                'label' => 'Mobile',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Email',
                'label' => 'Email',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Address',
                'label' => 'Address',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Status',
                'label' => 'Status',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'Gender',
                'label' => 'Gender',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'Dob',
                'label' => 'Dob',
                'rules' => 'trim|required|max_length[250]'
            )
            );
            $this->form_validation->set_rules($config); 
            if ($this->form_validation->run() == FALSE) { 
                $this->edit_rider($rider_id); 
            } else { 
                $data['Name'] = $this->input->post('Name', TRUE); 
                $data['Mobile'] = $this->input->post('Mobile', TRUE); 
                $data['Address'] = $this->input->post('Address', TRUE); 
                $data['Email'] = $this->input->post('Email', TRUE); 
                $data['Status'] = $this->input->post('Status', TRUE); 
                $data['Role_Id'] = 4; 
                $data['Gender'] = $this->input->post('Gender', TRUE); 
                $data['Dob'] = $this->input->post('Dob', TRUE); 
                $data['add_by'] = $this->session->userdata('admin_id');
                $data['created_on'] = date('Y-m-d H:i:s');  
                $result = $this->rider_mdl->update_rider($rider_id, $data); 
                if (!empty($result)) { 
                    $sdata['success'] = 'Update successfully .'; 
                    $this->session->set_userdata($sdata); 
                    redirect('admin/rider', 'refresh'); 
                } else { 
                    $sdata['exception'] = 'Operation failed !'; 
                    $this->session->set_userdata($sdata); 
                    redirect('admin/rider', 'refresh'); 
                } 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/rider', 'refresh'); 
        } 
    } 

    public function remove_rider($rider_id) { 
        $rider_info = $this->rider_mdl->get_Rider_by_rider_id($rider_id); 
        if (!empty($rider_info)) { 
            $result = $this->rider_mdl->remove_rider_by_id($rider_id); 
            if (!empty($result)) { 
                $sdata['success'] = 'Remove successfully .'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/rider', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/rider', 'refresh'); 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/riders', 'refresh'); 
        } 
    } 
    
     public function view_rider($rider_id) { 
        $data = array(); 
        $data['user_data'] = $this->rider_mdl->get_rider_by_rider_id($rider_id);  
        if (!empty($data['user_data'])) { 
            $data['title'] = 'Edit Rider'; 
            $data['active_menu'] = 'rider'; 
            $data['active_sub_menu'] = 'rider'; 
            $data['active_sub_sub_menu'] = ''; 
            $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
            $data['main_content'] = $this->load->view('admin_views/riders/view_rider_v', $data, TRUE);
            $this->load->view('admin_views/admin_master_v', $data); 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/rider', 'refresh'); 
        } 
    } 
}
?>