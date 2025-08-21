/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

'use strict';
function flashyAlert(type,message) {
    if(type == 'success') {
        iziToast.success({
            title: 'Great',
            message: message,
            position: 'topRight'
        });
    } else if(type == 'info'){
                iziToast.info({
            title: '',
             message: message,
            position: 'topRight'
        });
    } else if(type == 'warning'){
            iziToast.warning({
            title: '',
             message: message,
            position: 'topRight'
        });
    }
    else {
        iziToast.error({
            title: 'Error',
            message: message,
            position: 'topRight'
        });
    }
}

