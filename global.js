
function toggleAddWord() {
    $("#alert").hide().removeClass("error success");
    $("#add-word").slideToggle();
}

$(document).ready(function() {
    
    /*** Collect selected type IDs ***/
    var types = [];
    var revisionlist = 0;
    $("#filters .types [type=checkbox]").click(function() {
        if($(this).is(':checked')) {
            types.push($(this).attr('id'));
        } else {
            types.splice(types.indexOf($(this).attr('id')),1);
        }
    });
    
    
    /*** Get flashcard ***/
    $("#clickToBegin").click(function() {
        
        /*** Get revision list words ***/
        if($("#revision [type=checkbox]").is(':checked')) {
            revisionlist = 1;
        } else {
            revisionlist = 0;
        }
        
        $.ajax({
            url: "get_word.php",
            dataType: "json",
            data: { 
                datefilter: $("#datefilter").val(), 
                typefilter: types,
                revisionlist: revisionlist
            },
            success: function(result) {
                $("#english-span").text(result.english).removeClass("hidden");
                $("#spanish-span").text(result.spanish).addClass("hidden");
                $(".bar ul").removeClass("hidden");
                $(".bar ul li").first().text(result.type);
                $("#clickToBegin").text("Next word");
                $("#showTrans").removeClass("hidden").text("Show word");
                $("#showFilters").removeClass("hidden");
                $("#toggleRevision").removeClass('hidden');
                if(result.flagged == 0) {
                   $("#toggleRevision").removeClass('to-revise').text("To revise");
                } else {
                   $("#toggleRevision").addClass('to-revise').text("Revision list");
                }
                card = result;
            }});
        
         if($(".container").hasClass("hidden")) {
            $(".container").removeClass("hidden");
        }

    });

    /*** Show flashcard translation ***/
    $("#showTrans").click(function() {
        if (!$("#spanish-span").hasClass("hidden")) {
            $(this).text("Show word");
        } else {
            $(this).text("Hide word");
        }

        $("#spanish-span").toggleClass("hidden");
    });
    
    /*** Show filters ***/
    $("#showFilters").click(function() {
        $("#filters").toggleClass("hidden");
        if(!$("#filters").hasClass("hidden")) {
            $("#showFilters").text("Hide filters");
        } else {
            $("#showFilters").text("Show filters");
        }
    });

    /*** Add new word ***/
    $('#add_word_form').submit(function(event) {
        var formData = {
            'spanish': $('input[name=spanish]').val(),
            'english': $('input[name=english]').val(),
            'type': $('select[name=type]').val()
        };

        // Send request 
        $.ajax({
            type: 'POST',
            url: 'add_word.php',
            data: formData,
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })

                // using the done promise callback
                .done(function(data) {
            $("#add-word").hide();
            if (data['result'] === 'success') {
                $("#alert").addClass('success').show().text(data['message']);
            } else {
                $("#alert").addClass('error').show().text(data['message']);
            }
        });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });
    
    /*** Toggle revision status ***/
    $("#toggleRevision").click(function() {
        var is_flagged;
        if(card[5] == 0) {
            is_flagged = 1;
            $("#toggleRevision").addClass('to-revise').text("Revision list");
        } else {
            is_flagged = 0;
            $("#toggleRevision").removeClass('to-revise').text("To revise");
        }
        
        $.ajax({
            type: "POST",
            url: "revision_status.php",
            data: {'to_revise': is_flagged, 'id': card[0]},
         success: function() {
                card[5] = is_flagged;   
            }
        });
    }); 
    
    /*** Spanish characters ***/
    $("#chars li").click(function() {
        $('#spanish-field').val($('#spanish-field').val() + $(this).text());
    });
    
    /*** Mobile menu collapse ***/
    $('.handle').on('click', function() {
       $("header ul").toggleClass('showing'); 
    });

});

