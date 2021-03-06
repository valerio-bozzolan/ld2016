<?php
# Linux Day 2016 - Header
# Copyright (C) 2016 Valerio Bozzolan
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

class Header {
	function __construct($menu_uid = null, $args = [] ) {
		$menu = get_menu_entry($menu_uid);

		$args = merge_args_defaults($args, [
			'show-title'  => true,
			'nav-title'   => SITE_NAME_SHORT,
			'head-title'  => null,
			'title'       => $menu->name,
			'url'         => $menu->url,
			'not-found'   => false,
			'user-navbar' => true,
			'container'   => true
		] );

		if( ! isset( $args['og'] ) ) {
			$args['og'] = [];
		}

		$args['og'] = merge_args_defaults($args['og'], [
			'image'  => URL . STATIC_FOLD . '/ld-2016-logo-teal.png', // It's better an absolute URL here
			'type'   => 'website',
			'url'    => $args['url'],
			'title'  => $args['title']
		] );

		if( $args['head-title'] === null ) {
			$args['head-title'] = sprintf(
				_("%s - %s"),
				$args['title'],
				$args['nav-title']
			);
		}

		header('Content-Type: text/html; charset=' . CHARSET);

		if( $args['not-found'] ) {
			header('HTTP/1.1 404 Not Found');
		}

		enqueue_css('materialize');
		enqueue_css('materialize.custom');
		enqueue_css('materialize.icons');
		enqueue_js('jquery');
		enqueue_js('materialize');

		// Close header - Start
		$args['container'] && inject_in_module('footer', function() { ?>
		</div>
		<!-- End container -->

		<?php } );
		// Close header - End
?>
<!DOCTYPE html>
<html lang="<?php echo ISO_LANG ?>">
<head>
	<title><?php echo $args['head-title'] ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="generator" content="GNU nano" />
	<link rel="copyright" href="//creativecommons.org/licenses/by-sa/4.0/" />

	<link rel="icon" type="image/png" sizes="196x196" href="<?php echo XXX ?>/favicon/logo-192.png" />
	<link rel="shortcut icon" href="<?php echo XXX ?>/favicon/favicon.ico" />
	<link rel="icon" sizes="16x16 32x32 64x64" href="<?php echo XXX ?>/favicon/favicon.ico">
	<link rel="icon" type="image/png" sizes="196x196" href="<?php echo XXX ?>/favicon/favicon-192.png">
	<link rel="icon" type="image/png" sizes="160x160" href="<?php echo XXX ?>/favicon/favicon-160.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo XXX ?>/favicon/favicon-96.png">
	<link rel="icon" type="image/png" sizes="64x64" href="<?php echo XXX ?>/favicon/favicon-64.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo XXX ?>/favicon/favicon-32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo XXX ?>/favicon/favicon-16.png">
	<link rel="apple-touch-icon" href="<?php echo XXX ?>/favicon/favicon-57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo XXX ?>/favicon/favicon-114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo XXX ?>/favicon/favicon-72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo XXX ?>/favicon/favicon-144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo XXX ?>/favicon/favicon-60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo XXX ?>/favicon/favicon-120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo XXX ?>/favicon/favicon-76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo XXX ?>/favicon/favicon-152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo XXX ?>/favicon/favicon-180.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="<?php echo XXX ?>/favicon/favicon-144.png">
	<meta name="msapplication-config" content="<?php echo XXX ?>/favicon/browserconfig.xml">
<?php load_module('header') ?>

<?php foreach($args['og'] as $id=>$value): ?>
	<meta property="og:<?php echo $id ?>" content="<?php echo $value ?>" />
<?php endforeach ?>
</head>
<!--
 _     _                    _       _ _ _
| |   (_)_ __  _   ___  __ (_)___  | (_) | _____   ___  _____  __
| |   | | '_ \| | | \ \/ / | / __| | | | |/ / _ \ / __|/ _ \ \/ /
| |___| | | | | |_| |>  <  | \__ \ | | |   <  __/ \__ \  __/>  < _
|_____|_|_| |_|\__,_/_/\_\ |_|___/ |_|_|_|\_\___| |___/\___/_/\_( )
                                                                |/
 _ _   _       _          _   _                       _
(_) |_( )___  | |__   ___| |_| |_ ___ _ __  __      _| |__   ___ _ __
| | __|// __| | '_ \ / _ \ __| __/ _ \ '__| \ \ /\ / / '_ \ / _ \ '_ \
| | |_  \__ \ | |_) |  __/ |_| ||  __/ |     \ V  V /| | | |  __/ | | |
|_|\__| |___/ |_.__/ \___|\__|\__\___|_|      \_/\_/ |_| |_|\___|_| |_|

 _ _   _        __                       _____
(_) |_( )___   / _|_ __ ___  ___        |  ___| __ ___  ___    __ _ ___
| | __|// __| | |_| '__/ _ \/ _ \       | |_ | '__/ _ \/ _ \  / _` / __|
| | |_  \__ \ |  _| | |  __/  __/_ _ _  |  _|| | |  __/  __/ | (_| \__ \
|_|\__| |___/ |_| |_|  \___|\___(_|_|_) |_|  |_|  \___|\___|  \__,_|___/

 _         _____                  _                 _
(_)_ __   |  ___| __ ___  ___  __| | ___  _ __ ___ | |
| | '_ \  | |_ | '__/ _ \/ _ \/ _` |/ _ \| '_ ` _ \| |
| | | | | |  _|| | |  __/  __/ (_| | (_) | | | | | |_|
|_|_| |_| |_|  |_|  \___|\___|\__,_|\___/|_| |_| |_(_)

<3
<?php _e('https://it.wikipedia.org/wiki/GNU') ?>

<3
<?php _e('https://it.wikipedia.org/wiki/Linux_(kernel)') ?>

-->
<body>
	<nav>
		<div class="nav-wrapper purple darken-4">
			<a class="brand-logo" href="<?php echo URL . _ ?>" title="<?php _esc_attr(SITE_NAME) ?>">
				<img src="<?php echo XXX ?>/ld-2016-logo-64.png" alt="<?php _esc_attr(SITE_DESCRIPTION) ?>" />
			</a>
			<a href="#" data-activates="slide-out" class="button-collapse"><?php echo icon('menu') ?></a>
			<?php print_menu('root', 0, ['main-ul-intag' => 'class="right hide-on-med-and-down"']) ?>

		</div>
		<?php print_menu('root', 0, [
			'main-ul-intag' => 'id="slide-out" class="side-nav"',
			'collapse' => true
		] ) ?>

	</nav>
	<div class="parallax-container">
		<div class="parallax"><img src="<?php echo XXX ?>/this-is-Wikipedia.jpg" alt="<?php _e("This is Wikipedia") ?>"></div>
	</div>

	<?php if( $args['show-title'] ): ?>
	<header class="container">
		<?php if( isset( $args['url'] ) ): ?>

		<h1><?php echo HTML::a($args['url'], $args['title'], null, TEXT) ?></h1>
		<?php else: ?>

		<h1><?php echo $args['title'] ?></h1>
		<?php endif ?>
	</header>
	<?php endif ?>

	<?php if( $args['container'] ): ?>
	<!-- Start container -->
	<div class="container">

	<?php endif ?>

<?php	}
}
