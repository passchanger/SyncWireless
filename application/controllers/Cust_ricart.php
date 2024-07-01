<?php
class Cust_ricart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cust_ricart_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Customer RI Cart';
        $data['cust_details'] = $this->Cust_ricart_model->getCustomerDetails();

        $query = $this->db->select('cr.id, c.name as customer_name, b.name as brand_name, m.name as model_name, ri.issue_name as ri_name, cr.est_price, cr.status, cr.date_added')
            ->from('cust_ricart cr')
            ->join('customers c', 'cr.id = c.id', 'left')
            ->join('brands b', 'cr.id = b.id', 'left')
            ->join('models m', 'cr.id = m.id', 'left')
            ->join('repairing_issues ri', 'cr.id = ri.id', 'left')
            ->where('cr.status', 'active')
            ->get();

        $data['query_result'] = $query->result();
        $this->load->view('frontend/view-cust_ricart', $data);
    }

    public function deleteCustomersCart($id)
    {
        $result = $this->Cust_ricart_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'Your data has been deleted successfully');
        }
        redirect('view-customer');
    }
}
