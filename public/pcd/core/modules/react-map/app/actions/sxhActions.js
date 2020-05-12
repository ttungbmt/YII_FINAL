import {flashWarning} from './flashActions';
import {pick, get, set} from 'lodash';
import {convGeoDate} from '../utils/index';


export function updateSxhModel(model){
    return (dispatch, getState) => {

        ['ngaymacbenh_nv', 'ngaymacbenh', 'ngaynhapvien'].map((val) => {
            set(model, val, convGeoDate(get(model, val)));
        })





        dispatch({ type: 'SXH_MODEL', payload: model});
        model.from == 'map' || dispatch({ type: 'MAP_FLYTO', payload: [model.lat, model.lng]});
        dispatch({ type: 'SXH_POPUP', payload:
            model.from == 'map' ? 'map' : 'sidebar'
        });
    };
}

export function filterSxh(data){
    return (dispatch, getState) => {

        dispatch({
            type: 'SXH_FILTER',
            payload: data
        })

    };
}

export function addKvSxh(data, radius){
    return (dispatch, getState) => {
        const {khoanhvung} = getState().sxh;
        let dup = khoanhvung.find(val => val.id == data.macabenh);

        if(dup){
            dispatch(flashWarning(`Ca ${data.hoten} đã khoanh vùng`));
        } else {
            dispatch({
                type: 'SXH_ADD_KHOANHVUNG',
                payload: {
                    id: data.macabenh,
                    center: pick(data, ['lat', 'lng']),
                    radius,
                    model: data,
                    chosen: false
                }
            })
        }

    };

}


export function updateKvSxh(data, radius){
    return (dispatch, getState) => {
        const {khoanhvung} = getState().sxh;
        let dup = khoanhvung.find(val => val.id == data.macabenh);

        let payload = {
            id: data.macabenh,
            center: pick(data, ['lat', 'lng']),
            radius,
            model: data,
            chosen: true,
            color: '#ffff00'
        }

        if(dup){
            dispatch({type: 'SXH_UPDATE_KV_TO_ODICH', payload});
        } else {
            dispatch({type: 'SXH_ADD_TO_ODICH', payload});
        }

    };
}

export function deleteKvSxh(ids){
    return {
        type: 'SXH_DELETE_KHOANHVUNG',
        ids
    }
}