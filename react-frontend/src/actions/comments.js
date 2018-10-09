import * as types from '../actions/actionTypes';

const initialState = {
    comments: [],
    error: null,
}

const messages = (state = initialState, action) => {
    switch (action.type) {
        case types.FETCH_COMMENTS_BY_ID_SUCCESS:
            return {
                ...state,
                comments: action.payload
            };
        case types.FETCH_COMMENTS_BY_ID_FAILURE:
            return {
                ...state,
                error: action.payload
            };
        default:
            return state
    }
}

export default messages