<template>
    <div :class="`formulate-input-element formulate-input-element--${context.type} inline`"
         :data-type="context.type"
    >
        <b-form-radio-group
                v-if="type === 'b-radio'"
                v-model="context.model"
                type="radio"
                :value="context.value"
                v-bind="attributes"
                @blur="context.blurHandler"
                :options="options"
        ></b-form-radio-group>

        <b-form-checkbox-group
                v-else
                v-model="context.model"
                type="radio"
                :value="context.value"
                v-bind="attributes"
                @blur="context.blurHandler"
                :options="options"
        ></b-form-checkbox-group>
    </div>

</template>

<script>
    import FormulateInputMixin from '@braid/vue-formulate/src/FormulateInputMixin'

    export default {
        name: 'FormulateBInputBox',
        mixins: [FormulateInputMixin],
        computed: {
            options () {
                return this.context.options.map((v, k) => ({text: v.label, value: v.value}))
            },
        },
        mounted(){
        }

    }
</script>

<style>
    .custom-control{
        padding-left: 7px!important;
    }
</style>