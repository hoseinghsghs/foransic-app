$(function(){$(".jsdemo-notification-button button").on("click",function(){var a=$(this).data("placement-from"),t=$(this).data("placement-align"),s=$(this).data("animate-enter"),e=$(this).data("animate-exit"),i=$(this).data("color-name");l(i,null,a,t,s,e)})});function l(a,t,s,e,i,n){(a===null||a==="")&&(a="bg-black"),(t===null||t==="")&&(t="تبدیل هشدارهای بوت استرپ استاندارد"),(i===null||i==="")&&(i="animated fadeInDown"),(n===null||n==="")&&(n="animated fadeOutUp");var o=!0;$.notify({message:t},{type:a,allow_dismiss:o,newest_on_top:!0,timer:1e5,placement:{from:s,align:e},animate:{enter:i,exit:n},template:'<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} " role="alert"><button type="button" aria-hidden="true" style="top: 10px !impotant; " class="close" data-notify="dismiss">×</button><span data-notify="icon"></span> <span data-notify="title">{1}</span> <span data-notify="message">{2}</span><div class="progress" data-notify="progressbar"><div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div><a href="{3}" target="{4}" data-notify="url"></a></div>'})}
