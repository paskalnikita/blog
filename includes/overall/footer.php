		</div>
	</div>
<?php
	$DIR=$_SERVER["DOCUMENT_ROOT"];
	include "$DIR/includes/footer.php";?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script  type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript">
				$(function(){
				$('#password').keyup(function () {
					val = $('#password').val();
					$.ajax({
					type: "POST",
					url: "checkpass.php",
					data: "password="+val,
					success: function(html){
						$("#password-indicator").html(html);
					}
					});
				});
			});
//Animations 
	$('.post').addClass('animated slideInLeft');
	// $('#container').addClass('animated slideInUp');

//Vanishing blocks whith errors
		setTimeout(function(){$('.img-file-error').fadeOut('slow')},4000); // for settings
		setTimeout(function(){$('.errors-output').fadeOut('slow')},5000); //for settings,register
		setTimeout(function(){$('.success-output').fadeOut('slow')},5000); //for settings,register
		setTimeout(function(){$('.vanishing').fadeOut('slow')},3500);  //for news
//Name and surname can have only letters
function lettersOnly(input){
	var regex = /[^a-z]/gi;
	input.value = input.value.replace(regex,'');
}



// Birthday select in settings
	function updateDays(){
		//Create variables needed
		var monthSel = document.getElementById('month');
		var daySel   = document.getElementById('day');
		var yearSel  = document.getElementById('year');
		var monthVal = monthSel.value;
		var yearVal  = yearSel.value;
		//Determine the number of days in the month/year
		var daysInMonth = 31;
		if (monthVal==2){
			daysInMonth = (yearVal%4==0 && (yearVal%100!=0 || yearVal%400==0)) ? 29 : 28;
		}
		else if (monthVal==4 || monthVal==6 || monthVal==9 || monthVal==11){
			daysInMonth = 30;
		}
		//Add/remove options from days select list as needed
		if(daySel.options.length > daysInMonth){
			//Remove excess days, if needed
			daySel.options.length = daysInMonth;
		}
		while (daySel.options.length != daysInMonth){
		//Add additional days, if needed
			daySel.options[daySel.length] = new Option(daySel.length+1, daySel.length+1, false);
		}
		return;
	}

// Select smile
	function smile(){
		insertTextAtCursor(document.getElementById('comment_area'),':) ');
	}

	function insertTextAtCursor(el, text, offset) {
		var val = el.value, endIndex, range, doc = el.ownerDocument;
		if (typeof el.selectionStart == "number"
				&& typeof el.selectionEnd == "number") {
			endIndex = el.selectionEnd;
			el.value = val.slice(0, endIndex) + text + val.slice(endIndex);
			el.selectionStart = el.selectionEnd = endIndex + text.length+(offset?offset:0);
		} else if (doc.selection != "undefined" && doc.selection.createRange) {
				el.focus();
				range = doc.selection.createRange();
				range.collapse(false);
				range.text = text;
				range.select();
			}
	}

//Drop down list from users
			function DropDown(el){
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function(){
					var obj = this;
					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});
				}
			}
			$(function(){
				var dd = new DropDown( $('#dd') );
				$(document).click(function() {
					$('.dropdown-list').removeClass('active');
				});
			});

//Symbols left calc function
		window.addEventListener('load', function(){
		comment_form.comment.addEventListener('input', calcChars, false);
		comment_form.comment.addEventListener('focus', calcChars, false);
		var max = 255;
		function calcChars(){
			var left = max - this.value.length;
			if(left < 0){
					this.value = this.value.substr(0, max);
					alert('You can\'t write more than 255 characters!');
					return false;
			}
			counter.style.color = left <= 10 ? '#FF4040' : '#40C781';
			counter.textContent = max - this.value.length;
		}
		calcChars.call(comment_form.comment);
	},false);

	window.addEventListener('load', function(){
		comment_form.comment_area.addEventListener('input', calcChars, false);
		comment_form.comment_area.addEventListener('focus', calcChars, false);
		var max = 255;
		function calcChars(){
			var left = max - this.value.length;
			if(left < 0){
					this.value = this.value.substr(0, max);
					alert('You can\'t write more than 255 characters!');
					return false;
			}
			counter.style.color = left <= 10 ? '#FF4040' : '#40C781';
			counter.textContent = max - this.value.length;
		}
		calcChars.call(comment_form.comment_area);
	},false);


//Photo preview
	function onFileSelect(e){
		var f = e.target.files[0]; // Первый выбранный файл
		if(f.type.match(/image.*/)){
			var reader = new FileReader;
			place = document.getElementById("previewImg"); // Сюда покажем картинку
			reader.readAsDataURL(f);
			reader.onload = function(e){ // Как только картинка загрузится
				place.src = e.target.result;
			}
		}
		else {
				alert('You can chose only pictures');
			};
	};
	if(window.File && window.FileReader && window.FileList && window.Blob){
		document.querySelector("input[type=file]").addEventListener("change", onFileSelect, false);
	}else{
		console.warn( "Your browser does not support FileAPI");
	};

	//Up page button //does not work????
	$(function() {
		$.fn.scrollToTop = function() {
		$(this).hide().removeAttr("href");
		if ($(window).scrollTop() >= "250") $(this).fadeIn("slow")
		var scrollDiv = $(this);
		$(window).scroll(function() {
			if ($(window).scrollTop() <= "250") $(scrollDiv).fadeOut("slow")
			else $(scrollDiv).fadeIn("slow")
		});
			$(this).click(function() {
				$("html, body").animate({scrollTop: 0}, "slow");
			})
			}
		});
		$(function(){
			$("#Go_Top").scrollToTop();
		});
</script>
</body>
</html>