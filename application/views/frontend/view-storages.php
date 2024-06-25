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
            <h1>Storage</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-storages</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3></h3>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Storage</a>
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
                                        <!-- <th>SORTING</th> -->
                                        <th>STATUS</th>
                                        <th>DATE-ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($storage_details as $storage) : ?>
                                        <tr>
                                            <td><?php echo $storage->id; ?></td>
                                            <td><?php echo $storage->name; ?></td>
                                            <td><?php echo $storage->status; ?></td>
                                            <td><?php echo date("F j, Y", strtotime($storage->date_added)); ?></td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#editStorageModal<?php echo $storage->id; ?>" class="btn btn-primary btn-sm" href="<?php echo base_url('edit-storage/' . $storage->id); ?>">Edit</a>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('delete-storage/' . $storage->id); ?>">Delete</a>
                                            </td>
                                        </tr>

                                        <!-- Edit Storage Modal -->
                                        <div class="modal fade" id="editStorageModal<?php echo $storage->id; ?>" tabindex="-1" aria-labelledby="editStorageModalLabel<?php echo $storage->id; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?php echo base_url('update-storage/' . $storage->id); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editStorageModalLabel<?php echo $storage->id; ?>" style="margin-left: 320px;">Edit Storage
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </h1>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo htmlspecialchars($storage->name); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="sorting">Sorting</label>
                                                                <input type="text" name="sorting" placeholder="Enter Sorting" class="form-control" value="<?php echo htmlspecialchars($storage->sorting); ?>">
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

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Add Storage Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo base_url('add-storage'); ?>" method="POST">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="
                            margin-left:320px">Add Storage</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Enter Name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="sorting">Sorting</label>
                                <input type="text" name="sorting" placeholder="Enter Sorting" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="insert" value="Add Storage" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </main><!-- End #main -->

    <?php include("includes/footer.php"); ?>
</body>

</html>