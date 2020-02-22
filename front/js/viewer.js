$(document).on('click',document,function(){
    if (included_cats){
        $('#launch-input').attr('name','included_cats');
        $('#launch-input').attr('value',included_cats);
        $('#launch-form').submit();
    }else{
        $('#launch-form').submit(); 
    }
    
});