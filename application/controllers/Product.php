<?php
class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }

    public function index()
    {
        $runFunction = checkLogin();
        $data['title'] = 'Product';
        $data['product_details'] = $this->Product_model->getProducts();
        $data['brands'] = $this->db->query("select * from brands where status = 'active'")->result_array();
        $data['models'] = $this->db->query("select * from models where status = 'active'")->result_array();
        $this->load->view('frontend/view-products', $data);
    }

    public function addProduct()
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('brand_id', 'Brand ID', 'trim|required');
        $this->form_validation->set_rules('model_id', 'Model ID', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('key_specification', 'Key Specification', 'trim|required');
        $this->form_validation->set_rules('refund_policy', 'Refund Policy', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        // Add more validation rules as needed

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $data = [
                'brand_id' => $this->input->post('brand_id'),
                'model_id' => $this->input->post('model_id'),
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'key_specification' => $this->input->post('key_specification'),
                'refund_policy' => $this->input->post('refund_policy'),
                'status' => $this->input->post('status'),
                'date_added' => $currentDateTime
            ];

            $result = $this->Product_model->insert_product($data);

            if ($result) {
                $this->session->set_flashdata('inserted', 'Your data has been inserted successfully');
            }
        }
        redirect('product');
    }

    public function editProduct($id)
    {
        $data['singleproduct'] = $this->Product_model->getSingleProduct($id);
        $this->load->view('frontend/view-edit-product', $data);
    }

    public function updateProduct($id)
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('brand_id', 'Brand ID', 'trim|required');
        $this->form_validation->set_rules('model_id', 'Model ID', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('key_specification', 'Key Specification', 'trim|required');
        $this->form_validation->set_rules('refund_policy', 'Refund Policy', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $data = [
                'brand_id' => $this->input->post('brand_id'),
                'model_id' => $this->input->post('model_id'),
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'key_specification' => $this->input->post('key_specification'),
                'refund_policy' => $this->input->post('refund_policy'),
                'status' => $this->input->post('status'),
                'date_added' => $currentDateTime
            ];

            $result = $this->Product_model->update_product($data, $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'Your data has been updated successfully');
            }
        }
        redirect('product');
    }

    public function deleteProduct($id)
    {
        $result = $this->Product_model->delete_product($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'Your data has been deleted successfully');
        }
        redirect('product');
    }
}
