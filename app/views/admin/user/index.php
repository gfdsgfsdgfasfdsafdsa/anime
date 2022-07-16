<!-- Breadcrumb-->
<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin">User</a></li>
            <li class="breadcrumb-item active">List</a></li>
        </ul>
    </div>
</div>

<div class="container-fluid mb-3 mt-2">
    <div class="card">
        <div class="card-header">
            <h4>All Users</h4>
        </div>
        <div class="card-body">
            <?php flashMessage() ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-md table-bordered viewAllItemsTable">
                    <thead>
                    <tr class="bg-dark">
                        <td style="width: 10%" class="small text-center font-weight-bold text-light px-3 py-2">ID</td>
                        <td style="width: 25%" class="small text-center font-weight-bold text-light px-3 py-2">Username</td>
                        <td style="width: 25%" class="small text-center font-weight-bold text-light px-3 py-2">Role</td>
                        <td style="width: 15%" class="small text-center font-weight-bold text-light px-3 py-2">Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="small text-center font-weight-bold"><?= $user->id ?></td>
                            <td class="small text-center font-weight-bold"><?= $user->username ?></td>
                            <td class="small text-center font-weight-bold"><?= $user->role ?></td>
                            <td class="small d-flex justify-content-center font-weight-bold">
                                <div class="actions">
                                    <div><a href="<?= ROOTURL ?>admin/user/update?id=<?= $user->id ?>"><i class="fa fa-edit"></i>Update</a></div>
                                    <div><a href="<?= ROOTURL ?>admin/user/delete?id=<?= $user->id ?>"
                                            onclick="return confirm('Are you sure you want to delete this user \'\'<?= $user->username ?>\'\'')"
                                            class="text-red ml-3"><i class="fa fa-trash"></i>Delete</a></div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>