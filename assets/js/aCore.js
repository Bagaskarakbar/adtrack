// aCore.js, Averin Library based on X v3.15.4, Cross-Browser.com DHTML Library

var aVersion='3.15.4',aIE4Up,aIE4,aIE5,aIE6,aMoz,aUA=navigator.userAgent.toLowerCase();

if (document.all && aUA.indexOf('msie')!=-1) {
  aIE4Up=parseInt(navigator.appVersion)>=4;
  aIE4=aUA.indexOf('msie 4')!=-1;
  aIE5=aUA.indexOf('msie 5')!=-1;
  aIE6=aUA.indexOf('msie 6')!=-1;
}
else if (document.layers) {aNN4=true;}
aMoz=aUA.indexOf('gecko')!=-1;

function aDef() {
  for(var i=0; i<arguments.length; ++i){if(typeof(arguments[i])=='undefined') return false;}
  return true;
}

function aStr() {
  for(var i=0; i<arguments.length; ++i){if(typeof(arguments[i])!='string') return false;}
  return true;
}
function aNum() {
  for(var i=0; i<arguments.length; ++i){if(typeof(arguments[i])!='number') return false;}
  return true;
}

function aGetElementById(e) {
  if(typeof(e)!='string') return e;
  if(document.getElementById) e=document.getElementById(e);
  else if(document.all) e=document.all[e];
  else e=null;
  return e;
}

function aGetElementsByClassName(clsName, parentEle, tagName, fn)
{
  var found = new Array();
  var re = new RegExp('\\b'+clsName+'\\b', 'i');
  var list = aGetElementsByTagName(tagName, parentEle);
  for (var i = 0; i < list.length; ++i) {
    if (list[i].className.search(re) != -1) {
      found[found.length] = list[i];
      if (fn) fn(list[i]);
    }
  }
  return found;
}

function aGetElementsByTagName(tagName, parentEle)
{
  var list = null;
  tagName = tagName || '*';
  parentEle = parentEle || document;
  list = parentEle.getElementsByTagName(tagName);
  return list || new Array();
}

function aAddEvent(obj, evType, fn){ 
 if (obj.addEventListener){ 
   obj.addEventListener(evType, fn, true); 
   return true; 
 } else if (obj.attachEvent){
   var r = obj.attachEvent("on"+evType, fn); 
   return r; 
 } else { 
   return false; 
 } 
}

function aRemoveEvent(obj, evType, fn, useCapture){
  if (obj.removeEventListener){
    obj.removeEventListener(evType, fn, useCapture);
    return true;
  } else if (obj.detachEvent){
    var r = obj.detachEvent("on"+evType, fn);
    return r;
  } else {
    alert("Handler could not be removed");
  }
}

function aEvent(evt) // object prototype
{
  this.type = ''; this.target = null;
  var e = evt || window.event;
  if(!e) return;
  if(e.type) this.type = e.type;
  if(e.target) this.target = e.target;
  else if(e.srcElement) this.target = e.srcElement;
}

function getViewportHeight() {
	if (window.innerHeight!=window.undefined) return window.innerHeight;
	if (document.compatMode=='CSS1Compat') return document.documentElement.clientHeight;
	if (document.body) return document.body.clientHeight; 
	return window.undefined; 
}
function getViewportWidth() {
	if (window.innerWidth!=window.undefined) return window.innerWidth; 
	if (document.compatMode=='CSS1Compat') return document.documentElement.clientWidth; 
	if (document.body) return document.body.clientWidth; 
	return window.undefined; 
}

function aGetElementsByAttribute(sTag, sAtt, sRE, fn){
	var a, list, found = new Array(), re = new RegExp(sRE, 'i');
	list = aGetElementsByTagName(sTag);
	for (var i = 0; i < list.length; ++i) {
		a = list[i].getAttribute(sAtt);
		if (!a) {a = list[i][sAtt];}
		if (typeof(a)=='string' && a.search(re) != -1) {
			found[found.length] = list[i];
			if (fn) fn(list[i]);
		}
	}
	return found;
}

function aPageX(e) {
  if (!(e=aGetElementById(e))) return 0;
  var x = 0;
  while (e) {
    if (aDef(e.offsetLeft)) x += e.offsetLeft;
    e = aDef(e.offsetParent) ? e.offsetParent : null;
  }
  return x;
}
function aPageY(e) {
  if (!(e=aGetElementById(e))) return 0;
  var y = 0;
  while (e) {
    if (aDef(e.offsetTop)) y += e.offsetTop;
    e = aDef(e.offsetParent) ? e.offsetParent : null;
  }
//  if (xOp7) return y - document.body.offsetTop; // v3.14, temporary hack for opera bug 130324 (reported 1nov03)
  return y;
}

function aGetCS(ele,sP){return parseInt(document.defaultView.getComputedStyle(ele,'').getPropertyValue(sP));}
function aSetCW(ele,uW){
  var pl=0,pr=0,bl=0,br=0;
  if(aDef(document.defaultView) && aDef(document.defaultView.getComputedStyle)){
    pl=aGetCS(ele,'padding-left');
    pr=aGetCS(ele,'padding-right');
    bl=aGetCS(ele,'border-left-width');
    br=aGetCS(ele,'border-right-width');
  }
  else if(aDef(ele.currentStyle,document.compatMode)){
    if(document.compatMode=='CSS1Compat'){
      pl=parseInt(ele.currentStyle.paddingLeft);
      pr=parseInt(ele.currentStyle.paddingRight);
      bl=parseInt(ele.currentStyle.borderLeftWidth);
      br=parseInt(ele.currentStyle.borderRightWidth);
    }
  }
  else if(aDef(ele.offsetWidth,ele.style.width)){ // ?
    ele.style.width=uW+'px';
    pl=ele.offsetWidth-uW;
  }
  if(isNaN(pl)) pl=0; if(isNaN(pr)) pr=0; if(isNaN(bl)) bl=0; if(isNaN(br)) br=0;
  var cssW=uW-(pl+pr+bl+br);
  if(isNaN(cssW)||cssW<0) return;
  else ele.style.width=cssW+'px';
}
function aSetCH(ele,uH){
  var pt=0,pb=0,bt=0,bb=0;
  if(aDef(document.defaultView) && aDef(document.defaultView.getComputedStyle)){
    pt=aGetCS(ele,'padding-top');
    pb=aGetCS(ele,'padding-bottom');
    bt=aGetCS(ele,'border-top-width');
    bb=aGetCS(ele,'border-bottom-width');
  }
  else if(aDef(ele.currentStyle,document.compatMode)){
    if(document.compatMode=='CSS1Compat'){
      pt=parseInt(ele.currentStyle.paddingTop);
      pb=parseInt(ele.currentStyle.paddingBottom);
      bt=parseInt(ele.currentStyle.borderTopWidth);
      bb=parseInt(ele.currentStyle.borderBottomWidth);
    }
  }
  else if(aDef(ele.offsetHeight,ele.style.height)){ // ?
    ele.style.height=uH+'px';
    pt=ele.offsetHeight-uH;
  }
  if(isNaN(pt)) pt=0; if(isNaN(pb)) pb=0; if(isNaN(bt)) bt=0; if(isNaN(bb)) bb=0;
  var cssH=uH-(pt+pb+bt+bb);
  if(isNaN(cssH)||cssH<0) return;
  else ele.style.height=cssH+'px';
}



function aWidth(e,uW) {
  if(!(e=aGetElementById(e))) return 0;
  if (aNum(uW)) {
    if (uW<0) uW = 0;
    else uW=Math.round(uW);
  }
  else uW=-1;
  var css=aDef(e.style);
  if(css && aDef(e.offsetWidth) && aStr(e.style.width)) {
    if(uW>=0) aSetCW(e, uW);
    uW=e.offsetWidth;
  }
  else if(css && aDef(e.style.pixelWidth)) {
    if(uW>=0) e.style.pixelWidth=uW;
    uW=e.style.pixelWidth;
  }
  return uW;
}


function aHeight(e,uH) {
  if(!(e=aGetElementById(e))) return 0;
  if (aNum(uH)) {
    if (uH<0) uH = 0;
    else uH=Math.round(uH);
  }
  else uH=-1;
  var css=aDef(e.style);
  if(css && aDef(e.offsetHeight) && aStr(e.style.height)) {
    if(uH>=0) aSetCH(e, uH);
    uH=e.offsetHeight;
  }
  else if(css && aDef(e.style.pixelHeight)) {
    if(uH>=0) e.style.pixelHeight=uH;
    uH=e.style.pixelHeight;
  }
}

// experimenting with CSS1Compat:
function aClientWidth() {
  var w=0;
  if(document.compatMode == 'CSS1Compat' && !window.opera && document.documentElement && document.documentElement.clientWidth)
    w=document.documentElement.clientWidth;
  else if(document.body && document.body.clientWidth)
    w=document.body.clientWidth;
  else if(aDef(window.innerWidth,window.innerHeight,document.height)) {
    w=window.innerWidth;
    if(document.height>window.innerHeight) w-=16;
  }
  return w;
}
// experimenting with CSS1Compat:
function aClientHeight() {
  var h=0;
  if(document.compatMode == 'CSS1Compat' && !window.opera && document.documentElement && document.documentElement.clientHeight)
    h=document.documentElement.clientHeight;
  else if(document.body && document.body.clientHeight)
    h=document.body.clientHeight;
  else if(aDef(window.innerWidth,window.innerHeight,document.width)) {
    h=window.innerHeight;
    if(document.width>window.innerWidth) h-=16;
  }
  return h;
}
