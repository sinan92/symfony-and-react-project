import * as types from './actionTypes';
import axios from 'axios';

export function fetchMessages() {
    return function (dispatch) {
        axios.get('http://localhost:8000/messages')
            .then((response) => {
                dispatch({type: types.FETCH_MESSAGES_SUCCESS, payload: response.data})
            })
            .catch((err) => {
                dispatch({type: types.FETCH_MESSAGES_FAILURE, payload: err})
            })
    }
};

export function upvoteMessage(id) {
    return function (dispatch) {
        axios.get('http://localhost:8000/messages/upvote/'+id)
            .then((response) => {
                dispatch({type: types.UPVOTE_MESSAGE_SUCCESS, payload: response.data})
            })
            .catch((err) => {
                dispatch({type: types.UPVOTE_MESSAGE_FAILURE, payload: err})
            })
    }
};

export function downvoteMessage(id) {
    return function (dispatch) {
        axios.get('http://localhost:8000/messages/downvote/'+id)
            .then((response) => {
                dispatch({type: types.UPVOTE_MESSAGE_SUCCESS, payload: response.data})
            })
            .catch((err) => {
                dispatch({type: types.UPVOTE_MESSAGE_FAILURE, payload: err})
            })
    }
};