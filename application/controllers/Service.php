<?php
class Service extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['service_details'] = $this->Service_model->getALLService();
        $this->load->view('frontend/view-service-centers', $data);
        $this->load->library('form_validation');
    }
    public function addService()
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required');
        $this->form_validation->set_rules('cp_name', 'CP-Name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[10]|max_length[10]|is_unique[service_centres.mobile]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[service_centres.email]');
        $this->form_validation->set_rules('latitude', 'Lattitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {

            $currentDateTime = date("Y-m-d H:i:s");

            $result = $this->Service_model->insert_Service([

                'name' => $this->input->post('name'),
                'address' =>  $this->input->post('address'),
                'city' =>  $this->input->post('city'),
                'state' =>  $this->input->post('state'),
                'pincode' =>  $this->input->post('pincode'),
                'cp_name' =>  $this->input->post('cp_name'),
                'mobile' =>  $this->input->post('mobile'),
                'email' =>  $this->input->post('email'),
                'latitude' =>  $this->input->post('latitude'),
                'longitude' =>  $this->input->post('longitude'),
                'date_added' => $currentDateTime
            ]);
            if ($result) {
                $this->session->set_flashdata('inserted', 'your data has been inserted successfully');
            }
        }
        redirect('service');
    }
    public function editService($id)
    {
        $data['singleService'] = $this->Service_Model->getSingleService($id);
        $this->load->view('service', $data);
    }
    public function updateService($id)
    {

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required');
        $this->form_validation->set_rules('cp_name', 'CP-Name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[10]|max_length[10]|is_unique[service_centres.mobile]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[service_centres.email]');
        $this->form_validation->set_rules('latitude', 'Lattitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {

            $currentDateTime = date("Y-m-d H:i:s");
            $status = $this->input->post('status');

            $result = $this->Service_model->update_Service([

                'name' => $this->input->post('name'),
                'address' =>  $this->input->post('address'),
                'city' =>  $this->input->post('city'),
                'state' =>  $this->input->post('state'),
                'pincode' =>  $this->input->post('pincode'),
                'cp_name' =>  $this->input->post('cp_name'),
                'mobile' =>  $this->input->post('mobile'),
                'email' =>  $this->input->post('email'),
                'latitude' =>  $this->input->post('latitude'),
                'longitude' =>  $this->input->post('longitude'),
                'status' => $status,
                'date_added' => $currentDateTime
            ], $id);

            if ($result) {
                $this->session->set_flashdata('inserted', 'your data has been inserted successfully');
            }
        }
        redirect('service');
    }
    public function deleteService($id)
    {
        $result = $this->Service_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'your data has been deleted successfully');
        }
        redirect('service');
    }
}
