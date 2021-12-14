<template>
    <div :class="innerClass" v-if="computedIf">
        <slot />
    </div>
</template>
<script>
    import {isFunction} from 'lodash'

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
            if: [String, Function]
        },
        computed: {
            innerClass(){
                let clx = ['grid']
                if(this.cols) clx.push(`grid-cols-${this.cols}`)
                if(this.gap) clx.push(`gap-${this.gap}`)

                return clx
            },
            computedIf(){
                if(isFunction(this.if)) return this.if.bind(this)()
                return true
            }
        }
    }
</script>