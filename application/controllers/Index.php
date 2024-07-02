<?php
class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ram_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }

    public function index()
    {
        $runFunction = checkLogin();
        $data['title'] = "Dashboard";
        $this->load->view('frontend/index', $data);
    }
}
