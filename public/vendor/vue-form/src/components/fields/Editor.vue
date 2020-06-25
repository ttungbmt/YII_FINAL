<template>
    <quill-editor :content="value" @change="updateValue($event)"/>
</template>

<script>
    import { quillEditor } from 'vue-quill-editor'
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'

    export default {
        name: 'v-editor',
        props: {
            value: [String, Number],
            editor: {
                type: String,
                default: 'quill'
            },
        },
        components: {
            quillEditor
        },
        mounted(){

        },
        methods:{
            updateValue({quill, html, text}){
                this.$emit('input', html)
            },
        },
        beforeDestroy() {

        },
    }
</script>