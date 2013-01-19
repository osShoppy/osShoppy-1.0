<?php //$Id: /catalog/install/templates/main_page.php ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title><?php echo PROJECT_VERSION ?></title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" type="text/css" href="templates/main_page/stylesheet.css">
</head>

<body>
<div id="pageHeader">
  <div><h3>
    <div style="float: right; padding-bottom: 20px; padding-top: 30px; padding-right: 15px; color: #666; font-weight: bold;"><a href="http://site.osshoppy.com" target="_blank">osShoppy Website</a> &nbsp;|&nbsp; <a href="http://support.osshoppy.com" target="_blank">Support</a> &nbsp;|&nbsp; <a href="http://forum.osshoppy.com" target="_blank">Forum</a> &nbsp;|&nbsp; <a href="http://docs.osshoppy.com" target="_blank">Documentatie </a></h3></div>
    <img src="images/osShoppy_logo.png" border="0" width="262" height="76" title="<?php echo PROJECT_VERSION ?>" style="margin: 10px 0px 5px 70px;" />
  </div>
</div>

<div id="pageContent">
<?php require('templates/pages/' . $page_contents); ?>
</div>

<div class="footerBlock">
<div class="pageFooter"><h4>
  Copyright &copy; 2012 <a href="http://osshoppy.com" target="_blank">osShoppy</a> (<a href="http://osshoppy.com/copyright" target="_blank">Copyright Policy</a>, <a href="http://osshoppy.com/trademark" target="_blank">Trademark Policy</a>)<br />osShoppy is gebaseerd op de structuur van <a href="http://oscommerce.com" target="_blank">osCommerce</a> en uitgegeven onder de <a href="http://fsf.org/licenses/gpl.txt" target="_blank">GNU General Public License</a>
</h4></div>
</div>
</body>
</html>
