<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/locales/bootstrap-datepicker.vi.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>

<!--<div x-data="datepicker()">
    <div x-text="pluginOptions.autoclose"></div>
    <button x-on:click="init" >123</button>
</div>-->

<input type="text" class="form-control" x-data="widget().datepicker()" x-init="init()">


<script>
    function widget() {
        return {
            datepicker(options = {}) {
                return {
                    pluginOptions: Object.assign({
                        format: "dd/mm/yyyy",
                        clearBtn: true,
                        language: "vi",
                        autoclose: true,
                        todayHighlight: true
                    }, options),
                    init(){
                        $(this.$el).datepicker(this.pluginOptions)
                    }
                }
            }
        }
    }


</script>