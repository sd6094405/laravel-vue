import axios from 'axios';

export const backUrl = '/api/back/';
export const baseUrl = '/api/';

/* ajax-get */
export const fetch = (url,data={}) =>{
    return new Promise((resolve,reject) => {

        axios({
            method:'get',
            url:url,
            params:data,
            headers:{
                'X-Requested-With': 'XMLHttpRequest'
            },
        }).then(resp=>{
            resolve(resp);

        }).catch(err=>{
            reject(err);

        })
    })
};

/* json-post */
export const postJson = (url,data={}) =>{
    return new Promise((resolve,reject)=>{
        axios({
            method:'post',
            url:url,
            data:data,
            headers:{
                'X-Requested-With': 'XMLHttpRequest'
            },
        }).then(resp=>{
            resolve(resp)
        },reject)
    })
}

/* ajax-post */
export const postData = (url,data={}) =>{
    return new Promise((resolve,reject)=>{
        axios({
            method:'post',
            url:url,
            headers:{
                'Content-type': 'application/x-www-form-urlencoded'
            },
            data:data,
            transformRequest: [function (data) {
                let ret = ''
                for (let it in data) {
                    ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
                }
                return ret
            }]
        }).then(resp=>{
            resolve(resp)
        },reject)
    })
}

/* ajax-post */
export const postFormData = (url,data={}) =>{
    return new Promise((resolve,reject)=>{
        axios({
            method:'post',
            url:url,
            headers:{
                'Content-type': 'multipart/form-data'
            },
            data:data,
            transformRequest: [function (data) {
                let ret = ''
                for (let it in data) {
                    ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
                }
                return ret
            }]
        }).then(resp=>{
            resolve(resp)
        },reject)
    })
}

/* ajax-put */
export const putFormData = (url,data={}) =>{
    return new Promise((resolve,reject)=>{
        axios({
            method:'put',
            url:url,
            headers:{
                'Content-type': 'multipart/form-data'
            },
            data:data
            // transformRequest: [function (data) {
            //     let ret = ''
            //     for (let it in data) {
            //         ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
            //     }
            //     return ret
            // }]
        }).then(resp=>{
            resolve(resp)
        },reject)
    })
}