<?php
class Brand extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Brand_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Brands';
        $data['product_details'] = $this->Brand_model->getALLProducts();
        $this->load->view('frontend/view-brands', $data);
    }

    public function addBrand()
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('sorting', 'Sorting', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Brand_model->insert_Brand([

                'name' => $this->input->post('name'),
                'sorting' =>  $this->input->post('sorting'),
                'description' =>  $this->input->post('description'),
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $this->session->set_flashdata('inserted', 'your data has been inserted successfully');
            }
        }
        redirect('brand');
    }
    public function editBrand($id)
    {

        $data['singleBrand'] = $this->Brand_model->getSingleBrand($id);
        $data['product_details'] = $this->Brand_model->getALLProducts();
        $this->load->view('brand', $data);
    }
    public function updateBrand($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('sorting', 'Sorting', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");
            $status = $this->input->post('status');

            $result = $this->Brand_model->update_Brand([

                'name' => $this->input->post('name'),
                'sorting' =>  $this->input->post('sorting'),
                'description' =>  $this->input->post('description'),
                'status' => $status,
                'date_added' => $currentDateTime
            ], $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'your data has been updated successfully');
            }
        }
        redirect('brand');
    }
    public function deleteBrand($id)
    {
        $result = $this->Brand_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'your data has been deleted successfully');
        }
        redirect('brand');
    }
}
