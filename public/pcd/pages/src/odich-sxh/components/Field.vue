<template>
    <div>
        <b-form-group :label="label">
            <component :is="computedComponent" v-bind="computedAttrs" v-model="innerValue"></component>
        </b-form-group>
    </div>
</template>
<script>
    import {get, has, isString, isPlainObject, isArray, map, isEmpty, includes} from 'lodash-es'

    const toOptions = (items, extraOpts = {}, config = {}) => {
        let opts = []
        let {label = 'label', value = 'value'} = config
        let {placeholder} = extraOpts

        if (isPlainObject(items)) {
            opts =  map(items, (l, v) => ({[value]: v, [label]: l}))
        }

        if (isArray(items)) {
            if (has(items, '0.value') && has(items, '0.label')) {
                opts =  items
            } else {
                opts = items.map((l, v) => ({[value]: v, [label]: l}))
            }
        }

        if(!isEmpty(opts)){
            if(placeholder) return  [{[value]: null, [label]: placeholder}].concat(opts)
            return opts
        }

        return items
    }

    const inputTypes = ['text', 'password', 'integer', 'number', 'email', 'url', 'search', 'tel', 'range', 'date']

    export default {
        inheritAttrs: false,
        name: 'v-field',
        props: {
            label: String,
            model: String,
            placeholder: String,
            type: {
                type: String,
                default: 'text'
            },
            items: [String, Array, Object]
        },
        computed: {
            innerValue: {
                get: function () {
                    if (!this.model) return ''

                    return get(this.$store.state, this.model)
                },
                set: function (value) {
                    if (this.model) {
                        this.$store.commit('updateField', {
                            path: this.model,
                            value
                        })
                    }

                }
            },

            computedComponent(){
                if(includes(['text', 'password', 'integer', 'number', 'email', 'url', 'search', 'tel', 'range'], this.type)) {
                    return 'b-form-input'
                }

                switch (this.type) {
                    case 'editor':
                        return 'v-editor'
                    case 'select':
                    case 'textarea':
                        return `b-form-${this.type}`
                    case 'date':
                        return 'v-input-date'
                }
            },

            computedAttrs(){
                let attrs = {}

                if(this.type === 'select'){
                    attrs.options = this.computedItems
                }

                if(includes(['text', 'password', 'number', 'email', 'url', 'search', 'tel', 'range'], this.type)){
                    attrs.type = this.type
                }

                if(this.type === 'integer'){
                    attrs = {...attrs, type: 'number', min: 0, step: 1}
                }

                if(this.type === 'date'){
                    attrs = {...attrs, type: 'text'}
                }

                if(includes(inputTypes, attrs.type)){
                    attrs.placeholder = this.placeholder
                }

                return attrs
            },

            computedItems() {
                let items = []
                if (isString(this.items)) {
                    items = get(this.$store.state, this.items, [])
                }

                return toOptions(items, {placeholder: this.placeholder}, {label: 'text'})
            }
        },
        created() {
            let path = this.model
            if (!has(this.$store.state, path)) {
                this.$store.commit('createField', {path})
            }
        }
    }
</script>
