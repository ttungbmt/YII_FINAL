$(document).ready(function () {
    uiUpdate();
    loadTestJquery();
});

function uiUpdateOnReady(parentid) {
    uiUpdate(parentid);
}

function loadAjaxToDiv(formid, ajaxurl, divid) {
    $.ajax({
        url: ajaxurl,
        data: formid !== null ? $(formid).serialize() : [],
        success: function (html) {
            $(divid).empty().append(html);
            uiUpdate(divid);
        },
        error: function () {
            $(divid).empty().append("<div class='alert-danger'>Thao tác bị từ chối</div>");
        }
    });
}

function uiUpdate(parentid) {
    parentid = checkUndefine(parentid) ? '' : parentid;
    //For element looking for other element to change inside
    $(parentid + ' .custom-element-bind-other').each(function () {
        var _this = $(this);
        var _url = _this.attr('data-ajax-url');
        var _form = _this.attr('data-ajax-form');
        var _element = _this.attr('data-target-element');
        var _event = _this.attr('data-target-event');
        var _next_event = _this.attr('data-result-next-event');

        if (!checkUndefine(_url)) {
            loadAjaxToDiv(_form, _url, '#' + _this.attr('id'));
        } else {
            var selected = $(_element).val();
            var clone = $(selected).clone();
            var parentid = '#' + _this.attr('id');

            _this.empty().append(clone);
            uiUpdate(parentid);
            clone.trigger(_next_event);
        }
        $(_element).on(_event, function () {
            if (!checkUndefine(_url)) {
                loadAjaxToDiv(_form, _url, '#' + _this.attr('id'));
            } else {
                var selected = $(_element).val();
                var clone = $(selected).clone();
                var parentid = '#' + _this.attr('id');

                _this.empty().append(clone);
                uiUpdate(parentid);
                clone.trigger(_next_event);
            }
        });
    });
    //For toggle element
    $(parentid + ' .custom-element-toggle').each(function () {
        var _this = $(this);
        var _event = _this.attr('data-event');
        var _prevent = _this.attr('data-prevent');
        var _toggleclass = _this.attr('data-toggle');
        var _target = _this.attr('data-target');

        _this.on(_event, function (e) {
            if (!checkUndefine(_prevent)) {
                e.preventDefault();
            }
            $(_target).toggleClass(_toggleclass);
        });
    });
    // For element request to div with custom event
    $(parentid + ' .custom-element-request-div').each(function () {
        var _this = $(this);
        var _event = _this.attr('data-event');

        _this.on(_event, function () {
            var _this = $(this);
            var _url = _this.attr('data-url');
            var _target_div = _this.attr('data-target-div');
            var _target_form = _this.attr('data-target-form');
            $.ajax({
                url: _url,
                data: $(_target_form).serialize(),
                success: function (html) {
                    $(_target_div).empty().append(html);
                    uiUpdate(_target_div);
                }
            });
        });
    });
    // For element request to div with custom event
    $(parentid + ' .custom-element-request-modal').each(function () {
        console.log('custom-element-request-modal');
        var _this = $(this);
        var _event = _this.attr('data-event');
        if (typeof(_this.attr('custom-element-request-modal')) == 'undefined') {
            _this.attr('custom-element-request-modal', true);
            _this.on(_event, function () {
                var _this = $(this);
                var _url = _this.attr('data-url');
                var _target_div = _this.attr('data-target-div');
                var _target_form = _this.attr('data-target-form');
                $(_target_div).empty();
                $.ajax({
                    url: _url,
                    data: $(_target_form).serialize(),
                    success: function (html) {
                        $(_target_div).append(html);
                        uiUpdate(_target_div);
                    }
                });
            });
        }
    });
    // Custom select ajax
    $(parentid + ' .custom-select-ajax').each(function () {
        var _this = $(this);
        var _url = _this.attr('data-url');
        var _first_key = _this.attr('data-first-key');
        var _first_text = _this.attr('data-first-text');

        _this.empty().append($("<option></option>").attr("value", _first_key).text(_first_text));
        $.ajax({
            url: _url,
            success: function (data) {
                var length = data.length;
                for (var i = 0; i < length; i++) {
                    _this.append($("<option></option>").attr("value", data[i]['key']).text(data[i]['value']));
                }
            }
        });
    });
    // Change label
    $(parentid + ' .custom-change-label').each(function (e) {
        var _this = $(this);
        var _target = $(_this.attr('data-change-target'));
        var _content = _this.attr('data-change-content');
        var _isset = _this.attr('data-change-isset');
        if (typeof (_isset) === 'undefined') {
            _this.on('click', function () {
                _target.empty().append(_content);
            });
        }
    });

    // Button trig other button
    $(parentid + ' .custom-button-trigger-other').each(function (e) {
        var _this = $(this);
        var _target = $(_this.attr('data-trigger-target'));
        var _isset = _this.attr('data-trigger-isset');
        if (typeof (_isset) === 'undefined') {
            _this.on('click', function () {
                _target.click();
            });
            _this.attr('data-trigger-isset', true);
        }
    });

    // Custom button ajax call
    $(parentid + ' .custom-button-ajax-call').each(function (e) {
        var _this = $(this);
        var _url = _this.attr('data-url');
        var _form = $(_this.attr('data-form'));
        var _div = $(_this.attr('data-target-div'));
        var _isset = _this.attr('data-button-event-set');
        var _method = _this.attr('data-method');
        if (typeof (_isset) === 'undefined') {
            _this.on('click', function () {
                $.ajax({
                    url: _url,
                    data: _form.serialize(),
                    method: typeof (_method) !== 'undefined' ? _method : 'GET',
                    success: function (html) {
                        _div.empty().append(html);
                        uiUpdate('#' + _div.attr('id'));
                    }
                });
            });
            _this.attr('data-button-event-set', 'true');
        }
    });

    // Pagination
    $(parentid + ' .custom-widget-pagination').each(function () {
        var _this = $(this);
        var _url = _this.attr('data-url');
        var _div = $(_this.attr('data-target-div'));
        var _current = _this.attr('data-current');
        var _total = _this.attr('data-total');
        var _input = $(_this.attr('data-input'));
        var _form = $(_this.attr('data-form'));
        _input.val(1);

        _this.bootstrapPaginator({
            currentPage: _current,
            totalPages: parseInt(_total) + 1,
            numberOfPages: 3,
            size: 'small',
            itemContainerClass: function (type, page, current) {
                return (page === current) ? "active" : "pointer-cursor";
            },
            bootstrapMajorVersion: 3,
            onPageClicked: function (e, originalEvent, type, page) {
                _input.val(page);
                $.ajax({
                    url: _url,
                    data: _form.serialize(),
                    success: function (html) {
                        _div.empty().append(html);
                        uiUpdate('#' + _div.attr('id'));
                    }
                });
            }
        });
    });

    // For set active menu
    $(parentid + " .custom-menu").each(function () {
        var _this = $(this);
        _this.children("li").each(function () {
            var _child = $(this);
            if (window.location.pathname.indexOf(_child.attr("id")) >= 0) {
                _child.addClass("active");
            } else {
                _child.removeClass("active");
            }
        });
    });

    /////////////////////////PAN TO POINT ON MAP
    $(parentid + ' .custom-map-focus-point').each(function () {
        var _this = $(this);
        var _evented = _this.attr('data-map-focus-point');
        if (typeof (_evented) === 'undefined') {
            _this.on('click', function (e) {
                if (typeof (maplayers[_this.attr('data-layer')]) != 'undefined') {
                    maplayers[_this.attr('data-layer')].addTo(map);
                }
                panToByGeometry(_this.attr('data-point'), true);
            });
            _this.attr('data-map-focus-point', 'true');
        }
    });

    $(parentid + ' .custom-map-focus-point-check').each(function () {
        var _this = $(this);
        var _evented = _this.attr('data-map-focus-point');
        if (typeof (_evented) === 'undefined') {
            _this.on('click', function (e) {
                if (this.checked)
                    panToByGeometry(_this.attr('data-point'), false);
            });
            _this.attr('data-map-focus-point', 'true');
        }
    });

    ////////////////////////FILTER TARGET LAYER - required: map, maplayers
    $(parentid + ' .custom-map-layer-filter').each(function () {
        var _this = $(this);
        if (typeof (_this.attr('data-map-layer-filter')) === 'undefined') {
            _this.on('click', function () {
                var _layer = maplayers[_this.attr('data-layer')];
                var _filter = _this.attr('data-filter');
                _layer.setParams({CQL_FILTER: _filter});
                currentlayer = _layer.options.featureName;
            });
            _this.attr('data-map-layer-filter', 'true');
        }
    });

    ///////////////////////CHART
    //////////////////////CUSTOM ACTIVE LAYER
    $(parentid + ' .custom-active-layer').each(function () {
        var _this = $(this);
        _this.on('click', function () {
            var _strLayers = _this.attr('data-layer');
            var _arrLayers = _strLayers.split(';');
            for (var i = 0; i < _arrLayers.length; i++) {
                if (this.checked || !_this.hasClass('active')) {
                    maplayers[_arrLayers[i]].addTo(map);
                } else {
                    map.removeLayer(maplayers[_arrLayers[i]]);
                }
            }
        });
    });

    //////////////////////CUSTOM ACTIVE LAYER
    $(parentid + ' .custom-init-layer').each(function () {
        var _this = $(this);
        var _strLayers = _this.attr('data-layer');
        var _arrLayers = _strLayers.split(';');
        for (var i = 0; i < _arrLayers.length; i++) {
            maplayers[_arrLayers[i]].addTo(map);
        }
    });
    ///////////////////////////////////////////
    $(parentid + ' .custom-toggle').each(function () {
        var _this = $(this);
        var _target = $(_this.attr('data-toggle-target'));
        var _classes = _this.attr('data-toggle-classes');
        _this.on('click', function () {
            _target.toggleClass(_classes);
        });
    });
    ///////////////////////////AJAX DIV
    $(parentid + ' .custom-div-ajax').each(function () {
        var _this = $(this);
        if (typeof(_this.attr('data-loaded')) === 'undefined') {
            $(_this.parent()).addClass('loading');
            $.ajax({
                url: _this.attr('data-url'),
                method: 'GET',
                async: true,
                success: function (html) {
                    _this.attr('data-loaded', true);
                    _this.empty().append(html);
                    uiUpdate('#' + _this.attr('id'));
                    $(_this.parent()).removeClass('loading');
                }
            });
        }
    });
    ///////////////////////////////
    $(parentid + ' .custom-list-group').each(function () {
        var _this = $(this);
        if (typeof (_this.attr('data-ctg-event')) === 'undefined') {
            _this.attr('data-ctg-event', true);
            _this.on('click', function (e) {
                if (typeof(_this.attr('data-non-unique')) == 'undefined') {
                    _this.children().removeClass('active');
                }
                $(e.target).toggleClass('active');
            });
        }
    });
    ///////////////////////////////DOWNLOAD LINK
    $(parentid + ' .custom-download').each(function () {
        var _this = $(this);
        if (typeof (_this.attr('data-download-event')) === 'undefined') {
            _this.attr('data-download-event', true);
            _this.on('click', function () {
                window.location = _this.attr('data-url');
            });
        }
    });

    $(parentid + ' #crud-datatable-container').each(function () {
        var _this = $(this);
        if (typeof(_this.attr('data-double-scroll-created')) === 'undefined') {
            _this.attr('data-double-scroll-created', true);
            _this.doubleScroll();
        }
    });


    $(parentid + ' #feature_infos_close').on('click', function() {
        features_time_counter = 2;
        $("#feature_infos").fadeOut(500);
    });

    if (!interval_created) {
        window.setInterval(function () {
            if (features_time_counter > 0) {
                features_time_counter -= 1;
            }
        }, 1000);
        interval_created = true;
    }

    $(parentid + ' .custom-auto-replace-url').each(function () {
        var _this = $(this);
        if (_this.attr('data-replace') !== 'undefined') {
            window.history.pushState("object or string", "Title", _this.attr('data-url'));
        }
    });

    $(parentid + ' .custom-replace-url').each(function () {
        var _this = $(this);
        _this.on('click', function () {
            if (_this.attr('data-replace') !== 'undefined') {
                window.history.pushState("object or string", "Title", _this.attr('data-url'));
            }
        });
    });

    $(parentid + ' .custom-ajax-form').each(function() {
        var _this = $(this);
        var form = _this.find('form');

        form.submit(function () {
            var form = $(this);
            // return false if form still have some validation errors
            if (form.find('.has-error').length) {
                return false;
            }
            // submit form
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (response) {
                    form.closest('.custom-ajax-form').empty().append(response);
                }
            });
            return false;
        });
    });

    $(parentid + ' .custom-expand-sidebar').each(function () {
        var _this = $(this);
        if (typeof (_this.attr('custom-expand-sidebar')) === 'undefined' ) {
            _this.attr('custom-expand-sidebar', true);
            _this.on('click', function() {
                $('#wrapper').removeClass('toggled');
            });
        }
    });

    $(parentid + ' .custom-reload-ajax-div').each(function () {
        var _this = $(this);
        if (typeof(_this.attr('data-reload-ajax-div')) == 'undefined') {
            _this.attr('data-reload-ajax-div', true);
            _this.on('click', function () {
                var _url = _this.attr('data-url');
                var _div = _this.attr('data-target');
                loadAjaxToDiv('', _url, _div);
            });
        }
    });

    $('.suwala-doubleScroll-scroll-wrapper').css('width', '');

   $.datepicker.regional.vi = {
        closeText: "Đóng",
        prevText: "&#x3C;Trước",
        nextText: "Tiếp&#x3E;",
        currentText: "Hôm nay",
        monthNames: [ "Tháng Một", "Tháng Hai", "Tháng Ba", "Tháng Tư", "Tháng Năm", "Tháng Sáu",
        "Tháng Bảy", "Tháng Tám", "Tháng Chín", "Tháng Mười", "Tháng Mười Một", "Tháng Mười Hai" ],
        monthNamesShort: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6",
        "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
        dayNames: [ "Chủ Nhật", "Thứ Hai", "Thứ Ba", "Thứ Tư", "Thứ Năm", "Thứ Sáu", "Thứ Bảy" ],
        dayNamesShort: [ "CN", "T2", "T3", "T4", "T5", "T6", "T7" ],
        dayNamesMin: [ "CN", "T2", "T3", "T4", "T5", "T6", "T7" ],
        weekHeader: "Tu",
        dateFormat: "dd/mm/yy",
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: "" 
    };
    $.datepicker.setDefaults($.datepicker.regional['vi']);
    $(parentid + " .datepicker").datepicker({
        format: 'dd/mm/yyyy'
    });

}


function updateChart(parentid) {
    parentid = checkUndefine(parentid) ? '' : parentid;
    $(parentid + ' .custom-c3-chart').each(function () {
        var _this = $(this);
        var _url = _this.attr('data-url');
        $.ajax({
            url: _url,
            method: 'GET',
            success: function (data) {
                try {
                    data = JSON.parse(data);
                    data.listxy.x.unshift('x');
                    data.listxy.y.unshift('Mặt cắt ngang');
                    var config = {
                        bindto: '#' + _this.attr('id'),
                        data: {
                            x: 'x',
                            columns: [data.listxy.x, data.listxy.y],
//                        type: 'spline'
                        },
                    };
                    c3.generate(config);
                } catch (e) {
                    console.log(e);
                }
            }
        });
    });
}

function loadTestJquery() {
//    $("#div_tree").fancytree({
//        checkbox: true,
//        selectMode: 3,
//        source: [
//            {title: 'Quản trị hệ thống', key: '1'},
//            {title: 'Công tác thủy lợi', key: '2', folder: true, children: [
//                    {title: 'Quản lý kênh', key: '3'},
//                    {title: 'Quản lý nạo vét', key: '4'}
//                ]}
//        ]
//    });
}
