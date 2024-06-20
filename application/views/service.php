<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Service-Centres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="jumbotron">
        <h1 align="center">Service Centers</h1>
    </div>
    <div class="container">
        <div class="clearfix">
            <h3 style="float:left;">All Service Centres</h3>
            <a href="#" class="btn btn-primary" style="float:right;" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Service Centre</a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($service_details as $service) : ?>
                    <tr>
                        <td><?php echo $service->id; ?></td>
                        <td><?php echo $service->name; ?></td>
                        <td><?php echo $service->address; ?></td>
                        <td><?php echo $service->city; ?></td>
                        <td><?php echo $service->state; ?></td>
                        <td><?php echo $service->latitude; ?></td>
                        <td><?php echo $service->longitude; ?></td>
                        <td><?php echo $service->status; ?></td>
                        <td><?php echo $service->date_added; ?></td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#editServiceModal<?php echo $service->id; ?>" class="btn btn-success" href="#">Edit</a>
                            <a class="btn btn-danger" href="<?php echo base_url('delete-service/' . $service->id); ?>">Delete</a>
                        </td>
                    </tr>

                    <!-- Edit Service Modal -->
                    <div class="modal fade" id="editServiceModal<?php echo $service->id; ?>" tabindex="-1" aria-labelledby="editServiceModalLabel<?php echo $service->id; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="<?php echo base_url('update-service/' . $service->id); ?>" method="POST">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editServiceModalLabel<?php echo $service->id; ?>">Edit Service Centre
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group mb-2">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $service->name; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" placeholder="Enter Address" class="form-control" value="<?php echo $service->address; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="city">City</label>
                                            <input type="text" name="city" placeholder="Enter City" class="form-control" value="<?php echo $service->city; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="state">State</label>
                                            <input type="text" name="state" placeholder="Enter State" class="form-control" value="<?php echo $service->state; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="latitude">Latitude</label>
                                            <input type="number" name="latitude" placeholder="Enter Latitude" class="form-control" value="<?php echo $service->latitude; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="longitude">Longitude</label>
                                            <input type="number" name="longitude" placeholder="Enter Longitude" class="form-control" value="<?php echo $service->longitude; ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" name="insert" value="Update Service" class="btn btn-info">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Service Centre Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('add-service'); ?>" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Service Centre
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </h1>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" placeholder="Enter Name" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="address">Address</label>
                            <input type="text" name="address" placeholder="Enter Address" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="city">City</label>
                            <input type="text" name="city" placeholder="Enter City" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="state">State</label>
                            <input type="text" name="state" placeholder="Enter State" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="latitude">Latitude</label>
                            <input type="number" name="latitude" placeholder="Enter Latitude" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="longitude">Longitude</label>
                            <input type="number" name="longitude" placeholder="Enter Longitude" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="insert" value="Add Service Centre" class="btn btn-info">
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