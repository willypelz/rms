if (typeof Array.prototype.indexOf !== 'function') {
    Array.prototype.indexOf = function (item) {
        for(var i = 0; i < this.length; i++) {
            if (this[i] === item) {
                return i;
            }
        }
        return -1;
    }; 
}

window.SH_Embed = (function () {
    function SH(els) {
        for(var i = 0; i < els.length; i++ ) {
            this[i] = els[i];
        }
        this.length = els.length;
    }

    function merge(root){
        for ( var i = 1; i < arguments.length; i++ )
            for ( var key in arguments[i] )
                root[key] = arguments[i][key];
        return root;
    }

    function getEmbed(options) {
	    var xmlhttp;
	    // var host = "http://localhost/seamlesshiring/public_html/";
	    var host = "https://seamlesshiring.com/";
	    var self = this;	   
	    

	    if (window.XMLHttpRequest) {
	        // code for IE7+, Firefox, Chrome, Opera, Safari
	        xmlhttp = new XMLHttpRequest();
	    } else {
	        // code for IE6, IE5
	        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }

	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 ) {
	           if(xmlhttp.status == 200){
	               self.embedUI = xmlhttp.responseText;
	               //self.embedUI = "dshfsdf";
	           }
	           else if(xmlhttp.status == 400) {
	              alert('There was an error 400');
	           }
	           else {
	               alert('something else other than 200 was returned');
	           }
	        }
	        
	    };

	    // xmlhttp.open("POST", host + "embed-view" + parser(options) , false);
        xmlhttp.open("POST", host + "embed-view" + parser(options) , false);
	    xmlhttp.send();
	    //alert(xmlhttp.responseText);
	    return self.embedUI;
	    // return "abc";
	    // return embedUI;

	}

	function parser(option)
	{
		var results = "?";
        for (i in option) {
           // console.log('option: '+i+" -> "+option[i]);
            if(isNaN(option[i]))
                results +=  i + "=" + option[i].replace('#','') + "&"; 
            else
                results +=  i + "=" + option[i] + "&";

        }
        return results; 
    }


    // ========= UTILS =========
    SH.prototype.forEach = function (callback) {
        this.map(callback);
        return this; 
    };
    SH.prototype.map = function (callback) {
        var results = [];
        for (var i = 0; i < this.length; i++) {
            results.push(callback.call(this, this[i], i));
        }
        return results; //.length > 1 ? results : results[0];
    };
    SH.prototype.mapOne = function (callback) {
        var m = this.map(callback);
        return m.length > 1 ? m : m[0];
    };

    // ========== DOM MANIPULATION ==========
    SH.prototype.text = function (text) {
        if (typeof text !== "undefined") {
            return this.forEach(function (el) {
                el.innerText = text;
            });
        } else {
            return this.mapOne(function (el) {
                return el.innerText;
            });
        }
    };

    SH.prototype.html = function (html) {
        if (typeof html !== "undefined") {
            return this.forEach(function (el) {
                el.innerHTML = html;
            });
        } else {
            return this.mapOne(function (el) {
                return el.innerHTML;
            });
        }
    };

    SH.prototype.addClass = function (classes) {
        var className = "";
        if (typeof classes !== 'string') {
            for (var i = 0; i < classes.length; i++) {
               className += " " + classes[i];
            }
        } else {
            className = " " + classes;
        }
        return this.forEach(function (el) {
            el.className += className;
        });
    };

    SH.prototype.removeClass = function (clazz) {
        return this.forEach(function (el) {
            var cs = el.className.split(' '), i;

            while ( (i = cs.indexOf(clazz)) > -1) { 
                cs = cs.slice(0, i).concat(cs.slice(++i));
            }
            el.className = cs.join(' ');
        });
    };

    SH.prototype.attr = function (attr, val) {
        if (typeof val !== 'undefined') {
            return this.forEach(function(el) {
                el.setAttribute(attr, val);
            });
        } else {
            return this.mapOne(function (el) {
                return el.getAttribute(attr);
            });
        }
    };

    SH.prototype.append = function (els) {
        return this.forEach(function (parEl, i) {
            els.forEach(function (childEl) {
                parEl.appendChild( (i > 0) ? childEl.cloneNode(true) : childEl);
            });
        });
    };

    SH.prototype.prepend = function (els) {
        return this.forEach(function (parEl, i) {
            for (var j = els.length -1; j > -1; j--) {
                parEl.insertBefore((i > 0) ? els[j].cloneNode(true) : els[j], parEl.firstChild);
            }
        });
    };

    SH.prototype.remove = function () {
        return this.forEach(function (el) {
            return el.parentNode.removeChild(el);
        });
    };

    SH.prototype.on = (function () {
        if (document.addEventListener) {
            return function (evt, fn) {
                return this.forEach(function (el) {
                    el.addEventListener(evt, fn, false);
                });
            };
        } else if (document.attachEvent)  {
            return function (evt, fn) {
                return this.forEach(function (el) {
                    el.attachEvent("on" + evt, fn);
                });
            };
        } else {
            return function (evt, fn) {
                return this.forEach(function (el) {
                    el["on" + evt] = fn;
                });
            };
        }
    }());

    SH.prototype.off = (function () {
        if (document.removeEventListener) {
            return function (evt, fn) {
                return this.forEach(function (el) {
                    el.removeEventListener(evt, fn, false);
                });
            };
        } else if (document.detachEvent)  {
            return function (evt, fn) {
                return this.forEach(function (el) {
                    el.detachEvent("on" + evt, fn);
                });
            };
        } else {
            return function (evt, fn) {
                return this.forEach(function (el) {
                    el["on" + evt] = null;
                });
            };
        }
    }());

    var SH_Embed = {
        get: function (selector) {
            var els;
            if (typeof selector === 'string') {
                els = document.querySelectorAll(selector);
            } else if (selector.length) { 
                els = selector;
            } else {
                els = [selector];
            }
            return new SH(els);
        }, 
        create: function (tagName, attrs) {
            var el = new SH([document.createElement(tagName)]);
            if (attrs) {
                if (attrs.className) { 
                    el.addClass(attrs.className);
                    delete attrs.className;
                }
                if (attrs.text) { 
                    el.text(attrs.text);
                    delete attrs.text;
                }
                for (var key in attrs) {
                    if (attrs.hasOwnProperty(key)) {
                        el.attr(key, attrs[key]);
                    }
                }
            }
            return el;
        },
        pull: function (options){
        	var defaults = {
        			id : "",
                    key : "",
        		    background : "",
    				headerTextColor : "",
    				headerBackground : "",
    				hoverColor : "",
    				bodyTextColor : "",
    				evenRowColor : "",
    				oddRowColor : "",
    				width: "auto",
    				height: "auto",
    				numberOfJobs: "all",
    				fieldsShown: "all"
            };

            options = merge(defaults, options);
            return getEmbed(options);
        }

    };
    return SH_Embed;
}());