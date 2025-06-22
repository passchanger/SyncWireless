<?php
class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_Model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }
    public function index()
    {
        $runFunction = checkLogin();
        $data['title'] = 'Repairing Orders';
        $this->load->view('frontend/view-orders', $data);
    }
}
