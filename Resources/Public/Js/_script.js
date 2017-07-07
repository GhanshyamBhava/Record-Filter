$(function() {
    $.ajax({
        type: "POST",
        url: "",
        paramname: 'Filedata',
        contentType: false,
        processData: false,
        data: {name:'ghanshyam'},
        success:function(ret){
            alert(ret);
        },
    });
});
$(function() {


    // Init main tab
    $( "#tabs" ).tabs();
    // inner tabs
    $( "#inner-tabs-1" ).tabs();
    $( "#inner-tabs-2" ).tabs();
    

/*
* Jquery Interaction property
-------------------------------------------------------------------------------------
* Interactions : DRAGGABLE
*/

    var $start_counter = $( "#event-start" ),
        $drag_counter = $( "#event-drag" ),
        $stop_counter = $( "#event-stop" ),
        counts = [ 0, 0, 0 ];

    // Draggable and event.
    $('#draggable').draggable({
        containment: "#t-1",
        scroll:true,
        start: function() {
            counts[ 0 ]++;
            updateCounterStatus( $start_counter, counts[ 0 ] );
        },
        drag: function() {
            counts[ 1 ]++;
            updateCounterStatus( $drag_counter, counts[ 1 ] );
        },
        stop: function() {
            counts[ 2 ]++;
            updateCounterStatus( $stop_counter, counts[ 2 ] );
        }
    });

    function updateCounterStatus( $event_counter, new_count ) {
        $( "span.count", $event_counter ).text( new_count );
    }

    // Sortable
    $( "#sortable" ).sortable({
        revert: true
    });

    // Draggable
    $( "#draggablelist" ).draggable({
        connectToSortable: "#sortable",
        opacity: 0.7,
        cursor: "move",
        cursorAt:{top:0,left:0},
        helper: "clone",
        scroll: true,
        revert: "invalid"
    });
    
/*
* Jquery Interaction property
--------------------------------------------------------------------------------------------------
* Interactions : DRAGGABLE & DROPPABLE
*/


    // Acceptable and non
    $( "#draggablescope, #draggable-nonvalid" ).draggable();
    $( "#droppablescope" ).droppable({
        accept: "#draggablescope",
        classes: {
            "ui-droppable-active": "ui-state-active",
            "ui-droppable-hover": "ui-state-hover"
        },
        drop: function( event, ui ) {
            $( this ).addClass( "ui-state-highlight" ).find( "p" ).html( "Dropped!" );
        }
    });

    // Revertable and non-revertable
    $( "#draggableitem" ).draggable({ revert: "valid" });
    $( "#draggableitem2" ).draggable({ revert: "invalid" });

    $( "#droppableitem" ).droppable({
        classes: {
            "ui-droppable-active": "ui-state-active",
            "ui-droppable-hover": "ui-state-hover"
        },
        drop: function(event, ui) {
            $(this).addClass("ui-state-highlight").find("p").html("Dropped!");
        }
    });

/*
* Example photo gallery with draggable and droppable
*-------------------------------------------------------------------------------------------------
* Theres the gallery and the trash
*/
    var $gallery = $("#gallery"),
        $trash = $("#trash");
 
    // Let the gallery items be draggable
    $("li",$gallery).draggable ({
        opacity: 0.5,
        cancel: "a.ui-icon", // clicking an icon won't initiate dragging
        revert: "invalid", // when not dropped, the item will revert back to its initial position
        containment: "document",
        helper: "clone",
        cursor: "move"
    });

    // Draggable trash
    $trash.draggable();
    
    // Let the trash be droppable, accepting the gallery items
    $trash.droppable({
        accept: "#gallery > li",
        classes: {
            "ui-droppable-active": "ui-state-highlight"
        },
        drop: function(event,ui) {
            deleteImage(ui.draggable);
        }
    });
 
    // Let the gallery be droppable as well, accepting items from the trash
    $gallery.droppable({
        accept: "#trash li",
        classes: {
            "ui-droppable-active": "custom-state-active"
        },
        drop: function( event, ui ) {
            recycleImage( ui.draggable );
        }
    });
 
    // Image deletion function
    var recycle_icon = "<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>";
    function deleteImage( $item ) {
      $item.fadeOut(function() {
        var $list = $( "ul", $trash ).length ?
          $( "ul", $trash ) :
          $( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $trash );
 
        $item.find( "a.ui-icon-trash" ).remove();
        $item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
          $item
            .animate({ width: "48px" })
            .find( "img" )
              .animate({ height: "36px" });
        });
      });
    }
 
    // Image recycle function
    var trash_icon = "<a href='link/to/trash/script/when/we/have/js/off' title='Delete this image' class='ui-icon ui-icon-trash'>Delete image</a>";
    function recycleImage( $item ) {
      $item.fadeOut(function() {
        $item
          .find( "a.ui-icon-refresh" )
            .remove()
          .end()
          .css( "width", "96px")
          .append( trash_icon )
          .find( "img" )
            .css( "height", "72px" )
          .end()
          .appendTo( $gallery )
          .fadeIn();
      });
    }
 
    // Image preview function, demonstrating the ui.dialog used as a modal window
    function viewLargerImage( $link ) {
      var src = $link.attr( "href" ),
        title = $link.siblings( "img" ).attr( "alt" ),
        $modal = $( "img[src$='" + src + "']" );
 
      if ( $modal.length ) {
        $modal.dialog( "open" );
      } else {
        var img = $( "<img alt='" + title + "' width='384' height='288' style='display: none; padding: 8px;' />" )
          .attr( "src", src ).appendTo( "body" );
        setTimeout(function() {
          img.dialog({
            title: title,
            width: 400,
            modal: true
          });
        }, 1 );
      }
    }
 
    // Resolve the icons behavior with event delegation
    $( "ul.gallery > li" ).on( "click", function( event ) {
      var $item = $( this ),
        $target = $( event.target );
 
      if ( $target.is( "a.ui-icon-trash" ) ) {
        deleteImage( $item );
      } else if ( $target.is( "a.ui-icon-zoomin" ) ) {
        viewLargerImage( $target );
      } else if ( $target.is( "a.ui-icon-refresh" ) ) {
        recycleImage( $item );
      }
 
      return false;
    });
    
    if (window.FormData === undefined) {
        alert("HTML5 Not Supported, Please Use Regular Uploading Method");
    }
 
    var $box = $("#ulbox");
        $box.bind("dragenter", dragEnter);

        $box.bind("dragover", dragLeave);
        $box.bind("drop", drop);

    function dragEnter(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        console.log("dragEnter...");
        $(evt.target).addClass('over');
        return false;
    }
    function dragLeave(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        console.log("drag leave...");
        $(this).css('background-color', 'white');
        $(evt.target).removeClass('over');
        return false;
    }


    function drop(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        $(evt.target).removeClass('over');

        var files = evt.originalEvent.dataTransfer.files;

        document.getElementById('ulbox').innerHTML = 'Files Uploaded '+files.length;
        var uploadFormData = new FormData($("#uploadformid")[1]);
        
        // if(files.length > 0) { // checks if any files were dropped
        //     for(f = 0; f < files.length; f++) { // for-loop for each file dropped
        //         uploadFormData.append("files&#91;&#93;",files&#91;f&#93;);  // adding every file to                                                                                         the form so you could upload multiple files
        //     }
        // }

        
    }

    $( "#textarea" ).resizable({
        handles: "se"
    });

    $( "#resizable" ).resizable({
        animate: true,
        containment: "#container",
        maxHeight: 250,
        maxWidth: 350,
        minHeight: 150,
        minWidth: 200
    });

    $( "#selectable" ).selectable({
        stop: function() {
            var result = $("#select-result").empty();
            $(".ui-selected", this).each(function() {
                var index = $("#selectable li").index(this);
                result.append("#"+(index+1) );
            });
        }
    });

    // Sortable
    $( function() {
        $( "#sortable1, #sortable2" ).sortable({
            connectWith: ".connectedSortable"
        }).disableSelection();
    });

    $("#accordion" )
        .accordion({
            header: "> div > h3"
        })
        .sortable({
        axis: "y",
        handle: "h3",
        stop: function( event, ui ) {
            // IE doesn't register the blur when sorting
            // so trigger focusout handlers to remove .ui-state-focus
            ui.item.children( "h3" ).triggerHandler( "focusout" );
     
            // Refresh accordion to handle new order
            $( this ).accordion( "refresh" );
        }
    });

});

/*
* Effect Dropdown
*/
$('#effectTypes').on('change',function(){
    runEffect($( "#effectTypes" ).val());
    return false;
});
// run the currently selected effect
function runEffect(selectedEffect) {
  
  // Most effect types need no options passed by default
  var options = {};
  // some effects have required parameters
  if ( selectedEffect === "scale" ) {
    options = { percent: 50 };
  } else if ( selectedEffect === "transfer" ) {
    options = { to: "#effectTypes", className: "ui-effects-transfer" };
  } else if ( selectedEffect === "size" ) {
    options = { to: { width: 200, height: 60 } };
  }

  // Run the effect
  $( "#effect" ).effect( selectedEffect, options, 500, callback );
};

// Callback function to bring a hidden box back
function callback() {
  setTimeout(function() {
    $( "#effect" ).removeAttr( "style" ).hide().fadeIn();
  }, 1000 );
};
