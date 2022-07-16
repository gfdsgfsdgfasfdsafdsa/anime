<!-- Breadcrumb-->
<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/user">User</a></li>
            <li class="breadcrumb-item active">New User</li>
        </ul>
    </div>
</div>

<div class="container-fluid mt-3">
    <form action="<?= ROOTURL ?>admin/user/new" method="post">
        <div class="card">
            <div class="card-header align-items-center">
                <h4>User Details</h4>
            </div>
            <div class="card-body">
                <?php if(isset($validation) && !empty($validation->errors()->all()))
                    alert((!empty($validation->errors()->first('username')) ? '<strong>Error: </strong> '.$validation->errors()->first('username'): '').
                        (!empty($validation->errors()->first('password')) ? ' <strong>Error: </strong> '.$validation->errors()->first('password') : '').
                        (!empty($validation->errors()->first('confirm-password')) ?' <strong>Error: </strong> '.$validation->errors()->first('confirm-password') : ''), 'danger');  ?>
                <?php flashMessage() ?>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Username</label>
                        <input type="text" name="username" placeholder="Enter Username" class="form-control"
                               value="<?= setValue('username') ?>" autocomplete="off">
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Role</label>
                        <select name="role" class="form-control">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Password</label>
                        <input type="password" name="password" placeholder="Enter password" class="form-control"
                               value="<?= setValue('password') ?>" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Confirm Password</label>
                        <input type="password" name="confirm-password" placeholder="Enter password again" class="form-control"
                               value="<?= setValue('confirm-password') ?>" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-4">
            <div class="row">
                <div class="col-lg-12 text-center mb-2 d-flex justify-content-lg-end">
                    <a href="<?= ROOTURL ?>type" class="btn btn-danger btn-lg px-5">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-lg ml-3 px-5">Confirm</button>
                </div>
            </div>
        </div>
    </form>
</div>