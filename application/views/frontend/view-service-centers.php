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
            <h1>Service Centers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-Service-Centers</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3></h3>
                            <a href="<?php echo base_url('serviceCentres/serviceForm'); ?>" class="btn btn-primary">Add Service</a>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('inserted')) : ?>
                                <div class="alert alert-success alert-dismissible fade show text-start justify-content-start" role="alert">
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
                                <div class="alert alert-success alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('deleted')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>CP-DETAILS</th>
                                        <th>ADDRESS</th>
                                        <th>STATUS</th>
                                        <th>DATE-ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php foreach ($service_details as $service) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($counter); ?></td>
                                            <td><?php echo $service->name; ?></td>
                                            <td><?php echo $service->cp_name . "<br>" . $service->email . "<br>" . $service->mobile ?></td>
                                            <td>
                                                <?php echo $service->address . "<br>" . $service->city . "<br>" . $service->state . "<br>" . $service->pincode  ?>
                                            </td>

                                            <td><?php echo $service->status; ?></td>
                                            <td><?php echo date("F j, Y", strtotime($service->date_added)); ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('create-service/' . $service->id); ?>">Edit</a>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('delete-service/' . $service->id); ?>">Delete</a>
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