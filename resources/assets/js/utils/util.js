import CryptoJS from 'crypto-js'

//加密
export const encrypt = function (value){
    var key = CryptoJS.enc.Utf8.parse("0102030405060708");
    var iv = "0102030405060708";
        if (!value) {
            throw new Error("需要加密数据不能为空");
        }
        let data = {
            "iv":"",
            "value":""
        };
        data.iv = encode(iv);
        data.value = CryptoJS.AES.encrypt(value, key, {
            iv: CryptoJS.enc.Utf8.parse(iv),
            mode: CryptoJS.mode.CBC
        }).toString();
        // return data;
        return encode(JSON.stringify(data));
};

//解密
export const decrypt = function(ctrptText) {
    var key = CryptoJS.enc.Utf8.parse("0102030405060708");

    if (!ctrptText) {
        throw new Error("密文不能为空");
    }
    let s = decode(ctrptText);
    try {
        let j = JSON.parse(s);
        let va = j.value;
        let vi = decode(j.iv);
        return CryptoJS.AES.decrypt(va, key, {
            iv: CryptoJS.enc.Utf8.parse(vi),
            mode: CryptoJS.mode.CBC
        }).toString(CryptoJS.enc.Utf8);
    } catch (e) {
        throw new Error(e);
    }
};

export function make_rand(radix) {
    return Math.random().toString(radix).substr(2);
}

//字符串转base64
export function encode(str){
    // 对字符串进行编码
    // var encode = encodeURI(str);
    // 对编码的字符串转化base64
    return btoa(str);
}

// base64转字符串
export function decode(base64){
    return atob(base64)
    // 对base64转编码
    // var decode = atob(base64);
    // 编码转字符串
    // return decodeURI(decode);
}

export function base64ToBlob(base64) {
    // 解码base64
    var byteString = atob(base64.split(',')[1]);
    var mimeString = base64.split(',')[0].split(':')[1].split(';')[0];
// 类型数组
    var ia = new Uint8Array(byteString.length);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new Blob([ia], {
        type: mimeString
    });
}

export function base64ToTwo(base64)
{
    console.log(base64.split(','))
    return atob(base64.split(',')[1]).toString(2);
}


// 将base64转换成file对象
export function dataURLtoFile (dataurl, filename = 'file') {
    let arr = dataurl.split(',')
    let mime = arr[0].match(/:(.*?);/)[1]
    let suffix = mime.split('/')[1]
    let bstr = atob(arr[1])
    let n = bstr.length
    let u8arr = new Uint8Array(n)
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n)
    }
    return new File([u8arr], `${filename}.${suffix}`, {type: mime})
}