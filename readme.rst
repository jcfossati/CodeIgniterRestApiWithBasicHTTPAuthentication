##################
CodeIgniter REST API TUTORIAL
###################


First of all I downloaded latest version of CodeIgniter and did its setting.

After that I downloaded rest.php, REST_CONTROLLER and Format.php from this repository
https://github.com/chriskacerguis/codeigniter-restserver/

and put the rest.php file in /application/config
            REST_Controller.php and Format.php file in /application/libraries
            
After that I created my Controller with the following way

class Api extends REST_Controller {

// constructore 
/*
      function name_requestType(){
      }
*/
}

##################
Simple HTTP Basic Authentication
###################

After that I went into rest.php file and enabled the rest_auth like this
$config['rest_auth'] = 'basic';

For this basic authentication, we can set the username and passwords in the below way.
$config['rest_valid_logins'] = ['admin' => '1234', 'user' => 'password'];

Becasue of this all of the function was asking to authenticate with a username and password,
Then I just made a function public which is search_airport_get by the following way


$config['auth_override_class_method']['api']['search_airport'] = 'none';

##################
Output Format & Case InSensitive Routes
###################

this rest.php and REST_Controlled have provided the faclitiy to set your own output format by just giving the format as a parameter.
like 
/api/search_airport/QUE125?format=xml

and the provided formats are listed below

$config['rest_supported_formats'] = [
    'json',
    'array',
    'csv',
    'html',
    'jsonp',
    'php',
    'serialized',
    'xml',
];

These two files auto provide case insensitive routes.
