<?php

class Airport_Model extends My_Model{
	protected $table = 'airports';
	protected $primary_key = 'id';
	protected $return_type = 'array';

	/*$validate = array(
	    array( 'field' => 'airport_code', 'label' => 'airport_code', 'rules' => 'trim|required' ),
	    array( 'field' => 'airport_name', 'label' => 'airport_name', 'rules' => 'trim|required' ),
	    array( 'field' => 'country', 'label' => 'country', 'rules' => 'trim|required' ),     
	    array( 'field' => 'city', 'label' => 'city', 'rules' => 'trim|required' ),
		
	);


	/*private $id;
	private $code;
	private $name;
	private $country;
	private $city;

	function __construct(){
		parent::__construct();
	}

	public function getId(){
		return $this->id;
	}

	public function setId($var){
		$this->id = $var;
	}

	public function getCode(){
		return $this->code;
	}

	public function setCode($var){
		$this->code = $var;
	}		

	public function getName(){
		return $this->name;
	}

	public function setName($var){
		$this->name = $var;
	}		

	public function getCountry(){
		return $this->country;
	}

	public function setCountry($var){
		$this->country = $var;
	}		

	public function getCity(){
		return $this->city;
	}

	public function setCity($var){
		$this->city = $var;
	}		

	public function commit(){
		$data = array(
			'airport_code' => $code,
			'airport_name' => $name,
			'country' => $country,
			'city' => $city
			);

		if($id > 0){
			$this->db->update("aiport", $data, array( "id" => $this->id));
			return true;
		}
		else{
			if($this->db->insert("airport", $data)){
				$this->id = $this->db->insert_id();
				return true;
			}
		}
		return false;
	}*/
}

?>