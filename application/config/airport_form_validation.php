<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'add_airport_post' => array(
    array( 'field' => 'airport_code', 'label' => 'airport_code', 'rules' => 'trim|required' ),
    array( 'field' => 'airport_name', 'label' => 'airport_name', 'rules' => 'trim|required' ),
    array( 'field' => 'country', 'label' => 'country', 'rules' => 'trim|required' ),     
    array( 'field' => 'city', 'label' => 'city', 'rules' => 'trim|required' ),
	),
);

?>