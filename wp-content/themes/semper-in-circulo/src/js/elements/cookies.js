import "vanilla-cookieconsent";
import "vanilla-cookieconsent/dist/cookieconsent.css";
import "./cookie-custom.css";

const cookieconsent = initCookieConsent();

cookieconsent.run({
  current_lang: "de",
  autoclear_cookies: true, // default: false
  page_scripts: true, // default: false

  mode: "opt-in",
  delay: 0,
  revision: 1, // default: 0

  onFirstAction: function (cookie, user_preferences) {
    if (cookie.level.includes("analytics")) {
      _paq.push(["rememberConsentGiven"]);
    }
  },

  onChange: function (cookie, changed_preferences) {
    if (cookie.level.includes("analytics")) {
      _paq.push(["rememberConsentGiven"]);
    } else {
      _paq.push(["forgetConsentGiven"]);
    }
  },

  gui_options: {
    consent_modal: {
      layout: "box", // box/cloud/bar
      position: "bottom right", // bottom/middle/top + left/right/center
      transition: "slide", // zoom/slide
      swap_buttons: true, // enable to invert buttons
    },
    settings_modal: {
      layout: "bar", // box/bar
      // position: 'left',           // left/right
      transition: "zoom", // zoom/slide
    },
  },

  languages: {
    de: {
      consent_modal: {
        title: "Wir verwenden Cookies!",
        description:
          "Diese Webseite verwendet essentielle Cookies, welche das optimale Funktionieren der Seite garantieren und Ihr Verhalten auf unserer Webseite aufzeichnen. Letztere werden erst mit Ihrer Zustimmung gesetzt.",
        primary_btn: {
          text: "Alle akzeptieren",
          role: "accept_all",
        },
        secondary_btn: {
          text: "Einstellungen",
          role: "settings",
        },
      },
      settings_modal: {
        title: "Cookie Einstellungen",
        save_settings_btn: "Speichern",
        accept_all_btn: "Alle akzeptieren",
        reject_all_btn: "Alle ablehnen",
        close_btn_label: "Schliessen",
        cookie_table_headers: [
          { col1: "Name" },
          { col2: "Domain" },
          { col3: "Gültigkeit" },
          { col4: "Beschreibung" },
        ],
        blocks: [
          {
            title: "Verwendung von Cookies 📢",
            description:
              'Wir verwenden Cookies um Ihren Aufenthalt auf der Webseite zu verbessern und Ihr Verhalten auf unserer Webseite aufzuzeichnen. Sie können Ihre Einstellungen jederzeit anpassen. Mehr Informationen zu sensiblen Daten finden Sie <a href="/datenschutz" class="cc-link">in unseren Datenschutzbestimmungen.</a>',
          },
          {
            title: "Erforderliche Cookies",
            description:
              "Diese Cookies sind erforderlich, damit diese Webseite richtig funktioniert. Ohne sie würde die Seite nicht funktionieren.",
            toggle: {
              value: "necessary",
              enabled: true,
              readonly: true,
            },
          },
          {
            title: "Tracking und Analyse Cookies",
            description:
              "Diese Cookies erlauben es uns, Ihr Verhalten auf unserer Webseite zu analysieren und zu verfolgen.",
            toggle: {
              value: "analytics",
              enabled: false,
              readonly: false,
            },
            cookie_table: [
              {
                col1: "_pk_ses",
                col2: "analytics.kpunkt.ch",
                col3: "30 Minuten",
                col4: "Session-ID für Matomo Analytics",
              },
              {
                col1: "_pk_id",
                col2: "analytics.kpunkt.ch",
                col3: "1 Jahr",
                col4: "User-ID für Matomo Analytics",
              },
              {
                col1: "mtm_consent",
                col2: "analytics.kpunkt.ch",
                col3: "30 Jahre",
                col4: "Zustimmungserklärung zum Tracking durch Matomo Analytics",
              },
            ],
          },
          {
            title: "Mehr Informationen",
            description:
              'Für irgendwelche weiteren Fragen betreffend unserer Cookie Verwendungen, <a href="mailto: info@kreislauf-initiative.ch" class="cc-link">kontaktiere uns bitte.</a>',
          },
        ],
      },
    },
  },
});
