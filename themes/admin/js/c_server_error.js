/**
 * Created by Magicmen on 28.08.2017.
 */


$(document).ready(function () {
    var errors = {
        error_types: [],
        query: window
            .location
            .search
            .replace('?','')
            .split('&')
            .reduce(
                function(p,e){
                    var a = e.split('=');
                    p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                    return p;
                },
                {}
            )
    };

    $('body').append(tags.tag({
        tag: 'div',
        attributes: { class: 'page-errors', id: 'errors' }
    }));

    if (window.location.search.length > 1 &&
        /error/i.test(window.location.search)
    ) {
        $('#errors').append(tags.tag({
            tag: 'div',
            attributes: {
                class: 'alert alert-danger alert-dismissible fade show',
                id: errors.query.error_type,
                role: 'alert'
            },
            tagContent: tags.tag({
                tag: 'button',
                attributes: {
                    type: "button",
                    class: "close",
                    "data-dismiss": "alert",
                    "aria-label": "Close"
                },
                tagContent: '<span aria-hidden="true">&times;</span>'
            })+(errors.query.error)
        }));
        $('#'+errors.query.error_type).show();
    }
});
