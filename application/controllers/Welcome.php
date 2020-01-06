<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
//	public function index()
//	{
//		$this->load->view('welcome_message');
//        }
//        public function show()  
//        { 
//            $user_id =2;
//            $username='Ashu Saini';
//            $data['user_array'] = $this->user_model->get_users($user_id,$username);
//            $this->load->view('user_view',$data);
//        }  
//       public function insert(){
//            $Name = 'raj';
//            $email = 'raj@gmail.com';
//            $this->user_model->create_users([
//                'Name'=>$Name,
//                'Role_Id'=>"2",
//                'Email'=>$email,
//            ]);
//            }
//        public function update(){
//            $id=9;
//            $Name = 'amit saini';
//            $email = 'raj@gmail.com';
//            $this->user_model->update_users([
//                'Name'=>$Name,
//                'Role_Id'=>"2",
//                'Email'=>$email,
//            ],$id);
//            
//        }
//        public function delete(){
//            $id=8;
//            $this->user_model->delete_user($id);
//        }
    
    
    
    public function index()
        {
                $this->load->view('upload_form', array('error' => ' ' ));
        }

        public function do_upload()
        {
            $imgPath = base_url(). 'assets/backend/upload/';
            
                $config['upload_path']          = $imgPath;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                
//                echo '<pre>' ;print_r($config['upload_path']);die;

                $this->load->library('upload', $config);
                
                $field_name = "some_field_name";
                $this->upload->do_upload($field_name);
                
                            
                

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('upload_success', $data);
                }
        }
       
    
}
