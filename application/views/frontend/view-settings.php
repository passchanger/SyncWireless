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
            <h1></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-rams</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3></h3>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRamModal">Add Settings</a>
                        </div>
                        <div class="card-body">


                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Sitename</th>
                                        <th>Siteemails</th>
                                        <th>Sitemobile</th>
                                        <th>pg_creds</th>
                                        <th>ga_creds</th>
                                        <th>Tag_Manager</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($setting_details as $setting) : ?>
                                        <tr>
                                            <td><?php echo $setting->id; ?></td>
                                            <td><?php echo $setting->sitename; ?></td>
                                            <td><?php echo $setting->siteemail; ?></td>
                                            <td><?php echo $setting->sitemobile; ?></td>
                                            <td><?php echo $setting->pg_creds; ?></td>
                                            <td><?php echo $setting->ga_creds; ?></td>
                                            <td><?php echo $setting->tag_manager; ?></td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#editSettingModal<?php echo $setting->id; ?>" class="btn btn-primary btn-sm" href="<?php echo base_url('edit-setting/' . $setting->id); ?>">Edit</a>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('delete-setting/' . $setting->id); ?>">Delete</a>
                                            </td>
                                        </tr>

                                        <!-- Edit Setting Modal -->
                                        <div class="modal fade" id="editSettingModal<?php echo $setting->id; ?>" tabindex="-1" aria-labelledby="editSettingModalLabel<?php echo $setting->id; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?php echo base_url('update-setting/' . $setting->id); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editSettingModalLabel<?php echo $setting->id; ?>">Edit Setting
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </h1>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label for="name">Sitename</label>
                                                                <input type="text" name="sitename" placeholder="Enter Sitename" class="form-control" value="<?php echo htmlspecialchars($setting->sitename); ?>" >
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="email">Siteemail</label>
                                                                <input type="email" name="siteemail" placeholder="Enter Siteemail" class="form-control"value="<?php echo htmlspecialchars($setting->siteemail); ?>" >
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="number">Sitemobile</label>
                                                                <input type="number" name="sitemobile" placeholder="Enter Sitemobile" class="form-control" value="<?php echo htmlspecialchars($setting->sitemobile); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="pg_creds">pg_creds</label>
                                                                <input type="text" name="pg_creds" placeholder="Enter pg_creds" class="form-control" value="<?php echo htmlspecialchars($setting->pg_creds); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="ga_creds">ga_creds</label>
                                                                <input type="text" name="ga_creds" placeholder="Enter ga_creds" class="form-control" value="<?php echo htmlspecialchars($setting->ga_creds); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="tag_manager">Tag_Manager</label>
                                                                <input type="text" name="tag_manager" placeholder="Enter Tag_Manager" class="form-control" value="<?php echo htmlspecialchars($setting->Tag_manager); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <input type="submit" name="insert" value="Update Setting" class="btn btn-info">
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
        <!-- Add Setting Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo base_url('add-setting'); ?>" method="POST">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Setting
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </h1>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="name">Sitename</label>
                                <input type="text" name="sitename" placeholder="Enter Sitename" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Siteemail</label>
                                <input type="email" name="siteemail" placeholder="Enter Siteemail" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="number">Sitemobile</label>
                                <input type="number" name="sitemobile" placeholder="Enter Sitemobile" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="pg_creds">pg_creds</label>
                                <input type="text" name="pg_creds" placeholder="Enter pg_creds" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="ga_creds">ga_creds</label>
                                <input type="text" name="ga_creds" placeholder="Enter ga_creds" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="tag_manager">Tag_Manager</label>
                                <input type="text" name="tag_manager" placeholder="Enter Tag_Manager" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="insert" value="Add Setting" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('error')) : ?>
            <div align="center" style="color:#fff" class="bg-danger">
                <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('inserted')) : ?>
            <div align="center" style="color:#fff" class="bg-success">
                <?php echo htmlspecialchars($this->session->flashdata('inserted')); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('updated')) : ?>
            <div align="center" style="color:#fff" class="bg-success">
                <?php echo htmlspecialchars($this->session->flashdata('updated')); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('deleted')) : ?>
            <div align="center" style="color:#fff" class="bg-success">
                <?php echo htmlspecialchars($this->session->flashdata('deleted')); ?>
            </div>
        <?php endif; ?>

    </main><!-- End #main -->

    <?php include("includes/footer.php"); ?>
</body>

</html>