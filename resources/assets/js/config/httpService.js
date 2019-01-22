import axios from 'axios';

export const backUrl = '/api/back/';
export const baseUrl = '/api/';
export const cosBucket = 'http://blog-1257809211.cos.ap-chengdu.myqcloud.com/';
import {message} from 'element-ui'
import router from '../router/admin'

// 拦截响应response，并做一些错误处理
axios.interceptors.response.use((response) => {
    const data = response.data
    if (data.code == '200') return data;
// 根据返回的code值来做不同的处理（和后端约定）
    switch (data.code) {
        // 需要重新登录
        case '401':
            localStorage.removeItem('token ');
            message.error(data.data);
            router.push({name: 'login'});
            return response;
            break;
        case '403':
            message.error(data.data);
            return response;
            break;
        case '404':
            message.error(data.data);
            return response;
            break;
        case '500':
            message.error(data.data);
            return response;
            break;
        default:
            return response;
    }
    // 若不是正确的返回code，且已经登录，就抛出错误
    const err = new Error(data.description)
    err.data = data
    err.response = response

    throw err
}, (err) => { // 这里是返回状态码不为200时候的错误处理
    if (err && err.response) {
        switch (err.response.status) {
            case 400:
                message.error('请求错误');
                break

            case 401:
                message.error('未授权，请登录');
                break

            case 403:
                message.error('拒绝访问');
                break

            case 404:
                message.error('请求地址出错' + `${err.response.config.url}`);
                // err.message = `请求地址出错: ${err.response.config.url}`
                break

            case 408:
                message.error('请求超时');
                break

            case 500:
                message.error('服务器内部错误');
                break

            case 501:
                message.error('服务未实现');
                break

            case 502:
                message.error('网关错误');
                break

            case 503:
                message.error('服务不可用');
                break

            case 504:
                message.error('网关超时');
                break

            case 505:
                message.error('HTTP版本不受支持');
                break

            default:
        }
    }

    return Promise.reject(err)
})

/* ajax-get */
export const fetch = (url, data = {}) => {
    return new Promise((resolve, reject) => {

        axios({
            method: 'get',
            url: url,
            params: data,
            headers: {
                'api-token': localStorage.getItem('token'),
                'X-Requested-With': 'XMLHttpRequest'
            },
        }).then(resp => {
            resolve(resp);

        })
    })
};

/* ajax-put */
export const putData = (url, data = {}) => {
    return new Promise((resolve, reject) => {

        axios({
            method: 'PUT',
            url: url,
            data: data,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'api-token': localStorage.getItem('token')
            },
        }).then(resp => {
            resolve(resp);
        }, reject)
    })
};

/* json-post */
export const postJson = (url, data = {}) => {
    return new Promise((resolve, reject) => {
        axios({
            method: 'post',
            url: url,
            data: data,
            headers: {
                'api-token': localStorage.getItem('token'),
                'X-Requested-With': 'XMLHttpRequest'
            },
        }).then(resp => {
            resolve(resp)
        }, reject)
            .catch(err => {
                resolve(err)
            }, reject)
    })
}

/* json-delete */
export const deleteJson = (url, data = {}) => {
    return new Promise((resolve, reject) => {
        axios({
            method: 'delete',
            url: url,
            data: data,
            headers: {
                'api-token': localStorage.getItem('token'),
                'X-Requested-With': 'XMLHttpRequest'
            },
        }).then(resp => {
            resolve(resp)
        }, reject)
    })
}

/* ajax-post */
export const postData = (url, data = {}) => {
    return new Promise((resolve, reject) => {
        axios({
            method: 'post',
            url: url,
            headers: {
                'api-token': localStorage.getItem('token'),
                'Content-type': 'application/x-www-form-urlencoded'
            },
            data: data,
            transformRequest: [function (data) {
                let ret = ''
                for (let it in data) {
                    ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
                }
                return ret
            }]
        }).then(resp => {
            resolve(resp)
        }, reject)
    })
}

/* ajax-post */
export const postFormData = (url, data = {}) => {
    return new Promise((resolve, reject) => {
        axios({
            method: 'post',
            url: url,
            headers: {
                'api-token': localStorage.getItem('token'),
                'Content-type': 'multipart/form-data'
            },
            data: data,
            transformRequest: [function (data) {
                let ret = ''
                for (let it in data) {
                    ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
                }
                return ret
            }]
        }).then(resp => {
            resolve(resp)
        }, reject)

    })
}

/* ajax-put */
export const putFormData = (url, data = {}) => {
    return new Promise((resolve, reject) => {
        axios({
            method: 'PUT',
            data: data,
            url: url,
            headers: {
                'Content-type': 'multipart/form-data'
            },
            // transformRequest: [function (data) {
            //     let ret = ''
            //     for (let it in data) {
            //         ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
            //     }
            //     return ret
            // }]
        }).then(resp => {
            resolve(resp)
        }, reject)
    })
}