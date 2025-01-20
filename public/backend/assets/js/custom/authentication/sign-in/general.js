"use strict";
var KTSigninGeneral = function () {
    var t, e, r;
    return {
        init: function () {
            t = document.querySelector("#kt_sign_in_form"),
                e = document.querySelector("#kt_sign_in_submit"),
                r = FormValidation.formValidation(t, {
                    fields: {
                        email: {
                            validators: {
                                regexp: {
                                    regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                    message: "Geçerli bir email adresi giriniz!"
                                },
                                notEmpty: {
                                    message: "Email adresi zorunlu!"
                                }
                            }
                        },
                        password: {
                            validators: {
                                notEmpty: {
                                    message: "Şifre zorunlu!"
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                }),

                e.addEventListener("click", function (i) {
                    i.preventDefault();
                    r.validate().then(function (valid) {
                        if ("Valid" === valid) {
                            e.setAttribute("data-kt-indicator", "on");
                            e.disabled = true;
                            // Formu post et
                            axios.post(e.closest("form").getAttribute("action"), new FormData(t))
                                .then(function (response) {
                                    if (response.data.success) {
                                        Swal.fire({
                                            text: "Giriş başarılı!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Tamam!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });

                                        // Yönlendirme işlemi hemen yapılacak
                                        var redirectUrl = t.getAttribute("data-kt-redirect-url");
                                        if (redirectUrl) {
                                            location.href = redirectUrl;
                                        }
                                    } else {
                                        Swal.fire({
                                            text: "Üzgünüz, e-posta veya şifre hatalı, lütfen tekrar deneyin.",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Tamam!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });
                                    }
                                })
                                .catch(function (error) {
                                    Swal.fire({
                                        text: "Üzgünüz, bazı hatalar tespit edildi, lütfen tekrar deneyin.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Tamam!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });
                                })
                                .finally(function () {
                                    e.removeAttribute("data-kt-indicator");
                                    e.disabled = false;
                                });
                        } else {
                            Swal.fire({
                                text: "Üzgünüz, bazı hatalar tespit edildi, lütfen tekrar deneyin.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Tamam!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                });
        }
    }
}();
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
