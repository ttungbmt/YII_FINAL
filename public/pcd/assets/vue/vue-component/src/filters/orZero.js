import { isNull } from 'lodash-es'

function orZero(value) {
    if (isNull(value)) return 0
    return value
}

export default orZero