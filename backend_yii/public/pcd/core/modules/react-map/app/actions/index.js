import axios from 'axios';

export const fetchData = (url) => {
    return (dispatch, getState) => {
        return axios.get(url).then((res) => {
            dispatch({type: 'RECIEVE_DATA', payload: res});
        })
    };
    // return {
    //     type: 'FETCH_DATA',
    //     payload: axios.get(url).then((res) => {
    //         dispatch({type: 'RECIEVE_DATA', payload: res});
    //     })
    // }
}