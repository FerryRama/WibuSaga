<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->library('form_validation');
  }

  public function index()
  {
    redirect('auth/login');
  }

  public function login()
  {
    if ($this->session->userdata('userID')) {
      redirect('user');
    }

    $this->form_validation->set_rules(
      'username',
      'Username',
      'required|trim',
      array(
        'required'      => 'Your %s is empty.',
      )
    );
    $this->form_validation->set_rules(
      'password',
      'password',
      'required|trim',
      array(
        'required'      => 'Your %s is empty.',
      )
    );
    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Wibu Login';
      $data['home'] = 'active';
      $data['download'] = '';
      $data['rank'] = '';
      $data['donation'] = '';
      $this->load->view('home/template/home_header', $data);
      $this->load->view('auth/login');
      $this->load->view('home/template/home_footer');
    } else {
      // validasi login
      $this->_login();
    }
  }

  public function _login()
  {
    $userID = $_POST['username'];
    $password = $_POST['password'];

    $user = $this->db->get_where('userMemberDB', ['userID' => $userID])->row_array();

    if ($user) {
      // user aktif
      if ($user['verify'] == 'verify') {
        if (password_verify($password, $user['userPWD'])) {
          $data = [
            'userID' => $user['userID'],
            'role_id' => $user['role_id']
          ];
          $this->session->set_userdata($data);
          if ($user['role_id'] == 1) {
            redirect('user');
          } else {
            redirect('user');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Wrong</div>');
          redirect('auth/login');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your Account Not Active</div>');
        redirect('auth/login');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username Not Exist</div>');
      redirect('auth/login');
    }
  }

  public function register()
  {
    if ($this->session->userdata('userID')) {
      redirect('user');
    }

    $this->form_validation->set_rules(
      'username',
      'Username',
      'required|is_unique[userMemberDB.userID]|alpha_numeric',
      array(
        'required'      => 'Your %s is empty.',
        'is_unique'     => 'This %s already exists.',
        'alpha_numeric' => 'Your %s Error, Dont Use Special Character'
      )
    );
    $this->form_validation->set_rules(
      'password',
      'Password',
      'required|trim|min_length[6]|max_length[14]|matches[repassword]',
      [
        'matches' => 'Password Dont Match!',
        'min_length' => 'Password Too Short!',
        'max_length' => 'Password Too Long!'
      ]
    );
    $this->form_validation->set_rules('repassword', 'Re-Password', 'required|trim|matches[password]');
    $this->form_validation->set_rules(
      'email',
      'Email',
      'required|trim|valid_email|is_unique[userMemberDB.email]',
      array(
        'required'      => 'Your %s is empty.',
        'is_unique'     => 'This %s already exists.'
      )
    );
    $this->form_validation->set_rules(
      'Nickname',
      'Nickname',
      'required|trim|min_length[7]|max_length[14]|is_unique[userMemberDB.nickName]|alpha_numeric',
      array(
        'required'      => 'Your %s is empty.',
        'is_unique'     => 'This %s already exists.',
        'alpha_numeric' => 'Your %s Error, Dont Use Special Character'
      )
    );



    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Wibu Register';
      $data['home'] = 'active';
      $data['download'] = '';
      $data['rank'] = '';
      $data['donation'] = '';
      $this->load->view('home/template/home_header', $data);
      $this->load->view('auth/register');
      $this->load->view('home/template/home_footer');
    } else {
      $data = [

        $username = $this->input->post('username'),
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT),
        '@nMailling' => 1,
        $nickname = $this->input->post('Nickname'),
        $nick = strtolower($nickname),
        '@sActiveCode' => '*',
        $email = $this->input->post('email'),
        '@VerificationCode' => 1,
        '@role_id' => 1,
        '@image' => 'default.jpg'
      ];
      $token1 = md5(rand() . $username . $password);
      $token = base64_encode(random_bytes(32));

      $this->db->query("exec USP_Web_Member_Add 
            @sUserId = '$username', 
            @sPASSWORD = '$password', 
            @nMailling = '1' , 
            @sNickName = '$nick', 
            @sActiveCode = '*', 
            @sEMail = '$email', 
            @VerificationCode = '$token',
            @image = 'default.jpg', 
            @verify = 'notverify',
            @role_id ='0'");

      $this->_sendEmail($token, 'verify');
      $this->_sendBotDiscord($token, 'regist');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! Your Account Has Been Created. Please Login</div>');
      redirect('auth/login');
    }
  }

  private function _sendEmail($token, $type)
  {
    $config = [
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googleemail.com',
      'smtp_user' => 'wibusaga2021@gmail.com',
      'smtp_pass' => '180918fnfn',
      'smtp_port' => 465,
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'isHTML' => true,
      'newline' => "\r\n"
    ];

    $this->load->library('email', $config);
    $this->email->set_mailtype("html");
    $this->email->set_newline("\r\n");
    $this->email->from('wibusaga2021@gmail.com', "WibuSaga");
    $this->email->to($this->input->post('email'));

    if ($type == 'verify') {
      $this->email->subject('Account Verification');
      $this->email->message('<html>
            <head>
              <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <title>Simple Transactional Email</title>
              <style>
              img {
                border: none;
                -ms-interpolation-mode: bicubic;
                max-width: 100%; 
              }
        
              body {
                background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%; 
              }
        
              table {
                border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%; }
                table td {
                  font-family: sans-serif;
                  font-size: 14px;
                  vertical-align: top; 
              }
              .body {
                background-color: #f6f6f6;
                width: 100%; 
              }
              .container {
                display: block;
                margin: 0 auto !important;
                /* makes it centered */
                max-width: 580px;
                padding: 10px;
                width: 580px; 
              }
              .content {
                box-sizing: border-box;
                display: block;
                margin: 0 auto;
                max-width: 580px;
                padding: 10px; 
              }
              .main {
                background: #ffffff;
                border-radius: 3px;
                width: 100%; 
              }
        
              .wrapper {
                box-sizing: border-box;
                padding: 20px; 
              }
        
              .content-block {
                padding-bottom: 10px;
                padding-top: 10px;
              }
        
              .footer {
                clear: both;
                margin-top: 10px;
                text-align: center;
                width: 100%; 
              }
                .footer td,
                .footer p,
                .footer span,
                .footer a {
                  color: #999999;
                  font-size: 12px;
                  text-align: center; 
              }
              h1,
              h2,
              h3,
              h4 {
                color: #000000;
                font-family: sans-serif;
                font-weight: 400;
                line-height: 1.4;
                margin: 0;
                margin-bottom: 30px; 
              }
        
              h1 {
                font-size: 35px;
                font-weight: 300;
                text-align: center;
                text-transform: capitalize; 
              }
        
              p,
              ul,
              ol {
                font-family: sans-serif;
                font-size: 14px;
                font-weight: normal;
                margin: 0;
                margin-bottom: 15px; 
              }
                p li,
                ul li,
                ol li {
                  list-style-position: inside;
                  margin-left: 5px; 
              }
        
              a {
                color: #3498db;
                text-decoration: underline; 
              }
              .btn {
                box-sizing: border-box;
                width: 100%; }
                .btn > tbody > tr > td {
                  padding-bottom: 15px; }
                .btn table {
                  width: auto; 
              }
                .btn table td {
                  background-color: #ffffff;
                  border-radius: 5px;
                  text-align: center; 
              }
                .btn a {
                  background-color: #ffffff;
                  border: solid 1px #3498db;
                  border-radius: 5px;
                  box-sizing: border-box;
                  color: #3498db;
                  cursor: pointer;
                  display: inline-block;
                  font-size: 14px;
                  font-weight: bold;
                  margin: 0;
                  padding: 12px 25px;
                  text-decoration: none;
                  text-transform: capitalize; 
              }
        
              .btn-primary table td {
                background-color: #3498db; 
              }
        
              .btn-primary a {
                background-color: #3498db;
                border-color: #3498db;
                color: #ffffff; 
              }
              .last {
                margin-bottom: 0; 
              }
        
              .first {
                margin-top: 0; 
              }
        
              .align-center {
                text-align: center; 
              }
        
              .align-right {
                text-align: right; 
              }
        
              .align-left {
                text-align: left; 
              }
        
              .clear {
                clear: both; 
              }
        
              .mt0 {
                margin-top: 0; 
              }
        
              .mb0 {
                margin-bottom: 0; 
              }
        
              .preheader {
                color: transparent;
                display: none;
                height: 0;
                max-height: 0;
                max-width: 0;
                opacity: 0;
                overflow: hidden;
                mso-hide: all;
                visibility: hidden;
                width: 0; 
              }
        
              .powered-by a {
                text-decoration: none; 
              }
        
              hr {
                border: 0;
                border-bottom: 1px solid #f6f6f6;
                margin: 20px 0; 
              }
              @media only screen and (max-width: 620px) {
                table.body h1 {
                  font-size: 28px !important;
                  margin-bottom: 10px !important; 
                }
                table.body p,
                table.body ul,
                table.body ol,
                table.body td,
                table.body span,
                table.body a {
                  font-size: 16px !important; 
                }
                table.body .wrapper,
                table.body .article {
                  padding: 10px !important; 
                }
                table.body .content {
                  padding: 0 !important; 
                }
                table.body .container {
                  padding: 0 !important;
                  width: 100% !important; 
                }
                table.body .main {
                  border-left-width: 0 !important;
                  border-radius: 0 !important;
                  border-right-width: 0 !important; 
                }
                table.body .btn table {
                  width: 100% !important; 
                }
                table.body .btn a {
                  width: 100% !important; 
                }
                table.body .img-responsive {
                  height: auto !important;
                  max-width: 100% !important;
                  width: auto !important; 
                }
              }
              @media all {
                .ExternalClass {
                  width: 100%; 
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                  line-height: 100%; 
                }
                .apple-link a {
                  color: inherit !important;
                  font-family: inherit !important;
                  font-size: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
                  text-decoration: none !important; 
                }
                #MessageViewBody a {
                  color: inherit;
                  text-decoration: none;
                  font-size: inherit;
                  font-family: inherit;
                  font-weight: inherit;
                  line-height: inherit;
                }
                .btn-primary table td:hover {
                  background-color: #34495e !important; 
                }
                .btn-primary a:hover {
                  background-color: #34495e !important;
                  border-color: #34495e !important; 
                } 
              }
        
            </style>
          </head>
          <body>
            <span class="preheader">Register Account WibuSaga. | </span>
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
              <tr>
                <td>&nbsp;</td>
                <td class="container">
                  <div class="content">
                  <table role="presentation" class="main">
                  <tr>
                  <td class="wrapper">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>
                          <p>Hi ' . $this->input->post('username') . ',</p>
                          <p>Thank you for registering account in WibuSaga.<br>Before we started, we need to confirm if you Registering the account<br>Thats why we need you to Verify your account by clicking the link in below.
                          </p>
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                            <tbody>
                              <tr>
                                <td align="left">
                                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                      <tr>
                                        <td><a href="' . base_url() . 'auth/verify?username=' . $this->input->post('username') . '&token=' . urlencode($token) . '"> Click To Verify Your Password ' . $this->input->post('username') . '</a> </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <p>Dont worry, the verification just one time.</p>
                          <p>Happy Playing And Enjoyed !.</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                </table>
                <div class="footer">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="content-block">
                      <span class="apple-link">WibuSaga Inc, In Your Hearts</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="content-block powered-by">
                      Powered by <a href="http://wibusaga.xyz">WibuSaga</a>.
                    </td>
                  </tr>
                </table>
              </div>
                
</div>
</td>
<td>&nbsp;</td>
</tr>
</table>
</body>
</html>');
    }

    if ($type == 'forgot') {
      $this->email->subject('Reset Password');
      $this->email->message('<html>
            <head>
              <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <title>Simple Transactional Email</title>
              <style>
              img {
                border: none;
                -ms-interpolation-mode: bicubic;
                max-width: 100%; 
              }
        
              body {
                background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%; 
              }
        
              table {
                border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%; }
                table td {
                  font-family: sans-serif;
                  font-size: 14px;
                  vertical-align: top; 
              }
              .body {
                background-color: #f6f6f6;
                width: 100%; 
              }
              .container {
                display: block;
                margin: 0 auto !important;
                /* makes it centered */
                max-width: 580px;
                padding: 10px;
                width: 580px; 
              }
              .content {
                box-sizing: border-box;
                display: block;
                margin: 0 auto;
                max-width: 580px;
                padding: 10px; 
              }
              .main {
                background: #ffffff;
                border-radius: 3px;
                width: 100%; 
              }
        
              .wrapper {
                box-sizing: border-box;
                padding: 20px; 
              }
        
              .content-block {
                padding-bottom: 10px;
                padding-top: 10px;
              }
        
              .footer {
                clear: both;
                margin-top: 10px;
                text-align: center;
                width: 100%; 
              }
                .footer td,
                .footer p,
                .footer span,
                .footer a {
                  color: #999999;
                  font-size: 12px;
                  text-align: center; 
              }
              h1,
              h2,
              h3,
              h4 {
                color: #000000;
                font-family: sans-serif;
                font-weight: 400;
                line-height: 1.4;
                margin: 0;
                margin-bottom: 30px; 
              }
        
              h1 {
                font-size: 35px;
                font-weight: 300;
                text-align: center;
                text-transform: capitalize; 
              }
        
              p,
              ul,
              ol {
                font-family: sans-serif;
                font-size: 14px;
                font-weight: normal;
                margin: 0;
                margin-bottom: 15px; 
              }
                p li,
                ul li,
                ol li {
                  list-style-position: inside;
                  margin-left: 5px; 
              }
        
              a {
                color: #3498db;
                text-decoration: underline; 
              }
              .btn {
                box-sizing: border-box;
                width: 100%; }
                .btn > tbody > tr > td {
                  padding-bottom: 15px; }
                .btn table {
                  width: auto; 
              }
                .btn table td {
                  background-color: #ffffff;
                  border-radius: 5px;
                  text-align: center; 
              }
                .btn a {
                  background-color: #ffffff;
                  border: solid 1px #3498db;
                  border-radius: 5px;
                  box-sizing: border-box;
                  color: #3498db;
                  cursor: pointer;
                  display: inline-block;
                  font-size: 14px;
                  font-weight: bold;
                  margin: 0;
                  padding: 12px 25px;
                  text-decoration: none;
                  text-transform: capitalize; 
              }
        
              .btn-primary table td {
                background-color: #3498db; 
              }
        
              .btn-primary a {
                background-color: #3498db;
                border-color: #3498db;
                color: #ffffff; 
              }
              .last {
                margin-bottom: 0; 
              }
        
              .first {
                margin-top: 0; 
              }
        
              .align-center {
                text-align: center; 
              }
        
              .align-right {
                text-align: right; 
              }
        
              .align-left {
                text-align: left; 
              }
        
              .clear {
                clear: both; 
              }
        
              .mt0 {
                margin-top: 0; 
              }
        
              .mb0 {
                margin-bottom: 0; 
              }
        
              .preheader {
                color: transparent;
                display: none;
                height: 0;
                max-height: 0;
                max-width: 0;
                opacity: 0;
                overflow: hidden;
                mso-hide: all;
                visibility: hidden;
                width: 0; 
              }
        
              .powered-by a {
                text-decoration: none; 
              }
        
              hr {
                border: 0;
                border-bottom: 1px solid #f6f6f6;
                margin: 20px 0; 
              }
              @media only screen and (max-width: 620px) {
                table.body h1 {
                  font-size: 28px !important;
                  margin-bottom: 10px !important; 
                }
                table.body p,
                table.body ul,
                table.body ol,
                table.body td,
                table.body span,
                table.body a {
                  font-size: 16px !important; 
                }
                table.body .wrapper,
                table.body .article {
                  padding: 10px !important; 
                }
                table.body .content {
                  padding: 0 !important; 
                }
                table.body .container {
                  padding: 0 !important;
                  width: 100% !important; 
                }
                table.body .main {
                  border-left-width: 0 !important;
                  border-radius: 0 !important;
                  border-right-width: 0 !important; 
                }
                table.body .btn table {
                  width: 100% !important; 
                }
                table.body .btn a {
                  width: 100% !important; 
                }
                table.body .img-responsive {
                  height: auto !important;
                  max-width: 100% !important;
                  width: auto !important; 
                }
              }
              @media all {
                .ExternalClass {
                  width: 100%; 
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                  line-height: 100%; 
                }
                .apple-link a {
                  color: inherit !important;
                  font-family: inherit !important;
                  font-size: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
                  text-decoration: none !important; 
                }
                #MessageViewBody a {
                  color: inherit;
                  text-decoration: none;
                  font-size: inherit;
                  font-family: inherit;
                  font-weight: inherit;
                  line-height: inherit;
                }
                .btn-primary table td:hover {
                  background-color: #34495e !important; 
                }
                .btn-primary a:hover {
                  background-color: #34495e !important;
                  border-color: #34495e !important; 
                } 
              }
        
            </style>
          </head>
          <body>
            <span class="preheader">Reset Password Account WibuSaga. | </span>
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
              <tr>
                <td>&nbsp;</td>
                <td class="container">
                  <div class="content">
                  <table role="presentation" class="main">
                  <tr>
                  <td class="wrapper">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>
                          <p>Hi ' . $this->input->post('email') . ',</p>
                          <p>This is your verification link of resetting password. <br> Please do not give this link to anyone.
                          </p>
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                            <tbody>
                              <tr>
                                <td align="left">
                                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                      <tr>
                                        <td><a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Click To Reset Your Password ' . $this->input->post('email') . '</a> </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <p>Happy Playing And Enjoyed !.</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                </table>
                <div class="footer">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="content-block">
                      <span class="apple-link">WibuSaga Inc, In Your Hearts</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="content-block powered-by">
                      Powered by <a href="http://wibusaga.xyz">WibuSaga</a>.
                    </td>
                  </tr>
                </table>
              </div>
                
</div>
</td>
<td>&nbsp;</td>
</tr>
</table>
</body>
</html>');
    }

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function verify()
  {
    $username = $this->input->get('username');
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('userMemberDB', ['userID' => $username])->row_array();

    if ($user) {
      $user_token = $this->db->get_where('userMemberDB', ['verification_code' => $token])->row_array();
      if ($user['verify'] == 'verify') {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Your ID : ' . $username . ' Already Verify!</div>');
        redirect('auth/login');
      }
      if ($user_token) {
        $this->db->set('verify', 'verify');
        $this->db->where('userID', $username);
        $this->db->update('userMemberDB');
        $this->db->set('verification_code', '');
        $this->db->where('userID', $username);
        $this->db->update('userMemberDB');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Verify Username : ' . $username . ' Success!</div>');
        redirect('auth/login');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Account Activation Failed! Wrong Token Verify</div>');
        redirect('auth/login');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Account Activation Failed! Wrong UserID</div>');
      redirect('auth/login');
    }
  }


  public function logout()
  {
    $this->session->unset_userdata('userID');
    $this->session->unset_userdata('role_id');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You Have Been logged out!</div>');
    redirect('auth/login');
  }
  public function blocked()
  {
    $this->load->view('auth/403');
  }

  public function forgotPassword()
  {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Forgot Password';
      $data['home'] = 'active';
      $data['download'] = '';
      $data['rank'] = '';
      $data['donation'] = '';
      $this->load->view('home/template/home_header', $data);
      $this->load->view('auth/forgot-password');
      $this->load->view('home/template/home_footer');
    } else {
      $email = $this->input->post('email');
      $user = $this->db->get_where('userMemberDB', ['email' => $email, 'verify' => 'verify'])->row_array();
      $cekemail = $this->db->get_where('WibuSaga_Reset_Password', ['email' => $email])->row_array();
      if ($cekemail['email'] == $email) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Your Email : ' . $email . ' Have Token Reset, Please check your email to reset your password!</div>');
        redirect('auth/forgotpassword');
      }
      if ($user) {
        $token = base64_encode(random_bytes(32));
        $user_token = [
          'email' => $email,
          'date_created' => time(),
          'token' => $token
        ];

        $this->db->insert('WibuSaga_Reset_Password', $user_token);
        $this->_sendEmail($token, 'forgot');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Please check your email to reset password!</div>');
        redirect('auth/forgotpassword');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Email is not registered or activated!</div>');
        redirect('auth/forgotpassword');
      }
    }
  }
  public function resetpassword()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('userMemberDB', ['email' => $email])->row_array();

    if ($user) {
      $user_token = $this->db->get_where('WibuSaga_Reset_Password', ['token' => $token])->row_array();
      if ($user_token) {
        if (time() - $user_token['date_created'] < (60 * 60 * 1)) {
          $this->session->set_userdata('reset_email', $email);
          $this->changepassword();
        } else {
          $this->db->delete('WibuSaga_Reset_Password', ['email' => $email]);
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Reset Password Failed! Token Expired</div>');
          redirect('auth/login');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Reset Failed! Wrong Token</div>');
        redirect('auth/login');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Reset Failed! Wrong Email</div>');
      redirect('auth/login');
    }
  }
  public function changepassword()
  {
    if (!$this->session->userdata('reset_email')) {
      redirect('auth/login');
    }
    $this->form_validation->set_rules(
      'password1',
      'Password',
      'required|trim|min_length[6]|max_length[14]|matches[password2]',
      [
        'matches' => 'Password Dont Match Re-Password!',
        'min_length' => 'Password Too Short!',
        'max_length' => 'Password Too Long!'
      ]
    );
    $this->form_validation->set_rules(
      'password2',
      'Re-Password',
      'required|trim|matches[password1]',
      [
        'matches' => 'Password Dont Match Password!',
        'min_length' => 'Password Too Short!',
        'max_length' => 'Password Too Long!'
      ]
    );
    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Change Password';
      $data['home'] = 'active';
      $data['download'] = '';
      $data['rank'] = '';
      $data['donation'] = '';
      $this->load->view('home/template/home_header', $data);
      $this->load->view('auth/change-password');
      $this->load->view('home/template/home_footer');
    } else {
      $password = password_hash($this->input->post('password1'), PASSWORD_BCRYPT);
      $email = $this->session->userdata('reset_email');

      $this->db->set('userPWD', $password);
      $this->db->where('email', $email);
      $this->db->update('userMemberDB');

      $this->db->delete('WibuSaga_Reset_Password', ['email' => $email]);
      $this->session->unset_userdata('reset_email');
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Password Has Been Changed! Please Login</div>');
      redirect('auth/login');
    }
  }
  public function _sendBotDiscord($token, $type)
  {
    if ($type == 'regist') {
      //bot discord//
      date_default_timezone_set('Asia/Jakarta');
      $regDates = (new \DateTime())->format('Y-m-d H:i:s');
      $url = "https://discord.com/api/webhooks/949945454727151657/yGZ_aukGGbaqI3-gmtFAo0SHtceFpEAhKo1qot2mn_cLFzPb7klrRrZs8hGWYA2pjeH3";
      $headers = ['Content-Type: application/json; charset=utf-8'];

      $hookObject = json_encode(
        [
          /*
    * The general "message" shown above your embeds
    */
          "content" => "",
          /*
    * The username shown in the message
    */
          "username" => "LOG REGISTER WIBUSAGA",
          /*
    * The image location for the senders image
    */
          "avatar_url" => "",
          /*
    * Whether or not to read the message in Text-to-speech
    */
          "tts" => false,
          /*
    * File contents to send to upload a file
    */
          // "file" => "",
          /*
    * An array of Embeds
    */
          "embeds" => [
            /*
        * Our first embed
        */
            [
              // Set the title for your embed
              "title" => "WibuSaga",

              // The type of your embed, will ALWAYS be "rich"
              "type" => "rich",

              // A description for your embed
              "description" => "Someone has registered an Account",

              // The URL of where your title will be a link to
              "url" => "https://wibusaga.xyz/",

              /* A timestamp to be displayed below the embed, IE for when an an article was posted
            * This must be formatted as ISO8601
            */
              "timestamp" => date(DATE_ISO8601, strtotime($regDates)),

              // The integer color to be used on the left side of the embed
              "color" => hexdec("5865F2"),

              // Footer object
              "footer" => [
                "text" => "MADE BY WIBUSAGA",
                "icon_url" => "https://styles.redditmedia.com/t5_2tjkp/styles/communityIcon_j1vhjmngovq21.png"
              ],

              // Thumbnail object
              // "thumbnail" => [
              //     "url" => "https://styles.redditmedia.com/t5_2tjkp/styles/communityIcon_j1vhjmngovq21.png"
              // ],

              // Author object
              // "author" => [
              //     "name" => "Alphabet",
              //     "url" => "https://www.abc.xyz"
              // ],

              // Field array of objects
              "fields" => [

                // Field 1
                [
                  "name" => "Username",
                  "value" => strtoupper($this->input->post('username')),
                  "inline" => true
                ],
                // Field 2
                [
                  "name" => "Nickname",
                  "value" => strtoupper($this->input->post('Nickname')),
                  "inline" => true
                ],
                // Field 3
                [
                  "name" => "Register At",
                  "value" => $regDates,
                  "inline" => true
                ]
              ]
            ]
          ]

        ],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
      );

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $hookObject);

      $response = curl_exec($ch);

      if ($response) {
      }
    }
  }
}
