<?php
class Model extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['Model_details'] = $this->Model_model->getALLModels();
        $this->load->view('frontend/view-models', $data);
        $this->load->library('form_validation');
    }
    public function addModel()
    {

        $this->form_validation->set_rules('brand_id', 'Brand id', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('features', 'Features', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data_error = [
                'error' => validation_errors()
            ];
            $this->session->set_flashdata($data_error);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Model_model->insert_Model([

                'brand_id' =>  $this->input->post('brand_id'),
                'name' => $this->input->post('name'),
                'features' =>  $this->input->post('features'),
                'description' =>  $this->input->post('description'),
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $this->session->set_flashdata('inserted', 'your data has been inserted successfully');
            }
        }
        redirect('model');
    }
    public function editModel($id)
    {
        $data['singleModel'] = $this->Brand_Model->getSingleModel($id);
        $this->load->view('model', $data);
    }
    public function updateModel($id)
    {

        $this->form_validation->set_rules('brand_id', 'Brand id', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('features', 'Features', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data_error = [
                'error' => validation_errors()
            ];
            $this->session->set_flashdata($data_error);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Model_model->update_Model([

                'brand_id' =>  $this->input->post('brand_id'),
                'name' => $this->input->post('name'),
                'features' =>  $this->input->post('features'),
                'description' =>  $this->input->post('description'),
                'date_added' => $currentDateTime

            ], $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'your data has been updated successfully');
            }
        }
        redirect('model');
    }
    public function deleteModel($id)
    {

        $result = $this->Model_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'your data has been deleted successfully');
        }
        redirect('model');
    }
}
