<template>
    <a :download="fileName" href="#" @click="exportFile"><slot></slot></a>
</template>
<script>
    import ExcellentExport from 'excellentexport'

    export default {
        props: {
            tableId: {
                type: String,
                required: true
            },
            fileName: {
                type: String,
                default: 'tb-export.xls'
            },
            sheetName: {
                type: String,
                default: 'Sheet1'
            },
        },
        methods: {
            exportFile(){
                console.log(this.$el, this.tableId, this.sheetName)
                return ExcellentExport.excel(this.$el, this.tableId, this.sheetName)
            }
        }
    }
</script>