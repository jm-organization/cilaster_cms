/**
 * Created by Admin on 06.06.2017.
 */

var tags = {
    attributes: function ($attr = {}) {
        if (typeof $attr.attributes != 'undefined' && $attr.attributes != null) {
            var attributes = '';

            for (var key in $attr.attributes) {
                attributes += ' '+key+'="'+$attr.attributes[key]+'"';
            }

            return attributes;
        }

        return '';
    },
    content: function ($attr = {}) {
        return (typeof $attr.tagContent != 'undefined' && $attr.tagContent != null)?$attr.tagContent:'';
    },

    tag: function ($attr = {}) {
        if (typeof $attr.tag != 'undefined' && $attr.tag != null) {
            return '<'+$attr.tag+tags.attributes($attr)+'>'+tags.content($attr)+'</'+$attr.tag+'>';
        }

        return null;
    }
};