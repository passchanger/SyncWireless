<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Setting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="jumbotron">
        <h1 align="center">Setting</h1>
    </div>
    <div class="container">
        <div class="clearfix">
            <h3 style="float:left;">All Setting</h3>
            <a href="#" class="btn btn-primary" style="float:right;" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Setting</a>
        </div>
        <table class="table table-striped table-hover">
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
                            <a data-bs-toggle="modal" data-bs-target="#editSettingModal<?php echo $setting->id; ?>" class="btn btn-success" href="<?php echo base_url('edit-setting/' . $setting->id); ?>">Edit</a>
                            <a class="btn btn-danger" href="<?php echo base_url('delete-setting/' . $setting->id); ?>">Delete</a>
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
                                        <div class="form-group mb-2">
                                            <label for="name">Sitename</label>
                                            <input type="text" name="sitename" placeholder="Enter Sitename" class="form-control" value="<?php echo $setting->sitename; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="email">Siteemail</label>
                                            <input type="email" name="siteemail" placeholder="Enter Siteemail" class="form-control" value="<?php echo $setting->siteemail; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="number">Sitemobile</label>
                                            <input type="number" name="sitemobile" placeholder="Enter Sitemobile" class="form-control" value="<?php echo $setting->sitemobile; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="pg_creds">pg_creds</label>
                                            <input type="text" name="pg_creds" placeholder="Enter pg_creds" class="form-control" value="<?php echo $setting->pg_creds; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="ga_creds">ga_creds</label>
                                            <input type="text" name="ga_creds" placeholder="Enter ga_creds" class="form-control" value="<?php echo $setting->ga_creds; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="tag_manager">Tag_Manager</label>
                                            <input type="text" name="tag_manager" placeholder="Enter Tag_Manager" class="form-control" value="<?php echo $setting->tag_manager; ?>">
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
    </div>

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
                        <div class="form-group mb-2">
                            <label for="name">Sitename</label>
                            <input type="text" name="sitename" placeholder="Enter Sitename" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Siteemail</label>
                            <input type="email" name="siteemail" placeholder="Enter Siteemail" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="number">Sitemobile</label>
                            <input type="number" name="sitemobile" placeholder="Enter Sitemobile" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="pg_creds">pg_creds</label>
                            <input type="text" name="pg_creds" placeholder="Enter pg_creds" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="ga_creds">ga_creds</label>
                            <input type="text" name="ga_creds" placeholder="Enter ga_creds" class="form-control">
                        </div>
                        <div class="form-group mb-2">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>