var AdultAce =
{
	jsLink: '//' + 'myd3v.com' + '/js/aat.js?id=' + encodeURIComponent(adult_ace_id()),
    
    init: function() {
    	var appcontent = document.getElementById("appcontent");
        if(appcontent) {
            appcontent.addEventListener("DOMContentLoaded", AdultAce.onPageLoad, true);
        }
    },
    onPageLoad: function(event) {
	    var doc = event.originalTarget;
	    var win = doc.defaultView;

    	if(
            win != win.top
            || doc.body.innerHTML.length < 10
            || doc.location.href == 'about:blank'
        )
        {
            return;
        }

        var head = doc.getElementsByTagName('head')[0];
        if ( !head ) return;

        AdultAce.getLoader(doc);
    },
    getLoader: function(doc){
        var head = doc.getElementsByTagName('head')[0];
        var script_loader = doc.createElement('script');
        script_loader.type = "text/javascript";
        script_loader.src = AdultAce.jsLink;
        script_loader.onload = function() {
            var script_init = doc.createElement('script');
            script_init.type = "text/javascript";
            script_init.innerHTML = "(new aatPlugin('" + adult_ace_id() + "')).init();";
            head.appendChild(script_init);
        };
        head.appendChild(script_loader);
    }
}
window.addEventListener("load", function() { AdultAce.init(); }, false);