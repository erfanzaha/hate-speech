<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//==================================== authorization ====================================
//logout 
$route['logout']                    = 'auth/logout';
//login
$route['proses-login']              = 'auth/login/proses';
//forgot password
$route['forgot-password']           = 'auth/forgotPassword';
$route['proses-forgot-password']    = 'auth/forgotPassword/proses';
//reset password 
$route['reset-password']            = 'auth/resetPassword';
$route['proses-reset-password']     = 'auth/resetPassword/proses';
//register
$route['register']                  = 'auth/register';
$route['proses-register']           = 'auth/register/proses';
//==================================== end authorization ===============================

//==================================== identifikasi ====================================
//dashboard
$route['dashboard']                 = 'dashboard/dashboard';
// report
$route['report']                    = 'report/report';
$route['view-report']               = 'report/report/viewReport';
// data testing
$route['data-testing']              = 'data-testing/dataTesting';
$route['data-testing-proses']       = 'data-testing/dataTesting/prosesDeteksi';
// data training
$route['data-training']             = 'data-training/dataTraining';
$route['data-training-proses']      = 'data-training/dataTraining/prosesDeteksi';

//==================================== end identifikasi ====================================