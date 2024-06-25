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
            <h1>Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-users</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3></h3>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRamModal">Add User</a>

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
                                        <th>EMAIL</th>
                                        <th>PASSWORD</th>
                                        <th>STATUS</th>
                                        <th>DATE ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users_details as $users) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($users->id); ?></td>
                                            <td><?php echo htmlspecialchars($users->name); ?></td>
                                            <td><?php echo htmlspecialchars($users->email); ?></td>
                                            <td><?php echo htmlspecialchars($users->status); ?></td>
                                            <td><?php echo date("F j, Y", strtotime($users->date_added)); ?></td>
                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editRamModal<?php echo htmlspecialchars($users->id); ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="<?php echo base_url('delete-users/' . $users->id); ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>

                                        <!-- Edit Ram Modal -->
                                        <div class="modal fade" id="editRamModal<?php echo htmlspecialchars($users->id); ?>" tabindex="-1" aria-labelledby="editRamModalLabel<?php echo htmlspecialchars($users->id); ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editRamModalLabel<?php echo htmlspecialchars($users->id); ?>" style="margin-left:350px;">Edit User</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editForm<?php echo htmlspecialchars($users->id); ?>" action="<?php echo base_url('update-users/' . $users->id); ?>" method="POST">
                                                            <div class="form-group mb-3">
                                                                <label for="name" class="form-label">NAME</label>
                                                                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter your Name" value="<?php echo htmlspecialchars($users->name); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="email" class="form-label">EMAIL</label>
                                                                <input type="email" class="form-control" id="edit_email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($users->email); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="password" class="form-label">PASSWORD</label>
                                                                <input type="passowrd" class="form-control" id="edit_password" name="password" placeholder="Enter your Password" value="<?php echo htmlspecialchars($users->password); ?>">
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

        <!-- Add Ram Modal -->

        <div class="modal fade" id="addRamModal" tabindex="-1" aria-labelledby="addRamModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addRamForm" action="<?php echo base_url('add-users'); ?>" method="POST">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addRamModalLabel" style="margin-left:350px">Add User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">NAME</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">EMAIL</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">PASSWORD</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="insert" value="Add user" class="btn btn-primary btn-sm">
                            </div>
                    </form>
                    <!-- End Form -->
                </div>
                <!-- End Modal Body -->
            </div>
        </div>

        <!-- End Modal for Adding RAM -->
    </main>

    <?php include("includes/footer.php"); ?>
</body>

</html>