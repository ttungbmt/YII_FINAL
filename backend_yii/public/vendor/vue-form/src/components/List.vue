<template>
    <div>
        <b-list-group>
            <draggable v-model="innerItems" @change="onChange">
                <b-list-group-item v-for="(v, k) in innerItems" :key="k"><span v-html="getValue(v, k)"></span></b-list-group-item>
            </draggable>
        </b-list-group>

    </div>
</template>

<script>
    import {isFunction} from 'lodash-es'
    export default {
        name: 'm-list',
        props: {
            itemsPath: String,
            items: {
                type: [String, Array],
            },
            formatter: {
                type: [String, Function],
            },
            ordered: Function
        },
        data(){
            return {
                innerItems: this.getItems()
            }
        },
        methods: {
            getItems(){
                if(this.items) return this.items

                if(this.itemsPath) return this.$store.get(this.itemsPath).map((v, k) => {
                    return {
                        ...v,
                        _index: k
                    }
                })

                return []
            },
            getValue(item, index){
                if(isFunction(this.formatter)){
                    return this.formatter.bind(this)(item, index)
                }

                return index
            },
            onChange({moved}){
                this.$emit('ordered', this.innerItems.map(v => v._index))
            }
        },

    }
</script>