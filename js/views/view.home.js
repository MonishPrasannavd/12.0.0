(($=>{if($.isFunction($.fn.flipshow)){const circleContainer=$('.fc-slideshow');$.each(circleContainer,function(){const $container=$(this);$container.flipshow();setTimeout(function circleFlip(){$container.data().flipshow._navigate($container.find('div.fc-right span:first'),'right');setTimeout(circleFlip,3000);},3000);});}
if($('.cloud').get(0)){const moveCloud=()=>{$('.cloud').animate({'top':'+=20px'},3000,'linear',()=>{$('.cloud').animate({'top':'-=20px'},3000,'linear',()=>{moveCloud();});});};moveCloud();}})).apply(this,[jQuery]);