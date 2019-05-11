/**
 * Created by ANH To on 9/30/14.
 */
var smarttabz_main;
var smarttabz_setting;
(function($){
    $(document).ready(function(){
        SmartTab.Views.Main      = Backbone.View.extend({
            el: $(".container-smarttab"),
            events: {
                "click .add-category"           : "addCategory",
                "click .add-sub-category"       : "addSubCategory",
                "click .remove-category"        : "removeCategory",
                "click .remove-sub-category"    : "removeSubCategory"
            },
            initialize: function(){
            },
            addCategory: function(ev){
                var self = this;
                var category_id = this.$el.find("input[name=category_id]").val();

                if (category_id == "") {
                    return;
                }
                this.$el.find(".design-smarttab").attr("style", "display:block !important;");
                this.$el.find(".select-category-step1").slideUp(300, function(){});

                self.loadSubcategory(category_id);
            },
            addSubCategory: function(ev){
                if(!$('.choose-category').dropdown('get value')){
                    return true;
                }
                if(!$('.choose-sub-category').dropdown('get value')){
                    return true;
                }
                var data = {
                    id: $('.choose-sub-category').dropdown('get value'),
                    name: $('.choose-sub-category').dropdown('get text'),
                };

                var html = this.renderSubcategoryIntab(data);

                this.$el.find(".active-subcategories").find("tbody").append(html);

                $('.ui.checkbox').checkbox();
            },
            removeCategory: function(ev){
                var tr = $(ev.target).closest("tr");
                var module_id = tr.data('module-id');
                var loading = '<i class="notched large circle loading icon"></i>';

                $(ev.target).closest('td').html(loading);

                if(!module_id){
                    return true;
                }

                $.ajax({
                    type: "POST",
                    url: url_remove_module,
                    data: 'module_id='+module_id,
                    success: function(data){
                        if(data.ok){
                            tr.remove();
                        }
                    }
                });
            },
            removeSubCategory: function(ev){
                $(ev.target).closest("tr").remove();
            },
            loadSubcategory: function(category_id){
                var self = this;
                $.ajax({
                    type: "POST",
                    url: url_load_subcategory,
                    data: 'category_id='+category_id,
                    success: function(data){
                        if(data.ok){
                            var html = "";
                            $.each(data.subcategories, function(k, category){
                                html += "<div class=\"item\" data-value=\""+category.category_id+"\">"+category.name+"</div>";
                            });
                            $('.choose-sub-category').find(".menu").html(html);
                            $('.choose-sub-category').dropdown();

                            self.$el.find(".choose-sub-category").closest(".ui.tab").find(".add-sub-category").removeClass('disabled').addClass('positive');
                        }else{
                            self.$el.find(".choose-sub-category").closest(".ui.tab").find(".add-sub-category").removeClass('positive').addClass('disabled');
                        }
                    }
                });
            },
            renderSubcategoryIntab: function(data){
                var html = ''+
                    '<tr>'+
                        '<td class="three right aligned"><label>'+data.name+'</label><input type="hidden" name="subcategory['+data.id+'][id]" value="'+data.id+'"><input type="hidden" name="subcategory['+data.id+'][name]" value="'+data.name+'"></td>'+
                        '<td class="three ">'+
                        '<div class="ui toggle checkbox">'+
                            '<input type="checkbox" name="subcategory['+data.id+'][status]">'+
                        '</div>'+
                        '<i class="trash large red icon remove-sub-category" style="cursor: pointer"></i>'+
                        '</td>'+
                    '</tr>';

                return html;
            }
        });

        SmartTab.Views.SettingTheme = Backbone.View.extend({
            el: $(".container-kuteshop_setting"),
            events: {
                "click .select-store"           : "selectStore",
                "click .box span"                    : "selectBox"
            },
            initialize: function(){
            },
            selectStore: function(ev) {
                $('#form').submit();
            },
            selectBox: function(ev){
                var content_id = $(ev.target).closest('.box').data('id');

                $(".layout-page").find("> .column").next().remove();

                if($("#content_"+content_id).length){
                    var html = $("#content_"+content_id).html();
                }else{
                    var html = $("#content_empty").html();
                }
                $(".layout-page").append(html);
            }
        });
        smarttabz_main = new SmartTab.Views.Main();
        smarttabz_setting = new SmartTab.Views.SettingTheme();
    });


})(j$original);
