import { map, isPlainObject, isBoolean, toLower, isArray } from 'lodash-es'

export default {
    options: [Array, Object],
    computed: {
        vid(){
            // if(this.id) return this.id
            // if(this.$attrs.id) return this.$attrs.id
            return this.strArr2Dot(`${this.$attrs.name}`)
        },
        items(){
            let arr = this.options

            if(isPlainObject(this.options)) {
                arr = []
                map(this.options, (v, k) => { arr.push({text: v, value: k})})
            }

            if(this.prompt && isArray(arr)){
                let label = isBoolean(this.prompt) ? `Chọn ${toLower(this.$attrs.label)}` : this.prompt
                arr = [{text: label, value: null}, ...arr]
            }

            return arr
        }
    },
    methods: {
        strArr2Dot(str){
            return str.replace('][', '.').replace('[', '.').replace(']', '')
        }
    }
}