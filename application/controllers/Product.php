<?php
class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('form_validation', 'upload', 'config');
        $this->load->helper('auth_helper');
    }

    public function index()
    {
        $runFunction = checkLogin();
        $data['title'] = 'Product';
        $data['product_details'] = $this->Product_model->getProducts();

        $this->load->view('frontend/view-products', $data);
    }

    public function addProduct()
    {
        $runFunction = checkLogin();
        $data['title'] = 'Add Product';

        // Load necessary models and database queries properly
        $data['brands'] = $this->db->query("SELECT * FROM brands WHERE status = 'active'")->result_array();
        $data['models'] = $this->db->query("SELECT * FROM models WHERE status = 'active'")->result_array();
        $data['variationCatg'] = $this->db->query("SELECT * FROM variation_cat WHERE status = 'active'")->result_array();

        $this->load->view('frontend/add-edit-product', $data);
    }

    public function createProduct()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('brand_id', 'Brand ID', 'trim|required');
        $this->form_validation->set_rules('model_id', 'Model ID', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('key_specification', 'Key Specification', 'trim|required');
        $this->form_validation->set_rules('refund_policy', 'Refund Policy', 'trim|required');

        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
            redirect('Product/addProduct');
        } else {
            $config['upload_path'] = './assets/products/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 204800;
            $config['file_name'] = time() . '_' . $_FILES['image']['name'];

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $error_message = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error_message);
                redirect('Product/addProduct');
            } else {
                $uploadData = $this->upload->data();
                $imagePath = 'assets/products/' . $uploadData['file_name'];

                $currentDateTime = date("Y-m-d H:i:s");

                $data = [
                    'brand_id' => $this->input->post('brand_id'),
                    'model_id' => $this->input->post('model_id'),
                    'name' => $this->input->post('name'),
                    'image' => $imagePath,
                    'price' => $this->input->post('price'),
                    'description' => $this->input->post('description'),
                    'key_specification' => $this->input->post('key_specification'),
                    'refund_policy' => $this->input->post('refund_policy'),
                    'status' => 'active',
                    'date_added' => $currentDateTime
                ];

                $result = $this->Product_model->insert_product($data);

                $product_id = $this->db->insert_id();

                $variations = $this->input->post('variations');

                if (!empty($variations)) {
                    foreach ($variations as $variation) {
                        $dataVariation = explode("_", $variation);

                        $params['vcat_id'] = $dataVariation[0];
                        $params['variation_id'] = $dataVariation[1];
                        $params['product_id'] = $product_id;
                        $params['status'] = 'active';
                        $params['date_added'] = $currentDateTime;

                        $this->Product_model->insert_pv($params);
                    }
                }

                if ($result) {
                    $this->session->set_flashdata('inserted', 'Product has been created successfully');
                }
                redirect('product'); // Correct redirect URL
            }
        }
    }

    public function editProduct($id)
    {
        $data['title'] = 'Edit Product';
        $singleProduct = $this->Product_model->getSingleProduct($id);

        if ($singleProduct) {
            $variationCatg = $this->db->query("SELECT * FROM variation_cat WHERE status = 'active'")->result_array();
            $singleProduct->variationCatg = $variationCatg;
        }

        $data['singleproduct'] = $singleProduct;
        $data['brands'] = $this->db->query("SELECT * FROM brands WHERE status = 'active'")->result_array();
        $data['models'] = $this->db->query("SELECT * FROM models WHERE status = 'active'")->result_array();
        $data['variationCatg'] = $variationCatg; // Ensure variation categories are loaded properly

        $this->load->view('frontend/add-edit-product', $data);
    }

    public function updateProduct($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('brand_id', 'Brand ID', 'trim|required');
        $this->form_validation->set_rules('model_id', 'Model ID', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('key_specification', 'Key Specification', 'trim|required');
        $this->form_validation->set_rules('refund_policy', 'Refund Policy', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
            redirect('Product/editProduct/' . $id);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            $data = [
                'brand_id' => $this->input->post('brand_id'),
                'model_id' => $this->input->post('model_id'),
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'image' => $this->input->post('image'),
                'description' => $this->input->post('description'),
                'key_specification' => $this->input->post('key_specification'),
                'refund_policy' => $this->input->post('refund_policy'),
                'status' => $this->input->post('status'),
                'date_added' => $currentDateTime
            ];

            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = 'assets/products/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 204800;
                $config['file_name'] = time() . '_' . $_FILES['image']['name'];

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    $error_message = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error_message);
                    redirect('Product/editProduct/' . $id);
                } else {
                    $uploadData = $this->upload->data();
                    $data['image'] = 'assets/products/' . $uploadData['file_name'];
                }
            }

            $result = $this->Product_model->update_product($id, $data);

            if ($result) {
                $this->session->set_flashdata('updated', 'Product has been updated successfully');
            }
            redirect('product');
        }
    }


    public function deleteProduct($id)
    {
        $result = $this->Product_model->delete_product($id);
        if ($result) {
            $this->session->set_flashdata('deleted', 'Product has been deleted successfully');
        }
        redirect('view-products');
    }

    public function select_id()
    {
        $brand_id = $this->input->post('brand_id');
        if (!empty($brand_id)) {
            $models = $this->Product_model->getModelsByBrand($brand_id);
            echo json_encode($models);
        } else {
            echo json_encode([]);
        }
    }
}
