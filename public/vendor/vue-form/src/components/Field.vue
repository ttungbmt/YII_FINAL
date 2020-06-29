<template>
    <validation-provider v-slot="v" :rules="fieldRules" :name="label" :vid="computedName" ref="validator" slim>
        <b-form-group :label="label">
            <component :is="computedComponent" v-bind="computedAttrs" v-model="innerValue" :state="getValidationState(v)"></component>
            <b-form-invalid-feedback>{{ v.errors[0] }}</b-form-invalid-feedback>
        </b-form-group>
    </validation-provider>
</template>
<script>
    import {get, has, replace, isString, isPlainObject, isFunction, isArray, map, isEmpty, includes, isUndefined, filter} from 'lodash-es'

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

    // Valid supported input types
    const TYPES = [
        'text',
        'password',
        'email',
        'number',
        'url',
        'tel',
        'search',
        'range',
        'color',
        'date',
        'time',
        'datetime',
        'datetime-local',
        'month',
        'week'
    ]

    export default {
        inheritAttrs: false,
        name: 'm-field',
        inject: ['formOptions'],
        props: {
            id: String,
            label: String,
            rules: String,
            name: String,
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

                    return this.$store.get(this.modelPath)
                },
                set: function (value) {
                    if(!isUndefined(this.value)) {
                        this.$emit('input', value)
                    }

                    if (this.model) this.updateField(value)
                }
            },

            modelPath(){
                return [this.formOptions.model, this.model].join('.')
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
                const { computedType: type, computedName: name, id, disabled, placeholder, required, min, max, step } = this

                let attrs = {
                    type,
                    name
                }

                if(this.type === 'select'){
                    attrs.options = this.computedItems
                }

                if(this.type === 'integer'){
                    attrs = {...attrs, min: 0, step: 1}
                }

                if(includes(TYPES, attrs.type)){
                    attrs.placeholder = this.placeholder
                }

                if(id) attrs.id = id

                return attrs
            },

            computedName(){
                  return this.name ? this.name : this.model
            },

            computedType(){
                if(includes(['text', 'password', 'number', 'email', 'url', 'search', 'tel', 'range'], this.type)){
                    return this.type
                }

                if(this.type === 'integer'){
                    return 'number'
                }

                if(this.type === 'date'){
                    return 'text'
                }
            },

            computedItems() {
                let items = []
                if (isString(this.items)) {
                    items = get(this.$store.state, this.items, [])
                } else {
                    items = this.items ? this.items : []
                }

                if(this.filterBy && !isUndefined(this.filterBy.value)){
                    items = filter(items, v => get(v, this.filterBy.path) == this.filterBy.value)
                }

                return toOptions(items, {placeholder: this.placeholder}, {label: 'text'})
            },

            fieldRules(){
                if(isFunction(this.rules)) return this.rules.bind(this)(this.innerValue)

                return this.rules
            }
        },
        watch: {
            'filterBy.value': function (val) {
                this.$emit('input', null)

                if (this.model) this.updateField(null)
            }
        },
        created() {
            let path = this.modelPath
            if (!this.$store.has(path)) {
                this.$store.commit('createField', {path, value: null})
            }
        },
        methods: {
            updateField(value){
                this.$store.commit('updateField', {
                    path: this.modelPath,
                    value
                })
            },
            getValidationState({ dirty, validated, valid = null, failed }) {
                if(this.rules || failed) return dirty || validated ? valid : null;
                return null
            },
        },
        mounted(){
            // let depends = get(this.filterBy, 'depends')
            // if(depends){
            //     console.log(this.computedItems)
            //     // let value = $(depends).val()
            //     // // console.log(filter(this.computedItems, v => get(v, this.filterBy.path) == value))
            //     // this.$emit('input', filter(this.computedItems, v => get(v, this.filterBy.path) == value))
            //     // $(depends).change(() => {
            //     //     this.$emit('input', null)
            //     // })
            // }

        }
    }
</script>
