import schemaThuonghan from './schemas/thuonghan'
import schemaHoga from './schemas/hoga'
import schemaZika from './schemas/zika'

let schema = []
switch (pageData.form.chuandoan_bd) {
    case 'THUONG HAN': schema = schemaThuonghan; break
    case 'HO GA': schema = schemaHoga; break
    case 'ZIKA': schema = schemaZika; break
    default: break
}

export default {
    method: 'POST',
    url: '/benh_tn/default/update?id=10',
    schema,
    actions: {
        position: 'bottom',
        schema: [
            {
                component: 'div', class: 'flex my-2', children: [
                    {component: 'button', type: 'submit', children: 'Submit', variant: 'primary', class: 'ml-auto btn btn-primary'}
                ]
            },
        ]
    }
}