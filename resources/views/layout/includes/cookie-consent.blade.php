<!-- Cookie Consent script -->
<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script>
window.cookieconsent.initialise({
    "palette": {
        "popup": {
            "background": "#2f3e4d",
            "text": "#ffffff"
        },
        "button": {
            "background": "#28a745"
        }
    },
    "theme": "classic",
    "content": {
        "message": "This site uses cookies. By clicking 'Continue' or continuing to use the site, you agree to our use of cookies.",
        "dismiss": "Continue",
        "link": "Read our policy",
        "href": "https://seamlesshr.com/cookies"
    },
    onPopupOpen: function(status) {
        var cookieConsentSpacing = document.createElement('div');
        cookieConsentSpacing.setAttribute('id', 'cookie-consent-spacing');
        cookieConsentSpacing.style.paddingBottom = '60px';
        document.querySelector('body').append(cookieConsentSpacing) ;
        document.querySelector('.shr-auth').append(cookieConsentSpacing) ;
    },
    onStatusChange: function(status) {
        if(this.hasConsented()){
            var cookieConsentSpacing = document.querySelectorAll('#cookie-consent-spacing').remove();
            Array.prototype.forEach.call( cookieConsentSpacing, function( node ) {
                node.parentNode.removeChild( node );
            });
        }
    },
});
</script>
