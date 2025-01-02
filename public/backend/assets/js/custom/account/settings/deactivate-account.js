"use strict";
var KTAccountSettingsProfileUpdate = function () {
    var t, n, e;
    return {
        init: function () {
            // Form ve submit butonunu seç
            t = document.querySelector("#kt_account_profile_details_form");
            e = document.querySelector("#kt_account_profile_details_submit");

            if (t && e) {
                // Form doğrulama ayarları
                n = FormValidation.formValidation(t, {
                    fields: {
                        fname: {
                            validators: {
                                notEmpty: {
                                    message: "First name is required" // Gerekli alan mesajı
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                });

                // Submit butonuna tıklama olayı
                e.addEventListener("click", function (event) {
                    event.preventDefault(); // Varsayılan form gönderimini engelle
                    n.validate().then(function (status) {
                        if (status === "Valid") {
                            // Başarılı doğrulama durumu
                            swal
                                .fire({
                                    text: "Profilinizi güncellemek istediğinizden emin misiniz?",
                                    icon: "warning",
                                    buttonsStyling: false,
                                    showDenyButton: true,
                                    confirmButtonText: "Evet",
                                    denyButtonText: "Hayır",
                                    customClass: {
                                        confirmButton: "btn btn-light-primary",
                                        denyButton: "btn btn-danger"
                                    }
                                })
                                .then((result) => {
                                    if (result.isConfirmed) {
                                        // Form gönder
                                        t.submit();
                                    } else if (result.isDenied) {
                                        Swal.fire({
                                            text: "Profil güncellemesi iptal edildi.",
                                            icon: "info",
                                            confirmButtonText: "Tamam",
                                            buttonsStyling: false,
                                            customClass: {
                                                confirmButton: "btn btn-light-primary"
                                            }
                                        });
                                    }
                                });
                        } else {
                            // Doğrulama hatası durumu
                            swal.fire({
                                text: "Üzgünüz, bazı hatalar algılandı, lütfen tekrar deneyin.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Tamam, Anladım!",
                                customClass: {
                                    confirmButton: "btn btn-light-primary"
                                }
                            });
                        }
                    });
                });
            }
        }
    };
}();

// DOM yüklendiğinde başlat
KTUtil.onDOMContentLoaded(function () {
    KTAccountSettingsProfileUpdate.init();
});
