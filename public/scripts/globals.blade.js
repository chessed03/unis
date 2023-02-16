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

    $('.select2bs4').select2({
        theme: 'bootstrap4',
        placeholder: 'Selecciona una opción',
        width: '100%'
    });

}

initSelectCustomerSelect();

const tinyEditor = ( url_upload_image, token ) => {

    tinymce.init({
        height : "440",
        selector: '.tiny-editor',
        language: "es_MX",
        plugins: [
            'image code',
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste"
        ],
        toolbar:
            "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
        forced_root_block: false,
        image_title: true,
        automatic_uploads: true,
        images_upload_url: url_upload_image,
        file_picker_types: 'image',
        images_upload_handler: function(blobInfo, success, failure) {

            let xhr, formData;

            xhr = new XMLHttpRequest();

            xhr.withCredentials = false;

            xhr.open('POST', url_upload_image);

            xhr.setRequestHeader("X-CSRF-Token", token);

            xhr.onload = function() {

                let json;

                if (xhr.status != 200) {

                    failure('HTTP Error: ' + xhr.status);

                    return;

                }

                json = JSON.parse(xhr.responseText);

                console.log("response is ", json)

                if (!json || typeof json.location != 'string') {

                    failure('Invalid JSON: ' + xhr.responseText);

                    return;

                }

                success(json.location);

            };

            formData = new FormData();

            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        }
    });

}

const convertToSlug = ( stringText ) => {
    return stringText.toLowerCase()
        .replace(/ /g, '-')
        .replace(/[^\w-]+/g, '');
}

const generateSlug = () => {

    let stringText = $('#title').val();

    let slugText   = convertToSlug( stringText );

    $('.slug').val( slugText );

}
