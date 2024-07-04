<?php
class Variant extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Variant_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }

    public function index()
    {
        $runFunction = checkLogin();
        $data['title'] = 'Variation';
        $data['variation_details'] = $this->Variant_model->getVariation();
        $data['categ'] = $this->db->query("select * from variation_cat where status = 'active'")->result_array();
        $this->load->view('frontend/view-variations', $data);
    }

    public function addVariation()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('cat_id', 'Category ID', 'trim|required');
        $this->form_validation->set_rules('resources', 'Resources', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Variant_model->insert_variation([
                'name' => $this->input->post('name'),
                'cat_id' => $this->input->post('cat_id'),
                'resources' => $this->input->post('resources'),
                'status' => 'active',
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $alert_message = 'Variant has been created successfully';
            }
        }
        redirect('view-variations');
    }

    public function editVariation($id)
    {
        $data['singleram'] = $this->Variant_model->getSingleVariation($id);
        $data['ram_details'] = $this->Variant_model->getVariation();
        $this->load->view('frontend/view-variations', $data);
    }

    public function updateVariation($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('cat_id', 'Category ID', 'trim|required');
        $this->form_validation->set_rules('resources', 'Resources', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");
            $status = $this->input->post('status');

            $result = $this->Variant_model->update_variation([
                'name' => $this->input->post('name'),
                'cat_id' => $this->input->post('cat_id'),
                'resources' => $this->input->post('resources'),
                'status' => $status,
                'date_added' => $currentDateTime
            ], $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'Variant has been updated successfully');
            }
        }
        redirect('view-variations');
    }

    public function deleteVariation($id)
    {
        $result = $this->Variant_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'Variant has been deleted successfully');
        }
        redirect('view-variations');
    }
}
