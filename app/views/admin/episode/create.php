<!-- Breadcrumb-->
<?php $i = 0; ?>
<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/episode">Anime</a></li>
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/episode?anime=<?= $_GET['anime'] ?>">Episodes</a></li>
            <li class="breadcrumb-item active">New</li>
        </ul>
    </div>
</div>
<div class="container-fluid">
    <form action="<?= ROOTURL ?>admin/episode/new<?= '?anime='.setValue('anime') ?>" method="post">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex justify-content-between">
                        <div>
                            <h4>Anime <?= readableSlug($_GET['anime']) ?> <br/></h4>
                            <div style="margin-bottom: -10px">Episode Information</div>
                        </div>
                        <div>
                            <?php if(isset($_GET['l'])): ?>
                                <div><i class="fas fa-exclamation-circle text-warning mr-2"></i>Last episode added : <?= $_GET['l'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(isset($validation) && !empty($validation->errors()->all()))
                            alert('<strong>Error: </strong> Something is wrong!', 'danger');  ?>
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Episode Link / Episode #</label>
                        <div class="form-group itemInfoField" id="add-form-1">
                            <div class="row mb-3">
                                <div class="col-lg-8 col-md-3 col-sm-12">
                                    <input type="text" name="episodeLink[]" placeholder="Enter Episode Link" class="form-control" autocomplete="off" required>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <input type="number" name="episodeNumber[]" placeholder="Enter Episode Number" class="form-control" required>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-12 text-left">
                                    <a href="javascript:void(0);" class="addItemutton btn btn-primary form-control" title="Add Item">+</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-4">
                    <div class="row">
                        <div class="col-lg-12 text-center mb-2 d-flex justify-content-lg-end">
                            <a href="<?= ROOTURL ?>admin/episode?anime=<?= $_GET['anime'] ?>" class="btn btn-danger btn-lg px-5 d-flex align-items-center">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg ml-3">Confirm New Episode/s</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
