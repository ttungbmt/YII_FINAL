<template>
    <b-form-group :label="label">
        <component :is="computedComponent" v-bind="computedAttrs" v-model="innerValue"></component>
    </b-form-group>
</template>
<script>
    import {get, has, isString, isPlainObject, isArray, map, isEmpty, includes, isUndefined, filter} from 'lodash-es'

    const natsort = (arr) => {
        return arr.sort(function (a,b) {
            if ( isNaN(a) && isNaN(b) ) {
                if (a<=b) { return false; } else { return true; }
            }
            if (isNaN(a)) { return true; }
            if (isNaN(b)) { return false; }
            return a-b;
        });
    }

    const toOptions = (items, extraOpts = {}, config = {}) => {
        let opts = []
        let {label = 'label', value = 'value'} = config
        let {placeholder} = extraOpts

        if (isPlainObject(items)) {
            opts =  map(items, (l, v) => ({[value]: v, [label]: l}))
        }

        if (isArray(items)) {
            if (has(items, '0.value') && has(items, '0.label')) {
                opts =  items.map((v, k) => ({[value]: v.value, [label]: v.label}))
            }
        }

        if(placeholder) {
            opts = [{[value]: null, [label]: placeholder}].concat(opts)
        }

        if(!isEmpty(opts)){
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
            filterBy: [Object, Function],
            placeholder: String,
            type: {
                type: String,
                default: 'text'
            },
            items: [String, Array, Object],
            value: [String, Array, Object, Number],
        },
        computed: {
            innerValue: {
                get: function () {
                    if(!isUndefined(this.value)) return this.value
                    if (!this.model) return ''

                    return get(this.$store.state, this.model)
                },
                set: function (value) {
                    if(!isUndefined(this.value)) {
                        this.$emit('input', value)
                    }

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
                } else {
                    items = this.items ? this.items : []
                }

                if(this.filterBy){
                    items = filter(items, v => get(v, this.filterBy.path) == this.filterBy.value)
                }

                return toOptions(items, {placeholder: this.placeholder}, {label: 'text'})
            }
        },
        watch: {
            'filterBy.value': function (val) {
                this.$emit('input', null)
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
