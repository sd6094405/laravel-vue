// import vuex from 'vuex'

// const needAuth = route => route.meta.auth === true;

const beforeEach = (to, from, next) => {
    const user = localStorage.getItem('user');

    // if(!user) {
    //     return next({name: 'login'});
    // }
    next();
};

export default beforeEach