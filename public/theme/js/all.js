if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

$.AdminBSB = {};
$.AdminBSB.options = {
    colors: {
        red: '#F44336',
        pink: '#E91E63',
        purple: '#9C27B0',
        deepPurple: '#673AB7',
        indigo: '#3F51B5',
        blue: '#2196F3',
        lightBlue: '#03A9F4',
        cyan: '#00BCD4',
        teal: '#009688',
        green: '#4CAF50',
        lightGreen: '#8BC34A',
        lime: '#CDDC39',
        yellow: '#ffe821',
        amber: '#FFC107',
        orange: '#FF9800',
        deepOrange: '#FF5722',
        brown: '#795548',
        grey: '#9E9E9E',
        blueGrey: '#607D8B',
        black: '#000000',
        white: '#ffffff'
    },
    leftSideBar: {
        scrollColor: 'rgba(0,0,0,0.5)',
        scrollWidth: '4px',
        scrollAlwaysVisible: false,
        scrollBorderRadius: '0',
        scrollRailBorderRadius: '0'
    },
    dropdownMenu: {
        effectIn: 'fadeIn',
        effectOut: 'fadeOut'
    }
}

/* Left Sidebar - Function =================================================================================================
*  You can manage the left sidebar menu options
*  
*/
$.AdminBSB.leftSideBar = {
    activate: function () {
        var _this = this;
        var $body = $('body');
        var $overlay = $('.overlay');

        //Close sidebar
        $(window).click(function (e) {
            var $target = $(e.target);
            if (e.target.nodeName.toLowerCase() === 'i') { $target = $(e.target).parent(); }

            if (!$target.hasClass('bars') && _this.isOpen() && $target.parents('#leftsidebar').length === 0) {
                if (!$target.hasClass('js-right-sidebar')) $overlay.fadeOut();
                $body.removeClass('overlay-open');
            }
        });

        $.each($('.menu-toggle.toggled'), function (i, val) {
            $(val).next().slideToggle(0);
        });

        //When page load
        $.each($('.menu .list li.active'), function (i, val) {
            var $activeAnchors = $(val).find('a:eq(0)');

            $activeAnchors.addClass('toggled');
            $activeAnchors.next().show();
        });

        //Collapse or Expand Menu
        $('.menu-toggle').on('click', function (e) {
            var $this = $(this);
            var $content = $this.next();

            if ($($this.parents('ul')[0]).hasClass('list')) {
                var $not = $(e.target).hasClass('menu-toggle') ? e.target : $(e.target).parents('.menu-toggle');

                $.each($('.menu-toggle.toggled').not($not).next(), function (i, val) {
                    if ($(val).is(':visible')) {
                        $(val).prev().toggleClass('toggled');
                        $(val).slideUp();
                    }
                });
            }

            $this.toggleClass('toggled');
            $content.slideToggle(320);
        });

        //Set menu height
        _this.setMenuHeight();
        _this.checkStatuForResize(true);
        $(window).resize(function () {
            _this.setMenuHeight();
            _this.checkStatuForResize(false);
        });

        //Set Waves
        Waves.attach('.menu .list a', ['waves-block']);
        Waves.init();
    },
    setMenuHeight: function () {
        if (typeof $.fn.slimScroll != 'undefined') {
            var configs = $.AdminBSB.options.leftSideBar;
            var height = ($(window).height() - ($('.legal').outerHeight() + $('.user-info').outerHeight() + $('.navbar').innerHeight()));
            var $el = $('.list');

            $el.slimScroll({ destroy: true }).height("auto");
            $el.parent().find('.slimScrollBar, .slimScrollRail').remove();

            $el.slimscroll({
                height: height + "px",
                color: configs.scrollColor,
                size: configs.scrollWidth,
                alwaysVisible: configs.scrollAlwaysVisible,
                borderRadius: configs.scrollBorderRadius,
                railBorderRadius: configs.scrollRailBorderRadius
            });
        }
    },
    checkStatuForResize: function (firstTime) {
        var $body = $('body');
        var $openCloseBar = $('.navbar .navbar-header .bars');
        var width = $body.width();

        if (firstTime) {
            $body.find('.content, .sidebar').addClass('no-animate').delay(1000).queue(function () {
                $(this).removeClass('no-animate').dequeue();
            });
        }

        if (width < 1170) {
            $body.addClass('ls-closed');
            $openCloseBar.fadeIn();
        }
        else {
            $body.removeClass('ls-closed');
            $openCloseBar.fadeOut();
        }
    },
    isOpen: function () {
        return $('body').hasClass('overlay-open');
    }
};
//==========================================================================================================================

/* Right Sidebar - Function ================================================================================================
*  You can manage the right sidebar menu options
*  
*/
$.AdminBSB.rightSideBar = {
    activate: function () {
        var _this = this;
        var $sidebar = $('#rightsidebar');
        var $overlay = $('.overlay');

        //Close sidebar
        $(window).click(function (e) {
            var $target = $(e.target);
            if (e.target.nodeName.toLowerCase() === 'i') { $target = $(e.target).parent(); }

            if (!$target.hasClass('js-right-sidebar') && _this.isOpen() && $target.parents('#rightsidebar').length === 0) {
                if (!$target.hasClass('bars')) $overlay.fadeOut();
                $sidebar.removeClass('open');
            }
        });

        $('.js-right-sidebar').on('click', function () {
            $sidebar.toggleClass('open');
            if (_this.isOpen()) { $overlay.fadeIn(); } else { $overlay.fadeOut(); }
        });
    },
    isOpen: function () {
        return $('.right-sidebar').hasClass('open');
    }
}
//==========================================================================================================================

/* Searchbar - Function ================================================================================================
*  You can manage the search bar
*  
*/
var $searchBar = $('.search-bar');
$.AdminBSB.search = {
    activate: function () {
        var _this = this;

        //Search button click event
        $('.js-search').on('click', function () {
            _this.showSearchBar();
        });

        //Close search click event
        $searchBar.find('.close-search').on('click', function () {
            _this.hideSearchBar();
        });

        //ESC key on pressed
        $searchBar.find('input[type="text"]').on('keyup', function (e) {
            if (e.keyCode == 27) {
                _this.hideSearchBar();
            }
        });
    },
    showSearchBar: function () {
        $searchBar.addClass('open');
        $searchBar.find('input[type="text"]').focus();
    },
    hideSearchBar: function () {
        $searchBar.removeClass('open');
        $searchBar.find('input[type="text"]').val('');
    }
}
//==========================================================================================================================

/* Navbar - Function =======================================================================================================
*  You can manage the navbar
*  
*/
$.AdminBSB.navbar = {
    activate: function () {
        var $body = $('body');
        var $overlay = $('.overlay');

        //Open left sidebar panel
        $('.bars').on('click', function () {
            $body.toggleClass('overlay-open');
            if ($body.hasClass('overlay-open')) { $overlay.fadeIn(); } else { $overlay.fadeOut(); }
        });

        //Close collapse bar on click event
        $('.nav [data-close="true"]').on('click', function () {
            var isVisible = $('.navbar-toggle').is(':visible');
            var $navbarCollapse = $('.navbar-collapse');

            if (isVisible) {
                $navbarCollapse.slideUp(function () {
                    $navbarCollapse.removeClass('in').removeAttr('style');
                });
            }
        });
    }
}
//==========================================================================================================================

/* Input - Function ========================================================================================================
*  You can manage the inputs(also textareas) with name of class 'form-control'
*  
*/
$.AdminBSB.input = {
    activate: function () {
        //On focus event
        $('.form-control').focus(function () {
            $(this).parent().addClass('focused');
        });

        //On focusout event
        $('.form-control').focusout(function () {
            var $this = $(this);
            if ($this.parents('.form-group').hasClass('form-float')) {
                if ($this.val() == '') { $this.parents('.form-line').removeClass('focused'); }
            }
            else {
                $this.parents('.form-line').removeClass('focused');
            }
        });

        //On label click
        $('body').on('click', '.form-float .form-line .form-label', function () {
            $(this).parent().find('input').focus();
        });
    }
}
//==========================================================================================================================

/* Form - Select - Function ================================================================================================
*  You can manage the 'select' of form elements
*  
*/
$.AdminBSB.select = {
    activate: function () {
        if ($.fn.selectpicker) { $('select:not(.ms)').selectpicker(); }
    }
}
//==========================================================================================================================

/* DropdownMenu - Function =================================================================================================
*  You can manage the dropdown menu
*  
*/

$.AdminBSB.dropdownMenu = {
    activate: function () {
        var _this = this;

        $('.dropdown, .dropup, .btn-group').on({
            "show.bs.dropdown": function () {
                var dropdown = _this.dropdownEffect(this);
                _this.dropdownEffectStart(dropdown, dropdown.effectIn);
            },
            "shown.bs.dropdown": function () {
                var dropdown = _this.dropdownEffect(this);
                if (dropdown.effectIn && dropdown.effectOut) {
                    _this.dropdownEffectEnd(dropdown, function () { });
                }
            },
            "hide.bs.dropdown": function (e) {
                var dropdown = _this.dropdownEffect(this);
                if (dropdown.effectOut) {
                    e.preventDefault();
                    _this.dropdownEffectStart(dropdown, dropdown.effectOut);
                    _this.dropdownEffectEnd(dropdown, function () {
                        dropdown.dropdown.removeClass('open');
                    });
                }
            }
        });

        //Set Waves
        Waves.attach('.dropdown-menu li a', ['waves-block']);
        Waves.init();
    },
    dropdownEffect: function (target) {
        var effectIn = $.AdminBSB.options.dropdownMenu.effectIn, effectOut = $.AdminBSB.options.dropdownMenu.effectOut;
        var dropdown = $(target), dropdownMenu = $('.dropdown-menu', target);

        if (dropdown.size() > 0) {
            var udEffectIn = dropdown.data('effect-in');
            var udEffectOut = dropdown.data('effect-out');
            if (udEffectIn !== undefined) { effectIn = udEffectIn; }
            if (udEffectOut !== undefined) { effectOut = udEffectOut; }
        }

        return {
            target: target,
            dropdown: dropdown,
            dropdownMenu: dropdownMenu,
            effectIn: effectIn,
            effectOut: effectOut
        };
    },
    dropdownEffectStart: function (data, effectToStart) {
        if (effectToStart) {
            data.dropdown.addClass('dropdown-animating');
            data.dropdownMenu.addClass('animated dropdown-animated');
            data.dropdownMenu.addClass(effectToStart);
        }
    },
    dropdownEffectEnd: function (data, callback) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        data.dropdown.one(animationEnd, function () {
            data.dropdown.removeClass('dropdown-animating');
            data.dropdownMenu.removeClass('animated dropdown-animated');
            data.dropdownMenu.removeClass(data.effectIn);
            data.dropdownMenu.removeClass(data.effectOut);

            if (typeof callback == 'function') {
                callback();
            }
        });
    }
}
//==========================================================================================================================

/* Browser - Function ======================================================================================================
*  You can manage browser
*  
*/
var edge = 'Microsoft Edge';
var ie10 = 'Internet Explorer 10';
var ie11 = 'Internet Explorer 11';
var opera = 'Opera';
var firefox = 'Mozilla Firefox';
var chrome = 'Google Chrome';
var safari = 'Safari';

$.AdminBSB.browser = {
    activate: function () {
        var _this = this;
        var className = _this.getClassName();

        if (className !== '') $('html').addClass(_this.getClassName());
    },
    getBrowser: function () {
        var userAgent = navigator.userAgent.toLowerCase();

        if (/edge/i.test(userAgent)) {
            return edge;
        } else if (/rv:11/i.test(userAgent)) {
            return ie11;
        } else if (/msie 10/i.test(userAgent)) {
            return ie10;
        } else if (/opr/i.test(userAgent)) {
            return opera;
        } else if (/chrome/i.test(userAgent)) {
            return chrome;
        } else if (/firefox/i.test(userAgent)) {
            return firefox;
        } else if (!!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)) {
            return safari;
        }

        return undefined;
    },
    getClassName: function () {
        var browser = this.getBrowser();

        if (browser === edge) {
            return 'edge';
        } else if (browser === ie11) {
            return 'ie11';
        } else if (browser === ie10) {
            return 'ie10';
        } else if (browser === opera) {
            return 'opera';
        } else if (browser === chrome) {
            return 'chrome';
        } else if (browser === firefox) {
            return 'firefox';
        } else if (browser === safari) {
            return 'safari';
        } else {
            return '';
        }
    }
}
//==========================================================================================================================

$(function () {
    $.AdminBSB.browser.activate();
    $.AdminBSB.leftSideBar.activate();
    $.AdminBSB.rightSideBar.activate();
    $.AdminBSB.navbar.activate();
    $.AdminBSB.dropdownMenu.activate();
    $.AdminBSB.input.activate();
    $.AdminBSB.select.activate();
    $.AdminBSB.search.activate();

    setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 50);
});
$(function () {
    skinChanger();
    activateNotificationAndTasksScroll();

    setSkinListHeightAndScroll();
    setSettingListHeightAndScroll();
    $(window).resize(function () {
        setSkinListHeightAndScroll();
        setSettingListHeightAndScroll();
    });
});

//Skin changer
function skinChanger() {
    $('.right-sidebar .demo-choose-skin li').on('click', function () {
        var $body = $('body');
        var $this = $(this);

        var existTheme = $('.right-sidebar .demo-choose-skin li.active').data('theme');
        $('.right-sidebar .demo-choose-skin li').removeClass('active');
        $body.removeClass('theme-' + existTheme);
        $this.addClass('active');

        $body.addClass('theme-' + $this.data('theme'));
    });
}

//Skin tab content set height and show scroll
function setSkinListHeightAndScroll() {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.demo-choose-skin');

    $el.slimScroll({ destroy: true }).height('auto');
    $el.parent().find('.slimScrollBar, .slimScrollRail').remove();

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Setting tab content set height and show scroll
function setSettingListHeightAndScroll() {
    var height = $(window).height() - ($('.navbar').innerHeight() + $('.right-sidebar .nav-tabs').outerHeight());
    var $el = $('.right-sidebar .demo-settings');

    $el.slimScroll({ destroy: true }).height('auto');
    $el.parent().find('.slimScrollBar, .slimScrollRail').remove();

    $el.slimscroll({
        height: height + 'px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Activate notification and task dropdown on top right menu
function activateNotificationAndTasksScroll() {
    $('.navbar-right .dropdown-menu .body .menu').slimscroll({
        height: '254px',
        color: 'rgba(0,0,0,0.5)',
        size: '4px',
        alwaysVisible: false,
        borderRadius: '0',
        railBorderRadius: '0'
    });
}

//Google Analiytics ======================================================================================
addLoadEvent(loadTracking);
var trackingId = 'UA-30038099-6';

function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function () {
            oldonload();
            func();
        }
    }
}

function loadTracking() {
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
        m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', trackingId, 'auto');
    ga('send', 'pageview');
}
//========================================================================================================
function hexToRgb(hexCode) {
    var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
    var matches = patt.exec(hexCode);
    var rgb = "rgb(" + parseInt(matches[1], 16) + "," + parseInt(matches[2], 16) + "," + parseInt(matches[3], 16) + ")";
    return rgb;
}

function hexToRgba(hexCode, opacity) {
    var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
    var matches = patt.exec(hexCode);
    var rgb = "rgba(" + parseInt(matches[1], 16) + "," + parseInt(matches[2], 16) + "," + parseInt(matches[3], 16) + "," + opacity + ")";
    return rgb;
}

$(function () {
    //Widgets count
    $('.count-to').countTo();

    //Sales count to
    $('.sales-count-to').countTo({
        formatter: function (value, options) {
            return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
        }
    });

    initRealTimeChart();
    initDonutChart();
    initSparkline();
});

var realtime = 'on';
function initRealTimeChart() {
    //Real time ==========================================================================================
    var plot = $.plot('#real_time_chart', [getRandomData()], {
        series: {
            shadowSize: 0,
            color: 'rgb(0, 188, 212)'
        },
        grid: {
            borderColor: '#f3f3f3',
            borderWidth: 1,
            tickColor: '#f3f3f3'
        },
        lines: {
            fill: true
        },
        yaxis: {
            min: 0,
            max: 100
        },
        xaxis: {
            min: 0,
            max: 100
        }
    });

    function updateRealTime() {
        plot.setData([getRandomData()]);
        plot.draw();

        var timeout;
        if (realtime === 'on') {
            timeout = setTimeout(updateRealTime, 320);
        } else {
            clearTimeout(timeout);
        }
    }

    updateRealTime();

    $('#realtime').on('change', function () {
        realtime = this.checked ? 'on' : 'off';
        updateRealTime();
    });
    //====================================================================================================
}

function initSparkline() {
    $(".sparkline").each(function () {
        var $this = $(this);
        $this.sparkline('html', $this.data());
    });
}

function initDonutChart() {
    Morris.Donut({
        element: 'donut_chart',
        data: [{
            label: 'Chrome',
            value: 37
        }, {
            label: 'Firefox',
            value: 30
        }, {
            label: 'Safari',
            value: 18
        }, {
            label: 'Opera',
            value: 12
        },
        {
            label: 'Other',
            value: 3
        }],
        colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(96, 125, 139)'],
        formatter: function (y) {
            return y + '%'
        }
    });
}

var data = [], totalPoints = 110;
function getRandomData() {
    if (data.length > 0) data = data.slice(1);

    while (data.length < totalPoints) {
        var prev = data.length > 0 ? data[data.length - 1] : 50, y = prev + Math.random() * 10 - 5;
        if (y < 0) { y = 0; } else if (y > 100) { y = 100; }

        data.push(y);
    }

    var res = [];
    for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]]);
    }

    return res;
}
$(function () {
    initLoading();
});

//Init Loading
function initLoading() {
    $('[data-toggle="cardloading"]').on('click', function () {
        var effect = $(this).data('loadingEffect');
        var $loading = $(this).parents('.card').waitMe({
            effect: effect,
            text: 'Loading...',
            bg: 'rgba(255,255,255,0.90)',
            color: '#555'
        });

        setTimeout(function () {
            //Loading hide
            $loading.waitMe('hide');
        }, 3200);
    });
}
$(function () {
    initLoading();
});

//Init Loading
function initLoading() {
    $('[data-toggle="cardloading"]').on('click', function () {
        var effect = $(this).data('loadingEffect');
        var color = $.AdminBSB.options.colors[$(this).data('loadingColor')];

        var $loading = $(this).parents('.card').waitMe({
            effect: effect,
            text: 'Loading...',
            bg: 'rgba(255,255,255,0.90)',
            color: color
        });

        setTimeout(function () {
            //Loading hide
            $loading.waitMe('hide');
        }, 3200);
    });
}
$(function () {
    new Chart(document.getElementById("line_chart").getContext("2d"), getChartJs('line'));
    new Chart(document.getElementById("bar_chart").getContext("2d"), getChartJs('bar'));
    new Chart(document.getElementById("radar_chart").getContext("2d"), getChartJs('radar'));
    new Chart(document.getElementById("pie_chart").getContext("2d"), getChartJs('pie'));
});

function getChartJs(type) {
    var config = null;

    if (type === 'line') {
        config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    borderColor: 'rgba(0, 188, 212, 0.75)',
                    backgroundColor: 'rgba(0, 188, 212, 0.3)',
                    pointBorderColor: 'rgba(0, 188, 212, 0)',
                    pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                    pointBorderWidth: 1
                }, {
                        label: "My Second dataset",
                        data: [28, 48, 40, 19, 86, 27, 90],
                        borderColor: 'rgba(233, 30, 99, 0.75)',
                        backgroundColor: 'rgba(233, 30, 99, 0.3)',
                        pointBorderColor: 'rgba(233, 30, 99, 0)',
                        pointBackgroundColor: 'rgba(233, 30, 99, 0.9)',
                        pointBorderWidth: 1
                    }]
            },
            options: {
                responsive: true,
                legend: false
            }
        }
    }
    else if (type === 'bar') {
        config = {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: 'rgba(0, 188, 212, 0.8)'
                }, {
                        label: "My Second dataset",
                        data: [28, 48, 40, 19, 86, 27, 90],
                        backgroundColor: 'rgba(233, 30, 99, 0.8)'
                    }]
            },
            options: {
                responsive: true,
                legend: false
            }
        }
    }
    else if (type === 'radar') {
        config = {
            type: 'radar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    data: [65, 25, 90, 81, 56, 55, 40],
                    borderColor: 'rgba(0, 188, 212, 0.8)',
                    backgroundColor: 'rgba(0, 188, 212, 0.5)',
                    pointBorderColor: 'rgba(0, 188, 212, 0)',
                    pointBackgroundColor: 'rgba(0, 188, 212, 0.8)',
                    pointBorderWidth: 1
                }, {
                        label: "My Second dataset",
                        data: [72, 48, 40, 19, 96, 27, 100],
                        borderColor: 'rgba(233, 30, 99, 0.8)',
                        backgroundColor: 'rgba(233, 30, 99, 0.5)',
                        pointBorderColor: 'rgba(233, 30, 99, 0)',
                        pointBackgroundColor: 'rgba(233, 30, 99, 0.8)',
                        pointBorderWidth: 1
                    }]
            },
            options: {
                responsive: true,
                legend: false
            }
        }
    }
    else if (type === 'pie') {
        config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [225, 50, 100, 40],
                    backgroundColor: [
                        "rgb(233, 30, 99)",
                        "rgb(255, 193, 7)",
                        "rgb(0, 188, 212)",
                        "rgb(139, 195, 74)"
                    ],
                }],
                labels: [
                    "Pink",
                    "Amber",
                    "Cyan",
                    "Light Green"
                ]
            },
            options: {
                responsive: true,
                legend: false
            }
        }
    }
    return config;
}
var data = [], totalPoints = 110;
var updateInterval = 320;
var realtime = 'on';

$(function () {
    //Real time ==========================================================================================
    var plot = $.plot('#real_time_chart', [getRandomData()], {
        series: {
            shadowSize: 0,
            color: 'rgb(0, 188, 212)'
        },
        grid: {
            borderColor: '#f3f3f3',
            borderWidth: 1,
            tickColor: '#f3f3f3'
        },
        lines: {
            fill: true
        },
        yaxis: {
            min: 0,
            max: 100
        },
        xaxis: {
            min: 0,
            max: 100
        }
    });

    function updateRealTime() {
        plot.setData([getRandomData()]);
        plot.draw();

        var timeout;
        if (realtime === 'on') {
            timeout = setTimeout(updateRealTime, updateInterval);
        } else {
            clearTimeout(timeout);
        }
    }

    updateRealTime();

    $('#realtime').on('change', function () {
        realtime = this.checked ? 'on' : 'off';
        updateRealTime();
    });
    //====================================================================================================

    //Tracking ===========================================================================================
    var sin = [], cos = [];
    for (var i = 0; i < 14; i += 0.1) {
        sin.push([i, Math.sin(i)]);
        cos.push([i, Math.cos(i)]);
    }

    var trackingData = [
        {
            data: sin,
            label: 'sin(x) = -0.00',
            color: '#E91E63'
        },
        {
            data: cos,
            label: 'cos(x) = -0.00',
            color: '#00BCD4'
        }
    ];

    var trackingPlot = $.plot('#tracking_chart', trackingData, {
        crosshair: {
            mode: 'x'
        },
        grid: {
            hoverable: true,
            autoHighlight: false,
            borderColor: '#f3f3f3',
            borderWidth: 1,
            tickColor: '#f3f3f3'
        },
        yaxis: {
            min: -1.2,
            max: 1.2
        }
    });

    var legends = $('#tracking_chart .legendLabel');

    legends.each(function () {
        $(this).css('width', $(this).width());
    });

    var updateLegendTimeout = null;
    var latestPosition = null;

    function updateLegend() {
        updateLegendTimeout = null;
        var pos = latestPosition;

        var axes = trackingPlot.getAxes();
        if (pos.x < axes.xaxis.min || pos.x > axes.xaxis.max ||
            pos.y < axes.yaxis.min || pos.y > axes.yaxis.max) {
            return;
        }

        var i, j, dataset = trackingPlot.getData();
        for (i = 0; i < dataset.length; ++i) {
            var series = dataset[i];

            for (j = 0; j < series.data.length; ++j) {
                if (series.data[j][0] > pos.x) {
                    break;
                }
            }

            var y, p1 = series.data[j - 1], p2 = series.data[j];

            if (p1 == null) {
                y = p2[1];
            } else if (p2 == null) {
                y = p1[1];
            } else {
                y = p1[1] + (p2[1] - p1[1]) * (pos.x - p1[0]) / (p2[0] - p1[0]);
            }

            legends.eq(i).text(series.label.replace(/=.*/, '= ' + y.toFixed(2)));
        }
    }

    $('#tracking_chart').bind('plothover', function (event, pos, item) {
        latestPosition = pos;
        if (!updateLegendTimeout) {
            updateLegendTimeout = setTimeout(updateLegend, 50);
        }
    });
    //====================================================================================================

    //MULTIPLE AXIS ======================================================================================
    var oilprices = [[1167692400000, 61.05], [1167778800000, 58.32], [1167865200000, 57.35], [1167951600000, 56.31], [1168210800000, 55.55], [1168297200000, 55.64], [1168383600000, 54.02], [1168470000000, 51.88], [1168556400000, 52.99], [1168815600000, 52.99], [1168902000000, 51.21], [1168988400000, 52.24], [1169074800000, 50.48], [1169161200000, 51.99], [1169420400000, 51.13], [1169506800000, 55.04], [1169593200000, 55.37], [1169679600000, 54.23], [1169766000000, 55.42], [1170025200000, 54.01], [1170111600000, 56.97], [1170198000000, 58.14], [1170284400000, 58.14], [1170370800000, 59.02], [1170630000000, 58.74], [1170716400000, 58.88], [1170802800000, 57.71], [1170889200000, 59.71], [1170975600000, 59.89], [1171234800000, 57.81], [1171321200000, 59.06], [1171407600000, 58.00], [1171494000000, 57.99], [1171580400000, 59.39], [1171839600000, 59.39], [1171926000000, 58.07], [1172012400000, 60.07], [1172098800000, 61.14], [1172444400000, 61.39], [1172530800000, 61.46], [1172617200000, 61.79], [1172703600000, 62.00], [1172790000000, 60.07], [1173135600000, 60.69], [1173222000000, 61.82], [1173308400000, 60.05], [1173654000000, 58.91], [1173740400000, 57.93], [1173826800000, 58.16], [1173913200000, 57.55], [1173999600000, 57.11], [1174258800000, 56.59], [1174345200000, 59.61], [1174518000000, 61.69], [1174604400000, 62.28], [1174860000000, 62.91], [1174946400000, 62.93], [1175032800000, 64.03], [1175119200000, 66.03], [1175205600000, 65.87], [1175464800000, 64.64], [1175637600000, 64.38], [1175724000000, 64.28], [1175810400000, 64.28], [1176069600000, 61.51], [1176156000000, 61.89], [1176242400000, 62.01], [1176328800000, 63.85], [1176415200000, 63.63], [1176674400000, 63.61], [1176760800000, 63.10], [1176847200000, 63.13], [1176933600000, 61.83], [1177020000000, 63.38], [1177279200000, 64.58], [1177452000000, 65.84], [1177538400000, 65.06], [1177624800000, 66.46], [1177884000000, 64.40], [1178056800000, 63.68], [1178143200000, 63.19], [1178229600000, 61.93], [1178488800000, 61.47], [1178575200000, 61.55], [1178748000000, 61.81], [1178834400000, 62.37], [1179093600000, 62.46], [1179180000000, 63.17], [1179266400000, 62.55], [1179352800000, 64.94], [1179698400000, 66.27], [1179784800000, 65.50], [1179871200000, 65.77], [1179957600000, 64.18], [1180044000000, 65.20], [1180389600000, 63.15], [1180476000000, 63.49], [1180562400000, 65.08], [1180908000000, 66.30], [1180994400000, 65.96], [1181167200000, 66.93], [1181253600000, 65.98], [1181599200000, 65.35], [1181685600000, 66.26], [1181858400000, 68.00], [1182117600000, 69.09], [1182204000000, 69.10], [1182290400000, 68.19], [1182376800000, 68.19], [1182463200000, 69.14], [1182722400000, 68.19], [1182808800000, 67.77], [1182895200000, 68.97], [1182981600000, 69.57], [1183068000000, 70.68], [1183327200000, 71.09], [1183413600000, 70.92], [1183586400000, 71.81], [1183672800000, 72.81], [1183932000000, 72.19], [1184018400000, 72.56], [1184191200000, 72.50], [1184277600000, 74.15], [1184623200000, 75.05], [1184796000000, 75.92], [1184882400000, 75.57], [1185141600000, 74.89], [1185228000000, 73.56], [1185314400000, 75.57], [1185400800000, 74.95], [1185487200000, 76.83], [1185832800000, 78.21], [1185919200000, 76.53], [1186005600000, 76.86], [1186092000000, 76.00], [1186437600000, 71.59], [1186696800000, 71.47], [1186956000000, 71.62], [1187042400000, 71.00], [1187301600000, 71.98], [1187560800000, 71.12], [1187647200000, 69.47], [1187733600000, 69.26], [1187820000000, 69.83], [1187906400000, 71.09], [1188165600000, 71.73], [1188338400000, 73.36], [1188511200000, 74.04], [1188856800000, 76.30], [1189116000000, 77.49], [1189461600000, 78.23], [1189548000000, 79.91], [1189634400000, 80.09], [1189720800000, 79.10], [1189980000000, 80.57], [1190066400000, 81.93], [1190239200000, 83.32], [1190325600000, 81.62], [1190584800000, 80.95], [1190671200000, 79.53], [1190757600000, 80.30], [1190844000000, 82.88], [1190930400000, 81.66], [1191189600000, 80.24], [1191276000000, 80.05], [1191362400000, 79.94], [1191448800000, 81.44], [1191535200000, 81.22], [1191794400000, 79.02], [1191880800000, 80.26], [1191967200000, 80.30], [1192053600000, 83.08], [1192140000000, 83.69], [1192399200000, 86.13], [1192485600000, 87.61], [1192572000000, 87.40], [1192658400000, 89.47], [1192744800000, 88.60], [1193004000000, 87.56], [1193090400000, 87.56], [1193176800000, 87.10], [1193263200000, 91.86], [1193612400000, 93.53], [1193698800000, 94.53], [1193871600000, 95.93], [1194217200000, 93.98], [1194303600000, 96.37], [1194476400000, 95.46], [1194562800000, 96.32], [1195081200000, 93.43], [1195167600000, 95.10], [1195426800000, 94.64], [1195513200000, 95.10], [1196031600000, 97.70], [1196118000000, 94.42], [1196204400000, 90.62], [1196290800000, 91.01], [1196377200000, 88.71], [1196636400000, 88.32], [1196809200000, 90.23], [1196982000000, 88.28], [1197241200000, 87.86], [1197327600000, 90.02], [1197414000000, 92.25], [1197586800000, 90.63], [1197846000000, 90.63], [1197932400000, 90.49], [1198018800000, 91.24], [1198105200000, 91.06], [1198191600000, 90.49], [1198710000000, 96.62], [1198796400000, 96.00], [1199142000000, 99.62], [1199314800000, 99.18], [1199401200000, 95.09], [1199660400000, 96.33], [1199833200000, 95.67], [1200351600000, 91.90], [1200438000000, 90.84], [1200524400000, 90.13], [1200610800000, 90.57], [1200956400000, 89.21], [1201042800000, 86.99], [1201129200000, 89.85], [1201474800000, 90.99], [1201561200000, 91.64], [1201647600000, 92.33], [1201734000000, 91.75], [1202079600000, 90.02], [1202166000000, 88.41], [1202252400000, 87.14], [1202338800000, 88.11], [1202425200000, 91.77], [1202770800000, 92.78], [1202857200000, 93.27], [1202943600000, 95.46], [1203030000000, 95.46], [1203289200000, 101.74], [1203462000000, 98.81], [1203894000000, 100.88], [1204066800000, 99.64], [1204153200000, 102.59], [1204239600000, 101.84], [1204498800000, 99.52], [1204585200000, 99.52], [1204671600000, 104.52], [1204758000000, 105.47], [1204844400000, 105.15], [1205103600000, 108.75], [1205276400000, 109.92], [1205362800000, 110.33], [1205449200000, 110.21], [1205708400000, 105.68], [1205967600000, 101.84], [1206313200000, 100.86], [1206399600000, 101.22], [1206486000000, 105.90], [1206572400000, 107.58], [1206658800000, 105.62], [1206914400000, 101.58], [1207000800000, 100.98], [1207173600000, 103.83], [1207260000000, 106.23], [1207605600000, 108.50], [1207778400000, 110.11], [1207864800000, 110.14], [1208210400000, 113.79], [1208296800000, 114.93], [1208383200000, 114.86], [1208728800000, 117.48], [1208815200000, 118.30], [1208988000000, 116.06], [1209074400000, 118.52], [1209333600000, 118.75], [1209420000000, 113.46], [1209592800000, 112.52], [1210024800000, 121.84], [1210111200000, 123.53], [1210197600000, 123.69], [1210543200000, 124.23], [1210629600000, 125.80], [1210716000000, 126.29], [1211148000000, 127.05], [1211320800000, 129.07], [1211493600000, 132.19], [1211839200000, 128.85], [1212357600000, 127.76], [1212703200000, 138.54], [1212962400000, 136.80], [1213135200000, 136.38], [1213308000000, 134.86], [1213653600000, 134.01], [1213740000000, 136.68], [1213912800000, 135.65], [1214172000000, 134.62], [1214258400000, 134.62], [1214344800000, 134.62], [1214431200000, 139.64], [1214517600000, 140.21], [1214776800000, 140.00], [1214863200000, 140.97], [1214949600000, 143.57], [1215036000000, 145.29], [1215381600000, 141.37], [1215468000000, 136.04], [1215727200000, 146.40], [1215986400000, 145.18], [1216072800000, 138.74], [1216159200000, 134.60], [1216245600000, 129.29], [1216332000000, 130.65], [1216677600000, 127.95], [1216850400000, 127.95], [1217282400000, 122.19], [1217455200000, 124.08], [1217541600000, 125.10], [1217800800000, 121.41], [1217887200000, 119.17], [1217973600000, 118.58], [1218060000000, 120.02], [1218405600000, 114.45], [1218492000000, 113.01], [1218578400000, 116.00], [1218751200000, 113.77], [1219010400000, 112.87], [1219096800000, 114.53], [1219269600000, 114.98], [1219356000000, 114.98], [1219701600000, 116.27], [1219788000000, 118.15], [1219874400000, 115.59], [1219960800000, 115.46], [1220306400000, 109.71], [1220392800000, 109.35], [1220565600000, 106.23], [1220824800000, 106.34]];

    var exchangerates = [[1167606000000, 0.7580], [1167692400000, 0.7580], [1167778800000, 0.75470], [1167865200000, 0.75490], [1167951600000, 0.76130], [1168038000000, 0.76550], [1168124400000, 0.76930], [1168210800000, 0.76940], [1168297200000, 0.76880], [1168383600000, 0.76780], [1168470000000, 0.77080], [1168556400000, 0.77270], [1168642800000, 0.77490], [1168729200000, 0.77410], [1168815600000, 0.77410], [1168902000000, 0.77320], [1168988400000, 0.77270], [1169074800000, 0.77370], [1169161200000, 0.77240], [1169247600000, 0.77120], [1169334000000, 0.7720], [1169420400000, 0.77210], [1169506800000, 0.77170], [1169593200000, 0.77040], [1169679600000, 0.7690], [1169766000000, 0.77110], [1169852400000, 0.7740], [1169938800000, 0.77450], [1170025200000, 0.77450], [1170111600000, 0.7740], [1170198000000, 0.77160], [1170284400000, 0.77130], [1170370800000, 0.76780], [1170457200000, 0.76880], [1170543600000, 0.77180], [1170630000000, 0.77180], [1170716400000, 0.77280], [1170802800000, 0.77290], [1170889200000, 0.76980], [1170975600000, 0.76850], [1171062000000, 0.76810], [1171148400000, 0.7690], [1171234800000, 0.7690], [1171321200000, 0.76980], [1171407600000, 0.76990], [1171494000000, 0.76510], [1171580400000, 0.76130], [1171666800000, 0.76160], [1171753200000, 0.76140], [1171839600000, 0.76140], [1171926000000, 0.76070], [1172012400000, 0.76020], [1172098800000, 0.76110], [1172185200000, 0.76220], [1172271600000, 0.76150], [1172358000000, 0.75980], [1172444400000, 0.75980], [1172530800000, 0.75920], [1172617200000, 0.75730], [1172703600000, 0.75660], [1172790000000, 0.75670], [1172876400000, 0.75910], [1172962800000, 0.75820], [1173049200000, 0.75850], [1173135600000, 0.76130], [1173222000000, 0.76310], [1173308400000, 0.76150], [1173394800000, 0.760], [1173481200000, 0.76130], [1173567600000, 0.76270], [1173654000000, 0.76270], [1173740400000, 0.76080], [1173826800000, 0.75830], [1173913200000, 0.75750], [1173999600000, 0.75620], [1174086000000, 0.7520], [1174172400000, 0.75120], [1174258800000, 0.75120], [1174345200000, 0.75170], [1174431600000, 0.7520], [1174518000000, 0.75110], [1174604400000, 0.7480], [1174690800000, 0.75090], [1174777200000, 0.75310], [1174860000000, 0.75310], [1174946400000, 0.75270], [1175032800000, 0.74980], [1175119200000, 0.74930], [1175205600000, 0.75040], [1175292000000, 0.750], [1175378400000, 0.74910], [1175464800000, 0.74910], [1175551200000, 0.74850], [1175637600000, 0.74840], [1175724000000, 0.74920], [1175810400000, 0.74710], [1175896800000, 0.74590], [1175983200000, 0.74770], [1176069600000, 0.74770], [1176156000000, 0.74830], [1176242400000, 0.74580], [1176328800000, 0.74480], [1176415200000, 0.7430], [1176501600000, 0.73990], [1176588000000, 0.73950], [1176674400000, 0.73950], [1176760800000, 0.73780], [1176847200000, 0.73820], [1176933600000, 0.73620], [1177020000000, 0.73550], [1177106400000, 0.73480], [1177192800000, 0.73610], [1177279200000, 0.73610], [1177365600000, 0.73650], [1177452000000, 0.73620], [1177538400000, 0.73310], [1177624800000, 0.73390], [1177711200000, 0.73440], [1177797600000, 0.73270], [1177884000000, 0.73270], [1177970400000, 0.73360], [1178056800000, 0.73330], [1178143200000, 0.73590], [1178229600000, 0.73590], [1178316000000, 0.73720], [1178402400000, 0.7360], [1178488800000, 0.7360], [1178575200000, 0.7350], [1178661600000, 0.73650], [1178748000000, 0.73840], [1178834400000, 0.73950], [1178920800000, 0.74130], [1179007200000, 0.73970], [1179093600000, 0.73960], [1179180000000, 0.73850], [1179266400000, 0.73780], [1179352800000, 0.73660], [1179439200000, 0.740], [1179525600000, 0.74110], [1179612000000, 0.74060], [1179698400000, 0.74050], [1179784800000, 0.74140], [1179871200000, 0.74310], [1179957600000, 0.74310], [1180044000000, 0.74380], [1180130400000, 0.74430], [1180216800000, 0.74430], [1180303200000, 0.74430], [1180389600000, 0.74340], [1180476000000, 0.74290], [1180562400000, 0.74420], [1180648800000, 0.7440], [1180735200000, 0.74390], [1180821600000, 0.74370], [1180908000000, 0.74370], [1180994400000, 0.74290], [1181080800000, 0.74030], [1181167200000, 0.73990], [1181253600000, 0.74180], [1181340000000, 0.74680], [1181426400000, 0.7480], [1181512800000, 0.7480], [1181599200000, 0.7490], [1181685600000, 0.74940], [1181772000000, 0.75220], [1181858400000, 0.75150], [1181944800000, 0.75020], [1182031200000, 0.74720], [1182117600000, 0.74720], [1182204000000, 0.74620], [1182290400000, 0.74550], [1182376800000, 0.74490], [1182463200000, 0.74670], [1182549600000, 0.74580], [1182636000000, 0.74270], [1182722400000, 0.74270], [1182808800000, 0.7430], [1182895200000, 0.74290], [1182981600000, 0.7440], [1183068000000, 0.7430], [1183154400000, 0.74220], [1183240800000, 0.73880], [1183327200000, 0.73880], [1183413600000, 0.73690], [1183500000000, 0.73450], [1183586400000, 0.73450], [1183672800000, 0.73450], [1183759200000, 0.73520], [1183845600000, 0.73410], [1183932000000, 0.73410], [1184018400000, 0.7340], [1184104800000, 0.73240], [1184191200000, 0.72720], [1184277600000, 0.72640], [1184364000000, 0.72550], [1184450400000, 0.72580], [1184536800000, 0.72580], [1184623200000, 0.72560], [1184709600000, 0.72570], [1184796000000, 0.72470], [1184882400000, 0.72430], [1184968800000, 0.72440], [1185055200000, 0.72350], [1185141600000, 0.72350], [1185228000000, 0.72350], [1185314400000, 0.72350], [1185400800000, 0.72620], [1185487200000, 0.72880], [1185573600000, 0.73010], [1185660000000, 0.73370], [1185746400000, 0.73370], [1185832800000, 0.73240], [1185919200000, 0.72970], [1186005600000, 0.73170], [1186092000000, 0.73150], [1186178400000, 0.72880], [1186264800000, 0.72630], [1186351200000, 0.72630], [1186437600000, 0.72420], [1186524000000, 0.72530], [1186610400000, 0.72640], [1186696800000, 0.7270], [1186783200000, 0.73120], [1186869600000, 0.73050], [1186956000000, 0.73050], [1187042400000, 0.73180], [1187128800000, 0.73580], [1187215200000, 0.74090], [1187301600000, 0.74540], [1187388000000, 0.74370], [1187474400000, 0.74240], [1187560800000, 0.74240], [1187647200000, 0.74150], [1187733600000, 0.74190], [1187820000000, 0.74140], [1187906400000, 0.73770], [1187992800000, 0.73550], [1188079200000, 0.73150], [1188165600000, 0.73150], [1188252000000, 0.7320], [1188338400000, 0.73320], [1188424800000, 0.73460], [1188511200000, 0.73280], [1188597600000, 0.73230], [1188684000000, 0.7340], [1188770400000, 0.7340], [1188856800000, 0.73360], [1188943200000, 0.73510], [1189029600000, 0.73460], [1189116000000, 0.73210], [1189202400000, 0.72940], [1189288800000, 0.72660], [1189375200000, 0.72660], [1189461600000, 0.72540], [1189548000000, 0.72420], [1189634400000, 0.72130], [1189720800000, 0.71970], [1189807200000, 0.72090], [1189893600000, 0.7210], [1189980000000, 0.7210], [1190066400000, 0.7210], [1190152800000, 0.72090], [1190239200000, 0.71590], [1190325600000, 0.71330], [1190412000000, 0.71050], [1190498400000, 0.70990], [1190584800000, 0.70990], [1190671200000, 0.70930], [1190757600000, 0.70930], [1190844000000, 0.70760], [1190930400000, 0.7070], [1191016800000, 0.70490], [1191103200000, 0.70120], [1191189600000, 0.70110], [1191276000000, 0.70190], [1191362400000, 0.70460], [1191448800000, 0.70630], [1191535200000, 0.70890], [1191621600000, 0.70770], [1191708000000, 0.70770], [1191794400000, 0.70770], [1191880800000, 0.70910], [1191967200000, 0.71180], [1192053600000, 0.70790], [1192140000000, 0.70530], [1192226400000, 0.7050], [1192312800000, 0.70550], [1192399200000, 0.70550], [1192485600000, 0.70450], [1192572000000, 0.70510], [1192658400000, 0.70510], [1192744800000, 0.70170], [1192831200000, 0.70], [1192917600000, 0.69950], [1193004000000, 0.69940], [1193090400000, 0.70140], [1193176800000, 0.70360], [1193263200000, 0.70210], [1193349600000, 0.70020], [1193436000000, 0.69670], [1193522400000, 0.6950], [1193612400000, 0.6950], [1193698800000, 0.69390], [1193785200000, 0.6940], [1193871600000, 0.69220], [1193958000000, 0.69190], [1194044400000, 0.69140], [1194130800000, 0.68940], [1194217200000, 0.68910], [1194303600000, 0.69040], [1194390000000, 0.6890], [1194476400000, 0.68340], [1194562800000, 0.68230], [1194649200000, 0.68070], [1194735600000, 0.68150], [1194822000000, 0.68150], [1194908400000, 0.68470], [1194994800000, 0.68590], [1195081200000, 0.68220], [1195167600000, 0.68270], [1195254000000, 0.68370], [1195340400000, 0.68230], [1195426800000, 0.68220], [1195513200000, 0.68220], [1195599600000, 0.67920], [1195686000000, 0.67460], [1195772400000, 0.67350], [1195858800000, 0.67310], [1195945200000, 0.67420], [1196031600000, 0.67440], [1196118000000, 0.67390], [1196204400000, 0.67310], [1196290800000, 0.67610], [1196377200000, 0.67610], [1196463600000, 0.67850], [1196550000000, 0.68180], [1196636400000, 0.68360], [1196722800000, 0.68230], [1196809200000, 0.68050], [1196895600000, 0.67930], [1196982000000, 0.68490], [1197068400000, 0.68330], [1197154800000, 0.68250], [1197241200000, 0.68250], [1197327600000, 0.68160], [1197414000000, 0.67990], [1197500400000, 0.68130], [1197586800000, 0.68090], [1197673200000, 0.68680], [1197759600000, 0.69330], [1197846000000, 0.69330], [1197932400000, 0.69450], [1198018800000, 0.69440], [1198105200000, 0.69460], [1198191600000, 0.69640], [1198278000000, 0.69650], [1198364400000, 0.69560], [1198450800000, 0.69560], [1198537200000, 0.6950], [1198623600000, 0.69480], [1198710000000, 0.69280], [1198796400000, 0.68870], [1198882800000, 0.68240], [1198969200000, 0.67940], [1199055600000, 0.67940], [1199142000000, 0.68030], [1199228400000, 0.68550], [1199314800000, 0.68240], [1199401200000, 0.67910], [1199487600000, 0.67830], [1199574000000, 0.67850], [1199660400000, 0.67850], [1199746800000, 0.67970], [1199833200000, 0.680], [1199919600000, 0.68030], [1200006000000, 0.68050], [1200092400000, 0.6760], [1200178800000, 0.6770], [1200265200000, 0.6770], [1200351600000, 0.67360], [1200438000000, 0.67260], [1200524400000, 0.67640], [1200610800000, 0.68210], [1200697200000, 0.68310], [1200783600000, 0.68420], [1200870000000, 0.68420], [1200956400000, 0.68870], [1201042800000, 0.69030], [1201129200000, 0.68480], [1201215600000, 0.68240], [1201302000000, 0.67880], [1201388400000, 0.68140], [1201474800000, 0.68140], [1201561200000, 0.67970], [1201647600000, 0.67690], [1201734000000, 0.67650], [1201820400000, 0.67330], [1201906800000, 0.67290], [1201993200000, 0.67580], [1202079600000, 0.67580], [1202166000000, 0.6750], [1202252400000, 0.6780], [1202338800000, 0.68330], [1202425200000, 0.68560], [1202511600000, 0.69030], [1202598000000, 0.68960], [1202684400000, 0.68960], [1202770800000, 0.68820], [1202857200000, 0.68790], [1202943600000, 0.68620], [1203030000000, 0.68520], [1203116400000, 0.68230], [1203202800000, 0.68130], [1203289200000, 0.68130], [1203375600000, 0.68220], [1203462000000, 0.68020], [1203548400000, 0.68020], [1203634800000, 0.67840], [1203721200000, 0.67480], [1203807600000, 0.67470], [1203894000000, 0.67470], [1203980400000, 0.67480], [1204066800000, 0.67330], [1204153200000, 0.6650], [1204239600000, 0.66110], [1204326000000, 0.65830], [1204412400000, 0.6590], [1204498800000, 0.6590], [1204585200000, 0.65810], [1204671600000, 0.65780], [1204758000000, 0.65740], [1204844400000, 0.65320], [1204930800000, 0.65020], [1205017200000, 0.65140], [1205103600000, 0.65140], [1205190000000, 0.65070], [1205276400000, 0.6510], [1205362800000, 0.64890], [1205449200000, 0.64240], [1205535600000, 0.64060], [1205622000000, 0.63820], [1205708400000, 0.63820], [1205794800000, 0.63410], [1205881200000, 0.63440], [1205967600000, 0.63780], [1206054000000, 0.64390], [1206140400000, 0.64780], [1206226800000, 0.64810], [1206313200000, 0.64810], [1206399600000, 0.64940], [1206486000000, 0.64380], [1206572400000, 0.63770], [1206658800000, 0.63290], [1206745200000, 0.63360], [1206831600000, 0.63330], [1206914400000, 0.63330], [1207000800000, 0.6330], [1207087200000, 0.63710], [1207173600000, 0.64030], [1207260000000, 0.63960], [1207346400000, 0.63640], [1207432800000, 0.63560], [1207519200000, 0.63560], [1207605600000, 0.63680], [1207692000000, 0.63570], [1207778400000, 0.63540], [1207864800000, 0.6320], [1207951200000, 0.63320], [1208037600000, 0.63280], [1208124000000, 0.63310], [1208210400000, 0.63420], [1208296800000, 0.63210], [1208383200000, 0.63020], [1208469600000, 0.62780], [1208556000000, 0.63080], [1208642400000, 0.63240], [1208728800000, 0.63240], [1208815200000, 0.63070], [1208901600000, 0.62770], [1208988000000, 0.62690], [1209074400000, 0.63350], [1209160800000, 0.63920], [1209247200000, 0.640], [1209333600000, 0.64010], [1209420000000, 0.63960], [1209506400000, 0.64070], [1209592800000, 0.64230], [1209679200000, 0.64290], [1209765600000, 0.64720], [1209852000000, 0.64850], [1209938400000, 0.64860], [1210024800000, 0.64670], [1210111200000, 0.64440], [1210197600000, 0.64670], [1210284000000, 0.65090], [1210370400000, 0.64780], [1210456800000, 0.64610], [1210543200000, 0.64610], [1210629600000, 0.64680], [1210716000000, 0.64490], [1210802400000, 0.6470], [1210888800000, 0.64610], [1210975200000, 0.64520], [1211061600000, 0.64220], [1211148000000, 0.64220], [1211234400000, 0.64250], [1211320800000, 0.64140], [1211407200000, 0.63660], [1211493600000, 0.63460], [1211580000000, 0.6350], [1211666400000, 0.63460], [1211752800000, 0.63460], [1211839200000, 0.63430], [1211925600000, 0.63460], [1212012000000, 0.63790], [1212098400000, 0.64160], [1212184800000, 0.64420], [1212271200000, 0.64310], [1212357600000, 0.64310], [1212444000000, 0.64350], [1212530400000, 0.6440], [1212616800000, 0.64730], [1212703200000, 0.64690], [1212789600000, 0.63860], [1212876000000, 0.63560], [1212962400000, 0.6340], [1213048800000, 0.63460], [1213135200000, 0.6430], [1213221600000, 0.64520], [1213308000000, 0.64670], [1213394400000, 0.65060], [1213480800000, 0.65040], [1213567200000, 0.65030], [1213653600000, 0.64810], [1213740000000, 0.64510], [1213826400000, 0.6450], [1213912800000, 0.64410], [1213999200000, 0.64140], [1214085600000, 0.64090], [1214172000000, 0.64090], [1214258400000, 0.64280], [1214344800000, 0.64310], [1214431200000, 0.64180], [1214517600000, 0.63710], [1214604000000, 0.63490], [1214690400000, 0.63330], [1214776800000, 0.63340], [1214863200000, 0.63380], [1214949600000, 0.63420], [1215036000000, 0.6320], [1215122400000, 0.63180], [1215208800000, 0.6370], [1215295200000, 0.63680], [1215381600000, 0.63680], [1215468000000, 0.63830], [1215554400000, 0.63710], [1215640800000, 0.63710], [1215727200000, 0.63550], [1215813600000, 0.6320], [1215900000000, 0.62770], [1215986400000, 0.62760], [1216072800000, 0.62910], [1216159200000, 0.62740], [1216245600000, 0.62930], [1216332000000, 0.63110], [1216418400000, 0.6310], [1216504800000, 0.63120], [1216591200000, 0.63120], [1216677600000, 0.63040], [1216764000000, 0.62940], [1216850400000, 0.63480], [1216936800000, 0.63780], [1217023200000, 0.63680], [1217109600000, 0.63680], [1217196000000, 0.63680], [1217282400000, 0.6360], [1217368800000, 0.6370], [1217455200000, 0.64180], [1217541600000, 0.64110], [1217628000000, 0.64350], [1217714400000, 0.64270], [1217800800000, 0.64270], [1217887200000, 0.64190], [1217973600000, 0.64460], [1218060000000, 0.64680], [1218146400000, 0.64870], [1218232800000, 0.65940], [1218319200000, 0.66660], [1218405600000, 0.66660], [1218492000000, 0.66780], [1218578400000, 0.67120], [1218664800000, 0.67050], [1218751200000, 0.67180], [1218837600000, 0.67840], [1218924000000, 0.68110], [1219010400000, 0.68110], [1219096800000, 0.67940], [1219183200000, 0.68040], [1219269600000, 0.67810], [1219356000000, 0.67560], [1219442400000, 0.67350], [1219528800000, 0.67630], [1219615200000, 0.67620], [1219701600000, 0.67770], [1219788000000, 0.68150], [1219874400000, 0.68020], [1219960800000, 0.6780], [1220047200000, 0.67960], [1220133600000, 0.68170], [1220220000000, 0.68170], [1220306400000, 0.68320], [1220392800000, 0.68770], [1220479200000, 0.69120], [1220565600000, 0.69140], [1220652000000, 0.70090], [1220738400000, 0.70120], [1220824800000, 0.7010], [1220911200000, 0.70050]];

    function euroFormatter(v, axis) {
        return v.toFixed(axis.tickDecimals) + '€';
    }

    $.plot('#multiple_axis_chart', [
        { data: oilprices, label: 'Oil price ($)', color: '#E91E63' },
        { data: exchangerates, label: 'USD/EUR exchange rate', yaxis: 2, color: '#00BCD4' }
    ], {
        xaxes: [{ mode: 'time' }],
        yaxes: [{ min: 0 }, {
            alignTicksWithAxis: 1,
            position: 'right',
            tickFormatter: euroFormatter
        }],
        grid: {
            hoverable: true,
            autoHighlight: false,
            borderColor: '#f3f3f3',
            borderWidth: 1,
            tickColor: '#f3f3f3'
        },
        legend: { position: 'sw' }
    });
    //====================================================================================================

    //BAR CHART ==========================================================================================
    var barChartData = [];
    for (var i = 0; i <= 10; i += 1) {
        barChartData.push([i, parseInt(Math.random() * 30)]);
    }

    $.plot('#bar_chart', [barChartData], {
        series: {
            stack: 0,
            lines: {
                show: false,
                fill: true,
                steps: false
            },
            bars: {
                show: true,
                barWidth: 0.6
            },
            color: '#00BCD4'
        },
        grid: {
            hoverable: true,
            autoHighlight: false,
            borderColor: '#f3f3f3',
            borderWidth: 1,
            tickColor: '#f3f3f3'
        }
    });
    //====================================================================================================

    //PIE CHART ==========================================================================================
    var pieChartData = [], pieChartSeries = 4;
    var pieChartColors = ['#E91E63', '#03A9F4', '#FFC107', '#009688'];
    var pieChartDatas = [45, 17, 28, 10];

    for (var i = 0; i < pieChartSeries; i++) {
        pieChartData[i] = {
            label: 'Serie - ' + (i + 1),
            data: pieChartDatas[i],
            color: pieChartColors[i]
        }
    }
    $.plot('#pie_chart', pieChartData, {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 3 / 4,
                    formatter: labelFormatter,
                    background: {
                        opacity: 0.5
                    }
                }
            }
        },
        legend: {
            show: false
        }
    });
    function labelFormatter(label, series) {
        return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
    }
    //====================================================================================================
});

function getRandomData() {
    if (data.length > 0) data = data.slice(1);

    while (data.length < totalPoints) {
        var prev = data.length > 0 ? data[data.length - 1] : 50, y = prev + Math.random() * 10 - 5;
        if (y < 0) { y = 0; } else if (y > 100) { y = 100; }

        data.push(y);
    }

    var res = [];
    for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
    }

    return res;
}
$(function () {
    $('.knob').knob({
        draw: function () {
            // "tron" case
            if (this.$.data('skin') == 'tron') {

                var a = this.angle(this.cv)  // Angle
                    , sa = this.startAngle          // Previous start angle
                    , sat = this.startAngle         // Start angle
                    , ea                            // Previous end angle
                    , eat = sat + a                 // End angle
                    , r = true;

                this.g.lineWidth = this.lineWidth;

                this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3);

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value);
                    this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.previousColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
    });
});
$(function () {
    getMorris('line', 'line_chart');
    getMorris('bar', 'bar_chart');
    getMorris('area', 'area_chart');
    getMorris('donut', 'donut_chart');
});


function getMorris(type, element) {
    if (type === 'line') {
        Morris.Line({
            element: element,
            data: [{
                'period': '2011 Q3',
                'licensed': 3407,
                'sorned': 660
            }, {
                    'period': '2011 Q2',
                    'licensed': 3351,
                    'sorned': 629
                }, {
                    'period': '2011 Q1',
                    'licensed': 3269,
                    'sorned': 618
                }, {
                    'period': '2010 Q4',
                    'licensed': 3246,
                    'sorned': 661
                }, {
                    'period': '2009 Q4',
                    'licensed': 3171,
                    'sorned': 676
                }, {
                    'period': '2008 Q4',
                    'licensed': 3155,
                    'sorned': 681
                }, {
                    'period': '2007 Q4',
                    'licensed': 3226,
                    'sorned': 620
                }, {
                    'period': '2006 Q4',
                    'licensed': 3245,
                    'sorned': null
                }, {
                    'period': '2005 Q4',
                    'licensed': 3289,
                    'sorned': null
                }],
            xkey: 'period',
            ykeys: ['licensed', 'sorned'],
            labels: ['Licensed', 'Off the road'],
            lineColors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)'],
            lineWidth: 3
        });
    } else if (type === 'bar') {
        Morris.Bar({
            element: element,
            data: [{
                x: '2011 Q1',
                y: 3,
                z: 2,
                a: 3
            }, {
                    x: '2011 Q2',
                    y: 2,
                    z: null,
                    a: 1
                }, {
                    x: '2011 Q3',
                    y: 0,
                    z: 2,
                    a: 4
                }, {
                    x: '2011 Q4',
                    y: 2,
                    z: 4,
                    a: 3
                }],
            xkey: 'x',
            ykeys: ['y', 'z', 'a'],
            labels: ['Y', 'Z', 'A'],
            barColors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(0, 150, 136)'],
        });
    } else if (type === 'area') {
        Morris.Area({
            element: element,
            data: [{
                period: '2010 Q1',
                iphone: 2666,
                ipad: null,
                itouch: 2647
            }, {
                    period: '2010 Q2',
                    iphone: 2778,
                    ipad: 2294,
                    itouch: 2441
                }, {
                    period: '2010 Q3',
                    iphone: 4912,
                    ipad: 1969,
                    itouch: 2501
                }, {
                    period: '2010 Q4',
                    iphone: 3767,
                    ipad: 3597,
                    itouch: 5689
                }, {
                    period: '2011 Q1',
                    iphone: 6810,
                    ipad: 1914,
                    itouch: 2293
                }, {
                    period: '2011 Q2',
                    iphone: 5670,
                    ipad: 4293,
                    itouch: 1881
                }, {
                    period: '2011 Q3',
                    iphone: 4820,
                    ipad: 3795,
                    itouch: 1588
                }, {
                    period: '2011 Q4',
                    iphone: 15073,
                    ipad: 5967,
                    itouch: 5175
                }, {
                    period: '2012 Q1',
                    iphone: 10687,
                    ipad: 4460,
                    itouch: 2028
                }, {
                    period: '2012 Q2',
                    iphone: 8432,
                    ipad: 5713,
                    itouch: 1791
                }],
            xkey: 'period',
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['iPhone', 'iPad', 'iPod Touch'],
            pointSize: 2,
            hideHover: 'auto',
            lineColors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(0, 150, 136)']
        });
    } else if (type === 'donut') {
        Morris.Donut({
            element: element,
            data: [{
                label: 'Jam',
                value: 25
            }, {
                    label: 'Frosted',
                    value: 40
                }, {
                    label: 'Custard',
                    value: 25
                }, {
                    label: 'Sugar',
                    value: 10
                }],
            colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)'],
            formatter: function (y) {
                return y + '%'
            }
        });
    }
}
$(function () {
    $(".sparkline").each(function () {
        var $this = $(this);
        $this.sparkline('html', $this.data());
    });

    $('.sparkline-pie').sparkline('html', {
        type: 'pie',
        offset: 90,
        width: '150px',
        height: '150px',
        sliceColors: ['#E91E63', '#00BCD4', '#FFC107']
    })

    drawDocSparklines();
    drawMouseSpeedDemo();
});

//Taken from http://omnipotent.net/jquery.sparkline ================
function drawDocSparklines() {

    // Bar + line composite charts
    $('#compositebar').sparkline('html', { type: 'bar', barColor: '#aaf' });
    $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        { composite: true, fillColor: false, lineColor: 'red' });


    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline();

    // Larger line charts for the docs
    $('.largeline').sparkline('html',
        { type: 'line', height: '2.5em', width: '4em' });

    // Customized line chart
    $('#linecustom').sparkline('html',
        {
            height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
            minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3
        });

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', { type: 'bar' });

    $('.barformat').sparkline([1, 3, 5, 3, 8], {
        type: 'bar',
        tooltipFormat: '{{value:levels}} - {{value}}',
        tooltipValueLookups: {
            levels: $.range_map({ ':2': 'Low', '3:6': 'Medium', '7:': 'High' })
        }
    });

    // Tri-state charts using inline values
    $('.sparktristate').sparkline('html', { type: 'tristate' });
    $('.sparktristatecols').sparkline('html',
        { type: 'tristate', colorMap: { '-2': '#fa7', '2': '#44f' } });

    // Composite line charts, the second using values supplied via javascript
    $('#compositeline').sparkline('html', { fillColor: false, changeRangeMin: 0, chartRangeMax: 10 });
    $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
        { composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10 });

    // Line charts with normal range marker
    $('#normalline').sparkline('html',
        { fillColor: false, normalRangeMin: -1, normalRangeMax: 8 });
    $('#normalExample').sparkline('html',
        { fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4' });

    // Discrete charts
    $('.discrete1').sparkline('html',
        { type: 'discrete', lineColor: 'blue', xwidth: 18 });
    $('#discrete2').sparkline('html',
        { type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4 });

    // Bullet charts
    $('.sparkbullet').sparkline('html', { type: 'bullet' });

    // Pie charts
    $('.sparkpie').sparkline('html', { type: 'pie', height: '1.0em' });

    // Box plots
    $('.sparkboxplot').sparkline('html', { type: 'box' });
    $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
        { type: 'box', raw: true, showOutliers: true, target: 6 });

    // Box plot with specific field order
    $('.boxfieldorder').sparkline('html', {
        type: 'box',
        tooltipFormatFieldlist: ['med', 'lq', 'uq'],
        tooltipFormatFieldlistKey: 'field'
    });

    // click event demo sparkline
    $('.clickdemo').sparkline();
    $('.clickdemo').bind('sparklineClick', function (ev) {
        var sparkline = ev.sparklines[0],
            region = sparkline.getCurrentRegionFields();
        value = region.y;
        alert("Clicked on x=" + region.x + " y=" + region.y);
    });

    // mouseover event demo sparkline
    $('.mouseoverdemo').sparkline();
    $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
        var sparkline = ev.sparklines[0],
            region = sparkline.getCurrentRegionFields();
        value = region.y;
        $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
    }).bind('mouseleave', function () {
        $('.mouseoverregion').text('');
    });
}

/**
 ** Draw the little mouse speed animated graph
 ** This just attaches a handler to the mousemove event to see
 ** (roughly) how far the mouse has moved
 ** and then updates the display a couple of times a second via
 ** setTimeout()
 **/
function drawMouseSpeedDemo() {
    var mrefreshinterval = 500; // update display every 500ms
    var lastmousex = -1;
    var lastmousey = -1;
    var lastmousetime;
    var mousetravel = 0;
    var mpoints = [];
    var mpoints_max = 30;
    $('html').mousemove(function (e) {
        var mousex = e.pageX;
        var mousey = e.pageY;
        if (lastmousex > -1) {
            mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
        }
        lastmousex = mousex;
        lastmousey = mousey;
    });
    var mdraw = function () {
        var md = new Date();
        var timenow = md.getTime();
        if (lastmousetime && lastmousetime != timenow) {
            var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
            mpoints.push(pps);
            if (mpoints.length > mpoints_max)
                mpoints.splice(0, 1);
            mousetravel = 0;
            $('#mousespeed').sparkline(mpoints, { width: mpoints.length * 2, tooltipSuffix: ' pixels per second' });
        }
        lastmousetime = timenow;
        setTimeout(mdraw, mrefreshinterval);
    };
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
}

//=================================================================
$(function () {
    $('#forgot_password').validate({
        highlight: function (input) {
            console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
        }
    });
});
$(function () {
    $('#sign_in').validate({
        highlight: function (input) {
            console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
        }
    });
});
$(function () {
    $('#sign_up').validate({
        rules: {
            'terms': {
                required: true
            },
            'confirm': {
                equalTo: '[name="password"]'
            }
        },
        highlight: function (input) {
            console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        }
    });
});
$(function () {
    $('.colorpicker').colorpicker();

    //Dropzone
    Dropzone.options.frmFileUpload = {
        paramName: "file",
        maxFilesize: 2
    };

    //Masked Input ============================================================================================================================
    var $demoMaskedInput = $('.demo-masked-input');

    //Date
    $demoMaskedInput.find('.date').inputmask('dd/mm/yyyy', { placeholder: '__/__/____' });

    //Time
    $demoMaskedInput.find('.time12').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });
    $demoMaskedInput.find('.time24').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time24', hourFormat: '24' });

    //Date Time
    $demoMaskedInput.find('.datetime').inputmask('d/m/y h:s', { placeholder: '__/__/____ __:__', alias: "datetime", hourFormat: '24' });

    //Mobile Phone Number
    $demoMaskedInput.find('.mobile-phone-number').inputmask('+99 (999) 999-99-99', { placeholder: '+__ (___) ___-__-__' });
    //Phone Number
    $demoMaskedInput.find('.phone-number').inputmask('+99 (999) 999-99-99', { placeholder: '+__ (___) ___-__-__' });

    //Dollar Money
    $demoMaskedInput.find('.money-dollar').inputmask('99,99 $', { placeholder: '__,__ $' });
    //Euro Money
    $demoMaskedInput.find('.money-euro').inputmask('99,99 €', { placeholder: '__,__ €' });

    //IP Address
    $demoMaskedInput.find('.ip').inputmask('999.999.999.999', { placeholder: '___.___.___.___' });

    //Credit Card
    $demoMaskedInput.find('.credit-card').inputmask('9999 9999 9999 9999', { placeholder: '____ ____ ____ ____' });

    //Email
    $demoMaskedInput.find('.email').inputmask({ alias: "email" });

    //Serial Key
    $demoMaskedInput.find('.key').inputmask('****-****-****-****', { placeholder: '____-____-____-____' });
    //===========================================================================================================================================

    //Multi-select
    $('#optgroup').multiSelect({ selectableOptgroup: true });

    //noUISlider
    var sliderBasic = document.getElementById('nouislider_basic_example');
    noUiSlider.create(sliderBasic, {
        start: [30],
        connect: 'lower',
        step: 1,
        range: {
            'min': [0],
            'max': [100]
        }
    });
    getNoUISliderValue(sliderBasic, true);

    //Range Example
    var rangeSlider = document.getElementById('nouislider_range_example');
    noUiSlider.create(rangeSlider, {
        start: [32500, 62500],
        connect: true,
        range: {
            'min': 25000,
            'max': 100000
        }
    });
    getNoUISliderValue(rangeSlider, false);
});

//Get noUISlider Value and write on
function getNoUISliderValue(slider, percentage) {
    slider.noUiSlider.on('update', function () {
        var val = slider.noUiSlider.get();
        if (percentage) {
            val = parseInt(val);
            val += '%';
        }
        $(slider).parent().find('span.js-nouislider-value').text(val);
    });
}
$(function () {
    //Textare auto growth
    autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        clearButton: true,
        weekStart: 1
    });

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });

    $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    });
});
$(function () {
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;

    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '../../plugins/tinymce';
});
$(function () {
    $('#form_validation').validate({
        rules: {
            'checkbox': {
                required: true
            },
            'gender': {
                required: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    //Advanced Form Validation
    $('#form_advanced_validation').validate({
        rules: {
            'date': {
                customdate: true
            },
            'creditcard': {
                creditcard: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    //Custom Validations ===============================================================================
    //Date
    $.validator.addMethod('customdate', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d?-\d\d$/);
    },
        'Please enter a date in the format YYYY-MM-DD.'
    );

    //Credit card
    $.validator.addMethod('creditcard', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d\d\d?-\d\d\d\d?-\d\d\d\d$/);
    },
        'Please enter a credit card in the format XXXX-XXXX-XXXX-XXXX.'
    );
    //==================================================================================================
});
$(function () {
    //Horizontal form basic
    $('#wizard_horizontal').steps({
        headerTag: 'h2',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        onInit: function (event, currentIndex) {
            setButtonWavesEffect(event);
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
        }
    });

    //Vertical form basic
    $('#wizard_vertical').steps({
        headerTag: 'h2',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        stepsOrientation: 'vertical',
        onInit: function (event, currentIndex) {
            setButtonWavesEffect(event);
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
        }
    });

    //Advanced form with validation
    var form = $('#wizard_with_validation').show();
    form.steps({
        headerTag: 'h3',
        bodyTag: 'fieldset',
        transitionEffect: 'slideLeft',
        onInit: function (event, currentIndex) {
            $.AdminBSB.input.activate();

            //Set tab width
            var $tab = $(event.currentTarget).find('ul[role="tablist"] li');
            var tabCount = $tab.length;
            $tab.css('width', (100 / tabCount) + '%');

            //set button waves effect
            setButtonWavesEffect(event);
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex > newIndex) { return true; }

            if (currentIndex < newIndex) {
                form.find('.body:eq(' + newIndex + ') label.error').remove();
                form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
            }

            form.validate().settings.ignore = ':disabled,:hidden';
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ':disabled';
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            swal("Good job!", "Submitted!", "success");
        }
    });

    form.validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        rules: {
            'confirm': {
                equalTo: '#password'
            }
        }
    });
});

function setButtonWavesEffect(event) {
    $(event.currentTarget).find('[role="menu"] li a').removeClass('waves-effect');
    $(event.currentTarget).find('[role="menu"] li:not(.disabled) a').addClass('waves-effect');
}
$(function () {
    //Basic Map
    var basicMap = new GMaps({
        el: '#gmap_basic_example',
        lat: -12.043333,
        lng: -77.028333
    });

    //Markers
    var markers = new GMaps({
        div: '#gmap_markers',
        lat: -12.043333,
        lng: -77.028333
    });
    markers.addMarker({
        lat: -12.043333,
        lng: -77.03,
        title: 'Lima',
        details: {
            database_id: 42,
            author: 'HPNeo'
        },
        click: function (e) {
            if (console.log)
                console.log(e);
            alert('You clicked in this marker');
        }
    });
    markers.addMarker({
        lat: -12.042,
        lng: -77.028333,
        title: 'Marker with InfoWindow',
        infoWindow: {
            content: '<p>HTML Content</p>'
        }
    });

    //Static maps
    var staticMap = GMaps.staticMapURL({
        size: [$('#gmap_static_map').width(), 400],
        lat: -12.043333,
        lng: -77.028333
    });

    $('<img/>').attr('src', staticMap).appendTo('#gmap_static_map');

    //Static maps with markers
    var staticMapWithMarkers = GMaps.staticMapURL({
        size: [$('#gmap_static_map_with_markers').width(), 400],
        lat: -12.043333,
        lng: -77.028333,
        markers: [
            { lat: -12.043333, lng: -77.028333 },
            {
                lat: -12.045333, lng: -77.034,
                size: 'small'
            },
            {
                lat: -12.045633, lng: -77.022,
                color: 'blue'
            }
        ]
    });

    $('<img/>').attr('src', staticMapWithMarkers).appendTo('#gmap_static_map_with_markers');

    //Static maps with polyline
    var path = [
        [-12.040397656836609, -77.03373871559225],
        [-12.040248585302038, -77.03993927003302],
        [-12.050047116528843, -77.02448169303511],
        [-12.044804866577001, -77.02154422636042],
        [-12.040397656836609, -77.03373871559225],
    ];

    var staticMapPolyline = GMaps.staticMapURL({
        size: [$('#gmap_static_map_polyline').width(), 400],
        lat: -12.043333,
        lng: -77.028333,

        polyline: {
            path: path,
            strokeColor: '#131540',
            strokeOpacity: 0.6,
            strokeWeight: 6
            // fillColor: '#ffaf2ecc'
        }
    });

    $('<img/>').attr('src', staticMapPolyline).appendTo('#gmap_static_map_polyline');

    //Panorama
    var panorama = GMaps.createPanorama({
        el: '#gmap_panorama',
        lat: 42.3455,
        lng: -71.0983
    });
});
$(function () {
    $('#world-map-markers').vectorMap({
        map: 'world_mill_en',
        normalizeFunction: 'polynomial',
        hoverOpacity: 0.7,
        hoverColor: false,
        backgroundColor: 'transparent',
        regionStyle: {
            initial: {
                fill: 'rgba(210, 214, 222, 1)',
                "fill-opacity": 1,
                stroke: 'none',
                "stroke-width": 0,
                "stroke-opacity": 1
            },
            hover: {
                "fill-opacity": 0.7,
                cursor: 'pointer'
            },
            selected: {
                fill: 'yellow'
            },
            selectedHover: {}
        },
        markerStyle: {
            initial: {
                fill: '#009688',
                stroke: '#000'
            }
        },
        markers: [
            { latLng: [41.90, 12.45], name: 'Vatican City' },
            { latLng: [43.73, 7.41], name: 'Monaco' },
            { latLng: [-0.52, 166.93], name: 'Nauru' },
            { latLng: [-8.51, 179.21], name: 'Tuvalu' },
            { latLng: [43.93, 12.46], name: 'San Marino' },
            { latLng: [47.14, 9.52], name: 'Liechtenstein' },
            { latLng: [7.11, 171.06], name: 'Marshall Islands' },
            { latLng: [17.3, -62.73], name: 'Saint Kitts and Nevis' },
            { latLng: [3.2, 73.22], name: 'Maldives' },
            { latLng: [35.88, 14.5], name: 'Malta' },
            { latLng: [12.05, -61.75], name: 'Grenada' },
            { latLng: [13.16, -61.23], name: 'Saint Vincent and the Grenadines' },
            { latLng: [13.16, -59.55], name: 'Barbados' },
            { latLng: [17.11, -61.85], name: 'Antigua and Barbuda' },
            { latLng: [-4.61, 55.45], name: 'Seychelles' },
            { latLng: [7.35, 134.46], name: 'Palau' },
            { latLng: [42.5, 1.51], name: 'Andorra' }
        ]
    });
});
$(function () {
    $('#aniimated-thumbnials').lightGallery({
        thumbnail: true,
        selector: 'a'
    });
});
$(function () {
    $('#mainTable').editableTableWidget();
});
$(function () {
    // $('.js-basic-example').DataTable();

    //Exportable table
    // $('.js-exportable').DataTable({
    //     dom: 'Bfrtip',
    //     buttons: [
    //         'copy', 'csv', 'excel', 'pdf', 'print'
    //     ]
    // });
});
$(function () {
    $('.js-animations').bind('change', function () {
        var animation = $(this).val();
        $('.js-animating-object').animateCss(animation);
    });
});

//Copied from https://github.com/daneden/animate.css
$.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
});
$(function () {
    $('.js-sweetalert button').on('click', function () {
        var type = $(this).data('type');
        if (type === 'basic') {
            showBasicMessage();
        }
        else if (type === 'with-title') {
            showWithTitleMessage();
        }
        else if (type === 'success') {
            showSuccessMessage();
        }
        else if (type === 'confirm') {
            showConfirmMessage();
        }
        else if (type === 'cancel') {
            showCancelMessage();
        }
        else if (type === 'with-custom-icon') {
            showWithCustomIconMessage();
        }
        else if (type === 'html-message') {
            showHtmlMessage();
        }
        else if (type === 'autoclose-timer') {
            showAutoCloseTimerMessage();
        }
        else if (type === 'prompt') {
            showPromptMessage();
        }
        else if (type === 'ajax-loader') {
            showAjaxLoaderMessage();
        }
    });
});

//These codes takes from http://t4t5.github.io/sweetalert/
function showBasicMessage() {
    swal("Here's a message!");
}

function showWithTitleMessage() {
    swal("Here's a message!", "It's pretty, isn't it?");
}

function showSuccessMessage() {
    swal("Good job!", "You clicked the button!", "success");
}

function showConfirmMessage() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        swal("Deleted!", "Your imaginary file has been deleted.", "success");
    });
}

function showCancelMessage() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}

function showWithCustomIconMessage() {
    swal({
        title: "Sweet!",
        text: "Here's a custom image.",
        imageUrl: "../../images/thumbs-up.png"
    });
}

function showHtmlMessage() {
    swal({
        title: "HTML <small>Title</small>!",
        text: "A custom <span style=\"color: #CC0000\">html<span> message.",
        html: true
    });
}

function showAutoCloseTimerMessage() {
    swal({
        title: "Auto close alert!",
        text: "I will close in 2 seconds.",
        timer: 2000,
        showConfirmButton: false
    });
}

function showPromptMessage() {
    swal({
        title: "An input!",
        text: "Write something interesting:",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Write something"
    }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
            swal.showInputError("You need to write something!"); return false
        }
        swal("Nice!", "You wrote: " + inputValue, "success");
    });
}

function showAjaxLoaderMessage() {
    swal({
        title: "Ajax request example",
        text: "Submit to run ajax request",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        setTimeout(function () {
            swal("Ajax request finished!");
        }, 2000);
    });
}
$(function () {
    $('.js-modal-buttons .btn').on('click', function () {
        var color = $(this).data('color');
        $('#mdModal .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
        $('#mdModal').modal('show');
    });
});
$(function () {
    $('.jsdemo-notification-button button').on('click', function () {
        var placementFrom = $(this).data('placement-from');
        var placementAlign = $(this).data('placement-align');
        var animateEnter = $(this).data('animate-enter');
        var animateExit = $(this).data('animate-exit');
        var colorName = $(this).data('color-name');

        showNotification(colorName, null, placementFrom, placementAlign, animateEnter, animateExit);
    });
});

function showNotification(colorName, text, placementFrom, placementAlign, animateEnter, animateExit) {
    if (colorName === null || colorName === '') { colorName = 'bg-black'; }
    if (text === null || text === '') { text = 'Turning standard Bootstrap alerts'; }
    if (animateEnter === null || animateEnter === '') { animateEnter = 'animated fadeInDown'; }
    if (animateExit === null || animateExit === '') { animateExit = 'animated fadeOutUp'; }
    var allowDismiss = true;

    $.notify({
        message: text
    },
        {
            type: colorName,
            allow_dismiss: allowDismiss,
            newest_on_top: true,
            timer: 1000,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            animate: {
                enter: animateEnter,
                exit: animateExit
            },
            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
}
$(function () {
    //Taken from http://ionden.com/a/plugins/ion.rangeSlider/demo.html

    $("#range_01").ionRangeSlider();

    $("#range_02").ionRangeSlider({
        min: 100,
        max: 1000,
        from: 550
    });

    $("#range_03").ionRangeSlider({
        type: "double",
        grid: true,
        min: 0,
        max: 1000,
        from: 200,
        to: 800,
        prefix: "$"
    });

    $("#range_04").ionRangeSlider({
        type: "double",
        grid: true,
        min: -1000,
        max: 1000,
        from: -500,
        to: 500
    });

    $("#range_05").ionRangeSlider({
        type: "double",
        grid: true,
        min: -1000,
        max: 1000,
        from: -500,
        to: 500,
        step: 250
    });


    $("#range_06").ionRangeSlider({
        type: "double",
        grid: true,
        min: -12.8,
        max: 12.8,
        from: -3.2,
        to: 3.2,
        step: 0.1
    });

    $("#range_07").ionRangeSlider({
        type: "double",
        grid: true,
        from: 1,
        to: 5,
        values: [0, 10, 100, 1000, 10000, 100000, 1000000]
    });


    $("#range_08").ionRangeSlider({
        grid: true,
        from: 5,
        values: [
            "zero", "one",
            "two", "three",
            "four", "five",
            "six", "seven",
            "eight", "nine",
            "ten"
        ]
    });

    $("#range_09").ionRangeSlider({
        grid: true,
        from: 3,
        values: [
            "January", "February", "March",
            "April", "May", "June",
            "July", "August", "September",
            "October", "November", "December"
        ]
    });

    $("#range_10").ionRangeSlider({
        grid: true,
        min: 1000,
        max: 1000000,
        from: 100000,
        step: 1000,
        prettify_enabled: false
    });
});
$(function () {
    $('.dd').nestable();

    $('.dd').on('change', function () {
        var $this = $(this);
        var serializedData = window.JSON.stringify($($this).nestable('serialize'));

        $this.parents('div.body').find('textarea').val(serializedData);
    });
});
$(function () {
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    //Popover
    $('[data-toggle="popover"]').popover();
})
$(function () {
    initCounters();
    initCharts();
});

//Widgets count plugin
function initCounters() {
    $('.count-to').countTo();
}

//Charts
function initCharts() {
    //Chart Bar
    $('.chart.chart-bar').sparkline(undefined, {
        type: 'bar',
        barColor: '#fff',
        negBarColor: '#fff',
        barWidth: '4px',
        height: '34px'
    });

    //Chart Pie
    $('.chart.chart-pie').sparkline(undefined, {
        type: 'pie',
        height: '50px',
        sliceColors: ['rgba(255,255,255,0.70)', 'rgba(255,255,255,0.85)', 'rgba(255,255,255,0.95)', 'rgba(255,255,255,1)']
    });

    //Chart Line
    $('.chart.chart-line').sparkline(undefined, {
        type: 'line',
        width: '60px',
        height: '45px',
        lineColor: '#fff',
        lineWidth: 1.3,
        fillColor: 'rgba(0,0,0,0)',
        spotColor: 'rgba(255,255,255,0.40)',
        maxSpotColor: 'rgba(255,255,255,0.40)',
        minSpotColor: 'rgba(255,255,255,0.40)',
        spotRadius: 3,
        highlightSpotColor: '#fff'
    });
}
$(function () {
    initCounters();
    initCharts();
});

//Widgets count plugin
function initCounters() {
    $('.count-to').countTo();
}

//Charts
function initCharts() {
    //Chart Bar
    $('.chart.chart-bar').sparkline(undefined, {
        type: 'bar',
        barColor: '#fff',
        negBarColor: '#fff',
        barWidth: '4px',
        height: '34px'
    });

    //Chart Pie
    $('.chart.chart-pie').sparkline(undefined, {
        type: 'pie',
        height: '50px',
        sliceColors: ['rgba(255,255,255,0.70)', 'rgba(255,255,255,0.85)', 'rgba(255,255,255,0.95)', 'rgba(255,255,255,1)']
    });

    //Chart Line
    $('.chart.chart-line').sparkline(undefined, {
        type: 'line',
        width: '60px',
        height: '45px',
        lineColor: '#fff',
        lineWidth: 1.3,
        fillColor: 'rgba(0,0,0,0)',
        spotColor: 'rgba(255,255,255,0.40)',
        maxSpotColor: 'rgba(255,255,255,0.40)',
        minSpotColor: 'rgba(255,255,255,0.40)',
        spotRadius: 3,
        highlightSpotColor: '#fff'
    });
}
$(function () {
    initCounters();
    initCharts();
});

//Widgets count plugin
function initCounters() {
    $('.count-to').countTo();
}

//Charts
function initCharts() {
    //Chart Bar
    $('.chart.chart-bar').sparkline(undefined, {
        type: 'bar',
        barColor: '#fff',
        negBarColor: '#fff',
        barWidth: '4px',
        height: '34px'
    });

    //Chart Pie
    $('.chart.chart-pie').sparkline(undefined, {
        type: 'pie',
        height: '50px',
        sliceColors: ['rgba(255,255,255,0.70)', 'rgba(255,255,255,0.85)', 'rgba(255,255,255,0.95)', 'rgba(255,255,255,1)']
    });

    //Chart Line
    $('.chart.chart-line').sparkline(undefined, {
        type: 'line',
        width: '60px',
        height: '45px',
        lineColor: '#fff',
        lineWidth: 1.3,
        fillColor: 'rgba(0,0,0,0)',
        spotColor: 'rgba(255,255,255,0.40)',
        maxSpotColor: 'rgba(255,255,255,0.40)',
        minSpotColor: 'rgba(255,255,255,0.40)',
        spotRadius: 3,
        highlightSpotColor: '#fff'
    });
}
$(function () {
    initCounters();
    initCharts();
});

//Widgets count plugin
function initCounters() {
    $('.count-to').countTo();
}

//Charts
function initCharts() {
    //Chart Bar
    $('.chart.chart-bar:not(.reverse)').sparkline(undefined, {
        type: 'bar',
        barColor: 'rgba(0, 0, 0, 0.15)',
        negBarColor: 'rgba(0, 0, 0, 0.15)',
        barWidth: '8px',
        height: '34px'
    });

    //Chart Bar Reverse
    $('.chart.chart-bar.reverse').sparkline(undefined, {
        type: 'bar',
        barColor: 'rgba(255, 255, 255, 0.15)',
        negBarColor: 'rgba(255, 255, 255, 0.15)',
        barWidth: '8px',
        height: '34px'
    });

    //Chart Pie
    $('.chart.chart-pie').sparkline(undefined, {
        type: 'pie',
        height: '50px',
        sliceColors: ['rgba(0,0,0,0.10)', 'rgba(0,0,0,0.15)', 'rgba(0,0,0,0.20)', 'rgba(0,0,0,0.25)']
    });

    //Chart Line
    $('.chart.chart-line').sparkline(undefined, {
        type: 'line',
        width: '60px',
        height: '45px',
        lineColor: 'rgba(0, 0, 0, 0.15)',
        lineWidth: 2,
        fillColor: 'rgba(0,0,0,0)',
        spotColor: 'rgba(0, 0, 0, 0.15)',
        maxSpotColor: 'rgba(0, 0, 0, 0.15)',
        minSpotColor: 'rgba(0, 0, 0, 0.15)',
        spotRadius: 3,
        highlightSpotColor: 'rgba(0, 0, 0, 0.15)'
    });
}
$(function () {
    initCounters();
    initCharts();
});

//Widgets count plugin
function initCounters() {
    $('.count-to').countTo();
}

//Charts
function initCharts() {
    //Chart Bar
    $.each($('.chart.chart-bar'), function (i, key) {
        var chartColor = $.AdminBSB.options.colors[$(key).data('chartcolor')];
        $(key).sparkline(undefined, {
            type: 'bar',
            barColor: chartColor,
            negBarColor: chartColor,
            barWidth: '8px',
            height: '34px'
        });
    });

    //Chart Pie
    $.each($('.chart.chart-pie'), function (i, key) {
        var chartColor = $.AdminBSB.options.colors[$(key).data('chartcolor')];
        $(key).sparkline(undefined, {
            type: 'pie',
            height: '50px',
            sliceColors: [hexToRgba(chartColor, '0.55'), hexToRgba(chartColor, '0.70'), hexToRgba(chartColor, '0.85'), hexToRgba(chartColor, '1')]
        });
    });

    //Chart Line
    $.each($('.chart.chart-line'), function (i, key) {
        var chartColor = $.AdminBSB.options.colors[$(key).data('chartcolor')];
        $(key).sparkline(undefined, {
            type: 'line',
            width: '60px',
            height: '45px',
            lineColor: chartColor,
            lineWidth: 1.3,
            fillColor: 'rgba(0,0,0,0)',
            spotColor: chartColor,
            maxSpotColor: chartColor,
            minSpotColor: chartColor,
            spotRadius: 3,
            highlightSpotColor: chartColor
        });
    });
}
//# sourceMappingURL=all.js.map
