<?php
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['users_details'] = $this->Users_model->getUser();
        $this->load->view('frontend/view-users', $data);
    }

    public function addUsers()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[15]|is_unique[users.password]');

        if ($this->form_validation->run() == FALSE) {
            $data_error = [
                'error' => validation_errors()
            ];

            $this->session->set_flashdata($data_error);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Users_model->insert_users([
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $this->session->set_flashdata('inserted', 'Your data has been inserted successfully');
            }
        }
        redirect('view-users');
    }

    public function editUsers($id)
    {
        $data['singleuser'] = $this->Users_model->getSingleUser($id);
        $data['users_details'] = $this->Users_model->getUser();
        $this->load->view('users', $data);
    }

    public function updateUsers()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[15]|is_unique[users.password]');

        if ($this->form_validation->run() == FALSE) {
            $data_error = [
                'error' => validation_errors()
            ];

            $this->session->set_flashdata($data_error);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Users_model->update_users([
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $this->session->set_flashdata('updated', 'Your data has been updated successfully');
            }
        }
        redirect('view-users');
    }
    public function deleteUsers($id)
    {
        $result = $this->Users_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'Your data has been deleted successfully');
        }
        redirect('view-users');
    }
}
