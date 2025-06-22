<?php
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        var_dump("hello");
        exit;

        $data['title'] = 'Dashboard';

        $this->load->view('include/header');
        $this->load->view('index');
        $this->load->view('include/footer');
    }
}
