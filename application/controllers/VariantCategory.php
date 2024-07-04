<?php
class VariantCategory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('VariantCategory_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }

    public function index()
    {
        $runFunction = checkLogin();
        $data['title'] = 'Variation Category';
        $data['VariationCat_details'] = $this->VariantCategory_model->getVariationCat();
        $this->load->view('frontend/view-variation-category', $data);
        $this->load->library('form_validation');
    }
    public function addVariationCat()
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('sorting', ' Sorting', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {

            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->VariantCategory_model->insert_VariationCat([

                'name' => $this->input->post('name'),
                'sorting' => $this->input->post('sorting'),
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $this->session->set_flashdata('inserted', 'Variation category has been created successfully');
            }
        }
        redirect('view-variation-category');
    }
    public function editVariationCat($id)
    {
        $data['singleVariationCat'] = $this->VariantCategory_model->getSingleVariationCat($id);
        $this->load->view('frontend/view-variation-category', $data);
    }
    public function updateVariationCat($id)
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('sorting', 'Sorting', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");
            $status = $this->input->post('status');

            $result = $this->VariantCategory_model->update_VariationCat([

                'name' => $this->input->post('name'),
                'sorting' =>  $this->input->post('sorting'),
                'status' => $status,
                'date_added' => $currentDateTime

            ], $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'Variation category has been updated successfully');
            }
        }
        redirect('view-variation-category');
    }

    public function deleteVariationCat($id)
    {

        $result = $this->VariantCategory_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'Variation category has been deleted successfully');
        }
        redirect('view-variation-category');
    }
}
