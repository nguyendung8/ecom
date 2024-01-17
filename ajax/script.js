$(document).ready(function() {
    $('#btn_contact').click(function(e) {
        var name = $('#name').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var message = $('#message').val();

        if (!name || !email || !subject || !message) {
            $('#error_msg').html('Please fill in the blanks');
            return;
        }

        $.ajax({
            type: "post",
            url: "ajax/cnt.php",
            data: { name: name, email: email, subject: subject, message: message },
            success: function(response) {
                toastr.success('Thanks for contact me');
                $('#name').val('');
                $('#email').val('');
                $('#subject').val('');
                $('#message').val('');
                $('#error_msg').html('');
            }
        });
    });

    $('#btn_register').click(function(e) {
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();

        if (!name || !email || !password || !confirm_password) {
            $('#error_msg').html('Please fill in the blanks');
            return;
        }
        if (password != confirm_password) {
            $('#error_msg').html('Confirm password not correct');
            return;
        }

        $.ajax({
            type: "post",
            url: "ajax/user_register.php",
            data: { name: name, email: email, password: password },
            success: function(response) {
                if (response == 'success') {
                    toastr.success('Register success');
                    $('#name').val('');
                    $('#email').val('');
                    $('#password').val('');
                    $('#confirm_password').val('');
                    $('#error_msg').html('');
                } else {
                    toastr.error('Register failed');
                    $('#error_msg').html(response);
                }
            }
        });
    });

    $('#btn_login').click(function(e) {
        var email = $('#email').val();
        var password = $('#password').val();

        if (!email || !password) {
            $('#error_msg').html('Please fill in the blanks');
            return;
        }

        $.ajax({
            type: "post",
            url: "ajax/login_user.php",
            data: { email: email, password: password },
            success: function(response) {
                if (response == 'success') {
                    toastr.success('Login success');
                    $('#name').val('');
                    $('#email').val('');
                    $('#password').val('');
                    $('#confirm_password').val('');
                    $('#error_msg').html('');
                    window.location.href = 'index.php';
                } else {
                    toastr.error('Login failed');
                    $('#error_msg').html(response);
                }
            }
        });
    });

    $('#btn_add_cart').click(function(e) {
        var id = $(this).attr('data-id');
        var quantity = $('#quantity').val();

        $.ajax({
            type: "post",
            url: "ajax/add_cart.php",
            data: { id: id, quantity: quantity, type: 'add' },
            success: function(response) {
                $('#cart-total').text(response);
            }
        });
    });
});