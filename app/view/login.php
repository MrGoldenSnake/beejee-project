<div class="login-form-wrapper">
	<form action="/auth/login" method="POST">
		<div class="form-group">
			<label for="login">Login</label>
			<input type="text" name="login" class="form-control" required>
		</div>

		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" class="form-control" required>
		</div>
		
		<input type="submit" class="btn btn-light btn-sm" value="Log in">

		<?=($status['error'] == 1 ? '<br><br><div class="alert alert-danger" role="alert">'.$status['name'].'</div>' : '');?>
	</form>
</div>