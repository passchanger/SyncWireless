<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title . " - " . SITENAME; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include('includes/style.php'); ?>
</head>

<body>
    <?php include("includes/header.php"); ?>

    <?php include("includes/sidebar.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Shopping Cart</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View Shopping Cart</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                        </div>

                        <div class="card-body">

                            <?php if ($this->session->flashdata('deleted')) : ?>
                                <div class="alert alert-success alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('deleted')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>CUSTOMER NAME</th>
                                        <th>PRODUCT NAME</th>
                                        <th>VARIATION NAME</th>
                                        <th>DISC_PRICE</th>
                                        <th>STATUS</th>
                                        <th>DATE_ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php foreach ($cart_details as $cart) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($counter); ?></td>
                                            <td><?php echo htmlspecialchars($cart->customer_name); ?></td>
                                            <td><?php echo htmlspecialchars($cart->product_name); ?></td>
                                            <td><?php echo htmlspecialchars($cart->variation_name); ?></td>
                                            <td><?php echo htmlspecialchars($cart->disc_price); ?></td>
                                            <td><?php echo htmlspecialchars($cart->status); ?></td>
                                            <td><?php echo date("F j, Y", strtotime($cart->date_added)); ?></td>
                                            <td>
                                                <a href="<?php echo base_url('delete-shopping_cart/' . $cart->id); ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $counter++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <?php include("includes/footer.php"); ?>
</body>

</html>