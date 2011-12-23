<?php
/**
 * Description of dmCycleBehaviorForm
 *
 * @author TheCelavi
 */
class dmCycleBehaviorForm extends dmBehaviorBaseForm {
    
    protected $animation = array(
        'fade' => 'Fade',
        'blindX' => 'Blind X',
        'blindY' => 'Blind Y',
        'blindZ' => 'Blind Z',
        'cover' => 'Cover',
        'curtainX' => 'Curtain X',
        'curtainY' => 'Curtain Y',        
        'fadeZoom' => 'Fade zoom',
        'growX' => 'Grow X',
        'growY' => 'Grow Y',        
        'scrollUp' => 'Scroll up',
        'scrollDown' => 'Scroll down',
        'scrollLeft' => 'Scroll left',
        'scrollRight' => 'Scroll right',
        'scrollHorz' => 'Scroll horizontal',
        'scrollVert' => 'Scroll vertical',
        'shuffle' => 'Shuffle',
        'slideX' => 'Slide X',
        'slideY' => 'Slide Y',
        'toss' => 'Toss',
        'turnUp' => 'Turn up',
        'turnDown' => 'Turn down',
        'turnLeft' => 'Turn left',
        'turnRight' => 'Turn right',
        'uncover' => 'Uncover',
        'wipe' => 'Wipe',
        'zoom' => 'Zoom',
        'none' => 'None'
    );
    
    public function configure() {
        $this->widgetSchema['inner_target'] = new sfWidgetFormInputText();
        $this->validatorSchema['inner_target'] = new sfValidatorString(array(
            'required' => false
        ));
        
        $this->widgetSchema['fx'] = new sfWidgetFormChoice(array(
            'choices'=>$this->getI18n()->translateArray($this->animation)
        ));
        $this->validatorSchema['fx'] = new sfValidatorChoice(array(
            'choices'=> array_keys($this->animation)
        ));
        
        $this->widgetSchema['easing'] = new dmWidgetFormChoiceEasing();
        $this->validatorSchema['easing'] = new dmValidatorChoiceEasing(array(
            'required' => true
        ));
        
        $this->widgetSchema['speed'] = new sfWidgetFormInputText();
        $this->validatorSchema['speed'] = new sfValidatorInteger(array(
            'min'=>0
        )); 
        
        $this->widgetSchema['timeout'] = new sfWidgetFormInputText();
        $this->validatorSchema['timeout'] = new sfValidatorInteger(array(
            'min'=>0
        )); 
        
        $this->widgetSchema['pause'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['pause'] = new sfValidatorBoolean();
        
        $this->widgetSchema['random'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['random'] = new sfValidatorBoolean();
        
        $this->getWidgetSchema()->setLabels(array(
            'fx'=>'Animation'
        ));
        
        $this->getWidgetSchema()->setHelps(array(
            'pause'=>'Will mouse over pause animation',
            'random'=>'Cycle elements randomly',
            'speed' => 'Speed of animation in ms',
            'timeout' => 'Time between transitions in ms'
        )); 
        
        if (!$this->getDefault('pause')) $this->setDefault ('pause', true);
        if (!$this->getDefault('random')) $this->setDefault ('random', false);
        if (!$this->getDefault('fx')) $this->setDefault ('fx', 'fade');
        if (!$this->getDefault('easing')) $this->setDefault ('easing', 'jswing');
        if (!$this->getDefault('speed')) $this->setDefault ('speed', 300);
        if (!$this->getDefault('timeout')) $this->setDefault ('timeout', 5000);
        
        parent::configure();
    }
    
}
