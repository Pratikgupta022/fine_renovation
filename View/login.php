<?php
include 'View/header.php';
// print_r($_SESSION['loggedUser']); die;
// Login Form
?>
<div class="container mt-5">
    <form action= <?php echo BASE_ACTION_URL."login";?> method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" pattern="<?php echo REGEX_EMAIL; ?>" id="" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" id="" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<?php
include 'View/footer.php';
