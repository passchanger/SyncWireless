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
            <h1>Brand</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-brands</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3></h3>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Brand</a>
                        </div>

                        <div class="card-body">

                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show text-end justify-content-start" role="alert">
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

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <!-- <th>logo</th> -->
                                        <!-- <th>sorting</th> -->
                                        <th>DESCRIPTION</th>
                                        <th>STATUS</th>
                                        <th>DATE-ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php foreach ($product_details as $products) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($counter); ?></td>
                                            <td><?php echo htmlspecialchars($products->name); ?></td>
                                            <td><?php echo htmlspecialchars($products->description); ?></td>
                                            <td><?php echo htmlspecialchars($products->status); ?></td>
                                            <td><?php echo date("F j, Y", strtotime($products->date_added)); ?></td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#exampleModall<?php echo $products->id; ?>" class="btn btn-primary btn-sm" href="<?php echo base_url('edit-Brand/' . $products->id); ?>">Edit</a>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('delete-Brand/' . $products->id); ?>">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $counter++; ?>
                                        <div class="modal fade" id="exampleModall<?php echo $products->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?php echo base_url('update-Brand/' . $products->id); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="margin-left:330px;">Edit Brand</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label for="name">NAME</label>
                                                                <input type="text" name="name" placeholder="Enter your Name" class="form-control" value="<?php echo htmlspecialchars($products->name); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="description">DESCRIPTION</label>
                                                                <textarea name="description" placeholder="Enter your description" class="form-control"><?php echo htmlspecialchars($products->description); ?></textarea>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="status">Status</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="active" <?php echo ($products->status == 'active') ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo ($products->status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="sorting">SORTING</label>
                                                                <input type="number" name="sorting" placeholder="Enter your Sorting no." class="form-control" value="<?php echo htmlspecialchars($products->sorting); ?>">
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


                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Add Brand Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo base_url('add-Brand'); ?>" method="POST">
                        <div class="modal-header d-flex justify-content-between align-items-center">
                            <h1 class="modal-title fs-5 mb-0" style="
                            margin-left:330px">Add Brand</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="name">NAME</label>
                                <input type="text" name="name" placeholder="Enter your Name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">DESCRIPTION</label>
                                <textarea name="description" placeholder="Enter your description" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="sorting">SORTING</label>
                                <input type="number" name="sorting" placeholder="Enter your Sorting no." class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="insert" value="Add brand" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </main>
    <!-- End #main -->

    <?php include("includes/footer.php"); ?>
</body>

</html>