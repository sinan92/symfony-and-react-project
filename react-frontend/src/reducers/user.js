import * as types from '../actions/actionTypes';

const initialState = {
    loggedIn: false,
    username: '',
    password: '',
};

const user = (state = initialState, action) => {
    switch (action.type) {
        case types.LOGIN_USER:
            return {
                ...state,
                loggedIn: true,
                username: action.username,
                password: action.password
            };
        case types.LOGOUT_USER:
            return {
                ...state,
                loggedIn: false,
                username: '',
                password: ''
            };
        default:
            return state
    }
};

export default user