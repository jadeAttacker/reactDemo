;(function($){
    $.fn.extend({
         "alertBgColor":function(options){
                return this.each(function(){/*each就代表着知行*/
                    options=$.extend({
                        odd:"odd",
                        even:"even",
                        selected:"selected"
                    },options);
                    $("tbody>tr:odd",this).addClass(options.odd);
                    $("tbody>tr:even",this).addClass(options.even);
                    $("tbody>tr",this).click(function(){
                        var hasSelected=$(this).hasClass(options.selected);//返回true，false
                        if (hasSelected) {
                            $(this).removeClass("selected")
                            .find(':checkbox').attr("checked",false);
                        }else{
                             $(this).addClass("selected")
                            .find(':checkbox').attr("checked",true);
                        }
                    })
                     $('tbody>tr:has(:checked)',this).addClass(options.selected);
                     return this;//返回的是调用这个函数的DOM元素
                })
               
         },
    })
})(jQuery)