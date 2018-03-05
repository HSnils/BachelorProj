@if ($flash = session('notifyUser'))


	<div id="notifyUser" class="alert alert-success" role="alert">
		{{ $flash }}
	</div>


	<script>
		$(document).ready(function(){
			$('#notifyUser').fadeOut(2000);
			//$('#demo-toast-example').fadeOut(2000);
		});
	</script>
@endif
