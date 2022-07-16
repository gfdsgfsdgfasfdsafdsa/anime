<div class="breadcrumb-holder mb-2">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= ROOTURL ?>admin/slider">Slider</a></li>
            <li class="breadcrumb-item active">View</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb-->
<div class="container-fluid mb-3 mt-2">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Slider</h4>
                <a href="<?= ROOTURL ?>admin/slider/new" class="btn btn-primary text-center <?= (count($sliderItems) == 10?'disabled':'') ?>"><i class="fas fa-laptop"></i> Add new banner</a>
            </div>

        </div>
        <div class="card-body">
            <?php flashMessage(); ?>
            <label class="form-control-label text-uppercase text-primary font-weight-bold">Select Anime Max is 10</label>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-md table-bordered">
                    <thead>
                    <tr class="bg-dark">
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Anime</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Banner Img Link</td>
                        <td class="small text-center font-weight-bold text-light px-3 py-2">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($sliderItems)): ?>
                        <?php foreach ($sliderItems as $s): ?>
                            <tr>
                                <td class="small text-center font-weight-bold"><?= $s->title ?></td>
                                <td class="small text-center font-weight-bold">
                                    <a href="<?= $s->bannerLink ?>" target="_blank"><?= $s->bannerLink ?></a>
                                </td>
                                <td class="small justify-content-center font-weight-bold text-center">
                                    <a href="<?= ROOTURL ?>admin/slider/delete?id=<?= $s->id ?>"
                                       onclick="return confirm('Are you sure you want to remove this item anime \'\'<?= $s->title ?>\'\'')"
                                       class="text-red text-center"><i class="fa fa-trash"></i>Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>