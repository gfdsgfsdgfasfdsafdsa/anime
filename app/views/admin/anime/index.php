<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin">Anime</a></li>
            <li class="breadcrumb-item active">List</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb-->

<div class="container-fluid mb-3 mt-2">
    <div class="card">
        <div class="card-header">
            <h4>All Genres</h4>
        </div>
        <div class="card-body">
            <?php flashMessage() ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-md table-bordered viewAllItemsTableAnime">
                    <thead>
                    <tr class="bg-dark">
                        <td class="small text-center font-weight-bold text-light px-3 py-2">ID</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">TITLE</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">STATUS</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">DATE AIRED</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">GENRE</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Type</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($animes as $a): ?>
                        <tr>
                            <td class="small text-center font-weight-bold"><?= $a->id ?></td>
                            <td class="small text-center font-weight-bold"><?= $a->title ?></td>
                            <td class="small text-center font-weight-bold"><?= $a->status ?></td>
                            <td class="small text-center font-weight-bold"><?= formatDate($a->dateFrom) . ' to ' . formatDate($a->dateTo) ?></td>
                            <td class="small text-center font-weight-bold"><?php if(isset($animeGenres[$a->slug])) echo rtrim($animeGenres[$a->slug], ',') ?></td>
                            <td class="small text-center font-weight-bold"><?php if(isset($animeTypes[$a->slug])) echo rtrim($animeTypes[$a->slug], ',') ?></td>
                            <td class="small d-flex justify-content-center font-weight-bold">
                                <div class="actions">
                                    <div>
                                        <a href="<?= ROOTURL ?>admin/anime/view?anime=<?= $a->slug ?>" class="text-info"><i class="fa fa-eye"></i>View</a>
                                    </div>
                                    <div><a href="<?= ROOTURL ?>admin/anime/update?anime=<?= $a->slug ?>"><i class="fa fa-edit ml-3"></i>Update</a></div>
                                    <div><a href="<?= ROOTURL ?>admin/anime/delete?anime=<?= $a->slug ?>"
                                            onclick="return confirm('Are you sure you want to delete this anime \'\'<?= $a->title ?>\'\'')"
                                            class="text-red ml-3"><i class="fa fa-trash"></i>Delete</a></div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>