$(document).on('click','#re-btn',function(){
    if (included_cats){
        $('#launch-input').attr('name','included_cats');
        $('#launch-input').attr('value',included_cats);
        $('#launch-form').submit();
    }else{
        $('#launch-form').submit(); 
    }
    
});

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
//let detect = new MobileDetect(window.navigator.userAgent)
//if (detect.mobile()){
//    if (screenfull.isEnabled) {
//		screenfull.request(document.documentElement);
//	}
//} 
//$(document).on('swipe','body',function(){
//    document.documentElement.requestFullscreen();
//})
