<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Repairing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="jumbotron">
        <h1 align="center">Repairing</h1>
    </div>
    <div class="container">
        <div class="clearfix">
            <h3 style="float:left;">All Repairing</h3>
            <a href="#" class="btn btn-primary" style="float:right;" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Repairing Issue</a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Issue</th>
                    <th>sorting</th>
                    <th>status</th>
                    <th>date_added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($repairing_details as $repairing) : ?>
                    <tr>
                        <td><?php echo $repairing->id; ?></td>
                        <td><?php echo $repairing->issue; ?></td>
                        <td><?php echo $repairing->sorting; ?></td>
                        <td><?php echo $repairing->status; ?></td>
                        <td><?php echo $repairing->date_added; ?></td>
                        <td><a data-bs-toggle="modal" data-bs-target="#editRepairModal<?php echo $repairing->id; ?>" class="btn btn-success" href="#">Edit</a></td>
                        <td><a class="btn btn-danger" href="<?php echo base_url('delete-repair/' . $repairing->id); ?>">Delete</a></td>
                    </tr>

                    <!-- Edit Repair Modal -->
                    <div class="modal fade" id="editRepairModal<?php echo $repairing->id; ?>" tabindex="-1" aria-labelledby="editRepairModalLabel<?php echo $repairing->id; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="<?php echo base_url('update-repair/' . $repairing->id); ?>" method="POST">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editRepairModalLabel<?php echo $repairing->id; ?>">Edit Repair Issue
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group mb-2">
                                            <label for="issue">Issue</label>
                                            <input type="text" name="issue" placeholder="Enter Issue" class="form-control" value="<?php echo $repairing->issue; ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="sorting">Sorting</label>
                                            <input type="text" name="sorting" placeholder="Enter Sorting no." class="form-control" value="<?php echo $repairing->sorting; ?>">
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

    <!-- Add Repair Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('add-repair'); ?>" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Repair Issue
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </h1>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="issue">Issue</label>
                            <input type="text" name="issue" placeholder="Enter Issue" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="sorting">Sorting</label>
                            <input type="text" name="sorting" placeholder="Enter Sorting no." class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="insert" value="Add Repair Issue" class="btn btn-info">
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