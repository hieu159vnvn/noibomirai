<script type="text/javascript">
	$(document).ready(function(){
		$("input[name='hoten']").keyup(function(){
			$("div.hoten_jp").html($(this).val());
		})
		$("input[name='ngaysinh']").change(function(){			
			var a = $(this).val();
			$('.ngay-sinh').html(a);
		})
		$("input[name='noisinh']").keyup(function(){
			$("div.noisinh_jp").html($(this).val());
		})
		$("input[name='diachi']").keyup(function(){
			$("div.diachi_jp").html($(this).val());
		})
		$("#select-mien").change(function(){
			$("div.mien_jp").html($('#select-mien :selected').text());
		})
		$("#select-honnhan").change(function(){
			$("div.honnhan_jp").html($('#select-honnhan :selected').text());
		})
		$("input[name='benhan']").keyup(function(){
			$("div.benhan_jp").html($(this).val());
		})
		$("input[name='tongiao']").keyup(function(){
			$("div.tongiao_jp").html($(this).val());
		})
	});
</script>
{{-- TIENG-NHAT --}}
			<div class="ui bottom attached tab segment" data-tab="tiengnhat">		
				<h3 class="ui header centered blue">SƠ YẾU LÝ LỊCH</h3>			
					<div class="two fields">
						<div class="field">
							<label>氏名 (*)</label>
							<div class="ui labeled input">
							  <div class="ui label hoten_jp">
							  </div>
							  <input type="text" name="hoten_jp" value="{{ old('hoten_jp') }}">
							</div>							
						</div>
						<div class="field">
							<label>出身地 (*)</label>
							<div class="ui labeled input">
							  <div class="ui label noisinh_jp">
							  </div>
							  <input type="text" name="noisinh_jp" value="{{ old('noisinh_jp') }}">
							</div>								
						</div>						
					</div>
					<div class="two fields">
						<div class="field">
							<label>戸籍住所 (*)</label>
							<div class="ui labeled input">
							  <div class="ui label diachi_jp">
							  </div>
							  <input type="text" name="diachi_jp" value="{{ old('diachi_jp') }}" >
							</div>
							
						</div>
						<div class="field">
							<label>地方</label>
							<div class="ui labeled input">
							  <div class="ui label mien_jp">
							  </div>
							  <input type="text" name="mien_jp" value="{{ old('mien_jb') }}" >
							</div>
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>婚姻</label>
							<div class="ui labeled input">
							  <div class="ui label honnhan_jp">
							  </div>
							  <input type="text" name="honnhan_jp" value="{{ old('honnhan_jp') }}" >
							</div>							
						</div>
						<div class="field">
							<label>病暦</label>
							<div class="ui labeled input">
							  <div class="ui label benhan_jp">
							  </div>
							  <input type="text" name="benhan_jp" value="{{ old('benhan_jp') }}" >
							</div>	
						</div>
						<div class="field">
							<label>宗教</label>
							<div class="ui labeled input">
							  <div class="ui label tongiao_jp">
							  </div>
							  <input type="text" name="tongiao_jp" value="{{ old('tongiao_jp') }}" >
							</div>
						</div>
					</div>
					<h3 class="ui dividing header centered">学歴</h3>
					<div class="three fields hoctap">
						<div class="field">
						<label>期 間</label>	
							<div class="two fields">
								<div class="field">
									<div class="ui calendar" id="thoigianbd">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="thoigianhocbd_jp">
									    </div>
								    </div> 
							    </div>														
								<div class="field">
									<div class="ui calendar" id="thoigiankt_jp">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="thoigianhockt_jp">
									    </div>
								    </div> 
								</div>
							</div>
						</div>
						<div class="field">
							<label>学 校 名</label>
							<input type="text" name="tentruong_jp">
						</div>
						<div class="field">
							<label>学校所在地</label>
							<input type="text" name="diachitruong_jp">
						</div>
					</div>
					<script type="text/javascript">
						$('#thoigianbd,#thoigiankt').calendar({
						  type: 'year'
						});
					</script>
					<h3 class="ui dividing header centered">職歴</h3>
					<div class="three fields lamviec">
						<div class="field">
						<label>期 間</label>	
							<div class="two fields">
								<div class="field">
									<div class="ui calendar" id="thoigianlamviecbd">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="thoigianlamviecbd_jp" placeholder="2008">
									    </div>
								    </div> 
							    </div>														
								<div class="field">
									<div class="ui calendar" id="thoigianlamvieckt">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="thoigianlamvieckt_jp" placeholder="2011">
									    </div>
								    </div> 
								</div>
							</div>
						</div>
						<div class="field">
							<label>勤 務 先</label>
							<input type="text" name="tencongty_jp">
						</div>
						<div class="field">
							<label>職 種</label>
							<input type="text" name="diachicongty_jp">
						</div>
					</div>
					<script type="text/javascript">
						$('#thoigianlamviecbd,#thoigianlamvieckt').calendar({
						  type: 'year'
						});
					</script>
					<h3 class="ui dividing header centered">外国語</h3>
					<div class="three fields ngoaingu">
					    <div class="field">
					    	<label>英語</label>
					        <input type="text" name="anhngu_jp" value="{{ old('anhngu_jp') }}">
					    </div>
					    <div class="field">
					    	<label>日本語</label>
					        <input type="text" name="nhatngu_jp" value="{{ old('nhatngu_jp') }}">
					    </div>
					    <div class="field">
					    	<label>その他</label>
					        <input type="text" name="ngoaingukhac_jp" value="{{ old('ngoaingukhac_jp') }}">
					    </div>
					</div>
					<div id="ttnguoithan_jp" data-count="1">
						<div id="ttnguoithan_jp-1" class="three fields">
							<div class="field">
								<label>Họ tên</label>
								<input type="text" name="hotennguoithan_jp[]" value="{{ old('hotennguoithan') }}">
							</div>
							<div class="field">
								<label>Tuổi</label>
								<input type="text" name="tuoinguoithan_jp[]" value="{{ old('tuoinguoithan') }}">
							</div>
							<div class="field">
								<label>Quan hệ</label>
								<input type="text" name="quanhenguoithan_jp[]" value="{{ old('quanhenguoithan') }}">
							</div>
					
						</div>
					</div>
			        
					<h3 class="ui dividing header centered">日本での技能実習について</h3>
					<div class="two fields thuctap">
						<div class="field">
							<label>日本に行く目的</label>
							<textarea rows="3" name="mucdich_jp" placeholder="Nội dung">{{ old('mucdich_jp') }}</textarea>
						</div>
						<div class="field">
							<label>帰国後の目摽</label>
							<textarea rows="3" name="muctieu_jp" placeholder="Nội dung">{{ old('muctieu_jp') }}</textarea>
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>趣味</label>
							<textarea rows="3" name="sothich_jp">{{ old('sothich_jp') }}</textarea>
						</div>
						<div class="field">
							<label>長所</label>
							<textarea rows="3" name="diemmanh_jp">{{ old('diemmanh_jp') }}</textarea>
						</div>
					</div>
					<h3 class="ui dividing header centered">家族 構成</h3>
					<div class="ui grid">
	  						<div class="seven wide column">
	  							<div class="three fields">  								
									<div class="field four wide column">
										<label>続柄</label>
										<input type="text" name="quanhegiadinh_jp">									
									</div>
									<div class="field eight wide column">
										<label>氏名</label>
										<input type="text" name="hotengiadinh_jp">
									</div>
									<div class="field four wide column">
										<label>年生</label>									
										<input type="text" name="namsinhgiadinh_jp">
									</div>

								</div>
	  						</div>
	  						<div class="nine wide column">
	  							<div class="three fields">
									<div class="field">
										<label>職業</label>
										<input type="text" name="congviecgiadinh_jp">
									</div>
									<div class="field">
										<label>就職先</label>
										<input type="text" name="noilamviecgiadinh_jp">
									</div>
									<div class="field">
										<label>月収</label>
										<input type="text" name="thunhapgiadinh_jp">
									</div>
									<div class="icon_action">
										<i class="plus icon"></i>
									</div>
								</div>
	  						</div>
					</div>
					
			</div>
{{-- END TIENG-NHAT --}}

{{-- TIENG-NHAT --}}
			<div class="ui bottom attached tab segment" data-tab="tiengnhat">		
				<h3 class="ui header centered blue">SƠ YẾU LÝ LỊCH</h3>			
					<div class="two fields">
						<div class="field">
							<label>氏名 (*)</label>
							<div class="ui labeled input">
							  <div class="ui label">{{$hoso->hoten}}
							  </div>
							  <input type="text" name="hoten_jp" value="{{$hoso->hoten_jp}}">
							</div>							
						</div>
						<div class="field">
							<label>出身地 (*)</label>
							<div class="ui labeled input">
							  <div class="ui label">{{$hoso->noisinh}}
							  </div>
							  <input type="text" name="noisinh_jp" value="{{$hoso->noisinh_jp}}">
							</div>								
						</div>						
					</div>
					<div class="field">
						<label>戸籍住所 (*)</label>
						<div class="ui labeled input">
						  <div class="ui label">{{$hoso->diachi}}
						  </div>
						  <input type="text" name="diachi_jp" value="{{$hoso->diachi_jp}}" >
						</div>
					</div>
					<div class="field">	
						<label>地方</label>
						<div class="ui labeled input">
						  <div class="ui label mien_jp">
						  </div>
						  <input type="text" name="mien_jp" value="{{ old('mien_jb') }}" >
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>婚姻</label>
							<div class="ui labeled input">
							  <div class="ui label honnhan_jp">
							  </div>
							  <input type="text" name="honnhan_jp" value="{{ old('honnhan_jp') }}" >
							</div>							
						</div>
						<div class="field">
							<label>病暦</label>
							<div class="ui labeled input">
							  <div class="ui label benhan_jp">
							  </div>
							  <input type="text" name="benhan_jp" value="{{ old('benhan_jp') }}" >
							</div>	
						</div>
						<div class="field">
							<label>宗教</label>
							<div class="ui labeled input">
							  <div class="ui label tongiao_jp">
							  </div>
							  <input type="text" name="tongiao_jp" value="{{ old('tongiao_jp') }}" >
							</div>
						</div>
					</div>
					<h3 class="ui dividing header centered">学歴</h3>
					<div class="three fields hoctap">
						<div class="field">
						<label>期 間</label>	
							<div class="two fields">
								<div class="field">
									<div class="ui calendar" id="thoigianbd">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="thoigianhocbd_jp">
									    </div>
								    </div> 
							    </div>														
								<div class="field">
									<div class="ui calendar" id="thoigiankt_jp">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="thoigianhockt_jp">
									    </div>
								    </div> 
								</div>
							</div>
						</div>
						<div class="field">
							<label>学 校 名</label>
							<input type="text" name="tentruong_jp">
						</div>
						<div class="field">
							<label>学校所在地</label>
							<input type="text" name="diachitruong_jp">
						</div>
					</div>
					<script type="text/javascript">
						$('#thoigianbd,#thoigiankt').calendar({
						  type: 'year'
						}); 
					</script>
					<h3 class="ui dividing header centered">職歴</h3>
					<div class="three fields lamviec">
						<div class="field">
						<label>期 間</label>	
							<div class="two fields">
								<div class="field">
									<div class="ui calendar" id="thoigianlamviecbd">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="thoigianlamviecbd_jp" placeholder="2008">
									    </div>
								    </div> 
							    </div>														
								<div class="field">
									<div class="ui calendar" id="thoigianlamvieckt">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="thoigianlamvieckt_jp" placeholder="2011">
									    </div>
								    </div> 
								</div>
							</div>
						</div>
						<div class="field">
							<label>勤 務 先</label>
							<input type="text" name="tencongty_jp">
						</div>
						<div class="field">
							<label>職 種</label>
							<input type="text" name="diachicongty_jp">
						</div>
					</div>
					<script type="text/javascript">
						$('#thoigianlamviecbd,#thoigianlamvieckt').calendar({
						  type: 'year'
						});
					</script>
					<h3 class="ui dividing header centered">外国語</h3>
					<div class="three fields ngoaingu">
					    <div class="field">
					    	<label>英語</label>
					        <input type="text" name="anhngu_jp" value="{{ old('anhngu_jp') }}">
					    </div>
					    <div class="field">
					    	<label>日本語</label>
					        <input type="text" name="nhatngu_jp" value="{{ old('nhatngu_jp') }}">
					    </div>
					    <div class="field">
					    	<label>その他</label>
					        <input type="text" name="ngoaingukhac_jp" value="{{ old('ngoaingukhac_jp') }}">
					    </div>
					</div>
					<div id="ttnguoithan_jp" data-count="1">
						<div id="ttnguoithan_jp-1" class="three fields">
							<div class="field">
								<label>Họ tên</label>
								<input type="text" name="hotennguoithan_jp[]" value="{{ old('hotennguoithan') }}">
							</div>
							<div class="field">
								<label>Tuổi</label>
								<input type="text" name="tuoinguoithan_jp[]" value="{{ old('tuoinguoithan') }}">
							</div>
							<div class="field">
								<label>Quan hệ</label>
								<input type="text" name="quanhenguoithan_jp[]" value="{{ old('quanhenguoithan') }}">
							</div>
					
						</div>
					</div>
			        
					<h3 class="ui dividing header centered">日本での技能実習について</h3>
					<div class="two fields thuctap">
						<div class="field">
							<label>日本に行く目的</label>
							<textarea rows="3" name="mucdich_jp" placeholder="Nội dung">{{ old('mucdich_jp') }}</textarea>
						</div>
						<div class="field">
							<label>帰国後の目摽</label>
							<textarea rows="3" name="muctieu_jp" placeholder="Nội dung">{{ old('muctieu_jp') }}</textarea>
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>趣味</label>
							<textarea rows="3" name="sothich_jp">{{ old('sothich_jp') }}</textarea>
						</div>
						<div class="field">
							<label>長所</label>
							<textarea rows="3" name="diemmanh_jp">{{ old('diemmanh_jp') }}</textarea>
						</div>
					</div>
					<h3 class="ui dividing header centered">家族 構成</h3>
					<div class="ui grid">
	  						<div class="seven wide column">
	  							<div class="three fields">  								
									<div class="field four wide column">
										<label>続柄</label>
										<input type="text" name="quanhegiadinh_jp">									
									</div>
									<div class="field eight wide column">
										<label>氏名</label>
										<input type="text" name="hotengiadinh_jp">
									</div>
									<div class="field four wide column">
										<label>年生</label>									
										<input type="text" name="namsinhgiadinh_jp">
									</div>

								</div>
	  						</div>
	  						<div class="nine wide column">
	  							<div class="three fields">
									<div class="field">
										<label>職業</label>
										<input type="text" name="congviecgiadinh_jp">
									</div>
									<div class="field">
										<label>就職先</label>
										<input type="text" name="noilamviecgiadinh_jp">
									</div>
									<div class="field">
										<label>月収</label>
										<input type="text" name="thunhapgiadinh_jp">
									</div>
									<div class="icon_action">
										<i class="plus icon"></i>
									</div>
								</div>
	  						</div>
					</div>
					
			</div>
{{-- END TIENG-NHAT --}}
