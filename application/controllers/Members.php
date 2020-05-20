<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

    private $table = 'members';
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('commen_model');
        $this->load->model('members_model');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
       $this->global['pageTitle'] = 'Members';
       $this->loadViews("member-list", $this->global, NULL , NULL);
    }

    public function fetch_members(){
        $category_data = $this->members_model->make_datatables();  
		$data = array();  
		$index = 1;
        foreach($category_data as $row)  
        {  
             $sub_array = array();  
             $sub_array[] = $index;
             $sub_array[] = $row->first_name.' '.$row->last_name;  
             $sub_array[] = $row->mobile_no;  
             $sub_array[] = $row->email;  
             $sub_array[] = $row->dob;  
             $sub_array[] = $row->address;  
             $sub_array[] = '<button id="'.$row->id.'" class="btn btn-success btn-small update" value="'. $row->id .'"><i class="fa fa-edit"></i></button>';
             $sub_array[] = '<button id="'. $row->id .'" class="btn btn-danger btn-small delete" value="'. $row->id .'"><i class="fa fa-close"></i></button>';
			 $data[] = $sub_array; 
			 $index++; 
        }  
        $output = array(  
             "draw"                   =>     intval($_POST["draw"]),  
             "recordsTotal"           =>     $this->members_model->get_all_data(),  
             "recordsFiltered"        =>     $this->members_model->get_filtered_data(),  
             "data"                   =>     $data  
        );  
        echo json_encode($output);
    }

    public function fetch_single(){
           $output = array();  
          
           $data = $this->commen_model->fetch_single_row($this->table, 'id', $_POST["member_id"]);  
           foreach($data as $row)  
           {  
                $output['first_name'] = $row->first_name;  
                $output['last_name'] = $row->last_name;  
                $output['mobile_no'] = $row->mobile_no;  
                $output['email'] = $row->email;
                $output['dob'] = $row->dob;
                $output['address'] = $row->address;
           }  
           echo json_encode($output);  
	}
	
	function validate_mobile($mobile_no){
		if (preg_match('/(7|8|9)\d{9}/', $mobile_no)){
			return true;
		}else{
			$this->form_validation->set_message('validate_mobile', 'Mobile Number Should starts with 7,8,9.');
			return false;
		}
	}

	function check_date(){
		$doby = date('Y', strtotime($this->input->post('dob')));
		$dobm = date('m', strtotime($this->input->post('dob')));
		$dobd = date('d', strtotime($this->input->post('dob')));
		if (checkdate($dobm,$dobd,$doby)) {
			return true;
		}else {
			$this->form_validation->set_message('check_date', 'DOB Should be Correct.');
			return false;
		}
	}

    public function user_action(){
		$validate_data = array(
			array(
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required|alpha|min_length[3]|max_length[20]'
			),
			array(
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required|alpha|min_length[3]|max_length[20]'
			),
			array(
				'field' => 'mobile_no',
				'label' => 'Mobile Number',
				'rules' => 'trim|required|is_numeric|min_length[10]|max_length[10]|callback_validate_mobile'
			),
			array(
				'field' => 'dob',
				'label' => 'Date of Birth',
				'rules' => 'trim|required|callback_check_date'
			),
			array(
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'trim|required|max_length[50]'
			),
		);
		$this->form_validation->set_rules($validate_data);
		if($this->input->post('action') == 'add'){
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|is_unique[members.email]');
		}
		if($this->form_validation->run()){
			
			$data = array(
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'mobile_no' => $this->input->post('mobile_no'),
						'dob' => $this->input->post('dob'),
						'address' => $this->input->post('address')
					);
			
			if($this->input->post('action') == 'add'){
				$data['email'] = $this->input->post('email');		
				$this->commen_model->insert_into_table($this->table, $data);
				$data['status'] = true;      
				$data['msg'] = 'Data Inserted';   
				echo json_encode($data);   
			}

			if($this->input->post('action') == 'edit'){
				$this->commen_model->update_table_with_id($this->table, $data, $this->input->post('member_id'));
				$data['status'] = true;      
				$data['msg'] = 'Data Updated';   
				echo json_encode($data); 
			}
		}
		else{
			// echo 'Validation Failed';
			$data['status'] = false;
			$data['errors']['first_name'] = form_error('first_name');
			$data['errors']['last_name'] = form_error('last_name');
			$data['errors']['mobile_no'] = form_error('mobile_no');
			$data['errors']['email'] = form_error('email');
			$data['errors']['dob'] = form_error('dob');
			$data['errors']['address'] = form_error('address');
			echo json_encode($data);
		}
 
    }

    public function delete(){
        if($this->commen_model->delete_table_row($this->table , $this->input->post('member_id'))){
            echo 'Data Deleted!!!';
        }
        else{
            echo 'Error In Deleting Data!!!';
        }
	}
	
	public function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){

        $this->load->view('header', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('footer', $footerInfo);
    }
}
