<script>
$(document).ready(function(){
	$('#Inputusername').blur(function(){
		$('#pesan').html();
		var username = $(this).val();

		$.ajax({
			type	: 'POST',
			url 	: 'data/proses_cek_ketersediaan_user.php',
			data 	: 'Inputusername='+username,
			success	: function(data){
				$('#pesan').html(data);
			}
		})

	});
});
</script>