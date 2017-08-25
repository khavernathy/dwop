<?php
function displayMenu() 
{
	global $version;
	?>
	<div class="main">
	<h1 style="text-align: center">Welcome to the DTSI Work Order Program</h1>
	<h3 style="text-align: center">DTSIwop v<?php echo $version; ?></h3>
	<basefont face="Courier New, Courier, monospace" id="mainfont" size="12" />
	<!--
	do not change font
	-->
	<center><img src="assets/dtsilogo.png" alt="DTSI" title="DTSI" /></center>
	
	
	<table cellpadding="1" cellspacing="0" width="100%" style="background-color: #DDDDDD; border-width: 2px 0px; border-color: black; border-style: double;">
	<tr>
	<td style="padding-left: 20px; width: 50%">
	<h2>Main Menu</h2>
	<ul>
	  <li><a href="create.php">Create</a> new work order.</li>
	  <li><a href="edit.php">Edit/View</a> a previous work order.</li>
	  <li><a href="view.php">Print</a> previous work orders.</li>
	  <li><a href="email.php">E-mail</a> invoices.</li>
	  <li><a href="editcust.php">Manage</a> Customers</li>
	  <li><a href="deleteentry.php">Delete</a> an entry</li>
	  <li><a href="index.php?logout=go">Log out</a></li>
	
	</ul>
	</td>
	
	<td style="padding-left: 20px; width: 50%">
	<h2>Helpful links</h2>
	<ul>
	  <li><a href="http://www.getdtsi.com">DTSI Website</a></li>
	  <li><a href="watch_tutorial.php" target="_blank">DTSIwop Tutorial (v2.5)</a></li>
	  <li><a href="http://www.nec.com">NEC Website</a></li>
	  <li><a href="http://www.getdtsi.com/media/ux5000/main.html">Interactive UX5000 Tutorial</a></li>
	  <li><a href="http://www.getdtsi.com/media/interactive_aspire/main.swf">Interactive Aspire Tutorial</a></li>
	  <li><a href="http://www.getdtsi.com/media/flash_aspire_intramail/main.swf">Interactive Aspire Voicemail Tutorial</a></li>
	
	</ul>
	</td>
	</tr>
	</table>
	<br />
	
	<div class="footer">DTSIwop was created by <a href="mailto:khaverim7@gmail.com">Douglas Franz</a></div>
	<div class="footer"><a href="../">[Back to DTSI home page]</a></div>
	
	</div>
	<?php 
}

function displayLogin($login_message = '') 
{
	global $version;
	?>
	<div class="main">
	<h1 style="text-align: center">Welcome to the DTSI Work Order Program</h1>
	<h3 style="text-align: center">DTSIwop v<?php echo $version; ?></h3>
	<center><img src="assets/dtsilogo.png" alt="DTSI" title="DTSI" /></center>
	
	<br /><br />
	
	<div style="text-align: center">
	<form action="<?php $_SERVER[PHP_SELF] ?>" method="POST">
	<!-- <address dir="rtl">58643 enaL tekcihT gatS 8445</address> -->
	<?php
	if (isset($_GET['timeout']))
	{ 
		echo "Session timed out.";
		print "<br />";
	}
	
	if (isset($_GET['unauthorized']))
	{ 
		echo "You must login to access that page.";
		print "<br />";
	}
	echo $login_message ?><br /><input type="password" name="password" style="border: 1px solid black"><input type="submit" value="go">
	</form>
	</div>
	
	<br /><br />
	<br /><br />
	<br /><br />
	<br />
	
	
	<div class="footer">DTSIwop was created by <a href="mailto:khaverim7@gmail.com">Douglas Franz</a></div>
	<div class="footer"><a href="../">[Back to DTSI home page]</a></div>
	
	</div>
	<?php 
}
?>
