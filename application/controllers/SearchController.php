<?php
class SearchController extends CI_Controller
{
    public function redirectPage()
    {
        $query = strtolower(trim($this->input->post('query')));

        switch ($query) {
            case 'brands':
                redirect('view-brands');
                break;

            case 'models':
                redirect('view-models');
                break;

            case 'Repairing issues':
            case 'Repairing':
                redirect('view-repairing-issues');
                break;

            case 'Service Centers':
            case 'Service':
                redirect('view-service-centers');
                break;

            case 'Settings':
                redirect('view-settings');
                break;

            case 'customers':
                redirect('view-customers');
                break;

            case 'customer address':
                redirect('view-cust-address');
                break;

            case 'customer cart':
                redirect('view-cust-ricart');
                break;

            case 'shopping cart':
                redirect('view-shopping-cart');
                break;

            case 'variation':
                redirect('view-variations');
                break;
            case 'variation category':
                redirect('view-variation-category');
                break;

            case 'products':
                redirect('view-products');
                break;

            case 'products':
                redirect('view-products');
                break;

            case 'users':
            case 'view-users':
                redirect('view-users');
                break;

            case 'sell requests':
            case 'sell':
                redirect('sell-requests');
                break;

            case 'reports':
                redirect('reports');
                break;

            case 'dashboard':
                redirect('/dashboard');
                break;

            default:
                $this->session->set_flashdata('danger_message', 'Page not found! Check Page Name Again.');
                redirect($_SERVER['HTTP_REFERER']); // Back to previous page
        }
    }
}
