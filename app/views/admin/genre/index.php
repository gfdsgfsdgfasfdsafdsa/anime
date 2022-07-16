<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/genre">Genre</a></li>
            <li class="breadcrumb-item active">View All</li>
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
                <table class="table table-striped table-hover table-md table-bordered viewAllItemsTable">
                    <thead>
                    <tr class="bg-dark">
                        <td style="width: 10%" class="small text-center font-weight-bold text-light px-3 py-2">ID</td>
                        <td style="width: 75%" class="small text-center font-weight-bold text-light px-3 py-2">GENRE</td>
                        <td style="width: 15%" class="small text-center font-weight-bold text-light px-3 py-2">ACTIONS</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($genres as $g): ?>
                        <tr>
                            <td class="small text-center font-weight-bold"><?= $g->id ?></td>
                            <td class="small text-center font-weight-bold"><?= $g->genreName ?></td>
                            <td class="small d-flex justify-content-center font-weight-bold">
                                <div class="actions">
                                    <div><a href="<?= ROOTURL ?>admin/genre/update?id=<?= $g->id ?>"><i class="fa fa-edit"></i>Update</a></div>
                                    <div><a href="<?= ROOTURL ?>admin/genre/delete?id=<?= $g->id ?>"
                                            onclick="return confirm('Are you sure you want to delete this genre \'\'<?= $g->genreName ?>\'\'')"
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