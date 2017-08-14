<?php

require_once(__DIR__.DS.'helper.php');

class imagesField extends BaseField {
	static public $fieldname = 'images';
	static public $assets = array(
		'js' => array(
			'script.js'
		),
		'css' => array(
			'style.css'
		)
	);

	public function input() {
		$html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
			'field' => $this,
			'page' => $this->page()
		));
		return $html;
	}

	public function element() {
		$element = parent::element();
		$element->data('field', self::$fieldname);
		$element->addClass('field-with-images');
		return $element;
	}
	
	public function value() {
    $value = parent::value();
    return yaml::decode($value);
  }
    
  public function label() {
    return null;
  }
  
  public function headline() {
    
    
    $select = '<div class="images-dropdown">';
    if ($this->page()->hasImages()) {
      $select .= '<div class="filter-wrap">';
      $select .= '<i class="icon fa fa-search"></i>';
      $select .= '<input type="text" class="filter" placeholder="' . translation('search') . '"/>';
      $select .= '</div>';
      $select .= '<span class="no-images-found">' . translation('noImagesFound') . '</span>';
      $select .= '<span class="no-more-images">' . translation('noMoreImages') . '</span>';
    }
    else {
      $select .= '<span class="no-more-images no-images">' . translation('noImages') . '</span>';
    }
    foreach ($this->page()->images() as $image) {
      $disabled = "";
      if (in_array($image->filename(), $this->value())) $disabled = "disabled";
      $select .= '<a class="' . $disabled . '" data-filename="' . $image->filename() . '">';
      $select .= $image->crop(75,75)->html();
      $select .= '<span class="image">' . $image->filename() . '</span>';
      $select .= '</a>';
    }
    $select .= "</div>";
    
    $add = new Brick('div');
    $add->html('<i class="icon icon-left fa fa-plus-circle"></i>' . translation('select'));
    $add->addClass('images-add-button label-option');
  
    if(!$this->label) {
      $this->label = '&nbsp;';
    }
    
    $label = parent::label();
    $label->addClass('images-label');
    $label->append($add);
    $label->append($select);
    
    return $label;
  
  }
	
	
}