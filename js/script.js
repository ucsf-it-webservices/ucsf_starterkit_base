(function ($) {
    // Handle user toolbar when user is admin and have admin toolbar enabled.
    Drupal.behaviors.ucsf = {
        attach: function (context, settings) {

            if ($('.field-type-text-with-summary, .field-type-text, .block').length > 0 && $('body > div.print-site_name').length === 0) {
                /*****************
                 // Vertical Tabs
                 ******************/
                    // First Step
                    // We grab the code outputted by the WYSIWYG, and try to make it CSS friendly
                $vtabs = [];
                $vcontent = [];
                $vtab = 0;
                $vindex = 0;
                $('a.vtab').each(function ($index) {
                    $this = $(this);
                    $vtabs[$vindex] = $this.text();
                    $vcontent[$vindex] = $this.parent('p').next('p, div').html();
                    $vindex++;

                    // If this is the last "tab" item then we display the whole thing
                    if ($this.parent('p').next('p, div').next('p').find('a.vtab').length === 0) {
                        $vtabsHtml = '<ul class="vnav">';
                        $.each($vtabs, function ($itab) {
                            $vtabsHtml += '<li class="vnav-tab-' + $itab + '">' + $vtabs[$itab] + '</li>';
                        });
                        $vtabsHtml += '</ul>';
                        $vcontentHtml = '';
                        $.each($vcontent, function ($icontent) {
                            $vcontentHtml += '<div class="vcontent">' + $vcontent[$icontent] + '</div>';
                        });
                        $this.parent('p').next('p, div').after('<div class="vtabs vtabs-' + $vtab + '">' + $vtabsHtml + $vcontentHtml + '</div>');
                        $vtabs.length = 0;
                        $vcontent.length = 0;
                        $vindex = 0;
                        $vtab++;
                    }
                    // Let's remove the tab content
                    $this.parent('p').next('p, div').remove();
                    $this.parent('p').remove();
                });

                // Second Step
                // Bind the click to do the proper show/hide behavior
                $('.vtabs').each(function ($ti) {
                    $vtabs = $(this);
                    var $items = $vtabs.find('.vnav li').each(function ($i) {
                        if ($i === 0) {
                            $(this).addClass('current');
                            $('.vtabs').eq($ti).find('.vcontent').eq(0).show();
                        }
                        $(this).click(function (e) {
                            e.preventDefault();
                            $items.removeClass('current');
                            $(this).addClass('current');
                            $('.vtabs').eq($ti).find('.vcontent').hide().eq($items.index($(this))).show();
                        });
                    });
                });


                /*************
                 // Accordion
                 **************/
                    // First Step
                    // Bind the clicks to the proper show/hide
                $('.accordion').each(function ($ti) {
                    $vaccordion = $(this);

                    if ($desc = $vaccordion.parent('p').next('p, div')) {
                        $desc.hide();
                        $desc.addClass('accordian-content');
                    }

                    $vaccordion.click(function (e) {
                        e.preventDefault();

                        $desc = $(this).parent('p').next('p, div');

                        if ($desc.is(':visible')) {
                            $(this).removeClass('active');
                            $desc.hide();

                        }
                        else {
                            $(this).addClass('active');
                            $desc.show();
                        }
                    });
                });

                /************
                 // Tooltips
                 *************/
                $('.field-type-text-with-summary a[href][title], .field-type-text a[href][title]').qtip({
                    content: {
                        text: false
                    },
                    position: {
                        corner: {
                            tooltip: 'bottomMiddle',
                            target: 'topMiddle'
                        }
                    },
                    style: {
                        border: {
                            width: 1,
                            radius: 5,
                            color: '#333333'
                        },
                        padding: '0px 8px',
                        textAlign: 'center',
                        tip: {
                            corner: 'bottomMiddle',
                            size: {
                                x: 10,
                                y: 5
                            }
                        },
                        background: '#333333',
                        color: '#FFF',
                        fontSize: '12px',
                        lineHeight: '20px'
                    }
                });
            }

            /******************
             // Sortable Arrays
             *******************/


            $('.sortable th, .sortable thead td').bind('click', function () {
                var th = $(this), thIndex = th.index();
                switch ($(this).attr('inverse')) {
                    case 'false':
                        inverse = true;
                        break;
                    case 'true:':
                        inverse = false;
                        break;
                    default:
                        inverse = false;
                        break;
                }
                th.attr('inverse', inverse);
                var table = $(this).parent().parent().parent();
                table.find('th, thead td').removeClass('sort-active');
                th.addClass('sort-active');
                table.find('tbody td').filter(function () {
                    return $(this).index() === thIndex;
                }).sortElements(function (a, b) {
                    return $.text([a]) > $.text([b]) ?
                        inverse ? -1 : 1
                        : inverse ? 1 : -1;
                }, function () {
                    // parentNode is the element we want to move
                    return this.parentNode;
                });
                inverse = !inverse;
            });


            /*
             Mobile Link when below < 630px
             */
            // $('#mobile-link').addClass('active');
            // $('.header-region').addClass('active');

            $('#mobile-link').click(function (event) {
                event.preventDefault();
                var nav = $('.header-region');

                if (nav.hasClass('active')) {
                    nav.removeClass('active');
                    $(this).removeClass('active');
                } else {
                    nav.addClass('active');
                    $(this).addClass('active');
                }
            });

            /* Work around for the links with there odd padding sqishyness to make entire
             area clickable */
            var primary_nav_links = $('.header-container nav[role="navigation"] a');
            if (primary_nav_links.length > 0) {
                primary_nav_links.each(function (i, e) {
                    $(e).parent('li').click(function () {
                        window.location.href = $(e).attr('href');
                    });
                });
            }

            // Adds overlay for repsonsive needs
            // Delete or disable for production
            // $('<div>').attr({'id': 'log'}).css({
            //     'color': '#333',
            //     'background': 'rgba(255,255,255, .8)',
            //     'position': 'fixed',
            //     'padding': '.5em 0',
            //     'bottom': 0,
            //     'left': 0,
            //     'width': '100%',
            //     'text-align':'center'
            // }).html('width: ' + $(window).width() + ' / height: ' + $(window).height() ).appendTo('body');

            /* Time sensitive generic fix for a visual thing with sticky heads
             I know this is ugly, but it works for now. */
            var sticky_th = $('table.sticky-enabled thead tr th');
            if (sticky_th.length > 0) {
                sticky_th.css('float', 'left');
                setTimeout(function () {
                    $('table tr th').css('float', 'none');
                }, 1);
            }

            var update_resizables = function() {
                // $('#log').html( 'width: ' + $(window).width() + ' / height: ' + $(window).height() );


                // swap position of elements when two sidebars
                if ($('.two-sidebars').length > 0 && $(window).width() < 630) {
                    if ($('.sidebar-first + .sidebar-second').length > 0) {
                        $('.sidebar-first').insertAfter('.sidebar-second');
                    }
                } else {
                    if ($('.sidebar-second + .sidebar-first').length > 0) {
                        $('.sidebar-second').insertAfter('.sidebar-first');
                    }
                }
            };

            var enable_sidebar_switch = true;
            if (settings.ucsf_base && settings.ucsf_base.disable_sidebar_switch) {
                enable_sidebar_switch = false;
            }
            if (enable_sidebar_switch) {
                $(window).resize(function () {
                    update_resizables();
                });
                update_resizables();
            }
        }
    };
})(jQuery);



