import { ValidationProvider, ValidationObserver, localize, extend, configure } from 'vee-validate'
import vi from 'vee-validate/dist/locale/vi.json'
import * as rules from 'vee-validate/dist/rules'
import { map } from 'lodash-es'

import * as ownRules from './rules'

export default {
    install(Vue, options) {
        configure({
            classes: {
                valid: 'is-valid',
                invalid: 'is-invalid',
            }
        })

        localize('vi', {
            code: vi.code,
            messages: {
                ...vi.messages,
                integer: '{_field_} phải là một số nguyên'
            }
        })

        extend('date_to', {
            params: ['date'],
            validate(value, {to_date}) {
                let toDate = to_date ? to_date : moment().format('D/M/Y')
                let toTimestamp = moment(toDate, 'D/M/Y').valueOf()
                let valueTimestamp = moment(value, 'D/M/Y').valueOf()
                if (valueTimestamp <= toTimestamp) return true
                return `{_field_} phải nhỏ hoặc bằng ngày ${toDate}`
            },
        })

        extend('required_if_field', {
            params: ['field', 'target'],
            validate(value, {field, target}) {
                if (value) return true
                if (target) return true
                if (field === 'tuoi') return 'Ngày sinh hoặc tuổi không được để trống'
                return 'Tuổi hoặc ngày sinh không được để trống'
            },
            computesRequired: true,
        })



        map(rules, (obj, name) =>  extend(name, obj))
        map(ownRules, (validateFn, k) =>  extend(k, validateFn))

        Vue.component('ValidationProvider', ValidationProvider)
        Vue.component('ValidationObserver', ValidationObserver)
    }
}
