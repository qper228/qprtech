window.addEventListener("load", function(){
  window.cookieconsent.initialise({
    palette: {
      popup: {
        background: "#000"
      },
      button: {
        background: "#f1d600",
        text: "#000"
      }
    },
    theme: "classic",
    position: "bottom-right",
    type: "opt-in",
    content: {
      message: "We use cookies to enhance your browsing experience, serve personalized ads or content, and analyze our traffic.",
      dismiss: "Accept all",
      allow: "Accept necessary",
      deny: "Decline",
      link: "Learn more",
      href: "/privacy-policy"
    },
    onInitialise: function (status) {
      var type = this.options.type;
      var didConsent = this.hasConsented();
      if (type === 'opt-in' && didConsent) {
        // Enable cookies here
        console.log('Cookies accepted');
      }
    }
  });
});