<?php include 'layout/admin_header.php' ?>

<main class="my-5">

    <?php if (isset($err)) : ?>

        <div class="modal fade" id="error-dialog" tabindex="-1" aria-labelledby="error-dialog-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger" id="error-dialog-label">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>
                                Modal title
                            </span>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">

                        <?php foreach ($err as $e) : ?>

                            <div class="mb-1">

                                <?php echo $e ?>

                            </div>

                        <?php endforeach ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <?php endif ?>
    <div class="container">
        <div class="row mb-5">
            <div class="change-password">
                <div class="header">
                    CHANGE YOUR PASSWORD
                </div>
                <div class="form">
                    <form class="needs-validation" method="post" novalidate>
                        <div class="row">
                            <div class="form-floating col-sm-6  mb-3">
                                <input class="form-control" type="password" name="old_password" id="old_password" placeholder="OLD PASSWORD" required="required" autocomplete="new-password">
                                <label for="old_password">OLD PASSWORD</label>
                                <div class="invalid-feedback">
                                    OLD PASSWORD is require
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-floating col-sm-6  mb-3">
                                <input class="form-control" type="password" name="new_password" id="new_password" placeholder="NEW PASSWORD" required="required" autocomplete="new-password">
                                <label for="new_password">NEW PASSWORD</label>
                                <div class="invalid-feedback">
                                    NEW PASSWORD is require
                                </div>
                            </div>
                            <div class="form-floating col-sm-6  mb-3">
                                <input class="form-control" type="password" name="confirm_new_password" id="confirm_new_password" placeholder="CONFIRM NEW PASSWORD" required="required" autocomplete="new-password">
                                <label for="confirm_new_password">CONFIRM NEW PASSWORD</label>
                                <div class="invalid-feedback">
                                    CONFIRM NEW PASSWORD is require
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-success" name="change_password">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>
                                    CHANGE PASSWORD
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="change-info">
                <div class="header">
                    PERSONAL INFORMATION
                </div>
                <div class="form">
                    <form class="needs-validation" method="post" novalidate>
                        <div class="row">
                            <div class="form-floating col-sm-6 mb-3">
                                <input class="form-control" type="text" name="firstname" id="firstname" placeholder="FIRST NAME" required="required" autocomplete="off" value="<?php echo $data["first_name"] ?>">
                                <label for="firstname">FIRST NAME</label>
                                <div class="invalid-feedback">
                                    FIRST NAME is require
                                </div>
                            </div>
                            <div class="form-floating col-sm-6 mb-3">
                                <input class="form-control" type="text" name="lastname" id="lastname" placeholder="LAST NAME" required="required" autocomplete="new-off" value="<?php echo $data["last_name"] ?>">
                                <label for="firstname">LAST NAME</label>
                                <div class="invalid-feedback">
                                    LAST NAME is require
                                </div>
                            </div>
                            <div class="form-floating col-sm-6  mb-3">
                                <input class="form-control" type="text" name="username" id="username" placeholder="USERNAME" required="required" autocomplete="off" value="<?php echo $data["username"] ?>">
                                <label for="username">USERNAME</label>
                                <div class="invalid-feedback">
                                    USERNAME is require
                                </div>
                            </div>
                            <div class="form-floating col-sm-6  mb-3">
                                <input class="form-control" type="email" name="email" id="email" placeholder="EMAIL" required="required" autocomplete="off" value="<?php echo $data["email"] ?>">
                                <label for="email">EMAIL</label>
                                <div class="invalid-feedback">
                                    EMAIL is require
                                </div>
                            </div>
                            <div class="form-floating col-sm-6  mb-3">
                                <input class="form-control" type="tel" name="phone" id="phone" placeholder="PHONE" autocomplete="off" value="<?php echo $data["phone"] ?>">
                                <label for="phone">PHONE</label>
                            </div>
                            <div class="form-floating col-sm-6  mb-3">
                                <input class="form-control" type="text" name="address" id="address" placeholder="ADDRESS" required="required" autocomplete="off" value="<?php echo $data["address"] ?>">
                                <label for="address">ADDRESS</label>
                            </div>
                            <div class=" dropdown col-sm-6 mb-3">
                                <button class="dropdown-toggle btn form-control" id="gender" data-bs-toggle="dropdown" aria-expanded="false">

                                    <?php echo $data["gender"] ? "FEMALE" : "MALE" ?>

                                    <i class="fa-solid fa-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu col-12">
                                    <li class="dropdown-item" id="0">MALE</li>
                                    <li class="dropdown-item" id="1">FEMALE</li>
                                </ul>
                                <input type="hidden" name="gender" value="<?php echo $data["gender"] ?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-success" name="change_info">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>
                                    CHANGE INFORMATION
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <form class="needs-validation col-sm-7 col-md-6 col-lg-3" method="post" novalidate>
        <h1 class="mb-4"><?php echo $pageName ?></h1>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="firstname" id="firstname" placeholder="First Name" required="required" value="<?php echo $data["first_name"] ?>">
            <label for="firstname">First Name</label>
            <div class="invalid-feedback">
                First Name is require
            </div>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Last Name" required="required" value="<?php echo $data["last_name"] ?>">
            <label for="lastname">Last Name</label>
            <div class="invalid-feedback">
                Last Name is require
            </div>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="username" id="username" placeholder="Username" required="required" value="<?php echo $data["username"] ?>">
            <label for="Username">Username</label>
            <div class="invalid-feedback">
                Username is require
            </div>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="email" name="email" id="email" placeholder="Email" required="required" value="<?php echo $data["email"] ?>">
            <label for="email">Email</label>
            <div class="invalid-feedback">
                Email is require
            </div>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="password" name="password" id="password" placeholder="Password" autocomplete="new-password">
            <label for="password">Password</label>
            <div class="invalid-feedback">
                Password is require
            </div>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="address" name="address" id="address" placeholder="Address" required="required" value="<?php echo $data["address"] ?>">
            <label for="address">Address</label>
            <div class="invalid-feedback">
                Address is require
            </div>
        </div>
        <div>
            <input class="btn btn-success" type="submit" name="edit" value="Save">
        </div>
    </form> -->
</main>

<?php include 'layout/admin_footer.php' ?>