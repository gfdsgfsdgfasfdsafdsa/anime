<div class="body">
    <div class="anime-list-x-category" style="margin-bottom: -30px">
        <?php if(count($sliderItems)): ?>
            <!-- paging -->
            <div id="slide" class="carousel slide" data-ride="carousel">
                <div class="carousel-indicators">
                    <?php for($i = 0; $i < count($sliderItems); $i++): ?>
                        <span data-target="#slide" data-slide-to="<?= $i ?>" class="<?= ($i == 0 ? 'active' : '') ?>"></span>
                    <?php endfor; ?>
                </div>
                <div class="carousel-inner">
                    <?php $count = 0; ?>
                    <?php foreach ($sliderItems as $s): ?>
                        <div class="carousel-item <?= ($count == 0 ? 'active' : '') ?>">
                            <!-- +30 -->
                            <div class="img-banner">
                                <img src="<?= $s->bannerLink ?>" style="<?= ($s->marginTop != -999999?'top: '.$s->marginTop.'px;':'').
                                ($s->marginBottom != -999999?'bottom: '.$s->marginBottom.'px;':'') ?>">
                            </div>
<!--                            <img src="" width="1100" height="500px">-->
                            <div class="carousel-info d-flex justify-content-between p-3">
                                <div class="mt-n1" style="max-width: 670px;">
                                    <h5 style="font-weight: bold;"><?= (strlen($s->title) > 75 ? substr($s->title, 0, 75) : $s->title) ?></h5>
                                    <p class="mt-n2" style="font-size: 13px; color: rgb(235, 235, 235);"><?= (strlen($s->storySypnosis) > 170? substr($s->storySypnosis, 0, 170).'...' : $s->storySypnosis) ?></p>
                                </div>
                                <a href="<?= ROOTURL ?>watch?anime=<?= $s->slug ?>&episode=1" class="btn btn-primary watch-now">Watch Now</a>
                            </div>
                        </div>
                    <?php $count = 1; endforeach; ?>
                </div>

                <a class="carousel-control-prev" href="#slide" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span></a>

                <a class="carousel-control-next" href="#slide" data-slide="next">
                    <span class="carousel-control-next-icon"></span></a>
            </div>
            <!-- paging -->
        <?php endif; ?>
        <div style="font-size: 20px; font-weight: bold" class="pt-4 pb-2 mt-2 text-primary">Recent Anime Added</div>
        <ul>
            <?php foreach ($animes as $a): ?>
                <li class="anime-info">
                    <a href="<?= ROOTURL ?>watch?anime=<?= $a->slug ?>&episode=1">
                        <div class="poster">
                            <img src="<?= $a->posterLink ?>" alt="No image" style="border: 1px solid #c4c4c4">
                            <div class="overlay">
                                <div class="icon">
                                    <i class="far fa-play-circle"></i>
                                </div>
                            </div>
                            <div class="episodes">
                                <div style="background-color: darkviolet">EPS <?= $a->episodeCount ?></div>
                            </div>
                            <?php if(!empty($animeType[$a->slug])): ?>
                                <div class="taglist">
                                    <?php for($i = 0; $i < count($animeType[$a->slug]); $i++): ?>
                                        <div style="background-color: <?= $animeType[$a->slug][$i]['backgroundColor'] ?>"><?= $animeType[$a->slug][$i]['type'] ?></div>
                                    <?php endfor; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-0">
                            <p class="text-center"><?php if(strlen($a->title) > 70) echo substr($a->title, 0, 70).'...'; else echo $a->title; ?></p>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="mt-n5 mb-5">
            <div class="d-flex justify-content-center align-items-center" style="margin-top: 100px;">
                <a href="<?php if($page != 1) echo 'home?page='.($page-1) ?>" class="btn btn-primary px-2 mr-3 <?php if($page == 1) echo 'disabled' ?>"><i class="mr-2 fas fa-chevron-left"></i>Previous</a>
                <span class="mr-2">page</span>
                <form action="<?= ROOTURL ?>home" method="post" class="d-flex">
                    <div class="input-group" style="width: 100px;">
                        <input type="text" name="enteredPage" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter page" placeholder="<?= $page ?>" autocomplete="off">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary text-white" <?php if(!count($animes)) echo 'disabled' ?>>
                                go
                            </button>
                        </div>
                    </div>
                </form>
                <span class="ml-2">of <?= $totalPage == 0 ? 1 : $totalPage ?></span>
                <a href="<?php if($page != $totalPage) echo 'home?page='.($page+1) ?>" class="btn btn-primary px-4 ml-3 <?php if($page == $totalPage) echo 'disabled' ?>">Next<i class="ml-2 fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>