<footer class="main-footer container-fluid py-lg-2">
    <div class="container-fluid pb-lg-3 mt-2">
        <span class="text-white pl-lg-5 font-weight-bold" style="font-size: 13px;">A-Z List <span class="font-weight-light"> | Searching anime order by alphabet name A to Z.</span></span>
    </div>
    <div class="container-fluid pl-lg-3">
        <ul>
            <li><a href="<?= ROOTURL ?>az-list?q=all">All</a></li>
            <li><a href="<?= ROOTURL ?>az-list?q=0-9">0-9</a></li>
            <?php for($i = 'A'; $i <= 'Z'; $i++): ?>
                <li><a href="<?= ROOTURL ?>az-list?q=<?= $i ?>"><?= $i ?></a></li>
                <?php if($i == 'Z') break; ?>
            <?php endfor; ?>
        </ul>
    </div>

    <div class="container-fluid mt-4 pl-lg-5 pl-md-5 text-white-50">
        <div class="row pl-2" style="position: relative;">
            <div class="col-6">
                <img src="<?= ROOTURL ?>images/logo.png" class="pt-3" style="width: 130px;">
                <p>Copyright ©anime.anime All Rights Reserved</p>

                <div class="container-fluid pl-0 py-1 social">
                    <i class="fab fa-facebook-square social-icon"></i>
                    <i class="fab fa-twitter-square social-icon"></i>
                    <i class="fab fa-discord social-icon"></i>
                </div>
                <p class="pt-3 font-weight-light text-muted">Disclaimer: This site does not store any files on its server. All contents are provided by non-affiliated third parties.</p>
            </div>

            <div class="col-2 c-a links-style">
                <p class="pt-3 text-white m-0">Help</p>
                <span class="font-weight-light"><a href="<?= ROOTURL ?>contact">Contact</a></span><br>
                <span class="font-weight-light"><a href="#" data-toggle="modal" data-target="#requestModal">Request</a></span>
            </div>

            <div class="col-2 c-a links-style">
                <p class="pt-3 text-white m-0">Links</p>
                <span class="font-weight-light"><a href="<?= ROOTURL ?>az-list?q=all">A-Z List</a></span><br>
                <span class="font-weight-light"><a href="<?= ROOTURL ?>recently-added">Recently Added</a></span><br>
            </div>

            <div class="pic" style="position: absolute; right: 0; bottom: 0px;">
                <img src="<?= ROOTURL ?>images/rem.png" style="width: 350px;">
            </div>

        </div>
    </div>
</footer>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js"></script>
<script src="<?= ROOTURL ?>assets/readmore/src/readMoreJS.min.js"></script>
<script>
    let baseUrl = '<?= ROOTURL ?>';
    $(document).ready(function(){
        $('input').tooltip();

        $("#requestModal").on('hidden.bs.modal', ()=> {
            $('.req').remove();
            $('input[name="anime"]').val('');
        });

    });

    $('#requestModal').submit((e) => {

        e.preventDefault();
        if($('input[name="anime"]').val() == ''){
            $('.alert-modal-request').append('<div class="alert alert-danger req">Field is required.<button class="close" data-dismiss="alert">&times;</button></div>')
        }else{
            let seconds = 3;
            let btn = $('.btn-anime-request');
            btn.prop('disabled', true);
            $('.req').remove();

            let loader = '';
            for(let i = 0; i < 5; i++){
                loader += '<div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div>';
            }
            $('.request-load').append(loader);

            setTimeout(() => {
                btn.prop('disabled', false);
                $('.spinner-grow').remove();
                $.ajax({
                    url: baseUrl + 'ajax/anime-request',
                    type: "POST",
                    data: $('#requestModal').serialize(),
                    success: function(){
                        $('.alert-modal-request').append('<div class="alert alert-success req">Your request has been sent.<button class="close" data-dismiss="alert">&times;</button></div>')
                    },
                    error: function () {
                        $('.alert-modal-request').append('<div class="alert alert-danger req">Something is wrong.<button class="close" data-dismiss="alert">&times;</button></div>')
                    }
                });
                $('input[name="anime"]').val('');
            }, seconds*1000);
        }
    })

</script>
<script>
    <?php if(isset($_GET['episode'])): ?>
        $readMoreJS.init({
            target: '.storySypnosis',
            numOfWords: 50,
            toggle: true,
            moreLink: 'Read more...',
            lessLink: 'Read less'
        });
        console.log('test');

     $(document).ready(function(){
         $("#reportModal").on('hidden.bs.modal', ()=> {
             $('.rep').remove();
             $('textarea[name="reportReason"]').val('');
         });

     });

    $('#reportModal').submit((e) => {
        e.preventDefault();
        if ($('textarea[name="reportReason"]').val() == '') {
            $('.alert-modal-report').append('<div class="alert alert-danger rep">Field is required.<button class="close" data-dismiss="alert">&times;</button></div>')
        } else {
            let seconds = 3;
            let btn = $('.btn-anime-report');
            btn.prop('disabled', true);
            $('.rep').remove();

            let loader = '';
            for (let i = 0; i < 5; i++) {
                loader += '<div class="spinner-grow text-primary" role="status"><span class="sr-only">Loading...</span></div>';
            }
            $('.report-load').append(loader);

            setTimeout(() => {
                btn.prop('disabled', false);
                $('.spinner-grow').remove();
                $.ajax({
                    url: baseUrl + 'ajax/anime-report',
                    type: "POST",
                    data: {
                        animeName: "<?= $_GET['anime'] ?>",
                        episodeNumber: "<?= $_GET['episode'] ?>",
                        reason: $('textarea[name="reportReason"]').val()
                    },
                    success: function (d) {
                        $('.alert-modal-report').append('<div class="alert alert-success rep">Your report has been sent.<button class="close" data-dismiss="alert">&times;</button></div>')
                    },
                    error: function () {
                        $('.alert-modal-report').append('<div class="alert alert-danger rep">Something is wrong.<button class="close" data-dismiss="alert">&times;</button></div>')
                    }
                });
                $('textarea[name="reportReason"]').val('');
            }, seconds * 1000);
        }
    });
    <?php endif; ?>

    $(document).ready(function() {
        multiselect('#dropdown-genre', 'Genre');
        multiselect('#dropdown-year', 'Year');
        multiselect('#dropdown-type', 'Type');
        multiselect('#dropdown-sort', 'Sort', false);
    });

    //Type Boolean
    function multiselect(idClass, name, type = true) {
        if(type){
            var orderCount = 0;
            $(idClass).multiselect({
                buttonContainer: '<div style="background-color: #D5D5D5; border-radius: 6px"></div>',
                enableFiltering: true,
                onChange: function (option, checked) {
                    if (checked) {
                        orderCount++;
                        $(option).data('order', orderCount);
                    } else {
                        $(option).data('order', '');
                    }
                },
                buttonText: function (options) {
                    if (options.length === 0) {
                        return name + ' All';
                    } else if (options.length > 1) {
                        return name + ' ' + options.length + ' selected';
                    } else {
                        var selected = [];
                        options.each(function () {
                            selected.push([$(this).text(), $(this).data('order')]);
                        });

                        selected.sort(function (a, b) {
                            return a[1] - b[1];
                        });

                        var text = '';
                        for (var i = 0; i < selected.length; i++) {
                            text += selected[i][0] + ', ';
                        }
                        let t = text.substr(0, text.length - 2);
                        if (t.length >= 8)
                            t = t.substr(0, 7) + '..';
                        return name + ' ' + t;
                    }
                },
            });
        }else{
            $(idClass).multiselect({
                buttonContainer: '<div style="background-color: #D5D5D5; border-radius: 6px"></div>',
                buttonText: function(options) {
                    var selected = [];
                    options.each(function() {
                        selected.push([$(this).text(), $(this).data('order')]);
                    });
                    selected.sort(function(a, b) {
                        return a[1] - b[1];
                    });

                    var text = '';
                    for (var i = 0; i < selected.length; i++) {
                        text += selected[i][0] + ', ';
                    }
                    let t = text.substr(0, text.length -2);
                    if(t.length > 11)
                        t = t.substr(0, 10) + '..';
                    return name+' '+ t;
                },
            });
        }
    }
    // $(document).ready(function() {
    //     var orderCount = 0;
    //     $('#dropdown-genre').multiselect({
    //         buttonContainer: '<div style="background-color: #D5D5D5; border-radius: 6px"></div>',
    //         enableFiltering: true,
    //         onChange: function(option, checked) {
    //             if (checked) {
    //                 orderCount++;
    //                 $(option).data('order', orderCount);
    //             }
    //             else {
    //                 $(option).data('order', '');
    //             }
    //         },
    //         buttonText: function(options) {
    //             if (options.length === 0) {
    //                 return 'Genre all';
    //             }
    //             else if (options.length > 1) {
    //                 return 'Genre ' + options.length + ' selected';
    //             }
    //             else {
    //                 var selected = [];
    //                 options.each(function() {
    //                     selected.push([$(this).text(), $(this).data('order')]);
    //                 });
    //
    //                 selected.sort(function(a, b) {
    //                     return a[1] - b[1];
    //                 });
    //
    //                 var text = '';
    //                 for (var i = 0; i < selected.length; i++) {
    //                     text += selected[i][0] + ', ';
    //                 }
    //                 let t = text.substr(0, text.length -2);
    //                 if(t.length >= 8)
    //                     t = t.substr(0, 7) + '..';
    //                 return 'Genre '+ t;
    //             }
    //         },
    //     });
    //     $('#dropdown-sort').multiselect({
    //         buttonContainer: '<div></div>',
    //         buttonText: function(options) {
    //             var selected = [];
    //             options.each(function() {
    //                 selected.push([$(this).text(), $(this).data('order')]);
    //             });
    //             selected.sort(function(a, b) {
    //                 return a[1] - b[1];
    //             });
    //
    //
    //
    //             var text = '';
    //             for (var i = 0; i < selected.length; i++) {
    //                 text += selected[i][0] + ', ';
    //             }
    //             let t = text.substr(0, text.length -2);
    //             if(t.length > 11)
    //                 t = t.substr(0, 10) + '..';
    //             return 'Sort '+ t;
    //         },
    //     });
    //     $('#dropdown-year').multiselect({
    //         buttonContainer: '<div></div>',
    //         enableFiltering: true,
    //         onChange: function(option, checked) {
    //             if (checked) {
    //                 orderCount++;
    //                 $(option).data('order', orderCount);
    //             }
    //             else {
    //                 $(option).data('order', '');
    //             }
    //         },
    //         buttonText: function(options) {
    //             if (options.length === 0) {
    //                 return 'Year all';
    //             }
    //             else if (options.length > 1) {
    //                 return 'Year ' + options.length + ' selected';
    //             }
    //             else {
    //                 var selected = [];
    //                 options.each(function() {
    //                     selected.push([$(this).text(), $(this).data('order')]);
    //                 });
    //
    //                 selected.sort(function(a, b) {
    //                     return a[1] - b[1];
    //                 });
    //
    //                 var text = '';
    //                 for (var i = 0; i < selected.length; i++) {
    //                     text += selected[i][0] + ', ';
    //                 }
    //                 let t = text.substr(0, text.length -2);
    //                 if(t.length > 11)
    //                     t = t.substr(0, 10) + '..';
    //                 return 'Year '+ t;
    //             }
    //         },
    //     });
    //     $('#dropdown-type').multiselect({
    //         buttonContainer: '<div></div>',
    //         enableFiltering: true,
    //         onChange: function(option, checked) {
    //             if (checked) {
    //                 orderCount++;
    //                 $(option).data('order', orderCount);
    //             }
    //             else {
    //                 $(option).data('order', '');
    //             }
    //         },
    //         buttonText: function(options) {
    //             if (options.length === 0) {
    //                 return 'Type all';
    //             }
    //             else if (options.length > 1) {
    //                 return 'Type ' + options.length + ' selected';
    //             }
    //             else {
    //                 var selected = [];
    //                 options.each(function() {
    //                     selected.push([$(this).text(), $(this).data('order')]);
    //                 });
    //
    //                 selected.sort(function(a, b) {
    //                     return a[1] - b[1];
    //                 });
    //
    //                 var text = '';
    //                 for (var i = 0; i < selected.length; i++) {
    //                     text += selected[i][0] + ', ';
    //                 }
    //                 let t = text.substr(0, text.length -2);
    //                 if(t.length > 11)
    //                     t = t.substr(0, 10) + '..';
    //                 return 'Type '+ t;
    //             }
    //         },
    //     });
    // });
</script>
</body>
</html>