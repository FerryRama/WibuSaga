<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['api']           = 'home';
$route['api/server']        = 'home';
$route['server']        = 'api/server';

$route['api']           = 'home';
$route['api/wibukeys']        = 'home';
$route['wibukeys']        = 'api/wibukeys';

$route['default_controller'] = 'api';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
