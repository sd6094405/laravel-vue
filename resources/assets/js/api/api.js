import {postData,postJson,fetch,putFormData} from '../config/httpService'
import 'cos-js-sdk-v5'

export function getSign(fileName){
    return postJson('/api/back/sign',fileName)
}

export  function putObject(url,data){
    return putFormData(url,data)
}