<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/type">Type</a></li>
            <li class="breadcrumb-item active">View All</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb-->
<div class="container-fluid mb-3 mt-2">
    <div class="card">
        <div class="card-header">
            <h4>All Types</h4>
        </div>
        <div class="card-body">
            <?php flashMessage() ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-md table-bordered viewAllItemsTable">
                    <thead>
                    <tr class="bg-dark">
                        <td style="width: 10%" class="small text-center font-weight-bold text-light px-3 py-2">ID</td>
                        <td style="width: 75%" class="small text-center font-weight-bold text-light px-3 py-2">Genre</td>
                        <td style="width: 15%" class="small text-center font-weight-bold text-light px-3 py-2">Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($types as $t): ?>
                        <tr>
                            <td class="small text-center font-weight-bold"><?= $t->id ?></td>
                            <td class="small text-center font-weight-bold"><span class="text-white px-2"
                                        style="border-radius:3px;background-color: <?php if(!empty($t->backgroundColor)) echo $t->backgroundColor; else echo 'black'; ?>"
                                ><?= $t->typeName ?></span></td>
                            <td class="small d-flex justify-content-center font-weight-bold">
                                <div class="actions">
                                    <div><a href="<?= ROOTURL ?>admin/type/update?id=<?= $t->id ?>"><i class="fa fa-edit"></i>Update</a></div>
                                    <div><a href="<?= ROOTURL ?>admin/type/delete?id=<?= $t->id ?>"
                                            onclick="return confirm('Are you sure you want to delete this type \'\'<?= $t->typeName ?>\'\'')"
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