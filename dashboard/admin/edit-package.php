<?php
include_once 'header.php';

$package_id = $_GET['id'];

$stmt = $user->runQuery("SELECT * FROM package WHERE id=:id");
$stmt->execute(array(":id"=>$package_id));
$package_data = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once '../../configuration/header3.php';
    ?>
	<title>Edit Department</title>
</head>
<body>

<div class="class-modal">
        <div class="modal fade" id="editModal" aria-labelledby="classModalLabel" aria-hidden="true"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="header"></div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="classModalLabel"><i class='bx bxs-edit'></i> Edit
                            Package</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            onclick="history.back()"></button>
                    </div>
                    <div class="modal-body">
                        <section class="data-form-modals">
                            <div class="registration">
                                <?php
                                // department data
                                $package_name = $package_data['package'];
                                $package_price = $package_data['price'];
                                $package_credits = $package_data['number_of_post'];

                                ?>
                                <form action="controller/package-controller.php?id=<?php echo $package_id ?>" method="POST" class="row gx-5 needs-validation" enctype="multipart/form-data" name="form" onsubmit="return validate()" novalidate style="overflow: hidden;">
                                    <div class="row gx-5 needs-validation">

                                            <div class="col-md-12">
												<label for="package_name" class="form-label">Package Name <span> *</span></label>
												<input type="text"  class="form-control" value="<?php echo $package_name?>" autocapitalize="on" autocomplete="off" name="package_name" id="package_name" required>
												<div class="invalid-feedback">
													Please provide a Package Name.
												</div>
											</div>

											<div class="col-md-6">
												<label for="price" class="form-label">Price (Php) <span> *</span></label>
												<input type="text"  class="form-control numbers" value="<?php echo $package_price?>"v inputmode="numeric"  name="price" id="price" required>
											</div>
											<div class="invalid-feedback">
												Please provide a Price.
											</div>

											<div class="col-md-6">
												<label for="number_of_credits" class="form-label">Number of Credits <span> *</span></label>
												<input type="text"  class="form-control numbers" value="<?php echo $package_credits?>" inputmode="numeric"  name="number_of_credits" id="number_of_credits" required>
											</div>
											<div class="invalid-feedback">
												Please provide a Number of Credits.
											</div>

                                    <div class="addBtn">
                                        <button type="submit" class="btn-dark" name="btn-edit-package" id="btn-add"
                                            onclick="return IsEmpty(); sexEmpty();">Update</button>
                                    </div>
                                </form>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>  

    <?php
    include_once '../../configuration/footer3.php';
    ?>
    <script>
    //Load Modal
    $(window).on('load', function() {
        $('#editModal').modal('show');
    });
    </script>
    <?php include_once '../../configuration/sweetalert.php'; ?>

</body>
</html>