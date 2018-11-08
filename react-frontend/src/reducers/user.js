import * as types from '../actions/actionTypes';

const initialState = {
    loggedIn: false,
    username: '',
    password: '',
    users: [
        {username: 'sinan', password: 'test'},
        {username: 'root', password: 'root'},
    ]
};

const user = (state = initialState, action) => {
    switch (action.type) {
        case types.LOGIN_USER:
            let valid = false;
            state.users.map(user => {
                if((user.username === action.username) && (user.password === action.password)){
                    valid = true;
                }
                return true;
            });
            if(valid){
                return {
                    ...state,
                    loggedIn: true,
                    username: action.username,
                    password: action.password
                };
            }
            else{
                return {
                    ...state,
                    loggedIn: false
                }
            }
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