<template>
    <div>
        <vue-select v-bind="computedAttrs" v-model="innerValue"/>
    </div>
</template>

<script>
    import {pick} from 'lodash-es'
    import vueSelect from 'vue-select'
    import 'vue-select/dist/vue-select.css';

    export default {
        name: 'v-select',
        props: ['props', 'placeholder', 'options', 'value', 'multiple'],
        components: {
            vueSelect
        },
        computed: {
            computedAttrs(){
                return {
                    label: 'text',
                    reduce: i => i.value,
                    ...pick(this, ['placeholder', 'options', 'multiple'])
                }
            },
            innerValue: {
                get: function () {
                    return this.value
                },
                set: function (value) {
                    this.$emit('input', value)
                }
            }
        },
        data(){
            return {

            }
        }
    }
</script>
