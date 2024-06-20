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
            <h1>Models</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-models</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3></h3>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Model</a>

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
                                        <th>BRAND-ID</th>
                                        <th>NAME</th>
                                        <th>FEATURES</th>
                                        <th>DESCRIPTION</th>
                                        <th>STATUS</th>
                                        <th>DATE-ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Model_details as $models) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($models->id); ?></td>
                                            <td><?php echo htmlspecialchars($models->brand_id); ?></td>
                                            <td><?php echo htmlspecialchars($models->name); ?></td>
                                            <td><?php echo htmlspecialchars($models->features); ?></td>
                                            <td><?php echo htmlspecialchars($models->description); ?></td>
                                            <td><?php echo htmlspecialchars($models->status); ?></td>
                                            <td><?php echo htmlspecialchars($models->date_added); ?></td>

                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#exampleModall" class="btn btn-primary" href="<?php echo base_url('edit-model/' . $models->id); ?>">Edit</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger" href="<?php echo base_url('delete-model/' . $models->id); ?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <!-- Modal for Edit Model -->
                                    <div class="modal fade" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?php echo base_url('update-model/' . $models->id); ?>" method="POST">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left: 330px;">Edit Model
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label for="brand_id">BRAND ID</label>
                                                            <input type="number" name="brand_id" placeholder="Enter Brand ID" class="form-control" value="<?php echo htmlspecialchars($models->brand_id); ?>">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="name">NAME</label>
                                                            <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo htmlspecialchars($models->name); ?>">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="features">FEATURES</label>
                                                            <input type="text" name="features" placeholder="Enter Features" class="form-control" value="<?php echo htmlspecialchars($models->features); ?>">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="description">DESCRIPTION</label>
                                                            <textarea name="description" placeholder="Enter Description" class="form-control"><?php echo htmlspecialchars($models->description); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <input type="submit" name="insert" value="Update" class="btn btn-primary btn-sm">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Modal for Add Model -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo base_url('add-model'); ?>" method="POST">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="
                            margin-left:330px">Add Model</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="brand_id" class="form-label">BRAND ID</label>
                                <input type="number" name="brand_id" placeholder="Enter Brand ID" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">NAME</label>
                                <input type="text" name="name" placeholder="Enter Name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="features" class="form-label">FEATURES</label>
                                <input type="text" name="features" placeholder="Enter Features" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">DESCRIPTION</label>
                                <textarea name="description" placeholder="Enter Description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="insert" value="Add Model" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </main><!-- End #main -->

    <?php include("includes/footer.php"); ?>
</body>

</html>