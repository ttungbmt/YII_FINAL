<template>
    <div
            :class="context.classes.element"
            :data-type="context.type"
            :data-multiple="attributes && attributes.multiple !== undefined"
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
        <v-select
                v-model="context.model"
                :options="options"
                v-bind="attributes"
                v-on="$listeners"
                :reduce="reduce"
                :getOptionKey="option => option.value"
                @blur="context.blurHandler"
        ></v-select>

        <!--<select
                v-model="context.model"
                v-bind="attributes"
                :data-placeholder-selected="placeholderSelected"
                v-on="$listeners"
                @blur="context.blurHandler"
        >
            <option
                    v-if="context.placeholder"
                    value
                    hidden="hidden"
                    disabled
                    :selected="!hasValue"
            >
                {{ context.placeholder }}
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
        </select>-->
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
    import {get} from 'lodash'
    import FormulateInputMixin from '@braid/vue-formulate/src/FormulateInputMixin'
    import vSelect from "vue-select"
    // import 'vue-select/dist/vue-select.css'

    export default {
        name: 'FormulateInputSelect',
        mixins: [FormulateInputMixin],
        components: {
            'v-select': vSelect
        },
        data(){
            return {
                dependValue: this.getDependValue()
            }
        },
        inject: {
            formulateSetter: { default: undefined },
            getFormValues: {default: () => () => ({})},
        },
        computed: {
            options () {
                let options = this.context.options || {},
                    dependsOn = this.attributes.dependsOn,
                    dependKey = this.attributes.dependKey

                if(dependsOn) {
                    let value = this.getDependValue()
                    this.dependValue = value

                    if(value) return options.filter(i => get(i, dependKey) === value)
                    else return [];
                }

                return options
            },
            attributes(){
                return this.context.attributes || {}
            },
            name(){
                return this.attributes.name
            },
            reduce(){
                return this.attributes.reduce || (option => option.value)
            }
        },
        watch: {
            dependValue(newVal, oldVal){
                this.formulateSetter(this.attributes.name, null)
            }
        },
        mounted() {

        },
        methods: {
            getDependValue(){
                return get(this.getFormValues(this), get(this.context, 'attributes.dependsOn'))
            },
        }
    }
</script>

<style lang="scss">
    $vs-component-line-height: 1.2em;
    @import "vue-select/src/scss/vue-select.scss";

    .vs__dropdown-toggle {
        padding-top: 0.75em;
        padding-bottom: 0.75em;
    }

    .vs__selected {
        margin-top: 0;
        border: none;
        padding-left: 0;

        background: #41b883;
        /*color: white;*/
        /*padding: 4px 6px 4px 10px;*/
    }

    .vs__selected-options {
        padding-left: 0.75em;
    }

    .vs__actions {
        padding-top: 0;
        padding-right: 0.75em;
    }

    .vs__search, .vs__search:focus {
        margin-top: 0;
        padding: 0;
        border: none;
    }
    .vs__dropdown-option {
        padding: 3px 0.75em;
    }

    .formulate-input[data-classification=select] .formulate-input-element::before {
        content: none;
    }
</style>