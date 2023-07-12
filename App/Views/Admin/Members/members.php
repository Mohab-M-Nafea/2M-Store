<?php include 'layout/admin_header.php' ?>

<main class="container">
    <h1><?php echo $pageName ?></h1>
    <div class="table-responsive mb-4">
        <div class="members-table">
            <table class="table table-white table-hover table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Registered Date</th>
                        <th scope="col">Control</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php if (isset($data)) : ?>
                        <?php foreach ($data as $row) : ?>

                            <tr>
                                <th scope="row"><?php echo $row["user_id"] ?></th>
                                <td><?php echo $row["first_name"] . ' ' . $row["last_name"] ?></td>
                                <td><?php echo $row["username"] ?></td>
                                <td><?php echo $row["email"] ?></td>
                                <td><?php echo $row["address"] ?></td>
                                <td><?php echo $row["date"] ?></td>
                                <td>
                                    <a href="<?php url("dashboard/members/editMember/" . $row["user_id"]) ?>" class="btn btn-success" role="button"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <a class="btn btn-danger" role="button" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $row["user_id"] ?>"><i class="fa-solid fa-user-slash"></i> Delete</a>
                                    <div class="modal fade" id="delete-<?php echo $row["user_id"] ?>" tabindex="-1" aria-labelledby="<?php echo $row["user_id"] ?>ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="<?php echo $row["username"] ?>ModalLabel">Delete <?php echo $row["username"] ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Are you sure you want to delete the user: <?php echo $row["username"] ?>?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="<?php url("dashboard/categories/deleteMember/" . $row["user_id"]) ?>" class="btn btn-primary">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach ?>
                    <?php endif ?>

                </tbody>
            </table>
        </div>
    </div>
    <a href="./members/addMember" class="btn btn-primary" role="button"><i class="fa-solid fa-user-plus"></i> Add Member</a>
</main>

<?php include 'layout/admin_footer.php' ?>