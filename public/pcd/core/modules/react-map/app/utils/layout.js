let updateMap = () => {
    map.invalidateSize();
}

var defaults = {
    resizeWhileDragging: true,
    spacing_open: 5,
    spacing_closed: 5,
    resizerDragOpacity: 0.3, // Độ mờ resize(Tắt resizeWhileDragging),
    // onshow_end: updateMap,
    // onhide_end: updateMap,
    onresize_end: updateMap,
    // onclose_end: updateMap,
    // onopen_end: updateMap,
}

export function init() {
    let myLayout = $('body').layout({
        defaults,
        north: {
            paneSelector: '#header',
            size: 46,
            spacing_open: 0,			// cosmetic spacing
            // togglerLength_open: 0,			// HIDE the toggler button
            // resizable: false,
            // slidable: true,
            spacing_closed: 0,
            //showOverflowOnHover: true,
        },
        center: {
            paneSelector: '#main',
            childOptions: {
                defaults,
                west: {
                    paneSelector: '#leftPanel',
                    size: 550,
                    // showOverflowOnHover: true,
                },
                center: {
                    defaults,
                    paneSelector: '#content',

                    childOptions: {
                        defaults,
                        north: {
                            paneSelector: '#navbar',
                            size: 42,
                            spacing_open: 0,			// cosmetic spacing
                            spacing_closed: 0,
                            // showOverflowOnHover: true,
                        },
                        center: {
                            paneSelector: '#map-wrapper',
                            childOptions: {
                                defaults,
                                west: {
                                    paneSelector: '#leftMap',
                                    spacing_closed: 0,
                                    initClosed: true,
                                },
                                center: {
                                    paneSelector: '#mainMap',
                                },
                                east: {
                                    paneSelector: '#rightMap',
                                    initClosed: true,
                                    spacing_closed: 0,
                                },
                            }
                        },

                        south: {
                            paneSelector: '#preview',
                            size: 140,
                            initClosed: true,
                            spacing_closed: 0,
                        }
                    }
                },
                east: {
                    paneSelector: '#rightPanel',
                    initClosed: true,
                    spacing_closed: 0,
                },
            }
        },
        south: {
            paneSelector: '#footer',
            initClosed: true,
            spacing_closed: 0,
        }
    });

    let appLayout = myLayout,
        mainLayout = myLayout.center.children.layout1,
        contentLayout = mainLayout.center.children.layout1,
        mapLayout = contentLayout.center.children.layout1;

    window.appLayout = {root: myLayout, main: mainLayout, content: contentLayout, map: mapLayout};


    $('#leftPanel').perfectScrollbar();
    $('.table-responsive').perfectScrollbar();
    swipeSidebar();

}

export function swipeSidebar(id = 'navHeader') {
    var sbToggled = document.getElementById(id);
    var gesture = new Hammer(sbToggled);
    gesture.on('swipeleft swiperight', function (e) {
        const {type} = e;
        if (type == 'swipeleft') window.appLayout.main.close('west');
        if (type == 'swiperight') window.appLayout.main.open('west');
    });
}