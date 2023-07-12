<?php include 'layout/admin_header.php' ?>

<main class="login d-flex justify-content-center align-items-center text-center">

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
    
    <form class="needs-validation col-sm-7 col-md-6 col-lg-3" method="post" novalidate>
        <h1 class="mb-4"><?php echo $pageName ?></h1>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" name="username" id="username" placeholder="Username" autocomplete="off" required="required">
            <label for=" Username">Username</label>
            <div class="invalid-feedback">
                Username is require
            </div>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="password" name="password" id="password" placeholder="Password" autocomplete="new-password" required="required">
            <label for=" Password">Password</label>
            <div class="invalid-feedback">
                Password is require
            </div>
        </div>
        <div>
            <input class="btn btn-primary" type="submit" name="login" value="Login">
        </div>
    </form>
</main>

<?php include 'layout/admin_footer.php' ?>