<?php
class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Brand_model');
        $this->load->model('Model_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }

    public function getBrands()
    {
        // var_dump('test');
        $brands = $this->Brand_model->getActiveBrands();
        $response = array('message' => "Brand retrieved successfully", 'data' => $brands);
        echo json_encode($response);
    }

    public function getModels($id)
    {

        if ($id) {
            $checkbrand = $this->Brand_model->getSingleBrand($id);
            if ($checkbrand != NULL) {
                $models = $this->Model_model->getActiveModels($id);
                $response = array('message' => "Model retrieved successfully", 'data' => $models);
            } else {
                $response = array('message' => "Brand Does not Exist");
            }
        } else {
            $response = array('message' => "Brand ID is mandatory");
        }

        echo json_encode($response);
    }
}
