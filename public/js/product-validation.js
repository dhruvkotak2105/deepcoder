$(document).ready(function() {
    $("#product-form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            description: {
                required: true
            },
            price: {
                required: true,
                number: true
            },
            category_id: {
                required: true
            },
            thumb_image: {
                required: true,
                extension: "jpeg|png|jpg|gif|svg"
            }
        },
        messages: {
            name: {
                required: "Please enter the product name",
                maxlength: "The product name must not exceed 255 characters"
            },
            description: {
                required: "Please enter the product description"
            },
            price: {
                required: "Please enter the product price",
                number: "Please enter a valid price"
            },
            category_id: {
                required: "Please select a category"
            },
            thumb_image: {
                required: "Please upload a thumbnail image",
                extension: "Allowed file types: jpeg, png, jpg, gif, svg"
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            if (element.prop('type') === 'checkbox' || element.prop('type') === 'file') {
                error.insertAfter(element.siblings('label').last());
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });
});
