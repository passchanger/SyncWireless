<?php
class RepairingIssue extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RepairingIssue_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }
    public function index()
    {
        $runFunction = checkLogin();
        $data['title'] = 'Repairing Issue';
        $data['repairing_details'] = $this->RepairingIssue_model->getRepair();
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

            $result = $this->RepairingIssue_model->insert_issue([

                'issue_name' => $this->input->post('issue_name'),
                'issue_price' => $this->input->post('issue_price'),
                'sorting' => $this->input->post('sorting'),
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $this->session->set_flashdata('inserted', 'Reparing Issue has been created successfully');
            }
        }
        redirect('view-repairing-issues');
    }
    public function editRepairing($id)
    {
        $data['singlerepair'] = $this->RepairingIssue_model->getSingleRepair($id);
        $this->load->view('frontend/view-repairing-issues', $data);
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

            $result = $this->RepairingIssue_model->update_issue($data, $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'Reparing Issue has been updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to update data');
            }
        }

        redirect('view-repairing-issues');
    }


    public function deleteRepairing($id)
    {
        $result = $this->RepairingIssue_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'Reparing Issue has been deleted successfully');
        }
        redirect('view-repairing-issues');
    }
}
