/* 
 * domTab.js 
 * version 2.2.OSC
 * FIXED FOR product-tabs
 * written by Chris Heilmann
 * more info: http://www.onlinetools.org/tools/domtab.php
*/

// Global variables
var currentTab,currentLink;

// Change if you want to use another class for highlighting
var tabHighlightClass='tabon'; 

function initTabs()
{
// change if you have another main navigation ids for tabbed or normal element id
	var navElement='mainnav1';
	var navElementTabbedId='mainnavtabbed1';
	
// pattern to check against to identify "back to menu" links
	var backToMenu=/#top/;

	var n,as,id,i,cid,linklength,lastlink,re;
	if(document.getElementById && document.createTextNode)
	{
		cid=window.location.toString().match(/#(\w.+)/);
		if (cid && cid[1])
		{
			cid=cid[1];
		}
		var n=document.getElementById(navElement);
		n.id=navElementTabbedId;
		n=document.getElementById(navElementTabbedId)
		var as=n.getElementsByTagName('a');
		for (i=0;i<as.length;i++)
		{
			as[i].onclick=function(){showTab(this);return false}
			//as[i].onkeypress=function(){showTab(this);return false}
			id=as[i].href.match(/#(\w.+)/)[1];
			if(!cid && i==0)
			{
				currentTab=id;
				currentLink=as[i];
			} else if(id==cid)
			{
				currentTab=id;
				currentLink=as[i];
			}
			if(document.getElementById(id))
			{
				linklength=document.getElementById(id).getElementsByTagName('a').length;
				if(linklength>0)
				{
					lastlink=document.getElementById(id).getElementsByTagName('a')[linklength-1]
					if(backToMenu.test(lastlink.href))
					{
						lastlink.parentNode.removeChild(lastlink);
					}
				}
				document.getElementById(id).style.display='none';
			}
			if(cid){window.location.hash='top';}
		}		


		if(document.getElementById(currentTab))
		{
			document.getElementById(currentTab).style.display='block';
		}
		re=new RegExp('\\b'+tabHighlightClass+'\\b');
		if(!re.test(currentLink.className))
		{
			currentLink.className=currentLink.className+' '+tabHighlightClass
		}
	}
}  
function showTab(o)
{
	var id;
	if(currentTab)
	{
		if(document.getElementById(currentTab))
		{
			document.getElementById(currentTab).style.display='none';
		}
		currentLink.className=currentLink.className.replace(tabHighlightClass,'')
	}
	var id=o.href.match(/#(\w.+)/)[1];
	currentTab=id;
	currentLink=o;
	if(document.getElementById(id))
	{
		document.getElementById(id).style.display='block';
	}
	var re=new RegExp('\\b'+tabHighlightClass+'\\b');
	if(!re.test(o.className))
	{
		o.className=o.className+' '+tabHighlightClass
	}
}

// If you need to call other scripts onload, change this call
//window.onload=initTabs;  	