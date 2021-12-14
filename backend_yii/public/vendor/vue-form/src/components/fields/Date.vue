<template>
    <b-form-input :value="value" @input="updateValue" v-bind="$attrs"></b-form-input>
</template>

<script>
    import 'bootstrap-datepicker'
    import 'bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css'
    import 'bootstrap-datepicker/dist/locales/bootstrap-datepicker.vi.min.js'

    export default {
        name: 'v-input-date',
        props: {
            value: [String, Number]
        },
        mounted(){
            if (this.dp) return;
            this.dp = $(this.$el).datepicker({
                format: "dd/mm/yyyy",
                todayBtn: 'linked',
                clearBtn: true,
                language: "vi",
                autoclose: true,
                todayHighlight: true
            }).on('changeDate', (e) => {
                this.updateValue(e.target.value)
            });
        },
        methods:{
            updateValue(value){
                this.$emit('input', value)
            }
        },
        beforeDestroy() {
            if (this.dp) {
                this.dp.datepicker('destroy');
                this.dp = null;
            }
        },

    }
</script>