<?php
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('form_validation');
        $this->load->helper('auth_helper');
    }

    public function index()
    {
        $runFunction = checkLogin();
        $data['title'] = 'Users';
        $data['users_details'] = $this->Users_model->getUser();
        $this->load->view('frontend/view-users', $data);
    }

    public function addUsers()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[15]');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");
            $encoded_password = base64_encode($this->input->post('password'));


            $result = $this->Users_model->insert_users([
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $encoded_password,
                'status' => 'active',
                'date_added' => $currentDateTime
            ]);

            if ($result) {
                $this->session->set_flashdata('inserted', 'User has been created successfully');
            }
        }
        redirect('view-users');
    }

    public function editUsers($id)
    {
        $data['singleuser'] = $this->Users_model->getSingleUser($id);
        $data['users_details'] = $this->Users_model->getUser();
        $this->load->view('view-users', $data);
    }

    public function updateUsers($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check[' . $id . ']');
        // $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $error_message = strip_tags(validation_errors());
            $this->session->set_flashdata('error', $error_message);
        } else {
            $currentDateTime = date("Y-m-d H:i:s");
            $encoded_password = base64_encode($this->input->post('password'));

            $result = $this->Users_model->update_users([
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status'),
                'password' => $encoded_password,
                'date_added' => $currentDateTime
            ], $id);

            if ($result) {
                $this->session->set_flashdata('updated', 'User has been updated successfully');
            }
        }
        redirect('view-users');
    }


    // Callback function to check unique email during update
    public function email_check($email, $id)
    {
        $user = $this->Users_model->getUserByEmail($email);
        if ($user && $user->id != $id) {
            $this->form_validation->set_message('email_check', 'The {field} field must contain a unique value.');
            return FALSE;
        }
        return TRUE;
    }


    public function deleteUsers($id)
    {
        $result = $this->Users_model->deleteitems($id);
        if ($result == true) {
            $this->session->set_flashdata('deleted', 'User has been deleted successfully');
        }
        redirect('view-users');
    }

    public function login()
    {
        $data['title'] = "Login";
        $this->load->view('frontend/login', $data);
    }

    public function loginCheck()
    {
        // var_dump($_REQUEST);exit;
        $checkUsers = $this->db->select("*")->where("status = 'active'")->where("email = '" . $_REQUEST['email'] . "'")->from('users')->get()->row();

        // var_dump($checkUsers);exit;
        if (isset($checkUsers->password)) {
            $password = base64_decode($checkUsers->password);
            if ($_REQUEST['password'] == $password) {
                $tempArr = array('id' => $checkUsers->id, 'name' => $checkUsers->name, 'email' => $checkUsers->email);
                $this->session->set_userdata('session-data', $tempArr);
                redirect('/dashboard', 'refresh');
                exit;
            } else {
                $this->session->set_flashdata('danger_message', 'Password incorrect');
            }
        } else {
            $this->session->set_flashdata('danger_message', "Email doesn't exist with us");
        }

        redirect('login', 'refresh');
        exit;
    }

    public function logOut()
    {
        $this->session->unset_userdata('session-data');
        $this->session->set_flashdata('success_message', 'Logout Sucessfully');
        redirect('login', 'refresh');
        exit;
    }
}
