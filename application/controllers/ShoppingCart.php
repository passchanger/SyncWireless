<?php
class ShoppingCart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ShoppingCart_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }

    public function index()
    {
        $runFunction = checkLogin();
        $data['title'] = 'Shopping Cart';
        $data['cart_details'] = $this->ShoppingCart_model->getCartDetails();

        $this->load->view('frontend/view-shopping-cart', $data);
    }

    public function deleteCartItem($id)
    {
        $result = $this->ShoppingCart_model->deleteItem($id);
        if ($result) {
            $this->session->set_flashdata('deleted', ' Cart item has been deleted successfully');
        }
        redirect('view-shopping-cart');
    }
}
