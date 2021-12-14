<template>
    <div
            :class="context.classes.element"
            :data-type="context.type"
    >
        <FormulateSlot
                name="prefix"
                :context="context"
        >
            <component
                    :is="context.slotComponents.prefix"
                    v-if="context.slotComponents.prefix"
                    :context="context"
            />
        </FormulateSlot>
        <input
                v-model="context.model"
                type="text"
                v-bind="attributes"
                @blur="context.blurHandler"
                v-on="$listeners"
                ref="datePicker"
        >
        <FormulateSlot
                name="suffix"
                :context="context"
        >
            <component
                    :is="context.slotComponents.suffix"
                    v-if="context.slotComponents.suffix"
                    :context="context"
            />
        </FormulateSlot>
    </div>
</template>

<script>
    import flatpickr from 'flatpickr'
    import monthSelectPlugin from 'flatpickr/dist/plugins/monthSelect'
    import 'flatpickr/dist/plugins/monthSelect/style.css'
    import {omit, pick, defaults} from 'lodash'
    import 'flatpickr/dist/themes/airbnb.css'
    import 'flatpickr/dist/l10n/vn.js'

    import FormulateInputMixin from '@braid/vue-formulate/src/FormulateInputMixin'

    const props = ['dateFormat', 'allowInput', 'locale', 'showMonths', 'minDate', 'maxDate', 'disable']

    export default {
        name: 'FormulateInputText',
        mixins: [FormulateInputMixin],
        data: () => ({flatpickr: null}),
        watch: {
            value: function (newValue, oldValue) {
                if (this.flatpickr) {
                    this.flatpickr.setDate(newValue)
                }
            },
        },
        computed: {
            attributes() {
                return omit(this.context.attributes, props) || {}
            },
        },
        mounted() {
            this.$nextTick(() => this.createFlatpickr())
        },
        methods: {
            createFlatpickr() {
                this.flatpickr = flatpickr(this.$refs.datePicker, this.getConfig())
            },
            getConfig(){
                let config = defaults(
                    pick(this.context.attributes, props),
                    {
                        onClose: this.onChange,
                        onChange: this.onChange,
                        dateFormat: this.type === 'month' ? 'Y-m' : 'Y-m-d',
                        allowInput: true,
                    }
                )

                if(this.type === 'month') config.plugins = (config.plugins || []).concat(new monthSelectPlugin({
                    shorthand: true,
                    dateFormat: config.dateFormat,
                }))

                return config
            },
            onChange(event) {
                this.$emit('change', this.$refs.datePicker.value)
            },

            clear() {
                this.flatpickr.clear()
            },
        },
        beforeDestroy() {
            this.flatpickr.destroy()
        },
    }
</script>