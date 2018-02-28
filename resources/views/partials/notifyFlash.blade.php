@if ($flash = session('notifyUser'))
	<div id="notifyUser" class="alert alert-success" role="alert">
		{{ $flash }}
	</div>
	<script>
		$(document).ready(function(){
			$('#notifyUser').fadeOut(12000);
		});
	</script>
@endif
