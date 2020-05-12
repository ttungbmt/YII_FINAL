<template>
    <ValidationProvider :name="$attrs.name" :rules="rules" v-slot="{ invalid, valid, touched, errors }">
        <b-form-group
            :label-for="vid"
            v-bind="$attrs"
        >
            <b-form-checkbox-group
                :state="errors[0] ? false : ((valid && touched) ? true : null)"
                v-model="innerValue"
                :options="items"
            >
            </b-form-checkbox-group>
            <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
        </b-form-group>
    </ValidationProvider>
</template>


<script>
    import { isUndefined } from 'lodash-es'
    import fieldMixin from './fieldMixin'

    export default {
        name: 'field-checkbox',
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
            }
        },
        data: () => ({
            innerValue: ""
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
