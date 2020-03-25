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