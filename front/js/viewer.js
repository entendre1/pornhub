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