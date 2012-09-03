<?php //$Id: /catalog/install/templates/main_page.php ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title><?php echo PROJECT_VERSION ?> :: Designed by Hilvy</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" type="text/css" href="templates/main_page/stylesheet.css">
</head>

<body>
<div id="pageHeader">
  <div><h3>
    <div style="float: right; padding-bottom: 20px; padding-top: 30px; padding-right: 15px; color: #666; font-weight: bold;"><a href="http://www.hilvy.nl" target="_blank">Hilvy Website</a> &nbsp;|&nbsp; <a href="http://www.hilvy.nl/support" target="_blank">Support</a> &nbsp;|&nbsp; <a href="http://www.hilvy.nl/documents" target="_blank">Documentatie </a></h3></div>
    <img src="images/osShoppy_logo.png" border="0" width="262" height="76" title="osShoppy v4.0 BETA" style="margin: 10px 0px 5px 70px;" />
  </div>
</div>

<div id="pageContent">
<?php require('templates/pages/' . $page_contents); ?>
</div>

<div class="footerBlock">
<div class="pageFooter"><h4>
  Copyright &copy; 2012 <a href="http://www.hilvy.nl" target="_blank">Hilvy</a> (<a href="http://www.hilvy.nl/about/copyright" target="_blank">Copyright Policy</a>, <a href="http://www.hilvy.nl/about/trademark" target="_blank">Trademark Policy</a>)<br />osShoppy is gebaseerd op de structuur van <a href="http://www.oscommerce.com" target="_blank">osCommerce</a> en uitgegeven onder de <a href="http://www.fsf.org/licenses/gpl.txt" target="_blank">GNU General Public License</a>
</h4></div>
</div>
</body>
</html>
