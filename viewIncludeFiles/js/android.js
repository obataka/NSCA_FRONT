$(function(){
	if (navigator.userAgent.indexOf('Android') > 0) {
		let body = document.getElementsByTagName('body')[0];
		body.classList.add('Android');
	}
});