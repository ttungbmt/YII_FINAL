var App = function(){

    var handleParsleyjs = function(){
        if(!jQuery().datepicker)
            return console.warn('Thư viện Parsleyjs chưa được load')

        //window.Parsley.setLocale('vi');
    }


    var handleDatepicker = function(){

        if(!jQuery().datepicker)
            return console.warn('Thư viện Datepicker chưa được load')

        $('.i-datepicker').datepicker({
            format: "dd/mm/yyyy",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            language: "vi",
        });

        $('.i-datepicker-year').datepicker({
            format: "yyyy",
            startView: 1,
            minViewMode: 2,
            todayBtn: true,
            //multidate: true,
            todayHighlight: true,
            language: "vi",
            autoclose: true,
            clearBtn: true,
        });

        $('.i-datepicker-month').datepicker({
            format: "mm",
            minViewMode: 1,
            maxViewMode: 1,
            todayBtn: "linked",
            clearBtn: true,
            language: "vi",
            autoclose: true,
            todayHighlight: true
        });



    }

    var handleSelect2 = function(){
        if(!jQuery().select2)
            return console.warn('Thư viện select2 chưa được load');

        $('.i-select2-basic').select2({
            minimumResultsForSearch: Infinity
        });

        $(".i-select2-search").select2({
            language: 'vi'
        });

        $('.i-select2-tag-init').select2();
        $('.i-select-short-init').select2();
    }


    var handleCheckbox = function(){
        if(!jQuery().uniform) console.warn('Thư viện uniform chưa được load');

        $(".styled, .multiselect-container input").uniform({
            radioClass: 'choice'
        });

        // Primary
        $(".control-primary").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-primary-600 text-primary-800'
        });

        // Danger
        $(".control-danger").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-danger-600 text-danger-800'
        });

        // Success
        $(".control-success").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-success-600 text-success-800'
        });

        // Warning
        $(".control-warning").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-warning-600 text-warning-800'
        });

        // Info
        $(".control-info").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-info-600 text-info-800'
        });

        // Custom color
        $(".control-custom").uniform({
            radioClass: 'choice',
            wrapperClass: 'border-indigo-600 text-indigo-800'
        });
    }

    var handleNiceScroll = function(){
        if(!jQuery().niceScroll) console.warn('Thư viện niceScroll chưa được load');

        $(".i-nicescroll").niceScroll({
            cursorcolor: "#c4c4c4"
        });
    }

    var handleUniform = function(){
        if(!jQuery().uniform) console.warn('Thư viện uniform chưa được load');

        // Primary file input
        $(".file-styled-primary").uniform({
            wrapperClass: 'bg-primary',
            fileButtonHtml: '<i class="icon-plus2"></i>'
        });
    }

    return {
        init: function(){
            handleParsleyjs();
            handleSelect2();
            handleDatepicker();
            handleCheckbox();
            handleNiceScroll();
            handleUniform();
        }
    }
}();