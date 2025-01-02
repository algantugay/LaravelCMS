"use strict";
var KTSignupGeneral = function() {
    var e, t, r, a, s = function() {
        return a.getScore() > 50
    };
    return {
        init: function() {
            e = document.querySelector("#kt_sign_up_form"), t = document.querySelector("#kt_sign_up_submit"), a = KTPasswordMeter.getInstance(e.querySelector('[data-kt-password-meter="true"]')), ! function(e) {
                try {
                    return new URL(e), !0
                } catch (e) {
                    return !1
                }
            }(t.closest("form").getAttribute("action")) ? (r = FormValidation.formValidation(e, {
                fields: {
                    "first-name": {
                        validators: {
                            notEmpty: {
                                message: "First Name is required"
                            }
                        }
                    },
                    "last-name": {
                        validators: {
                            notEmpty: {
                                message: "Last Name is required"
                            }
                        }
                    },
                    email: {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: "Geçerli bir e-posta adresi değil"
                            },
                            notEmpty: {
                                message: "Email Adresi Gerekli"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "Şifre Gerekli"
                            },
                            callback: {
                                message: "Lütfen geçerli bir şifre girin",
                                callback: function(e) {
                                    if (e.value.length > 0) return s()
                                }
                            }
                        }
                    },
                    "confirm-password": {
                        validators: {
                            notEmpty: {
                                message: "Şifre onayı gerekli"
                            },
                            identical: {
                                compare: function() {
                                    return e.querySelector('[name="password"]').value
                                },
                                message: "Şifreler Uyuşmuyor"
                            }
                        }
                    },
                    toc: {
                        validators: {
                            notEmpty: {
                                message: "Şartlar ve koşulları kabul etmelisiniz"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: !1
                        }
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), t.addEventListener("click", (function(s) {
                s.preventDefault(), r.revalidateField("password"), r.validate().then((function(r) {
                    "Valid" == r ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function() {
                        t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                            text: "You have successfully reset your password!",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Tamam, Anladım!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then((function(t) {
                            if (t.isConfirmed) {
                                e.reset(), a.reset();
                                var r = e.getAttribute("data-kt-redirect-url");
                                r && (location.href = r)
                            }
                        }))
                    }), 1500)) : Swal.fire({
                        text: "Üzgünüz :( Hata yapmışsınız gibi gözüküyor, lütfen tekrar deneyin !",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Tamam, Anladım!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            })), e.querySelector('input[name="password"]').addEventListener("input", (function() {
                this.value.length > 0 && r.updateFieldStatus("password", "NotValidated")
            }))) : (r = FormValidation.formValidation(e, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: "Name kısmı zorunlu !"
                            }
                        }
                    },
                    email: {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: "Geçerli bir e-posta adresi değil"
                            },
                            notEmpty: {
                                message: "Email adresi zorunlu !"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "Şifre Girilmesi Zorunlu !"
                            },
                            callback: {
                                message: "Lütfen geçerli bir şifre girin",
                                callback: function(e) {
                                    if (e.value.length > 0) return s()
                                }
                            }
                        }
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: "Şifre onayı gerekli"
                            },
                            identical: {
                                compare: function() {
                                    return e.querySelector('[name="password"]').value
                                },
                                message: "Şifreler Uyuşmuyor"
                            }
                        }
                    },
                    toc: {
                        validators: {
                            notEmpty: {
                                message: "Şartlar ve koşulları kabul etmelisiniz"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: !1
                        }
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), t.addEventListener("click", (function(a) {
                a.preventDefault(), r.revalidateField("password"), r.validate().then((function(r) {
                    "Valid" == r ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, axios.post(t.closest("form").getAttribute("action"), new FormData(e)).then((function(t) {
                        if (t) {
                            e.reset();
                            const t = e.getAttribute("data-kt-redirect-url");
                            t && (location.href = t)
                        } else Swal.fire({
                            text: "Üzgünüz :( Hata yapmışsınız gibi gözüküyor, lütfen tekrar deneyin !",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Tamam, Anladım!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                    })).catch((function(e) {
                        Swal.fire({
                            text: "Üzgünüz :( Hata yapmışsınız gibi gözüküyor, lütfen tekrar deneyin !",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Tamam, Anladım!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                    })).then((() => {
                        t.removeAttribute("data-kt-indicator"), t.disabled = !1
                    }))) : Swal.fire({
                        text: "Üzgünüz :( Hata yapmışsınız gibi gözüküyor, lütfen tekrar deneyin !",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Tamam, Anladım!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            })), e.querySelector('input[name="password"]').addEventListener("input", (function() {
                this.value.length > 0 && r.updateFieldStatus("password", "NotValidated")
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTSignupGeneral.init()
}));