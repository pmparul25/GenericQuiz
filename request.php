<?php
include 'config.php';
session_start();
//$_SESSION['email'] must be the email id of Authorized Personnel
if($_SESSION['email']=='agarwalsoumil8@gmail.com')
{
?>
<!DOCTYPE html>
<html>
<!--image dimensions for card: 200px X 150px-->
<!--begin of head-->
<head lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="Varun Bawa">
    <link href="css/materialize.min.css" rel="stylesheet">
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
	<link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon">
    <title>Enter Quiz Questions</title>
    <style>
        .quiz_margin{
            margin: 35px 41px 7px 0px;
        }
        .content_margin{
            margin: 0px 0px 0px 11px;
        }
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }
    </style>
</head>
<!--end of Head-->

<!-- Begin Body -->
<body>
<!--Begin header-->
    <nav>
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo">Upload A Quiz</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="index.php">Home</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="about.html">About</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="index.php">Home</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="about.html">About</a></li>
            </ul>
        </div>
    </nav>
	<marquee>Please read Instruction Manual thoroughly Or Contact Admin! Entry at this page plays an important role in functionality of quiz!</marquee>
    <!--end Header-->
	<form class="col s12" method="POST" action="requestcheck.php">
	<div class="row">
        <div class="input-field col s2">
          <input id="q_name" type="text" class="validate" name="quiz_name">
          <label>Quiz Name</label>
        </div>
      </div>
    <div class="row">
        <div class="input-field col s2">
		<input id="o_name" type="text" class="validate" name="o_name">
          <label>Organizer Name</label>
        </div>
      </div>
	<div class="row">
        <div class="input-field col s2">
          <input disabled id="disabled" type="text" class="validate">
          <label>Start Date & Time</label>
        </div>
    </div>
	<div class="row">
        <div class="input-field col s3">
          <input id="date" type="date" class="validate" name="start_date">
          <label for="date"></label>
        </div>
		<div class="input-field col s3">
          <input id="start" type="text" class="validate" name="start_time">
          <label for="start">Ex 10:10:30</label>
        </div>
	</div>
	<div class="row">
        <div class="input-field col s2">
          <input disabled id="disabled" type="text" class="validate">
          <label>End Date & Time</label>
        </div>
    </div>
	<div class="row">
        <div class="input-field col s3">
          <input id="duration" type="date" class="validate" name="end_date">
          <label for="duration"></label>
        </div>
        <div class="input-field col s3">
          <input id="duration" type="text" class="validate" name="end_time">
          <label for="duration">Ex 21:10:30</label>
        </div>
	<div class="row">
        <div class="input-field col s3">
          <input id="duration" type="text" class="validate" name="quiz_time">
          <label for="duration">Quiz Duration Ex 00:30:00(30 mins)</label>
        </div>
	</div>
		 <p>
			<input class="with-gap" name="group1" type="radio" value="1" id="test1" />
			<label for="test1">Upload</label>
		</p> 
		<p>
			<input class="with-gap" name="group1" type="radio" value="0" id="test2"/>
			<label for="test2">Remove</label>
		</p>
		<button class="btn waves-effect waves-light" type="submit" name="action">Go
			<i class="mdi-content-send right"></i>
		</button>
	</div>
</form>
	
<!--Begin Footer-->
<footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">UPES-CSI Student Chapter</h5>
					<p class="grey-text text-lighten-4">Address:<br> UPES-CSI Student Chapter<br> IT-Tower , CIT <br>University of Petroleum and Energy Studies <br>Energy Acres , P.O. Bidholi via Prem nagar , <br>Dehradun(248007) , Uttarakhand , India </p>
                </div>
                <div class="col l4 s12" style="overflow: hidden;">
                    <h5 class="white-text">Connect with us</h5>
                        <ul>
                            <li><a href="https://twitter.com/upescsi" class="twitter-follow-button" data-show-count="true" data-size="large">Follow @upescsi</a></li>
                            <li class="hide-on-small-only"><div class="fb-like" data-href="https://facebook.com/upescsi" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div></li>
                            <li class="hide-on-large-only"><div class="fb-like" data-href="https://facebook.com/upescsi" data-layout="standard" data-action="like" data-show-faces="false" data-share="false"></div></li>
                        </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                Developed and Maintained by UPES-CSI Student Chapter  &copy; 2015-2016
                <a class="grey-text text-lighten-4 right" href="http://materializecss.com/" target="_blank">Developed using materializecss</a>
            </div>
        </div>
    </footer>
    <!--end Footer-->
</body>
<!--end of Body-->

<!--Begin of Script Section-->
	<script>
		$( document ).ready(function(){
			$(".button-collapse").sideNav();
		});
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
    <script>

        //responsive initialization
        $(".button-collapse").sideNav();

        //Tooltip initialization
        $(document).ready(function(){
            $('.tooltipped').tooltip({delay: 50});
        });

        //Modal Initialization
        $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal();
        });
    </script>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<!--End of Script Section-->
<!--Script to Clear Default-->
<script>/* 
 * Cross-browser event handling, by Scott Andrew
 */
function addEvent(element, eventType, lamdaFunction, useCapture) {
    if (element.addEventListener) {
        element.addEventListener(eventType, lamdaFunction, useCapture);
        return true;
    } else if (element.attachEvent) {
        var r = element.attachEvent('on' + eventType, lamdaFunction);
        return r;
    } else {
        return false;
    }
}

/* 
 * Kills an event's propagation and default action
 */
function knackerEvent(eventObject) {
    if (eventObject && eventObject.stopPropagation) {
        eventObject.stopPropagation();
    }
    if (window.event && window.event.cancelBubble ) {
        window.event.cancelBubble = true;
    }
    
    if (eventObject && eventObject.preventDefault) {
        eventObject.preventDefault();
    }
    if (window.event) {
        window.event.returnValue = false;
    }
}

/* 
 * Safari doesn't support canceling events in the standard way, so we must
 * hard-code a return of false for it to work.
 */
function cancelEventSafari() {
    return false;        
}

/* 
 * Cross-browser style extraction, from the JavaScript & DHTML Cookbook
 * <http://www.oreillynet.com/pub/a/javascript/excerpt/JSDHTMLCkbk_chap5/index5.html>
 */
function getElementStyle(elementID, CssStyleProperty) {
    var element = document.getElementById(elementID);
    if (element.currentStyle) {
        return element.currentStyle[toCamelCase(CssStyleProperty)];
    } else if (window.getComputedStyle) {
        var compStyle = window.getComputedStyle(element, '');
        return compStyle.getPropertyValue(CssStyleProperty);
    } else {
        return '';
    }
}

/* 
 * CamelCases CSS property names. Useful in conjunction with 'getElementStyle()'
 * From <http://dhtmlkitchen.com/learn/js/setstyle/index4.jsp>
 */
function toCamelCase(CssProperty) {
    var stringArray = CssProperty.toLowerCase().split('-');
    if (stringArray.length == 1) {
        return stringArray[0];
    }
    var ret = (CssProperty.indexOf("-") == 0)
              ? stringArray[0].charAt(0).toUpperCase() + stringArray[0].substring(1)
              : stringArray[0];
    for (var i = 1; i < stringArray.length; i++) {
        var s = stringArray[i];
        ret += s.charAt(0).toUpperCase() + s.substring(1);
    }
    return ret;
}

/*
 * Disables all 'test' links, that point to the href '#', by Ross Shannon
 */
function disableTestLinks() {
  var pageLinks = document.getElementsByTagName('a');
  for (var i=0; i<pageLinks.length; i++) {
    if (pageLinks[i].href.match(/[^#]#$/)) {
      addEvent(pageLinks[i], 'click', knackerEvent, false);
    }
  }
}

/* 
 * Cookie functions
 */
function createCookie(name, value, days) {
    var expires = '';
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        var expires = '; expires=' + date.toGMTString();
    }
    document.cookie = name + '=' + value + expires + '; path=/';
}

function readCookie(name) {
    var cookieCrumbs = document.cookie.split(';');
    var nameToFind = name + '=';
    for (var i = 0; i < cookieCrumbs.length; i++) {
        var crumb = cookieCrumbs[i];
        while (crumb.charAt(0) == ' ') {
            crumb = crumb.substring(1, crumb.length); /* delete spaces */
        }
        if (crumb.indexOf(nameToFind) == 0) {
            return crumb.substring(nameToFind.length, crumb.length);
        }
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, '', -1);
}
</script>
<script>
/*
 * Clear Default Text: functions for clearing and replacing default text in
 * <input> elements.
 *
 */

addEvent(window, 'load', init, false);

function init() {
    var formInputs = document.getElementsByTagName('input');
    for (var i = 0; i < formInputs.length; i++) {
        var theInput = formInputs[i];
        
        if (theInput.type == 'text' && theInput.className.match(/\bcleardefault\b/)) {  
            /* Add event handlers */          
            addEvent(theInput, 'focus', clearDefaultText, false);
            addEvent(theInput, 'blur', replaceDefaultText, false);
            
            /* Save the current value */
            if (theInput.value != '') {
                theInput.defaultText = theInput.value;
            }
        }
    }
}

function clearDefaultText(e) {
    var target = window.event ? window.event.srcElement : e ? e.target : null;
    if (!target) return;
    
    if (target.value == target.defaultText) {
        target.value = '';
    }
}

function replaceDefaultText(e) {
    var target = window.event ? window.event.srcElement : e ? e.target : null;
    if (!target) return;
    
    if (target.value == '' && target.defaultText) {
        target.value = target.defaultText;
    }
}
</script>
</html>
<?php
}
else
	echo "<script>alert('You Are Not Authorized Personnel For This Link!'); window.location= 'index.php';</script>";