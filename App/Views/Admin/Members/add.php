<?php include 'layout/admin_header.php' ?>

<main class="container mt-5">

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

    <div class="row">
        <div class="header">
            ADD NEW MEMBER
        </div>
        <div class="form">
            <form class="needs-validation" method="post" novalidate>
                <div class="row">
                    <div class="form-floating col-sm-6 mb-3">
                        <input class="form-control" type="text" name="firstname" id="firstname" placeholder="FIRST NAME" required="required" autocomplete="off">
                        <label for="firstname">FIRST NAME</label>
                        <div class="invalid-feedback">
                            FIRST NAME is require
                        </div>
                    </div>
                    <div class="form-floating col-sm-6 mb-3">
                        <input class="form-control" type="text" name="lastname" id="lastname" placeholder="LAST NAME" required="required" autocomplete="new-off">
                        <label for="firstname">LAST NAME</label>
                        <div class="invalid-feedback">
                            LAST NAME is require
                        </div>
                    </div>
                    <div class="form-floating col-sm-6  mb-3">
                        <input class="form-control" type="text" name="username" id="username" placeholder="USERNAME" required="required" autocomplete="off">
                        <label for="username">USERNAME</label>
                        <div class="invalid-feedback">
                            USERNAME is require
                        </div>
                    </div>
                    <div class="form-floating col-sm-6  mb-3">
                        <input class="form-control" type="email" name="email" id="email" placeholder="EMAIL" required="required" autocomplete="off">
                        <label for="email">EMAIL</label>
                        <div class="invalid-feedback">
                            EMAIL is require
                        </div>
                    </div>
                    <div class="form-floating col-sm-6  mb-3">
                        <input class="form-control" type="password" name="password" id="password" placeholder="PASSWORD" required="required" autocomplete="new-password">
                        <label for="password">PASSWORD</label>
                        <div class="invalid-feedback">
                            PASSWORD is require
                        </div>
                    </div>
                    <div class="form-floating col-sm-6 mb-3">
                        <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="CONFIRM PASSWORD" required="required" autocomplete="new-password">
                        <label for="confirm_password">CONFIRM PASSWORD</label>
                        <div class="invalid-feedback">
                            CONFIRM PASSWORD is require
                        </div>
                    </div>
                    <div class=" col-sm-6 mb-3">
                        <div class=" dropdown">
                            <button class="dropdown-toggle btn form-control" id="gender" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>GENDER</span>
                                <i class="fa-solid fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu col-12">
                                <li class="dropdown-item" id="0">MALE</li>
                                <li class="dropdown-item" id="1">FEMALE</li>
                            </ul>
                            <input type="hidden" name="gender">
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-dark" name="add_member">
                        ADD
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include 'layout/admin_footer.php' ?>