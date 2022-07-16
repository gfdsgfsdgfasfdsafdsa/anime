<!-- Breadcrumb-->
<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/request">Request</a></li>
            <li class="breadcrumb-item active">View</a></li>
        </ul>
    </div>
</div>

<div class="container-fluid mb-3 mt-2">
    <div class="card">
        <div class="card-header">
            <h4>All Anime Request</h4>
        </div>
        <div class="card-body">
            <?php flashMessage() ?>
            <div class="row">
                <div class="col-lg-12 mb-3 d-flex justify-content-end">
                    <a href="<?= ROOTURL ?>admin/request/delete-all" onclick="return confirm('Are you sure you want all episodes')" style="color: white" class="btn btn-danger mr-2"><i class="fas fa-trash-alt mr-2"></i>Delete All Done</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-md table-bordered viewAllItemsTable">
                    <thead>
                    <tr class="bg-dark">
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Anime</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Status</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Date Request</td>
                        <td style="width: 20%" class="small text-center font-weight-bold text-light px-3 py-2">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($request as $r): ?>
                        <tr>
                            <td class="small text-center font-weight-bold"><?php echo $r->animeName.(!$r->isRead?' (New request)':'') ?></td>
                            <td class="small text-center font-weight-bold"><?= $r->status ?></td>
                            <td class="small text-center font-weight-bold"><?= formatDate($r->createdAt) ?></td>
                            <td class="small d-flex justify-content-center font-weight-bold">
                                <div class="actions">
                                    <?php if($r->status == 'pending'): ?>
                                        <div><a href="<?= ROOTURL ?>admin/request/mark-as-done?id=<?= $r->id ?>"><i class="fa fa-check"></i>Mark as Done</a></div>
                                    <?php endif; ?>
                                    <div><a href="<?= ROOTURL ?>admin/request/delete?id=<?= $r->id ?>"
                                            onclick="return confirm('Are you sure you want to delete this request \'\'<?= $r->animeName ?>\'\'')"
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