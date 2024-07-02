<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// $route['api/(:any)/(:any)'] = 'Api/index/$1/$1';

$route['view-brands'] = "Brand/index";
$route['add-Brand'] = "Brand/addBrand";
$route['edit-Brand/(:any)'] = "Brand/editBrand/$1";
$route['update-Brand/(:any)'] = "Brand/updateBrand/$1";
$route['delete-Brand/(:any)'] = "Brand/deleteBrand/$1";

$route['view-variants'] = "Ram/index";
$route['add-ram'] = "Ram/addram";
$route['edit-ram/(:any)'] = "Ram/editram/$1";
$route['update-ram/(:any)'] = "Ram/updateram/$1";
$route['delete-ram/(:any)'] = "Ram/deleteram/$1";

$route['view-variation_category'] = "Storage/index";
$route['add-storage'] = "Storage/addStorage";
$route['edit-storage/(:any)'] = "Storage/editStorage/$1";
$route['update-storage/(:any)'] = "Storage/updateStorage/$1";
$route['delete-storage/(:any)'] = "Storage/deleteStorage/$1";

$route['view-models'] = "Model/index";
$route['add-model'] = "Model/addModel";
$route['edit-model/(:any)'] = "Model/editModel/$1";
$route['update-model/(:any)'] = "Model/updateModel/$1";
$route['delete-model/(:any)'] = "Model/deleteModel/$1";
$route['model/select-id'] = "Model/getModelsByBrand";



$route['view-repairing-issues'] = "Repairing/index";
$route['add-repair'] = "Repairing/addRepairing";
$route['edit-repair/(:any)'] = "Repairing/editRepairing/$1";
$route['update-repair/(:any)'] = "Repairing/updateRepairing/$1";
$route['delete-repair/(:any)'] = "Repairing/deleteRepairing/$1";



$route['view-service-centers'] = "Service/index";
$route['add-service'] = "Service/addService/";
$route['edit-service/(:any)'] = "Service/editService/$1";
$route['delete-service/(:any)'] = "Service/deleteService/$1";
$route['update-service/(:any)'] = "Service/updateService/$1";

$route['view-settings'] = "Setting/index";
$route['add-setting'] = "Setting/addSetting";
$route['edit-setting/(:any)'] = "Setting/editSetting/$1";
$route['update-setting/(:any)'] = "Setting/updateSetting/$1";
$route['delete-setting/(:any)'] = "Setting/deleteSetting/$1";


$route['dashboard'] = "Index/index";

$route['view-users'] = "Users/index";
$route['add-users'] = "Users/addUsers";
$route['edit-users/(:any)'] = "Users/editUsers/$1";
$route['update-users/(:any)'] = "Users/updateUsers/$1";
$route['delete-users/(:any)'] = "Users/deleteUsers/$1";

$route['login'] = "Users/login";
$route['login-check'] = "Users/loginCheck";
$route['logout'] = "Users/logOut";

$route['view-customers'] = "Customers/index";
$route['edit-customers/(:any)'] = "Customers/editCustomers/$1";
$route['update-customers/(:any)'] = " Customers/updateCustomers/$1";
$route['delete-customers/(:any)'] = " Customers/deleteCustomers/$1";

$route['view-cust-address'] = "Cust_Address/index";
$route['edit-custadd/(:any)'] = "Cust_Address/editCustomersAdd/$1";
$route['update-custadd/(:any)'] = "Cust_Address/updateCustomersAdd/$1";
$route['delete-custadd/(:any)'] = "Cust_Address/deleteCustomersAdd/$1";

$route['view-cust_ricart'] = "Cust_ricart/index";
$route['delete-cart/(:any)'] = "Cust_ricart/deleteCustomersCart";

$route['view-shopping_cart'] = "Shopping_cart/index";
$route['delete-shopping_cart/(:any)'] = "Shopping_cart/deleteCartItem";

$route['view-products'] = "Product/index";
$route['add-product'] = "Product/addProduct";
$route['edit-product/(:any)'] = "Product/editProduct/$1";
$route['update-product/(:any)'] = "Product/updateProduct/$1";
$route['delete-product/(:any)'] = "Product/deleteProduct/$1";

$route['view-product_variation'] = "Product_variation/index";
$route['add-product_variation'] = "Product_variation/addProductVariation";
$route['edit-product_variation/(:any)'] = "Product_variation/editProductVariation/$1";
$route['update-product_variation/(:any)'] = "Product_variation/updateProductVariation/$1";
$route['delete-product_variation/(:any)'] = "Product_variation/deleteProductVariation/$1";
