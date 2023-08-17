<?php
include 'View/header.php';

// Edit Workers Form
// print_r($dataArray); die;

$worker_id = str_pad($workerSessionId, 3, '0', STR_PAD_LEFT);
?>
<div class="container mt-5">
    <form action=<?php echo BASE_ACTION_URL . "edit-w&id=" . $workerSessionId; ?> method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Workers ID</label>
            <input type="text" name="full_name" class="form-control" value="<?php echo 'W'.$worker_id; ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="<?php echo $dataArray['full_name']; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $dataArray['email']; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="" value="<?php echo $dataArray['password']; ?>">
            <!-- <div id="" class="form-text">Edit Password only if you want to change & password length is default.</div> -->
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
            <input type="text" name="mobile" class="form-control" value="<?php echo $dataArray['mobile']; ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<?php
include 'View/footer.php';
