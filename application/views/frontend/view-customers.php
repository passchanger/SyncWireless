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
            <h1></h1>Customers
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-customers</li>
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
                                        <th>CUSTOMER INFO</th>
                                        <th>STATUS</th>
                                        <th>DATE ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php foreach ($customers_details as $customers) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($counter); ?></td>
                                            <td><?php echo ($customers->name) . "<br>" . ($customers->email) . "<br>" . ($customers->mobile) ?></td>
                                            <td><?php echo htmlspecialchars($customers->status); ?></td>
                                            <td><?php echo date("F j, Y", strtotime($customers->date_added)); ?></td>
                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editRamModal<?php echo htmlspecialchars($customers->id); ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="<?php echo base_url('delete-customers/' . $customers->id); ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $counter++; ?>
                                        <!-- Edit Ram Modal -->
                                        <div class="modal fade" id="editRamModal<?php echo htmlspecialchars($customers->id); ?>" tabindex="-1" aria-labelledby="editRamModalLabel<?php echo htmlspecialchars($customers->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editRamModalLabel<?php echo htmlspecialchars($customers->id); ?>" style="margin-left:350px;">Edit User</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editForm<?php echo htmlspecialchars($customers->id); ?>" action="<?php echo base_url('update-customers/' . $customers->id); ?>" method="POST">
                                                            <div class="form-group mb-3">
                                                                <label for="name" class="form-label">NAME</label>
                                                                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter your Name" value="<?php echo htmlspecialchars($customers->name); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="email" class="form-label">EMAIL</label>
                                                                <input type="email" class="form-control" id="edit_email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($customers->email); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="mobile" class="form-label">MOBILE</label>
                                                                <input type="number" class="form-control" id="edit_number" name="mobile" placeholder="Enter your Mobile no." value="<?php echo htmlspecialchars($customers->mobile); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="password" class="form-label">PASSWORD</label>
                                                                <input type="passowrd" class="form-control" id="edit_password" name="password" placeholder="Enter your Password" value="<?php echo htmlspecialchars($customers->password); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="status">Status</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="active" <?php echo ($customers->status == 'active') ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo ($customers->status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                                <input type="submit" name="insert" value="Add user" class="btn btn-primary btn-sm">
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