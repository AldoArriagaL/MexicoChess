<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
		
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	
	<?php wp_head(); ?>
	
	<style>
		.aa-pageload-screen{
			position: fixed;
			width: 100%;
			height: 100%;
			z-index: 1500;
			top: 0;
			left: 0;
			background-color: #ffffff;
			visibility: hidden;
			opacity: 0;
			
			-webkit-transition: all 700ms linear 800ms;
			transition: all 700ms linear 800ms;
		}
		.aa-pageloading .aa-pageload-screen{
			opacity: 1;
			visibility: visible;
		}
		.aa-pageload-screen .aa-logo{
			position: absolute;
			left: 0;
			right: 0;
			bottom: 50%;
		    top: auto;
		    width: 260px;
		    transform: translateY(50%);
		    -webkit-transform: translateY(50%);
		    vertical-align: middle;
		    margin: auto;
		}
	</style>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-135385724-2"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	
	  gtag('config', 'UA-135385724-2');
	</script>

	<!-- Facebook Pixel Code --><script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '2195713847230940'); fbq('track', 'PageView');</script><noscript> <img height="1" width="1" src="https://www.facebook.com/tr?id=2195713847230940&ev=PageView&noscript=1"/></noscript><!-- End Facebook Pixel Code -->

</head>

<body <?php body_class(); ?>>
	
	<div id="pagetop"></div>
	<div class="aa-pageload-screen">
		<div class="aa-logo">MéxicoChess</div>
	</div>
	
	<button class="aa-mainmenu aajs-triggerovermenu">
		<span>Menu</span>
		<div class="aa-menuicon">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</button>
	
	<div class="aa-overmenu">
		<div class="aa-overmenu-inner aa-clearfix">
			<div class="aa-overmenu-brand">
				<div class="aa-logo">MéxicoChess</div>
			</div>
			<div class="aa-overmenu-menu">
				<?php wp_nav_menu(array('menu' => 'Menú Principal', 'menu_class' => 'aa-overmenu-nav')); ?>
			</div>
			<div class="aa-overmenusocials">
				<ul class="aa-socials">
					<li><a href="https://www.facebook.com/pg/MexicoChessSocial" target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
					<li><a href="https://twitter.com/mexicochesscom" target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="aa-head">
		<div class="aa-header">
			<div class="aa-section-inner aa-clearfix">
				<a href="/"><div class="aa-logo">MéxicoChess</div></a>
				<div class="aa-main-menu">
					<?php wp_nav_menu(array('menu' => 'Menú Principal', 'menu_class' => 'aa-main-nav')); ?>
				</div>
			</div>
			
		</div>
	</div>
	
	<div class="aa-main-content">
	
	
	
	
	
	
	
	
	