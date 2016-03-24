<?php

class MyOtherClass {

    function MyOtherfunction() {
    	echo 'starting hook';
        $CI = & get_instance();
        var_dump(get_instance());
        $q = $CI->db->get('users');

		$logins =  $q->result_array();

		$valid_logins = $CI->config->item('rest_valid_logins');

		$size = count($logins);

		for($i = 1 ; $i<$size ; $i++){
			$valid_logins[$logins[$i]['email']] = $logins[$i]['password'];
			unset($logins[$i]['email']);
			unset($logins[$i]['type']);
			unset($logins[$i]['password']);
			unset($logins[$i]['id']);
		}
		//$this->ci = & get_instance();
		//$config['rest_valid_logins'] = $valid_logins;

		$CI->config->set_item('rest_valid_logins', $valid_logins);

		echo 'ending hook';
    }

}

?>