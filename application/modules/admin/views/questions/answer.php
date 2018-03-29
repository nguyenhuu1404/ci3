<!DOCTYPE html>
<html ng-app>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="<?=base_url();?>assets/grocery_crud/js/jquery-1.11.1.min.js"></script>
	<script src="/3rdparty/tinymce/tinymce.min.js" type="text/javascript"></script>

	<link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/grocery_crud/themes/bootstrap/css/bootstrap/bootstrap.min.css" />
	
	<link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/admin/css/main.css" />
    <script type="text/javascript" src="<?=base_url();?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
	
</head>
<body>
	<div class="item">
	<?php $this->load->view('admin/menu'); ?>
		
	</div>

	<div class="container">	
		<div class="item">
		<div class="col-xs-12">
			<span class="title-ptnn">Câu hỏi :</span> 
			<?php echo $question['name']; ?>
		</div>
		</div>

		<div class="item title-ptnn"><div class="col-xs-12"> Đáp án : </div></div>
		<button type="button" class="btn btn-primary margin-top-10" id="add-input-test" style="margin-left: 15px;"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
		
		<?php echo validation_errors(); ?>

		<?php echo form_open('/admin/questions/addAnsers'); ?>
		
			<input type="hidden" name="question_id" value="<?=$question['id'];?>" />
			<?php if($itemAnswers == NULL):?>
			<div id="content">
				<div class="col-xs-6 margin-top-10">
					<div class="input-group">
						<span class="input-group-addon">
							<input class="status_value" type="radio" name="check" value="0"/>
						</span>
						<textarea class="form-control content_value tinymce_input" name="name[]"  aria-required="true" aria-invalid="false"></textarea>
					</div>
				</div>
			</div>
			

			<?php else:?>
				<div id="content">
					<?php foreach($itemAnswers as $key =>$value):?>
					<div class="col-xs-6 margin-top-10 element-input">
						<div class="input-group">
							<span class="input-group-addon">
								<input class="status_value" type="radio" name="check" <?php if($value['check'] == 1){ echo 'checked = "1"';}?> value="<?=$value['id']?>"/>
							</span>
							<textarea class="form-control col-xs-6 content_value tinymce_input" name="name[<?=$value['id']?>]"  aria-required="true" aria-invalid="false"><?=$value['name']?></textarea>
							
						</div>
						<div class="remove-input"><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>
					</div>
					<?php $i = $value['id'];?>
					<?php endforeach;?>
				</div>

				
			<?php endif;?>

			<div id="answers_invalid" class="color-warning col-xs-12 margin-top-10">
			</div>
			<div class="clearfix"></div>
			<div class="margin-top-20">
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary" onclick = "return validate_answers()" ><span class="glyphicon glyphicon-save"></span> Cập nhật</button>
					
				</div>
			</div>
		</form>

		<script>
			<?php if(isset($i)):?>
				var i = <?=$i;?>;
			<?php else:?>
				var i = 0;
			<?php endif;?>
			$("#add-input-test" ).click(function() {
				i++;
				addRow(i);
			});

			function addRow(i) {

				var div = document.createElement('div');

				div.className = 'col-xs-6 margin-top-10 element-input';

				div.innerHTML = '<div class="input-group">\
									<span class="input-group-addon">\
										<input class="status_value" type="radio" name="check" value="'+i+'"/>\
									</span>\
									<textarea class="form-control content_value tinymce_input" name="name['+i+']"  aria-required="true" aria-invalid="false"></textarea>\
									</div>\
								<div class="remove-input"><a href="javascript:void(0)" class="color_delete" title="Xóa"><span class="glyphicon glyphicon-remove-circle"></span></a></div>';

				 document.getElementById('content').appendChild(div);
				 setInputTinymce();
			}

			function validate_answers(){

				var content = [];
				var content_validate = true;
				var status = true;

				/* $(".content_value").each(function() {
					content.push(($(this).val()).trim());
				}); */
				$(".content_value").each(function() {
					content.push(tinyMCE.activeEditor.getContent({format : 'text'}));
				});
				$('#answers_invalid').html("");
				status = $('input[name=status]:checked').val();

				if(status == undefined){
					$('#answers_invalid').show();
					$('#answers_invalid').append("<span class='glyphicon glyphicon-warning-sign'></span><b> Chưa chọn đáp án đúng ! </b><br/>");
				}

				$.each(content, function(key, value) {
					if(value ==''){
						$('#answers_invalid').show();
						$('#answers_invalid').append("<span class='glyphicon glyphicon-warning-sign'></span> <b>Giá trị nhập không được để trống ở vị trí số "+(key+1)+"</b><br/>");
						content_validate = false;
					}
				});

				if(status != undefined && content_validate == true){
					return true;
				}

				return false;
			}


			$("#content").on("click", '.remove-input', function(e){
				 $(this).parent().remove();
			});
			
			setInputTinymce();
			

		</script>
		<style>
			#answers_invalid{display:none;}
			#content .input-group .form-control {width:91%}
			.element-input{position:relative;}
			.remove-input{position: absolute;top:0;right:15px;padding-top:6px;}
			.color_delete{color: red;}
		</style>
	</div>
</body>
</html>