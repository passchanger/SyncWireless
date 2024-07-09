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
            <h1><?php echo isset($service) ? 'Edit' : 'Add'; ?> Service Center</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item active"><?php echo isset($service) ? 'Edit' : 'Add'; ?> Service Center</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <?php echo form_open(isset($service) ? 'update-service/' . $service->id : 'add-service/'); ?>
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Enter your Name" class="form-control" value="<?php echo isset($service) ? htmlspecialchars($service->name) : ''; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <input type="text" name="address" placeholder="Enter your Address" class="form-control" value="<?php echo isset($service) ? htmlspecialchars($service->address) : ''; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="city">City</label>
                                <input type="text" name="city" placeholder="Enter your City" class="form-control" value="<?php echo isset($service) ? htmlspecialchars($service->city) : ''; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="state">State</label>
                                <input type="text" name="state" placeholder="Enter your State" class="form-control" value="<?php echo isset($service) ? htmlspecialchars($service->state) : ''; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="pincode">Pincode</label>
                                <input type="number" name="pincode" placeholder="Enter your Pincode" class="form-control" value="<?php echo isset($service) ? htmlspecialchars($service->pincode) : ''; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="cp_name">Contact Person Name</label>
                                <input type="text" name="cp_name" placeholder="Enter your CP-Name" class="form-control" value="<?php echo isset($service) ? htmlspecialchars($service->cp_name) : ''; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="mobile">Mobile</label>
                                <input type="number" name="mobile" placeholder="Enter Mobile" class="form-control" value="<?php echo isset($service) ? htmlspecialchars($service->mobile) : ''; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" placeholder="Enter your Email" class="form-control" value="<?php echo isset($service) ? htmlspecialchars($service->email) : ''; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="latitude">Latitude</label>
                                <input type="number" name="latitude" placeholder="Enter your Latitude" class="form-control" value="<?php echo isset($service) ? htmlspecialchars($service->latitude) : ''; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="longitude">Longitude</label>
                                <input type="number" name="longitude" placeholder="Enter your Longitude" class="form-control" value="<?php echo isset($service) ? htmlspecialchars($service->longitude) : ''; ?>">
                            </div>
                            <?php if (isset($service)) : ?>
                                <div class="form-group mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Active" <?php echo (isset($service) && $service->status == 'Active') ? 'selected' : ''; ?>>Active</option>
                                        <option value="Inactive" <?php echo (isset($service) && $service->status == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <div class="text-start">
                                <button type="submit" class="btn btn-primary btn-sm"><?php echo isset($service) ? 'Update' : 'Add'; ?> Service</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include("includes/footer.php"); ?>
</body>

</html>