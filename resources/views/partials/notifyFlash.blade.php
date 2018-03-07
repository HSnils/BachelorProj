<!--Checks if notifyUser is set in session, if it is fills flash variable and runs the code -->
@if ($flash = session('notifyUser'))
<!-- Toast from getmdl.io -->
<div id="notifyUserToast" class="mdl-js-snackbar mdl-snackbar">
	<div class="mdl-snackbar__text"></div>
	<button class="mdl-snackbar__action" type="button"></button>
</div>
<!-- JS to make toast pop on page load instead of button Source: https://stackoverflow.com/questions/9899372/pure-javascript-equivalent-of-jquerys-ready-how-to-call-a-function-when-t/30319853#30319853 -->
<script>
	r(function(){
		var snackbarContainer = document.querySelector('#notifyUserToast');
		var data = {message: '{{$flash}}'};
		snackbarContainer.MaterialSnackbar.showSnackbar(data);
	});
	function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
</script>
@endif
