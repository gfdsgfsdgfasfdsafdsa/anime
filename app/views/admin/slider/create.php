<!-- Breadcrumb-->
<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/slider">Slider</a></li>
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/slider">View</a></li>
            <li class="breadcrumb-item active">New</li>
        </ul>
    </div>
</div>
<div class="container-fluid mt-3">
    <form action="<?= ROOTURL ?>admin/slider/new" method="post">
        <div class="card">
            <div class="card-header align-items-center">
                <h4>Banner Details</h4>
            </div>
            <div class="card-body">
                <?php flashMessage(); ?>
                <?php if(isset($validation) && !empty($validation->errors()->all()))
                    alert('<strong>Error: </strong> Anime/Banner Link is Required!', 'danger');
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Select Anime</label>
                        <div class="w-100 d-flex">
                            <select class="form-control selectAnime" name="anime">
                                <?php foreach ($animes as $a) : ?>
                                    <option value="<?= $a->slug ?>" <?= (setValue('anime') == $a->slug?'selected':'') ?>><?= $a->title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Banner Image Link</label>
                        <input type="text" class="form-control w-100" name="bannerLink" placeholder="Enter Banner Link" autocomplete="off">
                    </div>
                </div>
                <label class="mt-3 mb-n5 form-control-label text-uppercase text-primary font-weight-bold">Optional</label>
                <hr>
                <div class="row mt-n2">
                    <div class="col-lg-6">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Margin Top</label>
                        <input type="number" name="marginTop" value="<?= setValue('marginTop') ?>" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-lg-6">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Margin Bottom</label>
                        <input type="number" name="marginBottom" value="<?= setValue('marginBottom') ?>" class="form-control" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-4">
            <div class="row">
                <div class="col-lg-12 text-center mb-2 d-flex justify-content-lg-end">
                    <a href="<?= ROOTURL ?>admin" class="btn btn-danger btn-lg">Cancel</a>
                    <a data-toggle="modal" data-target="#previewModal" class="btn btn-info btn-lg ml-3 text-white">Preview</a>
                    <button type="submit" class="btn btn-primary btn-lg ml-3">Confirm</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Request Model -->
<form action="" method="post" class="modal fade" id="previewModal">
    <div class="modal-dialog" style="display: table">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Image Preview</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-bb"></div>
        </div>
    </div>
</form>