import * as types from './actionTypes';

export function loginUser(username, password) {
    return {
        type: types.LOGIN_USER,
        username: username,
        password: password
    };
}

export function logoutUser() {
    return {
        type: types.LOGOUT_USER,
    };
}