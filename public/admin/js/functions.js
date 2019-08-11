//--------------------------//
// START FORMS & VALIDATION
//--------------------------//

function resetValidationMsg(input) {
    input
        .parents(".form-group")
        .children(".validationMsg")
        .text("");
}

$(".form-group input").keyup(function() {
    const input = $(this);
    resetValidationMsg(input);
});
$('.form-group input[type="date"]').change(function() {
    const input = $(this);
    resetValidationMsg(input);
});
$(".form-group textarea").keyup(function() {
    const input = $(this);
    resetValidationMsg(input);
});
$(".form-group input").change(function() {
    const input = $(this);
    resetValidationMsg(input);
});

function validateSubmit(
    e,
    button,
    emptyMsg,
    emailMsg,
    mobileMsg,
    passwordStrengthMsg
) {
    //    const passwordStrengthRegex = /((?=.*d)(?=.*[a-z])(?=.*[A-Z]).{8,15})/gm;
    const localEgyptPhoneNumberRegex = /[01]+[0-9-()+]{9}/;
    const emailRegex = /^[A-z0-9._%+-]+@[A-z0-9.-]+.[A-z]{2,4}$/g;
    const inputs = button.parents("form").find(".form-group input");
    if (button.parents("form").find(".form-group textarea[required]").length) {
        inputs.push(
            button.parents("form").find(".form-group textarea[required]")
        );
    }
    if (button.parents("form").find(".form-group select").length) {
        inputs.push(button.parents("form").find(".form-group select"));
    }
    inputs.each(function() {
        $(this).removeClass("not-valid");
        $(this)
            .parents(".form-group")
            .children(".validationMsg")
            .text("");
            
        if (!$(this).val().length > 0) {
            $(this)
                .parents(".form-group")
                .children(".validationMsg")
                .addClass("red")
                .removeClass("green")
                .text(emptyMsg);
            e.preventDefault();
            $(this).addClass("not-valid");
        }
               if ($(this).attr('type') == 'password' && $(this).val().length > 0) {
                   if (!passwordStrengthRegex.test($(this).val())) {
                       $(this).parents('.form-group').children('.validationMsg')
                       .addClass('red').removeClass('green').text(passwordStrengthMsg);
                       e.preventDefault();
                       $(this).addClass('not-valid');
                   }
               }
        if ($(this).hasClass("email") && $(this).val().length > 0) {
            if (!emailRegex.test($(this).val())) {
                $(this)
                    .parents(".form-group")
                    .children(".validationMsg")
                    .addClass("red")
                    .removeClass("green")
                    .text(emailMsg);
                e.preventDefault();
                $(this).addClass("not-valid");
            }
        }
        if ($(this).hasClass("mobile") && $(this).val().length > 0) {
            if (!localEgyptPhoneNumberRegex.test($(this).val())) {
                $(this)
                    .parents(".form-group")
                    .children(".validationMsg")
                    .addClass("red")
                    .removeClass("green")
                    .text(mobileMsg);
                e.preventDefault();
                $(this).addClass("not-valid");
            }
        }
    });
}
$(".valid-submit").click(function(e) {
    const button = $(this);
    validateSubmit(
        e,
        button,
        "Please fill this field!",
        "Please enter a valid email address!"
    );
});
//$('form button[type="submit"]').click(function (e) {
//    const button = $(this);
//    validateSubmit(e, button, 'Please fill this field!', 'Please enter a valid email address!', 'Please enter a valid mobile number', 'The password must contain 8 to 15 characters with at least one lowercase letter, one uppercase letter and one number!');
//});

function showPassword(button) {
    button
        .parents(".form-group")
        .children('input[type="password"]')
        .attr("type", "text");
    button.addClass("d-none");
    button.siblings(".hide-password").removeClass("d-none");
}
function hidePassword(button) {
    button
        .parents(".form-group")
        .children('input[type="text"]')
        .attr("type", "password");
    button.addClass("d-none");
    button.siblings(".show-password").removeClass("d-none");
}
$(".show-password").click(function() {
    const button = $(this);
    showPassword(button);
});
$(".hide-password").click(function() {
    const button = $(this);
    hidePassword(button);
});

function confirmPassword(pass1, pass2, msg) {
    if (pass2.val() == "") {
        msg.text("").css("color", "");
    } else if (pass1.val() == "") {
        msg.text("Password field is empty").css("color", "");
    } else if (pass1.val() != pass2.val()) {
        msg.text("Passwords do not match!").css("color", "");
    } else if (pass1.val() === pass2.val()) {
        msg.text("Passwords Match").css("color", "green");
    }
}
$("#repPass2, #repPass1").keyup(function() {
    const pass1 = $("#repPass1");
    const pass2 = $("#repPass2");
    const msg = pass2.siblings(".confirmationMsg");
    confirmPassword(pass1, pass2, msg);
});

//--------------------------//
// END FORMS & VALIDATION
//--------------------------//

//--------------------------//
// START DASHBOARD NAVIGATION
//--------------------------//

function navigationBar() {
    const currentURL = $(location).attr("href");
    const navItems = $(".treeview-item");
    const links = $(".app-menu__item");
    for (let item of navItems) {
        if (currentURL.includes($(item).attr("href"))) {
            $(".treeview-item.active").removeClass("active");
            $(".app-menu__item.active").removeClass("active");
            $(item).addClass("active");
            $(item)
                .parents(".treeview")
                .addClass("is-expanded");
            $(item)
                .parents(".level-2-treeview")
                .addClass("is-expanded");
        }
    }
    for (let link of links) {
        if (currentURL.includes($(link).attr("href"))) {
            $(".treeview-item.active").removeClass("active");
            $(".app-menu__item.active").removeClass("active");
            $(link).addClass("active");
        }
    }
}

//--------------------------//
// END DASHBOARD NAVIGATION
//--------------------------//

//--------------------------//
// START DOWNLOADS
//--------------------------//

function downloadItemEdit(button) {
    button
        .parents(".download-item")
        .find("textarea, input")
        .each(function() {
            $(this)
                .removeClass("hide-text")
                .removeAttr("disabled");
        });
    button
        .parents(".download-item")
        .find(".file-name")
        .addClass("d-none");
    button.addClass("d-none");
    button
        .parents(".actions")
        .children(".save")
        .removeClass("d-none");
}
$(".download-item .action-btn.edit").click(function() {
    const button = $(this);
    downloadItemEdit(button);
});

$(".download-item .action-btn.save").click(function() {
    const button = $(this);
    downloadItemSave(button);
});

//--------------------------//
// END DOWNLOADS
//--------------------------//

//--------------------------//
// START SHOW MORE MODALS
//--------------------------//

function showVacancy(item) {
    $("#title_text").text(item.title);
    $("#v_i_text").text(item.type_job);
    $("#experience_text").text("More than " + item.experience + " years");
    $("#department_text").text(item.department);
    $("#level_text").text(item.career_level);
    $("#type_text").text(item.type_time);
    $("#short_desc_text").text(item.short_description);
    $("#desc_text").html(item.description);
}

function showApplication(item) {
    console.log(item);
    $("#name_text").text(item.name);
    $("#email_text").text(item.email);
    $("#number_text").text(item.mobile);
    $("#note_text").text(item.Note);
    $("#cv_text a").text(item.cv);
    $("#cv_text a").attr("href", "/uploads/files/" + item.cv);
    $("#current_employee_text").text(item.employee);
    $("#current_job_text").text(item.in_this_job);
    $("#know_someone_text").text(item.know_someone);
    $("#channel_text").text(item.hear_about_us);
    if (item.know_someone == "yes") {
        $("#hisName").removeClass("d-none");
        $("#know_someone_name").text(item.knowWho);
    } else if (item.know_someone == "no") {
        $("#hisName").addClass("d-none");
    }
}

//--------------------------//
// END SHOW MORE MODALS
//--------------------------//

//--------------------------//
// START EDIT IN MODALS
//--------------------------//

function editModals() {
    function editThisInModal(button) {
        button
            .parents(".item")
            .find(".can-edit")
            .addClass("d-none");
        button
            .parents(".item")
            .find(".edit-input")
            .removeClass("d-none");
        button.addClass("d-none");
        button.siblings(".save-modal-data-btn").removeClass("d-none");
    }
    $(".edit-modal-data-btn").click(function() {
        const button = $(this);
        editThisInModal(button);
    });
    function saveThisInModal(button) {
        const url ='/admin/update_journal';
        const _token = $('input[name="_token"]').val();
        const id = button.parents('.modal').find('input[name="journal_id"]').val();
        const changed = button.parents(".item").find(".edit-input");
        const name = button.parents('.modal').find('#journal_name').val();
        const count = button.parents('.modal').find('#number_volumes-edit').val();
        const description = button.parents('.modal').find('#journal_description-edit').val();
        console.log(name + ' ' + count);
        $.ajax({
           headers: { 
               "X-CSRF-TOKEN" : _token
           },
            type: 'POST',
            url: url,
            data: { 
                id: id,
                journal_name: name,
                volumes_count: count,
                desc: description
                },
            success: function (data) {
                console.log(data);
                // button.parents(".item").find(".can-edit").removeClass("d-none").text();
                // button.parents(".item").find(".edit-input").addClass("d-none");
                button.addClass("d-none");
                button.siblings(".edit-modal-data-btn").removeClass("d-none");
                window.location.href="/admin/all_journals";

           },
            error: function (data) {
                console.log('error');
            }
        });
    }
    $(".save-modal-data-btn").click(function() {
        const button = $(this);
        saveThisInModal(button);
    });
}

//--------------------------//
// END EDIT IN MODALS
//--------------------------//

//--------------------------//
// START NUMBER INPUTS
//--------------------------//

function numberInputs() {
    $(".numbers_only_input").keypress(function(e) {
        let value = $(this).val();
        if (e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });
    $(".numbers_only_input").keyup(function() {
        if ($(this).val() == "") {
            $(this).val(1);
            $(".decrease-btn").prop("disabled", true);
        } else if ($(this).val() <= 1) {
            $(this).val(1);
            $(".decrease-btn").prop("disabled", true);
        }
    });
    $(".increase-btn").click(function() {
        let input = $(this)
            .parents(".counter-btns")
            .find(".numbers_only_input");
        input.val(parseInt(input.val(), 10) + 1);
        $(".decrease-btn").prop("disabled", false);
    });
    $(".decrease-btn").click(function() {
        let input = $(this)
            .parents(".counter-btns")
            .find(".numbers_only_input");
        if (input.val() > 1) {
            input.val(parseInt(input.val(), 10) - 1);
            if (input.val() == 1) {
                $(this).prop("disabled", true);
            }
        }
    });
}

//--------------------------//
// END NUMBER INPUTS
//--------------------------//



//--------------------------//
// START REMOVE IMAGE
//--------------------------//

function removeDropifyImage() {
    $('.can_remove .dropify-clear').click(function () {
        $(this).parents('.can_remove').find('.dropify').eq(0).val(null);
        $(this).parents('.can_remove').prepend('<input type="hidden" value="delete" class="removed-image" name="' + $(this).parents('.can_remove').find('.dropify').eq(0).attr('name') + '">');
        console.log($(this).parents('.can_remove').find('.dropify').eq(0).prop('files'));
        console.log($(this).parents('.can_remove').find('.dropify').eq(0).val() == '');
        $(this).parents('.can_remove').find('.dropify').eq(0).change(function () {
            $(this).parents('.can_remove').find('.removed-image').remove();
        })
    });
    $('.can_remove_array .dropify').change(function () {
        if ($(this).parents('.can_remove_array').find('.removed-image').length == 0) {
            $(this).parents('.can_remove_array').append('<input type="hidden" name="deleted_images[]" class="removed-image" value="' + $(this).parents('.can_remove_array').find('.dropify').eq(0).attr('value') + '">');
         }
        $(this).parents('.can_remove_array').find('.dropify').eq(0).attr('name', 'new_images[]');
     });
    $('.can_remove_array .dropify-clear').click(function () {
        if ($(this).parents('.can_remove_array').find('.removed-image').length == 0) {
            $(this).parents('.can_remove_array').find('.dropify').eq(0).val(null);
            $(this).parents('.can_remove_array').append('<input type="hidden" name="deleted_images[]" class="removed-image" value="' + $(this).parents('.can_remove_array').find('.dropify').eq(0).attr('value') + '">');
            console.log($(this).parents('.can_remove_array').find('.dropify').eq(0).prop('files'));
            console.log($(this).parents('.can_remove_array').find('.dropify').eq(0).val() == '');
            $(this).parents('.can_remove_array').find('.dropify').eq(0).change(function () {
                $(this).parents('.can_remove_array').find('.dropify').eq(0).attr('name', 'new_images[]');
            });
        }
    });
}

//--------------------------//
// END REMOVE IMAGE
//--------------------------//



//--------------------------//
// START MANAGE ABOUT
//--------------------------//

function manageAbout() {
    $('.manage-about-page .nav-link').eq(0).addClass('active');
    $('.manage-about-page .tab-pane').eq(0).addClass('active show');
    function deletePage(button, id) {
        const url ='/admin/delete_about';
        const _token = $('input[name="_token"]').val();
        const page_id = id;
        $.ajax({
           headers: { 
               "X-CSRF-TOKEN" : _token
           },
            type: 'POST',
            url: url,
            data: { 
                id: page_id
            },
            success: function (data) {
                console.log(data);
                location.reload();
           },
            error: function (data) {
                console.log('error');
            }
        });
    }
    $('#confirm_delete_btn').click(function () {
        const id = $(this).parents('.modal').find('input[name="delete_page_id"]').val();
        deletePage($(this), id);
    });
    $('.delete_page_btn').click(function () {
        const id = $(this).parents('.tab-pane').find('input[name="page_id"]').val();
        $('#confirmDeleteModal').find('input[name="delete_page_id"]').val(id);
        $('#confirmDeleteModal').modal('show');
    });
    function addPage(button, modal) {
        const url ='/admin/add_about';
        const _token = $('input[name="_token"]').val();
        const title = modal.find('input[name="add_title"]').val();
        const content = modal.find('textarea[name="add_content"]').val();
        $.ajax({
           headers: { 
               "X-CSRF-TOKEN" : _token
           },
            type: 'POST',
            url: url,
            data: { 
                title: title,
                content: content
            },
            success: function (data) {
                console.log(data);
                location.reload();
           },
            error: function (data) {
                console.log('error');
            }
        });
    }
    $('#confirm_add_btn').click(function () {
        const modal = $('#addAboutModal');
        addPage($(this), modal);
    });
}

//--------------------------//
// END MANAGE ABOUT
//--------------------------//



//--------------------------//
// START JOURNALS
//--------------------------//

function manageJournals() {
    function deleteJournal(button) {
        const id = button.parents("form").find('input[name="journal_id"]').val();
        const url ='/admin/journal_delete';
        const _token = $('input[name="_token"]').val();
        const changed = [{id: id}];
        console.log(changed);
        $.ajax({
           headers: { 
               "X-CSRF-TOKEN" : _token
           },
            type: 'POST',
            url: url,
            data: { 
                changed : changed,
                apply : 'Delete'
            },
            success: function (data) {
                console.log(data);
                window.location.href="/admin/all_journals";
           },
            error: function (data) {
                console.log('error');
            }
        });
    }
    $(".delete_journal_btn").click(function() {
        const button = $(this);
        deleteJournal(button);
    });
}

//--------------------------//
// END JOURNALS
//--------------------------//



//--------------------------//
// START ARTICLES
//--------------------------//

function manageArticles() {
    function articleNavigation() {
        $(".article_to_approve").click(function() {
            $(this)
                .parents(".article_modal")
                .find("#article_body")
                .addClass("d-none");
            $(this)
                .parents(".article_modal")
                .find("#reject_step")
                .addClass("d-none");
            $(this)
                .parents(".article_modal")
                .find("#approve_step")
                .removeClass("d-none");
        });
        $(".article_to_reject").click(function() {
            $(this)
                .parents(".article_modal")
                .find("#article_body")
                .addClass("d-none");
            $(this)
                .parents(".article_modal")
                .find("#approve_step")
                .addClass("d-none");
            $(this)
                .parents(".article_modal")
                .find("#reject_step")
                .removeClass("d-none");
        });
        $(".article_to_body").click(function() {
            $(this)
                .parents(".article_modal")
                .find("#approve_step")
                .addClass("d-none");
            $(this)
                .parents(".article_modal")
                .find("#reject_step")
                .addClass("d-none");
            $(this)
                .parents(".article_modal")
                .find("#article_body")
                .removeClass("d-none");
        });
        $(".article_modal").on("hidden.bs.modal", function() {
            $(this)
                .find("#approve_step")
                .addClass("d-none");
            $(this)
                .find("#reject_step")
                .addClass("d-none");
            $(this)
                .find("#article_body")
                .removeClass("d-none");
        });
    }

    articleNavigation();
}

//--------------------------//
// END ARTICLES
//--------------------------//



//--------------------------//
// START DATA ENTRY EDIT ARTICLES
//--------------------------//

function dataEntryEditArticles() {
    function editArticle(button) {
        const modal = button.parents('.modal');
        modal.find('.editable').addClass('d-none');
        modal.find('.edit_field').removeClass('d-none');
        modal.find('.edit_field-rich').summernote({
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
        button.addClass('d-none');
        button.siblings('.modal-btn').removeClass('d-none');
    }
    function cancelEditArticle(button) {
        const modal = button.parents('.modal');
        modal.find('.edit_field').addClass('d-none');
        modal.find('.editable').removeClass('d-none');
        const richTextEditors = modal.find('.edit_field-rich');
        for (let i = 0; i < richTextEditors.length; i++) {
            richTextEditors.eq(i).summernote('destroy');
        }
        button.addClass('d-none');
        button.siblings('.save-btn').addClass('d-none');
        button.siblings('.edit-btn').removeClass('d-none');
    }
    $('#dataEntryArticleRequestModal .edit-btn').click(function (e) {
        e.preventDefault();
        const button = $(this);
        editArticle(button);
    });
    $('#dataEntryArticleRequestModal .cancel-btn').click(function (e) {
        e.preventDefault();
        const button = $(this);
        cancelEditArticle(button);
    });
    function inputFileName(input, file) {
        if (Boolean(file)) {
            input.siblings('.input-placeholder').text(file.name);
        } else {
            input.siblings('.input-placeholder').text(input.attr('placeholder'));
        }
    }
    $('.item .edit_field-file input[type="file"]').change(function () {
        const file = $(this).prop('files')[0];
        const input = $(this);
        inputFileName(input, file);
    });
    function articleStatus(select, article_id) {
        swal({
            title: "Are you sure?",
            text: "Please make sure you saved all your changes before proceeding.",
            type: "info",
            showCancelButton: true,
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Change Status",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                // Ajax function
                const url ='' ;
                const _token = $('input[name="_token"]').val();
                const status = select.val();
                const id = article_id;
                $.ajax({
                    headers: { 
                        "X-CSRF-TOKEN" : _token
                    },
                    type: 'POST',
                    url: url,
                    data: { 
                        status : status,
                        id : id
                    },
                    success: function (data) {
                        swal("Status Changed Successfully", "", "success");
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (data) {
                        console.log('error');
                        swal("Sorry, an error has occured", "Please try again!", "warning");
                    }
                });
            } else {
                swal.close();
                if (select.val() == 'To Do') {
                    select.val('In Progress');
                    select.selectpicker('render');
                } else if (select.val() == 'In Progress') {
                    select.val('To Do');
                    select.selectpicker('render');
                }
            }
        });
    }
    $('select.article_status').change(function () {
        const select = $(this);
        const article_id = $(this).parents('.modal').find('input[name="article_id"]').val();
        articleStatus(select, article_id);
    });
}

function showDataEntryArticle(article) {
    const modal = $('#dataEntryArticleRequestModal');
    //Personal Info
    $(modal).find('#affiliation_text').text(article.user.affiliation);
    $(modal).find('#article-affiliation').val(article.user.affiliation);

    $(modal).find('#degree_text').text(article.user.degree);
    $(modal).find('#article-degree').val(article.user.degree);

    $(modal).find('#firstname_text').text(article.user.first_name);
    $(modal).find('#article-firstName').val(article.user.first_name);

    $(modal).find('#correspondingAuthor_text').text(article.corresponding_author);
    $(modal).find('#article-corresponding_author').val(article.corresponding_author);

    $(modal).find('#lastname_text').text(article.user.last_name);
    $(modal).find('#article-lastName').val(article.user.last_name);

    if(article.rejection_reasons != null){
        $(modal).find('#show_note').removeClass('d-none');
        $(modal).find('#admin_notes').html(article.rejection_reasons);
    }

    //Authors Info
    const authors = article.author;
    const singleAuthor = $(modal).find('#pills-author_info').find('.single-author-wrapper').eq(0).clone();
    singleAuthor.removeClass('d-none');
    for (let i = 1; i < $(modal).find('#pills-author_info').find('.single-author-wrapper').length; i++) {
        $(modal).find('#pills-author_info').find('.single-author-wrapper').eq(i).remove();
    }
    $(modal).find('#pills-author_info').find('.single-author-wrapper').eq(0).addClass('d-none');
    authors.forEach((author , index) => {
        singleAuthor.find('.author_name').text(author.name);
        singleAuthor.find('.author_name_input').attr('name', `publish_addAuthorName${index}`).val(author.title);
        singleAuthor.find('.author_title').text(author.name);
        singleAuthor.find('.author_title_input').attr('name', `publish_addAuthorTitle${index}`).val(author.title);
        singleAuthor.find('.author_affiliation').text(author.affiliation);
        singleAuthor.find('.author_affiliation_input').attr('name', `publish_addAuthorAffiliation${index}`).val(author.affiliation);
        $(modal).find('#pills-author_info').append(singleAuthor);
    });

    //Article Info

    $(modal).find('#details_type_text').text(article.type);
    $(modal).find("#articleType").val(article.type);

    $(modal).find('#details_abstract_text').html(article.abstract);
    
    // $(modal).find("#article-abstract").summernote("code", article.abstract);
    $(modal).find("#article-abstract").val(article.abstract);

    $(modal).find('#details_keywords_text').text(article.keywords);
    $(modal).find('#article-keywords').val(article.keywords);

    $(modal).find('#details_intro_text').html(article.intro);
    // $(modal).find("#article-intro").summernote("code", article.intro);
    $(modal).find("#article-intro").val(article.intro);

    $(modal).find('#details_addInfo_text').html(article.additional_info);
    // $(modal).find("#article-additional_info").summernote("code", article.additional_info);
    $(modal).find("#article-additional_info").val(article.additional_info);

    $(modal).find('#details_reference_text').html(article.reference);
    // $(modal).find("#article-reference").summernote("code", article.reference);
    $(modal).find("#article-reference").val(article.reference);

    $(modal).find("#word_file").attr("href",`/uploads/files/${article.word_file}`);
    $(modal).find("#figure").attr("href",`/uploads/images/${article.figures}`);
    $(modal).find("#excel_sheet").attr("href",`/uploads/files/${article.excel_sheet}`);
    $(modal).find("#author_conflict").attr("href",`/uploads/files/${article.author_conflict}`);
    $(modal).find("#financial_disclosure_file").attr("href",`/uploads/files/${article.financial_disclosure_file}`);

    $(modal).find('#article-financial-text').text(article.financial_disclosure);
    $(modal).find('#financial_disclosure').val(article.financial_disclosure);

    $(modal).find('#details_ethics_text').text(article.ethics_community);
    $(modal).find('#article-ethics').val(article.ethics_community);

    $(modal).find('#article_id').val(article.id);
    $(modal).find('#rejected_article_id').val(article.id);
    
}

function showDataEntryArticleNoEdit(article) {
    const modal = $('#dataEntryFinishedArticleModal');
    //Personal Info
    $(modal).find('#affiliation_text').text(article.user.affiliation);

    $(modal).find('#degree_text').text(article.user.degree);

    $(modal).find('#firstname_text').text(article.user.first_name);

    $(modal).find('#correspondingAuthor_text').text(article.corresponding_author);

    $(modal).find('#lastname_text').text(article.user.last_name);

    //Authors Info
    const authors = article.author;
    const singleAuthor = $(modal).find('#pills-author_info').find('.single-author-wrapper').eq(0).clone();
    singleAuthor.removeClass('d-none');
    for (let i = 1; i < $(modal).find('#pills-author_info').find('.single-author-wrapper').length; i++) {
        $(modal).find('#pills-author_info').find('.single-author-wrapper').eq(i).remove();
    }
    $(modal).find('#pills-author_info').find('.single-author-wrapper').eq(0).addClass('d-none');
    authors.forEach((author , index) => {
        singleAuthor.find('.author_name').text(author.name);
        singleAuthor.find('.author_title').text(author.name);
        singleAuthor.find('.author_affiliation').text(author.affiliation);
        $(modal).find('#pills-author_info').append(singleAuthor);
    });

    //Article Info

    $(modal).find('#details_type_text').text(article.type);

    $(modal).find('#details_abstract_text').html(article.abstract);
    

    $(modal).find('#details_keywords_text').text(article.keywords);

    $(modal).find('#details_intro_text').html(article.intro);

    $(modal).find('#details_addInfo_text').html(article.additional_info);

    $(modal).find('#details_reference_text').html(article.reference);

    $(modal).find("#word_file").attr("href",`/uploads/files/${article.word_file}`);
    $(modal).find("#figure").attr("href",`/uploads/images/${article.figures}`);
    $(modal).find("#excel_sheet").attr("href",`/uploads/files/${article.excel_sheet}`);
    $(modal).find("#author_conflict").attr("href",`/uploads/files/${article.author_conflict}`);
    $(modal).find("#financial_disclosure_file").attr("href",`/uploads/files/${article.financial_disclosure_file}`);

    $(modal).find('#article-financial-text').text(article.financial_disclosure);

    $(modal).find('#details_ethics_text').text(article.ethics_community);

    $(modal).find('#article_id').val(article.id);
    $(modal).find('#rejected_article_id').val(article.id);
    
}

//--------------------------//
// END DATA ENTRY EDIT ARTICLES
//--------------------------//



//--------------------------//
// START DATATABLES
//--------------------------//

// INSERT ACTIONS LIST FUNCTION
function insertActionsList() {
    const list = $(".table-content .actions-div")
        .eq(0)
        .clone();
    $(".table-content .actions-div")
        .eq(0)
        .remove();
    list.removeClass("d-none");
    $(list).insertAfter(".dataTables_wrapper .dataTables_filter");
    $("#selectAllCheck").change(function() {
        const select = $(this);
        selectAll(select);
    });
    $(".actions-div").append($(".dt-buttons"));
}

// DataTables Defaults
$.extend($.fn.dataTable.defaults, {
    select: {
        style: "multi+shift",
        blurable: false,
        selector: "td:first-child .custom-control-label"
    },
    columnDefs: [
        {
            targets: 0,
            searchable: false,
            orderable: false
        }
    ],
    ordering: true,
    searching: true,
    dom: "lfrtip",
    language: {
        paginate: {
            previous: "&lt;",
            next: "&gt;"
        }
    }
});

// ALL TABLES ARRAY
let tables = [];

// INITIALIZE A SINGLE DATATABLE FUNCTION
function initSingleTable(tableID) {
    tables.push(
        $(tableID).DataTable({
            order: [1, "asc"]
        })
    );
    $(tableID + "_filter")
        .append('<i class="fa fa-search"></i>')
        .find("input")
        .attr("placeholder", "Search");
}

function initSingleButtonsTable(tableID) {
    tables.push(
        $(tableID).DataTable({
            order: [1, "asc"],
            dom: "Bfrtip",
            buttons: ["excelHtml5"]
        })
    );
    $(tableID + "_filter")
        .append('<i class="fa fa-search"></i>')
        .find("input")
        .attr("placeholder", "Search");
}

function initSingleButtonsDescTable(tableID) {
    tables.push(
        $(tableID).DataTable({
            order: [2, "desc"],
            dom: "Bfrtip",
            buttons: ["excelHtml5"]
        })
    );
    $(tableID + "_filter")
        .append('<i class="fa fa-search"></i>')
        .find("input")
        .attr("placeholder", "Search");
}

function initSingleNoSelectTable(tableID) {
    tables.push(
        $(tableID).DataTable({
            order: [0, "desc"],
            select: false
        })
    );
    $(tableID + "_filter")
        .append('<i class="fa fa-search"></i>')
        .find("input")
        .attr("placeholder", "Search");
}

// INITIALIZE ALL DATATABLES USING SINGLE FUNCTION
function initDataTables() {
    initSingleTable("#allJournalsTable");
    initSingleTable("#articleRequestsTable");
    initSingleTable("#allPagesTable");
    initSingleTable("#allVacanciesTable");
    initSingleButtonsTable("#partnerFormTable");
    initSingleButtonsTable("#careersFormTable");
    initSingleButtonsTable("#contactFormTable");
    initSingleButtonsDescTable("#subscribersTable");
    initSingleNoSelectTable("#allPageHeadersTable");
}

// SELECT/DESELECT ALL FUNCTION
function selectAll(select) {
    const table = select
        .parents(".dataTables_wrapper")
        .find("table.dataTable")
        .eq(0)
        .DataTable();
    if (select.prop("checked") == true) {
        table.rows().select();
        select
            .parents(".dataTables_wrapper")
            .find('input[name="select-checkbox"]')
            .each(function() {
                $(this).prop("checked", true);
            });
        select
            .parents(".custom-checkbox")
            .find("#select-all-text")
            .text("Deselect All");
    } else if (select.prop("checked") == false) {
        table.rows().deselect();
        select
            .parents(".dataTables_wrapper")
            .find('input[name="select-checkbox"]')
            .each(function() {
                $(this).prop("checked", false);
            });
        select
            .parents(".custom-checkbox")
            .find("#select-all-text")
            .text("Select All");
    }
}

// SELECT ROW BEHAVIOR FUNCTION
function selectTable() {
    for (let i = 0; i < tables.length; i++) {
        tables[i].on("select deselect", function() {
            // check if all rows are selected or not to update the select all
            if (
                tables[i]
                    .rows({
                        selected: true
                    })
                    .count() !== tables[i].rows().count()
            ) {
                $("#selectAllCheck").prop("checked", false);
                $("#select-all-text").text("Select All");
            } else {
                $("#selectAllCheck").prop("checked", true);
                $("#select-all-text").text("Deselect All");
            }

            // for certain tables disable edit option if selected rows are more than 1
            if (tables[i].rows({ selected: true }).count() == 1) {
                $("#select-options .hide-edit").prop("disabled", false);
            } else {
                $("#select-options .hide-edit").prop("disabled", true);
            }

            // disable actions if no rows are selected
            if (tables[i].rows({ selected: true }).count() == 0) {
                $("#select-options").prop("disabled", true);
            } else {
                $("#select-options").prop("disabled", false);
            }

            // update selected count
            $("#selectedCount").text(
                tables[i].rows({ selected: true }).count()
            );

            // hide roles editing from unchecked rows
            tables[i]
                .rows({ selected: false })
                .nodes()
                .to$()
                .find(".role-td .current-role")
                .removeClass("d-none");
            tables[i]
                .rows({ selected: false })
                .nodes()
                .to$()
                .find(".role-td .roles")
                .addClass("d-none");

            // reset select actions to "More"
            $("#select-options").val("0");
        });
    }
}

//--------------//
// TABLE CONTENT

// EDIT TABLE DATA WITH SELECT
function selectOptions() {
    $("#select-options").change(function() {
        if ($(this).val() == "1") {
            $(".selected .role-td .current-role").addClass("d-none");
            $(".selected .role-td .roles").removeClass("d-none");
            $(".selected").each(function() {
                if (
                    $(this)
                        .find(".dropify")
                        .eq(0)
                        .val() == ""
                ) {
                    const input = $(this)
                        .find(".dropify")
                        .eq(0)
                        .removeAttr("disabled")
                        .clone();
                    $(this)
                        .find(".bg-image")
                        .html("")
                        .append(input);
                    $(".dropify").dropify();
                }
            });
        }
    });

    $(".role-td .roles").change(function() {
        $(this)
            .parents(".role-td")
            .children('input[name="role"]')
            .val($(this).val());
    });
}

// EDIT HEADER BACKGROUNDS
function editHeader(button) {
    const input = button
        .parents("tr")
        .find(".dropify")
        .eq(0)
        .removeAttr("disabled")
        .clone();
    button
        .parents("tr")
        .find(".bg-image")
        .html("")
        .append(input);
    $(".dropify.page_header_size").dropify({
        messages: {
            default: "Image size should be 1400 x 300",
            replace: "Image size should be 1400 x 300"
        }
    });
    button.addClass("d-none");
    button.siblings(".save-btn").removeClass("d-none");
    removeHeaderImage();
}
$("#allPageHeadersTable .edit-header").click(function() {
    const button = $(this);
    editHeader(button);
});

// HEADER REMOVE IMAGE
function removeHeaderImage() {
    $("#allPageHeadersTable .dropify-clear").click(function() {
        $(this)
            .parents(".bg-image")
            .find(".dropify")
            .eq(0)
            .val(null);
        $(this)
            .parents(".bg-image")
            .append('<input type="hidden" class="removed-image">');
        console.log(
            $(this)
                .parents(".bg-image")
                .find(".dropify")
                .eq(0)
                .prop("files")
        );
        console.log(
            $(this)
                .parents(".bg-image")
                .find(".dropify")
                .eq(0)
                .val() == ""
        );
        $(this)
            .parents(".bg-image")
            .find(".dropify")
            .eq(0)
            .change(function() {
                $(this)
                    .parents(".bg-image")
                    .find(".removed-image")
                    .remove();
            });
    });
}
// SAVE HEADER BACKGROUND
function saveHeader(ID, TITLE) {
    const id = ID;
    const title = TITLE;
    let image;
    if (
        $("#saveHeader-" + id)
            .parents("tr")
            .find(".removed-image").length == 1
    ) {
        image = "delete";
    } else {
        image = $("#saveHeader-" + id)
            .parents("tr")
            .find(".dropify")
            .eq(0)
            .prop("files")[0];
    }
    const url = "/admin/page_headers";
    const _token = $('input[name="_token"]').val();
    var form_data = new FormData();
    form_data.append("id", id);
    form_data.append("title", title);
    form_data.append("image", image);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": _token
        },
        type: "POST",
        url: url,
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            console.log(data);
            $("#saveHeader-" + id).addClass("d-none");
            $("#saveHeader-" + id)
                .siblings(".edit-header")
                .removeClass("d-none");
        },
        error: function(data) {
            console.log("error");
        }
    });
}

//--------------//

//--------------------------//
// END DATATABLES
//--------------------------//

//-----------------------------------//
// Show and Hide and Confirm Password
//-----------------------------------//

function showPassword() {
    $(".show").click(function() {
        const input = $(this).siblings(".password");
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    $(".confirm, .main").keyup(function() {
        let passwordValue = $(".main").val();
        let confirmPasswordValue = $(".confirm").val();
        if (confirmPasswordValue == "") {
            $(".message").text("");
        } else if (passwordValue == "") {
            $(".message").text("Empty Password Field");
        } else if (passwordValue != confirmPasswordValue) {
            $(".message").text("Doesn't match");
        } else if (passwordValue == confirmPasswordValue) {
            $(".message").text("Matched");
        }
    });
}

//--------------------------//
// START ONLOAD
//--------------------------//

$(document).ready(function() {
    $(".dropify.landing_slider_size").dropify({
        messages: {
            default: "Image size should be 1400 x 640",
            replace: "Image size should be 1400 x 640"
        }
    });

    $(".dropify.solution_size").dropify({
        messages: {
            default: "Image size should be 600 x 300",
            replace: "Image size should be 600 x 300"
        }
    });

    $(".dropify.news_size").dropify({
        messages: {
            default: "Image size should be 400 x 180",
            replace: "Image size should be 400 x 180"
        }
    });

    $(".dropify.page_header_size").dropify({
        messages: {
            default: "Image size should be 1400 x 300",
            replace: "Image size should be 1400 x 300"
        }
    });

    $(".dropify").dropify();

    $(".summernote").summernote({
        height: 150,
        disableResizeEditor: true,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['paragraph']],
            ['height', ['height']]
        ]
    });

    $(".summernote-modal").summernote({
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['paragraph']],
            ['height', ['height']]
        ]
    });




    $(".selectpicker").selectpicker();

    navigationBar();

    initDataTables();

    insertActionsList();

    selectTable();

    selectOptions();

    editModals();

    numberInputs();

    manageJournals();

    manageArticles();

    dataEntryEditArticles();

    removeDropifyImage();

    manageAbout();

    showPassword();
});

function seen(){
    let url = '/admin/seen';
    $.ajax({
        type: 'GET',
        url: url,
        contentType: 'application/json',
        dataType: 'json',
        success: function (result) {
            console.log(result);
        },
        error: function (result) {
            console.log(result);
        }
    });
}

//--------------------------//
// END ONLOAD
//--------------------------//


