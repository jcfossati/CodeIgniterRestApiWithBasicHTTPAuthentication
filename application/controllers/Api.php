<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/REST_Controller.php';
 
class Api extends REST_Controller {
	private $valid_logins;
	function __construct(){
		parent::__construct();
//		 To specify the limits within the controller's __construct() method, add per-method
//| limits with:
//|
//|       $this->method['METHOD_NAME']['limit'] = [NUM_REQUESTS_PER_HOUR];
		$this->methods['search_airport_get']['limit'] = 5;
		$this->load->model('Airport_Model');
		$this->load->library('form_validation');
		//$this->load->config('config');
		//echo BASEPATH;
		//$valid_logins =  array();
		$valid_logins = $this->config->item('rest_valid_logins');
		$this->load->model('User_Model');
		/*$this->load->model('User_Model');
		$logins = $this->User_Model->get_all();
		$size = count($logins);

		for($i = 1 ; $i<$size ; $i++){
			$valid_logins[$logins[$i]['email']] = $logins[$i]['password'];
			unset($logins[$i]['email']);
			unset($logins[$i]['type']);
			unset($logins[$i]['password']);
			unset($logins[$i]['id']);
		}
		$this->ci = & get_instance();
		$this->ci->config->set_item('rest_valid_logins', $valid_logins);
		//var_dump($valid_logins);
		var_dump($this->config->item('rest_valid_logins'));*/
		//var_dump($valid_logins);
	}

	function get_airports_get(){
		
		$airports = $this->Airport_Model->get_all();		
		$data['status'] = 1;
		$data['message'] = $airports;
		$this->response($data);
	}

	function get_airport_get(){
		$id = $this->uri->segment(3);
		
		$airport = $this->Airport_Model->get_by(array('id' => $id));		
		if(is_null($airport)){
			$data['status'] = 0;
			$data['message'] = 'Record Not Found';
		}	
		else{
			$data['status'] = 1;
			$data['message'] = $airport;	
		}
		
		$this->response($data);
	}

	// search airpot by airport_code
	function search_airport_get(){
		
		$airport_code = $this->uri->segment(3);
		

		$airport = $this->Airport_Model->get_by(array('airport_code' => $airport_code));		
		
		if(is_null($airport)){
			$data['status'] = 0;
			$data['message'] = 'Record Not Found';
		}	
		else{
			$data['status'] = 1;
			$data['message'] = $airport;	
		}
		$this->response($data);
	}

    //  airport_code, , country, city will be POST PARAMS
	function add_airport_post(){
		$data = array(
			'user_id' => $this->post('user_id'),
			'airport_code' => $this->post('airport_code'),
			'airport_name' => $this->post('airport_name'),
			'country' => $this->post('country'),
			'city' => $this->post('city'),
			
			);//( 'field' => 'airport_code', 'label' => 'airport_code', 'rules' => 'trim|required' )
		$this->form_validation->set_rules('user_id',  'user_id', 'trim|required');
		$this->form_validation->set_rules('airport_code',  'airport_code', 'trim|required');
		$this->form_validation->set_rules('airport_name', 'airport_name', 'trim|required');
		$this->form_validation->set_rules('country', 'country', 'trim|required');
		$this->form_validation->set_rules('city', 'city', 'trim|required');
		//$this->form_validation->set_rules();
		if($this->form_validation->run() != false){
	//		die('good data');
			// check whether that user_id user exists or not
			$res = $this->User_Model->get_by(array('id' => $this->post('user_id')));
			//var_dump($res);
			if(is_null($res)){
				$data1['status'] = 0;
				$data1['message'] = "User Not Found.";
				return $this->response($data1);
			}


			$type = $res['type'];
			 
			if($type == 'user'){
				$result = $this->Airport_Model->get_by( array('city' => $this->post('city'), 'user_id' => $this->post('user_id') ));
				if(!is_null($result)){
					$data1['status'] = 0;
					$data1['message'] = "User not allowed to enter only one airport per city.";
					$this->response($data1);
				}
			}
//			else if(type == 'admin'){
			//unset($data['type']);
			$insert_id = $this->Airport_Model->insert($data);
			$data1['status'] = 1;
			$data1['message'] = $insert_id;
			$this->response($data1);
//			}
		}
		else{
			$data1['status'] = 0;
			$data1['message'] = "Oops Error Occured becasue of missing required fields.";
			$this->response($data1);
		}
	}

	function delete_airport_get(){
		$id = $this->uri->segment(3);

		$airport = $this->Airport_Model->get_by(array('id' => $id));		
		if(is_null($airport)){
			$data['status'] = 0;
			$data['message'] = 'Record Not Found';
		}	
		else{
			if($this->Airport_Model->delete($id)){
				$data['status'] = 1;
				$data['message'] = 'Successfully Deleted';
				$this->response($data);	
			}
			else{
				$data['status'] = 0;
				$data['message'] = 'Oops Error Occured';
				$this->response($data);	
			}
		}
		$this->response($data);
	}
	
    // id, airport_code, , country, city will be POST PARAMS
	function edit_airport_post(){
		//$id = $this->ui->segment(3);
		$data = array(
			'user_id' => $this->post('user_id'),
			'id' => $this->post('id'),
			'airport_code' => $this->post('airport_code'),
			'airport_name' => $this->post('airport_name'),
			'country' => $this->post('country'),
			'city' => $this->post('city')
		);
		//( 'field' => 'airport_code', 'label' => 'airport_code', 'rules' => 'trim|required' )
		$this->form_validation->set_rules('id', 'id', 'trim|required');
		$this->form_validation->set_rules('airport_code',  'airport_code', 'trim|required');
		$this->form_validation->set_rules('airport_name', 'airport_name', 'trim|required');
		$this->form_validation->set_rules('country', 'country', 'trim|required');
		$this->form_validation->set_rules('city', 'city', 'trim|required');
		//$this->form_validation->set_rules();
		if($this->form_validation->run() != false){
//			die('good data');
			$id = $data['id'];
			unset($data['id']);
			$airport = $this->Airport_Model->get_by(array('id' => $id, 'user_id' => $this->post('user_id')));		
			if(is_null($airport)){
				$data1['status'] = 0;
				$data1['message'] = 'Record Not Found';
				$this->response($data1);
			}	
			else{
				unset($data['user_id']);
				$insert_id = $this->Airport_Model->update($id, $data);
				$data1['status'] = 1;
				$data1['message'] = 'Successfully Updated';
				$this->response($data1);
			}
		}
		else{

			$data1['status'] = 0;
			$data1['message'] = "Oops Error Occured becasue of missing required fields.";
			$this->response($data1);
		}
	}
}

?>