<?php echo $field->headline() ?>

<?php

  if ($field->value()) {
    $fieldImages = $field->value();
  }
  else {
    $fieldImages = array();
  }
  
  $pageImages = array();
  foreach ($page->images() as $image) {
    $pageImages[] = $image->filename();
  }
  
  
  foreach ($pageImages as $pageImage) {
    if (in_array($pageImage, $fieldImages)) {
      continue;
    }
    $fieldImages[] = $pageImage;
  }
  
?>

<input class="images" type="hidden" name="<?= $field->name() ?>" value="<?= implode(",", $field->value()) ?>">

<div class="files" data-api="<?php __($page->url('files')) ?>">

  <div class="empty">
    Noch keine Bilder hinzugefügt.
  </div>
    
  <div class="grid sortable">
      
     <?php
       foreach($fieldImages as $file):
       $file = $page->image($file);
       if (!$file) continue;
     ?><!--
    --><div class="grid-item <?php e(in_array($file->filename(), $field->value()), 'selected') ?>" data-image="<?php __($file->filename()) ?>">
         <figure title="<?php __($file->filename()) ?>" class="file">
           <a class="file-preview file-preview-is-<?php __($file->type()) ?>" href="<?php __($file->url('edit')) ?>">
             <img src="<?php __($file->crop(400, 266)->url()) ?>" alt="<?php __($file->filename()) ?>">
           </a>
           <figcaption class="file-info">
             <a href="<?php __($file->url('edit')) ?>">
               <span class="file-name cut"><?php __($file->filename()) ?></span>
               <span class="file-meta marginalia cut"><?php __($file->niceSize()) ?></span>
             </a>
           </figcaption>
           <nav class="file-options cf">
             <a class="btn btn-with-icon" href="<?php __($file->url('edit')) ?>">
               <?php i('pencil', 'left') ?><span><?php _l('files.index.edit') ?></span>
             </a>
             <a data-modal class="btn btn-with-icon remove" href="#remove">
               <?php i('minus-circle', 'left') ?>
             </a>
           </nav>
         </figure>
       </div><!--
    --><?php endforeach ?><!--
    
    --><div class="add">
      <div class="inner">
      </div>
    </div>
 
 </div>
  
</div>