<?php
class Shopping_cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Shopping_cart_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }

    public function index()
    {
        $runFunction = checkLogin();
        $data['title'] = 'Shopping Cart';
        $data['cart_details'] = $this->Shopping_cart_model->getCartDetails();

        $query = $this->db->select('sc.id, c.id as customer_id, p.id as product_id, v.id as variation_id, sc.disc_price, sc.status, sc.date_added')
            ->from('shopping_cart sc')
            ->join('customers c', 'sc.customer_id = c.id', 'left')
            ->join('products p', 'sc.product_id = p.id', 'left')
            ->join('product_variations v', 'sc.variation_id = v.id', 'left')
            ->where('sc.status', 'active')
            ->get();

        $data['query_result'] = $query->result();

        $this->load->view('frontend/view-shopping_cart', $data);
    }

    public function deleteCartItem($id)
    {
        $result = $this->Shopping_cart_model->deleteItem($id);
        if ($result) {
            $this->session->set_flashdata('deleted', 'Item has been deleted successfully');
        }
        redirect('shopping_cart');
    }
}
