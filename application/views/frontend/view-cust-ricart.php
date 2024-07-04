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
            <h1>CUSTOMER REPAIRING ISSUE CART</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-Customer-Repairing-Issue-Cart</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between"></div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('deleted')) : ?>
                                <div class="alert alert-success alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('deleted')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>CUSTOMER NAME</th>
                                        <th>BRAND NAME</th>
                                        <th>MODEL NAME</th>
                                        <th>REPAIR ISSUE NAME</th>
                                        <th>EST PRICE</th>
                                        <th>STATUS</th>
                                        <th>DATE ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php foreach ($query_result as $cust) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($counter); ?></td>
                                            <td><?php echo htmlspecialchars($cust->customer_name); ?></td>
                                            <td><?php echo htmlspecialchars($cust->brand_name); ?></td>
                                            <td><?php echo htmlspecialchars($cust->model_name); ?></td>
                                            <td><?php echo htmlspecialchars($cust->ri_name); ?></td>
                                            <td><?php echo htmlspecialchars($cust->est_price); ?></td>
                                            <td><?php echo htmlspecialchars($cust->status); ?></td>
                                            <td><?php echo date("F j, Y", strtotime($cust->date_added)); ?></td>
                                            <td>
                                                <a href="<?php echo base_url('delete-cart/' . $cust->id); ?>" class="btn btn-danger btn-sm">Delete</a>
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
    <?php include("includes/footer.php"); ?>
</body>

</html>