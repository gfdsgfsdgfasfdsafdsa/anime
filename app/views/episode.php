<div class="body">
    <div class="anime-list-x-category">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="<?= ROOTURL ?>home">Home</a></div>
            <div class="breadcrumb-item"><?= $anime->title ?></div>
        </div>
        <!-- video -->
        <?php if(count($episodes)): ?>
<!--            <div style="height: 540px">-->
            <div class="video-size">
                <?php if(isUrlExist($episodeLink)): ?>
                    <iframe src="<?= $episodeLink ?>" allowfullscreen="true" frameborder="0" scrolling="no"
                            style="width: 100%; height: 100%"></iframe>
                <?php else: ?>
                    <div style="width: 100%; height: 100%; font-size: 3rem; background-color: black"
                         class="d-flex justify-content-center align-items-center text-white">
                        Video is not found.</div>
                <?php endif; ?>
            </div>
            <div class="d-flex justify-content-center p-2" style="background-color: #ECECEC;position: relative">

                <a class="mr-2" <?php if(!empty($prev)): ?>
                    href="<?= ROOTURL ?>watch?anime=<?= $_GET['anime'] ?>&episode=<?= $prev ?>"
                <?php else: ?>
                    style="color: gray"
                <?php endif; ?>
                ><i class="fas fa-backward"></i> Prev</a>
                <a class="mr-2"
                    <?php if(!empty($next)): ?>
                        href="<?= ROOTURL ?>watch?anime=<?= $_GET['anime'] ?>&episode=<?= $next ?>"
                    <?php else: ?>
                        style="color: gray"
                    <?php endif; ?>
                  >Next <i class="fas fa-forward"></i></a>
                <a href="#" data-toggle="modal" data-target="#reportModal" style="position: absolute;right: 15px;"><i class="fas fa-exclamation"></i> Report</a>
            </div>
        <?php endif; ?>
        <!-- video -->
        <div style="width: 100%; background-color: #ECECEC;margin-top: 10px; margin-bottom: 15px">
            <div class="pl-4 pt-4 h5">Episodes</div>
            <?php if(!count($episodes)): ?>
                <div class="ml-5 pb-3">No episodes currently uploaded.</div>
            <?php else: ?>
                <div class="ep">
                    <?php foreach ($episodes as $e): ?>
                        <?php if($currentSelectedEpisode == $e->episodeNumber): ?>
                            <a href="<?= ROOTURL ?>watch?anime=<?= $anime->slug ?>&episode=<?= $e->episodeNumber ?>" class="current"><?= $e->episodeNumber ?></a>
                        <?php else: ?>
                            <a href="<?= ROOTURL ?>watch?anime=<?= $anime->slug ?>&episode=<?= $e->episodeNumber ?>"><?= $e->episodeNumber ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div style="width: 100%; background-color: #ECECEC;margin-top: 10px; margin-bottom: 15px">
            <div class="row pl-4 pt-3 pb-3">
                <div class="col-3 d-none d-lg-block d-md-block">
                    <img src="<?= $anime->posterLink ?>" style="width: 100%;" alt="No Image Found">
                </div>
                <div class="col-9">
                    <div style="font-weight: bold; font-size: 19px"><?= $anime->title ?></div>
                    <div style="font-size: 14px"><?= $anime->titleKeywords ?></div>
                    <div style="font-size: 14px" class="mt-2 pr-4 storySypnosis"><?= $anime->storySypnosis ?></div>
                    <div style="font-size: 14px" class="mt-2">Type:
                        <?php for($i = 0; $i < count($type); $i++): ?>
                            <?php if($i+1 == count($type)): ?>
                                <a style="color: blue" href="<?= ROOTURL ?>filter?type%5B%5D=<?= $type[$i]->typeId ?>&sort=default&keyword="><?= $type[$i]->typeName ?></a>
                            <?php else: ?>
                                <a style="color: blue" href="<?= ROOTURL ?>filter?type%5B%5D=<?= $type[$i]->typeId ?>&sort=default&keyword="><?= $type[$i]->typeName.', ' ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <div style="font-size: 14px" class="mt-2">Genre:
                        <?php for($i = 0; $i < count($genre); $i++): ?>
                            <?php if($i+1 == count($genre)): ?>
                                <a style="color: blue" href="<?= ROOTURL ?>filter?genre%5B%5D=<?= $genre[$i]->genreId ?>&sort=default&keyword="><?= $genre[$i]->genreName ?></a>
                            <?php else: ?>
                                <a style="color: blue" href="<?= ROOTURL ?>filter?genre%5B%5D=<?= $genre[$i]->genreId ?>&sort=default&keyword="><?= $genre[$i]->genreName.', ' ?></a>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <div style="font-size: 14px" class="mt-2">Status : <?= $anime->status ?></div>
                    <div style="font-size: 14px" class="mt-2">Date Aired: <?= formatDate($anime->dateFrom) . ' to ' . formatDate($anime->dateTo) ?></div>
                </div>
            </div>
            <div class="pl-4 pr-4 pb-3" style="font-size: 14px">Keywords: <?= $anime->titleKeywords ?></div>
        </div>
    </div>


    <!-- Modal -->
    <form action="" method="post" class="modal fade" id="reportModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="py-4 px-4">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="text-center font-weight-bold text-primary" style="font-size: 25px">Report An Issue</h5>
                    <p style="font-size: 14px" class="text-center">Thank you for reporting an issue with this video.
                        Please let us know what's wrong so we can fix it ASAP.</p>
                    <div class="alert-modal-report"></div>
                    <div class="text-primary" style="font-size: 20px"><?= $anime->title ?></div>
                    <div class="mb-2" style="font-size: 14px">Episode <?= $_GET['episode'] ?></div>
                    <textarea name="reportReason" class="form-control" cols="60" rows="5" style="width: 100%;background-color: #ececec"></textarea>
                    <button class="btn btn-primary w-100 mt-3 btn-anime-report" type="submit">Send Report</button>
                    <div class="d-flex justify-content-center mt-2 report-load mb-n3">
                    </div>
                </div>
            </div>
        </div>
    </form>