<!-- Breadcrumb-->
<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/genre">Genre</a></li>
            <li class="breadcrumb-item active">New</li>
        </ul>
    </div>
</div>
<div class="container-fluid mt-3">
    <form action="<?= ROOTURL ?>admin/genre/new" method="post">
        <div class="card">
            <div class="card-header align-items-center">
                <h4>Genre Details</h4>
            </div>
            <div class="card-body">
                <?php if(isset($validation) && !empty($validation->errors()->all()))
                    if($validation->errors()->first('genreName') == 'The genreName field is required.'){
                         alert('<strong>Error: </strong> Field Cannot Be Empty!', 'danger');
                    }else{
                        alert('<strong>Error: </strong> Genre already exist!', 'danger');
                    }
                    ?>
                <?php flashMessage() ?>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Genre Name</label>
                        <input type="text" name="genreName" placeholder="Enter Genre Name" class="form-control"
                               value="<?= setValue('genreName') ?>" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-4">
            <div class="row">
                <div class="col-lg-12 text-center mb-2 d-flex justify-content-lg-end">
                    <a href="<?= ROOTURL ?>admin/genre" class="btn btn-danger btn-lg px-5">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-lg ml-3 px-5">Confirm</button>
                </div>
            </div>
        </div>
    </form>
</div>