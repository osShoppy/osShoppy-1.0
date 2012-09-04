/* $Id: /catalog/admin/includes/additional_images.js (1032) */
function XHConn()
{
  var xmlhttp, bComplete = false;
  try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); }
  catch (e) { try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }
  catch (e) { try { xmlhttp = new XMLHttpRequest(); }
  catch (e) { xmlhttp = false; }}}
  if (!xmlhttp) return null;
  this.connect = function(sURL, sMethod, sVars, fnDone)
  {
    if (!xmlhttp) return false;
    bComplete = false;
    sMethod = sMethod.toUpperCase();

    try {
      if (sMethod == "GET")
      {
        xmlhttp.open(sMethod, sURL+"?"+sVars, true);
        sVars = "";
      }
      else
      {
        xmlhttp.open(sMethod, sURL, true);
        xmlhttp.setRequestHeader("Method", "POST "+sURL+" HTTP/1.1");
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      }
      xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState == 4 && !bComplete)
        {
          bComplete = true;
          fnDone(xmlhttp);
        }
	  };
      xmlhttp.send(sVars);
    }
    catch(z) { return false; }
    return true;
  };
  return this;
}

function check_form(form_name) {

  var image_subdirectory = form_name.elements['image_subdirectory'].value;
  var products_image = form_name.elements['products_image'].value;
  var products_image_med = form_name.elements['products_image_med'].value;
  var products_image_pop = form_name.elements['products_image_pop'].value;
  
  image_subdirectory = escape(image_subdirectory);
  products_image = escape(products_image);
  products_image_med = escape(products_image_med);
  products_image_pop = escape(products_image_pop);

  image_subdirectory = image_subdirectory.replace("+", "%2B");
  products_image = products_image.replace("+", "%2B");
  products_image_med = products_image_med.replace("+", "%2B");
  products_image_pop = products_image_pop.replace("+", "%2B");

  image_subdirectory = image_subdirectory.replace("/", "%2F");
  products_image = products_image.replace("/", "%2F");
  products_image_med = products_image_med.replace("/", "%2F");
  products_image_pop = products_image_pop.replace("/", "%2F");

  var fnWhenDone = function (oXML) { 

	var i;
	var found_image = false;
    var image_status = oXML.responseXML.getElementsByTagName('image_status');
// for testing
//alert(oXML.responseText);

	for(i=0; ((i<image_status.length) && (found_image == false)); i++){ //length is the same as count($array)
//		id = image_status[i].getAttribute('id'); //Grabs the id attribute.
		name = image_status[i].getElementsByTagName('name')[0].childNodes[0].nodeValue;
		is_present = image_status[i].getElementsByTagName('is_present')[0].childNodes[0].nodeValue;
		if (is_present == 1) {
		  found_image = true;
		}
// for testing
//		alert("id=" + id + " name=" + name + " is_present=" + is_present);
	}
	
	if (found_image == true) {
	  if (confirm("This file already exists: " + name + ".\n\nClick OK to replace the file on the web site.\nClick Cancel to abort product save and select another file.\n\n") == true) {
	    form_name.submit();
	  }
	} else {
	  form_name.submit();
	}

  };

  var strosC = "";
  if (form_name.osCAdminID.value) {
    strosC = '&osCAdminID=' + escape(form_name.osCAdminID.value);
  }
  
  var myConn = new XHConn();
  if (!myConn) { 
    alert("XMLHTTP not available. Try a newer/better browser."); 
  } else {
// for testing
//window.location = "is_image_used.php?subdir=" + image_subdirectory + "&image1=" + products_image + "&image2=" + products_image_med + "&image3=" + products_image_pop + strosC;
//alert("is_image_used.php?subdir=" + image_subdirectory + "&image1=" + products_image + "&image2=" + products_image_med + "&image3=" + products_image_pop + strosC);
	myConn.connect("is_image_used.php", "GET", "subdir=" + image_subdirectory + "&image1=" + products_image + "&image2=" + products_image_med + "&image3=" + products_image_pop + strosC, fnWhenDone);
  }

  return false;
  
}

function check_form_add(form_name) {

  var image_subdirectory = form_name.elements['image_subdirectory'].value;
  var products_image = form_name.elements['thumb_images'].value;
  var products_image_med = form_name.elements['medium_images'].value;
  var products_image_pop = form_name.elements['popup_images'].value;
  
  image_subdirectory = escape(image_subdirectory);
  products_image = escape(products_image);
  products_image_med = escape(products_image_med);
  products_image_pop = escape(products_image_pop);

  image_subdirectory = image_subdirectory.replace("+", "%2B");
  products_image = products_image.replace("+", "%2B");
  products_image_med = products_image_med.replace("+", "%2B");
  products_image_pop = products_image_pop.replace("+", "%2B");

  image_subdirectory = image_subdirectory.replace("/", "%2F");
  products_image = products_image.replace("/", "%2F");
  products_image_med = products_image_med.replace("/", "%2F");
  products_image_pop = products_image_pop.replace("/", "%2F");

  var fnWhenDone = function (oXML) { 

	var i;
	var found_image = false;
    var image_status = oXML.responseXML.getElementsByTagName('image_status');
                
	for(i=0; ((i<image_status.length) && (found_image == false)); i++){ //length is the same as count($array)
//		id = image_status[i].getAttribute('id'); //Grabs the id attribute.
		name = image_status[i].getElementsByTagName('name')[0].childNodes[0].nodeValue;
		is_present = image_status[i].getElementsByTagName('is_present')[0].childNodes[0].nodeValue;
		if (is_present == 1) {
		  found_image = true;
		}
	}
	
	if (found_image == true) {
	  if (confirm("This file already exists: " + name + ".\n\nClick OK to replace the file on the web site.\nClick Cancel to abort product save and select another file.\n\n") == true) {
	    form_name.submit();
	  }
	} else {
	  form_name.submit();
	}

  };

  var strosC = "";
  if (form_name.osCAdminID.value) {
    strosC = '&osCAdminID=' + escape(form_name.osCAdminID.value);
  }
  
  var myConn = new XHConn();
  if (!myConn) { 
    alert("XMLHTTP not available. Try a newer/better browser."); 
  } else {
	myConn.connect("is_image_used.php", "GET", "subdir=" + image_subdirectory + "&image1=" + products_image + "&image2=" + products_image_med + "&image3=" + products_image_pop + strosC, fnWhenDone);
  }

  return false;
  
}
