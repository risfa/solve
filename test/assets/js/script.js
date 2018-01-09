var abc = 0; //Declaring and defining global increement variable
var host = window.location.hostname+"/adaru";
$(document).ready(function() {

//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
        $(this).before($("<span/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file'}),        
                $("<br/>")
                ));
    });
	
	

//following function will executes on change event of file input to select different file	
$('body').on('change', '#file', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
				
				var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
               
			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               
			    $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'http://'+host+'/assets/images/x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));
            }
        });

//To preview image     
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });

	/*
		BEGIN UPLOAD MULTIPLE IMAGES WITH DESCRIPTION
	*/
	var img_index = 1;
	
	$('#add_more_with_desc').click(function() {
        $(this).before($("<div/>", {id: 'fileDivWithDesc'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[new_'+img_index+']', type: 'file', id: 'file_with_desc', style: 'float:left;margin-bottom:10px;', required: "required"}),								
                $("<input/>", {name: 'img_desc[new_'+img_index+']', type: 'text', class: 'form-control', placeholder: 'Description', id: 'img_desc', required: "required"}),
                $("<br/>")
                ));
		img_index++;
    });

	//following function will executes on change event of file input to select different file	
	$('body').on('change', '#file_with_desc', function(){
            if (this.files && this.files[0]) {
				var thisParent = this;
			    var reader = new FileReader();
                reader.onload = function(e){
					$(thisParent).parent().prepend('<div class="abcd"><img src="'+e.target.result+'"><img id="img" src="http://'+host+'/assets/images/x.png" alt="delete" onclick="javascript:$(this).parent().parent().remove()"></div>');
				};
				$(this).hide();
                reader.readAsDataURL(this.files[0]);
            }
        });

		$('#upload').click(function(e) {
			var name = $(":file_with_desc").val();
			if (!name)
			{
				alert("First Image Must Be Selected");
				e.preventDefault();
			}
		});


	/*
		END UPLOAD MULTIPLE IMAGES WITH DESCRIPTION
	*/
});