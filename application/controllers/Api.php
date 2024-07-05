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
}
