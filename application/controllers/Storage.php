<?php
class Storage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Storage_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['storage_details'] = $this->Storage_model->getStorage();
        $this->load->view('frontend/view-storages', $data);
        $this->load->library('form_validation');
    }
    public function addStorage()
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('sorting', ' Sorting', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data_error = [
                'error' => validation_errors()
            ];

            $this->session->set_flashdata($data_error);
        } else {

            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Storage_model->insert_storage([

                'name' => $this->input->post('name'),
                'sorting' => $this->input->post('sorting'),
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $this->session->set_flashdata('inserted', 'your data has been inserted successfully');
            }
        }
        redirect('storage');
    }
    public function editStorage($id)
    {
        $data['singlestorage'] = $this->Storage_model->getSingleStorage($id);
        $this->load->view('storage', $data);
    }
    public function updateStorage($id)
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('sorting', 'Sorting', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data_error = [
                'error' => validation_errors()
            ];
            $this->session->set_flashdata($data_error);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Storage_model->update_Storage([

                'name' => $this->input->post('name'),
                'sorting' =>  $this->input->post('sorting'),
                'date_added' => $currentDateTime

            ], $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'your data has been updated successfully');
            }
        }
        redirect('storage');
    }

    public function deleteStorage($id)
    {

        $result = $this->Storage_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'your data has been deleted successfully');
        }
        redirect('storage');
    }
}
