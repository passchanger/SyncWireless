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
            <h1>Customers Addresses</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-Customers-Addresses</li>
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
                                        <th>CUSTOMER-NAME</th>
                                        <th>ADDRESS-1</th>
                                        <th>ADDRESS-2</th>
                                        <th>STATUS</th>
                                        <th>DATE ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php foreach ($custadd_details as $custadd) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($counter); ?></td>
                                            <td><?php echo htmlspecialchars($custadd->customer_name); ?></td>
                                            <td><?php echo htmlspecialchars($custadd->addline_1); ?></td>
                                            <td><?php echo ($custadd->city) . "<br>" . ($custadd->state) . "<br>" . ($custadd->pincode) . "<br>" . ($custadd->country) ?></td>
                                            <td><?php echo htmlspecialchars($custadd->status); ?></td>
                                            <td><?php echo date("F j, Y", strtotime($custadd->date_added)); ?></td>

                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editRamModal<?php echo htmlspecialchars($custadd->id); ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="<?php echo base_url('delete-custadd/' . $custadd->id); ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $counter++; ?>
                                        <!-- Edit Ram Modal -->
                                        <div class="modal fade" id="editRamModal<?php echo htmlspecialchars($custadd->id); ?>" tabindex="-1" aria-labelledby="editRamModalLabel<?php echo htmlspecialchars($custadd->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editRamModalLabel<?php echo htmlspecialchars($custadd->id); ?>" style="margin-left:350px;">Edit User</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editForm<?php echo htmlspecialchars($custadd->id); ?>" action="<?php echo base_url('update-custadd/' . $custadd->id); ?>" method="POST">
                                                            <div class="form-group mb-3">
                                                                <label for="id" class="form-label">Customer_id</label>
                                                                <input type="text" class="form-control" id="edit_customer_id" name="customer_id" placeholder="Enter your Customer_id" value="<?php echo htmlspecialchars($custadd->customer_id); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="address">Address</label>
                                                                <input type="text" name="addline_1" placeholder="Enter your Address" class="form-control" value="<?php echo htmlspecialchars($custadd->addline_1); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="city">City</label>
                                                                <input type="text" name="city" placeholder="Enter your City" class="form-control" value="<?php echo htmlspecialchars($custadd->city); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="state">State</label>
                                                                <input type="text" name="state" placeholder="Enter your State" class="form-control" value="<?php echo htmlspecialchars($custadd->state); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="pincode">Pincode</label>
                                                                <input type="number" name="pincode" placeholder="Enter your Pincode" class="form-control" value="<?php echo htmlspecialchars($custadd->pincode); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="Country">COUNTRY</label>
                                                                <input type="text" name="country" placeholder="Enter your Country" class="form-control" value="<?php echo htmlspecialchars($custadd->country); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="status">Status</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="active" <?php echo ($custadd->status == 'active') ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo ($custadd->status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="edit_primary<?php echo htmlspecialchars($custadd->id); ?>" name="is_primary" <?php echo ($custadd->is_primary == 1) ? 'checked' : ''; ?> checked>
                                                                    <label class="form-check-label" for="edit_primary<?php echo htmlspecialchars($custadd->id); ?>">
                                                                        Primary
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                <input type="submit" name="update" value="Update" class="btn btn-primary btn-sm">
                                                            </div>
                                                        </form>
                                                    </div>
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

    </main>

    <?php include("includes/footer.php"); ?>
</body>

</html>