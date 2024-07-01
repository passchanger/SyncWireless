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
      <h1>Variants</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Master Data</li>
          <li class="breadcrumb-item active">View-variants</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h3></h3>
              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRamModal">Add Variants</a>

            </div>

            <div class="card-body">

              <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show text-end justify-content-end" role="alert">
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
                    <th>STATUS</th>
                    <th>DATE ADDED</th>
                    <th>ACTIONS</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter = 1; ?>
                  <?php foreach ($ram_details as $ram) : ?>
                    <tr>
                      <td><?php echo htmlspecialchars($counter); ?></td>
                      <td><?php echo htmlspecialchars($ram->name); ?></td>
                      <td><?php echo htmlspecialchars($ram->status); ?></td>
                      <td><?php echo date("F j, Y", strtotime($ram->date_added)); ?></td>
                      <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#editRamModal<?php echo htmlspecialchars($ram->id); ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="<?php echo base_url('delete-ram/' . $ram->id); ?>" class="btn btn-danger btn-sm">Delete</a>
                      </td>
                    </tr>
                    <?php $counter++; ?>
                    <!-- Edit Ram Modal -->
                    <div class="modal fade" id="editRamModal<?php echo htmlspecialchars($ram->id); ?>" tabindex="-1" aria-labelledby="editRamModalLabel<?php echo htmlspecialchars($ram->id); ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editRamModalLabel<?php echo htmlspecialchars($ram->id); ?>" style="margin-left:350px;">Edit Ram</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form id="editForm<?php echo htmlspecialchars($ram->id); ?>" action="<?php echo base_url('update-ram/' . $ram->id); ?>" method="POST">
                              <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter Name" value="<?php echo htmlspecialchars($ram->name); ?>">
                              </div>
                              <div class="form-group mb-3">
                                <label for="cat_id" class="form-label">Category ID</label>
                                <input type="text" class="form-control" id="edit_cat_id" name="cat_id" placeholder="Enter Category ID" value="<?php echo htmlspecialchars($ram->cat_id); ?>">
                              </div>
                              <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                  <option value="active" <?php echo ($ram->status == 'active') ? 'selected' : ''; ?>>Active</option>
                                  <option value="inactive" <?php echo ($ram->status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                              </div>
                              <div class="form-group mb-3">
                                <label for="resources" class="form-label">Resources</label>
                                <input type="text" class="form-control" id="edit_resources" name="resources" placeholder="Enter Resources" value="<?php echo htmlspecialchars($ram->resources); ?>">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="insert" value="Update Ram" class="btn btn-primary btn-sm">
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

    <!-- Add Ram Modal -->
    <div class="modal fade" id="addRamModal" tabindex="-1" aria-labelledby="addRamModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="addRamForm" action="<?php echo base_url('add-ram'); ?>" method="POST">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addRamModalLabel" style="margin-left:350px">Add Variant</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-group mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
              </div>
              <div class="form-group mb-3">
                <label for="cat_id" class="form-label">Category ID</label>
                <input type="text" class="form-control" id="cat_id" name="cat_id" placeholder="Enter Category ID">
              </div>
              <div class="form-group mb-3">
                <label for="resources" class="form-label">Resources</label>
                <input type="text" class="form-control" id="resources" name="resources" placeholder="Enter Resources">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <input type="submit" name="insert" value="Add Variant" class="btn btn-primary btn-sm">
              </div>
          </form>
          <!-- End Form -->
        </div>
        <!-- End Modal Body -->
      </div>
    </div>
    <!-- End Modal for Adding RAM -->


    <!-- End Modal for Adding RAM -->
  </main><!-- End #main -->

  <?php include("includes/footer.php"); ?>
</body>

</html>