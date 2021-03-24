
$('.btn-feature-image').click(function (event) {
	$(".image-modal").modal('show');
});

$('.remove-image').click(function (event) {
	location.reload();
});

$(document).on('click','#conguoithan',function(event){
	if (this.checked){
	    $('#ttnguoithan').css('display','block');
	    $('#ttnguoithan').css('margin-bottom','-10px');

	}
    });
    $(document).on('click','#konguoithan',function(event){
    	 if (this.checked){
            $('#ttnguoithan').css('display','none');
        }
    });
    $(document).on('click', '.add_plus', function(event) {
		event.preventDefault();							
		var count = parseInt($('#ttnguoithan').attr('data-count')) + 1;
		var html = '<div id="ttnguoithan-'+count+'" class="three fields">' +
						'<div class="field"><input type="text" name="hotennguoithan[]"></div><div class="field"><input type="text" name="tuoinguoithan[]"></div><div class="field"><select name="quanhenguoithan[]">									<option value=""></option>									<option value="Bố">Bố</option>									<option value="Mẹ">Mẹ</option>									<option value="Vợ/Chồng">Vợ/Chồng</option>									<option value="Con trai">Con trai</option>									<option value="Con gái">Con gái</option>									<option value="Anh trai">Anh trai</option>									<option value="Em trai">Em trai</option>									<option value="Em gái">Em gái</option>									<option value="Chị gái">Chị gái</option>									<option value="Bố dượng">Bố dượng</option>									<option value="Mẹ kế">Mẹ kế</option>								</select></div>'+		
						'<i class="trash alternate icon red trash_icon"></i>'+'</div>';
		$('#ttnguoithan').append(html);
		$('#ttnguoithan').attr( 'data-count', count );
	});
	$(document).on('click','.trash_icon',function(event){
        event.preventDefault();
		$(this).parent().remove();
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

						
    $(document).on('click', '.add_truong', function(event) {
		event.preventDefault();							
		var count = parseInt($('#hoctap').attr('data-count')) + 1;
		var html = '<div id="hoctap-'+count+'" class="three fields">'+
			'<div class="field">'+
				'<div class="two fields">'+
					'<div class="field">'+
						'<div class="ui calendar" id="thoigianbd-'+count+'">'+
							'<div class="ui input left icon">'+
							'<i class="calendar icon"></i><input type="text" name="thoigianhocbd[]" required>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="field">'+
						'<div class="ui calendar" id="thoigiankt-'+count+'">'+
							'<div class="ui input left icon">'+
							'<i class="calendar icon"></i><input type="text" name="thoigianhockt[]" required>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>'+
			'<div class="field">'+
				'<input type="text" name="tentruong[]" required>'+
			'</div>'+
			'<div class="field">'+
				'<input type="text" name="diachitruong[]" required>'+
			'</div>'+
			'<i class="trash alternate icon red trash_hoctap" required></i>'+
		'</div>';

		$('#hoctap').append(html);
		$('#hoctap').attr( 'data-count', count );
		$("#thoigianbd-"+count+",#thoigiankt-"+count+"").calendar({
		  type: 'year'
		});							
        
	});
	$(document).on('click','.trash_hoctap',function(event){
        event.preventDefault();
		$(this).parent().remove();
    });
	$("#thoigianbd,#thoigiankt").calendar({
		  type: 'year'
		});


 $(document).on('click', '.add_congviec', function(event) {
		event.preventDefault();							
		var count = parseInt($('#congviec').attr('data-count')) + 1;
		var html = '<div id="congviec-'+count+'" class="three fields" >'+
			'<div class="field">'+
				'<div class="two fields">'+
					'<div class="field">'+
						'<div class="ui calendar" id="thoigianlamviecbd-'+count+'">'+
							'<div class="ui input left icon">'+
							'<i class="calendar icon"></i><input type="text" name="thoigianlamviecbd[]" required>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="field">'+
						'<div class="ui calendar" id="thoigianlamvieckt-'+count+'">'+
							'<div class="ui input left icon">'+
							'<i class="calendar icon"></i><input type="text" name="thoigianlamvieckt[]" required>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>'+
			'<div class="field">'+
				'<input type="text" name="tencongty[]" required>'+
			'</div>'+
			'<div class="field">'+
				'<input type="text" name="ndcongviec[]" required>'+
			'</div>'+
			'<i class="trash alternate icon red trash_congviec"></i>'+
		'</div>';

		$('#congviec').append(html);
		$('#congviec').attr( 'data-count', count );
		$("#thoigianlamviecbd-"+count+",#thoigianlamvieckt-"+count+"").calendar({
		  type: 'year'
		});							
        
	});
	$(document).on('click','.trash_congviec',function(event){
        event.preventDefault();
		$(this).parent().remove();
    });
	$("#thoigianlamviecbd,#thoigianlamvieckt").calendar({
		  type: 'year'
		});




 $(document).on('click', '.add_giadinh', function(event) {
		event.preventDefault();							
		var count = parseInt($('#giadinh').attr('data-count')) + 1;
		var html = '<div id="#giadinh-'+count+'" class="fields">'+ 								
							'<div class="field two wide comlum">'+
								'<input type="text" name="quanhegiadinh[]" required>'+									
							'</div>'+
							'<div class="field four wide comlum">'+
								'<input type="text" name="hotengiadinh[]" required>'+
							'</div>'+
							'<div class="field two wide comlum">'+								
								'<input type="text" name="namsinhgiadinh[]" required>'+
							'</div>'+

							'<div class="field">'+
								'<input type="text" name="congviecgiadinh[]" required>'+
							'</div>'+
							'<div class="field">'+
								'<input type="text" name="noilamviecgiadinh[]" required>'+
							'</div>'+
							'<div class="field">'+
								'<input type="text" name="thunhapgiadinh[]" required>'+
							'</div>'+	
							'<i class="trash alternate icon red trash_giadinh"></i>'+  						
					'</div>';
		$('#giadinh').append(html);
		$('#giadinh').attr( 'data-count', count );
		$("#thoigianlamviecbd-"+count+",#thoigianlamvieckt-"+count+"").calendar({
		  type: 'year'
		});							
        
	});
	$(document).on('click','.trash_giadinh',function(event){
        event.preventDefault();
		$(this).parent('div').remove();
    });
	$("#thoigianlamviecbd,#thoigianlamvieckt").calendar({
		  type: 'year'
		});