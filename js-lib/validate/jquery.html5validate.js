 $.fn.ownFormValidate = function(options) {
    options = $.extend({
        classError             : 'invalid',
        classOk                : 'valid',
        initialValid           : true,
        parentElement          : '',
        showValidOnCheck       : false
    }, options);        
                
        
    var testInputText = function($input, showValid) {
        $object = (options.parentElement!='')?$input.parents(options.parentElement) : $input;
        
        if ($input.attr('pattern')!=undefined) {                
            var reg = new RegExp($input.attr('pattern'), 'gi');
            if (!reg.test($input.val())) {
                $object.removeClass(options.classOk).addClass(options.classError);                    
                return false;
            } else {
                if (showValid) {
                    $object.removeClass(options.classError).addClass(options.classOk);
                }
                return true;
            }                
        } else {
            if ($input.val()=='') {            
                $object.removeClass(options.classOk).addClass(options.classError);
                return false;
            } else {
                if (showValid) {
                    $object.removeClass(options.classError).addClass(options.classOk);
                }
                return true;
            }
        }
    }    
    
    var testInputEmail = function($input, showValid) {
        var wzorMaila = /^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,3}$/

        $object = (options.parentElement!='')?$input.parents(options.parentElement) : $input;

        if (!wzorMaila.test($input.val())) {
            $object.removeClass(options.classOk).addClass(options.classError);
            return false;
        } else {
            if (showValid) {
                $object.removeClass(options.classError).addClass(options.classOk);
            }
            return true;
        }    
    }
    
    var testInputURL = function($input, showValid) {
        $object = (options.parentElement!='')?$input.parents(options.parentElement) : $input;

        if ($input.val().indexOf('http://')!==0) {
            $object.removeClass(options.classOk).addClass(options.classError);
            return false;
        } else {
            if (showValid) {
                $object.removeClass(options.classError).addClass(options.classOk);
            }
            return true;
        }    
    }
    
    var testInputSelect = function($select, showValid) {
        $object = (options.parentElement!='')?$select.parents(options.parentElement) : $select;

        if ($select.children('option:selected').val()=='') {
            $object.removeClass(options.classOk).addClass(options.classError);
            return false;
        } else {
            if (showValid) {
                $object.removeClass(options.classError).addClass(options.classOk);                    
            }
            return true;
        }
    }

   var testRadio = function($input, showValid) {

        var name = $input.attr('name');
        var $group = $form.find('input[name="'+name+'"]');
        $object = (options.parentElement!='')?$input.parents(options.parentElement) : $group;

        if (!$group.filter(':checked').length) {
            $object.removeClass(options.classOk).addClass(options.classError);
            return false;
        } else {
            if (showValid) {
                $object.removeClass(options.classError).addClass(options.classOk);
            }
            return true;
        }
    };

    var testCheckbox = function($input, showValid) {

         $object = (options.parentElement!='')?$input.parents(options.parentElement) : $group;

         if (!$input.is(':checked')) {
            $object.removeClass(options.classOk).addClass(options.classError);
            return false;
         } else {
            if (showValid) {
                $object.removeClass(options.classError).addClass(options.classOk);
            }
            return true;
        }
    };		
    
    var $form = $(this);

    var prepareElements = function() {
        $form.find('input[required], textarea[required], select[required]').each(function() {
            var $t = $(this);
            $t.removeAttr('required');
            $t.addClass('required');

            if ($t.is('input')) {
                var type = $t.attr('type').toLowerCase();
                if (type == 'email') {
                    $t.on('blur keyup', function() {testInputEmail($t, true)});
                    if (options.initialValid) testInputEmail($t, options.showValidOnCheck)
                }
                if (type == 'url') {
                    $t.on('blur keyup', function() {testInputURL($t, true)});
                    if (options.initialValid) testInputURL($t, options.showValidOnCheck);
                }
                if (type == 'text') {
                    $t.on('blur keyup', function() {testInputText($t, true)});
                    if (options.initialValid) testInputText($t, options.showValidOnCheck)
                }
                if (type == 'checkbox') {                
                    $t.on('click', function() {testCheckbox($t, true)});                
                    if (options.initialValid) testCheckbox($t, options.showValidOnCheck)
                }
                if (type == 'radio') {                
                    $t.on('click', function() {testRadio($t, true)});                
                    if (options.initialValid) testRadio($t, options.showValidOnCheck)
                }
            }
            if ($t.is('textarea')) {
                $t.on('blur keyup', function() {testInputText($t, true)});
                if (options.initialValid) testInputText($t, options.showValidOnCheck)
            }
            if ($t.is('select')) {
                $t.on('change keyup', function() {testInputSelect($t, true)});
                if (options.initialValid) testInputSelect($t, options.showValidOnCheck)
            }
        });        
    }
    prepareElements();

    $form.submit(function() {
        prepareElements();

        var validated = true;
        var $inputs = $form.find('.required');
        $inputs.each(function() {
            var $t = $(this);                
            if ($t.is('input')) {
                if ($t.attr('type').toLowerCase() == 'email') {
                    if (!testInputEmail($t, options.showValidOnCheck)) validated = false;
                }
                if ($t.attr('type').toLowerCase() == 'url') {
                    if (!testInputURL($t, options.showValidOnCheck)) validated = false;
                }
                if ($t.attr('type').toLowerCase() == 'text') {
                    if (!testInputText($t, options.showValidOnCheck)) validated = false;
                }
                if ($t.attr('type').toLowerCase() == 'checkbox') {
                    if (!testCheckbox($t, options.showValidOnCheck)) validated = false;
                }
                if ($t.attr('type').toLowerCase() == 'radio') {
                    if (!testRadio($t, options.showValidOnCheck)) validated = false;
                }
            }
            if ($t.is('textarea')) {
                if (!testInputText($t, false)) validated = false;
            }
            if ($t.is('select')) {
                if (!testInputSelect($t, options.showValidOnCheck)) validated = false;
            }
        });
        return validated;
    });
    
}

$(function() {
    $('.posttype-form').ownFormValidate({
        classError             : 'invalid',
        classOk                : 'valid',
        initialValid           : true,
        parentElement          : '.form_box',
        showValidOnCheck       : true
    });
});
