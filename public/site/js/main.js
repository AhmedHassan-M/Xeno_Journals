//--------------------------//
// START NAVIGATION
//--------------------------//

function navigation() {
    $('.explore-panes').height($('.explore-submenu>.row').height());
    $('.explore-menu-item').eq(0).addClass('active');
    $('.pane-item').eq(0).addClass('active');

    function positionExploreMenuIndicator() {
        const icon_left = $('#exploreBtn img').offset().left;
        const container_left = $('.ws-nav-container').offset().left;
        $('#exploreMenu .indicator').css('left', icon_left - container_left);
    }
    positionExploreMenuIndicator();
    $(window).resize(function () {
        positionExploreMenuIndicator();
    });
    $('#exploreBtn').click(function (e) {
        $('.user-nav-dropdown:not(#exploreMenu)').removeClass('shown').addClass('hidden');
        $('.toggle-nav-btn').removeClass('open');
        $('#exploreMenu').toggleClass('hidden shown');
        e.stopPropagation();
    });
    $('.explore-menu-item:not(".show-all")').click(function () {
        $(this).addClass('active');
        $(this).siblings('.explore-menu-item').removeClass('active');
        const id = $(this).attr('data-controls');
        $('.pane-item').removeClass('active');
        $('.pane-'+id).addClass('active');
    });
    $('.burger-menu-btn').click(function () {
        if ($(this).hasClass('menu-closed')) {
            $(this).removeClass('menu-closed').addClass('menu-open');
            $('.mb-menu').addClass('open');
            $('.touchable-overlay').removeClass('d-none');
        } else if ($(this).hasClass('menu-open')) {
            $(this).removeClass('menu-open').addClass('menu-closed');
            $('.mb-menu').removeClass('open');
            $('.touchable-overlay').addClass('d-none');
        }
    });
    $('.touchable-overlay').click(function () {
        $('.burger-menu-btn').removeClass('menu-open').addClass('menu-closed');
        $('.mb-menu').removeClass('open');
        $(this).addClass('d-none');
    });
    $('.my-dropdown').click(function (e) {
        if ($(this).hasClass('show')) {
            $(this).children('.my-dropdown-menu').removeClass('open');
            $(this).removeClass('show');
            e.stopPropagation();
        } else if ($(this).hasClass('closed')) {
            $(this).children('.my-dropdown-menu').addClass('open');
            $(this).addClass('show');
            e.stopPropagation();
        }
    });
    $('.notification-btn').click(function (e) {
        if ($(this).parents('.nav-item').children('.notification-list').hasClass('hidden')) {
            $('.user-nav-dropdown').removeClass('shown').addClass('hidden');
            $('.toggle-nav-btn').removeClass('open');
            e.stopPropagation();
        }
        $(this).parents('.nav-item').children('.notification-list').toggleClass('shown hidden');
        $(this).toggleClass('open');
        e.stopPropagation();
    });
    $('.user-btn').click(function (e) {
        if ($(this).parents('.nav-item').children('.user-menu').hasClass('hidden')) {
            $('.user-nav-dropdown').removeClass('shown').addClass('hidden');
            $('.toggle-nav-btn').removeClass('open');
            e.stopPropagation();
        }
        $(this).parents('.nav-item').children('.user-menu').toggleClass('shown hidden');
        $(this).toggleClass('open');
        e.stopPropagation();
    });
    $(document.body).click(function() {
        $('.user-nav-dropdown').removeClass('shown').addClass('hidden');
        $('.toggle-nav-btn').removeClass('open');
    });
    $('.user-nav-dropdown').click(function(e) {
        e.stopPropagation();
    });
}

//--------------------------//
// END NAVIGATION
//--------------------------//



//--------------------------//
// START AUTH
//--------------------------//

function authentication() {
    $('#forgot_password').click(function () {
        $('#login_part').addClass('d-none');
        $('#forgot_part').removeClass('d-none');
    });
    $('#back-to-login').click(function () {
        $('#forgot_part').addClass('d-none');
        $('#login_part').removeClass('d-none');
    });
    $('.show-hide-password').click(function () {
        const input = $(this).parents('.form-group').find('input');
        if (input.attr('type') == 'password') {
            input.attr('type', 'text');
        } else if (input.attr('type') == 'text') {
            input.attr('type', 'password');
        }
    });
}

//--------------------------//
// END AUTH
//--------------------------//



//--------------------------//
// START FORMS & VALIDATION
//--------------------------//

function resetValidationMsg(input) {
    input.parents('.form-group').children('.validationMsg').text('');
}

$('.form-group input').keyup(function () {
    const input = $(this);
    resetValidationMsg(input);
});
$('.form-group input[type="date"]').change(function () {
    const input = $(this);
    resetValidationMsg(input);
});
$('.form-group textarea').keyup(function () {
    const input = $(this);
    resetValidationMsg(input);
});
$('.form-group input').change(function () {
    const input = $(this);
    resetValidationMsg(input);
});

function validateSubmit(e, button, emptyMsg, emailMsg, mobileMsg, passwordStrengthMsg) {
    // const passwordStrengthRegex = /((?=.*d)(?=.*[a-z])(?=.*[A-Z]).{8,15})/gm;
    // const localEgyptPhoneNumberRegex = /[01]+[0-9-()+]{9}/;
    const emailRegex = /^[A-z0-9._%+-]+@[A-z0-9.-]+.[A-z]{2,4}$/g;
    const inputs = button.parents('form').find('.form-group input');
    if (button.parents('form').find('.form-group textarea[required]').length) {
        inputs.push(button.parents('form').find('.form-group textarea[required]'));
    }
    if (button.parents('form').find('.form-group select').length) {
        inputs.push(button.parents('form').find('.form-group select'));
    }
    inputs.each(function () {
        $(this).removeClass('not-valid');
        $(this).parents('.form-group').children('.validationMsg').text('');
        if (!$(this).val().length > 0) {
            $(this).parents('.form-group').children('.validationMsg')
                .addClass('red').removeClass('green').text(emptyMsg);
            e.preventDefault();
            $(this).addClass('not-valid');
        }
        // if ($(this).attr('type') == 'password' && $(this).val().length > 0) {
        //     if (!passwordStrengthRegex.test($(this).val())) {
        //         $(this).parents('.form-group').children('.validationMsg')
        //         .addClass('red').removeClass('green').text(passwordStrengthMsg);
        //         e.preventDefault();
        //         $(this).addClass('not-valid');
        //     }
        // }
        if ($(this).hasClass('email') && $(this).val().length > 0) {
            if (!emailRegex.test($(this).val())) {
                $(this).parents('.form-group').children('.validationMsg')
                .addClass('red').removeClass('green').text(emailMsg);
                e.preventDefault();
                $(this).addClass('not-valid');
            }
        }
        // if ($(this).hasClass('mobile') && $(this).val().length > 0) {
        //     if (!localEgyptPhoneNumberRegex.test($(this).val())) {
        //         $(this).parents('.form-group').children('.validationMsg')
        //         .addClass('red').removeClass('green').text(mobileMsg);
        //         e.preventDefault();
        //         $(this).addClass('not-valid');
        //     }
        // }
    });
}
$('.valid-submit').click(function (e) {
    const button = $(this);
    validateSubmit(e, button, 'Please fill this field!', 'Please enter a valid email address!');
});

function confirmPassword(pass1, pass2, msg) {
    if (pass2.val() == '') {
        msg.text('').css('color', '');
    } else if (pass1.val() == '') {
        msg.text('Password field is empty').css('color', '');
    } else if (pass1.val() != pass2.val()) {
        msg.text('Passwords do not match!').css('color', '');
    } else if (pass1.val() === pass2.val()) {
        msg.text('Passwords Match').css('color', 'green');
    }
}
$('#repPass2, #repPass1').keyup(function () {
    const pass1 = $('#repPass1');
    const pass2 = $('#repPass2');
    const msg = pass2.siblings('.confirmationMsg');
    confirmPassword(pass1, pass2, msg);
});

//--------------------------//
// END FORMS & VALIDATION
//--------------------------//



//--------------------------//
// START EXPLORE SIDE MENU
//--------------------------//

function exploreMenu() {
    $('.explore-page .side-container').eq(0).addClass('child-nav-open open').find('.nav-link').eq(0).addClass('active');
    $('.explore-page .side-container').eq(0).children('.side-sub-menu').addClass('shown');
    $('.explore-page .side-container').eq(0).children('.side-menu-toggle').addClass('open');
    $('.explore-page .tab-pane').eq(0).addClass('active show');
    $('.side-menu-toggle').click(function () {
        $(this).toggleClass('open').parents('.side-container').toggleClass('open').children('.side-sub-menu').toggleClass('shown');
        $(this).parents('.side-container').siblings('.side-container').removeClass('open').children('.side-sub-menu').removeClass('shown');
        $(this).parents('.side-container').siblings('.side-container').children('.side-menu-toggle').removeClass('open');
    });
    $('.sidebar .nav-link').click(function () {
        $(this).parents('.sidebar').find('.nav-link').removeClass('active');
        $(this).parents('.side-container').addClass('child-nav-open').siblings('.side-container').removeClass('child-nav-open');
    });
}

//--------------------------//
// END EXPLORE SIDE MENU
//--------------------------//



//--------------------------//
// START ABOUT
//--------------------------//

function aboutxeno() {
    $('.about-page .nav-link').eq(0).addClass('active');
    $('.about-page .tab-pane').eq(0).addClass('active show');
}

//--------------------------//
// END ABOUT
//--------------------------//



//--------------------------//
// START USER PROFILE
//--------------------------//

function userProfile() {
    $('.user-profile-page .nav-link[role="tab"]').eq(0).addClass('active');
    $('.user-profile-page .tab-pane').eq(0).addClass('active show');
    $('.new_password_btn').click(function () {
        if ($('.new-password-fields').hasClass('d-none')) {
            const currentPassword = $(this).siblings('input[type="password"]').val();
            const userID = $(this).parents('.page-content').find('input[name="user_id"]').val();
            // Ajax function
            const url ='/check-password' ;
            const _token = $('input[name="_token"]').val();
            const current_password = currentPassword;
            const user_id = userID;
            $.ajax({
                headers: { 
                    "X-CSRF-TOKEN" : _token
                },
                type: 'POST',
                url: url,
                data: { 
                    current_password : current_password,
                    user_id : user_id
                },
                success: function (data) {
                    if(data == 'same') {
                        $('.new-password-fields').removeClass('d-none');
                    } else if (data == 'different') {
                        $('.current-password-valid').removeClass('d-none');
                        setTimeout(function () {
                            $('.current-password-valid').addClass('d-none');
                        }, 5000);
                        // $(this).parents('.form-group').find('.validationMsg').addClass('red').text('Please enter the correct current password!');
                    }
                },
                error: function (data) {
                    
                }
            });
        } else {
            $('.new-password-fields').addClass('d-none');
            $('.new-password-fields').find('input[type="password"]').val('');
        }
    });
    function inputFileName(input, file) {
        if (Boolean(file)) {
            input.siblings('.input-placeholder').text(file.name);
        } else {
            input.siblings('.input-placeholder').text(input.attr('placeholder'));
        }
    }
    $('.user-profile-page #userImage_uploadFile').change(function () {
        const file = $(this).prop('files')[0];
        const input = $(this);
        inputFileName(input, file);
    });
    function showPassword(button, input) {
        if (input.attr('type') == 'password') {
            input.attr('type', 'text');
        } else if (input.attr('type') == 'text') {
            input.attr('type', 'password');
        }
        button.children('span').toggleClass('d-none');
    }
    $('.showPassword').click(function () {
        showPassword($(this), $(this).siblings('input'));
    });
}

//--------------------------//
// END USER PROFILE
//--------------------------//



//--------------------------//
// START AUTHOR DASHBOARD
//--------------------------//

function authorDashboard() {
    $('.author-dashboard-page .nav-link').eq(0).addClass('active');
    $('.author-dashboard-page .tab-pane').eq(0).addClass('active show');
    $('.article-options-btn').click(function () {
        let dis = $(this).parents('.article-options');
        $('.article-options').not(dis).find('.article-dropdown').addClass('d-none');
        $(this).parents('.article-options').find('.article-dropdown').toggleClass('d-none');
    });
    $(document.body).click(function() {
        $('.article-options .article-dropdown').addClass('d-none');
    });
    $('.article-options').click(function(e) {
        e.stopPropagation();
    });
}

//--------------------------//
// END AUTHOR DASHBOARD
//--------------------------//



//--------------------------//
// START REMOVE ALERT
//--------------------------//

function removeAlert() {
    setTimeout(function () {
        $('.alert').addClass('d-none');
    }, 2000);
}

//--------------------------//
// END REMOVE ALERT
//--------------------------//



//--------------------------//
// START PUBLISH YOUR ARTICLE
//--------------------------//

function publishYourArticle() {
    function navigateBetweenSteps() {
        /*just for development*/
        // $('#step_2_form').addClass('d-none');
        // $('#step_3_form').removeClass('d-none');
        // $('#line-2').removeClass('line-o');
        // $('#step-3').removeClass('step-o');
        // $('#step-2').children('.circle').html('<i class="fas fa-check"></i>');
        // $('#step_2_buttons').addClass('d-none');
        // $('#step_3_buttons').removeClass('d-none');
        /*end*/
        $('#toStep3').click(function () {
            $('#step_2_form').addClass('d-none');
            $('#step_3_form').removeClass('d-none');
            $('#line-2').removeClass('line-o');
            $('#step-3').removeClass('step-o');
            $('#step-2').children('.circle').html('<i class="fas fa-check"></i>');
            $('#step_2_buttons').addClass('d-none');
            $('#step_3_buttons').removeClass('d-none');
            secondformCounter();
        });
        $('#toStep2').click(function () {
            $('#step_3_form').addClass('d-none');
            $('#step_2_form').removeClass('d-none');
            $('#line-2').addClass('line-o');
            $('#step-3').addClass('step-o');
            $('#step-2').children('.circle').html('2');
            $('#step_2_buttons').removeClass('d-none');
            $('#step_3_buttons').addClass('d-none');
        });
    }
    navigateBetweenSteps();
    function validateRichTextEditor(editor) {
        console.log(editor);
        if (editor.summernote('isEmpty')) {
            editor.removeClass('valid');
        } else {
            editor.addClass('valid');
        }
    }
    $('.summernote').on('summernote.keyup', function(contents, e) {
        const editor = $(this);
        console.log(editor);
        console.log(contents);
        validateRichTextEditor(editor);
    });
    $('.summernote').summernote({
        callbacks: {
            onChange: function(contents, $editable) {
                console.log('onChange:', contents, $editable);
            }
        }
    });
    function validatePublishInput(input) {
        if (input.val() == '') {
            input.removeClass('valid');
        } else if (input.hasClass('select')) {
            if (input.find('option[value=""]').prop('selected')) {
                input.removeClass('valid');
            }
        } else {
            input.addClass('valid');
        }
    }
    function validateAddAuthorData(data) {
        for (let i = 0; i < data.length; i++) {
            if (data.eq(i).val() == "") {
                data.eq(i).addClass('not-valid');
            } else {
                data.eq(i).removeClass('not-valid');
            }
        }
    }
    

    // ENABLE NEXT ITEM IF THIS ONE IS VALID
    function enableInputs(step_id,input,index) {
        // first: validate the input
        validatePublishInput(input);
        // then: store the new count of valid inputs to update the counter
        const numberOfValid = $('.item input.enable.valid').length;
        // check if the input is valid or not
        if (input.hasClass('valid')) {
            // IF VALID: remove .disabled from the next item .form-group and enable its input
            $('.item-'+step_id).eq(index).children('.form-group').removeClass('disabled').children('input.enable').prop('disabled', false);

            // **for if this is not the last item, enable all items with valid inputs
            for (let i = 0; i < $('.item input.enable.valid').length; i++) {
                // if the input is valid enable this item
                $('.item input.enable.valid').eq(i).prop('disabled', false).parents('.form-group').removeClass('disabled');
                // when you reach the last valid item, enable the following item
                if (i == $('.item input.enable.valid').length - 1) {
                    $('.item input.enable').eq(i+1).prop('disabled', false).parents('.form-group').removeClass('disabled');
                }
            }
            // update the counter
            if (numberOfValid < $('.item-'+step_id).length) {
                input.parents('.single-form-step').find('.formCounter').children('.complete').text(numberOfValid + 1);
            } else {
                input.parents('.single-form-step').find('.formCounter').children('.complete').text($('.item-'+step_id).length);
            }
        } else {
            // IF NOT VALID: add .disabled to .form-group of all the following items and disable their inputs
            for (let i = index; i < $('.item-'+step_id).length; i++) {
                $('.item-'+step_id).eq(i).children('.form-group').addClass('disabled').children('input.enable').prop('disabled', true);
                input.parents('.single-form-step').find('.formCounter').children('.complete').text(index);
            }
        }
    }
    $('.item input.enable').keyup(function () {
        const input = $(this);
        const item = input.parents('.item');
        const step_id = input.parents('.single-form-step').find('input[name="step_id"]').val();
        const index = $('.item-'+step_id).index(item) + 1;
        enableInputs(step_id,input,index);
        let bool = true;
        for (let i = 0; i < $('.item input.enable').length; i++) {
            if (!$('.item input.enable').eq(i).hasClass('valid')) {
                bool = false;
            }
        }
        if (bool) {
            $('.button-container-'+step_id+' .action-btn').prop('disabled', false);
        } else {
            $('.button-container-'+step_id+' .action-btn').prop('disabled', true);
        }
    });

    // check valid items on load
    function checkOnLoad() {
        const inputs = $('.single-form-step .item .enable');
        for (let i = 0; i < inputs.length; i++) {
            const input = inputs.eq(i);
            const item = input.parents('.item');
            const step_id = input.parents('.single-form-step').find('input[name="step_id"]').val();
            if (step_id == 3) {
                return;
            }
            const index = $('.item-'+step_id).index(item) + 1;
            enableInputs(step_id,input,index);
            let bool = true;
            for (let i = 0; i < $('.item input.enable').length; i++) {
                if (!$('.item input.enable').eq(i).hasClass('valid')) {
                    bool = false;
                }
            }
            if (bool) {
                $('.button-container-'+step_id+' .action-btn').prop('disabled', false);
            } else {
                $('.button-container-'+step_id+' .action-btn').prop('disabled', true);
            }
        }
    }
    checkOnLoad();





    // THE THIRD STEP HANDLER //
    function enableArticleContent(input,step_id,index) {
        // a function to handle the submit button 
        function submitButtonHandler() {
            let bool = true;
            for (let i = 0; i < $('.item-'+step_id).length; i++) {
                if ($('.item-'+step_id).eq(i).children('.form-group').hasClass('disabled')) {
                    bool = false;
                }
            }
            $('.button-container-'+step_id+' .action-btn').prop('disabled', !bool);
        }
        // a function to enable the next item
        function enableNext() {
            // --> if the item contains an input
            if ($('.item-'+step_id).eq(index).find('input.enable-next')) {
                $('.item-'+step_id).eq(index).children('.form-group').removeClass('disabled').children('input.enable-next').prop('disabled', false);
            }
            // --> if the item contains a select
            if ($('.item-'+step_id).eq(index).find('select.enable')) {
                $('.item-'+step_id).eq(index).children('.form-group').removeClass('disabled').find('select.enable').prop('disabled', false);
                $('.selectpicker.enable').selectpicker('refresh');
            }
            // --> if the item is the article content item
            if ($('.item-'+step_id).eq(index).hasClass('article-content-item')) {
                $('.item-'+step_id).eq(index).children('.form-group').removeClass('disabled');
                $('.item-'+step_id).eq(index).children('.form-group').find('textarea.enable-text').prop('disabled', false);
                $('.item-'+step_id).eq(index).children('.form-group').find('span.rich-disable').removeClass('disable');
                $('.item-'+step_id).eq(index).children('.form-group').find('input.enable-content').prop('disabled', false);
            }
        }
        // a function to disable the following items
        function disableNext() {
            for (let i = index; i < $('.item-'+step_id).length; i++) {
                if ($('.item-'+step_id).eq(i).find('input.enable-next')) {
                    $('.item-'+step_id).eq(i).children('.form-group').addClass('disabled').children('input.enable-next').prop('disabled', true);
                }
                if ($('.item-'+step_id).eq(i).find('select.enable')) {
                    $('.item-'+step_id).eq(i).children('.form-group').addClass('disabled').find('select.enable').prop('disabled', true);
                    //.children('option').eq(0).prop('selected', true)
                    $('.selectpicker.enable').selectpicker('refresh');
                }
                if ($('.item-'+step_id).eq(i).hasClass('article-content-item')) {
                    $('.item-'+step_id).eq(i).children('.form-group').addClass('disabled');
                    $('.item-'+step_id).eq(i).children('.form-group').find('textarea.enable-text').prop('disabled', true);
                    $('.item-'+step_id).eq(i).children('.form-group').find('span.rich-disable').addClass('disable');
                    $('.item-'+step_id).eq(i).children('.form-group').find('input.enable-content').prop('disabled', true);
                }
            }
        }
        function secondformCounter() {
            const counter = $('.formCounter-'+step_id).children('.complete');
            let count = 0;
            for (let i = 0; i < $('.item-'+step_id+'>.form-group').length; i++) {
                if (!$('.item-'+step_id+'>.form-group').eq(i).hasClass('disabled')) {
                    count += 1;
                }
            }
            counter.text(count)
        }
        if (input.hasClass('input')) {
            validatePublishInput(input);
            // const numberOfValid = $('.item input.enable.valid').length;
            if (input.hasClass('valid')) {
                enableNext();
                secondformCounter();
                submitButtonHandler();
            } else {
                for (let i = index; i < $('.item-'+step_id).length; i++) {
                    $('.item-'+step_id).eq(i).children('.form-group').addClass('disabled').children('input.enable-next').prop('disabled', true);
                    if ($('.item-'+step_id).eq(i).hasClass('article-content-item')) {
                        $('.item-'+step_id).eq(i).children('.form-group').addClass('disabled');
                        $('.item-'+step_id).eq(i).children('.form-group').find('textarea.enable-text').prop('disabled', true);
                        $('.item-'+step_id).eq(i).children('.form-group').find('span.rich-disable').addClass('disable');
                        $('.item-'+step_id).eq(i).children('.form-group').find('input.enable-content').prop('disabled', true);
                    }
                    // input.parents('.single-form-step').find('.formCounter').children('.complete').text(index);
                }
                secondformCounter();
                submitButtonHandler();
            }
        } else if (input.hasClass('btn-skip')) {
            enableNext();
            const itemsToLoop = $('.item-'+step_id).find('.enable-next.valid');
            for (let i = 0; i < itemsToLoop.length; i++) {
                if ($('.item-'+step_id).eq(i).find('input.enable-next')) {
                    $('.item-'+step_id).eq(i).children('.form-group').removeClass('disabled').children('input.enable-next').prop('disabled', false);
                }
                if ($('.item-'+step_id).eq(i).find('select.enable')) {
                    $('.item-'+step_id).eq(i).children('.form-group').removeClass('disabled').find('select.enable').prop('disabled', false);
                    $('.selectpicker.enable').selectpicker('refresh');
                }
                if ($('.item-'+step_id).eq(i).hasClass('article-content-item')) {
                    $('.item-'+step_id).eq(i).children('.form-group').removeClass('disabled');
                    $('.item-'+step_id).eq(i).children('.form-group').find('textarea.enable-text').prop('disabled', false);
                    $('.item-'+step_id).eq(i).children('.form-group').find('span.rich-disable').removeClass('disable');
                    $('.item-'+step_id).eq(i).children('.form-group').find('input.enable-content').prop('disabled', false);
                }
                if (i == itemsToLoop.length - 1) {
                    if ($('.item-'+step_id).eq(i+1).find('input.enable-next')) {
                        $('.item-'+step_id).eq(i+1).children('.form-group').removeClass('disabled').children('input.enable-next').prop('disabled', false);
                    }
                    if ($('.item-'+step_id).eq(i+1).find('select.enable')) {
                        $('.item-'+step_id).eq(i+1).children('.form-group').removeClass('disabled').find('select.enable').prop('disabled', false);
                        $('.selectpicker.enable').selectpicker('refresh');
                    }
                    if ($('.item-'+step_id).eq(i+1).hasClass('article-content-item')) {
                        $('.item-'+step_id).eq(i+1).children('.form-group').removeClass('disabled');
                        $('.item-'+step_id).eq(i+1).children('.form-group').find('textarea.enable-text').prop('disabled', false);
                        $('.item-'+step_id).eq(i+1).children('.form-group').find('span.rich-disable').removeClass('disable');
                        $('.item-'+step_id).eq(i+1).children('.form-group').find('input.enable-content').prop('disabled', false);
                    }
                }
            }
            secondformCounter();
            const allAuthors = input.parents('.single-form-step').find('.single-author');
            for (let i = allAuthors.length - 1; i > 0; i--) {
                allAuthors.eq(i).remove();
            }
            input.parents('.single-form-step').find('.single-author').addClass('d-none');
            input.parents('.single-form-step').find('.buttons').children('.btn-primary, .btn-secondary').addClass('d-none');
            input.removeClass('enable-next').addClass('add-authors-btn').text('Add Authors');
            $('.add-authors-btn').click(function () {
                $(this).parents('.single-form-step').find('.single-author').removeClass('d-none');
                $(this).parents('.single-form-step').find('.buttons').children('.save-authors, .add-another-author').removeClass('d-none');
                $(this).addClass('enable-next').removeClass('add-authors-btn').text('Skip');
                disableNext();
                secondformCounter();
                $('.enable-next.btn').click(function () {
                    const inputN = $(this);
                    const itemN = inputN.parents('.item');
                    const step_idN = inputN.parents('.single-form-step').find('input[name="step_id"]').val();
                    const indexN = $('.item-'+step_idN).index(itemN) + 1;
                    enableArticleContent(inputN,step_idN,indexN);
                });
            });
            submitButtonHandler();
        } else if (input.hasClass('save-authors')) {
            const authorData = input.parents('.single-form-step').find('.authors').find('.add-author');
            validateAddAuthorData(authorData);
            if (input.parents('.addAuthor').find('.add-author.not-valid').length > 0) {
                input.parents('.addAuthor').find('.vMsg').text('Please fill all the fields!');
                input.parents('.single-form-step').find('.authors').find('.add-author').keyup(function () {
                    input.parents('.addAuthor').find('.vMsg').text('');
                });
            } else {
                enableNext();
                const itemsToLoop = $('.item-'+step_id).find('.enable-next.valid');
                for (let i = 0; i < itemsToLoop.length; i++) {
                    if ($('.item-'+step_id).eq(i).find('input.enable-next')) {
                        $('.item-'+step_id).eq(i).children('.form-group').removeClass('disabled').children('input.enable-next').prop('disabled', false);
                    }
                    if ($('.item-'+step_id).eq(i).find('select.enable')) {
                        $('.item-'+step_id).eq(i).children('.form-group').removeClass('disabled').find('select.enable').prop('disabled', false);
                        $('.selectpicker.enable').selectpicker('refresh');
                    }
                    if ($('.item-'+step_id).eq(i).hasClass('article-content-item')) {
                        $('.item-'+step_id).eq(i).children('.form-group').removeClass('disabled');
                        $('.item-'+step_id).eq(i).children('.form-group').find('textarea.enable-text').prop('disabled', false);
                        $('.item-'+step_id).eq(i).children('.form-group').find('span.rich-disable').removeClass('disable');
                        $('.item-'+step_id).eq(i).children('.form-group').find('input.enable-content').prop('disabled', false);
                    }
                    if (i == itemsToLoop.length - 1) {
                        if ($('.item-'+step_id).eq(i+1).find('input.enable-next')) {
                            $('.item-'+step_id).eq(i+1).children('.form-group').removeClass('disabled').children('input.enable-next').prop('disabled', false);
                        }
                        if ($('.item-'+step_id).eq(i+1).find('select.enable')) {
                            $('.item-'+step_id).eq(i+1).children('.form-group').removeClass('disabled').find('select.enable').prop('disabled', false);
                            $('.selectpicker.enable').selectpicker('refresh');
                        }
                        if ($('.item-'+step_id).eq(i+1).hasClass('article-content-item')) {
                            $('.item-'+step_id).eq(i+1).children('.form-group').removeClass('disabled');
                            $('.item-'+step_id).eq(i+1).children('.form-group').find('textarea.enable-text').prop('disabled', false);
                            $('.item-'+step_id).eq(i+1).children('.form-group').find('span.rich-disable').removeClass('disable');
                            $('.item-'+step_id).eq(i+1).children('.form-group').find('input.enable-content').prop('disabled', false);
                        }
                    }
                }
                secondformCounter();
                input.parents('.addAuthor').find('.vMsg').text('');
                input.parents('.addAuthor').find('.single-author').each(function () {
                    $(this).find('.single-author-row').text($(this).find('.add-author').eq(0).val());
                });
                input.parents('.addAuthor').find('.single-author-row').addClass('saved');
                input.parents('.addAuthor').find('.single-author-inputs').addClass('saved');
                input.addClass('d-none').siblings('.btn').addClass('d-none');
                input.siblings('.edit-authors').removeClass('d-none');
                $('.edit-authors').click(function () {
                    disableNext();
                    $(this).parents('.addAuthor').find('.single-author-row').removeClass('saved');
                    $(this).parents('.addAuthor').find('.single-author-inputs').removeClass('saved');
                    $(this).siblings('.btn').removeClass('d-none');
                    const allAuthors = $(this).parents('.addAuthor').find('.single-author');
                    if (allAuthors.length <= 1) {
                        $(this).siblings('.remove-author').addClass('d-none');
                    }
                    $(this).addClass('d-none');
                    secondformCounter();
                });
            }
            submitButtonHandler();
        } else {
            validatePublishInput(input);
            enableNext();
            secondformCounter();
            submitButtonHandler();
        }
    }
    function secondformCounter() {
        const counter = $('.formCounter-3').children('.complete');
        let count = 0;
        for (let i = 0; i < $('.item-3'+'>.form-group').length; i++) {
            if (!$('.item-3>.form-group').eq(i).hasClass('disabled')) {
                count += 1;
            }
        }
        counter.text(count)
    }
    $('.enable-next.select').change(function () {
        const input = $(this);
        const item = input.parents('.item');
        const step_id = input.parents('.single-form-step').find('input[name="step_id"]').val();
        const index = $('.item-'+step_id).index(item) + 1;
        enableArticleContent(input,step_id,index);
    });
    $('input.enable-next').keyup(function () {
        const input = $(this);
        const item = input.parents('.item');
        const step_id = input.parents('.single-form-step').find('input[name="step_id"]').val();
        const index = $('.item-'+step_id).index(item) + 1;
        enableArticleContent(input,step_id,index);
    });
    $('.enable-next.btn').click(function () {
        const input = $(this);
        const item = input.parents('.item');
        const step_id = input.parents('.single-form-step').find('input[name="step_id"]').val();
        const index = $('.item-'+step_id).index(item) + 1;
        enableArticleContent(input,step_id,index);
    });
    $('.add-another-author').click(function () {
        const anotherAuthor = $(this).parents('.single-form-step').find('.single-author').eq(0).clone();
        anotherAuthor.find('input[type="text"]').val('');
        $(this).parents('.single-form-step').find('.authors').append(anotherAuthor);
        $('.remove-author').removeClass('d-none');
        secondformCounter();
    });
    $('.remove-author').click(function () {
        let allAuthors = $(this).parents('.single-form-step').find('.single-author');
        allAuthors.eq(allAuthors.length - 1).remove();
        allAuthors = $(this).parents('.single-form-step').find('.single-author');
        if (allAuthors.length <= 1) {
            $(this).addClass('d-none');
        }
        secondformCounter();
    });


    // COUNTER STYLE
    // keep counter in view on scroll
    function keepCounterInView(scrollTop,ele,stopper,min) {
        const offsetTop = ele.offset().top;
        const max = stopper.offset().top - 100;
        if (scrollTop + 90 > offsetTop && scrollTop + 90 < max - 20) {
            ele.offset({top: scrollTop + 90});
        } else if (scrollTop + 90 > max - 20) {
            ele.offset({top: max - 10});
        } else if (offsetTop > min) {
            if (scrollTop + 90 >= min) {
                ele.offset({top: scrollTop + 90});
            } else {
                ele.offset({top: min});
            }
        }
    }
    $(window).scroll(function () {
        const scrollTop = $(this).scrollTop();
        for (let i = 0; i < $('.formCounter').length; i++) {
            const step_id = $('.formCounter').eq(i).parents('.single-form-step').find('input[name="step_id"]').val();
            const ele = $('.formCounter-'+step_id);
            const stopper = $('.button-container-'+step_id);
            keepCounterInView(scrollTop,ele,stopper,300);
        }
    });

    // UPLOAD FILE PLACEHOLDER
    function inputFileName(input, file) {
        console.log(file);
        if (Boolean(file)) {
            input.siblings('.input-placeholder').text(file.name);
        } else {
            input.siblings('.input-placeholder').text(input.attr('placeholder'));
        }
    }
    $('.file-upload input[type="file"]').change(function () {
        const file = $(this).prop('files')[0];
        const input = $(this);
        inputFileName(input, file);
    });
}

//--------------------------//
// END PUBLISH YOUR ARTICLE
//--------------------------//



//--------------------------//
// START ARTICLE PAGE
//--------------------------//

function articlePage() {
    function stickySidebar() {
        if ($('.article-page .sidebar').length > 0) {
            const navbar = $('.main-navbar').outerHeight();
            const articleHeader = $('.article-page .article-page-title').outerHeight();
            const articleAuthor = $('.article-page .article-date-author').outerHeight();
            const top = navbar + articleHeader + articleAuthor;
            const bottom = $('footer').outerHeight();
            $('.article-page .sidebar').sticky({
                topSpacing: top,
                bottomSpacing: bottom
            });
        }
    }
    function scrollArticle() {
        const sections = $('div[data-role="scroll-section"]');
        const navbar = $('.main-navbar').outerHeight();
        const articleHeader = $('.article-page .article-page-title').outerHeight();
        const articleAuthor = $('.article-page .article-date-author').outerHeight();
        const top = navbar + articleHeader + articleAuthor;
        let totalHeight = 0;
        let progress;
        let progressPercentage = 5;
        for (let i = 0; i < sections.length; i++) {
            totalHeight += sections.eq(i).outerHeight();
        }
        $(window).scroll(function () {
            // SIDEBAR PART
            for (let i = 0; i < sections.length; i++) {
                const start = sections.eq(i).offset().top - top - 20;
                const end = sections.eq(i).offset().top + sections.eq(i).outerHeight() - top - 20;
                if ($(window).scrollTop() >= start && $(window).scrollTop() <= end) {
                    $('.nav-tab').removeClass('active');
                    $('.nav-tab[data-represents="#'+sections.eq(i).attr('id')+'"]').addClass('active');
                }
            }
            // PROGRESS BAR PART
            progress = $(window).scrollTop() + top/2;
            progressPercentage = progress / totalHeight * 100;
            $('.progress-bar#article_progress_bar').css('width', progressPercentage+'%');
        });
        function scrollToSection(button) {
            const section = $(button.attr('data-represents'));
            const target = section.offset().top - top;
            if ($(window).scrollTop() < target) {
                let i = $(window).scrollTop() + 1;
                let interval = setInterval(function () {
                    $(window).scrollTop(i);
                    i += 3;
                    if ($(window).scrollTop() >= target) {
                        clearInterval(interval);
                    }
                }, .5);
            } else if ($(window).scrollTop() > target) {
                let i = $(window).scrollTop() - 1;
                let interval = setInterval(function () {
                    $(window).scrollTop(i);
                    i -= 3;
                    if ($(window).scrollTop() <= target) {
                        clearInterval(interval);
                    }
                }, .5);
            }
        }
        $('.article-page .sidebar .nav-tab').click(function () {
            const button = $(this);
            scrollToSection(button);
        })
    }
    stickySidebar();
    scrollArticle();
}

//--------------------------//
// END ARTICLE PAGE
//--------------------------//



//--------------------------//
// START SUMMERNOTE WITH PLACEHOLDER
//--------------------------//

function initSummernoteWithPlaceholders() {
    for (let i = 0; i < $('.summernote').length; i++) {
        const placeholder = $('.summernote').eq(i).attr('placeholder');
        $('.summernote').eq(i).summernote({
            placeholder: placeholder,
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['paragraph']],
                ['height', ['height']]
            ]
        });
    }
}

//--------------------------//
// END SUMMERNOTE WITH PLACEHOLDER
//--------------------------//



//--------------------------//
// START MAP
//--------------------------//

function initMap () {
    if ($("#leafletMap").length) {
        let myMap = L.map("leafletMap").setView([30.059824, 31.44479], 15);
    
        L.tileLayer(
        "https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}",
        {
            attribution:
            'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: "mapbox.streets",
            accessToken:
            "pk.eyJ1IjoiYWhhc3Nhbm0iLCJhIjoiY2pvc29qenIzMHFiaDNrbGtxM3AwOWhkeiJ9.000445dHQOyJTdlONx0NIQ"
        }
        ).addTo(myMap);
    
        const marker = L.marker([30.059824, 31.44479]).addTo(myMap);
    }
}

//--------------------------//
// END MAP
//--------------------------//
    


//--------------------------//
// START UNAUTHORIZED
//--------------------------//
    
function unauthorizedFn() {
    if ($(location).attr("href").includes('#unauthorized')) {
        $('#registrationModal').modal('show');
    }
}

//--------------------------//
// END UNAUTHORIZED
//--------------------------//
    


//--------------------------//
// START ONLOAD
//--------------------------//

$(document).ready(function () {

    $('.selectpicker').selectpicker();

    initSummernoteWithPlaceholders();

    navigation();

    authentication();

    exploreMenu();

    aboutxeno();

    userProfile();

    authorDashboard();

    publishYourArticle();

    articlePage();

    unauthorizedFn();

    removeAlert();

    initMap();

});

//--------------------------//
// END ONLOAD
//--------------------------//