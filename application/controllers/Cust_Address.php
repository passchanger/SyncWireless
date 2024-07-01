<?php
class Cust_Address extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cust_address_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Customer Adresses';
        $data['custadd_details'] = $this->Cust_address_model->getCustomerAdd();
        $data['customers'] = $this->db->query("select * from customers where status = 'active'")->result_array();
        $this->load->view('frontend/view-cust-address', $data);
    }


    public function editCustomersAdd($id)
    {
        $data['singlecustomeradd'] = $this->Customers_model->getSingleCustomerAdd($id);
        $data['cutsomer_details'] = $this->Customers_model->getCustomer();
        $this->load->view('frontend/view-customers', $data);
    }

    public function updateCustomersAdd($id)
    {
        $this->form_validation->set_rules('customer_id', 'Customer_id', 'trim|required');
        $this->form_validation->set_rules('addline_1', 'Address', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");
            $status = $this->input->post('status');

            $result = $this->Cust_address_model->update_customersadd([
                'customer_id' => $this->input->post('customer_id'),
                'addline_1' => $this->input->post('addline_1'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'pincode' => $this->input->post('pincode'),
                'country' => $this->input->post('country'),
                'date_added' => $currentDateTime,
                'status' => $status,
                'is_primary' => $this->input->post('is_primary') == 'on' ? 1 : 0
            ], $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'Your data has been updated successfully');
            }
        }
        redirect('view-cust-address');
    }
    public function deleteCustomersAdd($id)
    {
        $result = $this->Cust_address_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'Your data has been deleted successfully');
        }
        redirect('view-cust-address');
    }
}
