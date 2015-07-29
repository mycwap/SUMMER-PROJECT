<?php
/*********************************************************************
BROUGHT TO YOU BY TIM @ TIMKIPPTUTORIALS.COM
APRIL 19, 2012

TIMKIPPTUTORIALS DOES NOT TAKE RESPONSIBLITY FOR HOW THIS CODE MAY BE USED. 
THIS MATERIAL IS FOR EDUCATIONAL PURPOSES ONLY AND CAN BE MODIFIED HOWEVER YOU 
SEE APPROPRIATE. THANK YOU FOR SUPPORTING TIMKIPPTUTORIALS.COM!
*********************************************************************/
?>
<!DOCTYPE>
<html lang="en">
<head>
	<title>PHP Javascript Image Upload</title>
	<script type="text/javascript">
	function updatepicture(pic) {
		document.getElementById("image").setAttribute("src", pic);
	}
	</script>
</head>
<body>
<h3>PHP Javascript Image Upload</h3>

<form id="form" method="post" action="upload.php" enctype="multipart/form-data" target="iframe">
	<input type="file" id="file" name="file" />
	<input type="submit" name="submit" id="submit" value="Upload File" />
</form>

<p id="message">Upload message will go here.</p>

<img style="min-height: 120; min-width: 200; max-height: 120px;" id="image" /><br /><br />

<iframe style="display: none;" name="iframe"></iframe>

</body>
</html>