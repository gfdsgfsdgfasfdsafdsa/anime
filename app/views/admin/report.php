<!-- Breadcrumb-->
<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/report">Report</a></li>
            <li class="breadcrumb-item active">View</a></li>
        </ul>
    </div>
</div>

<div class="container-fluid mb-3 mt-2">
    <div class="card">
        <div class="card-header">
            <h4>All Reports</h4>
        </div>
        <form action="<?= ROOTURL ?>admin/report/delete-selected" method="post" class="card-body">
            <?php flashMessage() ?>
            <div class="row">
                <div class="col-lg-12 mb-3 d-flex justify-content-end">
                    <button type="submit" onclick="return confirm('Are you sure you to delete report/s?')" style="color: white" class="btn btn-danger mr-2"><i class="fas fa-trash-alt mr-2"></i>Delete Selected</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-md table-bordered viewAllItemsTable">
                    <thead>
                    <tr class="bg-dark">
                        <td class="small text-center font-weight-bold text-light px-3 py-2">#</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Anime</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Episode #</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Reason</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Link</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($report as $r): ?>
                        <tr>
                            <td><input name="ids[]" type="checkbox" value="<?= $r->id ?>"></td>
                            <td class="small text-center font-weight-bold"><?php echo $r->animeName.(!$r->isRead?' (New report)':'') ?></td>
                            <td class="small text-center font-weight-bold"><?= $r->episodeNumber ?></td>
                            <td class="small text-center font-weight-bold"><?= $r->reason ?></td>
                            <td class="small text-center font-weight-bold">
                                <a href="<?= ROOTURL.'watch?anime='.$r->animeName.'&episode='.$r->episodeNumber ?>" target="_blank">
                                    <?= ROOTURL.'watch?anime='.$r->animeName.'&episode='.$r->episodeNumber ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>