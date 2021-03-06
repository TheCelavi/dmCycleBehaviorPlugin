(function($) {    
    
    var methods = {        
        init: function(behavior) {                       
            var $this = $(this), data = $this.data('dmCycleBehavior');
            if (data && behavior.dm_behavior_id != data.dm_behavior_id) { // There is attached the same, so we must report it
                alert('You can not attach cycle behavior to same content'); // TODO TheCelavi - adminsitration mechanizm for this? Reporting error
            };
            $this.data('dmCycleBehavior', behavior);
        },
        
        start: function(behavior) {  
            var $this = $(this);
            // Cycle does not have a good destroy method :(            
            // This is memory mess, so it would be convinient to have view behavior and admin behavior
            var $copy = $this.children().clone(true, true);
            $this.data('dmCycleBehaviorPreviousDOM', $this.children().detach());            
            $this.children().remove();
            $this.append($copy);
            $this.cycle(behavior);
        },
        stop: function(behavior) {
            var $this = $(this);
            $this.children().remove();
            $this.append($this.data('dmCycleBehaviorPreviousDOM'));
            $this.removeAttr('style');           
        },
        destroy: function(behavior) {            
            var $this = $(this);
            $this.data('dmCycleBehavior', null);
            $this.data('dmCycleBehaviorPreviousDOM', null)
        }
    };
    
    $.fn.dmCycleBehavior = function(method, behavior){
        
        return this.each(function() {
            if ( methods[method] ) {
                return methods[ method ].apply( this, [behavior]);
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( this, [method] );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.dmCycleBehavior' );
            }  
        });
    };

    $.extend($.dm.behaviors, {        
        dmCycleBehavior: {
            init: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmCycleBehavior('init', behavior);
            },
            start: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmCycleBehavior('start', behavior);
            },
            stop: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmCycleBehavior('stop', behavior);
            },
            destroy: function(behavior) {
                $($.dm.behaviorsManager.getCssXPath(behavior, true) + ' ' + behavior.inner_target).dmCycleBehavior('destroy', behavior);
            }
        }
    });
    
})(jQuery);