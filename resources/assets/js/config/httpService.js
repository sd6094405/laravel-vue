import axios from 'axios';
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
            resolve(resp)
        }).catch(err=>{
            reject(err);
        })
    })
};

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