<?php 
defined('C5_EXECUTE') or die("Access Denied.");

$page = Page::getCurrentPage();

if($page instanceof Page) {
	$cID = $page->getCollectionID();
}
?>	
<?php if ($page->isEditMode()) {?>
  <div class="ccm-edit-mode-disabled-item">
  <div style="padding:8px 0px;">
    <p>
      <?php
        echo t('Vegas template is not shown when you on Edit mode.');
      ?>
    </p>
  </div>
</div>
<?php }?>
<?php    if (!empty($files) && !$page->isEditMode()) { ?>	
<?php
  $ou = $this->getBlockURL();
  $ou = str_replace("/packages/list_files_from_set", "/application", $ou);?>
  
    
<script src="<?php echo $ou ?>/templates/vegas/vegas.min.js"></script>
<script type="text/javascript">
	$(function() {
    $('body').vegas({
        slides: [
 	<?php 
	foreach($files as $f) {
		  
		$fv = $f->getApprovedVersion();
		
		// although the 'title' for a file is used for display,
		// the filename is retreived here so we can always get a file extension
		$filename = $fv->getFileName();
		$ext =  pathinfo($filename, PATHINFO_EXTENSION);
    $url = $f->getURL();

		// if you wish to directly link to the file, logging, etc,
		// use instead of the above line:  $url = $fv->getURL();
		
		// if we are overriding the filename (e.g. showing only 1 file)
		
			// get the title of the file. This default to the filename on uploading, but can be changed 
			// through the file manager.
			
			$title = $f->getTitle();
			
			// want to always use the filename and not the title?  uncomment line below
			// $title = $filename;
			
			// removes or puts in brackets the file extension
		 	// if you want to add more information about a file (e.g. description, download count)
		 	// look up in the API the functions for a File object and FileVersion object ($f and $fv in above code)

			
		?>
	 
		

                { src: '<?php echo $url;?>' }<?php if(!($f === end($files))):?>,<?php endif;?>


<?php    }	?>
            ]
        });
    });
</script>

<?php    }	?>


<!--
<?php    if (empty($files) && $noFilesMessage) { ?>
<p><?php    echo $noFilesMessage; ?></p>
<?php    } ?>
-->
