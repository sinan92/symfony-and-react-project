import * as types from '../actions/actionTypes';

const initialState = {
    messages: [],
    error: null,
    success: null,
}

const messages = (state = initialState, action) => {
    switch (action.type) {
        case types.FETCH_MESSAGES_SUCCESS:
            return {
                ...state,
                messages: action.payload
            };
        case types.FETCH_MESSAGES_FAILURE:
            return {
                ...state,
                error: action.payload
            };
        case types.UPVOTE_MESSAGE_SUCCESS:
            const upvotedMessages = state.map(message => {
                if(message.id === action.id){
                    return {...message, ...action.payload}
                }
            });

            return {
                ...state,
                messages: newMessages
            };
        case types.UPVOTE_MESSAGE_FAILURE:
            return {
                ...state,
                error: action.payload
            };
        case types.DOWNVOTE_MESSAGE_SUCCESS:
            const downvotedMessages = state.map(message => {
                if(message.id === action.id){
                    return {...message, ...action.payload}
                }
            });

            return {
                ...state,
                messages: downvotedMessages
            };
        case types.DOWNVOTE_MESSAGE_FAILURE:
            return {
                ...state,
                error: action.payload
            };
        default:
            return state
    }
}

export default messages