<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title . " - " . SITENAME; ?></title>
    <?php include('includes/style.php'); ?>
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php include("includes/sidebar.php"); ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Products</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Products</h3>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</a>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('inserted')) : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('inserted')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('updated')) : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('updated')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('deleted')) : ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <?php echo htmlspecialchars($this->session->flashdata('deleted')); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Brand ID</th>
                                        <th>Model ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Key Specification</th>
                                        <th>Refund-Policy</th>
                                        <th>Status</th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($product_details as $product) : ?>
                                        <tr>
                                            <td><?php echo $product->id; ?></td>
                                            <td><?php echo $product->brand_id; ?></td>
                                            <td><?php echo $product->model_id; ?></td>
                                            <td><?php echo $product->name; ?></td>
                                            <td><?php echo $product->price; ?></td>
                                            <td><?php echo $product->description; ?></td>
                                            <td><?php echo $product->key_specification; ?></td>
                                            <td><?php echo $product->refund_policy; ?></td>
                                            <td><?php echo $product->status; ?></td>
                                            <td><?php echo date("F j, Y", strtotime($product->date_added)); ?></td>
                                            <td>
                                                <a data-bs-toggle="modal" data-bs-target="#editProductModal<?php echo $product->id; ?>" class="btn btn-primary btn-sm" href="<?php echo base_url('edit-product/' . $product->id); ?>">Edit</a>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('delete-product/' . $product->id); ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                            </td>
                                        </tr>
                                        <!-- Edit Product Modal -->
                                        <div class="modal fade" id="editProductModal<?php echo $product->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?php echo base_url('update-product/' . $product->id); ?>" method="post">
                                                            <div class="form-group">
                                                                <label for="brand_id">Brand ID</label>
                                                                <input type="text" class="form-control" id="brand_id" name="brand_id" value="<?php echo $product->brand_id; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="model_id">Model ID</label>
                                                                <input type="text" class="form-control" id="model_id" name="model_id" value="<?php echo $product->model_id; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product->name; ?>" required>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label for="image">Image</label>
                                                                <input type="text" class="form-control" id="image" name="image" value="<?php echo $product->image; ?>" required>
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label for="price">Price</label>
                                                                <input type="number" class="form-control" id="price" name="price" value="<?php echo $product->price; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <textarea class="form-control" id="description" name="description" required><?php echo $product->description; ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="key_specification">Key Specification</label>
                                                                <textarea class="form-control" id="key_specification" name="key_specification" required><?php echo $product->key_specification; ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="refund_policy">Refund Policy</label>
                                                                <textarea class="form-control" id="refund_policy" name="refund_policy" required><?php echo $product->refund_policy; ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select class="form-control" id="status" name="status" required>

                                                                    <option value="1" <?php echo ($product->status == 1) ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="0" <?php echo ($product->status == 0) ? 'selected' : ''; ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Update Product</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <!-- Add Product Modal -->
                            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo base_url('add-product'); ?>" method="post">
                                                <div class="form-group">
                                                    <label for="brand_id">Brand ID</label>
                                                    <input type="text" class="form-control" id="brand_id" name="brand_id" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="model_id">Model ID</label>
                                                    <input type="text" class="form-control" id="model_id" name="model_id" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="text" class="form-control" id="image" name="image" required>
                                                </div> -->
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="number" class="form-control" id="price" name="price" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" id="description" name="description" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="key_specification">Key Specification</label>
                                                    <textarea class="form-control" id="key_specification" name="key_specification" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="refund_policy">Refund Policy</label>
                                                    <textarea class="form-control" id="refund_policy" name="refund_policy" required></textarea>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="" disbaled selected>Select Status</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Add Product</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include("includes/footer.php"); ?>
</body>

</html>