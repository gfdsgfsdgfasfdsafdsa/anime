<div class="side-items">
    <form action="<?= ROOTURL ?>filter" method="get" class="p-2 px-4 mb-3" style="background-color: #EEEEEE; border-radius: 5px;">
        <div style="font-size: 18px;" class="text-primary py-1">Filter</div>
        <div class="row d-flex">
            <div class="col-6 col-lg-6 col-md-3 p-1">
                <select name="genre[]" id="dropdown-genre" multiple="multiple">
                    <?php foreach ($genres as $g): ?>
                        <option value="<?= $g->id ?>"
                            <?php if(isset($genres_selected) && in_array($g->id, $genres_selected)) echo 'selected'?>
                        ><?= $g->genreName ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-6 col-lg-6 col-md-3 p-1">
                <select name="type[]" id="dropdown-type" multiple="multiple">
                    <?php foreach ($types as $t): ?>
                        <option value="<?= $t->id ?>"
                            <?php if(isset($types_selected) && in_array($t->id, $types_selected)) echo 'selected'?>
                        ><?= $t->typeName ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-6 col-lg-6 col-md-3 p-1">
                <select name="year[]" id="dropdown-year" multiple="multiple">
                    <?php for($i = $minMaxYear[0]->minYear; $i < $minMaxYear[1]->maxYear; $i++): ?>
                        <option value="<?= $i ?>"
                            <?php if(isset($year_selected) && in_array($i, $year_selected)) echo 'selected'?>
                        ><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-6 col-lg-6 col-md-3 p-1">
                <select name="sort" id="dropdown-sort">
                    <option value="default" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'default') echo 'selected' ?>>Default</option>
                    <option value="a_to_z" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'a_to_z') echo 'selected' ?>>Name A - Z</option>
                </select>
            </div>
            <div class="col-12 col-lg-12 col-md-6 p-1">
                <input type="text" class="form-control form-control-sm" name="keyword"
                       id="" style="padding: 16px;background-color: #D5D5D5;color: blue;" value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword']; ?>" placeholder="Search.." autocomplete="off">
            </div>
            <div class="col-12 col-lg-12 col-md-6 p-1">
                <button type="submit" class="w-100 p-1 btn btn-primary">
                    <i class="fas fa-filter"></i> Filter</button>
            </div>
        </div>
    </form>

    <div class="recent p-2 pb-3 pb-md-0" style="background-color: #ECECEC;border-radius: 5px;">
        <div class="d-flex justify-content-between p-2">
            <div style="font-size: 18px;" class="text-primary">Recently Added</div>
            <a href="<?= ROOTURL ?>recently-added" class="btn btn-primary d-flex align-items-center" style="font-size: 13px; padding: 2px 15px;">View all</a>
        </div>
        <div class="items">
            <?php foreach ($recentlyAdded as $r): ?>
                <a href="<?= ROOTURL ?>watch?anime=<?= $r->slug ?>&episode=<?= $r->episodeNumber ?>" class="item d-flex p-2">
                    <img src="<?= $r->posterLink ?>" alt="No Image available" width="63" height="90"
                         style="height: 90px;font-size: 13px;border: 1px solid #c4c4c4">
                    <div class="ml-2 pt-2">
                        <div class="font-weight-bold"><?php if(strlen($r->title) > 80) echo substr($r->title, 0, 80).'...'; else echo $r->title; ?></div>
                        <div class="pt-1">Episode <?= $r->episodeNumber ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div style="padding-top: 10px"></div>
    </div>
</div>
</div>