
$('.btn-feature-image').click(function (event) {
	$(".image-modal").modal('show');
});

$('.remove-image').click(function (event) {
	location.reload();
});

function responsive_filemanager_callback(field_id){
		var url=$('#'+field_id).val();
		if(field_id ==  "feature-image"){
			$('#show-feature-image').attr('src', url);
			$('.remove-image').css('display', 'inline-block');
			$('.crop_image').css('display','inline-block');
			$('.btn-feature-image').hide();
			image_crop = $('#show-feature-image').croppie({
			    enableExif: true,
			    viewport: {
			      width:170,
			      height:206,
			      type:'square' //circle
			    },
			    boundary:{
			      width:200,
			      height:300
			    }
			  });
			$('.crop_image').click(function(event){
			    var data = image_crop.croppie('result', {
			      type: 'canvas',
			      size: 'viewport'
			    }).then(function(response){
					$('#imga').prop('src',response);
					$('#canvas').attr('value',response);	
				});
				$('.croppie-container').css('display','none');
				$('.crop_image').css('display','none');
			    
			});
		}
	};
