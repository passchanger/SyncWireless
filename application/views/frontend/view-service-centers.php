<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
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
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3></h3>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Services</a>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('inserted')) : ?>
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('inserted')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('updated')) : ?>
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('updated')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('deleted')) : ?>
                                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('deleted')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>ADDRESS</th>
                                        <th>CITY</th>
                                        <th>STATE</th>
                                        <th>LATTITUDE</th>
                                        <th>LONGITUDE</th>
                                        <th>STATUS</th>
                                        <th>DATE-ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($service_details as $service) : ?>
                                        <tr>
                                            <td><?php echo $service->id; ?></td>
                                            <td><?php echo $service->name; ?></td>
                                            <td><?php echo $service->address; ?></td>
                                            <td><?php echo $service->city; ?></td>
                                            <td><?php echo $service->state; ?></td>
                                            <td><?php echo $service->latitude; ?></td>
                                            <td><?php echo $service->longitude; ?></td>
                                            <td><?php echo $service->status; ?></td>
                                            <td><?php echo $service->date_added; ?></td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#editServiceModal<?php echo $service->id; ?>" class="btn btn-primary" href="#">Edit</a>
                                                <a class="btn btn-danger" href="<?php echo base_url('delete-service/' . $service->id); ?>">Delete</a>
                                            </td>
                                        </tr>

                                        <!-- Edit Service Modal -->
                                        <div class="modal fade" id="editServiceModal<?php echo $service->id; ?>" tabindex="-1" aria-labelledby="editServiceModalLabel<?php echo $service->id; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?php echo base_url('update-service/' . $service->id); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editServiceModalLabel<?php echo $service->id; ?>" style="margin-left: 250px;">Edit Service Centre
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </h1>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $service->name; ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="address">Address</label>
                                                                <input type="text" name="address" placeholder="Enter Address" class="form-control" value="<?php echo $service->address; ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="city">City</label>
                                                                <input type="text" name="city" placeholder="Enter City" class="form-control" value="<?php echo $service->city; ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="state">State</label>
                                                                <input type="text" name="state" placeholder="Enter State" class="form-control" value="<?php echo $service->state; ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="latitude">Latitude</label>
                                                                <input type="number" name="latitude" placeholder="Enter Latitude" class="form-control" value="<?php echo $service->latitude; ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="longitude">Longitude</label>
                                                                <input type="number" name="longitude" placeholder="Enter Longitude" class="form-control" value="<?php echo $service->longitude; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                            <input type="submit" name="insert" value="Update Service" class="btn btn-primary btn-sm">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Add Service Centre Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo base_url('add-service'); ?>" method="POST">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="
                            margin-left:250px">Add Service Centres</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Enter Name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <input type="text" name="address" placeholder="Enter Address" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="city">City</label>
                                <input type="text" name="city" placeholder="Enter City" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="state">State</label>
                                <input type="text" name="state" placeholder="Enter State" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="latitude">Latitude</label>
                                <input type="number" name="latitude" placeholder="Enter Latitude" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="longitude">Longitude</label>
                                <input type="number" name="longitude" placeholder="Enter Longitude" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="insert" value="Add Services" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </main><!-- End #main -->

    <?php include("includes/footer.php"); ?>
</body>

</html>