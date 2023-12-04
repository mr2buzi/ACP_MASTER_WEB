$(document).ready(function () {
    $('#signup-form').submit(function (e) {
        e.preventDefault();

        var name = $('#name').val();
        var surname = $('#surname').val();
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirmpassword = $('#confirmpassword').val();

        $.ajax({
            type: 'POST',
            url: 'process.php',
            data: {
                name: name,
                surname: surname,
                username: username,
                email: email,
                password: password,
                confirmpassword: confirmpassword
            },
            success: function (data) {
                if (data === 'success') {
                    Swal.fire({
                        title: 'Success',
                        text: 'Account has been created successfully',
                        icon: 'success'
                    });
                } else if (data === 'error_password') {
                    Swal.fire({
                        title: 'Error',
                        text: 'Passwords do not match',
                        icon: 'error'
                    });
                } else if (data === 'duplicate_email') {
                    Swal.fire({
                        title: 'Error',
                        text: 'Email already exists',
                        icon: 'error'
                    });
                } else if (data === 'duplicate_username') {
                    Swal.fire({
                        title: 'Error',
                        text: 'Username already exists',
                        icon: 'error'
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'There were errors while saving the data',
                        icon: 'error'
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
                Swal.fire({
                    title: 'Error',
                    text: 'AJAX request failed',
                    icon: 'error'
                });
            }
        });
    });

    $('#email').blur(function () {
        var email = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'check_duplicate.php',
            data: { email: email },
            success: function (data) {
                if (data === 'duplicate_email') {
                    Swal.fire({
                        title: 'Error',
                        text: 'Email already exists',
                        icon: 'error'
                    });
                } else if (data === 'unique_email') {
                    // You can handle unique email case if needed
                }
            }
        });
    });

});
