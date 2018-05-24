

function success(title,message, icon = 'fa fa-check'){
    iziToast.success({
        title: title,
        message: message,
        icon: icon,
        position: 'topRight'
    });
}

function error(title,message, icon = 'fa fa-times'){
    iziToast.error({
        title: title,
        message: message,
        icon: icon,
        position: 'topRight'
    });
}
