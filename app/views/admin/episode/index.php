<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/episode">Episode</a></li>
            <li class="breadcrumb-item active">New/List</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb-->

<div class="container-fluid mb-3 mt-2">
    <div class="card">
        <div class="card-header">
            <h4>Anime</h4>
        </div>
        <div class="card-body">
            <form action="<?= ROOTURL ?>admin/episode" method="get">
                <div class="row">
                    <div class="col-lg-8">
                        <label for="" class="form-control-label text-uppercase text-primary font-weight-bold">Select Anime</label>
                        <span class="text-sm text-warning">| Load to add episode</span>
                        <div class="w-100 d-flex">
                            <select class="form-control selectAnime" name="anime">
                                <?php foreach ($animes as $a) : ?>
                                    <option value="<?= $a->slug ?>"
                                        <?php if(setValue('anime') == $a->slug) echo 'selected'?>><?= $a->title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-4 d-flex justify-content-lg-start justify-content-end">
                        <button type="submit" class="btn btn-primary btn-lg">Load</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$missingEpisodes = null;
$dupicateEpisodes = null;
if(isset($episodes) && isset($episodes[0]->episodeNumber)){
    $episodesList = array();
    $duplicates = array();
    foreach ($episodes as $e)
        if(!in_array($e->episodeNumber, $episodesList))
            array_push($episodesList, $e->episodeNumber);
        else if(!in_array($e->episodeNumber, $duplicates))
            array_push($duplicates, $e->episodeNumber);

    $epMax = max($episodesList[count($episodesList)-1], $episodesList[0]);
    for($i = 0; $i < $epMax; $i++){
        if(!in_array($i+1,$episodesList)){
            if($i+2 == $epMax){
                $missingEpisodes .= ($i+1);
            }else{
                $missingEpisodes .= ($i+1). ', ';
            }
        }
    }
    $dupicateEpisodes = rtrim(join(', ', $duplicates), ',');
}
?>

<div class="container-fluid mb-3 mt-n2">
    <div class="card">
        <div class="card-header">
            <h4><?php if(isset($_GET['anime'])) echo readableSlug($_GET['anime']); ?> Episodes</h4>
        </div>
        <div class="card-body">
            <?php flashMessage() ?>
            <div class="row">
                <div class="col-lg-12 mb-3 d-flex justify-content-between">
                    <div>
                        <?php if($missingEpisodes != null): ?>
                            <span class="text-sm text-danger"><?= 'Missing episodes found '.$missingEpisodes.'.' ?></span>
                        <?php endif; ?>
                        <?php if($dupicateEpisodes != null): ?>
                            <div>
                                <span class="text-sm text-primary"><?= 'Duplicate episode found '.rtrim($dupicateEpisodes).'.' ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if(isset($_GET['anime'])): ?>
                            <a href="<?= (count($episodes)?ROOTURL.'admin/episode/delete-all?anime='.setValue('anime'):'') ?>" onclick="return confirm('Are you sure you want all episodes')" style="color: white" class="btn btn-danger mr-2 <?= (count($episodes)?'':'disabled') ?>">Delete All Episodes</a>
                            <a href="<?= ROOTURL ?>admin/episode/new?anime=<?= setValue('anime') ?><?= (count($episodes)?'&l='.$episodes[count($episodes)-1]->episodeNumber:'') ?>" class="btn btn-primary">Add New Episode/s</a>
                        <?php else: ?>
                            <button class="btn btn-danger mr-2" disabled>Delete All Episodes</button>
                            <button class="btn btn-primary" disabled>Add New Episode/s</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-md table-bordered viewAllItemsTableEpisodes">
                    <thead>
                    <tr class="bg-dark">
                        <td class="small text-center font-weight-bold text-light px-3 py-2" hidden>ID</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">EPISODE #</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">EPISODE LINK</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($_GET['anime'])): ?>
                        <?php foreach ($episodes as $e): ?>
                            <tr>
                                <td class="small text-center font-weight-bold" hidden><?= $e->episodeNumber ?></td>
                                <td class="small text-center font-weight-bold">Episode <?= $e->episodeNumber ?></td>
                                <td class="small text-center font-weight-bold"><a href="<?= $e->episodeLink ?>" target="_blank"><?= $e->episodeLink ?></a></td>
                                <td class="small d-flex justify-content-center font-weight-bold">
                                    <div class="actions">
                                        <div><a href="<?= ROOTURL ?>admin/episode/update?id=<?= $e->id ?>"><i class="fa fa-edit"></i>Update</a></div>
                                        <div><a href="<?= ROOTURL ?>admin/episode/delete?id=<?= $e->id ?>&&anime=<?= $_GET['anime'] ?>&&episode=<?= $e->episodeNumber ?>"
                                                onclick="return confirm('Are you sure you want to delete episode <?= $e->episodeNumber ?>')"
                                                class="text-red ml-3"><i class="fa fa-trash"></i>Delete</a></div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>