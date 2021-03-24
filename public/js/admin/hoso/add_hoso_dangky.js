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
						'<div class="field">' +
						'<input type="text" name="hotennguoithan[]"></div>' +
						'<div class="field"><input type="text" name="tuoinguoithan[]"></div>' +
						'<div class="field"><input type="text" name="quanhenguoithan[]"></div>'+		
						'<i class="trash alternate icon red trash_icon"></i>'+'</div>';
		$('#ttnguoithan').append(html);
		$('#ttnguoithan').attr( 'data-count', count );
	});
	$(document).on('click','.trash_icon',function(event){
        event.preventDefault();
		$(this).parent().remove();
    });

    $(document).on('click', '.add_truong', function(event) {
		event.preventDefault();							
		var count = parseInt($('#hoctap').attr('data-count')) + 1;
		var html = '<div id="hoctap-'+count+'" class="three fields" style=" margin: 0em -0.5em;">'+
			'<div class="field">'+
				'<div class="two fields">'+
					'<div class="field">'+
						'<div class="ui calendar" id="thoigianbd-'+count+'">'+
							'<div class="ui input left icon">'+
							'<i class="calendar icon"></i><input type="text" class="thoigianhocbd" name="thoigianhocbd[]" >'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="field">'+
						'<div class="ui calendar" id="thoigiankt-'+count+'">'+
							'<div class="ui input left icon">'+
							'<i class="calendar icon"></i><input type="text" class="thoigianhockt" name="thoigianhockt[]" required>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>'+
			'<div class="field">'+
				'<div class="ui input left icon">'+
					'<i class="building icon"></i><input type="text" name="tentruong[]" required>'+
				'</div>'+
			'</div>'+
			'<div class="field">'+
				'<div class="ui input left icon">'+
					'<i class="map icon"></i><input type="text" name="diachitruong[]" required>'+
				'</div>'+
			'</div>'+
			'<i class="trash alternate icon red trash_hoctap"></i>'+
		'</div>';

		$('#hoctap').append(html);
		$('#hoctap').attr( 'data-count', count );
		$(".thoigianhocbd,.thoigianhockt").inputmask({ alias: "datetime", inputFormat: "yyyy"});

		// $("#thoigianbd-"+count+"").calendar({
		//   type: 'year',
		//   endCalendar: $("#thoigiankt-"+count+"")
		// });	
		// $("#thoigiankt-"+count+"").calendar({
		//   type: 'year',
		//   startCalendar: $("#thoigianbd-"+count+"")
		// });						
        
	});
	$(document).on('click','.trash_hoctap',function(event){
        event.preventDefault();
		$(this).parent().remove();
    });
    var i = 1;
	// for (i = 1; i < 5; i++){

	// $("#thoigianbd-"+i+"").calendar({
	// 	  type: 'year',
	// 	  endCalendar: $("#thoigiankt-"+i+"")
	// 	});
	// $("#thoigiankt-"+i+"").calendar({
	// 	  type: 'year',
	// 	  startCalendar: $("#thoigianbd-"+i+"")
	// 	});
	// }


 $(document).on('click', '.add_congviec', function(event) {
		event.preventDefault();							
		var count = parseInt($('#congviec').attr('data-count')) + 1;
		var html = '<div id="congviec-'+count+'" class="three fields" style=" margin: 0em -0.5em;" >'+
			'<div class="field">'+
				'<div class="two fields">'+
					'<div class="field">'+
						'<div class="ui calendar" id="thoigianlamviecbd-'+count+'">'+
							'<div class="ui input left icon">'+
							'<i class="calendar icon"></i><input type="text" class="thoigianlamviecbd" name="thoigianlamviecbd[]" required>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="field">'+
						'<div class="ui calendar" id="thoigianlamvieckt-'+count+'">'+
							'<div class="ui input left icon">'+
							'<i class="calendar icon"></i><input type="text" class="thoigianlamvieckt" name="thoigianlamvieckt[]" required>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>'+
			'<div class="field">'+
				'<div class="ui input left icon">'+
					'<i class="building icon"></i><input type="text" name="tencongty[]" required>'+
				'</div>'+	
			'</div>'+
			'<div class="field">'+
				'<div class="ui input left icon">'+
					'<i class="briefcase icon"></i><input type="text" name="ndcongviec[]" required>'+
				'</div>'+	
			'</div>'+
			'<i class="trash alternate icon red trash_congviec"></i>'+
		'</div>';

		$('#congviec').append(html);
		$('#congviec').attr( 'data-count', count );
		$(".thoigianlamviecbd,.thoigianlamvieckt").inputmask({ alias: "datetime", inputFormat: "mm-yyyy"});
		// $("#thoigianlamviecbd-"+count+"").calendar({
		//   type: 'month',
		//    type: 'month',
		//   text: {
		// 	days: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
		// 	months: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
		// 	monthsShort: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'],
		// 	today: 'Hôm nay',
		// 	now: 'Bây giờ',
		// 	am: 'AM',
		// 	pm: 'PM'
		// 	},
		//   formatter: {
	 //       date: function (date, settings) {
	 //             if (!date) return '';
	 //            var day = date.getDate() + '';
	 //            if (day.length < 2) {
	 //                day = '0' + day;
	 //            }
	 //            var month = (date.getMonth() + 1) + '';
	 //            if (month.length < 2) {
	 //                month = '0' + month;
	 //            }
	 //            var year = date.getFullYear();
	 //            return month + '/' + year;
	 //        }
	 //    },
		//   endCalendar: $("#thoigianlamvieckt-"+count+"")
		// });							
  //       $("#thoigianlamvieckt-"+count+"").calendar({
		//   type: 'month',
		//    type: 'month',
		//   text: {
		// 	days: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
		// 	months: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
		// 	monthsShort: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'],
		// 	today: 'Hôm nay',
		// 	now: 'Bây giờ',
		// 	am: 'AM',
		// 	pm: 'PM'
		// 	},
		//   formatter: {
	 //       date: function (date, settings) {
	 //             if (!date) return '';
	 //            var day = date.getDate() + '';
	 //            if (day.length < 2) {
	 //                day = '0' + day;
	 //            }
	 //            var month = (date.getMonth() + 1) + '';
	 //            if (month.length < 2) {
	 //                month = '0' + month;
	 //            }
	 //            var year = date.getFullYear();
	 //            return month + '/' + year;
	 //        }
	 //    },
		//   startCalendar: $("#thoigianlamviecbd-"+count+"")
		// });
	});
	$(document).on('click','.trash_congviec',function(event){
        event.preventDefault();
		$(this).parent().remove();
    });
	// $("#thoigianlamviecbd").calendar({
	// 	  type: 'month',
	// 	  text: {
	// 		days: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
	// 		months: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
	// 		monthsShort: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'],
	// 		today: 'Hôm nay',
	// 		now: 'Bây giờ',
	// 		am: 'AM',
	// 		pm: 'PM'
	// 		},
	// 	  formatter: {
	//        date: function (date, settings) {
	//              if (!date) return '';
	//             var day = date.getDate() + '';
	//             if (day.length < 2) {
	//                 day = '0' + day;
	//             }
	//             var month = (date.getMonth() + 1) + '';
	//             if (month.length < 2) {
	//                 month = '0' + month;
	//             }
	//             var year = date.getFullYear();
	//             return month + '/' + year;
	//         }
	//     },
	// 	  endCalendar: $("#thoigianlamvieckt")
	// 	});
	// $("#thoigianlamvieckt").calendar({
	// 	  type: 'month',
	// 	  text: {
	// 		days: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
	// 		months: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
	// 		monthsShort: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'],
	// 		today: 'Hôm nay',
	// 		now: 'Bây giờ',
	// 		am: 'AM',
	// 		pm: 'PM'
	// 		},
	// 	  formatter: {
	//         date: function (date, settings) {
	//             if (!date) return '';
	//             var day = date.getDate() + '';
	//             if (day.length < 2) {
	//                 day = '0' + day;
	//             }
	//             var month = (date.getMonth() + 1) + '';
	//             if (month.length < 2) {
	//                 month = '0' + month;
	//             }
	//             var year = date.getFullYear();
	//             return month + '/' + year;
	//         }
	//     },
	// 	  startCalendar: $("#thoigianlamviecbd")
	// 	});


 $(document).on('click', '.add_giadinh', function(event) {
		event.preventDefault();							
		var count = parseInt($('#giadinh').attr('data-count')) + 1;
		var html = '<div id="giadinh-'+count+'" class="fields">'+ 								
							'<div class="field two wide comlum">'+
								'<input type="text" name="quanhegiadinh[]" >'+									
							'</div>'+
							'<div class="field three wide comlum">'+
								'<input type="text" name="hotengiadinh[]" >'+
							'</div>'+
							'<div class="field two wide column">'+
								'<div class="ui calendar" id="namsinhgd-'+count+'">'+
									'<input type="text" class="namsinhgiadinh" name="namsinhgiadinh[]" >'+
								'</div>'+
							'</div>'+
							'<div class="field three wide comlum">'+
								'<input type="text" name="congviecgiadinh[]" >'+
							'</div>'+
							'<div class="field three wide comlum">'+
								'<input type="text" name="noilamviecgiadinh[]" >'+
							'</div>'+
							'<div class="field three wide comlum">'+
								'<input id="thunhap-'+count+'"  class="thunhap-'+count+' tngd " type="text" name="thunhapgiadinh[]" placeholder="VNĐ" >'+
							'</div>'+	
							'<i class="trash alternate icon red trash_giadinh"></i>'+  						
					'</div>';
		$('#giadinh').append(html);
		$('#giadinh').attr( 'data-count', count );
		$(".namsinhgiadinh").inputmask({ alias: "datetime", inputFormat: "yyyy"});
		
		$("#thunhap-"+count+"").inputmask("numeric", {
		    radixPoint: ".",
		    groupSeparator: ",",
		    digits: 2,
		    autoGroup: true,
		    rightAlign: false,
		    oncleared: function () { self.Value(''); }
		});			
		
		$(".thunhap-"+count).change(function(){
			var a = $(this).val().length;
			if(a > 6){
				$('.add_giadinh').trigger('click');
			}
		});

	});
	
	$(document).on('click','.trash_giadinh',function(event){
        event.preventDefault();
		$(this).parent('div').remove();
    });

	$('#sotienthang').val($.format_number($('#sotienthang').val()));
	$('#sotienthang').keyup(function () {
		$(this).val($.format_number($(this).val()));
	});

	$('#sotiennam').val($.format_number($('#sotiennam').val()));
	$('#sotiennam').keyup(function () {
		$(this).val($.format_number($(this).val()));
	});