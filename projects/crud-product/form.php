<?php
// Show PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once 'classes/product.php';

$objProduct = new Product();

// GET
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $stmt = $objProduct->runQuery("SELECT * FROM product WHERE id=:id");
    $stmt->execute(array(":id" => $id));
    $rowProduct = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $id = null;
    $rowProduct = null;
}

// POST
if (isset($_POST['btn_save'])) {
    $product_name = strip_tags($_POST['product_name']);
    $price_buy = strip_tags($_POST['price_buy']);
    $price_sell = strip_tags($_POST['price_sell']);
    $stock = strip_tags($_POST['stock']);

    // Handle image upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['size'] > 0) {
        $file_name = $_FILES['product_image']['name'];
        $file_tmp = $_FILES['product_image']['tmp_name'];
        $file_size = $_FILES['product_image']['size'];
        $file_type = $_FILES['product_image']['type'];
        $file_ext = strtolower(end(explode('.', $file_name)));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            echo "Extension not allowed, please choose a JPEG or PNG file.";
            exit();
        }

        if ($file_size > 100000) {
            echo 'File size must be less than 100 KB';
            exit();
        }

        move_uploaded_file($file_tmp, "uploads/" . $file_name);
        $product_image = "uploads/" . $file_name;
    } else {
        $product_image = $rowProduct['product_image'];
    }

    try {
        if ($id != null) {
            if ($objProduct->update($product_name, $price_buy, $price_sell, $stock, $product_image, $id)) {
                $objProduct->redirect('index.php?updated');
            } else {
                $objProduct->redirect('index.php?error');
            }
        } else {
            if ($objProduct->insert($product_name, $price_buy, $price_sell, $stock, $product_image)) {
                $objProduct->redirect('index.php?inserted');
            } else {
                $objProduct->redirect('index.php?error');
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Head metas, css, and title -->
    <?php require_once 'includes/head.php'; ?>
</head>

<body>
    <!-- Header banner -->
    <?php require_once 'includes/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar menu -->
            <?php require_once 'includes/sidebar.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <h1 style="margin-top: 10px">Form Product</h1>
                <p>Required fields are in (*).</p>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" readonly value="<?php print($rowProduct['id'] ?? ''); ?>" placeholder="ID auto generate">
                    </div>
                    <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" class="form-control" id="product_image" name="product_image" accept="image/jpeg, image/png" onchange="previewImage()">
                        <small class="form-text text-muted">Max file size 100KB</small>
                        <?php if (isset($rowProduct['product_image'])) : ?>
                            <img src="<?php echo $rowProduct['product_image']; ?>" width="100" id="preview">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="product_name">Product Name *</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php print($rowProduct['product_name'] ?? ''); ?>" placeholder="Input your product name" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="price_buy">Price Buy *</label>
                        <input type="number" class="form-control" id="price_buy" name="price_buy" value="<?php print($rowProduct['price_buy'] ?? ''); ?>" placeholder="Input your price buy" required>
                    </div>
                    <div class="form-group">
                        <label for="price_sell">Price Sell *</label>
                        <input type="number" class="form-control" id="price_sell" name="price_sell" value="<?php print($rowProduct['price_sell'] ?? ''); ?>" placeholder="Input your price sell" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock *</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="<?php print($rowProduct['stock'] ?? ''); ?>" placeholder="Input your stock" required>
                    </div>
                    <input type="submit" name="btn_save" class="btn btn-primary mb-2" value="Save">
                </form>
            </main>
        </div>
    </div>
    <!-- Footer scripts, and functions -->
    <?php require_once 'includes/footer.php'; ?>
    <script>
        function previewImage() {
            var preview = document.querySelector('#preview');
            var file = document.querySelector('#product_image').files[0];
            var reader = new FileReader();

            reader.addEventListener("load", function() {
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>