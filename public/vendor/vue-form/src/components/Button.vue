<template>
    <div :class="`text-${align}`">
        <button :class="computedClass" :type="computedType" @click="onClick"><i v-if="loading" class="icon-spinner2 spinner mr-2"></i> <slot></slot></button>
    </div>
</template>
<script>
    import $ from 'jquery'
    import TableToExcel from "@linways/table-to-excel"

    export default {
        name: 'm-btn',
        props: {
            color: String,
            '3d': {
                type: Boolean,
                default: true
            },
            loading: {
                type: Boolean,
                default: false
            },
            depressed: {
                type: Boolean,
                default: true
            },
            type: String,
            size: String,
            exportOptions: Object,
            align: {
                type: String,
                default: 'right'
            }
        },
        computed: {
            computedType(){
                if(this.type === 'submit') return 'submit'
                return 'button'
            },
            computedClass(){
                let classArr = ['m-btn']
                switch (this.color) {
                    case 'primary': classArr.push('bg-blue-600'); break
                    default: classArr.push('m-btn-white'); break
                }

                if(this['3d']){
                    classArr.push('m-btn-3d')
                }

                return classArr.join(' ')
            }
        },
        mounted(){

        },
        methods: {
            onClick(e){
                console.log($(this.tableSelector))
                if(this.$listeners.click){
                    this.$emit('click', e)
                    return
                }

                if(this.type === 'export') {
                    let {selector, filename = 'table.xlsx', sheet = 'Sheet'} = this.exportOptions
                    TableToExcel.convert($(selector).get(0), {
                        name: filename,
                        sheet: {
                            name: sheet
                        }
                    })
                }
            }
        }

    }
</script>

<style scoped lang="scss">



</style>