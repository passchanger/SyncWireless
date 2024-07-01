<?php
class Customers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customers_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'customers';
        $data['customers_details'] = $this->Customers_model->getCustomer();
        $this->load->view('frontend/view-customers', $data);
    }


    public function editCustomers($id)
    {
        $data['singlecustomer'] = $this->Customers_model->getSingleCustomer($id);
        $data['cutsomer_details'] = $this->Customers_model->getCustomer();
        $this->load->view('frontend/view-customers', $data);
    }

    public function updateCustomers($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[15]|is_unique[users.password]');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");
            $status = $this->input->post('status');
            $encoded_password = base64_encode($this->input->post('password'));


            $result = $this->Customers_model->update_customers([
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'status' => $status,
                'password' => $encoded_password,
                'date_added' => $currentDateTime
            ], $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'Your data has been updated successfully');
            }
        }
        redirect('view-customer');
    }
    public function deleteCustomers($id)
    {
        $result = $this->Customers_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'Your data has been deleted successfully');
        }
        redirect('view-customer');
    }
}
