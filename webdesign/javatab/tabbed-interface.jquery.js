(function($){
 $.fn.tabbed_interface = function(options) {

  var defaults = {
   switch_duration: 500,
   auto_switch: true,
   auto_switch_delay: 2000
  };

  var options = $.extend(defaults, options);

  return this.each(function(el) {

   el = this;

   $(el).children('ul').children('li').children('a').click(function(){

    $(el).children('div').fadeOut(options.switch_duration/2).
     filter(this.hash).fadeIn(options.switch_duration/2);

    $(el).children('ul').children('li').children('a').removeClass('active').
     filter(this).addClass('active');

    return false;

   });

   $(el).children('div').css('position','absolute').not(':first').hide();

   if(options.auto_switch)
   {
    $(el).bind('tabTimer',function(){

     setTimeout(function(){

      var my_id =
       $(el).children('div').not(':hidden').next().attr('id') ||
       $(el).children('div').not(':hidden').siblings('div').first().attr('id');

       $(el).children('ul').children('li').children('a[href="#'+my_id+'"]').click();

       $(el).trigger('tabTimer');

     },options.auto_switch_delay);

    }); $(el).trigger('tabTimer');
   }

  });

 };
})(jQuery);