//--------------------------//
// START FORMS & VALIDATION
//--------------------------//

let cancelled = false;

function resetValidationMsg(input) {
    input
        .parents(".form-group")
        .find(".validationMsg")
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
$('.form-group input[type="checkbox"], .form-group input[type="radio"]').click(
    function() {
        const input = $(this);
        resetValidationMsg(input);
    }
);

function validateSubmit(
    e,
    button,
    emptyMsg,
    emailMsg,
    mobileMsg,
    passwordStrengthMsg
) {
    const passwordStrengthRegex = /((?=.*d)(?=.*[a-z])(?=.*[A-Z]).{8,15})/gm;
    const localEgyptPhoneNumberRegex = /[01]+[0-9-()+]{9}/;
    const emailRegex = /^[A-z0-9._%+-]+@[A-z0-9.-]+.[A-z]{2,4}$/g;
    const inputs = button.parents("form").find(".form-group input");
    inputs.push(button.parents("form").find(".form-group textarea"));
    inputs.push(button.parents("form").find(".form-group select"));

    //-------------- Ana 3amelha comment ya a7med 34an elform m4 3ayza t submit ------------------

    // inputs.each(function() {
    //     $(this)
    //         .parents(".form-group")
    //         .children(".validationMsg")
    //         .text("");
    //     if (!$(this).val().length > 0) {
    //         $(this)
    //             .parents(".form-group")
    //             .children(".validationMsg")
    //             .addClass("red")
    //             .removeClass("green")
    //             .text(emptyMsg);
    //         e.preventDefault();
    //     }
    //     if ($(this).attr("type") == "password" && $(this).val().length > 0) {
    //         if (!passwordStrengthRegex.test($(this).val())) {
    //             $(this)
    //                 .parents(".form-group")
    //                 .children(".validationMsg")
    //                 .addClass("red")
    //                 .removeClass("green")
    //                 .text(passwordStrengthMsg);
    //             e.preventDefault();
    //         }
    //     }
    //     if ($(this).hasClass("email") && $(this).val().length > 0) {
    //         if (!emailRegex.test($(this).val())) {
    //             $(this)
    //                 .parents(".form-group")
    //                 .children(".validationMsg")
    //                 .addClass("red")
    //                 .removeClass("green")
    //                 .text(emailMsg);
    //             e.preventDefault();
    //         }
    //     }
    //     if ($(this).hasClass("mobile") && $(this).val().length > 0) {
    //         if (!localEgyptPhoneNumberRegex.test($(this).val())) {
    //             $(this)
    //                 .parents(".form-group")
    //                 .children(".validationMsg")
    //                 .addClass("red")
    //                 .removeClass("green")
    //                 .text(mobileMsg);
    //             e.preventDefault();
    //         }
    //     }
    // });
}
function validateAjaxSubmit(
    button,
    emptyMsg,
    emailMsg,
    mobileMsg,
    passwordStrengthMsg
) {
    const localEgyptPhoneNumberRegex = /[01]+[0-9-()+]{9}/;
    const emailRegex = /^[A-z0-9._%+-]+@[A-z0-9.-]+.[A-z]{2,4}$/g;
    const inputs = button.parents("form").find(".form-group input[required]");
    const selects = button.parents("form").find(".form-group select");
    const checkboxes = [];
    const radioBtns = [];
    if (button.parents("form").find(".form-group textarea[required]").length) {
        inputs.push(
            button.parents("form").find(".form-group textarea[required]")
        );
    }
    if (
        button
            .parents("form")
            .find('.form-group.required-check input[type="checkbox"]').length
    ) {
        button
            .parents("form")
            .find('.form-group.required-check input[type="checkbox"]')
            .each(function() {
                checkboxes.push($(this));
            });
    }
    if (
        button
            .parents("form")
            .find('.form-group.required-check input[type="radio"]').length
    ) {
        button
            .parents("form")
            .find('.form-group.required-check input[type="radio"]')
            .each(function() {
                radioBtns.push($(this));
            });
    }
    if (button.parents("form").find('.form-group input[type="file"]').length) {
        inputs.push(
            button.parents("form").find('.form-group input[type="file"]')
        );
    }
    for (let checkbox of checkboxes) {
        checkbox
            .parents(".form-group")
            .find(".valid-check")
            .removeClass("not-valid");
        checkbox
            .parents(".form-group")
            .find(".validationMsg")
            .text("");
        const checkGroup = checkbox
            .parents(".form-group")
            .find('input[type="checkbox"]');
        let checked = 0;
        checkGroup.each(function() {
            if ($(this).prop("checked")) {
                checked += 1;
            }
        });
        if (checked < 1) {
            checkbox
                .parents(".form-group")
                .find(".validationMsg")
                .addClass("red")
                .removeClass("green")
                .text(emptyMsg);
            checkbox
                .parents(".form-group")
                .find(".valid-check")
                .addClass("not-valid");
        }
    }
    for (let radioBtn of radioBtns) {
        radioBtn
            .parents(".form-group")
            .find(".valid-check")
            .removeClass("not-valid");
        radioBtn
            .parents(".form-group")
            .find(".validationMsg")
            .text("");
        const radioGroup = radioBtn
            .parents(".form-group")
            .find('input[type="radio"]');
        let checked = 0;
        radioGroup.each(function() {
            if ($(this).prop("checked")) {
                checked += 1;
            }
        });
        if (checked < 1) {
            radioBtn
                .parents(".form-group")
                .find(".validationMsg")
                .addClass("red")
                .removeClass("green")
                .text(emptyMsg);
            radioBtn
                .parents(".form-group")
                .find(".valid-check")
                .addClass("not-valid");
        }
    }
    selects.each(function() {
        $(this).removeClass("not-valid");
        $(this)
            .parents(".form-group")
            .children(".validationMsg")
            .text("");
        if ($(this).val() == null) {
            $(this)
                .parents(".form-group")
                .children(".validationMsg")
                .addClass("red")
                .removeClass("green")
                .text(emptyMsg);
            $(this).addClass("not-valid");
        }
    });
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
            $(this).addClass("not-valid");
        }
        if ($(this).attr("type") == "password" && $(this).val().length > 0) {
            if (!passwordStrengthRegex.test($(this).val())) {
                $(this)
                    .parents(".form-group")
                    .children(".validationMsg")
                    .addClass("red")
                    .removeClass("green")
                    .text(passwordStrengthMsg);
                $(this).addClass("not-valid");
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
                $(this).addClass("not-valid");
            }
        }
    });
}
$('form button[type="submit"]').click(function(e) {
    const button = $(this);
    validateSubmit(
        e,
        button,
        "Please fill this field!",
        "Please enter a valid email address!",
        "Please enter a valid mobile number"
    );
});
$(".valid-submit").click(function(e) {
    const button = $(this);
    validateSubmit(
        e,
        button,
        "Please fill this field!",
        "Please enter a valid email address!",
        "Please enter a valid mobile number"
    );
});
$(".valid-ajax-submit").click(function() {
    const button = $(this);
    if (button.hasClass("subscribe-btn")) {
        subscribe(button);
        return;
    }

    if (button.hasClass("unsubscribe-btn")) {
        unsubscribe(button);
        return;
    }

    validateAjaxSubmit(
        button,
        "Please fill this field!",
        "Please enter a valid email address!",
        "Please enter a valid mobile number"
    );

    function unsubscribe() {
        var email = $("#unsubscribe").val();

        function validateEmail(em) {
            var v = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return v.test(String(em).toLowerCase());
        }

        let emailValid = validateEmail(email);

        if (emailValid == true) {
            $.ajax({
                type: "GET",
                url: "/unsubscribe/" + email,

                success: function(responde) {
                    console.log(responde);

                    $(".subscribe-success").removeClass("d-none");
                    setTimeout(function() {
                        $(".subscribe-success").addClass("d-none");
                    }, 6000);
                },
                error: function(responde) {
                    console.log("error");
                }
            });
        } else if (emailValid == false) {
            $(".subscribe-error").removeClass("d-none");
            setTimeout(function() {
                $(".subscribe-error").addClass("d-none");
            }, 6000);
        }
    }
});

//--------------------------//
// END FORMS & VALIDATION
//--------------------------//

//--------------------------//
// START CONTACT US
//--------------------------//

function contactus(button) {
    if (button.parents("form").find(".not-valid").length) {
        return;
    }
    const url = "/contactus";
    const _token = $('input[name="_token"]').val();
    const purpose = $("#purpose option:selected").val();
    const subject = $('input[name="subject"]').val();
    const name = $('input[name="namecontact"]').val();
    const email = $('input[name="emailcontact"]').val();
    const details = $("#details").val();
    const phone = $('input[name="phonecontact"]').val();
    const robotChech = grecaptcha.getResponse(contactCaptcha);

    var form_data = new FormData();
    form_data.append("purpose", purpose);
    form_data.append("subject", subject);
    form_data.append("name", name);
    form_data.append("email", email);
    form_data.append("details", details);
    form_data.append("phonecontact", phone);
    form_data.append("g-recaptcha-response", robotChech);
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
            if (data.success) {
                $("#contact-us-form .reset-btn").click();
                //                $('#contact-success').removeClass('d-none');
                //                setTimeout(function () {
                //                    $('#contact-success').addClass('d-none');
                //                }, 3000);
                $("#thanksFormModal").modal("show");
                grecaptcha.reset(contactCaptcha);
                setTimeout(function() {
                    $("#thanksFormModal").modal("hide");
                }, 3000);
            }
        },
        error: function(data) {
            console.log("error");
        }
    });
}

$("#contactSubmit").click(function() {
    const button = $(this);
    contactus(button);
});

//--------------------------//
// END CONTACT US
//--------------------------//

//--------------------------//
// START HEADER BACKGROUND
//--------------------------//

function headerBackground() {
    const src = $(".header-background")
        .find("img")
        .attr("src");
    $(".header-background").css("background-image", 'url("' + src + '")');
    $(".header-background img").addClass("d-none");
}

//--------------------------//
// END HEADER BACKGROUND
//--------------------------//

//--------------------------//
// START PARTNER MODAL
//--------------------------//

$("#partnerSubmit").click(function() {
    const button = $(this);
    applypartner(button);
});

//--------------------------//
// END PARTNER MODAL
//--------------------------//

//--------------------------//
// START JOB APPLY MODAL
//--------------------------//

// KNOW SOMEONE
$('#applyModal input[name="know_someone"]').change(function() {
    if ($('#applyModal input[name="know_someone"]:checked').val() == "yes") {
        $("#know-who")
            .removeClass("d-none")
            .find('input[name="knowWho"]')
            .attr("required", true);
    } else {
        $("#know-who")
            .addClass("d-none")
            .find('input[name="knowWho"]')
            .attr("required", false)
            .val("");
    }
});

$("#jobApplySubmit").click(function() {
    const button = $(this);
    applyjob(button);
});

//--------------------------//
// END JOB APPLY MODAL
//--------------------------//

//--------------------------//
// START MAP
//--------------------------//

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

//--------------------------//
// END MAP
//--------------------------//

//--------------------------//
// START WEBSITE NAVIGATION
//--------------------------//

function navigationBar() {
    const currentURL = $(location).attr("href");
    const navItems = $(".nav-item");
    const dropItems = $(".dropdown-item");
    for (let item of navItems) {
        if (currentURL.includes($(item).attr("data-nav"))) {
            $(".nav-item.active").removeClass("active");
            $(item).addClass("active");
        }
    }
    for (let item of dropItems) {
        if (currentURL.includes($(item).attr("data-nav"))) {
            $(".nav-item.active").removeClass("active");
            $(item).addClass("active");
            $(item)
                .parents(".nav-item")
                .addClass("active");
        }
    }
}

//--------------------------//
// END WEBSITE NAVIGATION
//--------------------------//

//--------------------------//
// START IFRAME DEFER
//--------------------------//

function init() {
    var vidDefer = document.getElementsByTagName("iframe");
    for (var i = 0; i < vidDefer.length; i++) {
        if (vidDefer[i].getAttribute("data-src")) {
            vidDefer[i].setAttribute(
                "src",
                vidDefer[i].getAttribute("data-src")
            );
        }
    }
}

//--------------------------//
// END IFRAME DEFER
//--------------------------//

//--------------------------//
// START CV NAME
//--------------------------//

$('input[name="cv"]').change(function() {
    $("#cv-name").text('"' + $(this).prop("files")[0].name + '"');
});

//--------------------------//
// END CV NAME
//--------------------------//

//--------------------------//
// START NEWS GALLERY
//--------------------------//

function newsGallery(button) {
    const id = button.attr("id");
    $("#gallerySlider .carousel-indicators li").removeClass("active");
    $("#gallerySlider .carousel-inner .carousel-item").removeClass("active");
    $('#gallerySlider .carousel-indicators li[data-slide-to="' + id + '"]')
        .eq(0)
        .addClass("active");
    $("#gallerySlider .carousel-inner .carousel-item#" + id + "-slide")
        .eq(0)
        .addClass("active");
    $("#newsGalleryModal").modal("show");
}
$(".news-gallery .gallery-toggler").click(function() {
    const button = $(this);
    newsGallery(button);
});

//--------------------------//
// END NEWS GALLERY
//--------------------------//

//--------------------------//
// START OWL CAROUSEL
//--------------------------//

function owlSlider() {
    // remove (start)
    //    for (let i=0;i<3;i++) {
    //        $('.hero-slider-section .owl-carousel').eq(0).append($('.hero-slider-section .slide').eq(0).clone());
    //        $('.testimonials-section .owl-carousel').eq(0).append($('.testimonials-section .slide').eq(0).clone());
    //    }
    //    for (let i=0;i<8;i++) {
    //        $('.news-section .owl-carousel').eq(0).append($('.news-section .slide').eq(0).clone());
    //    }
    // remove (end)

    $(".hero-slider-section .owl-carousel").owlCarousel({
        items: 1,
        dotsEach: 1,
        autoplay: true,
        loop: true
    });
    $(".testimonials-section .owl-carousel").owlCarousel({
        items: 1,
        dotsEach: 1,
        autoplay: true,
        autoplayHoverPause: true,
        loop: true
    });
    $(".news-section .owl-carousel").owlCarousel({
        items: 3,
        margin: 30,
        dotsEach: 1,
        autoplay: true,
        autoplayHoverPause: true,
        loop: true,
        responsive: {
            0: {
                items: 1,
                padding: 30
            },
            576: {
                items: 2,
                padding: 0
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });
    $("#index-slider").owlCarousel({
        items: 4,
        dots: true,
        dotsEach: 1,
        // autoplay: true,
        // autoplayHoverPause: true,
        loop: true,
        nav: true,
        responsive: {
            0: {
                items: 1,
                padding: 30
            },
            576: {
                items: 2,
                padding: 0
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    });
}

//--------------------------//
// END OWL CAROUSEL
//--------------------------//

//--------------------------//
// START RECAPTCHA
//--------------------------//

let partnerCaptcha;
let contactCaptcha;
let jobCaptcha;

function loadCaptcha() {
    if ($("#partnerRobot").length) {
        partnerCaptcha = grecaptcha.render("partnerRobot", {
            sitekey: "6LeHPo0UAAAAAAipqTEUIgEObhLFKJexZiV4eXaG"
        });
    }
    if ($("#contactRobot").length) {
        contactCaptcha = grecaptcha.render("contactRobot", {
            sitekey: "6LeHPo0UAAAAAAipqTEUIgEObhLFKJexZiV4eXaG"
        });
    }
    if ($("#jobRobot").length) {
        jobCaptcha = grecaptcha.render("jobRobot", {
            sitekey: "6LeHPo0UAAAAAAipqTEUIgEObhLFKJexZiV4eXaG"
        });
    }
}

const onloadCallback = function() {
    loadCaptcha();
};
window.onloadCallback = onloadCallback;

//--------------------------//
// END RECAPTCHA
//--------------------------//

//--------------------------//
// START MODALS HANDLE
//--------------------------//

$("#partnerModal, #applyModal").on("hidden.bs.modal", function(e) {
    $(this)
        .find(".reset-btn")
        .eq(0)
        .click();
});

//--------------------------//
// START MODALS HANDLE
//--------------------------//

//--------------------------//
// START CONTENT PAGE
//--------------------------//

function contentPageDisplay() {
    const currentURL = $(location).attr("href");
    let id = parseInt(
        currentURL
            .split("")
            .reverse()
            .join("")
    )
        .toString()
        .split("")
        .reverse()
        .join("");
    for (let i = 0; i < 4; i++) {
        if (currentURL.split("").reverse()[i] == 0) {
            id += "0";
        }
    }
    $("#id-" + id + "-tab")
        .addClass("active show")
        .attr("aria-selected", true);
    $("#id-" + id).addClass("active show");
    if (isNaN(id)) {
        $(".sidebar .nav-link")
            .eq(0)
            .addClass("active show")
            .attr("aria-selected", true);
        $(".page-content #v-pills-tabContent .tab-pane")
            .eq(0)
            .addClass("active show");
    }
}

//--------------------------//
// START CONTENT PAGE
//--------------------------//

//--------------------------//
// START DROPDOWN MENU
//--------------------------//

function dropdownRight() {
    $(".dropdown-menu .dropdown-menu").each(function() {
        const rightEdge = $(this).width() + $(this).offset().left;
        const screenWidth = $(window).width();
        if (
            $(this)
                .parents(".dropdown-menu")
                .hasClass("show")
        ) {
            if (screenWidth - rightEdge < 0) {
                $(this).addClass("other-side");
            } else {
                $(this).removeClass("other-side");
                if (screenWidth - rightEdge < 0) {
                    $(this).addClass("other-side");
                }
            }
        }
    });
}

$(window).resize(function() {
    dropdownRight();
});
$(".navbar-nav>.dropdown").click(function() {
    setTimeout(function() {
        dropdownRight();
    }, 100);
});

//--------------------------//
// START DROPDOWN MENU
//--------------------------//

//--------------------------//
// START ONLOAD
//--------------------------//

$(document).ready(function() {
    $(".dropify").dropify();

    owlSlider();

    headerBackground();

    contentPageDisplay();

    dropdownRight();
});

//--------------------------//
// END ONLOAD
//--------------------------//

//--------------------------//
// START AJAX LOADING
//--------------------------//

$(document).ajaxStart(function() {
    //  $("#global_loader").css("display", "block");
    $("#global_loader").removeClass("d-none");
});

$(document).ajaxComplete(function() {
    //  $("#global_loader").css("display", "none");
    $("#global_loader").addClass("d-none");
});

//--------------------------//
// END AJAX LOADING
//--------------------------//

//

$(document).on("keyup", "#downloadsSearch", function(e) {
    e.preventDefault();

    let searchVal = $("#downloadsSearch").val();

    $("#all-downloads-files *").remove();

    $.ajax({
        type: "POST",
        url: "/download/search",
        data: {
            userSearchInput: searchVal
        },
        success: function(responde) {
            console.log(responde);

            if (!$.isArray(responde) || !responde.length) {
                let downloads = `<p class="no-downloads-data">no matching file found for ${searchVal}</p>`;

                $("#all-downloads-files *").remove();

                $("#all-downloads-files").append(downloads);
            } else {
                $("#all-downloads-files *").remove();

                let i;

                for (i = 0; i < responde.length; i++) {
                    let downloads = `
                
                
            <div class="job">
                <div class="col-lg-2 col-md-3 col-sm-12 job-logo">
                    <div class="img-container"></div>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-12 job-body">
                    <div class="row">
                        <div class="col-md-10 col-sm-12">
                            <div class="header">
                                <h5 class="title">${responde[i].title}</h5>
                                <p class="details">
                                    <span class="category">Uploaded</span>
                                    <span class="separator">-</span>
                                    <span class="date">${
                                        responde[i].updated_at
                                    }</span>
                                </p>
                            </div>
                            <div class="short-description">
                                ${responde[i].description}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12 apply-button">
                            <a class="btn" href="/uploads/files/${
                                responde[i].file
                            }" download>Download</a>
                        </div>
                    </div>
                </div>
            </div>
                
                
                
                
                `;

                    $("#all-downloads-files").append(downloads);
                }
            }

            $("#all-downloads-files .job").each(function() {
                let fileExt = $(this)
                    .find(".apply-button .btn")
                    .attr("href")
                    .split(".")
                    .pop();

                console.log(fileExt);

                if (fileExt === "pdf") {
                    let downloadImage = `<img class="img-responsive" src="/site/images/pdf-download.png">`;

                    $(this)
                        .find(".img-container")
                        .append(downloadImage);
                } else {
                    let downloadImage = `<img class="img-responsive" src="/site/images/Microsoft_Word logo.png">`;

                    $(this)
                        .find(".img-container")
                        .append(downloadImage);
                }
            });
        },
        error: function(responde) {
            console.log("error");
        }
    });
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
