<?php

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
    
    $select = "<select>";
    if ($this->page()->images()->count() > 0) {
      $select .= "<option disabled selected>" . l('fields.structure.add') . "</option>";
    }
    else {
      $select .= "<option disabled selected>" . l('pages.show.files.empty') . "</option>";
    }
    foreach ($this->page()->images() as $image) {
      $disabled = "";
      if (in_array($image->filename(), $this->value())) $disabled = "disabled";
      $select .= '<option ' . $disabled . ' data-filename="' . $image->filename() . '">' . $image->filename() . '</option>';
    }
    $select .= "</select>";
    
    $add = new Brick('div');
    $add->html('<i class="icon icon-left fa fa-plus-circle"></i>' . l('fields.structure.add') . $select);
    $add->addClass('images-add-button label-option');
  
    if(!$this->label) {
      $this->label = '&nbsp;';
    }
    
    $label = parent::label();
    $label->addClass('images-label');
    $label->append($add);
    
    return $label;
  
  }
	
	
}