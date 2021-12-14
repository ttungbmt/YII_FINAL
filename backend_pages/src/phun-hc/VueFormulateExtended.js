import FormulateInputDate from './components/FormulateInputDate'
import FormulateInputSelect from './components/FormulateInputSelect'
import FormulateTable from './components/FormulateTable'

import {isInteger, toNumber, has, isNil} from 'lodash'

export default function (formulateInstance) {
   formulateInstance.extend({
      components: {
         FormulateInputDate,
         FormulateInputSelect,
         FormulateTable
      },
      library: {
         date: {classification: 'text', component: 'FormulateInputDate'},
         month: {classification: 'text', component: 'FormulateInputDate'},
         table: {classification: 'text', component: 'FormulateTable'},
      },
      rules: {
         integer: ({ name, value }) => isInteger(toNumber(value)),
         maxValue: ({name, value, getFormValues}, target) => {
            let values = getFormValues()
            if(has(values, target) && !isNil(values[target]))  return value <= values[target]
            return true
         }
      }
   })
}