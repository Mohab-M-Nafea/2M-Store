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
            EDIT <?php echo $comment["username"] ?> COMMENT
        </div>
        <div class="form">
            <form class="needs-validation" method="post" novalidate>
                <div class="row">
                    <div class="upper-label col-sm-6 mb-3">
                        <label for="user-comment">Comment</label>
                        <textarea name="user-comment" id="user-comment" class="form-control" required="required"><?php echo $comment["comment"] ?></textarea>
                        <div class="invalid-feedback">
                            Comment is require
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-success" name="edit_comment">
                        EDIT COMMENT
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include 'layout/admin_footer.php' ?>