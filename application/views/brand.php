<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="jumbotron">
        <h1 align="center">Brand</h1>
    </div>
    <div class="container">
        <div class="clearfix">
            <h3 style="float:left;">All Brands</h3>
            <a href="#" class="btn btn-primary" style="float:right;" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Brand</a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>logo</th>
                    <th>sorting</th>
                    <th>description</th>
                    <th>date_added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($product_details as $products) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($products->id); ?></td>
                        <td><?php echo htmlspecialchars($products->name); ?></td>
                        <td><?php echo htmlspecialchars($products->logo); ?></td>
                        <td><?php echo htmlspecialchars($products->sorting); ?></td>
                        <td><?php echo htmlspecialchars($products->description); ?></td>
                        <td><?php echo htmlspecialchars($products->date_added); ?></td>
                        <td><a data-bs-toggle="modal" data-bs-target="#exampleModall" class="btn btn-success" href="<?php echo base_url('edit-Brand/' . $products->id); ?>">Edit</a></td>
                        <td><a class="btn btn-danger" href="<?php echo base_url('delete-Brand/' . $products->id); ?>">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
                <div class="modal fade" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="<?php echo base_url('update-Brand/' . $products->id); ?>" method="POST">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Brand
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group mb-2">
                                        <label for="name">NAME</label>
                                        <input type="text" name="name" placeholder="Enter your Name" class="form-control" value="<?php echo htmlspecialchars($products->name); ?>">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="sorting">SORTING</label>
                                        <input type="number" name="sorting" placeholder="Enter your Sorting no." class="form-control" value="<?php echo htmlspecialchars($products->sorting); ?>">
                                    </div>
                                    <div class=" form-group mb-2">
                                        <label for="description">DESCRIPTION</label>
                                        <textarea name="description" placeholder="Enter your description" class="form-control"><?php echo htmlspecialchars($products->description); ?></textarea>
                                    </div>
                                </div>
                                <div class=" modal-footer">
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

    <!-- Add Brand Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('add-Brand'); ?>" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brand
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="name">NAME</label>
                            <input type="text" name="name" placeholder="Enter your Name" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="sorting">SORTING</label>
                            <input type="number" name="sorting" placeholder="Enter your Sorting no." class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">DESCRIPTION</label>
                            <textarea name="description" placeholder="Enter your description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="insert" value="Add Brand" class="btn btn-info">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz