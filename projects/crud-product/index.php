<?php
// Show PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

require_once 'classes/product.php';

$objProduct = new Product();

// GET
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    try {
        if ($id != null) {
            if ($objProduct->delete($id)) {
                $objProduct->redirect('index.php?deleted');
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
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="mt-3 mb-3">Product Management</h1>
                    </div>
                    <div class="col-md-6">
                        <a href="form.php" class="btn btn-primary mt-3 mb-3">Add New Product</a>
                    </div>
                    <div class="col-md-6">
                        <form method="get">
                            <div class="input-group mt-3 mb-3">
                                <input type="text" class="form-control" placeholder="Search" name="search" value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <?php
                if (isset($_GET['updated'])) {
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong>User!</strong> Updated with success.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>';
                } else if (isset($_GET['deleted'])) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>User!</strong> Deleted with success.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>';
                } else if (isset($_GET['inserted'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>User!</strong> Inserted with success.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>';
                } else if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>DB Error!</strong> Something goes wrong during the database transaction. Try again!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>';
                }
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Price Buy</th>
                                <th>Price Sell</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                        // Pagination
                        $recordsPerPage = 10;
                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $offset = ($current_page - 1) * $recordsPerPage;

                        // Search
                        $search_term = isset($_GET['search']) ? $_GET['search'] : '';
                        $query = "SELECT * FROM product";
                        if ($search_term) {
                            $query .= " WHERE product_name LIKE '%$search_term%'";
                        }
                        $query .= " LIMIT $recordsPerPage OFFSET $offset";

                        $stmt = $objProduct->runQuery($query);
                        $stmt->execute();
                        ?>

                        <tbody>
                            <?php if ($stmt->rowCount() > 0) {
                                while ($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <tr>
                                        <td><?php print($rowUser['id']); ?></td>
                                        <td><img src="<?php echo $rowUser['product_image']; ?>" alt="Product Image" width="100"></td>
                                        <td><?php print($rowUser['product_name']); ?></td>
                                        <td>Rp <?php echo number_format($rowUser['price_buy'], 0, ',', '.'); ?></td>
                                        <td>Rp <?php echo number_format($rowUser['price_sell'], 0, ',', '.'); ?></td>
                                        <td><?php print($rowUser['stock']); ?></td>
                                        <td>
                                            <a href="form.php?edit_id=<?php print($rowUser['id']); ?>" class="mr-2">
                                                <span data-feather="edit"></span>
                                            </a>
                                            <a class="confirmation" href="index.php?delete_id=<?php print($rowUser['id']); ?>">
                                                <span data-feather="trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="7">No data found...</td>
                                </tr>
                            <?php } ?>
                    </table>
                </div>

                <!-- Add pagination links -->
                <div class="pagination">
                    <?php
                    $total_records = $stmt->rowCount();
                    $total_pages = ceil($total_records / $recordsPerPage);

                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<a href='index.php?page=$i&search=$search_term'>$i</a> ";
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>
    <!-- Footer scripts, and functions -->
    <?php require_once 'includes/footer.php'; ?>

    <!-- Custom scripts -->
    <script>
        // JQuery confirmation
        $('.confirmation').on('click', function() {
            return confirm('Are you sure you want do delete this user?');
        });
    </script>
</body>

</html>