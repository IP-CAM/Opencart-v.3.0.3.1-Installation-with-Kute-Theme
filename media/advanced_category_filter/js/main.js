var AdvancedFilter = function(id_container, id_content, auto_scroll){
    this.container = $(id_container);
    this.container_content = $(id_content);
    this.auto_scroll = auto_scroll;
    this.xhr = null;
    this.init();

    this.popped();
};

AdvancedFilter.prototype.init = function(){
    this.onClickOption();
    this.initSlider();
}

AdvancedFilter.prototype.initSlider = function(){
    var self = this;
    // CATEGORY FILTER
    $(document).ready(function(){
        self.container.find('.slider-range-price').each(function(){
            var min             = $(this).data('min');
            var max             = $(this).data('max');
            var unit            = $(this).data('unit');
            var value_min       = $(this).data('value-min');
            var value_max       = $(this).data('value-max');
            var label_reasult   = $(this).data('label-reasult');
            var t               = $(this);
            self.sliderObj = $( this ).slider({
                range: true,
                min: min,
                max: max,
                values: [ value_min, value_max ],
                slide: function( event, ui ) {
                    var result = label_reasult +" "+ unit + ui.values[ 0 ] +' - '+ unit +ui.values[ 1 ];
                    t.closest('.slider-range').find('.amount-range-price').html(result);
                },
                change: function( event, ui ) {
                    self.filterNow();
                }
            });
        });
    });
}

AdvancedFilter.prototype.popped = function(){
    var popped = ('state' in window.history && window.history.state !== null), initialURL = location.href;

    $(window).bind('popstate', function (event) {
        // Ignore inital popstate that some browsers fire on page load
        var initialPop = !popped && location.href == initialURL;
        popped = true;
        if (initialPop) return;
    });
}

AdvancedFilter.prototype.onClickOption = function(){
    var self = this;
    this.container.find("input[name='category[]'], input[name='manufacturer[]'], input[name='option[]']").on("click", function(){
        self.filterNow();
    });
}

AdvancedFilter.prototype.getSelectedOption = function(element){
    var self = this;

    var selected = [];
    self.container.find("input[name='"+element+"[]']:checked").each(function(){
        if($(this).val()){
            selected.push($(this).val());
        }
    });

    return selected;
}

AdvancedFilter.prototype.filterNow = function(){
    var self = this;
    var category_ids = 'category_ids='+this.getSelectedOption('category').join(',');
    var manufacturer_ids = 'manufacturer_ids='+this.getSelectedOption('manufacturer').join(',');
    var option_ids = 'option_ids='+this.getSelectedOption('option').join(',');
    var prices_range = 'prices_range='+this.sliderObj.slider("values").join(',');

    if(this.xhr != null){
        this.xhr.abort();
    }

    var all_params = current_params + '&' + category_ids + '&' + manufacturer_ids + '&' + option_ids + '&' + prices_range;

    if(history.pushState) {
        history.pushState(null, null,   "?" + all_params);
    }

    this.xhr = $.ajax({
        type: 'GET',
        url: 'index.php',
        data: all_params + '&ajax',
        success: function(data){
            if(data){
                self.container_content.html(data);
            }else{
                self.container_content.html('No product.');
            }
            if(self.auto_scroll){
                $("body,html").animate({ scrollTop: self.container_content.offset().top - 60 }, 1000);
            }
        }
    });
}

$(document).ready(function(){
    var advanced_filter = new AdvancedFilter(".advanced_category_filter", ".view-product-list", true);
})


