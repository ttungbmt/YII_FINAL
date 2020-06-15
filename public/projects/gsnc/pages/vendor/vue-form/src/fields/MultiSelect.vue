<template>
    <div
            :class="`formulate-input-element formulate-input-element--${context.type}`"
            :data-type="context.type"
    >
        <select
                ref="input"
                class="form-control"
                v-model="context.model"
                v-bind="attributes"
                :data-placeholder-selected="placeholderSelected"
                @blur="context.blurHandler"
                multiple="multiple"
        >
            <option
                    v-if="attributes.placeholder"
                    value=""
                    :selected="!hasValue"
            >
                {{ attributes.placeholder }}
            </option>
            <template
                    v-if="!optionGroups"
            >
                <option
                        v-for="option in options"
                        :key="option.id"
                        :value="option.value"
                        v-bind="option.attributes || {}"
                        v-text="option.label"
                />
            </template>
            <template
                    v-else
            >
                <optgroup
                        v-for="(subOptions, label) in optionGroups"
                        :key="label"
                        :label="label"
                >
                    <option
                            v-for="option in subOptions"
                            :key="option.id"
                            :value="option.value"
                            v-bind="option.attributes || {}"
                            v-text="option.label"
                    />
                </optgroup>
            </template>
        </select>
    </div>
</template>

<script>
    import FormulateInputMixin from '@braid/vue-formulate/src/FormulateInputMixin'

    export default {
        name: 'FormulateInputMultiSelect',
        mixins: [FormulateInputMixin],
        mounted(){
            $(this.$refs.input).multiselect({
                includeSelectAllOption: true,
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                onChange: function(option, checked) {
                    console.log(option, checked)

                    if (checked === false) {
                        // $preventDeselectElement.multiselect('select', option.val());
                    }
                }
            });
        },
        computed: {
            options () {
                return this.context.options || {}
            },
            optionGroups () {
                return this.context.optionGroups || false
            },
            placeholderSelected () {
                return !!(!this.hasValue && this.context.attributes && this.context.attributes.placeholder)
            }
        }
    }
</script>