$(document).on('click','#re-btn',function(){
    if (included_cats){
        $('#launch-input').attr('name','included_cats');
        $('#launch-input').attr('value',included_cats);
        $('#launch-form').submit();
    }else{
        $('#launch-form').submit(); 
    }
    
});

function setUserAgent(window, userAgent) {
    if (window.navigator.userAgent != userAgent) {
        var userAgentProp = { get: function () { return userAgent; } };
        try {
            Object.defineProperty(window.navigator, 'userAgent', userAgentProp);
        } catch (e) {
            window.navigator = Object.create(navigator, {
                userAgent: userAgentProp
            });
        }
    }
}
window.open = function (url, windowName, windowFeatures) {
    console.log('not opening a window');
}
function fullScreen(element) {
    if(element.requestFullscreen) {
      element.requestFullscreen();
    } else if(element.webkitrequestFullscreen) {
      element.webkitRequestFullscreen();
    } else if(element.mozRequestFullscreen) {
      element.mozRequestFullScreen();
    }
  }
var html = document.body;
let detect = new MobileDetect(window.navigator.userAgent)
if (detect.mobile()){
    if (screenfull.isEnabled) {
		screenfull.request(document.documentElement);
	}
    alert('fullscreen');
}   
$(document).on('swipe','body',function(){
    document.documentElement.requestFullscreen();
})
