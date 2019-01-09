export function make_rand(radix) {
    return Math.random().toString(radix).substr(2);
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