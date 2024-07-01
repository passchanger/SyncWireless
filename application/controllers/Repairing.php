<?php
class Repairing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Repairing_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Repairing';
        $data['repairing_details'] = $this->Repairing_model->getRepair();
        $data['brands'] = $this->db->query("select * from brands where status = 'active'")->result_array();
        $this->load->view('frontend/view-repairing-issues', $data);
        $this->load->library('form_validation');
    }

    public function addRepairing()
    {

        $this->form_validation->set_rules('issue_name', 'Issue Name', 'trim|required');
        $this->form_validation->set_rules('issue_price', 'Issue Price', 'trim|required');
        $this->form_validation->set_rules('sorting', ' Sorting', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {

            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Repairing_model->insert_issue([

                'issue_name' => $this->input->post('issue_name'),
                'issue_price' => $this->input->post('issue_price'),
                'sorting' => $this->input->post('sorting'),
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $this->session->set_flashdata('inserted', 'your data has been inserted successfully');
            }
        }
        redirect('repairing');
    }
    public function editRepairing($id)
    {
        $data['singlerepair'] = $this->Repairing_model->getSingleRepair($id);
        $this->load->view('repairing', $data);
    }
    public function updateRepairing($id)
    {
        $this->form_validation->set_rules('issue_name', 'Issue Name', 'trim|required');
        $this->form_validation->set_rules('issue_price', 'Issue Price', 'trim|required');
        $this->form_validation->set_rules('sorting', 'Sorting', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");
            $status = $this->input->post('status');

            $data = [
                'issue_name' => $this->input->post('issue_name'),
                'issue_price' => $this->input->post('issue_price'),
                'sorting' => $this->input->post('sorting'),
                'status' => $status,
                'date_added' => $currentDateTime
            ];

            $result = $this->Repairing_model->update_issue($data, $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'Your data has been updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to update data');
            }
        }

        redirect('repairing');
    }


    public function deleteRepairing($id)
    {
        $result = $this->Repairing_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'your data has been deleted successfully');
        }
        redirect('repairing');
    }
}
