<template>
    <component v-bind:is="component" v-bind="attrs" v-model="modelValue" :label="innerLabel" :id="innerId" :name="name" :disabled="innerDisabled"/>
</template>

<script>
    import { get, set, isArray, isUndefined, isString } from 'lodash-es'
    import { mapState } from 'vuex'

    export default {
        props: {
            id: String,
            label: String,
            disabled: [Boolean, String, Object],
            name: {
                type: String,
                required: true
            },
            nameKey: String,
            path: String,
        },
        name: 'field-sxh',
        computed: {
            ...mapState(['dm', 'form', 'schema', 'xacminh']),
            // ...mapState({
            //     storeDisabled: state => state.disabled
            // }),
            innerId(){
                if(this.id) return this.id

                return `field-${this.attrs.name}`
            },
            cname() {
                return this.nameKey ? this.nameKey : this.name
            },
            innerLabel(){
                if(this.label) return this.label

                if(!isUndefined(this.$attrs.index) && this.attrs.label){
                    return `${this.attrs.label} (${this.$attrs.index+1})`
                }
                return this.attrs.label
            },
            innerPath() {
                // Dùng để lấy dữ liệu từ store
                return this.path ? this.path : `form.${this.cname}`;
            },
            innerDisabled(){
                // Lock từ props
                if(this.disabled == true){
                    return this.disabled
                }

                // Lock từ schema (server)
                if (this.attrs.disabled) {
                    return this.attrs.disabled
                }

                // Lock từ store: locked px 1 (server)
                let pathArr = this.innerPath.split('.')

                if(pathArr.length > 2){
                    let path = pathArr.slice(0, -1).join('.'),
                        data = get(this, path, {})

                    if(!isUndefined(data.disabled)){
                        return data.disabled
                    }
                }

                return false
            },
            modelValue: {
                get: function () {
                    return get(this, this.innerPath)
                },
                set: function (newValue) {
                    if(!isArray(newValue)){

                        let pathArr = this.innerPath.split('.')  ,
                            key = pathArr.slice(0,1),
                            path = pathArr.slice(1).join('.')
                        set(this[key], path, newValue)
                    }
                }
            },
            attrs(){
                let $attrs = get(this.schema, `${this.cname}`, {})

                if ($attrs.options && isString($attrs.options)) {
                    $attrs.options = this.dm[$attrs.options]
                }

                if (this.$attrs.depends) {
                    $attrs.depends = this.$attrs.depends
                }
                return $attrs
            },

            component() {
                return get(this.schema, `${this.cname}.component`, 'field-input')
            },
        },
        methods: {

        }
    }
</script>