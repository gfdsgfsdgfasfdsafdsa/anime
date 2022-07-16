<div class="body">
    <div class="anime-list-x-category">
        <div class="breadcrumb">
            <div class="breadcrumb-item"><a href="<?= ROOTURL ?>home">Home</a></div>
            <div class="breadcrumb-item active">Anime By Letter <?= '"'.$q.'"' ?></div>
        </div>
        <div style="background-color: #EEEEEE; padding: 10px 20px; border-radius: 3px">
            <div class="a-to-z-list">
                <a href="<?= ROOTURL ?>az-list?q=all" class="<?php if($q == 'all') echo 'current' ?>">All</a>
                <a href="<?= ROOTURL ?>az-list?q=0-9" class="<?php if($q == '0-9') echo 'current' ?>">0-9</a>
                <?php for($i = 'A'; $i <= 'Z'; $i++): ?>
                    <a class="<?php if($q == $i) echo 'current' ?>" href="<?= ROOTURL ?>az-list?q=<?= $i ?>"><?= $i ?></a>
                    <?php if($i == 'Z') break; ?>
                <?php endfor; ?>
            </div>

            <?php if(!count($animes)): ?>
                <ul class="ml-4 mt-4" style="font-size: 40px">No currently anime in this category yet</ul>
            <?php endif; ?>

            <div class="px-2 mt-3">
                <?php $c = 1; foreach ($animes as $a): ?>
                    <div style="width: 100%; border-radius: 2px; <?php if($c%2!= 0) echo 'background-color: #d7d7d7'; $c++; ?>" class="px-1 py-1 mt-2">
                            <div class="">
                                <a href="<?= ROOTURL ?>watch?anime=<?= $a->slug ?>&episode=1" class="d-flex">
                                    <img style="font-size: 13px" src="<?= $a->posterLink ?>" alt="No image" height="59" width="45">
                                    <div class="p-0 ml-3 pt-1">
                                        <div class="text-center" style="font-size: 14px"><?php if(strlen($a->title) > 110) echo substr($a->title, 0, 110).'...'; else echo $a->title; ?></div>
                                        <div style="font-size: 13px; color: gray">Eps <?= $a->episodeCount ?></div>
                                    </div>
                                </a>
                            </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-n5 mb-3">
                <div class="d-flex justify-content-center align-items-center" style="margin-top: 100px;">
                    <a href="<?php if($page != 1) echo 'az-list?q='.$q.'&page='.($page-1) ?>" class="btn btn-primary px-2 mr-3 <?php if($page == 1) echo 'disabled' ?>"><i class="mr-2 fas fa-chevron-left"></i>Previous</a>
                    <span class="mr-2">page</span>
                    <form action="<?= ROOTURL ?>az-list?q=<?= $q ?>" method="POST" class="d-flex">
                        <div class="input-group" style="width: 100px;">
                            <input type="text" name="enteredPage" class="form-control" data-toggle="tooltip" data-placement="top" title="Enter page" placeholder="<?= $page ?>" autocomplete="off" required>
                            <input type="hidden" name="totalPage" value="<?= $totalPage ?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary text-white" <?php if(!count($animes) || ($totalPage == 1)) echo 'disabled' ?>>
                                    go
                                </button>
                            </div>
                        </div>
                    </form>
                    <span class="ml-2">of <?= $totalPage == 0 ? 1 : $totalPage ?></span>

                    <a href="<?php if($page != $totalPage) echo 'az-list?q='.$q.'&page='.($page+1) ?>" class="btn btn-primary px-4 ml-3 <?php if($page == $totalPage) echo 'disabled' ?>">Next<i class="ml-2 fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>


    </div>