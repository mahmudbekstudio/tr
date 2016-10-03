<?php
use yii\helpers\Url;

$this->title = 'Login';
$this->params['bodyClass'] = 'gray-bg';
?>
<div class="middle-box text-center loginscreen animated fadeInDown">
	<div>
		<?php /*<div>

			<h1 class="logo-name">IN+</h1>

		</div>
		<h3>Welcome to IN+</h3>
		<p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
			<!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
		</p>
		<p>Login in. To see it in action.</p>*/ ?>
		<form class="m-t" id="systemLoginForm" role="form" action="<?php echo Url::to('site/systemlogin') ?>">
			<div class="form-group">
				<input type="email" class="form-control system-login-email" placeholder="E-mail" required="">
			</div>
			<div class="form-group">
				<input type="password" class="form-control system-login-password" placeholder="Password" required="">
			</div>
			<button type="submit" class="btn btn-primary block full-width m-b system-login-btn">Login <i class="fa fa-spinner fa-pulse fa-fw margin-bottom system-login-form-load hidden"></i></button>

			<?php /*<a href="#"><small>Forgot password?</small></a>
			<p class="text-muted text-center"><small>Do not have an account?</small></p>
			<a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>*/ ?>
		</form>
<?php /*<p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>*/ ?>
	</div>
</div>