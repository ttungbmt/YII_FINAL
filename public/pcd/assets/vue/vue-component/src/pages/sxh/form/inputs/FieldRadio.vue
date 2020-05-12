<template>
    <ValidationProvider :name="$attrs.name" :vid="vid" :rules="rules" v-slot="{ invalid, valid, touched, errors }">
        <b-form-group
            :label-for="$attrs.id"
            :label="$attrs.label"
        >
            <b-form-radio-group
                :state="errors[0] ? false : ((valid && touched) ? true : null)"
                v-bind="$attrs"
                v-model="innerValue"
                :options="items"
                :disabled="$attrs.disabled"
            >
            </b-form-radio-group>
            <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
        </b-form-group>
    </ValidationProvider>
</template>


<script>
    import fieldMixin from './fieldMixin'
    import { isUndefined } from 'lodash-es'

    export default {
        name: 'field-radio',
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
            options: [Array, Object]
        },
        data: () => ({
            innerValue: null
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
        }
    };
</script>
