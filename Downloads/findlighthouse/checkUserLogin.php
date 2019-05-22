<?php
	session_start();
	if(isset($_SESSION['user_id'])) {
    } else {
?>
			<script type="text/javascript">
                window.location = 'index.php';
            </script>
<?php
	}
?>