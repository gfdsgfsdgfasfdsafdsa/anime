<!-- Breadcrumb-->
<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/anime">Anime</a></li>
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/anime">List</a></li>
            <li class="breadcrumb-item active"><?= $anime->title ?></li>
        </ul>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header align-items-center">
                    <h4>Anime Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="ml-4">
                                <img height="300px" width="220px" src="<?= $anime->posterLink ?>" alt="No Img Found.">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <h1 class="font-weight-bold" style="font-size: 2.5rem">
                                <?= $anime->title ?>
                            </h1>
                            <p><?= $anime->titleKeywords ?></p>
                            <span class="storySypnosis" style="font-size: 0.9rem">
                                    <?= $anime->storySypnosis ?>
                                </span>
                            <div style="font-size: 0.9rem" class="mt-2"><strong>Status:</strong> <span><?= $anime->status ?></span></div>
                            <div style="font-size: 0.9rem"><strong>Date aired:</strong> <span><?= formatDate($anime->dateFrom).' to '.formatDate($anime->dateTo) ?></span></div>
                            <div style="font-size: 0.9rem"><strong>Genre:</strong> <span><?php if(isset($animeGenres[$anime->slug])) echo rtrim($animeGenres[$anime->slug], ',') ?></span></div>
                            <div style="font-size: 0.9rem"><strong>Type:</strong> <span><?php if(isset($animeTypes[$anime->slug])) echo rtrim($animeTypes[$anime->slug], ',') ?></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4">
            <div class="row">
                <div class="col-lg-12 text-center mb-2 d-flex justify-content-lg-end">
                    <a href="<?= ROOTURL ?>admin/anime" class="btn btn-info btn-lg px-5">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
