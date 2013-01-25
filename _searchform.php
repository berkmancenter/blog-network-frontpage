<form method="get" action="<?php echo bloginfo("home"); ?>">
<?php if (!isset($s)) { $ssval = "Search"; } else { $ssval = wp_specialchars($s, 1); } ?>
<input type="text" value="<?php echo $ssval; ?>" name="search" id="search" onblur="setTimeout('closeResults()',2000); if (this.value == '') {this.value = '<?php echo $ssval; ?>';}"  onfocus="if (this.value == '<?php echo $ssval; ?>') {this.value = '';}" />
</form>
