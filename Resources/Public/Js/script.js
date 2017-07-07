$(document).ready(function(){
    // Tool Tip
    var tooltips = $( "[title]" ).tooltip({
        tooltipClass:'infotip',
        show: {
            effect: "slideDown",
            delay: 300
        },
        hide: {
            effect: "slideUp",
            delay: 300
        },
        track: true
    });
    
    $( "#tabs" ).tabs();

    $('#datepicker').datepicker({
        changeMonth: true,
        changeYear: true,    
        showButtonPanel: true,
        yearRange: "-100:+0",
        dateFormat: 'yy-mm-dd',
        autoclose: false
    });
    
    // Show model on click
    // Init dialog
    $( "#dialog" ).dialog({
      autoOpen: false,
      wdth:'100%',
      show: {
        effect: "fade",
        duration: 2500
      },
      hide: {
        effect: "fade",
        duration: 1000
      }
    });

    //Call function to get categories on the form
    getCate();

    // Insert Data
    $('#myform').on('submit',function validation(e){
            e.preventDefault();
            var pname = document.getElementById("proname").value;
            var pprice = document.getElementById("proprice").value;
            var pmfg = document.getElementById("datepicker").value;
            var pcname = document.getElementById("companyname").value;
            var pclicense = document.getElementById("companylicense").value;
            var pcateg = document.getElementById("catselector").value;
            var pdesc = document.getElementById("prodesc").value;

            if (pname == '' || pprice == '' || pmfg == '' || pcname == '' || pclicense == '' || pcateg == '' || pdesc == '' ){
                alert("Fill All Fields");
                return false;
            }else{
                $.ajax({
                    url : $(this).attr('action') || window.location.pathname,
                    type: "post",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#btn').html('Saving...'); // change submit button text
                    },
                    success: function (msg) {
                        alert('Product Saved..!');
                        $("#myform").trigger('reset');
                        $('#btn').html('Add Product');
                    },
                    error: function (jXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
    });

    /*
    * Search functionality with auto complete
    */
    function split( val ) {
      return val.split( /,\s*/ );
    }

    function extractLast( term ) {
      return split( term ).pop();
    }

    function log( message ) {
        $( "<div>" ).text( message ).prependTo( "#log" );
        $( "#log" ).scrollTop( 0 );
    }

    // Auto complate
    $("#searchPro").autocomplete({
        source: function(request,response) {
            $.ajax({
                url: "php.func.php?request=findIt",
                type: "POST",
                data: { term: request.term },
                success: function (searchData) {
                    $('#searchLog').html(searchData);
                }
            })
        }
    });
    

    /*
    * Search functionality with slider
    */

    // Search by Range slider
    var sliderTooltip = function(event, ui) {
        var curValue = ui.value;
        var target = ui.handle ;
        var tooltip = '<div class="ttip"><div class="ttip-inner">' + curValue + '</div></div>';
       $(target).html(tooltip);
    }

    $( "#slider-range-min" ).slider({
        range: "min",
        value: 0,
        min: 1,
        max: 10000,
        create: sliderTooltip,
        slide: sliderTooltip,
        stop:function(event, ui ){
            $.ajax({
                url: "php.func.php?request=findbyPrice",
                type: "POST",
                data: {mx:ui.value,actAs:'mx'},
                success: function (viewData) {
                    $('#searchLog').html(viewData);
                }
            });
        }
    });

    $("#slider").slider({
        value: 300,
        min: 100,
        max: 500,
        step: 1,
        create: sliderTooltip,
        slide: sliderTooltip
    });
});

// Delete Record
function delRecord(Rec){
    // body...// Get categories
    $.ajax({
        url: "php.func.php?request=delRec",
        async: false,
        data:{recId:Rec},
        beforeSend: function() {
            $('#del').html('Removing...'); // change button text untill record delete
        },
        success: function(delData){
            alert('Product Deleted..!');
            $('#del').html('Remove');
            getAll();
        }
    });
};

// Open MyForm for update purposes
function openMyform(recId){
    $.ajax({
        url: "php.func.php?request=getPro",
        async: false,
        dataType:'json',
        data:{rec:recId},
        success: function(datas){                
            alert(datas.product_name);
            $("#dialog").dialog( "open" );
        }
    });
}

// Get categories
function getCate (view) {
    if (view=='chk') {
        $.ajax({
            url: "php.func.php?request=getCat&view=chk",
            async: false,
            success: function(data){
                $('#categorychk').html(data);
            }
        });
    }else{
        // Get categories on the form
        $.ajax({
            url: "php.func.php?request=getCat",
            async: false,
            success: function(data){
                $('#categoryList').html(data);
            }
        });
    }
}

// Onclick Open popover..
function clc(){
    $('#newcat').popover({
        html: 'true',
        placement: 'bottom',
        content : function() {
            return $('#popover-content').html();
        }
    });
}

// Single categories Action..
function CategAction(act){
    var catVal = $('#NewCat').val();

    if( catVal == ''){
        alert('Fill Required Field');return false;
    }else{
        if (act == 'del') {
            $.ajax({
                url: "php.func.php?request=CatOpt",
                async: false,
                data:{newCatName:catVal,act:'del'},
                success: function(datas){                
                    alert(datas);
                    $("#NewCat").trigger('reset');
                    getCate();
                }
            });
        }else{
            $.ajax({
                url: "php.func.php?request=CatOpt",
                async: false,
                data:{newCatName:catVal,act:'add'},
                success: function(datas){
                    alert(datas);
                    $("#NewCat").trigger('reset');
                    getCate();
                }
            });
        }
    }    
}

// Get all data from the db
function getAll() {
    $.ajax({
        url: "php.func.php?request=getAll",
        async: false,
        success: function(data){
            $('#tbl-info').html(data);
        }
    });
}

// Find by checkbox
function FindbyChech(){
    var checkValues = $('input[name=chk]:checked').map(function(){
        return $(this).val();
    }).get();

    if (checkValues == '') {
        alert('Select Category First');return false;
    }else{
        $.ajax({
            url: "php.func.php?request=findByChk",
            type: "POST",
            data: { info:checkValues },
            success: function (chkdata) {
                $('#searchLog').html(chkdata);
                // alert(chkdata);return false;
            }
        })
    }
}