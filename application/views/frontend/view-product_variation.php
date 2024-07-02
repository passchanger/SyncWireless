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
            <h1>Product Variations</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-Product-Variations</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3></h3>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductVariationModal">Add Product Variation</a>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show text-end justify-content-end" role="alert">
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
                                        <th>Product ID</th>
                                        <th>Variation Category ID</th>
                                        <th>Variation ID</th>
                                        <th>Status</th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php foreach ($product_variations as $variation) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($counter); ?></td>
                                            <td><?php echo $variation->product_id; ?></td>
                                            <td><?php echo $variation->vcat_id; ?></td>
                                            <td><?php echo $variation->variation_id; ?></td>
                                            <td><?php echo $variation->status; ?></td>
                                            <td><?php echo date("F j, Y", strtotime($variation->date_added)); ?></td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#editProductVariationModal<?php echo $variation->id; ?>" class="btn btn-primary btn-sm" href="<?php echo base_url('edit-product_variation/') . $variation->id; ?>">Edit</a>
                                                <a data-bs-toggle="modal" data-bs-target="#deleteProductVariationModal<?php echo $variation->id; ?>" class="btn btn-danger btn-sm" href="<?php echo base_url('delete-product_variation/') . $variation->id; ?>">Delete</a>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editProductVariationModal<?php echo $variation->id; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Product Variation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="<?php echo base_url('update-product_variation/') . $variation->id; ?>">
                                                            <div class="mb-3">
                                                                <label for="product_id" class="form-label">Product ID</label>
                                                                <input type="text" class="form-control" id="product_id" name="product_id" value="<?php echo $variation->product_id; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="vcat_id" class="form-label">Variation Category ID</label>
                                                                <input type="text" class="form-control" id="vcat_id" name="vcat_id" value="<?php echo $variation->vcat_id; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="variation_id" class="form-label">Variation ID</label>
                                                                <input type="text" class="form-control" id="variation_id" name="variation_id" value="<?php echo $variation->variation_id; ?>" required>
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="status">Status</label>
                                                                <select class="form-control" id="status" name="status" required>
                                                                    <option value="" disabled>Select Status</option>
                                                                    <option value="active" <?php echo ($variation->status == 'active') ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo ($variation->status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                                                </select>
                                                            </div>


                                                            <div class="mb-3">
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->

                                        <?php $counter++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Add Modal -->
        <div class="modal fade" id="addProductVariationModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product Variation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url('add-product_variation'); ?>">
                            <div class="mb-3">
                                <label for="product_id" class="form-label">Product ID</label>
                                <input type="text" class="form-control" id="product_id" name="product_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="vcat_id" class="form-label">Variation Category ID</label>
                                <input type="text" class="form-control" id="vcat_id" name="vcat_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="variation_id" class="form-label">Variation ID</label>
                                <input type="text" class="form-control" id="variation_id" name="variation_id" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="" disbaled selected>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <?php include("includes/footer.php"); ?>

</body>

</html>