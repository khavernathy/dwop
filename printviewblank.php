<html>
<head>
<title>DTSIwop - Blank Work Order Print View</title>
<link rel="stylesheet" type="text/css" href="css/printstyle.css">
<script language="Javascript1.2">
  
  function printpage() {
  window.print();
  }
  
</script>
</head>

<body onLoad="printpage();">

<?php
// We would only be on this page IF they have selected to view a BLANK WORK ORDER. NO DATA RETRIEVAL.

$blankspace = "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>";
?>

<!-- first main row (the image)... -->


<table border="0" class="main">
<tr><td style="text-align: center; border-bottom: 1px solid black" colspan="6"><img src="assets/dtsilogo_bigger.png" /></td>
</tr>

<!-- Second main row... -->

<tr class="first"><td class="bold">Client:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td></td>
    <td></td>
    <td class="bold" width="150">Phone Sys. Type:</td>
    <td class="normal"><?php echo $blankspace ?></td>
</tr>

<tr class="first"><td class="bold" rowspan="2">Address:</td>
    <td rowspan="2" class="normal"><?php echo $blankspace ?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>

<tr class="first"><td class="bold">City:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td class="bold">V.M. System Type:</td>
    <td class="normal"><?php echo $blankspace ?></td>
</tr>

<tr class="first"><td class="bold">State:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td class="bold">Zip:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td class="bold">Bronze Date:</td>
    <td class="normal"><?php echo $blankspace ?></td>
</tr>

<tr class="first"><td class="bold">Phone:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td class="bold">Fax:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td class="bold">Silver Date:</td>
    <td class="normal"><?php echo $blankspace ?></td>
</tr>

<tr class="first" id="borderbottom"><td class="bold">Original Inst. date:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td class="bold">Telco:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td class="bold">Telco date:</td>
    <td class="normal"><?php echo $blankspace ?></td>
</tr>

</table>
<!-- ENDED THAT TABLE third main row... -->

<table class="main" border="0">
<tr class="second"><td id="servorder" width="160">SERVICE ORDER #:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td></td>
    <td></td>
    <td class="bold">Billing note:</td>
    <td class="normal"><?php echo $blankspace ?></td>
</tr>

<tr class="second"><td class="bold">Order Date:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td class="bold">Request Date:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td class="bold">Request Time:</td>
    <td class="normal"><?php echo $blankspace ?></td>
</tr>

<tr class="second"><td class="bold">Order Contact:</td>
    <td class="normal"><?php echo $blankspace ?></td>
    <td class="bold" rowspan="3">Problem:</td>
    <td rowspan="3" colspan="2"><?php echo $blankspace ?></td>
</tr>

<tr class="second"><td class="bold">Notes:</td>
    <td class="normal"><?php echo $blankspace ?></td>
</tr>

<tr class="second"><td class="bold">CPU Version:</td>
    <td class="normal"><?php echo $blankspace ?></td>
</tr>

</table>
<!-- fourth main row. THIS IS THE PART THAT IS HANDWRITTEN-->

<table class="thickborder" cellpadding="0">

<tr class="boldital">
<td>Part #(s)</td>
<td>Equipment Description(s)</td>
<td style="text-align: center">Qty.</td>
<td style="text-align: center">Amount</td>
</tr>

<!-- 8 blank rows -->
<tr height="17"><td> </td><td> </td><td> </td><td> </td></tr>
<tr height="17"><td> </td><td> </td><td> </td><td> </td></tr>
<tr height="17"><td> </td><td> </td><td> </td><td> </td></tr>
<tr height="17"><td> </td><td> </td><td> </td><td> </td></tr>
<tr height="17"><td> </td><td> </td><td> </td><td> </td></tr>
<tr height="17"><td> </td><td> </td><td> </td><td> </td></tr>
<tr height="17"><td> </td><td> </td><td> </td><td> </td></tr>
<tr height="17"><td> </td><td> </td><td> </td><td> </td></tr>

<tr height="25">
    <td style="border:none; text-align: right; vertical-align: top; padding-right: 4px" colspan="2">
    <div id="tc">TECH COMMENTS:</div>
    </td>
	
    <td colspan="2" style="border-bottom: 1px solid black">
    </td>
</tr>

<tr height="25">
    <td style="border: none; text-align: right; padding-right: 4px" colspan="2">
    Sub Total
    </td>
	
    <td colspan="2" style="border-bottom: 1px solid black">
    </td>
</tr>

<tr height="25">
    <td style="border: none; text-align: right; padding-right: 4px" colspan="2">
    Tax
    </td>
	
    <td colspan="2">
    </td>
</tr>

<tr height="25">
    <td style="border: none; text-align: right; padding-right: 4px" colspan="2">
    Total
    </td>
	
    <td colspan="2">
    </td>
</tr>
</table>

<!-- END OF WRITTEN PART 1 -->

<p style="font-weight: bold; padding: 4px 0px 4px 14px; margin: 0px">  * FOLLOW-UP (if needed)</p>

<!-- BEGIN WORK DESCRIPTION TABLE -->

<table class="thickborder" cellpadding="0">
<tr height="20">
  <td style="font-weight: bold; font-style: italic">WORK DESCRIPTION:</td>
</tr>
<tr height="20">
  <td></td>
</tr>
<tr height="20">
  <td></td>
</tr>
<tr height="20">
  <td></td>
</tr>
<tr height="20">
  <td></td>
</tr>
<tr height="20">
  <td></td>
</tr>
</table>

<!-- FOR THE TIME CLOCK AND SIGS -->
<br />
<table style="width: 8.0in">

<tr style="width: 8.0in">
	<td><table class="thickborder_s" cellpadding="0">
	<tr style="text-align: center">
		<td>Date</td>
		<td>Time In</td>
		<td>Time Out</td>
		<td>Total Time</td>
	</tr>

	<!-- FOUR EMPTY ROWS -->

	<tr height="15"><td></td><td></td><td></td><td></td></tr>
	<tr height="15"><td></td><td></td><td></td><td></td></tr>
	<tr height="15"><td></td><td></td><td></td><td></td></tr>
	<tr height="15"><td></td><td></td><td></td><td></td></tr>

	<tr>
		<td colspan="2">Standard minimum</td>
		<td style="text-align: center">1 Hour</td>
		<td></td>
	</tr>

	<tr>
		<td colspan="2"></td>
		<td style="text-align: center">Total</td>
		<td></td>
	</tr>
	</table></td>
  

  <td><table>
    <tr>
	<td>
	<p class="sigs">TECH. OR REP. (PRINT):</p>
	<p class="sigs">________________________________________________</p>
	<p class="sigs">CUSTOMER SIGNATURE / APPROVAL ALL WORK
	VERIFIED AND COMPLETED:</p>
	<p class="sigs">________________________________________________</p>
	<p class="sigs">CUSTOMER PRINTED NAME</p>
	<p class="sigs">________________________________________________</p>
	</td>
	</tr>
  </table></td>
</tr>
</table>

<!-- FINALLY THE FOOTNOTE -->

<table style="width: 8.0in" cellpadding="0" border="0">
<tr><td>
<br />
<p id="footnote">36181 East Lake Rd.  Suite 260 Palm Harbor, Fl. 34685 - Ph. 727-451-4545, Fax 727-451-4545</p>
</td></tr>
</table>


<!-- ENDING PRINTABLE WORK ORDER -->
</table>
<br />


</body>
</html>