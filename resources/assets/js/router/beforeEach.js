const beforeEach = (to, from, next) => {
    let token = localStorage.getItem('token');
    let urlName = to.name;
    if(urlName == 'login'){
        next();
    }else{
        // sessionStorage.setItem('urlName',urlName);
        if(!token){
            next({name:"login"})
        }else{
            next();
        }
    }
};

export default beforeEach