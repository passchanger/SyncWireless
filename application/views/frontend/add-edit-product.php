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
            <h1><?php echo $title; ?></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('product'); ?>">Products</a></li>
                    <li class="breadcrumb-item active"><?php echo $title; ?></li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3><?php echo $title; ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo isset($singleproduct) ? base_url('update-product/' . $singleproduct->id) : base_url('create-product'); ?>" method="post">
                                <div class="form-group mb-3">
                                    <label for="brand_id">Brand</label>
                                    <select class="form-control" id="brand_id" name="brand_id" required>
                                        <option value="" disabled <?php echo !isset($singleproduct) ? 'selected' : ''; ?>>Select Brand</option>
                                        <?php foreach ($brands as $brand) : ?>
                                            <option value="<?php echo $brand['id']; ?>" <?php echo (isset($singleproduct) && $singleproduct->brand_id == $brand['id']) ? 'selected' : ''; ?>><?php echo $brand['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="model_id">Model</label>
                                    <select class="form-control" id="model_id" name="model_id" required>
                                        <option value="" disabled <?php echo !isset($singleproduct) ? 'selected' : ''; ?>>Select Model</option>
                                        <?php foreach ($models as $model) : ?>
                                            <option value="<?php echo $model['id']; ?>" <?php echo (isset($singleproduct) && $singleproduct->model_id == $model['id']) ? 'selected' : ''; ?>><?php echo $model['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($singleproduct) ? $singleproduct->name : ''; ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="<?php echo isset($singleproduct) ? $singleproduct->price : ''; ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" required><?php echo isset($singleproduct) ? $singleproduct->description : ''; ?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="key_specification">Key Specification</label>
                                    <textarea class="form-control" id="key_specification" name="key_specification" required><?php echo isset($singleproduct) ? $singleproduct->key_specification : ''; ?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="refund_policy">Refund Policy</label>
                                    <textarea class="form-control" id="refund_policy" name="refund_policy" required><?php echo isset($singleproduct) ? $singleproduct->refund_policy : ''; ?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="active" <?php echo (isset($singleproduct) && $singleproduct->status == 'active') ? 'selected' : ''; ?>>Active</option>
                                        <option value="inactive" <?php echo (isset($singleproduct) && $singleproduct->status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <?php
                                    foreach ($variationCatg as $variationCat) {
                                        //var_dump($variationCat); 
                                    ?>
                                        <div class="col-md-6">
                                            <?php
                                            $sqlGetVariations = "select id, name from variation where cat_id = '" . $variationCat['id'] . "'";
                                            $getVariations = $this->db->query($sqlGetVariations)->result_array();

                                            if (sizeof($getVariations) > 0) { ?>
                                                <label for="variation_cat" class="mb-2">Choose <?php echo $variationCat['name']; ?></label><br>
                                                <?php
                                                foreach ($getVariations as $variations) { ?>
                                                    <input type="radio" name="variations[<?php echo 'varcat#' . $variationCat['id']; ?>]" value="<?php echo $variations['id']; ?>" id="variations<?php echo $variations['id']; ?>" required>
                                                    <label for="variations<?php echo $variations['id']; ?>"><?php echo $variations['name']; ?></label>
                                                    <br>
                                            <?php }
                                            } ?>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <button type="submit" class="btn btn-primary"><?php echo isset($singleproduct) ? 'Update' : 'Add'; ?> Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include("includes/footer.php"); ?>
</body>

</html>