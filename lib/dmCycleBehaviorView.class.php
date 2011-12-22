<?php
/**
 * Description of dmCycleBehaviorView
 *
 * @author TheCelavi
 */
class dmCycleBehaviorView extends dmBehaviorBaseView {
    
    public function configure() {
        $this->addRequiredVar(array('pause', 'random', 'fx', 'easing', 'speed', 'timeout'));
    }

    protected function filterBehaviorVars(array $vars = array()) {
        $vars = parent::filterBehaviorVars($vars);        
        return $vars;
    }
    
    public function getJavascripts() {
        return array_merge(
            parent::getJavascripts(),            
            array(
                'lib.easing',                
                'dmCycleBehaviorPlugin.cycle',
                'dmCycleBehaviorPlugin.launch'
            )
        );
    }    
    
}
