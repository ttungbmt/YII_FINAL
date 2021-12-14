<template>
    <b-alert show :variant="variant" dismissible class="border-0" v-if="!_.isEmpty(messagesArr)">

        <span class="font-weight-semibold">{{label}}</span>
        <ul>
            <li v-for="(v, k) in messagesArr" :key="k">{{v}}</li>
        </ul>
    </b-alert>
</template>
<script>
    import { map } from 'lodash-es'

    export default {
        name: 'v-alert',
        props: {
            messages: [Array, Object],
            variant: String,
            label: {
                type: String,
                default(){
                    return 'Vui lòng điền các thông tin sau:'
                }
            },
        },
        computed: {
            messagesArr() {
                return map(this.messages, v => v.join(', '))
            }
        }
    }
</script>