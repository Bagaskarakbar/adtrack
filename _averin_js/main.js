/*
###########################################################################
File main.js terdiri dari :
- KOLEKSI ELEMEN
- VARIABEL GLOBAL
- FUNGSI UTAMA
- FUNGSI YANG MENGATUR LAYOUT
- FUNGSI MENU
- FUNGSI TAB
- FUNGSI TABLE
- FUNGSI LAIN-LAIN

###########################################################################
*/

// ########################################################################
// KOLEKSI ELEMEN

// ########################################################################
// VARIABEL GLOBAL

var replaceIs
var jsdebug = false

// variable kerangka
var headerHeight = 61;
var modulHeaderHeight = 97;
var totalHeader

// variable halaman
var isiBawahHeight = 0

// variable menu utama
var siMnuAnak = new Array();
var mnuWasKlik
var setExpInterval
var setCollInterval
var siElemClicked

//variable tab
var tabOn

//variable table
var tblUtama
var currRow = -1;

//variable popUp
var newWindow
var winDebug
var winDebugLoaded

//variable Note
var siNote = new Array()
var waktu = new Date()

//variable Form
var highlightcolor="#FFFFCC"
var ns6=document.getElementById&&!document.all
var previous=''
var eventobj
//Regular expression to highlight only form elements
var intended=/INPUT|TEXTAREA|OPTION/

//variabel ROOTWWW = http://nama.server
var HTTPPATH=location.protocol + '//' + location.host;
// ########################################################################
// FUNGSI UTAMA

function initKerangka(){
	if(aGetElementById("mnuUtama")) adjustMenu();
	if(!aGetElementById("modulHeader")) modulHeaderHeight = 0;
	totalHeader = headerHeight+modulHeaderHeight;
	if (aGetElementById("modul")){
		var modultr = aGetElementById("modul").getElementsByTagName("TR");
		modultr[modultr.length - 1].className = "modulTutup";
	}
	adjustLayoutKerangka();
	aAddEvent(window, 'resize', adjustLayoutKerangka);
}



function hasClass(obj) {
	var result = false;
	if (obj.getAttributeNode("class") != null) {
	 result = obj.getAttributeNode("class").value;
	}
	return result;
}   
function stripe(ev,od) {
	var tblcoll = document.getElementsByTagName("table");
	var i;
	//alert('i love u, muachhh...');
	for(i=0; i < tblcoll.length; i++){
		//alert(tblcoll[i].className);
		if (tblcoll[i].className=="tblUtama"){
			stripeMore(tblcoll[i],ev,od)
			
		}
	}
}

function stripeMore(tbl,ev,od) {

	var even = false;
	var evenColor = arguments[1] ? arguments[1] : "#fff";
	var oddColor = arguments[2] ? arguments[2] : "#000";

	var table = tbl;
	var tbodies = table.getElementsByTagName("tbody");
	
	for (var h = 0; h < tbodies.length; h++) {
		var trs = tbodies[h].getElementsByTagName("tr");
		
		for (var i = 0; i < trs.length; i++) {
			
			var mytr = trs[i];
			if (! hasClass(mytr) && ! mytr.style.backgroundColor) {
					mytr.style.backgroundColor = even ? evenColor : oddColor;
					//alert('hey');
					
			}
			even =  ! even;
		}
	}

}

function bartools(){
	var aColl = aGetElementById("barTools").getElementsByTagName("A")
	for (var i=0;i<aColl.length ; i++){
		if (aColl[i].className == "tool") aAddEvent(aColl[i], 'click', toolsAktif)
		if (aColl[i].className == "toolLaporan") aAddEvent(aColl[i],'click',toolsBuka)
		if (aColl[i].className == "toolCetak") aAddEvent(aColl[i],'click',toolsBukaCetak)
	}
}
/*
function bartools(){
	var aColl = aGetElementById("barTools").getElementsByTagName("A")
	for (var i=0;i<aColl.length ; i++){
		if (aColl[i].className == "tool") aAddEvent(aColl[i], 'click', toolsAktif2)
		if (aColl[i].className == "toolLaporan") aAddEvent(aColl[i],'click',toolsBuka)
		if (aColl[i].className == "toolCetak") aAddEvent(aColl[i],'click',toolsBukaCetak)
	}
}
*/
function toolsAktif(evt) {
	var e = new aEvent(evt);
	var siElem = e.target;
	openTools(siElem.href)
	return false
}

function toolsAktif2(evt){
	var e = new aEvent(evt);
	var siElem = e.target;
	//alert(e.target.href);
	openPop2(siElem);
	return false;
}

function openTools(url) {
	//var wTop = (screen.availHeight-480)/2
	//var wLeft = (screen.availWidth-640)/2
	//newWindow = window.open(url, "win", "top=5000,left=5000,height=480,width=640,location=no,menubar=no,scrollbars=no,titlebar=no,toolbar=no,resizable=yes")
	newWindow = window.open(url, "win", "top=5000,left=5000,height=480,width=640,location=no,menubar=yes,scrollbars=yes,titlebar=no,toolbar=yes,resizable=yes")
	//aAddEvent(window, 'unload', closeTools)

	//window.open(url,winNama,"menubar=yes,copyhistory=no,status=no,resizable=yes,toolbar=yes,location=no,width="+lebar+",height="+tinggi+",left="+left+",top="+top);

}

function toolsBuka(evt){
	var e = new aEvent(evt);
	var siElem = e.target;
	openReport(siElem.href);
	return false;
}

function openReport(url){
	newWindow = window.open(url, "win", "top=5000,left=5000,height=480,width=640,location=no,menubar=no,scrollbars=yes,titlebar=yes,toolbar=yes,resizable=yes,alwaysRaised=yes")
	aAddEvent(window, 'unload', closeTools)
}

function toolsBukaCetak(evt){
	var e= new aEvent(evt);
	var siElem = e.target;
	var wName =Date.parse(new Date());
	openPop3(siElem.href,wName,800,600);
	return false;
}

function openPop(url,tinggi,lebar) {
	var wHeight = tinggi ? tinggi : 480
	var wWidth = lebar ? lebar : 640
	var wTop = (screen.availHeight-wHeight)/2
	var wLeft = (screen.availWidth-wWidth)/2
	/*
	if (event.srcElement.parentNode.className=="hapus"){
		if (!confirm('Anda benar-benar ingin menghapus data ini ?')) return false
	}
	*/
	newWindow = window.open(url, "win", "top="+wTop+",left="+wLeft+",height="+wHeight+",width="+wWidth+",location=no,menubar=no,scrollbars=yes,titlebar=no,toolbar=no,resizable=yes")
	aAddEvent(window, 'unload', closeTools)
}

function closeTools() {if (newWindow) newWindow.close()}

// ########################################################################
// FUNGSI-FUNGSI YANG MENGATUR LAYOUT

function adjustLayoutKerangka(){
	aGetElementById("isiUtama").style.height = (getViewportHeight()-totalHeader) + "px"
	if (aGetElementById("modul")){
		if (aGetElementById("modul").offsetHeight < aGetElementById("isiUtama").offsetHeight){
			aGetElementById("modul").style.marginTop =
				((aGetElementById("isiUtama").offsetHeight - aGetElementById("modul").offsetHeight)/2) + "px"
		}else{
			aGetElementById("modul").style.marginTop = "10px"
		}
	}
}

function adjustLayoutHalaman(){

	if ((aGetElementById("isiUtama") && (!window.opener)) || aGetElementById("print") ) {
		var isiUtama = aGetElementById("isiUtama")
		if(aGetElementById("isiBawah")) isiBawahHeight = aGetElementById("isiBawah").offsetHeight;
		isiUtama.style.height = (getViewportHeight() - ((isiUtama.offsetTop + isiBawahHeight)+1)) + "px"
	}
	if ((aGetElementById("isiUtama") && (window.opener))) {
		var isiUtama = aGetElementById("isiUtama")
		if(aGetElementById("isiBawah")) isiBawahHeight = aGetElementById("isiBawah").offsetHeight;
		isiUtama.style.height = (getViewportHeight() - ((isiUtama.offsetTop + isiBawahHeight)+1)) + "px"
	}
	if(tblUtama) setTimeout("adjustTable()", 10);
	
}



// ########################################################################
// FUNGSI MENU

function adjustMenu() {

	var siMnuAnakRaw = aGetElementById("mnuUtama").childNodes;
	for (var i = 0; i < siMnuAnakRaw.length; i++){
		if ( (siMnuAnakRaw[i].nodeType != 3) && (siMnuAnakRaw[i].nodeType != 8) ){
			siMnuAnak[siMnuAnak.length] = siMnuAnakRaw[i]
		}
	}
	
	var adjmoz = aMoz? 2 : 0

	for (var j=0; j < siMnuAnak.length; j++ ){
		if(siMnuAnak[j]) siMnuAnak[j].style.height = (siMnuAnak[j].getElementsByTagName("A")[0].offsetHeight - adjmoz) + 2 + "px"
		if(siMnuAnak[j+1]) siMnuAnak[j+1].style.top = (siMnuAnak[j].offsetTop + siMnuAnak[j].offsetHeight) + 1 + "px"

		if (siMnuAnak[j].getElementsByTagName("A")[0]) {
			var siA = siMnuAnak[j].getElementsByTagName("A")
			aAddEvent(siA[0], 'click', menuClick);
			for(k=1; k < siA.length ; k++ ){aAddEvent(siA[k], 'click', menuAnakClick);}
		}
	}

}

function menuAnakClick(evt){
	var e = new aEvent(evt);
	var siElem = e.target;

	if(siElemClicked) siElemClicked.className = "";
	siElem.className = "mnuAnakAct";
	siElemClicked = siElem;
}

function menuClick(evt) {
	var e = new aEvent(evt);
	var siElem = e.target;

	if (siElem.className == "mnuOrtu"){
		for (i=0; i<siMnuAnak.length ;i++ ){
			if((siMnuAnak[i]==siElem.parentNode) && (siElem.parentNode!=siMnuAnak[mnuWasKlik])) mnuInterval(i);
		}
	}
}
 
function mnuInterval(diKlik) {
	if(siMnuAnak[mnuWasKlik]) {
		siMnuAnak[mnuWasKlik].getElementsByTagName("A")[0].className = "mnuOrtu"
		setCollInterval = setInterval("mnuCollapse(" + diKlik + ")",1);
	}else{
		siMnuAnak[diKlik].getElementsByTagName("A")[0].className = "mnuOrtuAct"
		setExpInterval = setInterval("mnuExpand(" + diKlik + ")",10);
	}
}

function mnuCollapse(diKlik){  //collapse
	var adjMoz = aMoz? 2 : 0
	
	siMnuAnak[mnuWasKlik].style.height = ((siMnuAnak[mnuWasKlik].offsetHeight - adjMoz) - 10) + "px"
	
	for (var i = mnuWasKlik+1; i < siMnuAnak.length; i++){if(siMnuAnak[i]) siMnuAnak[i].style.top = (siMnuAnak[i].offsetTop - 10) + "px"}
	
	if (siMnuAnak[mnuWasKlik].offsetHeight <= siMnuAnak[mnuWasKlik].getElementsByTagName("A")[0].offsetHeight){
		clearInterval(setCollInterval);
		siMnuAnak[mnuWasKlik].style.height = siMnuAnak[mnuWasKlik].getElementsByTagName("A")[0].offsetHeight + 2
		if(siMnuAnak[mnuWasKlik+1]) var slisih = (siMnuAnak[mnuWasKlik].offsetTop + siMnuAnak[mnuWasKlik].offsetHeight + adjMoz + 1) - siMnuAnak[mnuWasKlik+1].offsetTop
		for (var i = mnuWasKlik+1; i < siMnuAnak.length; i++){
			if(siMnuAnak[i]) siMnuAnak[i].style.top = (siMnuAnak[i].offsetTop + slisih) + "px"
		}
		setExpInterval = setInterval("mnuExpand(" + diKlik + ")",10);
	}
}

function mnuExpand(diKlik){  //gerakin menu2 dibawah menu yg diKlik
	var maxTop = 0
	var adjMoz = aMoz? 2 : 0
	
	for (var i = 0 ; i < siMnuAnak[diKlik].childNodes.length; i++){
		if(siMnuAnak[diKlik].childNodes[i].nodeType == 1) maxTop = maxTop + siMnuAnak[diKlik].childNodes[i].offsetHeight
	}

	siMnuAnak[diKlik].style.height = (siMnuAnak[diKlik].offsetHeight-adjMoz) + 5 + "px"

	for (var i = diKlik+1 ; i < siMnuAnak.length; i++){
		var siTop = siMnuAnak[i].offsetTop + 5;
		siMnuAnak[i].style.top = siTop + "px"
	}

	if ((siMnuAnak[diKlik].offsetHeight) >= maxTop){
		var slisihTop = (siMnuAnak[diKlik].offsetHeight-adjMoz) - maxTop

		siMnuAnak[diKlik].style.height = maxTop + "px"

		for (var j = diKlik+1 ; j < siMnuAnak.length; j++){
			siMnuAnak[j].style.top = (siMnuAnak[j].offsetTop - slisihTop) + "px"
		}

		clearInterval(setExpInterval);
		mnuWasKlik = diKlik
	}

}

// ########################################################################
// FUNGSI TAB

function initInfo(){
	var divcoll = aGetElementById("infoItem").getElementsByTagName("DIV");
	var i,divInfo,divInfoTitle;

	for(i=0;i<divcoll.length;i++){
		divInfo = divcoll[i].innerHTML
		divInfoTitle = divcoll[i].title
		divcoll[i].innerHTML = ""
		var spanElem = document.createElement("span")
		spanElem.className = "kotakInfoIsi"
		spanElem.innerHTML = divInfo
		divcoll[i].parentNode.appendChild(spanElem)
		divcoll[i].innerHTML = divInfoTitle
	}
}


function tabAktif(evt) {
	var e = new aEvent(evt);
	var siElem = e.target;
		
	if((siElem.tagName=="A")&&(!siElem.disabled)){
		if (tabOn) tabOn.className=""
		siElem.className="tabAktif"
		tabOn = siElem
		window.frmIsiTab.location.replace(siElem.href);
	}

	return false;
}

function tabBegin() {
	if(!aGetElementById("item")) aGetElementById("barJudul").style.borderBottomWidth = "1"

	if(!tabOn){
		var aColl = aGetElementById("tab").getElementsByTagName("A");
		for (var i=0; i<aColl.length ; i++ ){if (aColl[i].className=="tabAktif") tabOn = aColl[i]}
	}
}


// ########################################################################
// FUNGSI TABLE

function scrollIsiUtama(){
	if (fixedTh.getElementsByTagName("TABLE")[0]){
	fixedTh.getElementsByTagName("TABLE")[0].style.left = -(aGetElementById("isiUtama").scrollLeft) +"px"
	}
}	

function initTable(){
	var siFixedTh = document.createElement("DIV")
	siFixedTh.id = "fixedTh"
	document.body.appendChild(siFixedTh)

	var siTable = tblUtama.cloneNode(false)
	var siTHead = tblUtama.getElementsByTagName("THEAD")[0].cloneNode(true)

	siTable.appendChild(siTHead)
	aGetElementById("fixedTh").appendChild(siTable)

	aAddEvent(tblUtama, "mouseover", onMouseOver)
	aAddEvent(tblUtama, "mouseout", onMouseOut)
	aAddEvent(aGetElementById("isiUtama"), "scroll", scrollIsiUtama)

	adjustTable()
}
currRow = -1;
function hilite(newRow){
	if (currRow != -1) currRow.className = "";
	if (newRow != -1) newRow.className = "rowOn";
	currRow = newRow;
} 

function onMouseOver(evt){
	var e = new aEvent(evt);
	var siElem = e.target;

	while (siElem.tagName != "TR" && siElem.tagName != "TABLE") siElem = siElem.parentNode;
	if(siElem.tagName != "TR") return;

	if (siElem.parentNode.tagName == "TBODY") hilite(siElem);
		else hilite(-1);
}

function onMouseOut(){hilite(-1);}
/*
function onMouseClick(evt){
	var e = new aEvent(evt);
	var siElem = e.target;

	//crawl up the tree to find the table row
	while (siElem.tagName != "TR" && srcElem.tagName != "TABLE") siElem = siElem.parentNode;
	if(srcElem.tagName != "TR") return;
	if(srcElem.rowIndex == 0 ) return;
	if (selRow != -1) selRow.runtimeStyle.backgroundColor = '';
	srcElem.className = "";
	selRow = srcElem;
	
	var oEvent 	= createEventObject();
	oEvent.selected = selRow;
	rowSelect.fire(oEvent);
}
*/
///////////////////////////////////////////////
var fixedTh;

function adjustTable(){

	fixedTh = aGetElementById("fixedTh")
	var thUtama = tblUtama.getElementsByTagName("TH")
	var thFixed = aGetElementById("fixedTh").getElementsByTagName("TH")

	fixedTh.getElementsByTagName("TABLE")[0].style.left = "0px"

	for ( var i=0; i < thUtama.length; i++ ){ thFixed[i].style.width = (thUtama[i].offsetWidth-10) + "px";}

	fixedTh.style.top = aGetElementById("isiUtama").offsetTop + "px"
	fixedTh.style.width = aGetElementById("isiUtama").clientWidth + "px"

	scrollIsiUtama()
}

// ########################################################################
// FUNGSI LAIN-LAIN

function notes(comment) {
	var collDiv = document.getElementsByTagName("DIV")
	var oDiv = document.createElement("div")
	oDiv.className = "note"
	oDiv.innerHTML = comment
	
	var noteDiv = document.body.appendChild(oDiv)
	siNote[siNote.length]=noteDiv
	
	if(siNote.length > 1){
		var editHeight = 0

		for (var i=1;i < siNote.length;i++ )
		{
			siNote[i].style.top = siNote[i-1].offsetTop + siNote[i-1].clientHeight
		}
	}
}

function note(sourcenya,notenya){
	if (jsdebug)
	{
	if (!winDebug){
		var wHeight = 200
		var wWidth = 250
		var wTop = (screen.availHeight-wHeight)-40
		var wLeft = (screen.availWidth-wWidth)-15
		winDebug = window.open("/_js/jsdebug.php", "jsdebug", "top="+wTop+",left="+wLeft+",height="+wHeight+",width="+wWidth+",location=no,menubar=no,scrollbars=yes,titlebar=no,toolbar=no,resizable=yes,status=no")
		aAddEvent(winDebug, 'unload', destroyWinDebug);
		aAddEvent(window, 'unload', closeWinDebug);
	}

	//cari metode paling aman tuk gantiin cara dibawah!
	while (!winDebug.document.body) {
	}

	var oDebugItem = winDebug.document.createElement("div")
	var oSrcErr = winDebug.document.createElement("div")
	var oNoteErr = winDebug.document.createElement("div")

	oDebugItem.className = "debugItem"
	oSrcErr.className = "srcErr"
	oNoteErr.className = "noteErr"

	if(sourcenya) {
		oSrcErr.innerHTML = sourcenya + " :"
	}else{
		oSrcErr.innerHTML = ""
	}
	oNoteErr.innerHTML = notenya

	oDebugItem.appendChild(oSrcErr)
	oDebugItem.appendChild(oNoteErr)

	winDebug.document.body.appendChild(oDebugItem)
	}
}

function destroyWinDebug(){
	winDebug = false;
}

function closeWinDebug(){
	if(winDebug) winDebug.close();
}

////////////////////////////////////////////////////////////////

// Fungsi konfirmasi
function konfirmasiForm() {
	return window.confirm("Anda benar-benar ingin menyimpan data ini ?");
}

// Fungsi validasi
function validasiForm(theElm, strOptional) {
	var i, j, inputArr, textAreaArr, selectArr, nameArr, bGotIt, bStop, rgx, bOptional, tempVal, theForm;
	rgx = / /gi;

	theForm = theElm.form;

	if (strOptional) {
		strOptional = strOptional.toString().replace(rgx, "");
		nameArr = strOptional.toString().split(",");
		bOptional = nameArr.length > 0;
	}

	inputArr = theForm.getElementsByTagName("input");
	textAreaArr = theForm.getElementsByTagName("textarea");
	selectArr = theForm.getElementsByTagName("select");

	if (inputArr) {
		for (i = 0; i < inputArr.length; i++) {
			tempVal = inputArr[i].value.toString().replace(rgx, "");
			if (((inputArr[i].getAttribute("type") == "text") || ((inputArr[i].getAttribute("type") == "file"))) && (!inputArr[i].disabled)) {
				if (inputArr[i].name.toString().replace(rgx, "") == "") continue;
				bGotIt = false;
				if (bOptional) {
					for (j = 0; j < nameArr.length; j++) {
						if (inputArr[i].getAttribute("name") == nameArr[j]) bGotIt = true;
					}
				}
				if ((!bGotIt) && (tempVal == "")) {
					alert("Data TEXT : " + inputArr[i].getAttribute("name") + " belum diisi!");
					inputArr[i].focus();
					return false;
				}
			} else
				continue;
		}
	}

	if (textAreaArr) {
		for (i = 0; i < textAreaArr.length; i++) {
			tempVal = textAreaArr[i].value.toString().replace(rgx, "");
			if (!textAreaArr[i].disabled) {
				if (textAreaArr[i].name.toString().replace(rgx, "") == "") continue;
				bGotIt = false;
				if (bOptional) {
					for (j = 0; j < nameArr.length; j++) {
						if (textAreaArr[i].getAttribute("name") == nameArr[j]) bGotIt = true;
					}
				}
				if ((!bGotIt) && (tempVal == "")) {
					alert("Data TEXTAREA : " + textAreaArr[i].getAttribute("name") + " belum diisi!");
					textAreaArr[i].focus();
					return false;
				}
			} else 
				continue;
		}
	}

	if (selectArr) {
		for (i = 0; i < selectArr.length; i++) {
			tempVal = selectArr[i].value.toString().replace(rgx, "");
			if (!selectArr[i].disabled) {
				if (selectArr[i].name.toString().replace(rgx, "") == "") continue;
				bGotIt = false;
				if (bOptional) {
					for (j = 0; j < nameArr.length; j++) {
						if (selectArr[i].getAttribute("name") == nameArr[j]) bGotIt = true;
					}
				}
				if ((!bGotIt) && (tempVal == "")) {
					alert("Data SELECT : " + selectArr[i].getAttribute("name") + " belum diisi!");
					selectArr[i].focus();
					return false;
				}
			} else 
				continue;
		}
	}

	return konfirmasiForm();
}


////////////////////////////////////////////////////////////////

function formatUang(num,koma) {
	var depan, belakang, hasil;

	belakang = num.toString().split(".");
	if (belakang.length > 1) 
		belakang = belakang[1];
	else
		belakang = "00";

	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
		num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	num = Math.floor(num/100).toString();
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
			num = num.substring(0,num.length-(4*i+3))+'.'+ num.substring(num.length-(4*i+3));

	depan = (((sign)?'':'-') + num);

	if (belakang.toString().length < 2) belakang = belakang + '0';
	
	if(isNaN(koma) || koma < 1){
		hasil = (depan + "," + belakang.toString().substr(0, 2));
	} else {
		hasil = depan;
	}

	return hasil
}


function initFocus() {
	if(top.newWindow) top.newWindow.focus()
	}

////////////////////////////////////////////////////////////////
function check_semua(elm) {
	var frm = elm.form;
	var checkboxes = GetElementsByAttribute('input', 'type', 'checkbox');
	for (i=1; i<checkboxes.length; i++) checkboxes[i].checked = elm.checked;
}
////////////////////////////////////////////////////////////////
function openPopLaporan(targetWindow) {
	var theWidth = 800;
	var theHeight = 800;
	var left = (screen.availWidth/2)-(theWidth/2);
	var top = (screen.availHeight/2)-(theHeight/2);
	window.open('about:blank',targetWindow,'menubar=yes,copyhistory=no,status=no,resizable=yes,toolbar=yes,location=no,width=830,height=700,left='+left+',top='+top);
}

function openPop2(url,nama,lebar,tinggi) {
	var winNama=new Date(); //generate buat nama window
	winNama=nama;
	
	var left = (screen.availWidth/2)-(lebar/2)
	var top = (screen.availHeight/2)-(tinggi/2)
	
	window.open(url,winNama,"menubar=yes,copyhistory=no,status=no,resizable=yes,toolbar=yes,location=no,scrollbars=yes,width="+lebar+",height="+tinggi+",left="+left+",top="+top);
}

function openPopLaporanBaru(targetWindow) {
	var theWidth = 800;
	var theHeight = 500;
	var left = (screen.availWidth/2)-(theWidth/2);
	var top = (screen.availHeight/2)-(theHeight/2);
	window.open('about:blank',targetWindow,'copyhistory=no,status=no,resizable=no,toolbar=yes,location=no,width=830,height=487,left='+left+',top='+top);
}

function bukaWin(url,w,h){
	var myWindow;
	var width = w;
	var height = h;
	var left = parseInt((screen.availWidth/2) - (width/2));
	var top = parseInt((screen.availHeight/2) - (height/2));
	var windowFeatures = "width=" + width + ",height=" + height + 
		",resizable,left=" + left + ",top=" + top + 
		",screenX=" + left + ",screenY=" + top;
	myWindow = window.open(url, "subWind", windowFeatures);
}
function bukaWinLaporan(url,w,h){
	var myWindow;
	var width = w;
	var height = h;
	var left = parseInt((screen.availWidth/2) - (width/2));
	var top = parseInt((screen.availHeight/2) - (height/2));
	var windowFeatures = "width=" + width + ",height=" + height + 
		",resizable=yes,toolbar=yes,left=" + left + ",top=" + top + 
		",screenX=" + left + ",screenY=" + top;
	myWindow = window.open(url, "subWind", windowFeatures);
}

function bukaWinLaporan2(url,w,h){
	var myWindow;
	var width = w ? w : 800;
	var height = h ? h : 600;
	var wName = Date.parse(new Date());
	var left = parseInt((screen.availWidth/2) - (width/2));
	var top = parseInt((screen.availHeight/2) - (height/2));
	var windowFeatures = "width=" + width + ",height=" + height + 
		",resizable=yes,toolbar=no,left=" + left + ",top=" + top + 
		",screenX=" + left + ",screenY=" + top;
	myWindow = window.open(url, wName, windowFeatures);
	return false;
}

function openPop3(url,nama,lebar,tinggi) {
	var wHeight = tinggi ? tinggi : 480;
	var wWidth = lebar ? lebar : 640;
	var wName = nama ? nama : Date.parse(new Date());
	var wTop = (screen.availHeight-wHeight)/2;
	var wLeft = (screen.availWidth-wWidth)/2;
	window.open(url,wName,"copyhistory=no,location=no,menubar=no,scrollbars=yes,titlebar=no,toolbar=no,status=no,resizable=yes,width="+wWidth+",height="+wHeight+",left="+wLeft+",top="+wTop);

	return false;
}

function openPop4(url,nama,lebar,tinggi) {
	var wHeight = tinggi ? tinggi : 800;
	var wWidth = lebar ? lebar : 1000;
	var wName = nama ? nama : Date.parse(new Date());
	var wTop = (screen.availHeight-wHeight)/2;
	var wLeft = (screen.availWidth-wWidth)/2;
	window.open(url,wName,"copyhistory=no,location=no,menubar=yes,scrollbars=yes,titlebar=no,toolbar=no,status=yes,resizable=yes,width="+wWidth+",height="+wHeight+",left="+wLeft+",top="+wTop);

	return false;
}
function buka(id){
	if(navigator.appName == 'Microsoft Internet Explorer'){
		document.getElementById([id]).style.display="block";
	}else{
		document.getElementById([id]).style.display="table-row";
	}
}

function tutup(id){
	document.getElementById([id]).style.display="none";
}

function currencyToNumeric(str, isFloat) {
	str = str.toString();
	var num = str.replace(/\./g, '');
	return (isFloat==undefined) ? parseInt(num.replace(/,/, '.')) : parseFloat(num.replace(/,/, '.')) ;
}

function numericToCurrency(str) {
	str = str.toString();
	var re = /(\d+)(\d{3})(,\d*)?/;
	while (re.test(str)) {
		str = str.replace(re, '$1.$2$3');
	}
	return str;
}
function formatCurrency(num) {
num = num.toString().replace(/\$|\,/g,'');
if(isNaN(num))
num = "0";
sign = (num == (num = Math.abs(num)));
num = Math.floor(num*100+0.50000000001);
cents = num%100;
num = Math.floor(num/100).toString();
if(cents<10)
cents = "0" + cents;
for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
num = num.substring(0,num.length-(4*i+3))+'.'+
num.substring(num.length-(4*i+3));
return (((sign)?'':'-') + num + ',' + cents);
}
////////////////////////////////////////////////////////////////
//Function to check whether element clicked is form element
function checkel(which){
	if (which.style&&intended.test(which.tagName)){
		if (ns6&&eventobj.nodeType==3)
			eventobj=eventobj.parentNode.parentNode
		return true
		}else
			return false
		}

//Function to highlight form element
function highlight2(e){
	eventobj=ns6? e.target : event.srcElement
		if (previous!=''){
			if (checkel(previous))
				previous.style.backgroundColor=''
				previous=eventobj
			if (checkel(eventobj))
				eventobj.style.backgroundColor=highlightcolor
			}
			else{
				if (checkel(eventobj))
				eventobj.style.backgroundColor=highlightcolor
				previous=eventobj
			}
}

//Tooltip

			
			function enableTooltips(siClass){
				var siA = aGetElementsByClassName(siClass)
				for(i=0;i<siA.length;i++){
					Prepare(siA[i]);
					}
				}

				function Prepare(el){
				el.onmouseover=showTooltip;
				el.onmouseout=hideTooltip;
				}

				function showTooltip(evt){

					var e = new aEvent(evt);
					var siElem = aGetElementsByClassName("tooltip",e.target.parentNode.parentNode)[0];


					var posx=0,posy=0;
					if(e==null) e=window.event;
						if(e.pageX || e.pageY){
							posx=e.pageX; posy=e.pageY;
							}
					else if(e.clientX || e.clientY){
						if(document.documentElement.scrollTop){
							posx=e.clientX+document.documentElement.scrollLeft;
							posy=e.clientY+document.documentElement.scrollTop;
							}
						else{
							posx=e.clientX+document.body.scrollLeft;
							posy=e.clientY+document.body.scrollTop;
							}
						}

					siElem.style.top=(posy-65)+"px";
					siElem.style.left=(posx+10)+"px";

					siElem.style.display="block";
				}

				function hideTooltip(evt){
					var e = new aEvent(evt);
					var siElem = aGetElementsByClassName("tooltip",e.target.parentNode.parentNode)[0];

					siElem.style.display="none";
				}

				
////////////////////////////////////////////////////////////////
//Function Input Dari Format IDR ex.32,98 ->32.98
function IDRnumericToCurrency(temi) {
				temi = temi.toString();
				temi = temi.replace(/\./g,'');
				temi = temi.replace(/\,/g,'.');
				temi = parseFloat(temi);
				
				return temi;
			}
////////////////////////////////////////////////////////////////
//PUNK 12/08/11 10:03:47
//Function Pembulatan dengan n belakang koma
//angka = angka masukan
//koma = digit belakang koma
function roundNumber(angka, koma) {
	var result = Math.round(angka*Math.pow(10,koma))/Math.pow(10,koma);
	return result;
}
////////////////////////////////////////////////////////////////
//PUNK-22/05/2012-12:46:07 
function trimJS(str){
	var	str = str.replace(/^\s\s*/, ''),
		ws = /\s/,
		i = str.length;
	while (ws.test(str.charAt(--i)));
	return str.slice(0, i + 1);
}
////////////////////////////////////////////////////////////////
//PUNK-21/06/2012-14:55:03 
function strtoupperJS(str){
return (trimJS(str)+'').toUpperCase();
}
////////////////////////////////////////////////////////////////
//PUNK-21/06/2012-15:06:30 
function ucfirstJS(str){
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}
////////////////////////////////////////////////////////////////
//WAHIDIN-27/09/2013
 function check_radio(radio)
  {
// memeriksa apakah radio button sudah ada yang dipilih
    for (i = 0; i < radio.length; i++)
    {
      if (radio[i].checked === true)
      {
        return radio[i].value;
      }
    }
   return false;
   }
/*
available window feature :
--------------------------------------------------------------------------------------------------------------------
|  Atrribute		|	NN	|	IE	|	Description														
--------------------------------------------------------------------------------------------------------------------
	alwaysLowered		4		n/a		Always behind all other browser windows. Signed script required.	
	alwaysRaised		4		n/a		Always in front of all other browser windows. Signed script required.
	channelMode			n/a		4		Show in theater mode with channel band.
	copyhistory			2		n/a		Copy history listing from opening window to new window. 
	dependent			4		n/a		Subwindow closes if the window that opened it closes.
	directories			2		3		Display directory buttons. 
	fullscreen			n/a		4		Display no titlebar or menus. 
	height				2		3		Window interior height in pixels.
	hotkeys				4		n/a		Disable menu keyboard shortcuts (except Quit and Security Info).
	innerHeight			4		n/a		Content region height. Signed script required for very small measures.
	innerWidth			4		n/a		Content region width. Signed script required for very small measures.
	left				6		4		Offset of window's left edge from left edge of screen. 
	location			2		3		Display Location (or Address) text field.
	menubar				2		3		Display menu bar (a menu bar is always visible on Mac, letting users hide or show some chrome at will). 
	outerHeight			4		n/a		Total window height. Signed script required for very small measures.
	outerWidth			4		n/a		Total window width. Signed script required for very small measures.
	resizable			2		3		Allow window resizing (always allowed in NN 4 and earlier on the Mac).
	screenX				4		n/a		Offset of window's left edge from left edge of screen. Signed script required to move window off screen. 
	screenY				4		n/a		Offset of window's top edge from top edge of screen. Signed script required to move window off screen. 
	scrollbars			2		3		Display scrollbars if document is too large for window.
	status				2		3		Display status bar.
	titlebar			4		n/a		Display titlebar. Set this value to no to hide the titlebar. Signed script required. 
	toolbar				2		3		Display toolbar (with Back, Forward, and other buttons).
	top					6		4		Offset of window's top edge from top edge of screen.
	width				2		3		Window interior width in pixels.
	z-lock				4		n/a		New window is fixed below browser windows. Signed script required.
----------------------------------------------------------------------------------------------------------------------
*/
////////////////////////////////////////////////////////////////