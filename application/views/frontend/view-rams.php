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
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Datatables</h5>
              <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p>

              <!-- Table with stripped rows -->
              <table class="table datatable">
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
                  <?php endforeach; ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include("includes/footer.php"); ?>
</body>
</html>