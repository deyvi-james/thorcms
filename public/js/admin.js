(function($) {
    $(function() {
        // Auto init tabs
        $('li [data-toggle="tab"]:first').tab('show');
        
        //Slugable inputs
        $('input.sluggable').keyup(function(e){
            var _self = $(this);
            var _out = $(_self.attr('sluggable-output'));
            _out.each(function(){
                var _val = _out.val();
                if((_val===null) || (_val.length === 0) || _out.hasClass('initially-empty')){
                    _out.addClass('initially-empty').val($utils.slugize(_self.val()));
                }
            });
        });
    });
})(jQuery);