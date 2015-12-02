(function ( $ ) {                
    $.fn.autotranslate = function(options) {
        var defaults = {
            selector: ".autotranslatable",
            selectorBtn: ".btn-translate",
            url: '/autotranslate',
            onTranslationStart : function() {},
            onTranslationFinish : function() {}                         
        };

        var settings = $.extend( {}, defaults, options );

        this.each(function() 
        {                    
            var elem = $(this);                    
            elem.find('.btn-translate').on('click', function(){
                if($(this).hasClass('active')) return;

                var sourceInput = elem.find('input,textarea');                   
                var sourceText = sourceInput.val();                                     

                if(sourceText !== ''){
                    var fromLocale = sourceInput.data('locale');                                                          
                    var requestsCompleteCount = 0;
                    var inputToTranslate = [];
                    $(settings.selector + ' [id$=' + sourceInput.data('name') + ']').each(function(){                                                                                                        
                            inputToTranslate.push(this);                                    
                    });                                         

                    var requestsCount = inputToTranslate.length - 1;
                    if(requestsCount){                                                                                    
                        elem.trigger('translationStart');                                                                                                                                                
                        $(inputToTranslate).each(function()
                        {                                    
                            var toLocale = $(this).data('locale');
                            var input = $(this);
                            if(toLocale !== fromLocale){                                
                                var data = {"text": sourceText, "to": toLocale, "from": fromLocale };                                
                                $.ajax({
                                    url: settings.url,
                                    method: "POST",                                    
                                    data: data,
                                    complete: function (data, textStatus) {                                        
                                        requestsCompleteCount++;                                            
                                        if(data.status == '200'){
                                            input.val(data.responseText);                                            
                                        }
                                        if(requestsCount === requestsCompleteCount){                                                
                                            elem.trigger("translationFinish");
                                        }
                                    } 
                                });
                            }                            
                        });
                    }
                }
            });

            elem.on('translationStart', function (e) {
                console.log('translationStart');
                $(e.target).find(settings.selectorBtn).addClass('active');                            
                $(e.target).find('i').addClass('fa-spin');
                settings.onTranslationStart.call(e);
            });

            elem.on('translationFinish', function (e) {
                console.log('translationFinish');
                $(e.target).find('i').removeClass('fa-spin');
                $(e.target).find(settings.selectorBtn).removeClass('active');                            
                settings.onTranslationFinish.call(e);
            });                                        

        });                                        
    };                                                                            
}( $ ));