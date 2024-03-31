(function(i){var p=function(e,t){this.options=t,this.$element=i(e),this.$container=i("<div/>",{class:"ms-container"}),this.$selectableContainer=i("<div/>",{class:"ms-selectable"}),this.$selectionContainer=i("<div/>",{class:"ms-selection"}),this.$selectableUl=i("<ul/>",{class:"ms-list",tabindex:"-1"}),this.$selectionUl=i("<ul/>",{class:"ms-list",tabindex:"-1"}),this.scrollTo=0,this.elemsSelector="li:visible:not(.ms-optgroup-label,.ms-optgroup-container,."+t.disabledClass+")"};p.prototype={constructor:p,init:function(){var e=this,t=this.$element;if(t.next(".ms-container").length===0){t.css({position:"absolute",left:"-9999px"}),t.attr("id",t.attr("id")?t.attr("id"):Math.ceil(Math.random()*1e3)+"multiselect"),this.$container.attr("id","ms-"+t.attr("id")),this.$container.addClass(e.options.cssClass),t.find("option").each(function(){e.generateLisFromOption(this)}),this.$selectionUl.find(".ms-optgroup-label").hide(),e.options.selectableHeader&&e.$selectableContainer.append(e.options.selectableHeader),e.$selectableContainer.append(e.$selectableUl),e.options.selectableFooter&&e.$selectableContainer.append(e.options.selectableFooter),e.options.selectionHeader&&e.$selectionContainer.append(e.options.selectionHeader),e.$selectionContainer.append(e.$selectionUl),e.options.selectionFooter&&e.$selectionContainer.append(e.options.selectionFooter),e.$container.append(e.$selectableContainer),e.$container.append(e.$selectionContainer),t.after(e.$container),e.activeMouse(e.$selectableUl),e.activeKeyboard(e.$selectableUl);var s=e.options.dblClick?"dblclick":"click";e.$selectableUl.on(s,".ms-elem-selectable",function(){e.select(i(this).data("ms-value"))}),e.$selectionUl.on(s,".ms-elem-selection",function(){e.deselect(i(this).data("ms-value"))}),e.activeMouse(e.$selectionUl),e.activeKeyboard(e.$selectionUl),t.on("focus",function(){e.$selectableUl.focus()})}var l=t.find("option:selected").map(function(){return i(this).val()}).get();e.select(l,"init"),typeof e.options.afterInit=="function"&&e.options.afterInit.call(this,this.$container)},generateLisFromOption:function(e,t,s){for(var l=this,n=l.$element,c="",r=i(e),o=0;o<e.attributes.length;o++){var f=e.attributes[o];f.name!=="value"&&f.name!=="disabled"&&(c+=f.name+'="'+f.value+'" ')}var a=i("<li "+c+"><span>"+l.escapeHTML(r.text())+"</span></li>"),d=a.clone(),h=r.val(),C=l.sanitize(h);a.data("ms-value",h).addClass("ms-elem-selectable").attr("id",C+"-selectable"),d.data("ms-value",h).addClass("ms-elem-selection").attr("id",C+"-selection").hide(),(r.prop("disabled")||n.prop("disabled"))&&(d.addClass(l.options.disabledClass),a.addClass(l.options.disabledClass));var v=r.parent("optgroup");if(v.length>0){var U=v.attr("label"),b=l.sanitize(U),m=l.$selectableUl.find("#optgroup-selectable-"+b),u=l.$selectionUl.find("#optgroup-selection-"+b);if(m.length===0){var y='<li class="ms-optgroup-container"></li>',S='<ul class="ms-optgroup"><li class="ms-optgroup-label"><span>'+U+"</span></li></ul>";m=i(y),u=i(y),m.attr("id","optgroup-selectable-"+b),u.attr("id","optgroup-selection-"+b),m.append(i(S)),u.append(i(S)),l.options.selectableOptgroup&&(m.find(".ms-optgroup-label").on("click",function(){var g=v.children(":not(:selected, :disabled)").map(function(){return i(this).val()}).get();l.select(g)}),u.find(".ms-optgroup-label").on("click",function(){var g=v.children(":selected:not(:disabled)").map(function(){return i(this).val()}).get();l.deselect(g)})),l.$selectableUl.append(m),l.$selectionUl.append(u)}t=t===void 0?m.find("ul").children().length:t+1,a.insertAt(t,m.children()),d.insertAt(t,u.children())}else t=t===void 0?l.$selectableUl.children().length:t,a.insertAt(t,l.$selectableUl),d.insertAt(t,l.$selectionUl)},addOption:function(e){var t=this;e.value!==void 0&&e.value!==null&&(e=[e]),i.each(e,function(s,l){if(l.value!==void 0&&l.value!==null&&t.$element.find("option[value='"+l.value+"']").length===0){var n=i('<option value="'+l.value+'">'+l.text+"</option>"),s=parseInt(typeof l.index>"u"?t.$element.children().length:l.index),c=l.nested===void 0?t.$element:i("optgroup[label='"+l.nested+"']");n.insertAt(s,c),t.generateLisFromOption(n.get(0),s,l.nested)}})},escapeHTML:function(e){return i("<div>").text(e).html()},activeKeyboard:function(e){var t=this;e.on("focus",function(){i(this).addClass("ms-focus")}).on("blur",function(){i(this).removeClass("ms-focus")}).on("keydown",function(s){switch(s.which){case 40:case 38:s.preventDefault(),s.stopPropagation(),t.moveHighlight(i(this),s.which===38?-1:1);return;case 37:case 39:s.preventDefault(),s.stopPropagation(),t.switchList(e);return;case 9:if(t.$element.is("[tabindex]")){s.preventDefault();var l=parseInt(t.$element.attr("tabindex"),10);l=s.shiftKey?l-1:l+1,i('[tabindex="'+l+'"]').focus();return}else s.shiftKey&&t.$element.trigger("focus")}if(i.inArray(s.which,t.options.keySelect)>-1){s.preventDefault(),s.stopPropagation(),t.selectHighlighted(e);return}})},moveHighlight:function(e,t){var s=e.find(this.elemsSelector),l=s.filter(".ms-hover"),n=null,c=s.first().outerHeight(),r=e.height();if(""+this.$container.prop("id"),s.removeClass("ms-hover"),t===1){if(n=l.nextAll(this.elemsSelector).first(),n.length===0){var o=l.parent();if(o.hasClass("ms-optgroup")){var f=o.parent(),a=f.next(":visible");a.length>0?n=a.find(this.elemsSelector).first():n=s.first()}else n=s.first()}}else if(t===-1&&(n=l.prevAll(this.elemsSelector).first(),n.length===0)){var o=l.parent();if(o.hasClass("ms-optgroup")){var f=o.parent(),d=f.prev(":visible");d.length>0?n=d.find(this.elemsSelector).last():n=s.last()}else n=s.last()}if(n.length>0){n.addClass("ms-hover");var h=e.scrollTop()+n.position().top-r/2+c/2;e.scrollTop(h)}},selectHighlighted:function(e){var t=e.find(this.elemsSelector),s=t.filter(".ms-hover").first();s.length>0&&(e.parent().hasClass("ms-selectable")?this.select(s.data("ms-value")):this.deselect(s.data("ms-value")),t.removeClass("ms-hover"))},switchList:function(e){e.blur(),this.$container.find(this.elemsSelector).removeClass("ms-hover"),e.parent().hasClass("ms-selectable")?this.$selectionUl.focus():this.$selectableUl.focus()},activeMouse:function(e){var t=this;this.$container.on("mouseenter",t.elemsSelector,function(){i(this).parents(".ms-container").find(t.elemsSelector).removeClass("ms-hover"),i(this).addClass("ms-hover")}),this.$container.on("mouseleave",t.elemsSelector,function(){i(this).parents(".ms-container").find(t.elemsSelector).removeClass("ms-hover")})},refresh:function(){this.destroy(),this.$element.multiSelect(this.options)},destroy:function(){i("#ms-"+this.$element.attr("id")).remove(),this.$element.off("focus"),this.$element.css("position","").css("left",""),this.$element.removeData("multiselect")},select:function(e,t){typeof e=="string"&&(e=[e]);var s=this,l=this.$element,n=i.map(e,function(h){return s.sanitize(h)}),c=this.$selectableUl.find("#"+n.join("-selectable, #")+"-selectable").filter(":not(."+s.options.disabledClass+")"),r=this.$selectionUl.find("#"+n.join("-selection, #")+"-selection").filter(":not(."+s.options.disabledClass+")"),o=l.find("option:not(:disabled)").filter(function(){return i.inArray(this.value,e)>-1});if(t==="init"&&(c=this.$selectableUl.find("#"+n.join("-selectable, #")+"-selectable"),r=this.$selectionUl.find("#"+n.join("-selection, #")+"-selection")),c.length>0){c.addClass("ms-selected").hide(),r.addClass("ms-selected").show(),o.prop("selected",!0),s.$container.find(s.elemsSelector).removeClass("ms-hover");var f=s.$selectableUl.children(".ms-optgroup-container");if(f.length>0){f.each(function(){var h=i(this).find(".ms-elem-selectable");h.length===h.filter(".ms-selected").length&&i(this).find(".ms-optgroup-label").hide()});var a=s.$selectionUl.children(".ms-optgroup-container");a.each(function(){var h=i(this).find(".ms-elem-selection");h.filter(".ms-selected").length>0&&i(this).find(".ms-optgroup-label").show()})}else if(s.options.keepOrder&&t!=="init"){var d=s.$selectionUl.find(".ms-selected");d.length>1&&d.last().get(0)!=r.get(0)&&r.insertAfter(d.last())}t!=="init"&&(l.trigger("change"),typeof s.options.afterSelect=="function"&&s.options.afterSelect.call(this,e))}},deselect:function(e){typeof e=="string"&&(e=[e]);var t=this,s=this.$element,l=i.map(e,function(a){return t.sanitize(a)}),n=this.$selectableUl.find("#"+l.join("-selectable, #")+"-selectable"),c=this.$selectionUl.find("#"+l.join("-selection, #")+"-selection").filter(".ms-selected").filter(":not(."+t.options.disabledClass+")"),r=s.find("option").filter(function(){return i.inArray(this.value,e)>-1});if(c.length>0){n.removeClass("ms-selected").show(),c.removeClass("ms-selected").hide(),r.prop("selected",!1),t.$container.find(t.elemsSelector).removeClass("ms-hover");var o=t.$selectableUl.children(".ms-optgroup-container");if(o.length>0){o.each(function(){var a=i(this).find(".ms-elem-selectable");a.filter(":not(.ms-selected)").length>0&&i(this).find(".ms-optgroup-label").show()});var f=t.$selectionUl.children(".ms-optgroup-container");f.each(function(){var a=i(this).find(".ms-elem-selection");a.filter(".ms-selected").length===0&&i(this).find(".ms-optgroup-label").hide()})}s.trigger("change"),typeof t.options.afterDeselect=="function"&&t.options.afterDeselect.call(this,e)}},select_all:function(){var e=this.$element,t=e.val();if(e.find('option:not(":disabled")').prop("selected",!0),this.$selectableUl.find(".ms-elem-selectable").filter(":not(."+this.options.disabledClass+")").addClass("ms-selected").hide(),this.$selectionUl.find(".ms-optgroup-label").show(),this.$selectableUl.find(".ms-optgroup-label").hide(),this.$selectionUl.find(".ms-elem-selection").filter(":not(."+this.options.disabledClass+")").addClass("ms-selected").show(),this.$selectionUl.focus(),e.trigger("change"),typeof this.options.afterSelect=="function"){var s=i.grep(e.val(),function(l){return i.inArray(l,t)<0});this.options.afterSelect.call(this,s)}},deselect_all:function(){var e=this.$element,t=e.val();e.find("option").prop("selected",!1),this.$selectableUl.find(".ms-elem-selectable").removeClass("ms-selected").show(),this.$selectionUl.find(".ms-optgroup-label").hide(),this.$selectableUl.find(".ms-optgroup-label").show(),this.$selectionUl.find(".ms-elem-selection").removeClass("ms-selected").hide(),this.$selectableUl.focus(),e.trigger("change"),typeof this.options.afterDeselect=="function"&&this.options.afterDeselect.call(this,t)},sanitize:function(e){var t=0,s,l;if(e.length==0)return t;var n=0;for(s=0,n=e.length;s<n;s++)l=e.charCodeAt(s),t=(t<<5)-t+l,t|=0;return t}},i.fn.multiSelect=function(){var e=arguments[0],t=arguments;return this.each(function(){var s=i(this),l=s.data("multiselect"),n=i.extend({},i.fn.multiSelect.defaults,s.data(),typeof e=="object"&&e);l||s.data("multiselect",l=new p(this,n)),typeof e=="string"?l[e](t[1]):l.init()})},i.fn.multiSelect.defaults={keySelect:[32],selectableOptgroup:!1,disabledClass:"disabled",dblClick:!1,keepOrder:!1,cssClass:""},i.fn.multiSelect.Constructor=p,i.fn.insertAt=function(e,t){return this.each(function(){e===0?t.prepend(this):t.children().eq(e-1).after(this)})}})(window.jQuery);
