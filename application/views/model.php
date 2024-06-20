<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Model</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="jumbotron">
        <h1 align="center">Model</h1>
    </div>
    <div class="container">
        <div class="clearfix">
            <h3 style="float:left;">All Models</h3>
            <a href="#" class="btn btn-primary" style="float:right;" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Model</a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>brand id</th>
                    <th>name</th>
                    <th>features</th>
                    <th>description</th>
                    <th>status</th>
                    <th>date_added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Model_details as $models) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($models->id); ?></td>
                        <td><?php echo htmlspecialchars($models->brand_id); ?></td>
                        <td><?php echo htmlspecialchars($models->name); ?></td>
                        <td><?php echo htmlspecialchars($models->features); ?></td>
                        <td><?php echo htmlspecialchars($models->description); ?></td>
                        <td><?php echo htmlspecialchars($models->status); ?></td>
                        <td><?php echo htmlspecialchars($models->date_added); ?></td>
                        <td><a data-bs-toggle="modal" data-bs-target="#exampleModall" class="btn btn-success" href="<?php echo base_url('edit-model/' . $models->id); ?>">Edit</a></td>
                        <td><a class="btn btn-danger" href="<?php echo base_url('delete-model/' . $models->id); ?>">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
                <!-- Modal for Edit Model -->
                <div class="modal fade" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="<?php echo base_url('update-model/' . $models->id); ?>" method="POST">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Model
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group mb-2">
                                        <label for="brand_id">BRAND ID</label>
                                        <input type="number" name="brand_id" placeholder="Enter Brand ID" class="form-control" value="<?php echo htmlspecialchars($models->brand_id); ?>">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="name">NAME</label>
                                        <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo htmlspecialchars($models->name); ?>">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="features">FEATURES</label>
                                        <input type="text" name="features" placeholder="Enter Features" class="form-control" value="<?php echo htmlspecialchars($models->features); ?>">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="description">DESCRIPTION</label>
                                        <textarea name="description" placeholder="Enter Description" class="form-control"><?php echo htmlspecialchars($models->description); ?></textarea>
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
            </tbody>
        </table>
    </div>

    <!-- Modal for Add Model -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('add-model'); ?>" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Model
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="brand_id">BRAND ID</label>
                            <input type="number" name="brand_id" placeholder="Enter Brand ID" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="name">NAME</label>
                            <input type="text" name="name" placeholder="Enter Name" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="features">FEATURES</label>
                            <input type="text" name="features" placeholder="Enter Features" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">DESCRIPTION</label>
                            <textarea name="description" placeholder="Enter Description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="insert" value="Add Model" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>