<template>
    <div v-html="computedHtml"></div>
</template>
<script>
    import {isFunction} from 'lodash-es'

    export default {
        inheritAttrs: false,
        name: 'm-html',
        props: {
            html: [String, Function]
        },
        computed: {
            computedHtml(){
                if(isFunction(this.html)){
                    return this.html.bind(this)()
                }

                return this.html
            }
        }
    }
</script>