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
        $this->load->model('CustAddress_model');
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
        // $repairing_issues = $this->RepairingIssue_model->getAllRepairingIssues();

        $response = array(
            array('icon' => 'https://tal7aouy.gallerycdn.vsassets.io/extensions/tal7aouy/icons/3.8.0/1703110281439/Microsoft.VisualStudio.Services.Icons.Default', 'name' => 'Broken Screen', 'description' => "Lorem ipsum"),
            array('icon' => 'https://tal7aouy.gallerycdn.vsassets.io/extensions/tal7aouy/icons/3.8.0/1703110281439/Microsoft.VisualStudio.Services.Icons.Default', 'name' => 'Jack Issue', 'description' => "Lorem ipsum")
        );

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
                        'brand' => $product->brand_name,
                        'model' => $product->model_name
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

        // Fetch the customer with the provided email and active status
        $customer = $this->db->select("*")->where("status", 'active')->where("email", $email)->from('customers')->get()->row();

        if ($customer) {
            // Decode the stored password and compare with the provided password
            $decoded_password = base64_decode($customer->password);
            if ($password == $decoded_password) {
                // Generate a new token
                $token = bin2hex(random_bytes(64));
                // Update the customer's token in the database
                $this->db->where('id', $customer->id)->update('customers', array('token' => $token));
                // Prepare the user data for the response
                $customer_data = array(
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'token' => $token,
                );

                $response = array(
                    'message' => 'Login successful',
                    'data' => $customer_data
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
                    'address_id' => $addressId
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
        $radius = 10;      //$this->input->get('1000'); // Optional radius parameter

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
        // Retrieve input data
        $brand_id = $this->input->post('brand_id');
        $model_id = $this->input->post('model_id');
        $issue_name = $this->input->post('issue_name');
        $issue_price = $this->input->post('issue_price');
        $sorting = $this->input->post('sorting');

        // Validate inputs
        $this->form_validation->set_rules('brand_id', 'Brand ID', 'trim|required');
        $this->form_validation->set_rules('model_id', 'Model ID', 'trim|required');
        $this->form_validation->set_rules('issue_name', 'Issue Name', 'trim|required');
        $this->form_validation->set_rules('issue_price', 'Issue Price', 'trim|required|numeric');
        $this->form_validation->set_rules('sorting', 'Sorting', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            // Retrieve validation errors
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
        // Retrieve token from GET request
        $token = $this->input->get('token');

        // Check if token is provided
        if (!$token) {
            $response = array(
                'status' => false,
                'message' => 'Token is required'
            );
            echo json_encode($response);
            return;
        }

        // Fetch customer data based on token
        $customer = $this->Customer_model->getCustomerByToken($token);

        // Check if customer exists
        if (!$customer) {
            $response = array(
                'status' => false,
                'message' => 'Invalid token'
            );
            echo json_encode($response);
            return;
        }

        // Fetch address data based on customer ID
        $address = $this->CustAddress_model->getAddressByCustomerId($customer->id);

        // Check if address exists
        if (!$address) {
            $response = array(
                'status' => false,
                'message' => 'Address not found'
            );
            echo json_encode($response);
            return;
        }

        // Prepare successful response
        $response = array(
            'status' => true,
            'message' => 'Address retrieved successfully',
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
    public function createAddressByToken()
    {
        // Retrieve input data
        $token = $this->input->post('token');
        $country = $this->input->post('country');
        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $pincode = $this->input->post('pincode');
        $addline_1 = $this->input->post('addline_1');
        $addline_2 = $this->input->post('addline_2');

        // Validate inputs
        $this->form_validation->set_rules('token', 'Token', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required|numeric');
        $this->form_validation->set_rules('addline_1', 'Address Line 1', 'trim|required');
        $this->form_validation->set_rules('addline_2', 'Address Line 2', 'trim');

        if ($this->form_validation->run() == FALSE) {
            // Retrieve validation errors
            $error_message = strip_tags(validation_errors());
            $response = array(
                'status' => false,
                'message' => $error_message
            );
            echo json_encode($response);
            return;
        }

        // Fetch customer data based on token
        $customer = $this->Customer_model->getCustomerByToken($token);

        // Check if customer exists
        if (!$customer) {
            $response = array(
                'status' => false,
                'message' => 'Invalid token'
            );
            echo json_encode($response);
            return;
        }

        // Prepare data for insertion
        $address_data = array(
            'customer_id' => $customer->id,
            'country' => $country,
            'state' => $state,
            'city' => $city,
            'pincode' => $pincode,
            'addline_1' => $addline_1,
            'addline_2' => $addline_2,
            'date_added' => date("Y-m-d H:i:s")
        );

        // Insert address data into the database
        $result = $this->CustAddress_model->insert_address($address_data);

        if ($result) {
            $response = array(
                'status' => true,
                'message' => 'Address created successfully'
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'Failed to create address'
            );
        }

        echo json_encode($response);
    }
    public function getSlotsByDate()
    {
        // Retrieve input data
        $date = $this->input->get('date');

        // Validate input
        $this->form_validation->set_data(array('date' => $date));
        $this->form_validation->set_rules('date', 'Date', 'trim|required|callback_valid_date');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $response = array(
                'status' => false,
                'message' => $error_message
            );
            echo json_encode($response);
            return;
        }

        // Mock data for slots (this should be replaced with actual data retrieval logic)
        $slots = $this->getMockSlots();

        $response = array(
            'status' => true,
            'message' => 'Slots retrieved successfully',
            'data' => $slots
        );

        echo json_encode($response);
    }

    // Custom validation callback for date format
    public function valid_date($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    // Mock function to simulate slot retrieval
    private function getMockSlots()
    {
        // Example generic slot data
        return array(
            '09:00AM - 10:00AM',
            '10:00AM - 11:00AM',
            '11:00AM - 12:00PM',
            '12:00PM - 01:00PM',
            '01:00PM - 02:00PM',
            '02:00PM - 03:00PM',
            '03:00PM - 04:00PM',
            '04:00PM - 05:00PM'
        );
    }
}
