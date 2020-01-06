<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
class Pooler extends CI_Controller {  

    public function __construct() {
        parent::__construct(); 
//        $this->user_login_authentication(); 
        if ($this->session->userdata('logged_info') == FALSE) {
            redirect('admin', 'refresh');
        }
        $this->load->model('admin_models/pooler_model', 'pooler_mdl'); 
        
//         $memberObj = $this->session->userdata;
       // echo '<pre>' ; print_r($memberObj);die;
    } 

    public function index() {
        $data = array();
        $data['title'] = 'Manage Pooler';
        $data['active_menu'] = 'pooler';
        $data['active_sub_menu'] = 'pooler';
        $data['active_sub_sub_menu'] = ''; 
        $data['pooler_info'] = $this->pooler_mdl->get_pooler_info();
       // echo '<pre>' ;        print_r($data['pooler_info']);die;
        $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
        $data['main_content'] = $this->load->view('admin_views/poolers/manage_pooler_v', $data, TRUE);
        $this->load->view('admin_views/admin_master_v', $data);
    } 

    public function add_pooler() { 
        $data = array(); 
        $data['title'] = 'Add Pooler';
        $data['active_menu'] = 'pooler';
        $data['active_sub_menu'] = 'pooler';
        $data['active_sub_sub_menu'] = '';
        $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
        $data['main_content'] = $this->load->view('admin_views/poolers/add_pooler_v', $data, TRUE);
        $this->load->view('admin_views/admin_master_v', $data);
    }
    public function create_pooler() {
        // $imgPath = base_url(). '/assets/backend/img/pooler/';
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
            ),
            array(
                'field' => 'License_Number',
                'label' => 'License_Number',
                'rules' => 'trim|required|max_length[250]'
            ),
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
            $this->add_pooler();
        } else {
            
            
            $data['Name'] = $this->input->post('Name', TRUE); 
            $data['Mobile'] = $this->input->post('Mobile', TRUE); 
            $data['Address'] = $this->input->post('Address', TRUE); 
            $data['Email'] = $this->input->post('Email', TRUE); 
            $data['Status'] = $this->input->post('Status', TRUE); 
            $data['Gender'] = $this->input->post('Gender', TRUE); 
            $data['Dob'] = $this->input->post('Dob', TRUE); 
           // $data['Image'] = $this->input->post('Image', TRUE); 
            $data['Role_Id'] = 3; 
            $data['add_by'] = $this->session->userdata('admin_id'); 
            //$data['date_added'] = date('Y-m-d H:i:s');  
            
            
            $insert_id = $this->pooler_mdl->add_pooler_data($data);  // Insert in user table
            $dataPooler['License_Number'] = $this->input->post('License_Number', TRUE); 
            $dataPooler['User_Id'] = $insert_id; 
            $dataPooler['Status'] = 1; 
            $insert_poolerid = $this->pooler_mdl->add_pooler_licence_data($dataPooler);  // Insert in drive_license table
            if (!empty($insert_id) && (!empty($insert_poolerid))) { 
                $sdata['success'] = 'Add successfully . '; 
                $this->session->set_userdata($sdata); 
                redirect('admin/pooler', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/pooler', 'refresh'); 
            } 
        } 
    }
 
    public function published_pooler($pooler_id) { 
        $pooler_info = $this->pooler_mdl->get_pooler_by_pooler_id($pooler_id); 
        if (!empty($pooler_info)) { 
            $result = $this->pooler_mdl->published_pooler_by_id($pooler_id); 
            if (!empty($result)) { 
                $sdata['success'] = 'Active successfully .'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/pooler', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !';
                $this->session->set_userdata($sdata); 
                redirect('admin/pooler', 'refresh'); 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !';
            $this->session->set_userdata($sdata); 
            redirect('admin/pooler', 'refresh'); 
        } 
    }
 
    public function unpublished_pooler($pooler_id) { 
        $pooler_info = $this->pooler_mdl->get_pooler_by_pooler_id($pooler_id);
        if (!empty($pooler_info)) {
            $result = $this->pooler_mdl->unpublished_pooler_by_id($pooler_id);
            if (!empty($result)) {
                $sdata['success'] = 'Inactive successfully .';
                $this->session->set_userdata($sdata); 
                redirect('admin/pooler', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/pooler', 'refresh'); 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/pooler', 'refresh'); 
        } 
    }  

    public function edit_pooler($pooler_id) { 
        $data = array(); 
        $data['user_data'] = $this->pooler_mdl->get_pooler_by_pooler_id($pooler_id);  
        if (!empty($data['user_data'])) { 
            $data['title'] = 'Edit Pooler'; 
            $data['active_menu'] = 'pooler'; 
            $data['active_sub_menu'] = 'pooler'; 
            $data['active_sub_sub_menu'] = ''; 
            $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
            $data['main_content'] = $this->load->view('admin_views/poolers/edit_pooler_v', $data, TRUE);
            $this->load->view('admin_views/admin_master_v', $data); 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/pooler', 'refresh'); 
        } 
    } 

    public function update_pooler($pooler_id) { 
        $pooler_info = $this->pooler_mdl->get_pooler_by_pooler_id($pooler_id); 
        if (!empty($pooler_info)) { 
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
                $this->edit_pooler($pooler_id); 
            } else { 
                $data['Name'] = $this->input->post('Name', TRUE); 
                $data['Mobile'] = $this->input->post('Mobile', TRUE); 
                $data['Address'] = $this->input->post('Address', TRUE); 
                $data['Email'] = $this->input->post('Email', TRUE); 
                $data['Status'] = $this->input->post('Status', TRUE); 
                $data['Role_Id'] = 3; 
                $data['Gender'] = $this->input->post('Gender', TRUE); 
                $data['Dob'] = $this->input->post('Dob', TRUE); 
                $data['add_by'] = $this->session->userdata('admin_id');
                $data['created_on'] = date('Y-m-d H:i:s');  
                $result = $this->pooler_mdl->update_pooler($pooler_id, $data); 
                if (!empty($result)) { 
                    $sdata['success'] = 'Update successfully .'; 
                    $this->session->set_userdata($sdata); 
                    redirect('admin/pooler', 'refresh'); 
                } else { 
                    $sdata['exception'] = 'Operation failed !'; 
                    $this->session->set_userdata($sdata); 
                    redirect('admin/pooler', 'refresh'); 
                } 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/pooler', 'refresh'); 
        } 
    } 

    public function remove_pooler($pooler_id) { 
        $pooler_info = $this->pooler_mdl->get_Pooler_by_pooler_id($pooler_id); 
        if (!empty($pooler_info)) { 
            $result = $this->pooler_mdl->remove_pooler_by_id($pooler_id); 
            if (!empty($result)) { 
                $sdata['success'] = 'Remove successfully .'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/pooler', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/pooler', 'refresh'); 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/poolers', 'refresh'); 
        } 
    } 
    
    public function view_pooler($pooler_id) { 
        $data = array(); 
        $data['user_data'] = $this->pooler_mdl->get_pooler_by_pooler_id($pooler_id);  
        if (!empty($data['user_data'])) { 
            $data['title'] = 'Edit Pooler'; 
            $data['active_menu'] = 'pooler'; 
            $data['active_sub_menu'] = 'pooler'; 
            $data['active_sub_sub_menu'] = ''; 
            $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
            $data['main_content'] = $this->load->view('admin_views/poolers/view_pooler_v', $data, TRUE);
            $this->load->view('admin_views/admin_master_v', $data); 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/pooler', 'refresh'); 
        } 
    } 
}
?>