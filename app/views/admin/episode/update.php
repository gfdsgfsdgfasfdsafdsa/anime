<!-- Breadcrumb-->
<?php $i = 0; ?>
<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index">Anime</a></li>
            <li class="breadcrumb-item"><a href="index"><?= readableSlug($episode->animeSlug) ?></a></li>
            <li class="breadcrumb-item"><a href="index"></a>Episode <?= $episode->episodeNumber ?> Update</li>

        </ul>
    </div>
</div>
<div class="container-fluid">
    <form action="<?= ROOTURL ?>admin/episode/update<?= '?id='.setValue('id') ?>" method="post">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center">
                        <h4>Episode Information</h4>
                    </div>
                    <div class="card-body">
                        <?php if(isset($validation) && !empty($validation->errors()->all()))
                            alert('<strong>Error: </strong> All field cannot be empty!', 'danger');  ?>
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Episode Link / Episode #</label>
                        <div class="form-group itemInfoField">
                            <div class="row mb-3">
                                <div class="col-lg-9 col-md-3 col-sm-12">
                                    <input value="<?= $episode->episodeLink ?>" type="text" name="episodeLink" placeholder="Enter Episode Link" class="form-control" autocomplete="off">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <input value="<?= $episode->episodeNumber ?>" type="number" name="episodeNumber" placeholder="Enter Episode Number" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-4">
                    <div class="row">
                        <div class="col-lg-12 text-center mb-2 d-flex justify-content-lg-end">
                            <a href="<?= ROOTURL ?>admin" class="btn btn-danger btn-lg px-5">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg ml-3">Update Episode</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
