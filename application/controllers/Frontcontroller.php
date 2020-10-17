<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Frontcontroller extends CI_Controller{
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('service_model'); 
        $this->load->model('cart_model');
        $this->load->model('login_model');

        /*$this->load->model('Contactus_model');
        $this->load->model('Classes_model');*/

        $this->frontLogin = false;
        
        $isLoggedIn = $this->session->userdata ( 'isFrontLoggedIn' );
        $this->frontUsername    = "";
        $this->frontUserId      = "";
        
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
            $this->frontLogin = false;
        } 
        else {
            $this->frontLogin = true;
            $this->frontUsername = $this->session->userdata ( 'front_username' );
            $this->frontUserId = $this->session->userdata ( 'front_user_id' );
        }
    }

    public function processCookieData(){

        $this->serviceCartCookie  = ((isset($_COOKIE['serviceCartCookie']) && !empty($_COOKIE['serviceCartCookie'])) ? json_decode($_COOKIE['serviceCartCookie'], 1) : array("serviceids" => []));
        $this->cartDetailsInfo    = ((isset($_COOKIE['cartDetailsInfo']) && !empty($_COOKIE['cartDetailsInfo'])) ? json_decode($_COOKIE['cartDetailsInfo'], 1) : array("dateselect" => array("date" => "", "time" => "")));
        $this->cartUserInfo       = (isset($_COOKIE['cartUserInfo']) ? json_decode($_COOKIE['cartUserInfo'], 1) : array());
        $this->user_address       = (isset($_COOKIE['user_address']) ? json_decode($_COOKIE['user_address'], 1) : "Dubai");
        $this->user_lat           = (isset($_COOKIE['user_lat']) ? json_decode($_COOKIE['user_lat'], 1) : "");
        $this->user_lng           = (isset($_COOKIE['user_lng']) ? json_decode($_COOKIE['user_lng'], 1) : "");
    }

    /**
     * Index Page for this controller.
     */
    public function index(){    
        $data['frontLogin'] = $this->frontLogin;    
        $data['frontUsername'] = $this->frontUsername;    
        $data['frontUserId'] = $this->frontUserId;

        $data['title'] = PROJECT_NAME;
        $data['description'] = PROJECT_NAME . ' - Home';  
        $data['currentpage'] = 'homepage';

        $this->loadViews('frontend/home', $data);
    }

    /**
     * Index Page for this controller.
     */
    public function map(){        
        $data['title'] = PROJECT_NAME;
        $data['description'] = PROJECT_NAME . ' - Map';  
        $data['currentpage'] = 'mappage';

        $this->loadViews('frontend/map', $data);
    }

    /**
     * Index Page for this controller.
     */
    public function service(){
        $this->checkServiceCartCookieIsEmpty();
        $this->processCookieData();

        $this->jsCheckMapCookieNotSet();

        $data['title'] = PROJECT_NAME;
        $data['description'] = PROJECT_NAME . ' - Service';  
        $data['currentpage'] = 'servicepage';
        $data['user_address'] = $this->user_address;
        $data['selectedService'] = $this->serviceCartCookie;
        $data['serviceRecords'] = $this->getAllServices();
        $data['frontLogin'] = $this->frontLogin;    
        $data['frontUsername'] = $this->frontUsername;    
        $data['frontUserId'] = $this->frontUserId;

        $this->loadViews('frontend/service', $data);
    }

    public function dateSelect(){
        $this->processCookieData();

        $this->jsCheckServiceCookieNotSet();

        $data['title'] = PROJECT_NAME;
        $data['description'] = PROJECT_NAME . ' - Select Date and Time';  
        $data['currentpage'] = 'datetimepage';
        $data['cartDetailsInfo'] = $this->cartDetailsInfo;
        $data['selectedService'] = $this->serviceCartCookie;
        $data['user_address'] = $this->user_address;
        $data['frontLogin'] = $this->frontLogin;    
        $data['frontUsername'] = $this->frontUsername;    
        $data['frontUserId'] = $this->frontUserId;

        $this->loadViews('frontend/dateselect', $data);
    }

    public function addPersonalInfo(){
        $this->processCookieData();

        $this->jsCheckCartDetailsCookieNotSet();

        $data['frontLogin'] = $this->frontLogin;    
        $data['frontUsername'] = $this->frontUsername;    
        $data['frontUserId'] = $this->frontUserId;
        $data['title'] = PROJECT_NAME;
        $data['description'] = PROJECT_NAME . ' - Enter Your Personal Details';  
        $data['currentpage'] = 'personalinfopage';
        $data['cartDetailsInfo'] = $this->cartDetailsInfo;
        $data['selectedService'] = $this->serviceCartCookie;
        $data['cartUserInfo'] = $this->cartUserInfo;
        $data['user_address'] = $this->user_address;

        $this->loadViews('frontend/addpersonalinfo', $data);
    }

    public function savePersonalInfo(){
        $this->processCookieData();
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('txtFName','First Name','trim|required|max_length[250]');
        $this->form_validation->set_rules('txtLName','Last Name','trim|required|max_length[250]');
        $this->form_validation->set_rules('txtPhone','Phone','trim|required|max_length[50]');
        $this->form_validation->set_rules('txtEmail','Email','trim|required|callback_exists_email|max_length[50]');
        $this->form_validation->set_rules('txtPassword','Password','trim|required|max_length[50]');
        $this->form_validation->set_rules('txtCPassword','Confirm Password','trim|required|matches[txtPassword]|max_length[50]');

        if($this->form_validation->run() == FALSE){
            redirect('add-personal-info');
        }
        else {
            $txtFName = ucwords(strtolower($this->security->xss_clean($this->input->post('txtFName'))));
            $txtLName = ucwords(strtolower($this->security->xss_clean($this->input->post('txtLName'))));
            $txtPhone = strtolower($this->security->xss_clean($this->input->post('txtPhone')));
            $txtEmail = strtolower($this->security->xss_clean($this->input->post('txtEmail')));
            $txtPassword = $this->security->xss_clean($this->input->post('txtPassword'));


            $userInfo = array('email' => $txtEmail, 'first_name'=> $txtFName, 'last_name' => $txtLName, 'phone_number' => $txtPhone,'username' => $txtEmail,'password' => getHashedPassword($txtPassword), 'location_full_address' => $this->user_address, 'location_lat' => $this->user_lat, 'location_lng' => $this->user_lng, 'add_date' => date('Y-m-d H:i:s'));

            $result = $this->user_model->addNewUserDetails($userInfo);
            if($result > 0){

                $this->session->set_userdata ( 'front_username', $txtEmail );
                $this->session->set_userdata ( 'front_user_id', $result );
                $this->session->set_userdata ( 'isFrontLoggedIn', TRUE );

                $txtFName = ucwords(strtolower($this->security->xss_clean($this->input->post('txtFName'))));
                $txtLName = ucwords(strtolower($this->security->xss_clean($this->input->post('txtLName'))));
                $txtPhone = strtolower($this->security->xss_clean($this->input->post('txtPhone')));
                $txtEmail = strtolower($this->security->xss_clean($this->input->post('txtEmail')));

                $arrPersonalInfo = array("txtFName" => $txtFName, 
                                        "txtLName" => $txtLName,
                                        "txtPhone" => $txtPhone,
                                        "txtEmail" => $txtEmail);

                $cookie_name  = 'cartUserInfo';  
                $cookie_name_value = rawurldecode(json_encode($arrPersonalInfo));
                setcookie($cookie_name, $cookie_name_value, time() + (86400 * 7), "/"); // one day example


                $sessionArray = array('userId'=>$result,                    
                                    'front_user_id'=>$result,
                                    'first_name'=>$txtFName,
                                    'last_name'=>$txtLName,
                                    'email'=>$txtEmail,
                                    'front_username'=>$txtEmail,
                                    'phone_number'=>$txtPhone,
                                    'location_full_address' => $this->user_address,
                                    'location_lat'=>$this->user_lat,
                                    'location_lng'=>$this->user_lng,
                                    'isFrontLoggedIn' => TRUE
                                );

                $this->session->set_userdata($sessionArray);

                $cookie_name  = 'user_name_session';  
                $cookie_pass  = 'user_pass_session';  
                $cookie_name_value = "";
                $cookie_pass_value = "";
                setcookie($cookie_name, $cookie_name_value, time() + (86400 * 7), "/"); // one day example
                setcookie($cookie_pass, $cookie_pass_value, time() + (86400 * 7), "/"); // one day example


                $this->session->set_flashdata('success', 'New User registration is done successfully.');
                redirect('order-confirm');
            }
            else{
                $this->session->set_flashdata('error', 'User creation failed');
                redirect('add-personal-info');
            }
        }
    }

    public function savePersonalInfoOnly(){
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('txtFName','First Name','trim|required|max_length[250]');
        $this->form_validation->set_rules('txtLName','Last Name','trim|required|max_length[250]');
        $this->form_validation->set_rules('txtPhone','Phone','trim|required|max_length[50]');
        $this->form_validation->set_rules('txtEmail','Email','trim|required|max_length[50]');

        if($this->form_validation->run() == FALSE){
            redirect('add-personal-info');
        }
        else {
            $txtFName = ucwords(strtolower($this->security->xss_clean($this->input->post('txtFName'))));
            $txtLName = ucwords(strtolower($this->security->xss_clean($this->input->post('txtLName'))));
            $txtPhone = strtolower($this->security->xss_clean($this->input->post('txtPhone')));
            $txtEmail = strtolower($this->security->xss_clean($this->input->post('txtEmail')));

            $arrPersonalInfo = array("txtFName" => $txtFName, 
                                    "txtLName" => $txtLName,
                                    "txtPhone" => $txtPhone,
                                    "txtEmail" => $txtEmail);

            $cookie_name  = 'cartUserInfo';  
            $cookie_name_value = rawurldecode(json_encode($arrPersonalInfo));
            setcookie($cookie_name, $cookie_name_value, time() + (86400 * 7), "/"); // one day example

            redirect('order-confirm');
        }
    }

    public function orderConfirm(){
        $this->processCookieData();

        $this->jsCheckCartDetailsCookieNotSet();

        $data['frontLogin'] = $this->frontLogin;    
        $data['frontUsername'] = $this->frontUsername;    
        $data['frontUserId'] = $this->frontUserId;
        $data['title'] = PROJECT_NAME;
        $data['description'] = PROJECT_NAME . ' - Confirm the Booking';  
        $data['currentpage'] = 'orderconfirmpage';
        $data['cartDetailsInfo'] = $this->cartDetailsInfo;
        $data['selectedService'] = $this->serviceCartCookie;
        $data['cartUserInfo'] = $this->cartUserInfo;
        $data['user_address'] = $this->user_address;

        $this->loadViews('frontend/orderconfirm', $data);
    }

    public function saveOrderConfirmInfo(){
        $this->processCookieData();
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('taOrderNotes','Booking Notes','trim|required');

        if($this->form_validation->run() == FALSE){
            redirect('order-confirm');
        }
        else {
            $taOrderNotes = strtolower($this->security->xss_clean($this->input->post('taOrderNotes')));

            if($this->saveCartInfo($taOrderNotes)){
                redirect('thankyou');    
            }
            else{
                redirect('order-confirm');
            }
        }
    }

    public function thankyou(){
        $data['title'] = PROJECT_NAME;
        $data['description'] = PROJECT_NAME . ' - Thank You';  
        $data['currentpage'] = 'thankyoupage';
        $this->loadViews('frontend/thankyou', $data);
    }

    public function orderHistory(){
        $data['title'] = PROJECT_NAME;
        $data['description'] = PROJECT_NAME . ' - Order History';  
        $data['currentpage'] = 'orderhistorypage';
        $data['frontLogin'] = $this->frontLogin;    
        $data['frontUsername'] = $this->frontUsername;    
        $data['frontUserId'] = $this->frontUserId;
        $data['orderhistory'] = $this->getOrderHistory($this->frontUserId);
        $this->loadViews('frontend/orderhistory', $data);
    }


    public function login(){
        $isFrontLoggedIn = $this->session->userdata('isFrontLoggedIn');
        
        if(!isset($isFrontLoggedIn) || $isFrontLoggedIn != TRUE){
            $data = array();
            $data['title'] = PROJECT_NAME;
            $data['description'] = PROJECT_NAME . ' - Login';  
            $data['currentpage'] = 'loginpage';

            $this->load->view('frontend/login', $data);
        }
        else {
            redirect('/', 'refresh');
        }
    }

    public function loginUser(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('txtUsername', 'Username', 'required|max_length[50]');
        $this->form_validation->set_rules('txtPassword', 'Password', 'required|max_length[50]');
        
        if($this->form_validation->run() == FALSE){
            redirect('login');
        }
        else {
            $txtUsername = strtolower($this->security->xss_clean($this->input->post('txtUsername')));
            $txtPassword = $this->security->xss_clean($this->input->post('txtPassword'));
            
            $result = $this->login_model->loginCustomer($txtUsername, $txtPassword);

            if(!verifyHashedPassword($txtPassword, $result->password)){
                $result =  array();
            }

            if(!empty($result)) { 

                if(isset($_REQUEST['remember_me'])) {
                    $cookie_name  = 'user_name_session';  
                    $cookie_pass  = 'user_pass_session';  
                    $cookie_name_value = rawurldecode ($txtUsername);
                    $cookie_pass_value = rawurldecode ($txtPassword);
                    setcookie($cookie_name, $cookie_name_value, time() + (86400 * 7), "/"); // one day example
                    setcookie($cookie_pass, $cookie_pass_value, time() + (86400 * 7), "/"); // one day example
                }
                else{
                    $cookie_name  = 'user_name_session';  
                    $cookie_pass  = 'user_pass_session';  
                    $cookie_name_value = "";
                    $cookie_pass_value = "";
                    setcookie($cookie_name, $cookie_name_value, time() + (86400 * 7), "/"); // one day example
                    setcookie($cookie_pass, $cookie_pass_value, time() + (86400 * 7), "/"); // one day example
                }

                $sessionArray = array('userId'=>$result->id,                    
                                    'front_user_id'=>$result->id,
                                    'first_name'=>$result->first_name,
                                    'last_name'=>$result->last_name,
                                    'email'=>$result->email,
                                    'front_username'=>$result->email,
                                    'phone_number'=>$result->phone_number,
                                    'location_full_address'=>$result->location_full_address,
                                    'location_lat'=>$result->location_lat,
                                    'location_lng'=>$result->location_lng,
                                    'isFrontLoggedIn' => TRUE
                                );

                $this->session->set_userdata($sessionArray);

                $arrPersonalInfo = array("txtFName" => $result->first_name, 
                                    "txtLName" => $result->last_name,
                                    "txtPhone" => $result->phone_number,
                                    "txtEmail" => $result->email);

                $cookie_name  = 'cartUserInfo';  
                $cookie_name_value = json_encode($arrPersonalInfo);
                setcookie($cookie_name, $cookie_name_value, time() + (86400 * 7), "/"); // one day example
            
                redirect('/', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Username or password mismatch');
                redirect('login');
            }
        }
    }

    public function register(){
        $isFrontLoggedIn = $this->session->userdata('isFrontLoggedIn');
        
        if(!isset($isFrontLoggedIn) || $isFrontLoggedIn != TRUE){
            $data = array();
            $data['title'] = PROJECT_NAME;
            $data['description'] = PROJECT_NAME . ' - Register';  
            $data['currentpage'] = 'loginpage';

            $this->load->view('frontend/register', $data);
        }
        else {
            redirect('/', 'refresh');
        }
    }

    public function saveRegisterInfo(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('txtFName','First Name','trim|required|max_length[250]');
        $this->form_validation->set_rules('txtLName','Last Name','trim|required|max_length[250]');
        $this->form_validation->set_rules('txtPhone','Phone','trim|required|max_length[50]');
        $this->form_validation->set_rules('txtEmail','Email','trim|required|callback_exists_email|max_length[50]');
        $this->form_validation->set_rules('txtPassword','Password','trim|required|max_length[50]');
        $this->form_validation->set_rules('txtCPassword','Confirm Password','trim|required|matches[txtPassword]|max_length[50]');

        if($this->form_validation->run() == FALSE){
            redirect('register');
        }
        else {
            $txtFName = ucwords(strtolower($this->security->xss_clean($this->input->post('txtFName'))));
            $txtLName = ucwords(strtolower($this->security->xss_clean($this->input->post('txtLName'))));
            $txtPhone = strtolower($this->security->xss_clean($this->input->post('txtPhone')));
            $txtEmail = strtolower($this->security->xss_clean($this->input->post('txtEmail')));
            $txtPassword = $this->security->xss_clean($this->input->post('txtPassword'));


            $userInfo = array('email' => $txtEmail, 'first_name'=> $txtFName, 'last_name' => $txtLName, 'phone_number' => $txtPhone,'username' => $txtEmail,'password' => getHashedPassword($txtPassword), 'add_date' => date('Y-m-d H:i:s'));

            $result = $this->user_model->addNewUserDetails($userInfo);
            if($result > 0){

                $this->session->set_userdata ( 'front_username', $txtEmail );
                $this->session->set_userdata ( 'front_user_id', $result );
                $this->session->set_userdata ( 'isFrontLoggedIn', TRUE );

                $this->session->set_flashdata('success', 'New User registration is done successfully.');
                redirect('/', "refresh");
            }
            else{
                $this->session->set_flashdata('error', 'User creation failed');
                redirect('register');
            }
        }
    }

    public function logout(){
        $this->session->sess_destroy ();
        $this->unsetCartCookies();
        redirect ( 'login' );
    }

    public function forgotPassword(){
        $isFrontLoggedIn = $this->session->userdata('isFrontLoggedIn');
        
        if(!isset($isFrontLoggedIn) || $isFrontLoggedIn != TRUE){
            $data = array();
            $data['title'] = PROJECT_NAME;
            $data['description'] = PROJECT_NAME . ' - Forgot Password';  
            $data['currentpage'] = 'forgotpasswordpage';

            $this->load->view('frontend/forgotPassword', $data);
        }
        else {
            redirect('/', 'refresh');
        }
    }

    public function resetPassword(){
        $status = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('txtUsername','Username','trim|required|max_length[50]');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
            //redirect('forgot-password');
        }
        else 
        {
            $username = $this->security->xss_clean($this->input->post('txtUsername'));
            
            if($this->login_model->checkActiveCustomerExist($username))
            {
                $userInfoEmail = $this->login_model->getFrontCustomerInfoByUsername($username);
                if(!empty($userInfoEmail)){
                    $data1["name"] = $userInfoEmail->first_name . " " . $userInfoEmail->last_name;
                    $data1["email"] = $userInfoEmail->email;
                    $data1["message"] = "Reset Your Password";
                    $encoded_username = urlencode($username);
                    $email = $userInfoEmail->email;
               
                    $this->load->helper('string');
                    $data['username'] = $username;
                    $data['user_type'] = "customer";
                    $data['activation_id'] = random_string('alnum',15);
                    $data['createdDtm'] = date('Y-m-d H:i:s');
                    $data['agent'] = getBrowserAgent();
                    $data['client_ip'] = $this->input->ip_address();
                
                    $save = $this->login_model->resetPassword($data);                
                
                    if($save)
                    {
                        $data1['reset_link'] = base_url() . "confirmresetpassword/" . $data['activation_id'] . "/" . $encoded_username;

                        $sendStatus = $this->resetPasswordEmail($data1);

                        /*echo "<pre>";
                        print_r($data1);
                        die();*/

                        $sendStatus = true;

                        if($sendStatus){
                            $status = "send";
                            setFlashData($status, "Reset password link has been sent. Please check your mail.");
                        } else {
                            $status = "notsend";
                            setFlashData($status, "Email has been failed, try again.");
                        }
                    }
                    else
                    {
                        $status = 'unable';
                        setFlashData($status, "It seems an error while sending your details, try again.");
                    }
                }
                else
                {
                    $status = 'invalid';
                    setFlashData($status, "This username is not registered with us.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "This username is not registered with us.");
            }
            redirect('forgot-password');
        }
    }

    public function confirmResetPassword($activation_id, $username)
    {
        // Get email and activation code from URL values at index 3-4
        $username = urldecode($username);
        
        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($username, $activation_id, "customer");
        
        $data['username'] = $username;
        $data['activation_code'] = $activation_id;
        $data['title'] = PROJECT_NAME;
        $data['description'] = PROJECT_NAME . ' - New Password';  
        $data['currentpage'] = 'newpasswordpage';

        
        if ($is_correct == 1)
        {
            $this->load->view('frontend/newpassword', $data);
        }
        else
        {
            redirect('login');
        }
    }

    public function createNewPassword(){
        $status = '';
        $message = '';
        $username = strtolower($this->input->post("txtUsername"));
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('txtPassword','Password','required|max_length[50]');
        $this->form_validation->set_rules('txtCPassword','Confirm Password','trim|required|matches[txtPassword]|max_length[50]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->confirmResetPassword($activation_id, urlencode($username));
        }
        else
        {
            $password = $this->input->post('txtPassword');
            $cpassword = $this->input->post('txtCPassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($username, $activation_id, 'customer');
            
            if($is_correct == 1)
            {                
                $this->login_model->createNewCustomerPassword($username, $password, 'customer');
                
                $status = 'success';
                $message = 'Password reset successfully';
            }
            else
            {
                $status = 'error';
                $message = 'Password reset failed';
            }
            
            setFlashData($status, $message);

            redirect("login");
        }
    }

    function resetPasswordEmail($detail) {
        $data["data"] = $detail;
        

        $this->load->library('email');
                
        //Admin Email 
        $this->email->from(ADMINMAIL, ADMINNAME);
        $this->email->to($detail["email"]);
        $this->email->bcc('sarathcp007@gmail.com');
        $this->email->subject(PROJECT_NAME . ' : Reset Password');

        
        $emailOuter = $this->load->view('email/emailoutertemplate',$data,true);
        $adminMessageBody = $this->load->view('email/resetPassword',$data,true);
        $fullEmailMessage = str_replace('[contentarea]',$adminMessageBody,$emailOuter);
        
        $this->email->set_mailtype("html");
        $this->email->message($fullEmailMessage);
        $status = $this->email->send();

        
        return $status;
    }

    function exists_email($email){       
        $return = false;
        $result = $this->user_model->checkCustomerEmailExists($email);

        if(empty($result)){ 
            $return = true; 
        }
        else {
            $this->form_validation->set_message('exists_email', 'User with given {field} is already exist. Please login with {field} or try with different {field}');
            $return = false;
        }

        return $return;
    }

    function saveCartInfo($orderNote){
        $cartDetailsInfo    = $this->cartDetailsInfo;
        $selectedService    = $this->serviceCartCookie;
        $cartUserInfo       = $this->cartUserInfo;
        $arrAllServices     = $this->getAllServices(false);

        $arrCartMasterInfo = array("customer_id" => $this->frontUserId, 
                            "service_date" => $cartDetailsInfo['dateselect']['date'], 
                            "service_time" => $cartDetailsInfo['dateselect']['time'],
                            "booking_note" => $orderNote,
                            "vat" => "5",
                            "status" => "PN",
                            "total_price" => 0,
                            "add_date" => date('Y-m-d H:i:s')
                        );

        $cartMasterId = $this->cart_model->addIntoCartMaster($arrCartMasterInfo);

        if($cartMasterId > 0){
            $arrPersonalInfo = array("cartmaster_id"  => $cartMasterId, 
                                "first_name"            => $cartUserInfo['txtFName'], 
                                "last_name"             => $cartUserInfo['txtLName'], 
                                "email"                 => $cartUserInfo['txtEmail'], 
                                "phone"                 => $cartUserInfo['txtPhone'], 
                                "address"               => $this->user_address,
                                "location_latitude"     => $this->user_lat,
                                "location_longitude"    => $this->user_lng,
                                "add_date"              => date('Y-m-d H:i:s')
                            );

            $cartPersonalInfoId = $this->cart_model->addIntoCartPersonalInfo($arrPersonalInfo);

            $arrCustomerInfo = array('location_full_address' => $this->user_address, 'location_lat' => $this->user_lat, 'location_lng' => $this->user_lng);

            $result = $this->user_model->updateuser($arrCustomerInfo, $this->frontUserId);

            $cartTotalPrice = 0;

            foreach ($selectedService['serviceids'] as $key => $value) {
                if(!empty($value)){
                    $arrCartInfo = array("cartmaster_id" => $cartMasterId,
                                        "service_id" => $value["serviceId"],
                                        "price" => $arrAllServices[$value["serviceId"]]["price"],
                                        "person" => $value["persion"],
                                        "add_date" => date('Y-m-d H:i:s')
                                    );
                    $cartId = $this->cart_model->addIntoCartInfo($arrCartInfo);

                    $cartTotalPrice += $value["persion"] * $arrAllServices[$value["serviceId"]]["price"];
                }
            }

            $cartTotalPrice += $cartTotalPrice * 0.05;

            $arrCartMasterInfo = array( "total_price" => $cartTotalPrice, "order_id" => "ES" . $cartMasterId);
            $this->cart_model->updateCartMaster($arrCartMasterInfo, $cartMasterId);

            $this->unsetCartCookies();

            return true;
        }
        else{
            return false;
        }
    }

    function unsetCartCookies(){
        setcookie("serviceCartCookie", "", time() - 3600);
        setcookie("cartDetailsInfo", "", time() - 3600);
        setcookie("cartUserInfo", "", time() - 3600);
    }

    /**
     * This function used to load views
     * @param {string} $viewName : This is view name
     * @param {mixed} $headerInfo : This is array of header information
     * @param {mixed} $pageInfo : This is array of page information
     * @param {mixed} $footerInfo : This is array of footer information
     * @return {null} $result : null
     */
    function loadViews($viewName = "", $pageInfo = NULL){
        $this->load->view('frontend/Header', $pageInfo);    
        $this->load->view($viewName, $pageInfo);
        $this->load->view('frontend/Footer', $pageInfo);
    } 


    function getAllServices($flGroupByCategory = true){
        $arrServices = $this->service_model->serviceListing("AC", true);

        $arrFinal = array();
        foreach ($arrServices as $record) {
            if($flGroupByCategory){
                $arrFinal[$record->category_name][] = $record;
            }
            else{
                $arrFinal[$record->id] = (array)$record;
            }
        }
        return $arrFinal;
    }

    function getOrderHistory($customerId){
        $arrAllServices     = $this->getAllServices(false);
        $arrOrderInfo = $this->cart_model->getAllOrderInfo($customerId);

        

        $arrFinalOrderInfo = array();
        foreach ($arrOrderInfo as $key => $value) {
            $cartValue = (array)$value;
            $arrFinalOrderInfo[$value->cartId] = $cartValue; 
            $arrFinalOrderInfo[$value->cartId]["serviceName"] = $arrAllServices[$cartValue['service_id']]['title'];
            $arrFinalOrderInfo[$value->cartId]["serviceCatName"] = $arrAllServices[$cartValue['service_id']]['category_name'];
        }

        return $arrFinalOrderInfo;
    }

    function checkServiceCartCookieIsEmpty(){
        if(isset($_COOKIE['serviceCartCookie'])){
            $arrCookie = json_decode($_COOKIE['serviceCartCookie'], 1);
            if(isset($arrCookie['serviceids'])){
                $flEmpty = true;
                foreach ($arrCookie['serviceids'] as $value) {
                    if(!empty($value) && !is_null($value)){
                        $flEmpty = false;
                    }
                }
                if($flEmpty){
                    $_COOKIE['serviceCartCookie'] = '{"serviceids":[]}';
                }
            }
            
        }
    }

    function jsCheckMapCookieNotSet(){
        $user_lat           = (isset($_COOKIE['user_lat']) ? json_decode($_COOKIE['user_lat'], 1) : "");
        $user_lng           = (isset($_COOKIE['user_lng']) ? json_decode($_COOKIE['user_lng'], 1) : "");

        if(empty($user_lat) || empty($user_lng)){
            redirect('map');
        }
    }

    function jsCheckServiceCookieNotSet(){
        $this->jsCheckMapCookieNotSet();

        $serviceCartCookie  = (isset($_COOKIE['serviceCartCookie']) ? json_decode($_COOKIE['serviceCartCookie'], 1) : array());

        if(isset($arrCookie['serviceids'])){
            $flEmpty = true;
            foreach ($arrCookie['serviceids'] as $value) {
                if(!empty($value) && !is_null($value)){
                    $flEmpty = false;
                }
            }
            if($flEmpty){
                redirect('service');
            }
        }
    }  

    function jsCheckCartDetailsCookieNotSet(){
        $this->jsCheckServiceCookieNotSet();

        $cartDetailsInfo    = (isset($_COOKIE['cartDetailsInfo']) ? json_decode($_COOKIE['cartDetailsInfo'], 1) : array());

        if(!isset($cartDetailsInfo['dateselect']) || !isset($cartDetailsInfo['dateselect']['date']) || empty($cartDetailsInfo['dateselect']['date']) || !isset($cartDetailsInfo['dateselect']['time']) || empty($cartDetailsInfo['dateselect']['time'])){
            redirect('date-select');
        }
    }
}
?>