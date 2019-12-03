	<script src="https://code.jquery.com/jquery-3.0.0.js"></script>
	<script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>
	
	
	<script type="text/javascript" src="<?php echo Config::get('URL'); ?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo Config::get('URL'); ?>js/lightbox.min.js"></script>
    <script type="text/javascript" src="<?php echo Config::get('URL'); ?>js/wow.min.js"></script>
    <script type="text/javascript" src="<?php echo Config::get('URL'); ?>js/main.js"></script> 	
	
	
	<div class="main-content-wrapper">
		<div class="mental-math-calculator boxed">
			<div id="expression" class="mental-math-middle-question" disabled="true"></div>
			
			<div class="mental-math-left left-1">
				<ul class="fa-ul">
					<li class="statistic-entry">	
						<div class="icon">
							<i class="fa fa-check"></i>
							<label class="">Right</label>
						</div>
						
						<div class="value">
							<input id="correct-answers" type="text" value="0" disabled="" class="">
						</div>
					</li>	
				</ul>
			</div>
			
			<div class="mental-math-left left-2">
				<ul class="fa-ul">
					<li class="statistic-entry">	
						<div class="icon">
							<span class="fa-layers fa-fw">
								<i class="fas fa-circle" style="color:Tomato"></i>
								<i class="fa-inverse fas fa-times" data-fa-transform="shrink-6"></i>
							</span>
							<label class="">Wrong</label>
						</div>
						<div class="value">
							<input id="uncorrect-answers" type="text" value="0" disabled="" class="">
						</div>
					</li>	
				</ul>		
			</div>
			
			<div class="mental-math-middle-response"> 
				<input id="response" type="text" value="" disabled="true">
			</div>
		</div>
	
		<div class="mental-math-mode boxed">
			<form method = "Post" id="FormMode"  action="#" enctype="multipart/form-data" >
				<fieldset>
										
					<p><label for="type">Type</type>
					<select id="type" name="type" value="">
						<option value="addition">Addition</option>
						<option value="subtraction">Subtraction</option>
						<option value="multiplication">Multiplication</option>
						<option value="division">Division</option>
					</select></p>
					
					<p><label for="level">Level</label> 
					<select id="level" name="level" value="">
						<option value="brothers">Brothers</option>
						<option value="relatives">Relatives</option>
						<option value="neighbors">Neighbors</option>
						
					</select></p>	
					
					<p><label for="step">Step</label>
					<input id="step" class="" type="number" name="step" required /></p>
				</fieldset>	
				<p><input id="start" class="flat-button" type="submit" name="" value="Start" required /></p>
					
			</form>
		</div>
		
		<div class="boxed" id="myProgress">
			<div id="myBar"></div>
		</div>
	</div>
	
	<script> 
		
		var answer = 0;
		
		$(document).ready(function(){
			$("#FormMode").submit(function(e){
				e.preventDefault();
				localStorage.clear();	
				document.getElementById("correct-answers").value   = 0;
				document.getElementById("uncorrect-answers").value = 0;
				
				$.ajax({
					type: "POST",
					data: new FormData(this),
					processData: false,
					contentType: false,
					cache: false,
					url:"<?php echo Config::get('URL'); ?>trainer/getpractic",
					success: function(data)
					{
						showexempl(data, true);
						TimeVar = setTimeout(statWrite, 60000);
						document.getElementById("start").disabled = true;
						move();
					}
				});
			});	
			
			$("#response").keyup(function(e) {
				if(e.keyCode == 13)
				{
					showexempl(null, false);
				}
			});
		});
		
		function showexempl(data, fstart){
			
			let response = document.getElementById("response");
			let expression = document.getElementById("expression");
			
			if (fstart){
				response.disabled = false;
				response.focus();
				var data = JSON.parse(data);
			
			}else{ if (localStorage.getItem("StorExemple")) {
					stringData = localStorage.getItem("StorExemple");
					data=JSON.parse(stringData);
					CheckAnswer();
					}
			}
			
			lengthData=Object.keys(data).length;
			
			if (lengthData > 0){
				let i = Math.floor((Math.random() * lengthData) + 1)-1;
				exmplstr = getExempl(data[i]);
				expression.innerHTML = exmplstr;
				answer = data[i].reduce((a, b) => a + b, 0);
				data.splice(i, 1);
				response.value="";
				exmplstor = JSON.stringify(data);
				localStorage.setItem("StorExemple", exmplstor);
				return true;

		   }else{
			statWrite();
			return false;
		   }
		}
		
		function getExempl(data){
	
			let x='';

			for(let i in data){
				x+='<input'+' ' + 'value='+data[i]+'><br>';
			}
			
			return x;
		}

		function CheckAnswer(){
	
			let response = document.getElementById("response").value;
			let CorrectAnswer = document.getElementById("correct-answers");
			let UnCorrectAnswer = document.getElementById("uncorrect-answers");
			
			if(response == answer){
					CorrectAnswer.value = Number(document.getElementById("correct-answers").value)+1;
				}else{
					UnCorrectAnswer.value = Number(document.getElementById("uncorrect-answers").value)+1;
				}
		}

		function statWrite() {
			
			var stat;
			response.value="";
			response.disabled=true;
			localStorage.clear();
			clearTimeout(TimeVar);
			document.getElementById("start").disabled = false;
			document.getElementById("expression").innerHTML = "<input'+' ' + 'value=''><br>";
			clearInterval(id);
			
			stat = {
				"correct":Number(document.getElementById("correct-answers").value),
				"uncorrect":Number(document.getElementById("uncorrect-answers").value),
				"user_name":"<?php echo $_SESSION['user_name']?>",
				"type":document.getElementById("type").value,
				"level":document.getElementById("level").value,
				"step":document.getElementById("step").value
			};
			
			$.ajax({
				url:"<?php echo Config::get('URL'); ?>trainer/substat",
				type: "POST",
				data: stat,
			});
		}

		document.addEventListener("DOMContentLoaded", function(event) {

//			setPage();

		  });

		function move() {
		  
		  var elem = document.getElementById("myBar");   
		  var width = 2;
		  id = setInterval(frame, 600);
		   
		  function frame() {
			if (width >= 100) {
			  clearInterval(id);
			} else {
			  width++; 
			  elem.style.width = width + '%'; 
			}
		  }
		}
	
	</script>	
		
