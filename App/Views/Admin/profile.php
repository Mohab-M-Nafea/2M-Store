<?php include 'layout/admin_header.php' ?>

<main class="profile d-flex">
    <aside class="col-xl-3 col-lg-4">
        <div class="sidebar-profile mb-3">
            <div class="profile-info">
                <div class="d-inline-block">
                    <img class="img-fluid rounded-circle profile-image shadow" src="<?php url($data['gender'] ? 'Uploads/Avatar/woman_avatar.jpg' : 'Uploads/Avatar/men_avatar.jpg') ?>" alt="">
                </div>
                <h5><?php echo $_SESSION["admin"] ?></h5>
                <p class="text-muted text-sm mb-0"><?php echo $_SESSION["admin_name"] ?></p>
            </div>
        </div>
        <div class="menu">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">
                    <i class="fa-solid fa-address-card"></i>
                    <span>Profile</span>
                </a>
                <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a>
                <a class="list-group-item list-group-item-action" data-bs-toggle="link" href="<?php url('admin/logout') ?>">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>
                        Log out
                    </span>
                </a>
            </div>
        </div>
    </aside>
    <section>

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
            <div class="tab-content my-5" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
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
                                        <button type="submit" class="btn btn-outline-dark" name="change_password">
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
                                        <button type="submit" class="btn btn-outline-dark" name="change_info">
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
                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-messages-list">...</div>
            </div>
        </div>
    </section>

    <!-- <?php if (isset($err)) : ?>

            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <div class="me-3">
                    <i class="fa-solid fa-triangle-exclamation"></i>

                </div>

                <div>

                    <?php foreach ($err as $e) : ?>
                        <div class="mb-1">

                            <?php echo $e ?>

                        </div>

                    <?php endforeach ?>

                </div>
            </div>

        <?php endif ?> -->

</main>

<?php include 'layout/admin_footer.php' ?>