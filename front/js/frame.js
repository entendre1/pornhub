$(document).on('click','.mhp1138_play',function(){
    alert('hui');
});
setTimeout(() => { 

    //var link = $('#main_frame').contents().find('source')[0];
    var vars = document.getElementById("main_frame").contentWindow.flashvars;
    console.log(vars.mediaDefinitions[0].videoUrl);

}, 1000); 
