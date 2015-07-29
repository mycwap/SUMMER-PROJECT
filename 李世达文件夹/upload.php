<?php
if ($_FILES['file']['size']>0) {
	if ($_FILES['file']['size']<=153600) {
		if (move_uploaded_file($_FILES['file']['tmp_name'], "image/".$_FILES['file']['name'])) {
			// file uploaded	

		?>
		<script type="text/javascript">
			parent.document.getElementById("message").innerHTML="";
			parent.document.getElementById("file").value="";
			window.parent.updatepicture("<php echo 'image/'.$_FILES['file']['name'];?>")
		</script>
		<?php

		}else{
			// the upload fail
			 
			?>
			<script type="text/javascript">
				parent.document.getElementById("message").innerHTML="<font color='#ff0000'> There was an error uploading your image. Please try again later.</font>";
			<?php

			 }

	}else{
	//the file is too big

		  }
}
?>