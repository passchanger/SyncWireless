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
            <h1>Repairing Issues</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active">View-Repairing-issues</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 style="float:left;">All Repairing</h3>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Repairing-issue</a>
                        </div>
                        <div class="card-body">

                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('inserted')) : ?>
                                <div class="alert alert-success alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('inserted')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('updated')) : ?>
                                <div class="alert alert-success alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('updated')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('deleted')) : ?>
                                <div class="alert alert-success alert-dismissible fade show text-start justify-content-start" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('deleted')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>BRAND</th>
                                        <th>MODEL</th>
                                        <th>ISSSUE-NAME</th>
                                        <th>ISSSUE-PRICE</th>
                                        <th>STATUS</th>
                                        <th>DATE-ADDED</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php foreach ($repairing_details as $repairing) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($counter); ?></td>
                                            <td><?php echo htmlspecialchars($repairing->brand_name); ?></td>
                                            <td><?php echo htmlspecialchars($repairing->model_name); ?></td>
                                            <td><?php echo htmlspecialchars($repairing->issue_name); ?></td>
                                            <td><?php echo htmlspecialchars($repairing->issue_price); ?></td>
                                            <td><?php echo htmlspecialchars($repairing->status); ?></td>
                                            <td><?php echo date("F j, Y", strtotime($repairing->date_added)); ?></td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#editRepairModal<?php echo $repairing->id; ?>" class="btn btn-primary btn-sm" href="#">Edit</a>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('delete-repair/' . $repairing->id); ?>">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $counter++; ?>

                                        <!-- Edit Repair Modal -->
                                        <div class="modal fade" id="editRepairModal<?php echo $repairing->id; ?>" tabindex="-1" aria-labelledby="editRepairModalLabel<?php echo $repairing->id; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?php echo base_url('update-repair/' . $repairing->id); ?>" method="POST">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="editRepairModalLabel<?php echo $repairing->id; ?>" style="margin-left: 280px;">Edit Repair Issue
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </h1>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group mb-3">
                                                                <label for="brand_id" class="form-label">Select Brand</label>
                                                                <select class="form-control" name="brand_id" id="brand_id<?php echo $repairing->id; ?>" required>
                                                                    <option disabled>Select Brand</option>
                                                                    <?php foreach ($brands as $brand) { ?>
                                                                        <option value="<?php echo $brand['id']; ?>" <?php echo ($repairing->brand_id == $brand['id']) ? 'selected' : ''; ?>>
                                                                            <?php echo htmlspecialchars($brand['name']); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <label for="model_id" class="form-label">Select Model</label>
                                                                <select class="form-control" name="model_id" id="model_id<?php echo $repairing->id; ?>" required>
                                                                    <option disabled>Select Model</option>
                                                                    <?php foreach ($models[$repairing->brand_id] as $model) { ?>
                                                                        <option value="<?php echo $model['id']; ?>" <?php echo ($repairing->model_id == $model['id']) ? 'selected' : ''; ?>>
                                                                            <?php echo htmlspecialchars($model['name']); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                            <script>
                                                                $(document).ready(function() {
                                                                    $('#brand_id<?php echo $repairing->id; ?>').on('change', function() {
                                                                        var brand_id = $(this).val();
                                                                        if (brand_id != '') {
                                                                            $.ajax({
                                                                                url: '<?php echo base_url("select-id"); ?>',
                                                                                type: 'POST',
                                                                                data: {
                                                                                    brand_id: brand_id
                                                                                },
                                                                                dataType: 'json',
                                                                                success: function(response) {
                                                                                    var modelSelect = $('#model_id<?php echo $repairing->id; ?>');
                                                                                    modelSelect.html('<option value="">Select Model</option>');
                                                                                    $.each(response, function(index, data) {
                                                                                        modelSelect.append('<option value="' + data.id + '">' + data.name + '</option>');
                                                                                    });
                                                                                    modelSelect.prop('disabled', false);
                                                                                },
                                                                                error: function(xhr, status, error) {
                                                                                    console.error('Error:', error);
                                                                                }
                                                                            });
                                                                        } else {
                                                                            $('#model_id<?php echo $repairing->id; ?>').html('<option disabled selected>Select Brand first</option>').prop('disabled', true);
                                                                        }
                                                                    });
                                                                });
                                                            </script>

                                                            <div class="form-group mb-3">
                                                                <label for="issue">Issue Name</label>
                                                                <input type="text" name="issue_name" placeholder="Enter your Issue" class="form-control" value="<?php echo htmlspecialchars($repairing->issue_name); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="number">Issue Price</label>
                                                                <input type="number" name="issue_price" placeholder="Enter your Issue Price" class="form-control" value="<?php echo htmlspecialchars($repairing->issue_price); ?>">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="status">Status</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="active" <?php echo ($repairing->status == 'active') ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="inactive" <?php echo ($repairing->status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="sorting">Sorting</label>
                                                                <input type="text" name="sorting" placeholder="Enter Sorting no." class="form-control" value="<?php echo htmlspecialchars($repairing->sorting); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                            <input type="submit" name="insert" value="Update" class="btn btn-primary btn-sm">
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
        <!-- Add Repair Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo base_url('add-repair'); ?>" method="POST">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="
                            margin-left:280px">Add Repair Issue </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="brand_id" class="form-label">Select Brand</label>
                                <select class="form-control" name="brand_id" id="brand_id" required>
                                    <option selected>Select Brand</option>
                                    <?php foreach ($brands as $brand) { ?>
                                        <option value="<?php echo $brand['id']; ?>"><?php echo htmlspecialchars($brand['name']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="model_id" class="form-label">Select Model</label>
                                <select class="form-control" name="model_id" id="model_id" required>
                                    <option disabled selected>Select Model</option>
                                </select>
                            </div>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('#brand_id').on('change', function() {
                                        var brand_id = $(this).val();
                                        if (brand_id != '') {
                                            $.ajax({
                                                url: '<?php echo base_url("select-id"); ?>',
                                                type: 'POST',
                                                data: {
                                                    brand_id: brand_id
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    $('#model_id').html('<option value="">Select Model</option>');
                                                    $.each(response, function(index, data) {
                                                        $('#model_id').append('<option value="' + data.id + '">' + data.name + '</option>');
                                                    });
                                                    $('#model_id').prop('disabled', false);
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error('Error:', error);
                                                }
                                            });
                                        } else {
                                            $('#model_id').html('<option disabled selected>Select Brand first</option>').prop('disabled', true);
                                        }
                                    });
                                });
                            </script>

                            <div class="form-group mb-3">
                                <label for="issue">Issue Name</label>
                                <input type="text" name="issue_name" placeholder="Enter your Issue" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="number">Issue Price</label>
                                <input type="number" name="issue_price" placeholder="Enter your Issue Price" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="sorting">Sorting</label>
                                <input type="text" name="sorting" placeholder="Enter Sorting no." class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="insert" value="Add Repair-issue" class="btn btn-primary btn-sm">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <?php include("includes/footer.php"); ?>
</body>

</html>