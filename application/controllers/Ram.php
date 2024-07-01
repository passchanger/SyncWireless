<?php
class Ram extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ram_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Variation';
        $data['ram_details'] = $this->Ram_model->getRam();
        $this->load->view('frontend/view-variants', $data);
    }

    public function addram()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('feature', 'Feature', 'trim|required');
        $this->form_validation->set_rules('sorting', 'Sorting', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Ram_model->insert_ram([
                'name' => $this->input->post('name'),
                'sorting' => $this->input->post('sorting'),
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $alert_message = 'Your data has been inserted successfully';
            }
        }
        redirect('Ram');
    }

    public function editram($id)
    {
        $data['singleram'] = $this->Ram_model->getSingleRam($id);
        $data['ram_details'] = $this->Ram_model->getRam();
        $this->load->view('frontend/view-variants', $data);
    }

    public function updateram($id)
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

            $result = $this->Ram_model->update_ram([
                'name' => $this->input->post('name'),
                'sorting' => $this->input->post('sorting'),
                'status' => $status,
                'date_added' => $currentDateTime
            ], $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'Your data has been updated successfully');
            }
        }
        redirect('Ram');
    }

    public function deleteram($id)
    {
        $result = $this->Ram_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'Your data has been deleted successfully');
        }
        redirect('Ram');
    }
}
