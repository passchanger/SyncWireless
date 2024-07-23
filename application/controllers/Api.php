<?php
class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Brand_model');
        $this->load->model('Model_model');
        $this->load->model('RepairingIssue_model');
        $this->load->model('Product_model');
        $this->load->model('Customer_model');
        $this->load->model('ServiceCentres_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }

    public function getBrands()
    {
        $brands = $this->Brand_model->getActiveBrands();

        $response = array();
        foreach ($brands as $brand) {
            $response[] = array(
                'id' => $brand->id,
                'name' => $brand->name,
                'date_added' => $brand->date_added
            );
        }

        echo json_encode(array('message' => "Brands retrieved successfully", 'data' => $response));
    }

    public function getModels($id)
    {
        if ($id) {
            $checkbrand = $this->Brand_model->getSingleBrand($id);
            if ($checkbrand != NULL) {
                $models = $this->Model_model->getActiveModels($id);

                $response = array();
                foreach ($models as $model) {
                    $response[] = array(
                        'id' => $model->id,
                        'name' => $model->name,
                        'date_added' => $model->date_added
                    );
                }

                echo json_encode(array('message' => "Models retrieved successfully", 'data' => $response));
            } else {
                echo json_encode(array('message' => "Brand Does not Exist"));
            }
        } else {
            echo json_encode(array('message' => "Brand ID is mandatory"));
        }
    }

    public function getRepairingIssues($id)
    {
        if ($id) {
            $checkModel = $this->Model_model->getSingleModel($id);
            if ($checkModel != NULL) {
                $repairingIssues = $this->RepairingIssue_model->getActiveRepairingIssues($id);

                $response = array();
                foreach ($repairingIssues as $issue) {
                    $response[] = array(
                        'id' => $issue->id,
                        'issue_name' => $issue->issue_name,
                        'issue_price' => $issue->issue_price
                    );
                }

                echo json_encode(array('message' => "Repairing issues retrieved successfully", 'data' => $response));
            } else {
                echo json_encode(array('message' => "Model Does not Exist"));
            }
        } else {
            echo json_encode(array('message' => "Model ID is mandatory"));
        }
    }

    public function AllRepairingissues()
    {
        $repairing_issues = $this->RepairingIssue_model->getAllRepairingIssues();

        $response = array();
        foreach ($repairing_issues as $issue) {
            $response[] = $issue;
        }

        echo json_encode(array('message' => "All Repairing issues retrieved successfully", 'data' => $response));
    }

    public function getProductsByModelId($id)
    {
        if ($id) {
            $checkmodel = $this->Model_model->getSingleModel($id);
            if ($checkmodel != NULL) {
                $products = $this->Product_model->getProductsByModelId($id);

                $response = array();
                foreach ($products as $product) {
                    $response[] = array(
                        'id' => $product->id,
                        'image' => $product->image,
                        'name' => $product->name,
                        'price' => $product->price,
                        'brand_id' => $product->brand_name,
                        'model_id' => $product->model_name
                    );
                }
                echo json_encode(array('message' => "Product retrieved successfully", 'data' => $response));
            } else {
                echo json_encode(array('message' => "Model Does not Exist"));
            }
        } else {
            echo json_encode(array('message' => "Model ID is mandatory"));
        }
    }
    public function getProductsByBrandId($id)
    {
        if ($id) {
            $checkBrand = $this->Brand_model->getSingleBrand($id);
            if ($checkBrand != NULL) {
                $products = $this->Product_model->getProductsByBrandId($id);

                $response = array();
                foreach ($products as $product) {
                    $response[] = array(
                        'id' => $product->id,
                        'image' => $product->image,
                        'name' => $product->name,
                        'price' => $product->price,
                        'brand_id' => $product->brand_name,
                        'model_id' => $product->model_name
                    );
                }
                echo json_encode(array('message' => "Product retrieved successfully", 'data' => $response));
            } else {
                echo json_encode(array('message' => "Brand does not exist"));
            }
        } else {
            echo json_encode(array('message' => "Brand ID is mandatory"));
        }
    }

    public function getProductDetailsWithVariations($product_id)
    {
        if ($product_id) {
            $product = $this->Product_model->getActiveProductWithVariations($product_id);

            if ($product) {
                echo json_encode(array('message' => "Product details retrieved successfully", 'data' => $product));
            } else {
                echo json_encode(array('message' => "Product not found or inactive"));
            }
        } else {
            echo json_encode(array('message' => "Product ID is mandatory"));
        }
    }

    public function apiLogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if (empty($email) || empty($password)) {
            $response = array(
                'message' => 'Email and Password are required.',
            );
            echo json_encode($response);
            return;
        }

        $user = $this->db->select("*")->where("status", 'active')->where("email", $email)->from('users')->get()->row();
        if ($user) {
            $decoded_password = base64_decode($user->password);
            if ($password == $decoded_password) {
                $token = bin2hex(random_bytes(64));
                $this->db->where('id', $user->id)->update('users', array('token' => $token));
                $user_data = array(
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' => $token,
                );

                $response = array(
                    'message' => 'Login successful',
                    'data' => $user_data
                );
            } else {
                $response = array(
                    'message' => 'Password incorrect',
                );
            }
        } else {
            $response = array(
                'message' => "Email doesn't exist with us",
            );
        }

        echo json_encode($response);
    }

    public function registerCustomer()
    {
        // Retrieve input data
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $password = $this->input->post('password');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $pincode = $this->input->post('pincode');

        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required');

        // Check if validation fails
        if ($this->form_validation->run() == FALSE) {
            $response = array(
                'message' => 'Validation errors',
                'errors' => $this->form_validation->error_array()
            );
            echo json_encode($response);
            return;
        }

        // Check if email already exists
        $existingCustomer = $this->Customer_model->getCustomerByEmail($email);
        if ($existingCustomer) {
            $response = array(
                'message' => 'Email already exists',
            );
            echo json_encode($response);
            return;
        }

        // Prepare timestamps and hashed password
        $currentDateTime = date("Y-m-d H:i:s");
        $hashedPassword = base64_encode($password);

        // Prepare customer data
        $customerData = array(
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'password' => $hashedPassword,
            'date_added' => $currentDateTime,
            'status' => 'active'
        );

        // Insert customer data
        $insertId = $this->Customer_model->insert_customer($customerData);

        if ($insertId) {
            // Prepare address data
            $addressData = array(
                'customer_id' => $insertId,
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'pincode' => $pincode,
                'date_added' => $currentDateTime
            );

            // Load the CustAddress_model and insert the address data
            $this->load->model('CustAddress_model');
            $addressId = $this->CustAddress_model->insert_address($addressData);

            // Generate token and update customer record
            $token = bin2hex(random_bytes(64));
            $this->db->where('id', $insertId)->update('customers', array('token' => $token, 'updated_at' => $currentDateTime));

            // Fetch new customer data excluding password
            $newCustomer = $this->Customer_model->getCustomerById($insertId);

            $response = array(
                'message' => 'Registration successful',
                'data' => array(
                    'id' => $newCustomer->id,
                    'name' => $newCustomer->name,
                    'email' => $newCustomer->email,
                    'mobile' => $newCustomer->mobile,
                    'status' => $newCustomer->status,
                    'token' => $newCustomer->token,
                    'updated_at' => $newCustomer->updated_at,
                    'address_id' => $addressId,
                    'address' => array(
                        'country' => $addressData['country'],
                        'state' => $addressData['state'],
                        'city' => $addressData['city'],
                        'pincode' => $addressData['pincode']
                    )
                )
            );
        } else {
            $response = array(
                'message' => 'Registration failed',
            );
        }

        echo json_encode($response);
    }



    public function getServiceCentresByLocation()
    {
        $latitude = $this->input->get('latitude');
        $longitude = $this->input->get('longitude');
        $radius = $this->input->get('radius'); // Optional radius parameter

        if (!$latitude || !$longitude) {
            echo json_encode(array('message' => 'Latitude and Longitude are required'));
            return;
        }

        $serviceCentres = $this->ServiceCentres_model->getServiceCentresByLocation($latitude, $longitude, $radius);

        if ($serviceCentres) {
            echo json_encode(array('message' => 'Service centres retrieved successfully', 'data' => $serviceCentres));
        } else {
            echo json_encode(array('message' => 'No service centres found'));
        }
    }

    public function addToCart()
    {
        $brand_id = $this->input->post('brand_id');
        $model_id = $this->input->post('model_id');
        $issue_name = $this->input->post('issue_name');
        $issue_price = $this->input->post('issue_price');
        $sorting = $this->input->post('sorting');

        // Validate inputs
        $this->form_validation->set_rules('brand_id', 'Brand ID', 'trim|required');
        $this->form_validation->set_rules('model_id', 'Model ID', 'trim|required');
        $this->form_validation->set_rules('issue_name', 'Issue Name', 'trim|required');
        $this->form_validation->set_rules('issue_price', 'Issue Price', 'trim|required');
        $this->form_validation->set_rules('sorting', 'Sorting', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            echo json_encode(array('status' => 'error', 'message' => $error_message));
            return;
        }

        // Prepare data for insertion
        $data = [
            'brand_id' => $brand_id,
            'model_id' => $model_id,
            'issue_name' => $issue_name,
            'issue_price' => $issue_price,
            'sorting' => $sorting,
            'status' => 'active',
            'date_added' => date("Y-m-d H:i:s")
        ];

        // Insert data into the database
        $result = $this->RepairingIssue_model->insert_issue($data);

        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Repairing issue added to cart successfully'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to add repairing issue to cart'));
        }
    }
    public function getAddressByToken()
    {
        // Retrieve token from request headers
        $token = $this->input->get_request_header('Authorization');

        if (!$token) {
            $response = array(
                'message' => 'Token is required',
                'status' => false
            );
            echo json_encode($response);
            return;
        }

        // Fetch customer data based on token
        $customer = $this->Customer_model->getCustomerByToken($token);

        if (!$customer) {
            $response = array(
                'message' => 'Invalid token',
                'status' => false
            );
            echo json_encode($response);
            return;
        }

        // Fetch address data based on customer ID
        $address = $this->CustAddress_model->getAddressByCustomerId($customer->id);

        if (!$address) {
            $response = array(
                'message' => 'Address not found',
                'status' => false
            );
            echo json_encode($response);
            return;
        }

        // Prepare response
        $response = array(
            'message' => 'Address retrieved successfully',
            'status' => true,
            'data' => array(
                'customer_id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'mobile' => $customer->mobile,
                'address' => array(
                    'country' => $address->country,
                    'state' => $address->state,
                    'city' => $address->city,
                    'pincode' => $address->pincode
                )
            )
        );

        echo json_encode($response);
    }
}
