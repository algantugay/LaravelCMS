"use strict";

var KTAuthI18nDemo = function() {
    var element, menuInstance;
    var translations = {
        "general-progress": {
            English: "Please wait...",
            Spanish: "Iniciar Sesión",
            German: "Registrarse",
            Japanese: "ログイン",
            French: "S'identifier"
        },
        "general-desc": {
            English: "Get unlimited access & earn money",
            Spanish: "Obtenga acceso ilimitado y gane dinero",
            German: "Erhalten Sie unbegrenzten Zugriff und verdienen Sie Geld",
            Japanese: "無制限のアクセスを取得してお金を稼ぐ",
            French: "Obtenez un accès illimité et gagnez de l'argent"
        },
        // ... diğer çeviriler ...
    };

    var updateTranslations = function(language) {
        for (var key in translations) {
            if (translations.hasOwnProperty(key) && translations[key][language]) {
                var element = document.querySelector("[data-kt-translate=" + key + "]");
                if (element) {
                    if (element.tagName === "INPUT") {
                        element.setAttribute("placeholder", translations[key][language]);
                    } else {
                        element.innerHTML = translations[key][language];
                    }
                }
            }
        }
    };

    var changeLanguage = function(lang) {
        var langElement = element.querySelector('[data-kt-lang="' + lang + '"]');
        if (langElement) {
            var currentLangName = document.querySelector('[data-kt-element="current-lang-name"]');
            var currentLangFlag = document.querySelector('[data-kt-element="current-lang-flag"]');
            var langName = langElement.querySelector('[data-kt-element="lang-name"]');
            var langFlag = langElement.querySelector('[data-kt-element="lang-flag"]');
            
            currentLangName.innerText = langName.innerText;
            currentLangFlag.setAttribute("src", langFlag.getAttribute("src"));
            
            localStorage.setItem("kt_auth_lang", lang);
        }
    };

    return {
        init: function() {
            if ((element = document.querySelector("#kt_auth_lang_menu"))) {
                menuInstance = KTMenu.getInstance(element);
                
                // Language settings from localStorage
                var savedLang = localStorage.getItem("kt_auth_lang");
                if (savedLang) {
                    changeLanguage(savedLang);
                    updateTranslations(savedLang);
                }
                
                menuInstance.on("kt.menu.link.click", function(event) {
                    var lang = event.getAttribute("data-kt-lang");
                    changeLanguage(lang);
                    updateTranslations(lang);
                });
            }
        }
    };
}();

// Initialize the module on DOM content load
KTUtil.onDOMContentLoaded(function() {
    KTAuthI18nDemo.init();
});
