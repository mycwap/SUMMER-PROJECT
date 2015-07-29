<?php
/*********************************************************************
BROUGHT TO YOU BY TIM @ TIMKIPPTUTORIALS.COM
APRIL 19, 2012

TIMKIPPTUTORIALS DOES NOT TAKE RESPONSIBLITY FOR HOW THIS CODE MAY BE USED. 
THIS MATERIAL IS FOR EDUCATIONAL PURPOSES ONLY AND CAN BE MODIFIED HOWEVER YOU 
SEE APPROPRIATE. THANK YOU FOR SUPPORTING TIMKIPPTUTORIALS.COM!
*********************************************************************/
?>
<?php

if ($_FILES['file']['size'] > 0) {

	if ($_FILES['file']['size'] <= 153600) {
		if (move_uploaded_file($_FILES['file']['tmp_name'], "images/".$_FILES['file']["name"])) {
			// file uploaded
			
			?>
			<script type="text/javascript">
			parent.document.getElementById("message").innerHTML = "";
			parent.document.getElementById("file").value = "";
			window.parent.updatepicture("<?php echo 'images/'.$_FILES['file']["name"]; ?>");
			</script>
			<?php
			
		} else {
			// the upload failed
			
			?>
			<script type="text/javascript">
			parent.document.getElementById("message").innerHTML = "<font color='#ff0000'>There was an error uploading your image. Please try again later.</font>";
			</script>			
			<?php
			
		}
	} else {
		// the file is too big
		
		?>
		<script type="text/javascript">
		parent.document.getElementById("message").innerHTML = "<font color='#ff0000'>Your file is larger than 150kb. Please choose a different picture.</font>";
		</script>
		<?php
		
	}
	
}

?>