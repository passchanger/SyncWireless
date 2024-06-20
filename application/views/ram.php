<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ram</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="jumbotron">
        <h1 align="center">Ram</h1>
    </div>
    <div class="container">
        <div class="clearfix">
            <h3 style="float:left;">All Ram</h3>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRamModal">Add Ram</a>
        </div>
        <table class="table table-bordered" id="datatable" width="100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Sorting</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ram_details as $ram) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ram->id); ?></td>
                        <td><?php echo htmlspecialchars($ram->name); ?></td>
                        <td><?php echo htmlspecialchars($ram->sorting); ?></td>
                        <td><?php echo htmlspecialchars($ram->status); ?></td>
                        <td><?php echo htmlspecialchars($ram->date_added); ?></td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editRamModal<?php echo htmlspecialchars($ram->id); ?>" class="btn btn-primary">Edit</a>
                            <a href="<?php echo base_url('delete-ram/' . $ram->id); ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>

                    <!-- Edit Ram Modal -->
                    <div class="modal fade" id="editRamModal<?php echo htmlspecialchars($ram->id); ?>" tabindex="-1" aria-labelledby="editRamModalLabel<?php echo htmlspecialchars($ram->id); ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editRamModalLabel<?php echo htmlspecialchars($ram->id); ?>">Edit Ram</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editForm<?php echo htmlspecialchars($ram->id); ?>" action="<?php echo base_url('update-ram/' . $ram->id); ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">NAME</label>
                                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter your Name" value="<?php echo htmlspecialchars($ram->name); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="sorting" class="form-label">SORTING</label>
                                            <input type="number" class="form-control" id="edit_sorting" name="sorting" placeholder="Enter your Sorting" value="<?php echo htmlspecialchars($ram->sorting); ?>">
                                        </div>
                                        <button type="submit" class="btn btn-warning mt-3">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <!-- Add Ram Modal -->
    <div class="modal fade" id="addRamModal" tabindex="-1" aria-labelledby="addRamModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addRamModalLabel">Add Ram</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addRamForm" action="<?php echo base_url('add-ram'); ?>" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label for="sorting" class="form-label">Sorting</label>
                            <input type="number" class="form-control" id="sorting" name="sorting" placeholder="Enter Sorting">
                        </div>
                        <button type="submit" class="btn btn-warning mt-3">Save & Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php if ($this->session->flashdata('error')) : ?>
        <div align="center" style="color: #FFF" class="bg-danger">
            <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('inserted')) : ?>
        <div align="center" style="color: #FFF" class="bg-success">
            <?php echo htmlspecialchars($this->session->flashdata('inserted')); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('updated')) : ?>
        <div align="center" style="color: #FFF" class="bg-success">
            <?php echo htmlspecialchars($this->session->flashdata('updated')); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('deleted')) : ?>
        <div align="center" style="color: #FFF" class="bg-warning">
            <?php echo htmlspecialchars($this->session->flashdata('deleted')); ?>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>