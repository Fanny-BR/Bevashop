<script>
$(document).ready(function(){
	$('#kode').blur(function(){
		$('#pesan').html();
		var kode = $(this).val();

		$.ajax({
			type	: 'POST',
			url 	: 'data/proses_cek_ketersediaan_supplier.php',
			data 	: 'kode='+kode,
			success	: function(data){
				$('#pesan').html(data);
			}
		})

	});
});
</script>