<?php
class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Setting_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }

    public function index()
    {
        $runFunction = checkLogin();
        $this->load->model('Setting_Model');
        $data['setting_details'] = $this->Setting_Model->getALLSettings();
        $this->load->view('frontend/view-settings', $data);
        $this->load->library('form_validation');
    }
    public function addSetting()
    {
        $this->form_validation->set_rules('sitename', 'Name', 'trim|required');
        $this->form_validation->set_rules('siteemail', 'Sorting', 'trim|required');
        $this->form_validation->set_rules('sitemobile', 'Description', 'trim|required');
        $this->form_validation->set_rules('pg_creds', 'Description', 'trim|required');
        $this->form_validation->set_rules('ga_creds', 'Description', 'trim|required');
        $this->form_validation->set_rules('tag_manager', 'Description', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {

            $result = $this->Setting_model->insert_Setting([

                'sitename' => $this->input->post('sitename'),
                'siteemail' =>  $this->input->post('siteemail'),
                'sitemobile' =>  $this->input->post('sitemobile'),
                'pg_creds' =>  $this->input->post('pg_creds'),
                'ga_creds' =>  $this->input->post('ga_creds'),
                'tag_manager' =>  $this->input->post('tag_manager'),
            ]);

            if ($result) {
                $this->session->set_flashdata('inserted', 'your data has been inserted successfully');
            }
        }
        redirect('setting');
    }
    public function editSetting($id)
    {
        $data['singleSetting'] = $this->Setting_Model->getSinglSetting($id);
        $this->load->view('setting', $data);
    }
    public function updateSetting($id)
    {
        $this->form_validation->set_rules('sitename', 'Name', 'trim|required');
        $this->form_validation->set_rules('siteemail', 'Sorting', 'trim|required');
        $this->form_validation->set_rules('sitemobile', 'Description', 'trim|required');
        $this->form_validation->set_rules('pg_creds', 'Description', 'trim|required');
        $this->form_validation->set_rules('ga_creds', 'Description', 'trim|required');
        $this->form_validation->set_rules('tag_manager', 'Description', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {

            $result = $this->Setting_model->update_Setting([

                'sitename' => $this->input->post('sitename'),
                'siteemail' =>  $this->input->post('siteemail'),
                'sitemobile' =>  $this->input->post('sitemobile'),
                'pg_creds' =>  $this->input->post('pg_creds'),
                'ga_creds' =>  $this->input->post('ga_creds'),
                'tag_manager' =>  $this->input->post('tag_manager'),

            ], $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'your data has been updated successfully');
            }
        }
        redirect('setting');
    }
    public function deleteSetting($id)
    {

        $result = $this->Setting_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'your data has been deleted successfully');
        }
        redirect('setting');
    }
}
