( function( $ ) {
    "use strict";

    $( document ).ready( function () {
        scrollNewPostsTPLHome()
    })

    // function scroll new posts tpl home
    const scrollNewPostsTPLHome = () => {
        const newPostsScrollbar = $('.new-posts__list')

        if ( newPostsScrollbar.length ) {
            newPostsScrollbar.scrollbar({
                autoScrollSize: false
            })
        }
    }

} )( jQuery )