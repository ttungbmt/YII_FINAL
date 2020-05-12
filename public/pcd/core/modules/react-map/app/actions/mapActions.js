import {flashWarning} from './flashActions';
import {isEmpty} from 'lodash';



export function geocodeGoogle(addr){

    return (dispatch, getState) => {
        let {location, gmaps, label, placeId} = addr;
        let outbounds;

        if(gmaps){
            // Kiểm tra nếu điểm nằm ngoài TP. HCM thì trả về trung tâm
            label = gmaps.formatted_address;

            // const {hc_phuong, hc_tokhupho} = window.geoJSON;
            // let onSurface = pointInPolygon(location, hc_phuong);
            // outbounds = isEmpty(onSurface) ? true : false;
            outbounds = false;
        }

        // Tìm kiếm đẩy dữ liệu phường xã, quận huyện

        if(outbounds){
            dispatch(flashWarning('Không tìm thấy địa chỉ', 'Cảnh báo'));
        } else {
            dispatch({ type: 'GEOCODE_GOOGLE', payload: { label, location, placeId,}})
        }

    };

}