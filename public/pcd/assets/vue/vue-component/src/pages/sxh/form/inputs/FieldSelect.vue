<template>
    <ValidationProvider
        ref="validator"
        :name="$attrs.label"
        :rules="rules"
        v-slot="{ invalid, valid, touched, errors }"
        :vid="vid"
    >
        <b-form-group
            :label-class="(invalid && touched) ? 'font-weight-semibold text-danger' : ''"
            :label-for="$attrs.id"
            :label="$attrs.label"
        >
            <b-form-select
                ref="select"
                v-bind="$attrs"
                :id="$attrs.id"
                :state="errors[0] ? false : ((valid && touched) ? true : null)"
                v-model="innerValue"
                :options="items"
            >
            </b-form-select>
            <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
        </b-form-group>
    </ValidationProvider>
</template>

<script>
    import $ from 'jquery'
    import { isUndefined } from 'lodash-es'
    import fieldMixin from './fieldMixin'

    if($.fn.depdropLocales){
        $.fn.depdropLocales['vi'] = {
            loadingText: 'Đang tải ...',
            placeholder: 'Chọn ...',
            emptyMsg: 'Không có dữ liệu'
        };
    }

    export default {
        name: 'field-select',
        inheritAttrs: false,
        mixins: [fieldMixin],
        props: {
            rules: {
                type: [Object, String],
                default: ""
            },
            // must be included in props
            value: {
                type: null
            },
            options: [Array, Object],
            prompt: [Boolean, String],
            depends: Array,
            params: Array,
            url: String
        },
        data: () => ({
            innerValue: "",
            // innerOptions: []
        }),
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
        created() {
            if (!isUndefined(this.value)) {
                this.innerValue = this.value;
            }

            if (this.url) {
                // this.innerOptions = [{value: '', text: 'Đang tải...'}]
                // this.innerValue = ''
            }
        },
        mounted() {
            if (this.url && this.depends) {
                let depdropOptions = {
                    depends: this.depends,
                    url: this.url,
                    language: 'vi',
                    ajaxSettings: {
                        data: {value: this.innerValue}
                    },
                    params: this.params
                }

                if(this.parentsHasValue()){
                    depdropOptions = {
                        ...depdropOptions,
                        initialize: true,
                    }
                }

                $(this.$refs.select.$el).depdrop(depdropOptions);
            }
        },
        methods: {
            parentsHasValue(){
                for (let k in this.depends) {
                    let val = $(`#${this.depends[k]}`).val()
                    if(val) return true
                }

                return false
            }
        }
    };
</script>
