<?php
include 'View/header.php';

// Register Form
?>
<div class="container mt-5">
    <form action= <?php echo BASE_ACTION_URL."register";?> method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Full Name</label>
            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Full Name" >
            <div class="invalid-feedback" id="full_name1">Looks</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" >
            <div class="invalid-feedback" id="email1">Looks</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password"  >
            <div class="invalid-feedback" id="password1">Looks</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
            <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile Number" >
            <div class="invalid-feedback" id="mobile1">Looks</div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="view/js/register.js"></script>
<?php
include 'View/footer.php';
