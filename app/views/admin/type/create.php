<!-- Breadcrumb-->
<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/type">Type</a></li>
            <li class="breadcrumb-item active">New</li>
        </ul>
    </div>
</div>
<div class="container-fluid mt-3">
    <form action="<?= ROOTURL ?>admin/type/new" method="post">
        <div class="card">
            <div class="card-header align-items-center">
                <h4>Type Details</h4>
            </div>
            <div class="card-body">
                <?php if(isset($validation) && !empty($validation->errors()->all()))
                    if($validation->errors()->first('typeName') == 'The typeName field is required.'){
                        alert('<strong>Error: </strong> Field Cannot Be Empty!', 'danger');
                    }else{
                        alert('<strong>Error: </strong> Type already exist!', 'danger');
                    }
                ?>
                <?php flashMessage() ?>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Type Name</label>
                        <input type="text" name="typeName" placeholder="Enter Type Name" class="form-control"
                               value="<?= setValue('typeName') ?>" autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Pick BG Color</label>
                        <input class="form-control" type="color" name="backgroundColor" value="<?= setValue('backgroundColor') ?>">
                    </div>
                    <div>
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Preview</label>
                        <div class="text-white text-center mt-1 px-2 preview-style" style="background-color: #000000; border-radius: 5px">sda</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-4">
            <div class="row">
                <div class="col-lg-12 text-center mb-2 d-flex justify-content-lg-end">
                    <a href="<?= ROOTURL ?>admin/type" class="btn btn-danger btn-lg px-5">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-lg ml-3 px-5">Confirm</button>
                </div>
            </div>
        </div>
    </form>
</div>