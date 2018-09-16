const listenAndScroll = () => {
	$('html, body').animate({
		scrollTop: $('#pin').offset().top
	}, 800, 'swing');
	window.removeEventListener('scroll', listenAndScroll);
	return 0;
};
const checkScreenAndLoadBackground = () => {
	const hw = `w=${$(window).width()}&h=${$(window).height()}&`;
	return 0;
}

let size = 'h=1000&';
// if ($(window).width() < 1000)
// 	size = `h=${$(window).width()}&w=${$(window).height()}&`;

$('#header').css(
	'background-image',
	`url('https://images.unsplash.com/photo-1503264116251-35a269479413?${size}crop=bottom&q=100&fm=jpg')`
);
// Materialize components initialization
$('#sidenav li, #nav-mobile li').each(function() {
	if ($(this).find('a').attr('href') === location.pathname) {
		$(this).addClass('active');
	}
});
$('.sidenav').sidenav();
$('#pin').pushpin({ top: $('#pin').offset().top });
$('.tabs').tabs();
$('.tooltipped').tooltip();
// Listen to click and scroll, has the callback say...
$('#scroll-down').click(listenAndScroll);
if 	(
		!(new URLSearchParams(window.location.search)).has('page')
	&&
		$('body').scrollTop() === 0
	)
	window.addEventListener('scroll', listenAndScroll);