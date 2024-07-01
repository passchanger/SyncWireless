<?php
class Product_variation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_variation_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Product Variation';
        $data['product_variations'] = $this->Product_variation_model->getProductVariations();
        $this->load->view('frontend/view-product_variation', $data);
    }

    public function addProductVariation()
    {
        $this->form_validation->set_rules('product_id', 'Product ID', 'trim|required');
        $this->form_validation->set_rules('vcat_id', 'Variation Category ID', 'trim|required');
        $this->form_validation->set_rules('variation_id', 'Variation ID', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Product_variation_model->insertProductVariation([
                'product_id' => $this->input->post('product_id'),
                'vcat_id' => $this->input->post('vcat_id'),
                'variation_id' => $this->input->post('variation_id'),
                'status' => $this->input->post('status'),
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $this->session->set_flashdata('inserted', 'Your data has been inserted successfully');
            }
        }
        redirect('product_variation');
    }

    public function editProductVariation($id)
    {
        $data['single_product_variation'] = $this->Product_variation_model->getSingleProductVariation($id);
        $this->load->view('frontend/view-product_variation', $data);
    }

    public function updateProductVariation($id)
    {
        $this->form_validation->set_rules('product_id', 'Product ID', 'trim|required');
        $this->form_validation->set_rules('vcat_id', 'Variation Category ID', 'trim|required');
        $this->form_validation->set_rules('variation_id', 'Variation ID', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Product_variation_model->updateProductVariation([
                'product_id' => $this->input->post('product_id'),
                'vcat_id' => $this->input->post('vcat_id'),
                'variation_id' => $this->input->post('variation_id'),
                'status' => $this->input->post('status'),
                'date_added' => $currentDateTime
            ], $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'Your data has been updated successfully');
            }
        }
        redirect('product_variation');
    }

    public function deleteProductVariation($id)
    {
        $result = $this->Product_variation_model->deleteProductVariation($id);
        if ($result) {
            $this->session->set_flashdata('deleted', 'Your data has been deleted successfully');
        }
        redirect('product_variation');
    }
}
