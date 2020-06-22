<template>
    <div v-html="html"></div>
</template>
<script>
    export default {
        inheritAttrs: false,
        name: 'v-html',
        props: [
            'html',
        ],
        data(){
            return {
            }
        }
    }
</script>