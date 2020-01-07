<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
class Driver extends CI_Controller {  

    public function __construct() {
        parent::__construct(); 
//        $this->user_login_authentication(); 
        if ($this->session->userdata('logged_info') == FALSE) {
            redirect('admin', 'refresh');
        }
        $this->load->model('admin_models/driver_model', 'driver_mdl'); 
        $this->load->model('admin_models/Vehicle_model', 'vehicle_mdl');  
        
//         $memberObj = $this->session->userdata;
       // echo '<pre>' ; print_r($memberObj);die;
    } 

    public function index() {
        $data = array();
        $data['title'] = 'Manage Driver';
        $data['active_menu'] = 'driver';
        $data['active_sub_menu'] = 'driver';
        $data['active_sub_sub_menu'] = ''; 
        $data['driver_info'] = $this->driver_mdl->get_driver_info();
      
        $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
        $data['main_content'] = $this->load->view('admin_views/drivers/manage_driver_v', $data, TRUE);
        $this->load->view('admin_views/admin_master_v', $data);
    } 

    public function add_driver() { 
        $data = array(); 
        $data['title'] = 'Add Driver';
        $data['active_menu'] = 'driver';
        $data['active_sub_menu'] = 'driver';
        $data['active_sub_sub_menu'] = '';
        $data['DropdownData'] = $this->driver_mdl->get_dropdownData();
        $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
        $data['main_content'] = $this->load->view('admin_views/drivers/add_driver_v', $data, TRUE);
        $this->load->view('admin_views/admin_master_v', $data);
    }
    public function create_driver() {
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
                'field' => 'Status',
                'label' => 'Status',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'License_Number',
                'label' => 'License_Number',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Gender',
                'label' => 'Gender',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'Address',
                'label' => 'Address',
                'rules' => 'trim|required|max_length[250]'
            ),
            
            array(
                'field' => 'v_type_id',
                'label' => 'v_type_id',
                'rules' => 'trim|required'
            ),
             
            array(
                'field' => 'v_vehicle_name',
                'label' => 'v_vehicle_name',
                'rules' => 'trim|required|max_length[250]'
            ),
             array(
                'field' => 'v_vehicle_number',
                'label' => 'v_vehicle_number',
                'rules' => 'trim|required|max_length[250]'
            ),
//             array(
//                'field' => 'v_vehicle_model_no',
//                'label' => 'v_vehicle_model_no',
//                'rules' => 'trim|required|max_length[250]'
//            ),
            array(
                'field' => 'v_vehicle_detail',
                'label' => 'v_vehicle_detail',
                'rules' => 'trim|required'
            ),
            );
        
       
        $this->load->library('upload', $config);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
             //echo '<pre>' ;print_r($config);die;
            $this->add_driver();
        } else {
            
            
            $data['Name'] = $this->input->post('Name', TRUE); 
            $data['Mobile'] = $this->input->post('Mobile', TRUE); 
            $data['Address'] = $this->input->post('Address', TRUE); 
            $data['Email'] = $this->input->post('Email', TRUE); 
            $data['Status'] = $this->input->post('Status', TRUE); 
            $data['Gender'] = $this->input->post('Gender', TRUE); 
            $data['Image'] ='';
            $data['Role_Id'] = 3; 
            $data['add_by'] = $this->session->userdata('admin_id'); 
        
            $insert_user_id = $this->driver_mdl->add_driver_data($data);  // Insert in user table
            //=============profile upload===============//
            $valid_extensions = array('jpeg','jpg','png','gif');
                if ($_FILES['userfile']['error'] == 0) {
                    $img = $_FILES['userfile']['name'];
                    $tmp = $_FILES['userfile']['tmp_name'];
                    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                     if (in_array($ext, $valid_extensions)) {
                        $driverName=$data['Name'];
                        $name_replace_with_underscore = str_replace(' ', '_', $driverName);
                        $profilePic=$insert_user_id.'_'.$name_replace_with_underscore.'.'.$ext;
                        if($img){
                            $path = "./assets/backend/img/driver/profile/" .$profilePic;
                        } else {
                            $path ='';
                        }
                        if (move_uploaded_file($tmp, $path)){
                            $_POST['userfile'] = $path;
                        }
                    }
                    if (file_exists($path)) {
                    $dataUpdate['Image']=$profilePic;
                    $this->driver_mdl->update_driver($insert_user_id, $dataUpdate); 
                    }
                }
            
            //=============profile upload end===============//
                 
            $data_vahicle['v_vehicle_name'] = $this->input->post('v_vehicle_name', TRUE); 
            $data_vahicle['v_vehicle_detail'] = $this->input->post('v_vehicle_detail', TRUE); 
            $data_vahicle['v_vehicle_number'] = $this->input->post('v_vehicle_number', TRUE); 
         //   $data_vahicle['v_vehicle_model_no'] = $this->input->post('v_vehicle_model_no', TRUE); 
            $data_vahicle['v_vehicle_driver_id'] = $insert_user_id; 
            $data_vahicle['v_type_id'] = $this->input->post('v_type_id', TRUE); 
            $data_vahicle['v_status'] = 1; 
            $data_vahicle['v_user_id'] = $this->session->userdata('admin_id'); 
            $data_vahicle['v_add_by'] = $this->session->userdata('admin_id');
            $insert_vehicle_id = $this->vehicle_mdl->add_vehicle_data($data_vahicle); 
            if ($_FILES['rcfile']['error'] == 0) {
                    $img_rc = $_FILES['rcfile']['name'];
                    $tmp_rc = $_FILES['rcfile']['tmp_name'];
                    $ext_rc = strtolower(pathinfo($img_rc, PATHINFO_EXTENSION));
                     if (in_array($ext, $valid_extensions)) {
                        $v_name=$data_vahicle['v_vehicle_name'];
                        $name_replace_with_underscore = str_replace(' ', '_', $v_name);
                        $vehicleRcImage=$insert_vehicle_id.'_rc_'.$name_replace_with_underscore.'.'.$ext_rc;
                        if($img_rc){
                            $path_rc = "./assets/backend/img/driver/vehicle/rcpic/" .$vehicleRcImage;
                        } else {
                            $path_rc ='';
                        }
                        if (move_uploaded_file($tmp_rc, $path_rc)){
                            $_POST['rcfile'] = $path_rc;
                        }
                    }
                    if (file_exists($path_rc)){
                    $data_V['v_vehicle_rc']=$vehicleRcImage;
                    $this->vehicle_mdl->update_vehicle($insert_vehicle_id, $data_V); 
                } 
                }
                if ($_FILES['vimagefile']['error'] == 0) {
                    $imgv = $_FILES['vimagefile']['name'];
                    $tmpv = $_FILES['vimagefile']['tmp_name'];
                    $extv = strtolower(pathinfo($imgv, PATHINFO_EXTENSION));
                     if (in_array($extv, $valid_extensions)) {
                        $v_Name=$data_vahicle['v_vehicle_name'];
                        $name_replace_with_underscore = str_replace(' ', '_', $v_Name);
                        $vehicleImage=$insert_vehicle_id.'_vimage_'.$name_replace_with_underscore.'.'.$extv;
                        if($imgv){
                            if($data_vahicle['v_type_id']==1){
                               $pathv = "./assets/backend/img/driver/vehicle/byke/" .$vehicleImage; 
                            }
                            if($data_vahicle['v_type_id']==2){
                               $pathv = "./assets/backend/img/driver/vehicle/auto/" .$vehicleImage; 
                            }
                            if($data_vahicle['v_type_id']==3){
                               $pathv = "./assets/backend/img/driver/vehicle/electric_rickshaw/" .$vehicleImage; 
                            }
                        } else {
                            $pathv ='';
                        }
                        if (move_uploaded_file($tmpv, $pathv)){
                            $_POST['vimagefile'] = $pathv;
                        }
                    }
                     if (file_exists($pathv)){
                    $v_vehicle_Image['v_vehicle_Image']=$vehicleImage;
                    $this->vehicle_mdl->update_vehicle($insert_vehicle_id, $v_vehicle_Image); 
                }
                }
                
                
            $dataDriver['d_l_license_number'] = $this->input->post('License_Number', TRUE); 
            $dataDriver['d_l_vehicle_id'] = $insert_vehicle_id; 
            $dataDriver['d_l_user_id'] = $insert_user_id; 
            $dataDriver['d_l_status'] = 1; 
            $dataDriver['d_l_image'] ='';
            $insert_driverid = $this->driver_mdl->add_driver_licence_data($dataDriver);  // Insert in drive_license table
            
            //==========================DL Upload=========
            $valid_extensions_dl = array('jpeg','jpg','png','gif');
                if ($_FILES['dlfile']['error'] == 0) {
                    $imgdl = $_FILES['dlfile']['name'];
                    $tmpdl = $_FILES['dlfile']['tmp_name'];
                    $extdl = strtolower(pathinfo($imgdl, PATHINFO_EXTENSION));
                  
                     if (in_array($extdl, $valid_extensions_dl)) {
                          
                        $driverName=$data['Name'];
                        $dl_driver_with_underscore = str_replace(' ', '_', $driverName);
                        $dlPic=$insert_user_id.'_dl_'.$dl_driver_with_underscore.'.'.$extdl;
                        
                        if($imgdl){
                            $pathDl = "./assets/backend/img/driver/dl/" . $dlPic;
                        } else {
                            $pathDl ='';
                        }
                        if (move_uploaded_file($tmpdl, $pathDl)){
                            $_POST['dlfile'] = $pathDl;
                        }
                        
                    }
                    if (file_exists($pathDl)) {
                        $dlUpdate['d_l_image']=$dlPic;
                        $this->driver_mdl->update_driver_dl($insert_driverid, $dlUpdate); 
                    } 
                }
            
            //  ========================Dl upload= End===========//
                
            
            
                
          if (!empty($insert_user_id) && (!empty($insert_driverid)) && (!empty($insert_vehicle_id))) { 
                $sdata['success'] = 'Add successfully . '; 
                $this->session->set_userdata($sdata); 
                redirect('admin/driver', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/driver', 'refresh'); 
            } 
        } 
    }
 
    public function published_driver($driver_id) { 
        $driver_info = $this->driver_mdl->get_driver_by_driver_id($driver_id); 
        if (!empty($driver_info)) { 
            $result = $this->driver_mdl->published_driver_by_id($driver_id); 
            if (!empty($result)) { 
                $sdata['success'] = 'Active successfully .'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/driver', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !';
                $this->session->set_userdata($sdata); 
                redirect('admin/driver', 'refresh'); 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !';
            $this->session->set_userdata($sdata); 
            redirect('admin/driver', 'refresh'); 
        } 
    }
 
    public function unpublished_driver($driver_id) { 
        $driver_info = $this->driver_mdl->get_driver_by_driver_id($driver_id);
        if (!empty($driver_info)) {
            $result = $this->driver_mdl->unpublished_driver_by_id($driver_id);
            if (!empty($result)) {
                $sdata['success'] = 'Inactive successfully .';
                $this->session->set_userdata($sdata); 
                redirect('admin/driver', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/driver', 'refresh'); 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/driver', 'refresh'); 
        } 
    }  

    public function edit_driver($driver_id) { 
        $data = array(); 
        $data['user_data'] = $this->driver_mdl->get_driver_vehicle_data($driver_id);
//        echo '<pre>' ;print_r($data['user_data']);die;
        if (!empty($data['user_data'])) { 
            $data['title'] = 'Edit Driver'; 
            $data['active_menu'] = 'driver'; 
            $data['active_sub_menu'] = 'driver'; 
            $data['active_sub_sub_menu'] = ''; 
            $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
            $data['main_content'] = $this->load->view('admin_views/drivers/edit_driver_v', $data, TRUE);
            $this->load->view('admin_views/admin_master_v', $data); 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/driver', 'refresh'); 
        } 
    } 

    public function update_driver($driver_id) { 
        $driver_info = $this->driver_mdl->get_driver_vehicle_data($driver_id); 
        $vehicle_id = $driver_info['d_l_vehicle_id'];
        if (!empty($driver_info)) { 
            $config = array( 
               array(
                'field' => 'Name',
                'label' => 'Name',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Mobile',
                'label' => 'Mobile',
                'rules' => 'trim|required|max_length[15]|min_length[10]'
            ),
            array(
                'field' => 'Email',
                'label' => 'Email',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Status',
                'label' => 'Status',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'License_Number',
                'label' => 'License_Number',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'Gender',
                'label' => 'Gender',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'Address',
                'label' => 'Address',
                'rules' => 'trim|required|max_length[250]'
            ),
            
            array(
                'field' => 'v_type_id',
                'label' => 'v_type_id',
                'rules' => 'trim|required'
            ),
             
            array(
                'field' => 'v_vehicle_name',
                'label' => 'v_vehicle_name',
                'rules' => 'trim|required|max_length[250]'
            ),
             array(
                'field' => 'v_vehicle_number',
                'label' => 'v_vehicle_number',
                'rules' => 'trim|required|max_length[250]'
            ),
            array(
                'field' => 'v_vehicle_detail',
                'label' => 'v_vehicle_detail',
                'rules' => 'trim|required'
            ),
            );
            $this->form_validation->set_rules($config); 
            if ($this->form_validation->run() == FALSE) { 
                $this->edit_driver($driver_id); 
            } else { 
                $data['Name'] = $this->input->post('Name', TRUE); 
                $data['Mobile'] = $this->input->post('Mobile', TRUE); 
                $data['Address'] = $this->input->post('Address', TRUE); 
                $data['Email'] = $this->input->post('Email', TRUE); 
                $data['Status'] = $this->input->post('Status', TRUE); 
                $data['Role_Id'] = 3; 
                $data['Gender'] = $this->input->post('Gender', TRUE); 
                $data['add_by'] = $this->session->userdata('admin_id');
                $data['created_on'] = date('Y-m-d H:i:s');  
                $result = $this->driver_mdl->update_driver($driver_id, $data); 
                
                $valid_extensions = array('jpeg','jpg','png','gif');
                if ($_FILES['userfile']['error'] == 0) {
                    $img = $_FILES['userfile']['name'];
                    $tmp = $_FILES['userfile']['tmp_name'];
                    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                     if (in_array($ext, $valid_extensions)) {
                        $driverName=$data['Name'];
                        $name_replace_with_underscore = str_replace(' ', '_', $driverName);
                        $profilePic=$driver_id.'_'.$name_replace_with_underscore.'.'.$ext;
                        if($img){
                            $path = "./assets/backend/img/driver/profile/" . $profilePic;
                        } else {
                            $path ='';
                        }
                        if (move_uploaded_file($tmp, $path)){
                            $_POST['userfile'] = $path;
                        }
                    }
                    if (file_exists($path)) {
                    $dataUpdate['Image']=$profilePic;
                    $this->driver_mdl->update_driver($driver_id, $dataUpdate); 
                    }
                }
                
            //=============profile upload end===============//
            $data_vahicle['v_vehicle_name'] = $this->input->post('v_vehicle_name', TRUE); 
            $data_vahicle['v_vehicle_detail'] = $this->input->post('v_vehicle_detail', TRUE); 
            $data_vahicle['v_vehicle_number'] = $this->input->post('v_vehicle_number', TRUE); 
            $data_vahicle['v_vehicle_driver_id'] = $driver_id; 
            $data_vahicle['v_type_id'] = $this->input->post('v_type_id', TRUE); 
            $data_vahicle['v_status'] = 1; 
            $data_vahicle['v_user_id'] = $this->session->userdata('admin_id'); 
            $data_vahicle['v_add_by'] = $this->session->userdata('admin_id');
            
          
                
            $result_vehicle = $this->vehicle_mdl->update_vehicle($vehicle_id, $data_vahicle); 
            
            if ($_FILES['rcfile']['error'] == 0) {
                    $img_rc = $_FILES['rcfile']['name'];
                    $tmp_rc = $_FILES['rcfile']['tmp_name'];
                    $ext_rc = strtolower(pathinfo($img_rc, PATHINFO_EXTENSION));
                    
                     if (in_array($ext_rc, $valid_extensions)) {
                        $v_name=$data_vahicle['v_vehicle_name'];
                        $name_replace_with_underscore = str_replace(' ', '_', $v_name);
                        $vehicleRcImage=$vehicle_id.'_rc_'.$name_replace_with_underscore.'.'.$ext_rc;
                        if($img_rc){
                            $path_rc = "./assets/backend/img/driver/vehicle/rcpic/" .$vehicleRcImage;
                        } else {
                            $path_rc ='';
                        }
                        if (move_uploaded_file($tmp_rc, $path_rc)){
                            $_POST['rcfile'] = $path_rc;
                        }
                    }
                     //echo '<pre>' ;print_r($path_rc);die;
                    if (file_exists($path_rc)){
                    $data_V['v_vehicle_rc']=$vehicleRcImage;
                    $this->vehicle_mdl->update_vehicle($vehicle_id, $data_V); 
                } 
                }
                
                if ($_FILES['vimagefile']['error'] == 0) {
                    $imgv = $_FILES['vimagefile']['name'];
                    $tmpv = $_FILES['vimagefile']['tmp_name'];
                    $extv = strtolower(pathinfo($imgv, PATHINFO_EXTENSION));
                     if (in_array($extv, $valid_extensions)) {
                        $v_Name=$data_vahicle['v_vehicle_name'];
                        $name_replace_with_underscore = str_replace(' ', '_', $v_Name);
                        $vehicleImage=$vehicle_id.'_vimage_'.$name_replace_with_underscore.'.'.$extv;
                        if($imgv){
                            if($data_vahicle['v_type_id']==1){
                               $pathv = "./assets/backend/img/driver/vehicle/byke/" .$vehicleImage; 
                            }
                            if($data_vahicle['v_type_id']==2){
                               $pathv = "./assets/backend/img/driver/vehicle/auto/" .$vehicleImage; 
                            }
                            if($data_vahicle['v_type_id']==3){
                               $pathv = "./assets/backend/img/driver/vehicle/electric_rickshaw/" .$vehicleImage; 
                            }
                        } else {
                            $pathv ='';
                        }
                        if (move_uploaded_file($tmpv, $pathv)){
                            $_POST['vimagefile'] = $pathv;
                        }
                    }
                     if (file_exists($pathv)){
                    $v_vehicle_Image['v_vehicle_Image']=$vehicleImage;
                    $this->vehicle_mdl->update_vehicle($vehicle_id, $v_vehicle_Image); 
                }
                }
            
            
                
            $dataDriver['d_l_license_number'] = $this->input->post('License_Number', TRUE); 
            $dataDriver['d_l_vehicle_id'] = $this->input->post('vehicle_id', TRUE); 
            $dataDriver['d_l_user_id'] = $driver_id; 
            $dataDriver['d_l_status'] = 1; 
            $dataDriver['d_l_image'] ='';
            $driverData = $this->driver_mdl->update_driver_dl($driver_id,$dataDriver);  // Insert in drive_license table
           
            //==========================DL Upload=========
           
                if ($_FILES['dlfile']['error'] == 0) {
                    $imgdl = $_FILES['dlfile']['name'];
                    $tmpdl = $_FILES['dlfile']['tmp_name'];
                    $extdl = strtolower(pathinfo($imgdl, PATHINFO_EXTENSION));
                  
                     if (in_array($extdl, $valid_extensions)) {
                          
                        $driverName=$data['Name'];
                        $dl_driver_with_underscore = str_replace(' ', '_', $driverName);
                        $dlPic=$driver_id.'_dl_'.$dl_driver_with_underscore.'.'.$extdl;
                        
                        if($imgdl){
                            $pathDl = "./assets/backend/img/driver/dl/" . $dlPic;
                        } else {
                            $pathDl ='';
                        }
                        if (move_uploaded_file($tmpdl, $pathDl)){
                            $_POST['dlfile'] = $pathDl;
                        }
                        
                    }
                     //echo '<pre>' ;print_r($pathDl);die;
                    if (file_exists($pathDl)) {
                        $dlUpdate['d_l_image']=$dlPic;
                        $this->driver_mdl->update_driver_dl($driver_id, $dlUpdate); 
                    } 
                }
                
                
                //echo '<pre>' ;print_r($pathDl);die;
                if (!empty($result) && (!empty($driverData)) && (!empty($result_vehicle))) { 
                    $sdata['success'] = 'Update successfully .'; 
                    $this->session->set_userdata($sdata); 
                    redirect('admin/driver', 'refresh'); 
                } else { 
                    $sdata['exception'] = 'Operation failed !'; 
                    $this->session->set_userdata($sdata); 
                    redirect('admin/driver', 'refresh'); 
                } 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/driver', 'refresh'); 
        } 
    } 

    public function remove_driver($driver_id) { 
        $driver_info = $this->driver_mdl->get_Driver_by_driver_id($driver_id); 
        if (!empty($driver_info)) { 
            $result = $this->driver_mdl->remove_driver_by_id($driver_id); 
            if (!empty($result)) { 
                $sdata['success'] = 'Remove successfully .'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/driver', 'refresh'); 
            } else { 
                $sdata['exception'] = 'Operation failed !'; 
                $this->session->set_userdata($sdata); 
                redirect('admin/driver', 'refresh'); 
            } 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/drivers', 'refresh'); 
        } 
    } 
    
    public function view_driver($driver_id) { 
        $data = array(); 
        $data['user_data'] = $this->driver_mdl->get_driver_by_driver_id($driver_id);  
        if (!empty($data['user_data'])) { 
            $data['title'] = 'Edit Driver'; 
            $data['active_menu'] = 'driver'; 
            $data['active_sub_menu'] = 'driver'; 
            $data['active_sub_sub_menu'] = ''; 
            $data['main_menu'] = $this->load->view('admin_views/main_menu_v', $data, TRUE);
            $data['main_content'] = $this->load->view('admin_views/drivers/view_driver_v', $data, TRUE);
            $this->load->view('admin_views/admin_master_v', $data); 
        } else { 
            $sdata['exception'] = 'Content not found !'; 
            $this->session->set_userdata($sdata); 
            redirect('admin/driver', 'refresh'); 
        } 
    } 
}
?>