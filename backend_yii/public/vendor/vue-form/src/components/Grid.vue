<template>
    <div :class="innerClass" v-if="computedIf">
        <component v-bind:is="i.component" v-for="(i, k) in schema" v-bind="i" :key="k"></component>
    </div>
</template>
<script>
    import {isFunction} from 'lodash-es'

    export default {
        inheritAttrs: false,
        name: 'm-grid',
        props: {
            cols: {
                type: Number,
                default: 4
            },
            gap: {
                type: Number,
                default: 4
            },
            schema: Array,
            cond_if: [String, Function]
        },
        computed: {
            innerClass(){
                let clx = ['grid']
                if(this.cols) clx.push(`grid-cols-${this.cols}`)
                if(this.gap) clx.push(`gap-${this.gap}`)

                return clx
            },
            computedIf(){
                if(isFunction(this.cond_if)){
                    return this.cond_if.bind(this)()
                }
                return true
            }
        }
    }
</script>
