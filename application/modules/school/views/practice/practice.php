<?php 
	$quantity = 20;
	if($showQuestions){ 
?>	
<!-- Page Banner Area Start -->
<div class="page-banner-area overlay section">
    <div class="container">
        <div class="row">
            <!-- Page Banner -->
            <div class="page-banner text-center col-xs-12">
                <h1>Latest News</h1>
                <!-- Breadcrumb -->
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Latest News</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Banner Area -->

<div class="container">
	<div class="item content-lt">
		
		<div class="col-xs-12 text-center form-group  top20">

			<span><b>Thời gian</b> </span>
			
			<div class="time">
				<div id="countdown" class="num-time title-red"><?=$time;?></div>
			</div>

		</div>
			
		<div class="col-xs-12 border-question" style="z-index: 9">
			<form id="form_question_nn" class="question_content pd-0 item mgb15 form-horizontal bd-div bgclor" method="post">
				
				<?php foreach($showQuestions as $key =>$value):?>
					<div id="idFieldset" class="row top20 left20">
							<div class="col-md-12">
							<div class="stt question_<?=$value['id'];?>">Câu : <?=$key+1;?></div>
							</div>
							<div class="col-md-12 top10">
								<input type="hidden" name="questions[<?=$value['id']?>]" value="<?=$value['id']?>"/>
								
								<p><span class="ptnn-title"> <?=$value['name'];?></span></p>
								<?php 
									//answer
									$dataAnswer['answers'] = $processAnswer[$value['id']];
									$dataAnswer['qestionId'] = $value['id'];
									$this->load->view('question/choice', $dataAnswer);
								?>
								
								<a href="#mobile-explan-<?=$value['id'];?>" class="explanation top10 hidden btn btn-success btn-show-exp" data-toggle="collapse">Lý giải</a>
		
								<div id="mobile-explan-<?=$value['id'];?>" class="collapse top10 item" style="border: 1px solid rgb(221, 221, 221);
								border-radius: 5px;
								padding: 10px;
								text-align: justify;
								background: rgb(255, 255, 255); margin-bottom:10px;">
									<div class="item">
									<?=$value['explain'];?>
									</div>
								</div>	
							
							</div>
							
							<div class="line-question"></div>
					</div>
				<?php endforeach;?>

				<div class="item mgb20">
					
					<button id="finish-choice" class="btn btn-primary" name="finish-choice" onclick="finish_choice();" type="button">
						Hoàn thành 
					</button>

				</div>
				
			</form>
		</div>
	</div>
</div>

<!-- Modal popover view-result -->
		<div class="modal fade" role="dialog" id="exampleModal" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title text-center title-blue" id="gridSystemModalLabel"><b>Kết quả</b></h3>
					</div>
					
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12 title-blue">
								<div class="col-xs-8 question_true control-label">Số câu đúng: </div> <div class="col-xs-4 num_true title-blue"></div>
							</div>
							<div class="col-xs-12 title-red">
								<div class="col-xs-8 question_false control-label">Số câu sai: </div> <div class="col-xs-4 num_false title-red"></div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>	
	
<script>

	var formdata;
	
    function finish_choice(){
        
    	formdata = $('#form_question_nn').serializeForm();
    	$('#idFieldset input').prop( "disabled", true );
    	$('#finish-choice').prop( "disabled", true );
    	get_answers();
    	return formdata;
    }


	function get_answers(){
			
	       	if(formdata	==	null){
	      		alert('Click hoàn thành để xem đáp án !');
	      	}else{
	      		$.ajax({
		          	type: "Post",
			        data:{
			          	answers:formdata,
			        },
			        url:'/school/practice/showAnswers',
					async: false,
			        success: function(results){
			         	var data = $.parseJSON(results);
						
			           	$('.num_true').text(data.total);
			           	var question_total = 30;
			           	var num_false = question_total - data.total;
			           	$('.num_false').text(data.totalFalse);
						
						//show answers
						$.each(data, function(i, item) {
							
							$('.answers_'+item.questionId+'_'+item.answerId).css('color', '#3e9e00');
							$('.answers_'+item.questionId+'_'+item.answerId).css('font-weight', 'bold');
							$('.answers_'+item.questionId+'_'+item.answerId).append('<span class="has-success fa fa-check"></span>');
							
							
						});
						
						//show answers
						$.each(data.answersFalse, function(i, value) {
	
							$('.question_'+value).addClass('alert alert-danger');

						});

						$('.explanation').removeClass('hidden');
						
						
			      	}
		        });
				
				$('.explanation').show();
	      		
		     	$('#exampleModal').modal('show');
				
	      	}
	   	}
    
	
  	var CountDown = (function ($) {
  	    // Length ms 
  	    var TimeOut = 10000;
  	    // Interval ms
  	    var TimeGap = 1000;
  	    
  	    var CurrentTime = ( new Date() ).getTime();
  	    var EndTime = ( new Date() ).getTime() + TimeOut;
  	    
  	    var GuiTimer = $('#countdown');
  	    
  	    var Running = true;
  	    
  	    var UpdateTimer = function() {
  	        // Run till timeout
  	        if( CurrentTime + TimeGap < EndTime ) {
  	            setTimeout( UpdateTimer, TimeGap );
  	        }
  	        // Countdown if running
  	        if( Running ) {
  	            CurrentTime += TimeGap;
  	            if( CurrentTime >= EndTime ) {
  	                GuiTimer.css('color','red');

  	  	          	finish_choice();
  	            }
  	        }
  	        // Update Gui
  	        var Time = new Date();
  	        Time.setTime( EndTime - CurrentTime );
  	        var Minutes = Time.getMinutes();
  	        var Seconds = Time.getSeconds();
  	        
  	        GuiTimer.html( 
  	            (Minutes < 10 ? '0' : '') + Minutes 
  	            + ':' 
  	            + (Seconds < 10 ? '0' : '') + Seconds );
  	    };
  	    
  	    var Pause = function() {
  	        Running = false;
  	    };
  	    
  	    var Start = function( Timeout ) {
  	        TimeOut = Timeout;
  	        CurrentTime = ( new Date() ).getTime();
  	        EndTime = ( new Date() ).getTime() + TimeOut;
  	        UpdateTimer();
  	    };

  	    return {
  	        Pause: Pause,
  	        Start: Start
  	    };
  	})(jQuery);
  	
  	jQuery('#finish-choice').on('click',CountDown.Pause);

  	// ms
  	CountDown.Start(<?=$time*60*1000?>);
	
	// slight update to account for browsers not supporting e.which
	function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
	// To disable f5
		/* jQuery < 1.7 */
	$(document).bind("keydown", disableF5);
	/* OR jQuery >= 1.7 */
	$(document).on("keydown", disableF5);

	// To re-enable f5
		/* jQuery < 1.7 */
	$(document).unbind("keydown", disableF5);
	/* OR jQuery >= 1.7 */
	$(document).off("keydown", disableF5);
	
</script>
<?php } ?>