<div class="body">
    <div class="anime-list-x-category">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="<?= ROOTURL ?>home">Home</a></div>
            <div class="breadcrumb-item active">Filter</div>
        </div>
        <?php if(!count($animes)): ?>
            <ul class="ml-4" style="font-size: 40px">No Results found</ul>
        <?php endif; ?>
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
                <a href="<?php if($page != 1) echo  'filter?'.$url_.'keyword='.$_GET['keyword'].'&page='.($page-1) ?>" class="btn btn-primary px-2 mr-3 <?php if($page == 1) echo 'disabled' ?>"><i class="mr-2 fas fa-chevron-left"></i>Previous</a>
                <span class="mr-2">page</span>
                <form action="<?= ROOTURL ?>filter" method="POST" class="d-flex">
                    <div class="input-group" style="width: 100px;">
                        <input type="text" name="enteredPage" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter page" placeholder="<?= $page ?>" autocomplete="off">
                        <input type="hidden" name="keyword" value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword']; else echo  '' ?>">
                        <input type="hidden" name="url_" value="<?= $url_ ?>">
                        <input type="hidden" name="totalPage" value="<?= $totalPage ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary text-white <?php if(!count($animes)) echo 'disabled' ?>">
                                go
                            </button>
                        </div>
                    </div>
                </form>
                <span class="ml-2">of <?= $totalPage == 0 ? 1 : $totalPage ?></span>

                <a href="<?php if($page != $totalPage && isset($_GET['keyword'])) echo 'filter?'.$url_.'keyword='.$_GET['keyword'].'&page='.($page+1); else echo 'filter?sort=default&keyword=' ?>" class="btn btn-primary px-4 ml-3 <?php if($page == $totalPage || !count($animes)) echo 'disabled' ?>">Next<i class="ml-2 fas fa-chevron-right"></i></a>
            </div>
        </div>
    </div>