<template>
    <ValidationProvider :vid="vid" :name="$attrs.label" :rules="rules" v-slot="v">
        <b-form-group
            :label-class="v.invalid && v.touched? 'font-weight-semibold text-danger' : ''"
            :label-for="$attrs.id"
            :label="$attrs.label"
        >
            <b-form-input
                v-model="innerValue"
                v-bind="$attrs"
                :id="$attrs.id"
                :state="v.errors[0] ? false : ((v.valid && v.touched) ? true : null)"
                ref="input"
            ></b-form-input>

            <b-form-invalid-feedback class="form-text">{{ v.errors[0] }}</b-form-invalid-feedback>
        </b-form-group>
    </ValidationProvider>
</template>
<script>
    import { isUndefined } from 'lodash-es'
    import $ from 'jquery'
    import 'bootstrap-datepicker'
    import 'bootstrap-datepicker/dist/locales/bootstrap-datepicker.vi.min'
    import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.css'

    const datepickerOpts = {
        format: 'dd/mm/yyyy',
        todayBtn: "linked",
        language: "vi",
        clearBtn: true,
        autoclose: true,
        todayHighlight: true
    }

    export default {
        name: 'field-input',
        inheritAttrs: false,
        props: {
            rules: {
                type: [Object, String],
                default: ""
            },
            // must be included in props
            value: {
                type: null
            },
            widget: String
        },
        data: () => ({
            innerValue: ""
        }),
        computed: {
            vid() {
                if (this.$attrs.vid) return this.$attrs.vid

                return this.strArr2Dot(`${this.$attrs.name}`)
            },
        },
        watch: {
            // Handles internal model changes.
            innerValue(newVal) {
                this.$emit("input", newVal);
            },
            // Handles external model changes.
            value(newVal) {
                this.innerValue = newVal;
            }
        },
        mounted() {
            if (this.widget === 'datepicker') {
                $(this.$refs.input.$el).datepicker(datepickerOpts).on('changeDate', (e) => {
                    this.innerValue = e.target.value
                })

                if (!this.$attrs.placeholder) {
                    this.$attrs.placeholder = 'DD/MM/YYYY'
                }

            }
        },
        created() {
            if (!isUndefined(this.value)) {
                this.innerValue = this.value;
            }
        },
        methods: {
            strArr2Dot(str){
                return str.replace('][', '.').replace('[', '.').replace(']', '')
            }
        }
    };
</script>

<style>

</style>

