<?php
class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ram_model');
        $this->load->library('form_validation');
    }

    public function index()
    {   
        $data['title'] = "Dashboard";
        $this->load->view('frontend/index', $data);
    }
}
