<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Storage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="jumbotron">
        <h1 align="center">Storage</h1>
    </div>
    <div class="container">
        <div class="clearfix">
            <h3 style="float:left;">All Storage</h3>
            <a href="#" class="btn btn-primary" style="float:right;" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Storage</a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>sorting</th>
                    <th>status</th>
                    <th>date_added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($storage_details as $storage) : ?>
                    <tr>
                        <td><?php echo $storage->id; ?></td>
                        <td><?php echo $storage->name; ?></td>
                        <td><?php echo $storage->sorting; ?></td>
                        <td><?php echo $storage->status; ?></td>
                        <td><?php echo $storage->date_added; ?></td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#editStorageModal<?php echo $storage->id; ?>" class="btn btn-success" href="<?php echo base_url('edit-storage/' . $storage->id); ?>">Edit</a>
                            <a class="btn btn-danger" href="<?php echo base_url('delete-storage/' . $storage->id); ?>">Delete</a>
                        </td>
                    </tr>

                    <!-- Edit Storage Modal -->
                    <div class="modal fade" id="editStorageModal<?php echo $storage->id; ?>" tabindex="-1" aria-labelledby="editStorageModalLabel<?php echo $storage->id; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="<?php echo base_url('update-storage/' . $storage->id); ?>" method="POST">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editStorageModalLabel<?php echo $storage->id; ?>">Edit Storage
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group mb-2">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $storage->name; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="sorting">Sorting</label>
                                            <input type="text" name="sorting" placeholder="Enter Sorting" class="form-control" value="<?php echo $storage->sorting; ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" name="insert" value="Update" class="btn btn-info">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Storage Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('add-storage'); ?>" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Storage
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </h1>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" placeholder="Enter Name" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="sorting">Sorting</label>
                            <input type="text" name="sorting" placeholder="Enter Sorting" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="insert" value="Add Storage" class="btn btn-info">
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