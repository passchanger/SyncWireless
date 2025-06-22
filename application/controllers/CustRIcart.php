<?php
class CustRIcart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CustRIcart_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }

    public function index()
    {
        $runFunction = checkLogin();
        $data['title'] = 'Customer RI Cart';
        $data['cust_details'] = $this->CustRIcart_model->getCustomerDetails();

        $query = $this->db->select('cr.id, c.name as customer_name, b.name as brand_name, m.name as model_name, ri.issue_name as ri_name, cr.est_price, cr.status, cr.date_added')
            ->from('cust_ricart cr')
            ->join('customers c', 'cr.id = c.id', 'left')
            ->join('brands b', 'cr.brand_id = b.id', 'left')
            ->join('models m', 'cr.model_id = m.id', 'left')
            ->join('repairing_issues ri', 'cr.id = ri.id', 'left')
            ->where('cr.status', 'active')
            ->get();

        $data['query_result'] = $query->result();
        $this->load->view('frontend/view-cust-ricart', $data);
    }

    public function deleteCustomersCart($id)
    {
        $result = $this->CustRIcart_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'Customer Repairing Issue has been deleted successfully');
        }
        redirect('view-cust-ricart');
    }
}
