<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Serviceboycontroller extends CI_Controller{
    /**
     * This is default constructor of the class
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('service_model'); 
        $this->load->model('cart_model');

        $this->load->model('serviceboy_model');
        $this->load->model('booking_model');
        $this->load->model('team_model');

        /*$this->load->model('Contactus_model');
        $this->load->model('Classes_model');*/

        $this->serviceBoyLogin = false;
        
        $isLoggedIn = $this->session->userdata ( 'isServiceBoyLoggedIn' );
        $this->serviceBoyFullName    = "";
        $this->serviceBoyUsername    = "";
        $this->serviceBoyUserId      = "";
        
        if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
            $this->serviceBoyLogin = false;
        } 
        else {
            $this->serviceBoyLogin = true;
            $this->serviceBoyUsername = $this->session->userdata ( 'serviceboy_username' );
            $this->serviceBoyUserId = $this->session->userdata ( 'serviceboy_user_id' );
            $this->serviceBoyFullName = trim($this->session->userdata ( 'first_name' ) . " " . $this->session->userdata ( 'last_name' ));
        }
    }

    /**
     * Index Page for this controller.
     */
    public function index(){

        if($this->serviceBoyLogin){
            $data['title'] = PROJECT_NAME;
            $data['pageTitle'] = PROJECT_NAME . ' - Service Boy Home';  
            $data['description'] = PROJECT_NAME . ' - Service Boy Home';  
            $data['currentpage'] = 'sb-homepage';
            $data['serviceBoyName'] = $this->serviceBoyFullName;
            $data['serviceBoyCode'] = $this->serviceBoyUsername;
            $data['servicesInfo'] = $this->getFullServiceDetails($this->serviceBoyUserId);

            $this->loadViews('serviceboy/home', $data);
        }
        else{
            redirect('serviceboy/login', 'refresh');
        }
    }

    public function login(){
        if($this->serviceBoyLogin){
            redirect('serviceboy', 'refresh');
        }
        else{
            $data = array();
            $data['title'] = PROJECT_NAME;
            $data['pageTitle'] = PROJECT_NAME . ' - Service Boy Login';  
            $data['description'] = PROJECT_NAME . ' - Service Boy Login';  
            $data['currentpage'] = 'sb-loginpage';

            $this->load->view('serviceboy/login', $data);
        }
    }


    public function loginUser(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('txtUsername', 'Your ID', 'required|max_length[50]');
        
        if($this->form_validation->run() == FALSE){
            redirect('serviceboy/login');
        }
        else {
            $txtUsername = $this->security->xss_clean($this->input->post('txtUsername'));
            $result = $this->serviceboy_model->loginServiceboy($txtUsername);

            if(!empty($result)) { 
                $sessionArray = array(                  
                                    'serviceboy_user_id'=>$result->id,
                                    'serviceboy_username'=>$result->team_id,
                                    'first_name'=>$result->first_name,
                                    'last_name'=>$result->last_name,
                                    'isServiceBoyLoggedIn' => TRUE
                                );

                $this->session->set_userdata($sessionArray);
                redirect('serviceboy', 'refresh');
            }
            else {
                $this->session->set_flashdata('error', 'Invalid ID');
                redirect('serviceboy/login');
            }
        }
    }

    public function logout(){
        //$this->session->sess_destroy ();
        $sessionArray = array(                  
                            'serviceboy_user_id'=> '',
                            'serviceboy_username'=> '',
                            'first_name'=> '',
                            'last_name'=> '',
                            'isServiceBoyLoggedIn' => false
                        );

        $this->session->set_userdata($sessionArray);
        redirect ( 'serviceboy/login' );
    }

    public function confirmOrder(){
        if(!$this->serviceBoyLogin){
            echo(json_encode(array('status'=>'access')));
        }
        else{
            $orderId = $this->input->post('orderId');

            $serviceInfo = array('cartmaster_id' => $orderId, 'team_id' => $this->serviceBoyUserId, 'action' => 'accept', 'note' => '', 'add_date' => date('Y-m-d H:i:s'));
            $result = $this->serviceboy_model->addNewServiceBoyOrderAction($serviceInfo);
            if ($result > 0) { 
                $this->cart_model->updateCartMaster(array('status' => 'SBC'), $orderId);
                //Function call for add into admin notification
                $this->cart_model->addIntoNotification($orderId, "admin");
                echo(json_encode(array('status'=>TRUE))); 
            }
            else { 
                echo(json_encode(array('status'=>FALSE))); 
            }
        }
    }

    public function completeOrder(){
        if(!$this->serviceBoyLogin){
            echo(json_encode(array('status'=>'access')));
        }
        else{
            $orderId = $this->input->post('orderId');
            $paymentType = $this->input->post('paymentType');
            $cardNumber = $this->input->post('cardNumber');
            $cardType = $this->input->post('cardType');

            if($paymentType != 'card'){
                $cardNumber = '';
                $cardType = 'Cash';
            }

            $serviceInfo = array('cartmaster_id' => $orderId, 'team_id' => $this->serviceBoyUserId, 'action' => 'complete', 'payment_type' => $paymentType, 'card_number' => $cardNumber, 'note' => '', 'add_date' => date('Y-m-d H:i:s'));
            $result = $this->serviceboy_model->addNewServiceBoyOrderAction($serviceInfo);
            if ($result > 0) { 
                $this->cart_model->updateCartMaster(array('status' => 'CM', 'card_type' => $cardType, 'payment_type' => $paymentType, 'card_number' => $cardNumber), $orderId);
                // Function call for the mail sending.
                $this->fnSendBookingMail($orderId);

                //Function call for add into admin notification
                $this->cart_model->addIntoNotification($orderId, "admin");
                echo(json_encode(array('status'=>TRUE))); 
            }
            else { 
                echo(json_encode(array('status'=>FALSE))); 
            }
        }
    }

    function fnSendBookingMail($bookingId)
    {   
        $data = array();
        $data['bookingInfo'] = $this->booking_model->getBookingInfo($bookingId);
        $data['bookingTeamProductInfo'] = $this->booking_model->getBookingServicerProductInfo($bookingId);
        $data['serviceInfo'] = $this->getAllServices(false);
        $data['teamInfo'] = $this->getTeamInfo();

        $userMessageBody = $this->load->view('email/ordercomplete', $data,true);

        $this->load->library('email');
        $this->email->from('info@emansalon.com', PROJECT_NAME);
        $this->email->to('testerdev111@gmail.com');
        $this->email->to($data['bookingInfo']['info']['email'], $data['bookingInfo']['info']['first_name']);
        $this->email->subject(PROJECT_NAME . ' : ' . $data['bookingInfo']['info']['invoice_number'] . 'Booking Completed');
        $this->email->set_mailtype("html");
        $this->email->message($userMessageBody);
        $rs = $this->email->send();

        return $rs;
    }

    public function rejectOrder(){
        if(!$this->serviceBoyLogin){
            echo(json_encode(array('status'=>'access')));
        }
        else{
            $orderId = $this->input->post('orderId');
            $rejectReason = $this->input->post('rejectReason');
            $serviceInfo = array('cartmaster_id' => $orderId, 'team_id' => $this->serviceBoyUserId, 'action' => 'reject', 'note' => $rejectReason, 'add_date' => date('Y-m-d H:i:s'));
            $result = $this->serviceboy_model->addNewServiceBoyOrderAction($serviceInfo);
            if ($result > 0) { 
                $this->cart_model->updateCartMaster(array('status' => 'SBR'), $orderId);
                //Function call for add into admin notification
                $this->cart_model->addIntoNotification($orderId, "admin");
                echo(json_encode(array('status'=>TRUE))); 
            }
            else { 
                echo(json_encode(array('status'=>FALSE))); 
            }
        }
    }

    public function orderDetails($orderId = ''){
        if($this->serviceBoyLogin || $orderId != ''){
            $data['title'] = PROJECT_NAME;
            $data['pageTitle'] = PROJECT_NAME . ' - Order Details';  
            $data['description'] = PROJECT_NAME . ' - Order Details';  
            $data['currentpage'] = 'sb-ordermappage';
            $data['orderId'] = $orderId;
            $data['servicesInfo'] = $this->getFullServiceDetails($this->serviceBoyUserId, $orderId);

            $this->loadViews('serviceboy/detail', $data);
        }
        else{
            redirect('serviceboy/login', 'refresh');
        }
    }

    public function thankyou(){
        if($this->serviceBoyLogin){
            $data['title'] = PROJECT_NAME;
            $data['pageTitle'] = PROJECT_NAME . ' - Thank You';  
            $data['description'] = PROJECT_NAME . ' - Thank You';  
            $data['currentpage'] = 'sb-thankyoupage';
            $this->loadViews('serviceboy/thankyou', $data);
        }
        else{
            redirect('serviceboy/login', 'refresh');
        }
    }

    function getFullServiceDetails($serviceBoyId, $orderId = ''){
        $result = $this->serviceboy_model->getServiceBoyCartDetails($serviceBoyId, $orderId);
        $arrReturn = array();
        foreach ($result as $key => $value) {
            $objBooking = $this->booking_model->getBookingInfo($value->cartMasterId);
            if($objBooking['info']['status'] == 'PN' || $objBooking['info']['status'] == 'CN' || $objBooking['info']['status'] == 'SBC'){
                $arrReturn[$value->cartMasterId] = $objBooking;
            }
        }

        /*echo "<pre>";
        print_r($arrReturn);
        die();*/
        return $arrReturn;
    }

    function getAllServices($flGroupByCategory = true, $type = '')
    {
        $arrServices = $this->service_model->serviceListing("AC", true, $type);

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

    function getTeamInfo()
    {
        $arrTeam = $this->team_model->teamListing();
        $arrReturn = array();
        foreach ($arrTeam as $key => $value) {
            $arrReturn[] = array("id" => $value->id, 
                                "name" => $value->first_name . " " . $value->last_name);
        }
        return $arrReturn;
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
        $this->load->view('serviceboy/Header', $pageInfo);    
        $this->load->view($viewName, $pageInfo);
        $this->load->view('serviceboy/Footer', $pageInfo);
    }
}
?>