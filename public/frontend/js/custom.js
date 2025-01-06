// $(document).ready(function () {
//     $('.js-example-basic-multiple, .js-example-basic-single').select2();
// });

//Select All Checkbox
$('.metronic_select_all').on('change', function () {
    // Apply check state to all checkboxes
    $('[type="checkbox"]').prop('checked', $(this).prop('checked'));
});

// Password Show and Hide
$(document).ready(function () {
    $('.toggle-password').click(function () {
        const passwordInput = $(this).closest('.position-relative').find('input');
        const isVisible = passwordInput.attr('type') === 'text';
        passwordInput.attr('type', isVisible ? 'password' : 'text');
        $(this).find('.bi-eye').toggleClass('d-none');
        $(this).find('.bi-eye-slash').toggleClass('d-none');
    });
});



// Delete action with reload page
$(document).on('click', '.delete', function (e) {
    e.preventDefault();

    var deleteUrl = $(this).attr('href');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-success'
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (data) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then(function () {
                        location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    Swal.fire(
                        'Error Occurred!',
                        error,
                        'error'
                    );
                }
            });
        }
        else if (result.dismiss === swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            );
        }
    });
});


// --------------------------------
// Delete Account with reload page
$(document).on('click', '.delete-account', async function (e) {
    e.preventDefault();

    var deleteAccountUrl = $(this).attr('href');
    var checkPasswordUrl = $(this).data('check-password-url');
    const { value: password } = await Swal.fire({
        title: "Confirm Password",
        input: "password",
        // inputLabel: "Password",
        inputPlaceholder: "Enter your password",
        inputAttributes: {
            maxlength: "30",
            autocapitalize: "off",
            autocorrect: "off"
        },
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-success'
        }
    });

    if (password) {
        // Check if the entered password matches the user's password in the database
        $.ajax({
            url: checkPasswordUrl,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                password: password,
            },
            success: function (response) {
                if (response.success) {
                    // Password matches, proceed with deletion
                    $.ajax({
                        url: deleteAccountUrl,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Your Account has been deleted.',
                                'success'
                            ).then(function () {
                                // location.reload();
                                window.location.href = '/';
                            });
                        },
                        error: function (xhr, status, error) {
                            Swal.fire(
                                'Error Occurred!',
                                error,
                                'error'
                            );
                        }
                    });
                } else {
                    // Password does not match, show error message
                    Swal.fire(
                        'Error Occurred!',
                        response.message,
                        'error'
                    );
                }
            },
            error: function (xhr, status, error) {
                Swal.fire(
                    'Error Occurred!',
                    'An error occurred while checking the password. Please try again.',
                    'error'
                );
            }
        });
    } else {
        Swal.fire(
            'Cancelled',
            'Your Account is safe :)',
            'error'
        );
    }
});
// --------------------------------



// Define toggleStatus function globally
function toggleStatus(route, id) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: route,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (response) {
            $(`#status_toggle_${id}`).prop('checked', response.success);
            Toast.fire({
                icon: 'success',
                title: 'Status toggled successfully'
            });
        },
        error: function (xhr) {
            console.error('Error - ' + xhr.status + ': ' + xhr.statusText);
            Toast.fire({
                icon: 'error',
                title: 'An error occurred'
            });
        }
    });

    document.addEventListener("DOMContentLoaded", () => {
        const inner = document.querySelector('.inner');
        const resizeText = () => {
            if (inner.scrollWidth > inner.clientWidth) {
                inner.style.fontSize = `${parseFloat(getComputedStyle(inner).fontSize) - 1}px`;
            }
        };

        resizeText();
        window.addEventListener('resize', resizeText);
    });
}





