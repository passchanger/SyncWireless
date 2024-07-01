<?php

if (!function_exists('checkLogin')) {
    function checkLogin()
    {
        $CI = &get_instance();

        if ($CI->session->userdata('session-data')) {
            $session = $CI->session->userdata('session-data');
            // var_dump($session);
        } else {
            $CI->session->set_flashdata('danger_message', 'Login to continue');
            redirect('login', 'refresh');
            exit;
        }
    }
}
