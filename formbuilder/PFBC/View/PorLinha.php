<?php
namespace PFBC\View;

class PorLinha extends \PFBC\View {
	protected $class = "form-inline";

	public function render() {
		$this->_form->appendAttribute("class", $this->class);

		echo '<form', $this->_form->getAttributes(), '>';
		$this->_form->getErrorView()->render();

		$elements = $this->_form->getElements();
        $elementSize = sizeof($elements);
        $elementCount = 0;
        for($e = 0; $e < $elementSize; ++$e) {
			if (($e%2) == 0)
				echo "<br />";
			if($e > 0)
				echo '&nbsp;&nbsp;&nbsp; ';
            $element = $elements[$e];
			echo $this->renderLabel($element), ' ', $element->render(), $this->renderDescriptions($element);
			++$elementCount;
        }

		echo '</form>';
    }

	protected function renderLabel(\PFBC\Element $element) {
        $label = $element->getLabel();
        if(!empty($label)) {
			echo '<label for="', $element->getAttribute("id"), '">';
			if($element->isRequired())
				echo '<span class="required">* </span>';
			echo $label;	
			echo '</label>'; 
        }
    }
}	
