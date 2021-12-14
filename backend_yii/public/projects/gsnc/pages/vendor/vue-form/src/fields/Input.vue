<template>
    <div :class="`formulate-input-element formulate-input-element--${context.type}`"
         :data-type="context.type"
    >
        <b-form-input v-model="context.model"
                      v-bind="attributes"
                      @blur="context.blurHandler"
        ></b-form-input>
    </div>

</template>

<script>
    import FormulateInputMixin from '@braid/vue-formulate/src/FormulateInputMixin'

    export default {
        mixins: [FormulateInputMixin],
    }
</script>