import * as types from '../actions/actionTypes';

const initialState = {
    messages: [],
    message: null,
    messageSearchResults: [],
    success: null,
}

const messages = (state = initialState, action) => {
    switch (action.type) {
        case types.FETCH_MESSAGES:
            return {
                ...state,
                messages: action.payload
            };
        case types.FETCH_MESSAGE_BY_ID:
            return {
                ...state,
                message: action.payload
            };
        case types.FETCH_MESSAGES_BY_CONTENT:
            return {
                ...state,
                messageSearchResults: action.payload
            };
        case types.FETCH_MESSAGES_BY_CONTENT_AND_CATEGORY:
            return {
                ...state,
                messageSearchResults: action.payload
            };
        case types.UPVOTE_MESSAGE:
            const upvotedMessages = state.map(message => {
                if(message.id === action.id){
                    return {...message, ...action.payload}
                }
            });

            return {
                ...state,
                messages: upvotedMessages
            };
        case types.DOWNVOTE_MESSAGE:
            const downvotedMessages = state.map(message => {
                if(message.id === action.id){
                    return {...message, ...action.payload}
                }
            });

            return {
                ...state,
                messages: downvotedMessages
            };
        default:
            return state
    }
}

export default messages