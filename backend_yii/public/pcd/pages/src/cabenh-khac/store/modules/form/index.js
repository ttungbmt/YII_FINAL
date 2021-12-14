import axios from 'axios'
import {get, isPlainObject, isString, isInteger, isEmpty, isEqual, isUndefined} from 'lodash-es'
import { getField, updateField } from 'vuex-map-fields'
import { vueSet } from 'vue-deepset'

const defaultState = {
    cats: {
        gioitinh: [{value: 'T', label: 'Nam'}, {value: 'G', label: 'Nữ'}],
        yesno: [{value: '1', label: 'Có'}, {value: '2', label: 'Không'}],
        yesnonull: [{value: '1', label: 'Có'}, {value: '2', label: 'Không'}, {value: '3', label: 'Không rõ'}],
        duongamnull: [{value: '1', label: '(+)'}, {value: '2', label: '(-)'}, {value: '3', label: 'Không rõ'}],
        thuonghan_xv: [{value: '1', label: 'Vi (polysaccharide)'}, {value: '2', label: 'Ty21a (uống)'}],
        songgan: [{value: '2', label: 'Kênh, rạch'}, {value: '3', label: 'Ao, hồ'}, {value: '4', label: 'Sông, suối'}, {value: '5', label: 'Bãi rác'}, {value: '1', label: 'Khác'}],
        nguonnuoc: [{value: '2', label: 'Bồn nước mưa'}, {value: '3', label: 'Nước giếng khoan'}, {value: '4', label: 'Nguồn nước bên ngoài (Sông, suối, đập)'}, {value: '5', label: 'Nước máy'}, {value: '1', label: 'Khác'}],

        hoga: {
            nguon_tb: [{value: '1', label: 'Y tế'}, {value: '2', label: 'Phòng khám tư'}, {value: '3', label: 'Cộng đồng'}, {value: '4', label: 'Tìm kiếm'}, {value: '5', label: 'Khác'}],
            tinhtrang_ls: [{value: '1', label: 'Lành'}, {value: '2', label: 'Chết'}],
            ketluan: [{value: '1', label: 'Ca ho gà xác định'}, {value: '2', label: 'Ca ho gà có thể'}, {value: '3', label: 'Loại trừ ca ho gà'}],
            dt_3tuan_pb: [{value: '1', label: 'Trường học'}, {value: '2', label: 'Nhà trẻ'}, {value: '3', label: 'Nơi làm việc'}, {value: '4', label: 'Ở nhà'}, {value: '5', label: 'Nhà người thân'}, {value: '6', label: 'Nhà bạn'}, {value: '7', label: 'Nhà hàng xóm'}, {value: '8', label: 'Phòng khám'}, {value: '9', label: 'Bệnh viện'}, {value: '10', label: 'Tiệm cà phê'}, {value: '11', label: 'Điểm giải trí'}, {value: '12', label: 'Xe buýt'}, {value: '13', label: 'Nhà thờ'}, {value: '14', label: 'Chùa đình'}, {value: '15', label: 'Du lịch'}, {value: '16', label: 'Khác'},],
        },

        zika: {
            bn_cungutai: [{value: '1', label: 'Địa chỉ trên'}, {value: '2', label: 'Nơi khác/Tp'}, {value: '3', label: 'Tỉnh'}],
            nghenghiep: [{value: '1', label: 'Đi học'}, {value: '2', label: 'Khác'}],
            benhdomuoi: [{value: '1', label: 'SXH'}, {value: '2', label: 'VNNB'}, {value: '3', label: 'Sốt vàng'}, {value: '4', label: 'Khác'}],
            benhlykhac: [{value: '1', label: 'Ung thư'}, {value: '2', label: 'Tiểu đường'}, {value: '3', label: 'Tim mạch'}, {value: '4', label: 'Phổi'}, {value: '5', label: 'Suy giảm miễn dịch'}, {value: '6', label: 'Khác'},],
            bienchung: [{value: '1', label: 'Trẻ sống '}, {value: '2', label: 'Chết thai nhi '}, {value: '3', label: 'Chết chu sin '}, {value: '4', label: 'Tật đầu nhỏ '}, {value: '5', label: 'Hóa vôi nội sọ '}, {value: '6', label: 'Khác'},],
            dangban: [{value: '1', label: 'Dát sần'}, {value: '2', label: 'Đốm xuất huyết'}, {value: '3', label: 'Ban xuất huyết '}, {value: '4', label: 'Khác'},],
            trieutrungkhac: [{value: '1', label: 'Đau khớp'}, {value: '2', label: 'Viêm kết mạc - mắt đỏ'}, {value: '3', label: 'Đau cơ '}, {value: '4', label: 'Đau hốc mắt'}, {value: '5', label: 'Nhức đầu'}, {value: '6', label: 'Ói mữa'}, {value: '7', label: 'Tiêu chảy '}, {value: '8', label: 'Phù quanh khớp'},],
            kq_sieuam: [{value: '1', label: 'Thai bình thường'}, {value: '2', label: 'Tật đầu nhỏ'}, {value: '3', label: 'Hóa vôi nội sọ  '}, {value: '4', label: 'Khác'},],
            kq_thai: [{value: '1', label: 'Đẻ sống'}, {value: '2', label: 'Thai chết (≥ 21 tuần)'}, {value: '3', label: 'Sảy thai (< 21 tuần)'}, {value: '4', label: 'Chấm dứt thai'}, {value: '5', label: 'Không rõ'},],
            tt_tremoisinh: [
                {value: '1', label: 'Trẻ sống'},
                {value: '2', label: 'Chết thai nhi'},
                {value: '3', label: 'Sinh sống và chế'},
                {value: '4', label: 'K.rõ'},
            ],
            duongamkxd: [{value: '1', label: '(+)'}, {value: '2', label: '(-)'}, {value: '3', label: 'Không xác định'}],
            kl_cb: [{value: '1', label: 'Xác định'}, {value: '2', label: 'Có thể'}, {value: '3', label: 'Nghi ngờ'}, {value: '4', label: 'Loại trừ'},],
            kl_thainhi: [{value: '1', label: 'Binh thường'}, {value: '2', label: 'Bất thường'}, {value: '3', label: 'Đẻ sống'}, {value: '4', label: 'Thai chết (≥ 21 tuần)'}, {value: '5', label: 'Sảy thai (< 21 tuần)'}, {value: '6', label: 'Chấm dứt thai'},],
        }
    },
    items: []
}
const actions = {

}
const mutations = {
    updateField,
    registerField(state, {index, field}){
        let path1 = `items.${index}.initialValues.${field}`,
            path2 = `items.${index}.values.${field}`

        isUndefined(get(state, path1)) && vueSet(state, path1, null)
        isUndefined(get(state, path2)) && vueSet(state, path2, null)
    },
    registerForm(state, payload){
        let key = payload.key,
            initialValues = isEmpty(payload.initialValues) ? {} : payload.initialValues

        state.items.push({
            key,
            initialValues,
            values: initialValues,
        })

    },
    updateFormValue(state, {index, field, value}){
        vueSet(state, `items.${index}.values.${field}`, value)
    }
}
const getters = {
    getField,
    getFormValues: (state, getters) => payload => {
        let index, key
        if(isPlainObject(payload)) {
            index = payload.index
            key = payload.key
        } else if(isString(payload)){
            key = payload
        }  else if(isInteger(payload)){
            index = payload
        } else {
            throw new Error('Invalid payload')
        }

        let formIndex = index ? index : getters.getFormIndex(key)
        return get(state, `items.${formIndex}.values`)
    },
    getFormValue: (state, getters) => ({index, field}) => {
        return get(state, `items.${index}.values.${field}`)
    },
    getFormIndex: (state, getters) => key => {
        return state.items.findIndex(v => v.key === key)
    },
    getCat: (state, getters) => name => get(state, `cats.${name}`)
}

export default {
    namespaced: true,
    state: defaultState,
    getters,
    actions,
    mutations
}
