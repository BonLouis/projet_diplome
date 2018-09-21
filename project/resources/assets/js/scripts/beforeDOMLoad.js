document.querySelector('body').style.overflow = 'hidden';

/**
 * Menu is fancy and all, but when we are looking for the next page
 * of, for example, 'formations', we don't want to go again to the header
 * and scroll down.
 * So, regarding to the urls parameters, let's handle this.
 * 
 * Moreover, we want to handle it before the DOMContentLoaded event is fired (1)
 * to prevent a glitchy behaviour.
 * But because the load of app.js is deffered (which is good),
 * we can't use Jquery before (1).
 *
 * Some pathname verification are done in the same goal.
 */
if  (
		(new URLSearchParams(window.location.search)).has('page')
		|| window.location.pathname === '/login'
		|| window.location.pathname === '/contact'
		|| window.location.pathname === '/post'
	)
	window.scrollTo(0, document.querySelector('#pin').offsetTop);