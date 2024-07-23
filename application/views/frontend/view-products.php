<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title . " - " . SITENAME; ?></title>
    <?php include('includes/style.php'); ?>
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/sidebar.php"); ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Products</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Products</h3>
                            <a href="<?php echo base_url('add-product'); ?>" class="btn btn-primary">Add Product</a>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('inserted')) : ?>
                                <div class="alert alert-success alert-dismissible fade text-start justify-content-start show" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('inserted')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('updated')) : ?>
                                <div class="alert alert-success alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('updated')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('deleted')) : ?>
                                <div class="alert alert-warning alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('deleted')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>BRAND AND MODEL</th>
                                        <th>PRODUCT NAME</th>
                                        <th>VARIATION</th>
                                        <th>IMAGE</th>
                                        <th>PRICE</th>
                                        <th>STATUS</th>
                                        <th>DATE ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php foreach ($product_details as $product) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($counter); ?></td>
                                            <td><?php echo $product->brand_name . ' ' . $product->model_name; ?></td>
                                            <td><?php echo $product->name; ?></td>
                                            <td><?php
                                                $variations = $this->db->query("SELECT vc.name, v.name as variation_name from product_variations pv LEFT JOIN variation_cat vc ON (pv.vcat_id = vc.id) LEFT JOIN variation v ON (pv.variation_id = v.id) where pv.product_id  = '" . $product->id . "'")->result();
                                                foreach ($variations as $variant) {
                                                    echo "<strong>" . $variant->name . ' </strong>: ' . $variant->variation_name;
                                                    echo "<br>";
                                                }
                                                ?></td>
                                            <td><?php echo $product->image; ?></td>
                                            <td><?php echo $product->price; ?></td>
                                            <td><?php echo $product->status; ?></td>
                                            <td><?php echo date("F j, Y", strtotime($product->date_added)); ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('edit-product/' . $product->id); ?>">Edit</a>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('delete-product/' . $product->id); ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $counter++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include('includes/footer.php'); ?>
</body>

</html>