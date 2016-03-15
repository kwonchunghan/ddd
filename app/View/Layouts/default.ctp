<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]><?php echo $this->Html->script('ie8-responsive-file-warning') ?>![endif]-->
	<?php echo $this->Html->script('ie-emulation-modes-warning') ?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<?php
		echo $this->Html->meta('icon');

		// echo $this->Html->css('cake.generic');
		// bootstrap css add
		echo $this->Html->css('../bootstrap/css/bootstrap.min');
		// font awesome css add
		echo $this->Html->css('../font-awesome/css/font-awesome.min');
		echo $this->Html->css('dashboard');
		echo $this->Html->css('style');
		echo $this->Html->css('../jquery-ui-1.11.4/jquery-ui.min.css');
		echo $this->Html->css('../jquery-ui-1.11.4/jquery-ui.theme.min.css');

		// bootstrap js add
		echo $this->Html->script('jquery-1.11.3.min', array('inline' => false));
		echo $this->Html->script('../bootstrap/js/bootstrap.min', array('inline' => false));
		echo $this->Html->script('common', array('inline' => false));
		echo $this->Html->script('../jquery-ui-1.11.4/jquery-ui.min.js', array('inline' => false));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
