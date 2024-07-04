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
            <h1>Variation Category</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-varation-category</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3></h3>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Variation category</a>
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
                                    <?php $counter = 1; ?>
                                    <?php foreach ($VariationCat_details as $Variation) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($counter); ?></td>
                                            <td><?php echo $Variation->name; ?></td>
                                            <td><?php echo $Variation->status; ?></td>
                                            <td><?php echo date("F j, Y", strtotime($Variation->date_added)); ?></td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#editVariationModal<?php echo $Variation->id; ?>" class="btn btn-primary btn-sm" href="<?php echo base_url('edit-variationCat/' . $Variation->id); ?>">Edit</a>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('delete-variationCat/' . $Variation->id); ?>">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $counter++; ?>
                                        <!-- Edit Variation Modal -->
                                        <div class="modal fade" id="editVariationModal<?php echo $Variation->id; ?>" tabindex="-1" aria-labelledby="editVariationModalLabel<?php echo $Variation->id; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?php echo base_url('update-variationCat/' . $Variation->id); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editVariationModalLabel<?php echo $Variation->id; ?>" style="margin-left: 220px;">Edit Variation Category
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </h1>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo htmlspecialchars($Variation->name); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="status">Status</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="active" <?php echo ($Variation->status == 'active') ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo ($Variation->status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>

                                                                </select>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="sorting">Sorting</label>
                                                                <input type="text" name="sorting" placeholder="Enter Sorting" class="form-control" value="<?php echo htmlspecialchars($Variation->sorting); ?>">
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
        <!-- Add Variation Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo base_url('add-variationCat'); ?>" method="POST">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="
                            margin-left:220px">Add Variation Category</h1>
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
                            <input type="submit" name="insert" value="Add Variation Category" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </main><!-- End #main -->

    <?php include("includes/footer.php"); ?>
</body>

</html>