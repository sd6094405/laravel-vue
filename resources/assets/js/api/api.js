import {postData,fetch,putFormData} from '../config/httpService'
import 'cos-js-sdk-v5'

export function getSign(){
    return postData('/api/sign')
}

export function putObject(url,data){
    return putFormData(url,data)
}