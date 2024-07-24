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
        // Set form validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('brand_id', 'Brand ID', 'trim|required');
        $this->form_validation->set_rules('model_id', 'Model ID', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('key_specification', 'Key Specification', 'trim|required');
        $this->form_validation->set_rules('refund_policy', 'Refund Policy', 'trim|required');

        // Validate form input
        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
            redirect('Product/addProduct');
        } else {
            // Prepare data for database insertion
            $currentDateTime = date("Y-m-d H:i:s");

            $data = [
                'brand_id' => $this->input->post('brand_id'),
                'model_id' => $this->input->post('model_id'),
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description'),
                'key_specification' => $this->input->post('key_specification'),
                'refund_policy' => $this->input->post('refund_policy'),
                'status' => 'active',
                'date_added' => $currentDateTime
            ];

            // Insert product into the database
            $result = $this->Product_model->insert_product($data);


            if ($result) {
                // Get the inserted product ID
                $product_id = $this->db->insert_id();

                // Handle product variations
                $variations = $this->input->post('variations');

                if (!empty($variations)) {
                    foreach ($variations as $variation) {
                        $dataVariation = explode("_", $variation);

                        $params = [
                            'vcat_id'       => $dataVariation[0],
                            'variation_id'  => $dataVariation[1],
                            'product_id'    => $product_id,
                            'status'        => 'active',
                            'date_added'    => $currentDateTime
                        ];

                        $this->Product_model->insert_pv($params);
                    }
                }

                $this->session->set_flashdata('inserted', 'Product has been created successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to create product');
            }

            redirect('product'); // Correct redirect URL
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
        $data['variationCatg'] = $variationCatg;

        $this->load->view('frontend/add-edit-product', $data);
    }

    public function updateProduct($id)
    {
        $data = $this->input->post();
        $data_files = $_FILES;
        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('brand_id', 'Brand ID', 'trim|required');
        $this->form_validation->set_rules('model_id', 'Model ID', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('image', 'Image', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_rules('key_specification', 'Key Specification', 'trim|required');
        $this->form_validation->set_rules('refund_policy', 'Refund Policy', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        // Check if form validation passes
        if (!$this->form_validation->run()) {
            // Validation failed, set error message and redirect back
            $this->session->set_flashdata('error', strip_tags(validation_errors()));
            return redirect('Product/editProduct/' . $id);
        }

        $currentDateTime = date('Y-m-d H:i:s');

        // Handle file upload
        $config = array(
            'upload_path' => '../assets/products/', // Verify this path
            'allowed_types' => 'jpg|jpeg|png|gif',
            'overwrite' => TRUE,
            'max_size' => "204800", // Max size in KB
        );

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            // File upload failed, set error message and redirect back
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            echo $error; // Print the error for debugging
            exit;
            return redirect('Product/editProduct/' . $id);
        } else {
            // File upload successful, get uploaded file details
            $uploadData = $this->upload->data();
            $image = $uploadData['file_name']; // Get the file name
        }

        // Prepare data for database update
        $update_data = array(
            'brand_id' => $data['brand_id'],
            'model_id' => $data['model_id'],
            'name' => $data['name'],
            'price' => $data['price'],
            'image' => '../assets/products/' . $image,
            'description' => $data['description'],
            'key_specification' => $data['key_specification'],
            'refund_policy' => $data['refund_policy'],
            'status' => $data['status'],
            'date_added' => $currentDateTime
        );

        // Update database
        $result = $this->Product_model->update_product($id, $update_data);

        if ($result) {
            $this->session->set_flashdata('success', 'Product has been updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Something went wrong, failed to update product');
        }

        return redirect('product');
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
