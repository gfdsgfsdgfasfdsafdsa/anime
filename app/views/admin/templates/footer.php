<!-- Page Footer-->
<footer class="main-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <p>Anime &copy; 2021</p>
            </div>
            <div class="col-sm-6 text-right">
                <p>Powered by <a href="" class="external">Agol</a></p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
</div>
<!-- JavaScript files-->
<script src="<?= ROOTURL ?>assets/js/jquery.min.js"></script>
<script src="<?= ROOTURL ?>assets/js/popper.min.js"> </script>
<script src="<?= ROOTURL ?>assets/js/bootstrap.min.js"></script>
<!--    <script src="--><?//= ROOTURL ?><!--assets/js/jquery-validation/jquery.validate.min.js"></script>-->
<script type="text/javascript" src="<?= ROOTURL ?>assets/js/datatables.min.js"></script>
<script src="<?= ROOTURL ?>assets/js/front.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js"></script>
<script src="<?= ROOTURL ?>assets/readmore/src/readMoreJs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
<!-- Functions -->
<script>
    function searchStyleDataTable(){
        $('.dataTables_filter input[type="search"]').css(
            {'width':'300px','display':'inline-block'}
        );
    }
    function basicDataTable(){
        $('.viewAllItemsTable').DataTable({
            "autoWidth": false,
            "order": [[ 0, "desc" ]]
        });
    }
</script>
<!-- Genre and Type Index -->
<script>
<?php if(isset($current) && ($current == 'genreIndex' || $current == 'typeIndex' || $current == 'userIndex' || $current == 'report')): ?>
    $(document).ready(function() {
        basicDataTable();
        searchStyleDataTable();
    });
<?php elseif(isset($current) && $current == 'sliderCreate'): ?>
    $(document).ready(function() {
        $('.selectAnime').multiselect({
            buttonContainer: '<div></div>',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
        });

        $('#previewModal').on('hidden.bs.modal', function (e) {
            $('.modal-body').remove();
        })

        $('#previewModal').on('show.bs.modal', function (e) {

            let bannerLinkInput = $('input[name="bannerLink"]');
            $('.modal-bb').append('<div class="modal-body"></div>');

            let top = "";
            let bottom = "";
            if($('input[name="marginTop"]').val() != '' && $.isNumeric($('input[name="marginTop"]').val())){
                top = 'top:'+$('input[name="marginTop"]').val()+'px;';
            }
            if($('input[name="marginBottom"]').val() != '' && $.isNumeric($('input[name="marginBottom"]').val())){
                bottom = 'bottom:'+$('input[name="marginBottom"]').val()+'px;';
            }

            if(bannerLinkInput.val() == ''){
                $('#previewModal').find('.modal-body').append('<div style="width: 400px; height: 100px;" class="text-center mt-5">Please enter image link.</div>');
            }else{
                // $('#previewModal').find('.modal-body').append('<div style="width: 961px; height: 413px; border: 1px solid gray;overflow: hidden;position: relative">' +
                //     '<img src="'+bannerLinkInput.val()+'" ' +
                //     'style="object-fit: cover;width: 100%;height: 100%;margin-bottom: 50px">' +
                //     '<div style="position: absolute;width: 100%;height: 100px;bottom: 0;background-color: rgb(59, 93, 155);z-index: 100"></div>' +
                //     '</div>');
                $('#previewModal').find('.modal-body').append('<div style="width: 961px; height: 415px;overflow: hidden;position: relative">' +
                    '<img src="'+bannerLinkInput.val()+'" ' +
                    'style="width: 100%;height: auto;object-fit: cover;position: absolute;'+top+bottom+'" alt="Image not found.">' +
                    '<div style="position: absolute;width: 100%;height: 100px;bottom: 0;background-color: white;z-index: 100"></div>' +
                    '</div>');
            }
        })
    });
<?php elseif(isset($current) && $current == 'request' ): ?>
    $(document).ready(function() {
        $('.viewAllItemsTable').DataTable({
            "autoWidth": false,
            "order": [[ 1, "desc" ]]
        });
    });
<?php elseif(isset($current) && ($current == 'typeCreate' || $current == 'typeUpdate')): ?>
    $(document).ready(function() {
        if($('input[name$="typeName"]').val() == ''){
            $('.preview-style').text('Text');
        }else{
            $('.preview-style').text($('input[name$="typeName"]').val());
        }
        if($('input[name$="backgroundColor"]').val() != ''){
            $('.preview-style').css('background', $('input[name$="backgroundColor"]').val())
        }
        console.log($('input[name$="backgroundColor"]').val())

        $('input[name$="typeName"]').keyup(() => {
            let input = $('input[name$="typeName"]');
            if(input.val() != ''){
                $('.preview-style').text($('input[name$="typeName"]').val());
            }else{
                $('.preview-style').text('Text');
            }
        })

        $('input[name$="backgroundColor"]').change(() => {
            $('.preview-style').css('background', $('input[name$="backgroundColor"]').val())
        })
    });
<!-- Anime Index -->
<?php elseif (isset($current) && $current == 'animeIndex'): ?>
    $(document).ready(function() {
        $('.viewAllItemsTableAnime').DataTable({
            "order": [[ 0, "desc" ]],
            "autoWidth": false,
            "columnDefs": [
                { "width": "18%", "targets": 6 },
                { "width": "5%", "targets": 0 }
            ]
        });
        searchStyleDataTable();
    });

<?php elseif(isset($current) && $current == 'animeCreate'): ?>
    var orderCount = 0;
    $('.multiSelect').multiselect({
        buttonContainer: '<div></div>',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
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
                return '--Select--';
            } else if (options.length > 4) {
                return options.length + ' selected';
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
                    if(i === selected.length-1){
                        text += selected[i][0];
                    }else{
                        text += selected[i][0] + ', ';
                    }
                }
                return text.length > 35 ? text.substr(0, 35)+'..' : text;
            }
        },
    });

<!-- anime view -->
<?php elseif (isset($current) && $current == 'animeView'): ?>
    $readMoreJS.init({
        target: '.storySypnosis',
        numOfWords: 50,
        toggle: true,
        moreLink: 'Read more...',
        lessLink: 'Read less'
    });

<!-- Episode Index -->
<?php elseif(isset($current) && $current == 'episodeIndex'): ?>
    $(document).ready(function() {
        $('.selectAnime').multiselect({
            buttonContainer: '<div></div>',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            // buttonText: function (options) {
            //     var selected = [];
            //     options.each(function () {
            //         selected.push([$(this).text(), $(this).data('order')]);
            //     });
            //
            //     selected.sort(function (a, b) {
            //         return a[1] - b[1];
            //     });
            //
            //     var text = '';
            //     for (var i = 0; i < selected.length; i++) {
            //         if(i === selected.length-1){
            //             text += selected[i][0];
            //         }else{
            //             text += selected[i][0] + ', ';
            //         }
            //     }
            //     return text.length > 100 ? text.substr(0, 100)+'..' : text;
            // },
        });
        // var orderCount = 0;
        // $('.selectAnime').multiselect({
        //     buttonContainer: '<div></div>',
        //     enableFiltering: true,
        //     enableCaseInsensitiveFiltering: true,
        //     onChange: function (option, checked) {
        //         if (checked) {
        //             orderCount++;
        //             $(option).data('order', orderCount);
        //         } else {
        //             $(option).data('order', '');
        //         }
        //     },
        //     buttonText: function (options) {
        //         var selected = [];
        //         options.each(function () {
        //             selected.push([$(this).text(), $(this).data('order')]);
        //         });
        //
        //         selected.sort(function (a, b) {
        //             return a[1] - b[1];
        //         });
        //
        //         var text = '';
        //         for (var i = 0; i < selected.length; i++) {
        //             if(i === selected.length-1){
        //                 text += selected[i][0];
        //             }else{
        //                 text += selected[i][0] + ', ';
        //             }
        //         }
        //         return text.length > 100 ? text.substr(0, 100)+'..' : text;
        //     },
        // });
        <?php if($current == 'episodeIndex'): ?>
            $('.viewAllItemsTableEpisodes').DataTable({
                "order": [[ 0, "desc" ]],
                "autoWidth": false,
                "columnDefs": [
                    { "width": "17%", "targets": 3 },
                ]
            });
            searchStyleDataTable();
        <?php endif; ?>
    });
<?php elseif (isset($current) && $current == 'episodeCreate'): ?>
    var formIds = ['add-form-1'];
    $(document).ready(function(){

        var maxField = 1000; //Input fields increment limitation
        var addButton = $('.addItemutton'); //Add button selector
        var wrapper = $('.itemInfoField'); //Input field wrapper

        var x = 1; //Initial field counter is 1
        var formIdCount = 2;
        //Once add button is clicked
        $(addButton).click(function(){
            var formId = "add-form-"+formIdCount;

            formIds.push(formId);
            var lastInputValue = parseInt($("#"+formIds[formIds.length-2]+' input[name="episodeNumber[]"]').val()) + 1
            console.log(lastInputValue)
            var fieldHTML = '<div class="form-group" id="'+formId+'"><div class="row mb-3"><div class="col-lg-8 col-md-3 col-sm-12"><input type="text" name="episodeLink[]" placeholder="Enter Episode Link" class="form-control" autocomplete="off" required></div><div class="col-lg-3 col-md-3 col-sm-12"><input type="number" name="episodeNumber[]" value="'+lastInputValue+'" placeholder="Enter Episode Number" class="form-control" required></div><div class="col-lg-1 col-md-1 col-sm-12 text-left"><a href="javascript:void(0);" class="removeItemButton btn btn-danger form-control" onclick=removeItem("'+formId+'") title="Remove Item">-</a></div></div></div>';
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                formIdCount++;
                $(wrapper).append(fieldHTML); //Add field html
            }

        });

    });

    function removeItem($id){
        formIds.splice($.inArray($id, formIds), 1);
        document.getElementById($id).remove(); //Remove field html
    }
<?php endif; ?>
</script>

</body>
</html>

