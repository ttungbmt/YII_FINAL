<template>
    <component :is="tag" v-if="isShown" v-bind="$attrs">
        <slot />
    </component>
</template>
<script>
    import {evaluate} from '../utils'
    import {isUndefined} from 'lodash'

    export default {
        props: {
            if: {
                type: [String, Function],
            },
            tag: {
                type: String,
                default: 'div'
            }
        },
        inject: {
            getFormValues: {default: () => () => ({})},
        },
        computed: {
            isShown(){
                if(isUndefined(this.if)) return true

                return evaluate(this.if, Object.assign({}, this.getFormValues(this), {
                    window: window
                }))
            }
        }
    }
</script>