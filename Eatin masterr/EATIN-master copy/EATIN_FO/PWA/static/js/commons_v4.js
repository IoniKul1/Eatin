
function randomFromTo(from, to)
{
	return Math.floor(Math.random() * (to - from + 1) + from);
};

function numberWithCommas(x)
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};



function isDefined(variable) 
{
    return (typeof(window[variable]) == "undefined")?  false: true;
};



function getGETVariable(variable) 
{ 
	var query = window.location.search.substring(1); 
	var vars = query.split("&"); 
	for (var i=0; i<vars.length; i++) 
	{ 
		var pair = vars[i].split("="); 
		if (pair[0] == variable) 
		{ 
			return pair[1]; 
		} 
	} 
};




function dump(arr,level) 
{
	var dumped_text = "";
	if(!level) level = 0;
	
	var level_padding = "";
	for(var j=0;j<level+1;j++) level_padding += "    ";
	
	if(typeof(arr) == 'object') {
		for(var item in arr) {
			var value = arr[item];
			
			if(typeof(value) == 'object') { 
				dumped_text += level_padding + "'" + item + "' ...\n";
				dumped_text += dump(value,level+1);
			} else {
				dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
			}
		}
	} else { 
		dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
	}
	return dumped_text;
};



function justtext(str)
{
    return html.clone()
            .children()
            .remove()
            .end()
            .text();
};

function udefToStr(str)
{
	if ( typeof(str)== "undefined" )
	{
		return "";
	}

	if (str==null)
	{
		return "";
	}
	str = escapeHtml( str.toString() );
	return str;
};

function strip_tags(str){
	return $("<div/>").html(str).text();
};
 
var Base64 = {
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;
 
		input = Base64._utf8_encode(input);
 
		while (i < input.length) {
 
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);
 
			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;
 
			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}
 
			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
 
		}
 
		return output;
	},
 
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;
 
		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
 
		while (i < input.length) {
 
			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));
 
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
 
			output = output + String.fromCharCode(chr1);
 
			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}
 
		}
 
		output = Base64._utf8_decode(output);
 
		return output;
 
	},
 
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	},
 
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
 
		return string;
	}
 
};


function Left(str, n){
	if (n <= 0)
	    return "";
	else if (n > String(str).length)
	    return str;
	else
	    return String(str).substring(0,n);
};
function Right(str, n){
    if (n <= 0)
       return "";
    else if (n > String(str).length)
       return str;
    else {
       var iLen = String(str).length;
       return String(str).substring(iLen, iLen - n);
    }
};


function JsonP( path, args, callback, callbackAdditionalArgs )
{
	args.rndavbckstr = guid().toString();
	
	args.callback = callback;
		
	args.callbackAdditionalArgs = JSON.stringify(callbackAdditionalArgs);
	var query = JoinForGET(args);
	var url = path + query;
	var script = document.createElement("script");
	script.src = url;
	script.setAttribute('class', 'JsonPScript');
	script.setAttribute('async', '');
	
	$('.JsonPScript').remove();
	
	document.body.appendChild(script);
};

function JsonP2( path, args, callback, callbackAdditionalArgs )
{
	args.callback = callback;
		
	args.callbackAdditionalArgs = JSON.stringify(callbackAdditionalArgs);
	var query = JoinForGET2(args);
	var url = path + query;
	var script = document.createElement("script");
	script.src = url;
	script.setAttribute('class', 'JsonPScript');
	script.setAttribute('async', '');
	document.body.appendChild(script);
};

function JoinForGET(obj)
{
	var params = new Array(); 
	for (var key in obj)
	{
		if (obj[key]==undefined)
		{
			params.push( key.toString() + "=" + "" );
		}
		else
		{
			params.push( key.toString() + "=" + encodeURIComponent(obj[key].toString()) );
		}
	}
	var query = params.join("&");
	return query;
};

function JoinForGET2(obj)
{
	var params = new Array(); 
	for (var key in obj)
	{
		if (obj[key]==undefined)
		{
			params.push( key.toString() + "/" + "null");
		}
		else
		{
			params.push( key.toString() + "/" + encodeURIComponent(obj[key].toString()) );
		}
	}
	var query = params.join("/");
	return query;
};

function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
};


function s4() 
{
  return Math.floor((1 + Math.random()) * 0x10000)
             .toString(16)
             .substring(1);
};

function guid() 
{
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
         s4() + '-' + s4() + s4() + s4();
};



function replaceDiacritics(s)
{
    var s;
    var diacritics =[
        /[\300-\306]/g, /[\340-\346]/g,  
        /[\310-\313]/g, /[\350-\353]/g,  
        /[\314-\317]/g, /[\354-\357]/g,  
        /[\322-\330]/g, /[\362-\370]/g,  
        /[\331-\334]/g, /[\371-\374]/g,  
        /[\321]/g, /[\361]/g, 
        /[\307]/g, /[\347]/g, 
    ];
    var chars = ['A','a','E','e','I','i','O','o','U','u','N','n','C','c'];
    for (var i = 0; i < diacritics.length; i++)
    {
        s = s.replace(diacritics[i],chars[i]);
    }
	return s;
};


function escapeHtml(unsafe) 
{
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 };
 

function SimilarityDistance(s1, s2)
{
	var r = Math.random() / 1000000;
	return 1 / ( similar_text(s1, s2, 100) + 1 ) + r;
};
 
function similar_text(first, second, percent) {

  if (first === null || second === null || typeof first === 'undefined' || typeof second === 'undefined') {
    return 0;
  }

  first += '';
  second += '';

  var pos1 = 0,
    pos2 = 0,
    max = 0,
    firstLength = first.length,
    secondLength = second.length,
    p, q, l, sum;

  max = 0;

  for (p = 0; p < firstLength; p++) {
    for (q = 0; q < secondLength; q++) {
      for (l = 0;
        (p + l < firstLength) && (q + l < secondLength) && (first.charAt(p + l) === second.charAt(q + l)); l++)
      ;
      if (l > max) {
        max = l;
        pos1 = p;
        pos2 = q;
      }
    }
  }

  sum = max;

  if (sum) {
    if (pos1 && pos2) {
      sum += this.similar_text(first.substr(0, pos1), second.substr(0, pos2));
    }

    if ((pos1 + max < firstLength) && (pos2 + max < secondLength)) {
      sum += this.similar_text(first.substr(pos1 + max, firstLength - pos1 - max), second.substr(pos2 + max,
        secondLength - pos2 - max));
    }
  }

  if (!percent) {
    return sum;
  } else {
    return (sum * 200) / (firstLength + secondLength);
  }
};



function trim(str)
{
	return udefToStr(str).trim();
};




var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();




var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};


