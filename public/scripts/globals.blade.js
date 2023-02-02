const alertMessage = ( message, type ) => {

    let Toast = Swal.mixin({

        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }

    });

    Toast.fire({
        icon  : type,
        title : message
    });

}

const changeIcon = id => {

    if ( $('#headerIconCard' + id).hasClass('bx bx-expand-alt bx-border-circle') ) {

        $('#headerIconCard' + id).removeClass().addClass('bx bx-minus bx-border-circle font-weight-bold');

    } else {

        $('#headerIconCard' + id).removeClass().addClass('bx bx-expand-alt bx-border-circle font-weight-bold');

    }
}

window.initSelectCustomerSelect = () => {

    $('.select2').select2({
        placeholder: 'Selecciona una opción',
        width: '100%'
    });

}
