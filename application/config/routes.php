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

$route['view-variations'] = "Variant/index";
$route['add-variation'] = "Variant/addVariation";
$route['edit-variation/(:any)'] = "Variant/editVariation/$1";
$route['update-variation/(:any)'] = "Variant/updateVariation/$1";
$route['delete-variation/(:any)'] = "Variant/deleteVariation/$1";

$route['view-variation-category'] = "VariantCategory/index";
$route['add-variationCat'] = "VariantCategory/addVariationCat";
$route['edit-variationCat/(:any)'] = "VariantCategory/editVariationCat/$1";
$route['update-variationCat/(:any)'] = "VariantCategory/updateVariationCat/$1";
$route['delete-variationCat/(:any)'] = "VariantCategory/deleteVariationCat/$1";

$route['view-models'] = "Model/index";
$route['add-model'] = "Model/addModel";
$route['edit-model/(:any)'] = "Model/editModel/$1";
$route['update-model/(:any)'] = "Model/updateModel/$1";
$route['delete-model/(:any)'] = "Model/deleteModel/$1";
$route['model/select-id'] = "Model/getModelsByBrand";



$route['view-repairing-issues'] = "RepairingIssue/index";
$route['add-repair'] = "RepairingIssue/addRepairing";
$route['edit-repair/(:any)'] = "RepairingIssue/editRepairing/$1";
$route['update-repair/(:any)'] = "RepairingIssue/updateRepairing/$1";
$route['delete-repair/(:any)'] = "RepairingIssue/deleteRepairing/$1";
$route['select-id'] = 'RepairingIssue/select_id';


$route['view-service-centers'] = "ServiceCentres/index";
$route['create-service'] = 'ServiceCentres/createService';
$route['add-service'] = "ServiceCentres/addService";
$route['edit-service/(:any)'] = "ServiceCentres/editService/$1";
$route['delete-service/(:any)'] = "ServiceCentres/deleteService/$1";
$route['update-service/(:any)'] = "ServiceCentres/updateService/$1";

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

$route['view-customers'] = 'Customer/index';
$route['edit-customers/(:any)'] = 'Customer/editCustomers/$1';
$route['update-customers/(:any)'] = 'Customer/updateCustomers/$1';
$route['delete-customers/(:any)'] = 'Customer/deleteCustomers/$1';


$route['view-cust-address'] = "CustAddress/index";
$route['edit-custadd/(:any)'] = "CustAddress/editCustomersAdd/$1";
$route['update-custadd/(:any)'] = "CustAddress/updateCustomersAdd/$1";
$route['delete-custadd/(:any)'] = "CustAddress/deleteCustomersAdd/$1";

$route['view-cust-ricart'] = "CustRIcart/index";
$route['delete-cart/(:any)'] = "CustRIcart/deleteCustomersCart";

$route['view-shopping-cart'] = "ShoppingCart/index";
$route['delete-shopping-cart/(:any)'] = "ShoppingCart/deleteCartItem";

$route['view-products'] = "Product/index";
$route['add-product'] = "Product/addProduct";
$route['create-product'] = "Product/createProduct";
$route['edit-product/(:any)'] = "Product/editProduct/$1";
$route['update-product/(:any)'] = "Product/updateProduct/$1";
$route['delete-product/(:any)'] = "Product/deleteProduct/$1";
$route['select-id'] = 'Product/select_id';


$route['view-product-variation'] = "ProductVariation/index";
$route['add-product_variation'] = "ProductVariation/addProductVariation";
$route['edit-product_variation/(:any)'] = "ProductVariation/editProductVariation/$1";
$route['update-product_variation/(:any)'] = "ProductVariation/updateProductVariation/$1";
$route['delete-product_variation/(:any)'] = "ProductVariation/deleteProductVariation/$1";


$route['api/get-brands'] = "Api/getBrands";
$route['api/get-models/(:any)'] = "Api/getModels/$1";
$route['api/get-repairingIssue/(:any)'] = "Api/getRepairingIssues/$1";
$route['api/get-all-repairing-issues'] = 'Api/AllRepairingissues';
$route['api/get-products/(:any)'] = 'Api/getProductsByModelId/$1';
$route['api/get-product-details/(:any)'] = "Api/getProductDetailsWithVariations/$1";
