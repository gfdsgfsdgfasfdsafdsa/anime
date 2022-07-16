<!-- Breadcrumb-->
<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/anime">Anime</a></li>
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/anime">List</a></li>
            <li class="breadcrumb-item active">Update <?= $anime->title ?></li>
        </ul>
    </div>
</div>
<div class="container-fluid">
    <form action="<?= ROOTURL ?>admin/anime/update?anime=<?= $anime->slug ?>" method="post">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-header align-items-center">
                        <h4>Anime Information</h4>
                    </div>
                    <div class="card-body">
                        <?php if(isset($validation) && !empty($validation->errors()->all())){
                            if($validation->errors()->first('title') == "slugExist"){
                                alert("<strong>Error: </strong> Title Already Exist!", 'danger');
                            }else{
                                alert('<strong>Error: </strong> All Fields are required! <strong>Except: </strong> Date Aired To', 'danger');
                            }
                        }
                        ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter Anime Title" value="<?= $anime->title ?>" autocomplete="off">
                                </div>
                                <div class="col-lg-4">
                                    <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Finished" <?php if($anime->status == 'Finished') echo 'selected'?>>Finished</option>
                                        <option value="Airing" <?php if($anime->status == 'Airing') echo 'selected'?>>Airing</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-8">
                                    <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Poster Link</label>
                                    <input type="text" name="posterLink" value="<?= $anime->posterLink ?>" class="form-control" placeholder="Enter Link Eg. https://image.com" autocomplete="off">
                                </div>
                                <div class="col-lg-4">
                                    <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Type</label>
                                    <div class="w-100">
                                        <select class="form-control multiSelect" multiple="multiple" name="typeIds[]">
                                            <?php for($i = 0; $i < count($types); $i++): ?>
                                                <?php if(in_array($types[$i]->id, $typeSelectedIds)): ?>
                                                    <option value="<?= $types[$i]->id ?>" selected><?= $types[$i]->typeName ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $types[$i]->id ?>"><?= $types[$i]->typeName ?></option>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-4">
                                    <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Genre</label>
                                    <div class="w-100">
                                        <select class="form-control multiSelect" multiple="multiple" name="genreIds[]">
                                            <?php for($i = 0; $i < count($genres); $i++): ?>
                                                <?php if(in_array($genres[$i]->id, $genreSelectedIds)): ?>
                                                    <option value="<?= $genres[$i]->id ?>" selected><?= $genres[$i]->genreName ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $genres[$i]->id ?>"><?= $genres[$i]->genreName ?></option>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Date Aired From</label>
                                    <input type="date" name="dateFrom" value="<?= $anime->dateFrom ?>" class="form-control" maxlength="4" min="1900-01-01" max="2999-12-31">
                                </div>
                                <div class="col-lg-4">
                                    <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Date Aired To</label>
                                    <input type="date" name="dateTo" value="<?= $anime->dateTo ?>" class="form-control" maxlength="4" min="1900-01-01" max="2999-12-31">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">title Keywords</label>
                                    <textarea name="titleKeywords" class="form-control" cols="30" rows="2" placeholder="Enter Title Keywords"><?= $anime->titleKeywords ?></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Story Sypnosis</label>
                                    <textarea name="storySypnosis" class="form-control" cols="30" rows="4" placeholder="Enter Story Sypnosis"><?= $anime->storySypnosis ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="row">
                    <div class="col-lg-12 text-center mb-2 d-flex justify-content-lg-end">
                        <a href="<?= ROOTURL ?>admin/anime" class="btn btn-danger btn-lg px-5">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-lg ml-3 px-5">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
