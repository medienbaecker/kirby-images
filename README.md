# Kirby Images v0.1.6

**This field is still in development and not quite ready yet.**

The `images` field can be used to edit groups of images very easily by drag-and-drop. Simply take an image from the sidebar and drop it on the field. You can also reorder images inside the field, not linked to the regular order.

## Installation

Put the `kirby-images` folder into your `site/plugins` folder and rename it to `images`.

## Example

![Preview](images.gif)

```yaml
slideshow:
  label:       Slideshow
  type:        images
```

## Template

To display an image slideshow with the selected images you can use a code like this:

```php
<div class="slider">
<?php foreach($page->slideshow()->yaml() as $image): ?>   
  <?php if($image = $page->image($image)): ?>
    <?= $image->crop(1200,500)->html(); ?>  		    
  <?php endif ?>
<?php endforeach; ?>
</div>
```

## Drag between multiple instances

You can even move images between multiple instances of the `images` field like this:

![Drag](drag.gif)
